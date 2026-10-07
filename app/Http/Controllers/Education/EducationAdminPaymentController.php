<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\EducationBookingPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EducationAdminPaymentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | PAYMENTS INDEX
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = EducationBookingPayment::query()
            ->with([
                'booking.student',
                'booking.bookingType',
                'reviewer',
            ]);

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = trim($request->search);

            $query->where(function ($query) use ($search) {

                $query
                    ->where(
                        'payment_reference',
                        'like',
                        "%{$search}%"
                    )

                    ->orWhere(
                        'payment_method',
                        'like',
                        "%{$search}%"
                    )

                    ->orWhere(
                        'receipt_original_name',
                        'like',
                        "%{$search}%"
                    )

                    ->orWhereHas(
                        'booking',
                        function ($bookingQuery) use ($search) {

                            $bookingQuery
                                ->where(
                                    'title',
                                    'like',
                                    "%{$search}%"
                                )

                                ->orWhere(
                                    'id',
                                    $search
                                )

                                ->orWhereHas(
                                    'student',
                                    function ($studentQuery) use ($search) {

                                        $studentQuery
                                            ->where(
                                                'name',
                                                'like',
                                                "%{$search}%"
                                            )

                                            ->orWhere(
                                                'email',
                                                'like',
                                                "%{$search}%"
                                            );
                                    }
                                )

                                ->orWhereHas(
                                    'bookingType',
                                    function ($typeQuery) use ($search) {

                                        $typeQuery->where(
                                            'name',
                                            'like',
                                            "%{$search}%"
                                        );
                                    }
                                );
                        }
                    );
            });
        }

        /*
        |--------------------------------------------------------------------------
        | STATUS FILTER
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );
        }

        /*
        |--------------------------------------------------------------------------
        | PAYMENT METHOD FILTER
        |--------------------------------------------------------------------------
        */

        if ($request->filled('payment_method')) {

            $query->where(
                'payment_method',
                $request->payment_method
            );
        }

        /*
        |--------------------------------------------------------------------------
        | DATE FILTER
        |--------------------------------------------------------------------------
        */

        if ($request->filled('date')) {

            $query->whereDate(
                'created_at',
                $request->date
            );
        }

        /*
        |--------------------------------------------------------------------------
        | PAGINATION
        |--------------------------------------------------------------------------
        */

        $payments = $query
            ->latest('created_at')
            ->paginate(20)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | STATISTICS
        |--------------------------------------------------------------------------
        */

        $statistics = [

            'total' =>
                EducationBookingPayment::count(),

            'unpaid' =>
                EducationBookingPayment::where(
                    'status',
                    'unpaid'
                )->count(),

            'submitted' =>
                EducationBookingPayment::where(
                    'status',
                    'submitted'
                )->count(),

            'under_review' =>
                EducationBookingPayment::where(
                    'status',
                    'under_review'
                )->count(),

            'approved' =>
                EducationBookingPayment::where(
                    'status',
                    'approved'
                )->count(),

            'rejected' =>
                EducationBookingPayment::where(
                    'status',
                    'rejected'
                )->count(),
        ];

        return view(
            'education.admin.payments.index',
            compact(
                'payments',
                'statistics'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PAYMENT SHOW
    |--------------------------------------------------------------------------
    */

    public function show(
        EducationBookingPayment $payment
    ) {

        $payment->load([
            'booking.student',
            'booking.bookingType',
            'reviewer',
        ]);

        return view(
            'education.admin.payments.show',
            compact('payment')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | START REVIEW
    |--------------------------------------------------------------------------
    |
    | نقل الدفع من submitted إلى under_review.
    |
    */

    public function review(
        EducationBookingPayment $payment
    ) {

        if ($payment->status !== 'submitted') {

            return back()->with(
                'error',
                'عملية الدفع ليست في حالة تسمح ببدء المراجعة.'
            );
        }

        DB::transaction(function () use ($payment) {

            $payment->update([

                'status' =>
                    'under_review',

                'reviewed_by' =>
                    Auth::guard(
                        'education_admin'
                    )->id(),

                'reviewed_at' =>
                    now(),
            ]);
        });

        return back()->with(
            'success',
            'تم نقل عملية الدفع إلى حالة قيد المراجعة.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | APPROVE PAYMENT
    |--------------------------------------------------------------------------
    |
    | اعتماد إثبات الدفع.
    |
    */

    public function approve(
        EducationBookingPayment $payment
    ) {

        if (
            !in_array(
                $payment->status,
                [
                    'submitted',
                    'under_review',
                ],
                true
            )
        ) {

            return back()->with(
                'error',
                'حالة الدفع الحالية لا تسمح بالاعتماد.'
            );
        }

        DB::transaction(function () use ($payment) {

            /*
            |--------------------------------------------------------------------------
            | APPROVE PAYMENT
            |--------------------------------------------------------------------------
            |
            | جميع بيانات الدفع يتم تحديثها في
            | education_booking_payments
            |
            */

            $payment->update([

                'status' =>
                    'approved',

                'reviewed_by' =>
                    Auth::guard(
                        'education_admin'
                    )->id(),

                'reviewed_at' =>
                    now(),

                'rejection_reason' =>
                    null,

                'paid_at' =>
                    now(),
            ]);
        });

        return back()->with(
            'success',
            'تم اعتماد الدفع بنجاح.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | REJECT PAYMENT
    |--------------------------------------------------------------------------
    |
    | رفض إثبات الدفع مع تسجيل سبب الرفض.
    |
    */

    public function reject(
        Request $request,
        EducationBookingPayment $payment
    ) {

        if (
            !in_array(
                $payment->status,
                [
                    'submitted',
                    'under_review',
                ],
                true
            )
        ) {

            return back()->with(
                'error',
                'حالة الدفع الحالية لا تسمح بالرفض.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'rejection_reason' => [
                'required',
                'string',
                'max:2000',
            ],

        ]);

        /*
        |--------------------------------------------------------------------------
        | REJECT
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $payment,
            $validated
        ) {

            $payment->update([

                'status' =>
                    'rejected',

                'reviewed_by' =>
                    Auth::guard(
                        'education_admin'
                    )->id(),

                'reviewed_at' =>
                    now(),

                'rejection_reason' =>
                    $validated['rejection_reason'],

                'paid_at' =>
                    null,
            ]);
        });

        return back()->with(
            'success',
            'تم رفض إثبات الدفع. يمكن للطالب إرسال إثبات جديد.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | RESET PAYMENT
    |--------------------------------------------------------------------------
    |
    | إعادة الدفع إلى حالة غير مدفوع.
    |
    */

    public function reset(
        EducationBookingPayment $payment
    ) {

        DB::transaction(function () use ($payment) {

            $payment->update([

                'status' =>
                    'unpaid',

                'reviewed_by' =>
                    null,

                'reviewed_at' =>
                    null,

                'rejection_reason' =>
                    null,

                'admin_note' =>
                    null,

                'paid_at' =>
                    null,
            ]);
        });

        return back()->with(
            'success',
            'تم إعادة عملية الدفع إلى حالة غير مدفوع.'
        );
    }
}
