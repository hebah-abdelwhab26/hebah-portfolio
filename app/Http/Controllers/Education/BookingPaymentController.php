<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\EducationBooking;
use App\Models\EducationBookingPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BookingPaymentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | PAYMENT PAGE
    |--------------------------------------------------------------------------
    |
    | عرض صفحة الدفع الخاصة بالحجز.
    |
    */

    public function show(EducationBooking $booking)
    {
        $this->authorizeBooking($booking);

        /*
        |--------------------------------------------------------------------------
        | التأكد من وجود عملية دفع للحجز
        |--------------------------------------------------------------------------
        */

        $payment = $booking->payment;

        if (!$payment) {

            $payment = new EducationBookingPayment();

            $payment->education_booking_id = $booking->id;
            $payment->amount = $booking->lesson_price;
            $payment->currency = $booking->currency;
            $payment->status = 'unpaid';

            $payment->save();
        }

        return view(
            'education.front.bookings.payment',
            compact(
                'booking',
                'payment'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SUBMIT PAYMENT PROOF
    |--------------------------------------------------------------------------
    |
    | استقبال إثبات التحويل من الطالب.
    |
    */

    public function submit(
        Request $request,
        EducationBooking $booking
    ) {
        $this->authorizeBooking($booking);

        /*
        |--------------------------------------------------------------------------
        | التحقق من البيانات
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'payment_method' => [
                'required',
                'string',
                'max:100',
            ],

            'payment_reference' => [
                'nullable',
                'string',
                'max:255',
            ],

            'receipt_file' => [
                'required',
                'file',
                'mimes:jpg,jpeg,png,webp,pdf',
                'max:5120',
            ],

            'student_note' => [
                'nullable',
                'string',
                'max:2000',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | PAYMENT
        |--------------------------------------------------------------------------
        */

        $payment = $booking->payment;


        /*
        |--------------------------------------------------------------------------
        | إنشاء سجل الدفع إذا لم يكن موجودًا
        |--------------------------------------------------------------------------
        */

        if (!$payment) {

            $payment = new EducationBookingPayment();

            $payment->education_booking_id = $booking->id;
            $payment->amount = $booking->lesson_price;
            $payment->currency = $booking->currency;
        }


        /*
        |--------------------------------------------------------------------------
        | منع إعادة إرسال الدفع بعد قبوله
        |--------------------------------------------------------------------------
        */

        if ($payment->status === 'approved') {

            return back()->with(
                'error',
                'تم اعتماد عملية الدفع لهذا الحجز بالفعل.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | منع الدفع للحجز الملغي
        |--------------------------------------------------------------------------
        */

        if ($booking->status === 'cancelled') {

            return back()->with(
                'error',
                'لا يمكن إرسال إثبات دفع لحجز ملغي.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | رفع الملف
        |--------------------------------------------------------------------------
        */

        $file = $request->file('receipt_file');


        /*
        |--------------------------------------------------------------------------
        | إنشاء مجلد إثباتات الدفع
        |--------------------------------------------------------------------------
        |
        | حسب نظام المشروع الحالي:
        | نستخدم public مباشرة وليس storage/public.
        |
        */

        $directory = public_path(
            'images/education/payments'
        );


        if (!File::exists($directory)) {
            File::makeDirectory(
                $directory,
                0755,
                true
            );
        }


        /*
        |--------------------------------------------------------------------------
        | اسم الملف
        |--------------------------------------------------------------------------
        */

        $extension = $file->getClientOriginalExtension();

        $filename =
            'payment-' .
            $booking->id .
            '-' .
            Str::uuid() .
            '.' .
            $extension;


        /*
        |--------------------------------------------------------------------------
        | نقل الملف
        |--------------------------------------------------------------------------
        */

        $file->move(
            $directory,
            $filename
        );


        /*
        |--------------------------------------------------------------------------
        | مسار الملف داخل public
        |--------------------------------------------------------------------------
        */

        $filePath =
            'images/education/payments/' .
            $filename;


        /*
        |--------------------------------------------------------------------------
        | حفظ بيانات الدفع
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $payment,
            $validated,
            $file,
            $filePath
        ) {

            $payment->payment_method =
                $validated['payment_method'];

            $payment->payment_reference =
                $validated['payment_reference'] ?? null;

            $payment->receipt_file =
                $filePath;

            $payment->receipt_original_name =
                $file->getClientOriginalName();

            $payment->receipt_mime_type =
                $file->getClientMimeType();

            $payment->receipt_file_size =
                $file->getSize();

            $payment->student_note =
                $validated['student_note'] ?? null;

            $payment->status =
                'submitted';

            $payment->submitted_at =
                now();

            /*
            |--------------------------------------------------------------------------
            | إعادة ضبط بيانات المراجعة
            |--------------------------------------------------------------------------
            */

            $payment->reviewed_by = null;

            $payment->reviewed_at = null;

            $payment->admin_note = null;

            $payment->rejection_reason = null;

            $payment->paid_at = null;

            $payment->save();
        });


        /*
        |--------------------------------------------------------------------------
        | العودة
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'education.bookings.show',
                $booking
            )
            ->with(
                'success',
                'تم إرسال إثبات الدفع بنجاح، وسيتم مراجعته من الإدارة.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | AUTHORIZE BOOKING
    |--------------------------------------------------------------------------
    |
    | التأكد أن الحجز يخص الطالب الحالي.
    |
    */

    protected function authorizeBooking(
        EducationBooking $booking
    ): void {

        /*
        |--------------------------------------------------------------------------
        | ملاحظة
        |--------------------------------------------------------------------------
        |
        | EducationUser نظام مستقل عن users.
        |
        | لذلك نحتاج لاحقًا إلى استخدام نظام المصادقة
        | الخاص بالطلاب إذا كان المشروع يستخدم guard مستقل.
        |
        */

        $user = Auth::user();

        if (!$user) {
            abort(403);
        }


        /*
        |--------------------------------------------------------------------------
        | إذا كان EducationUser هو المستخدم المصادق عليه
        |--------------------------------------------------------------------------
        */

        if (
            $user instanceof \App\Models\EducationUser
            &&
            $booking->education_user_id !== $user->id
        ) {

            abort(403);
        }
    }
}
