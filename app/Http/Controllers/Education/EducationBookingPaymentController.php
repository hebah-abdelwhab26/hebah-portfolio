<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\EducationBooking;
use App\Models\EducationSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class EducationBookingPaymentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | PAYMENT PAGE
    |--------------------------------------------------------------------------
    */

    public function show(EducationBooking $booking)
    {
        /*
        |--------------------------------------------------------------------------
        | AUTHENTICATED STUDENT
        |--------------------------------------------------------------------------
        */

        $student = Auth::guard('education')->user();

        if (!$student) {
            return redirect()
                ->route('education.login')
                ->withErrors([
                    'email' => 'يرجى تسجيل الدخول أولًا.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | AUTHORIZE BOOKING
        |--------------------------------------------------------------------------
        */

        abort_unless(
            (int) $booking->education_user_id === (int) $student->id,
            403
        );

        /*
        |--------------------------------------------------------------------------
        | LOAD RELATIONS
        |--------------------------------------------------------------------------
        */

        $booking->load([
            'student',
            'bookingType',
            'payment',
        ]);

        /*
        |--------------------------------------------------------------------------
        | EDUCATION SETTINGS
        |--------------------------------------------------------------------------
        */

        $educationSettings = EducationSetting::query()
            ->first();

        /*
        |--------------------------------------------------------------------------
        | CHECK PAYMENT ENABLED
        |--------------------------------------------------------------------------
        */

        $paymentEnabled = $educationSettings
            ? (bool) $educationSettings->payment_enabled
            : true;

        /*
        |--------------------------------------------------------------------------
        | CREATE PAYMENT IF NOT EXISTS
        |--------------------------------------------------------------------------
        */

        $payment = $booking->payment;

        if (!$payment) {
            $payment = $booking->payment()->create([
                'amount' => (float) $booking->price,
                'currency' => $booking->currency ?? 'SAR',
                'status' => 'unpaid',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'education.student.bookings.payment',
            compact(
                'booking',
                'payment',
                'educationSettings',
                'paymentEnabled'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STORE PAYMENT PROOF
    |--------------------------------------------------------------------------
    */

    public function store(
        Request $request,
        EducationBooking $booking
    ) {

        /*
        |--------------------------------------------------------------------------
        | AUTHENTICATED STUDENT
        |--------------------------------------------------------------------------
        */

        $student = Auth::guard('education')->user();

        if (!$student) {
            return redirect()
                ->route('education.login')
                ->withErrors([
                    'email' => 'يرجى تسجيل الدخول أولًا.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | AUTHORIZE BOOKING
        |--------------------------------------------------------------------------
        */

        abort_unless(
            (int) $booking->education_user_id === (int) $student->id,
            403
        );

        /*
        |--------------------------------------------------------------------------
        | EDUCATION SETTINGS
        |--------------------------------------------------------------------------
        */

        $educationSettings = EducationSetting::query()
            ->first();

        /*
        |--------------------------------------------------------------------------
        | PAYMENT ENABLED CHECK
        |--------------------------------------------------------------------------
        */

        if (
            $educationSettings &&
            !$educationSettings->payment_enabled
        ) {
            return back()->with(
                'error',
                'الدفع غير متاح حاليًا. يرجى التواصل مع الإدارة.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate(

            [
                'payment_method' => [
                    'required',
                    'string',
                    'in:bank_transfer,cash,other',
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
            ],

            [

                'payment_method.required' =>
                    'يرجى اختيار طريقة الدفع.',

                'payment_method.in' =>
                    'طريقة الدفع المحددة غير صحيحة.',

                'receipt_file.required' =>
                    'يرجى إرفاق إثبات الدفع.',

                'receipt_file.file' =>
                    'ملف إثبات الدفع غير صالح.',

                'receipt_file.mimes' =>
                    'يسمح فقط بملفات JPG أو JPEG أو PNG أو WEBP أو PDF.',

                'receipt_file.max' =>
                    'حجم إثبات الدفع يجب ألا يتجاوز 5 MB.',

                'student_note.max' =>
                    'الملاحظات لا يمكن أن تتجاوز 2000 حرف.',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | PAYMENT
        |--------------------------------------------------------------------------
        */

        $payment = $booking->payment;

        if (!$payment) {
            $payment = $booking->payment()->create([
                'amount' => (float) $booking->price,
                'currency' => $booking->currency ?? 'SAR',
                'status' => 'unpaid',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | PREVENT DUPLICATE SUBMISSION
        |--------------------------------------------------------------------------
        */

        if (
            in_array(
                $payment->status,
                [
                    'submitted',
                    'under_review',
                    'approved',
                ],
                true
            )
        ) {
            return back()->with(
                'error',
                'لا يمكن إرسال إثبات دفع جديد في حالة الدفع الحالية.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | UPLOAD DIRECTORY
        |--------------------------------------------------------------------------
        |
        | المشروع يستخدم:
        |
        | public/images
        |
        | ولا يستخدم storage/public.
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
        | OLD RECEIPT
        |--------------------------------------------------------------------------
        */

        $oldReceiptPath =
            $payment->receipt_file ?? null;

        /*
        |--------------------------------------------------------------------------
        | UPLOAD NEW RECEIPT
        |--------------------------------------------------------------------------
        */

        $receiptPath = null;

        $receiptOriginalName = null;

        $receiptMimeType = null;

        $receiptFileSize = null;

        if ($request->hasFile('receipt_file')) {

            $file = $request->file('receipt_file');

            $extension = strtolower(
                $file->getClientOriginalExtension()
            );

            $receiptOriginalName =
                $file->getClientOriginalName();

            $receiptMimeType =
                $file->getClientMimeType();

            $receiptFileSize =
                $file->getSize();

            $filename =
                'payment_' .
                $booking->id .
                '_' .
                Str::uuid() .
                '.' .
                $extension;

            $file->move(
                $directory,
                $filename
            );

            $receiptPath =
                'images/education/payments/' .
                $filename;
        }

        /*
        |--------------------------------------------------------------------------
        | SAVE PAYMENT
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $payment,
            $booking,
            $validated,
            $receiptPath,
            $receiptOriginalName,
            $receiptMimeType,
            $receiptFileSize
        ) {

            $data = [

                /*
                |--------------------------------------------------------------------------
                | PAYMENT INFORMATION
                |--------------------------------------------------------------------------
                */

                'amount' =>
                    (float) $booking->price,

                'currency' =>
                    $booking->currency ?? 'SAR',

                'payment_method' =>
                    $validated['payment_method'],

                'payment_reference' =>
                    $validated['payment_reference'] ?? null,

                /*
                |--------------------------------------------------------------------------
                | STUDENT SUBMISSION
                |--------------------------------------------------------------------------
                */

                'student_note' =>
                    $validated['student_note'] ?? null,

                'status' =>
                    'submitted',

                'submitted_at' =>
                    now(),

                /*
                |--------------------------------------------------------------------------
                | RESET ADMIN REVIEW
                |--------------------------------------------------------------------------
                */

                'reviewed_by' =>
                    null,

                'reviewed_at' =>
                    null,

                'admin_note' =>
                    null,

                'rejection_reason' =>
                    null,

                /*
                |--------------------------------------------------------------------------
                | PAYMENT CONFIRMATION
                |--------------------------------------------------------------------------
                */

                'paid_at' =>
                    null,
            ];

            /*
            |--------------------------------------------------------------------------
            | RECEIPT
            |--------------------------------------------------------------------------
            */

            if ($receiptPath) {

                $data['receipt_file'] =
                    $receiptPath;

                $data['receipt_original_name'] =
                    $receiptOriginalName;

                $data['receipt_mime_type'] =
                    $receiptMimeType;

                $data['receipt_file_size'] =
                    $receiptFileSize;
            }

            /*
            |--------------------------------------------------------------------------
            | UPDATE PAYMENT
            |--------------------------------------------------------------------------
            |
            | مهم:
            |
            | جميع بيانات الدفع تحفظ في:
            |
            | education_booking_payments
            |
            | وليس education_bookings.
            |
            */

            $payment->update($data);
        });

        /*
        |--------------------------------------------------------------------------
        | DELETE OLD RECEIPT
        |--------------------------------------------------------------------------
        */

        if (
            $oldReceiptPath &&
            $receiptPath &&
            $oldReceiptPath !== $receiptPath
        ) {

            $oldReceiptFullPath =
                public_path($oldReceiptPath);

            if (File::exists($oldReceiptFullPath)) {

                File::delete(
                    $oldReceiptFullPath
                );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'education.booking.payment.show',
                $booking
            )
            ->with(
                'success',
                'تم إرسال إثبات الدفع بنجاح، وسيتم مراجعته من الإدارة.'
            );
    }
}
