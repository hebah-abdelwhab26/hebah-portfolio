<?php

namespace App\Http\Controllers;

use App\Models\EducationBooking;
use App\Models\EducationBookingPaymentProof;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class EducationBookingPaymentProofController extends Controller
{
    /**
     * Store a new bank-transfer payment proof.
     */
    public function store(
        Request $request,
        EducationBooking $booking
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | VERIFY CURRENT STUDENT
        |--------------------------------------------------------------------------
        */

        $educationUser = Auth::guard('education')->user();

        abort_unless(
            $educationUser &&
            $booking->education_user_id === $educationUser->id,
            403
        );


        /*
        |--------------------------------------------------------------------------
        | CHECK BOOKING PAYMENT STATUS
        |--------------------------------------------------------------------------
        */

        if ($booking->payment_status === 'paid') {

            return back()->with(
                'booking_error',
                'هذا الحجز تم دفع قيمته بالفعل.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | CHECK BOOKING STATUS
        |--------------------------------------------------------------------------
        */

        if (!in_array(
            $booking->status,
            ['pending', 'confirmed'],
            true
        )) {

            return back()->with(
                'booking_error',
                'لا يمكن رفع إثبات دفع لهذا الحجز في حالته الحالية.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | CHECK EXISTING PENDING PROOF
        |--------------------------------------------------------------------------
        */

        $pendingProofExists =
            $booking->paymentProofs()
                ->where('status', 'pending')
                ->exists();

        if ($pendingProofExists) {

            return back()->with(
                'booking_error',
                'يوجد إثبات دفع قيد المراجعة لهذا الحجز بالفعل.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'payment_proof' => [
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

        ], [

            'payment_proof.required' =>
                'يرجى إرفاق إثبات التحويل.',

            'payment_proof.file' =>
                'الملف المرفق غير صالح.',

            'payment_proof.mimes' =>
                'يسمح فقط بصور JPG و PNG و WEBP أو ملفات PDF.',

            'payment_proof.max' =>
                'حجم الملف يجب ألا يتجاوز 5 ميجابايت.',

            'student_note.max' =>
                'الملاحظة طويلة جدًا.',

        ]);


        /*
        |--------------------------------------------------------------------------
        | UPLOAD DIRECTORY
        |--------------------------------------------------------------------------
        |
        | المشروع يستخدم public مباشرة وليس storage/public.
        |
        */

        $directory =
            public_path(
                'images/education/payment-proofs'
            );


        /*
        |--------------------------------------------------------------------------
        | CREATE DIRECTORY
        |--------------------------------------------------------------------------
        */

        if (!File::exists($directory)) {

            File::makeDirectory(
                $directory,
                0755,
                true
            );
        }


        /*
        |--------------------------------------------------------------------------
        | FILE INFORMATION
        |--------------------------------------------------------------------------
        */

        $file =
            $validated['payment_proof'];

        $originalName =
            $file->getClientOriginalName();

        $mimeType =
            $file->getClientMimeType();

        $fileSize =
            $file->getSize();


        /*
        |--------------------------------------------------------------------------
        | GENERATE UNIQUE FILE NAME
        |--------------------------------------------------------------------------
        */

        $extension =
            strtolower(
                $file->getClientOriginalExtension()
            );

        $fileName =
            'booking-' .
            $booking->id .
            '-' .
            Str::uuid() .
            '.' .
            $extension;


        /*
        |--------------------------------------------------------------------------
        | MOVE FILE
        |--------------------------------------------------------------------------
        */

        $file->move(
            $directory,
            $fileName
        );


        /*
        |--------------------------------------------------------------------------
        | DATABASE RECORD
        |--------------------------------------------------------------------------
        */

        EducationBookingPaymentProof::create([

            'education_booking_id' =>
                $booking->id,

            'file_path' =>
                'images/education/payment-proofs/' .
                $fileName,

            'original_name' =>
                $originalName,

            'mime_type' =>
                $mimeType,

            'file_size' =>
                $fileSize,

            'student_note' =>
                $validated['student_note'] ?? null,

            'status' =>
                'pending',

        ]);


        /*
        |--------------------------------------------------------------------------
        | UPDATE PAYMENT STATUS
        |--------------------------------------------------------------------------
        |
        | رفع الإثبات لا يعني أن الدفع تم قبوله.
        | لذلك تصبح الحالة pending إلى أن تراجعه الإدارة.
        |
        */

        $booking->update([

            'payment_status' => 'pending',

            'payment_method' => 'bank_transfer',

        ]);


        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        return back()->with(
            'booking_success',
            'تم رفع إثبات التحويل بنجاح، وسيتم مراجعته من الإدارة.'
        );
    }
}
