<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\EducationAdminNotification;
use App\Models\EducationBooking;
use App\Models\EducationUserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class EducationAdminBookingController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | NOTIFY STUDENT
    |--------------------------------------------------------------------------
    |
    | إنشاء إشعار للطالب المرتبط بالحجز.
    |
    | مهم:
    | جميع الروابط التي يتم حفظها في إشعارات الطالب يجب أن تكون
    | روابط خاصة بمنطقة الطالب، وليس منطقة الإدارة.
    |
    */

    private function notifyStudent(
        EducationBooking $booking,
        string $type,
        string $title,
        string $message,
        string $icon = '🔔',
        string $color = 'gold',
        ?string $url = null,
        array $data = []
    ): void {

        /*
        |--------------------------------------------------------------------------
        | STUDENT CHECK
        |--------------------------------------------------------------------------
        */

        if (!$booking->education_user_id) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | SAFE STUDENT URL
        |--------------------------------------------------------------------------
        */

        $notificationUrl = $url;


        /*
        |--------------------------------------------------------------------------
        | AUTOMATIC URL BY NOTIFICATION TYPE
        |--------------------------------------------------------------------------
        */

        if ($notificationUrl === null) {

            try {

                /*
                |------------------------------------------------------------------
                | PAYMENT NOTIFICATIONS
                |------------------------------------------------------------------
                |
                | إشعارات الدفع تذهب مباشرة إلى صفحة دفع الحجز.
                |
                */

                if (
                    str_starts_with(
                        $type,
                        'payment_'
                    )
                ) {

                    $notificationUrl = route(
                        'education.booking.payment.show',
                        [
                            'booking' =>
                                $booking->id,
                        ]
                    );

                }

                /*
                |------------------------------------------------------------------
                | BOOKING NOTIFICATIONS
                |------------------------------------------------------------------
                |
                | إشعارات الحجز تذهب إلى صفحة تفاصيل الحجز الخاصة بالطالب.
                |
                */

                else {

                    $notificationUrl = route(
                        'education.booking.show',
                        [
                            'booking' =>
                                $booking->id,
                        ]
                    );
                }

            } catch (\Throwable $e) {

                /*
                |--------------------------------------------------------------------------
                | FALLBACK
                |--------------------------------------------------------------------------
                |
                | إذا لم يكن أحد مسارات الطالب متاحًا لأي سبب،
                | نستخدم لوحة الطالب كوجهة آمنة.
                |
                */

                try {

                    $notificationUrl = route(
                        'education.dashboard'
                    );

                } catch (\Throwable $exception) {

                    $notificationUrl = null;
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | CREATE STUDENT NOTIFICATION
        |--------------------------------------------------------------------------
        */

        EducationUserNotification::create([

            'education_user_id' =>
                $booking->education_user_id,

            'type' =>
                $type,

            'title' =>
                $title,

            'message' =>
                $message,

            'icon' =>
                $icon,

            'color' =>
                $color,

            'url' =>
                $notificationUrl,

            'data' =>
                array_merge(
                    [
                        'booking_id' =>
                            $booking->id,
                    ],
                    $data
                ),

        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | BOOKINGS INDEX
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | QUERY
        |--------------------------------------------------------------------------
        */

        $query = EducationBooking::query()
            ->with([
                'student',
                'bookingType',
                'payment',
            ]);


        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = trim(
                $request->input('search')
            );

            $query->where(function ($q) use ($search) {

                $q->where(
                    'title',
                    'like',
                    "%{$search}%"
                )

                ->orWhere(
                    'description',
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
                )

                ->orWhereHas(
                    'payment',
                    function ($paymentQuery) use ($search) {

                        $paymentQuery
                            ->where(
                                'payment_reference',
                                'like',
                                "%{$search}%"
                            )
                            ->orWhere(
                                'payment_method',
                                'like',
                                "%{$search}%"
                            );
                    }
                );

            });
        }


        /*
        |--------------------------------------------------------------------------
        | BOOKING STATUS FILTER
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->input('status')
            );
        }


        /*
        |--------------------------------------------------------------------------
        | PAYMENT STATUS FILTER
        |--------------------------------------------------------------------------
        */

        if ($request->filled('payment_status')) {

            $query->where(
                'payment_status',
                $request->input('payment_status')
            );
        }


        /*
        |--------------------------------------------------------------------------
        | DATE FILTER
        |--------------------------------------------------------------------------
        */

        if ($request->filled('date')) {

            $query->where(
                'booking_date',
                $request->input('date')
            );
        }


        /*
        |--------------------------------------------------------------------------
        | ORDER
        |--------------------------------------------------------------------------
        */

        $bookings = $query
            ->orderByDesc('booking_date')
            ->orderByDesc('start_time')
            ->orderByDesc('id')
            ->paginate(15)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | STATISTICS
        |--------------------------------------------------------------------------
        */

        $statistics = [

            /*
            |--------------------------------------------------------------------------
            | BOOKING STATISTICS
            |--------------------------------------------------------------------------
            */

            'total' =>
                EducationBooking::count(),

            'pending' =>
                EducationBooking::where(
                    'status',
                    'pending'
                )->count(),

            'confirmed' =>
                EducationBooking::where(
                    'status',
                    'confirmed'
                )->count(),

            'completed' =>
                EducationBooking::where(
                    'status',
                    'completed'
                )->count(),

            'cancelled' =>
                EducationBooking::where(
                    'status',
                    'cancelled'
                )->count(),

            'no_show' =>
                EducationBooking::where(
                    'status',
                    'no_show'
                )->count(),


            /*
            |--------------------------------------------------------------------------
            | PAYMENT STATISTICS
            |--------------------------------------------------------------------------
            */

            'unpaid' =>
                EducationBooking::where(
                    'payment_status',
                    'unpaid'
                )->count(),

            'payment_pending' =>
                EducationBooking::where(
                    'payment_status',
                    'pending'
                )->count(),

            'paid' =>
                EducationBooking::where(
                    'payment_status',
                    'paid'
                )->count(),

            'failed' =>
                EducationBooking::where(
                    'payment_status',
                    'failed'
                )->count(),

            'refunded' =>
                EducationBooking::where(
                    'payment_status',
                    'refunded'
                )->count(),

        ];


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'education.admin.bookings.index',
            compact(
                'bookings',
                'statistics'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | BOOKING SHOW
    |--------------------------------------------------------------------------
    */

    public function show(
        EducationBooking $booking
    ) {

        /*
        |--------------------------------------------------------------------------
        | LOAD RELATIONS
        |--------------------------------------------------------------------------
        */

        $booking->load([

            'student',

            'bookingType',

            'payment',

            'lessonAssignments.lesson',

            'lessonAssignments.studentLesson',

            'studentLessons' => function ($query) {

                $query
                    ->where(
                        'is_active',
                        true
                    )
                    ->orderBy(
                        'session_number'
                    )
                    ->orderBy(
                        'id'
                    );

            },

            'studentLessons.sourceLesson',

            'studentLessons.contents',

            'studentLessons.evaluation',

        ]);


        return view(
            'education.admin.bookings.show',
            compact('booking')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE BOOKING STATUS
    |--------------------------------------------------------------------------
    */

    public function updateStatus(
        Request $request,
        EducationBooking $booking
    ) {

        $validated = $request->validate([

            'status' => [
                'required',

                Rule::in([
                    'pending',
                    'confirmed',
                    'completed',
                    'cancelled',
                    'no_show',
                ]),
            ],

        ]);


        $oldStatus =
            $booking->status;

        $newStatus =
            $validated['status'];


        $booking->update([
            'status' =>
                $newStatus,
        ]);


        /*
        |--------------------------------------------------------------------------
        | NOTIFY STUDENT
        |--------------------------------------------------------------------------
        */

        if ($oldStatus !== $newStatus) {

            $messages = [

                'pending' => [
                    'title' =>
                        'تحديث حالة الحجز',

                    'message' =>
                        'تم تغيير حالة حجزك إلى قيد الانتظار.',

                    'icon' =>
                        '⏳',

                    'color' =>
                        'gold',
                ],

                'confirmed' => [
                    'title' =>
                        'تم تأكيد الحجز',

                    'message' =>
                        'تم تأكيد حجزك بنجاح.',

                    'icon' =>
                        '✓',

                    'color' =>
                        'green',
                ],

                'completed' => [
                    'title' =>
                        'تم إكمال الدرس',

                    'message' =>
                        'تم تسجيل الدرس المرتبط بحجزك كمكتمل.',

                    'icon' =>
                        '✓',

                    'color' =>
                        'green',
                ],

                'cancelled' => [
                    'title' =>
                        'تم إلغاء الحجز',

                    'message' =>
                        'تم إلغاء حجزك من قبل الإدارة.',

                    'icon' =>
                        '×',

                    'color' =>
                        'red',
                ],

                'no_show' => [
                    'title' =>
                        'تسجيل عدم الحضور',

                    'message' =>
                        'تم تسجيل هذا الحجز كعدم حضور.',

                    'icon' =>
                        '⚠',

                    'color' =>
                        'red',
                ],

            ];


            if (isset($messages[$newStatus])) {

                $notification =
                    $messages[$newStatus];

                $this->notifyStudent(
                    $booking,
                    'booking_status',
                    $notification['title'],
                    $notification['message'],
                    $notification['icon'],
                    $notification['color'],
                    null,
                    [
                        'old_status' =>
                            $oldStatus,

                        'new_status' =>
                            $newStatus,
                    ]
                );
            }
        }


        return back()->with(
            'success',
            'تم تحديث حالة الحجز بنجاح.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CONFIRM BOOKING
    |--------------------------------------------------------------------------
    */

    public function confirm(
        EducationBooking $booking
    ) {

        if (
            $booking->status ===
            'cancelled'
        ) {

            return back()->with(
                'error',
                'لا يمكن تأكيد حجز ملغى.'
            );
        }


        if (
            $booking->status ===
            'completed'
        ) {

            return back()->with(
                'error',
                'هذا الحجز مكتمل بالفعل.'
            );
        }


        $oldStatus =
            $booking->status;


        $booking->update([
            'status' =>
                'confirmed',
        ]);


        /*
        |--------------------------------------------------------------------------
        | NOTIFY STUDENT
        |--------------------------------------------------------------------------
        */

        if ($oldStatus !== 'confirmed') {

            $this->notifyStudent(
                $booking,
                'booking_confirmed',
                'تم تأكيد الحجز',
                'تم تأكيد حجزك بنجاح. يمكنك متابعة تفاصيل الحجز من لوحة الطالب.',
                '✓',
                'green',
                null,
                [
                    'old_status' =>
                        $oldStatus,

                    'new_status' =>
                        'confirmed',
                ]
            );
        }


        return back()->with(
            'success',
            'تم تأكيد الحجز بنجاح.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | COMPLETE BOOKING
    |--------------------------------------------------------------------------
    */

    public function complete(
        EducationBooking $booking
    ) {

        if (
            $booking->status ===
            'cancelled'
        ) {

            return back()->with(
                'error',
                'لا يمكن إكمال حجز ملغى.'
            );
        }


        if (
            $booking->status ===
            'completed'
        ) {

            return back()->with(
                'error',
                'الدرس مكتمل بالفعل.'
            );
        }


        $oldStatus =
            $booking->status;


        $booking->update([
            'status' =>
                'completed',
        ]);


        /*
        |--------------------------------------------------------------------------
        | NOTIFY STUDENT
        |--------------------------------------------------------------------------
        */

        $this->notifyStudent(
            $booking,
            'booking_completed',
            'تم إكمال الدرس',
            'تم تسجيل الدرس المرتبط بحجزك كمكتمل.',
            '✓',
            'green',
            null,
            [
                'old_status' =>
                    $oldStatus,

                'new_status' =>
                    'completed',
            ]
        );


        return back()->with(
            'success',
            'تم تسجيل الدرس كمكتمل بنجاح.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CANCEL BOOKING
    |--------------------------------------------------------------------------
    */

    public function cancel(
        EducationBooking $booking
    ) {

        if (
            $booking->status ===
            'completed'
        ) {

            return back()->with(
                'error',
                'لا يمكن إلغاء درس مكتمل.'
            );
        }


        if (
            $booking->status ===
            'cancelled'
        ) {

            return back()->with(
                'error',
                'الحجز ملغى بالفعل.'
            );
        }


        $oldStatus =
            $booking->status;


        $booking->update([
            'status' =>
                'cancelled',
        ]);


        /*
        |--------------------------------------------------------------------------
        | NOTIFY STUDENT
        |--------------------------------------------------------------------------
        */

        $this->notifyStudent(
            $booking,
            'booking_cancelled',
            'تم إلغاء الحجز',
            'تم إلغاء حجزك من قبل الإدارة.',
            '×',
            'red',
            null,
            [
                'old_status' =>
                    $oldStatus,

                'new_status' =>
                    'cancelled',
            ]
        );


        return back()->with(
            'success',
            'تم إلغاء الحجز بنجاح.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | NO SHOW
    |--------------------------------------------------------------------------
    */

    public function noShow(
        EducationBooking $booking
    ) {

        if (
            $booking->status ===
            'cancelled'
        ) {

            return back()->with(
                'error',
                'لا يمكن تسجيل حجز ملغى كعدم حضور.'
            );
        }


        if (
            $booking->status ===
            'completed'
        ) {

            return back()->with(
                'error',
                'هذا الدرس مسجل كمكتمل بالفعل.'
            );
        }


        $oldStatus =
            $booking->status;


        $booking->update([
            'status' =>
                'no_show',
        ]);


        /*
        |--------------------------------------------------------------------------
        | NOTIFY STUDENT
        |--------------------------------------------------------------------------
        */

        $this->notifyStudent(
            $booking,
            'booking_no_show',
            'تسجيل عدم الحضور',
            'تم تسجيل هذا الحجز كعدم حضور.',
            '⚠',
            'red',
            null,
            [
                'old_status' =>
                    $oldStatus,

                'new_status' =>
                    'no_show',
            ]
        );


        return back()->with(
            'success',
            'تم تسجيل الطالب كغير حاضر.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PAYMENT - MARK AS PAID
    |--------------------------------------------------------------------------
    */

    public function markAsPaid(
        Request $request,
        EducationBooking $booking
    ) {

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

            'admin_note' => [
                'nullable',
                'string',
                'max:5000',
            ],

        ]);


        DB::transaction(
            function () use (
                $booking,
                $validated
            ) {

                $payment =
                    $booking->payment;


                if (!$payment) {

                    $payment =
                        $booking->payment()->create([

                            'amount' =>
                                (float) $booking->price,

                            'currency' =>
                                $booking->currency
                                ?? 'SAR',

                            'status' =>
                                'unpaid',

                        ]);
                }


                $payment->update([

                    'amount' =>
                        (float) $booking->price,

                    'currency' =>
                        $booking->currency
                        ?? 'SAR',

                    'payment_method' =>
                        $validated['payment_method'],

                    'payment_reference' =>
                        $validated['payment_reference']
                        ?? null,

                    'status' =>
                        'approved',

                    'admin_note' =>
                        $validated['admin_note']
                        ?? null,

                    'reviewed_by' =>
                        Auth::id(),

                    'reviewed_at' =>
                        now(),

                    'rejection_reason' =>
                        null,

                    'paid_at' =>
                        now(),

                ]);


                $booking->update([

                    'payment_status' =>
                        'paid',

                    'payment_method' =>
                        $validated['payment_method'],

                    'payment_reference' =>
                        $validated['payment_reference']
                        ?? null,

                    'paid_at' =>
                        now(),

                ]);

            }
        );


        /*
        |--------------------------------------------------------------------------
        | NOTIFY STUDENT
        |--------------------------------------------------------------------------
        */

        $this->notifyStudent(
            $booking,
            'payment_approved',
            'تم اعتماد الدفع',
            'تم تسجيل دفعتك واعتمادها بنجاح.',
            '✓',
            'green',
            null,
            [
                'payment_status' =>
                    'paid',
            ]
        );


        return back()->with(
            'success',
            'تم تسجيل الدفع واعتماده بنجاح.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PAYMENT - MARK PENDING
    |--------------------------------------------------------------------------
    */

    public function markPaymentPending(
        Request $request,
        EducationBooking $booking
    ) {

        $validated = $request->validate([

            'payment_method' => [
                'nullable',
                'string',
                'max:100',
            ],

            'payment_reference' => [
                'nullable',
                'string',
                'max:255',
            ],

            'admin_note' => [
                'nullable',
                'string',
                'max:5000',
            ],

        ]);


        DB::transaction(
            function () use (
                $booking,
                $validated
            ) {

                $payment =
                    $booking->payment;


                if (!$payment) {

                    $payment =
                        $booking->payment()->create([

                            'amount' =>
                                (float) $booking->price,

                            'currency' =>
                                $booking->currency
                                ?? 'SAR',

                            'status' =>
                                'unpaid',

                        ]);
                }


                $payment->update([

                    'amount' =>
                        (float) $booking->price,

                    'currency' =>
                        $booking->currency
                        ?? 'SAR',

                    'payment_method' =>
                        $validated['payment_method']
                        ?? 'manual_transfer',

                    'payment_reference' =>
                        $validated['payment_reference']
                        ?? null,

                    'status' =>
                        'under_review',

                    'admin_note' =>
                        $validated['admin_note']
                        ?? null,

                    'reviewed_by' =>
                        null,

                    'reviewed_at' =>
                        null,

                    'paid_at' =>
                        null,

                ]);


                $booking->update([

                    'payment_status' =>
                        'pending',

                    'payment_method' =>
                        $validated['payment_method']
                        ?? 'manual_transfer',

                    'payment_reference' =>
                        $validated['payment_reference']
                        ?? null,

                    'paid_at' =>
                        null,

                ]);

            }
        );


        /*
        |--------------------------------------------------------------------------
        | NOTIFY STUDENT
        |--------------------------------------------------------------------------
        */

        $this->notifyStudent(
            $booking,
            'payment_pending',
            'الدفع قيد المراجعة',
            'تم وضع عملية الدفع الخاصة بحجزك قيد المراجعة.',
            '⏳',
            'gold',
            null,
            [
                'payment_status' =>
                    'pending',
            ]
        );


        return back()->with(
            'success',
            'تم وضع الدفع قيد المراجعة.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PAYMENT - MARK UNPAID
    |--------------------------------------------------------------------------
    */

    public function markAsUnpaid(
        EducationBooking $booking
    ) {

        DB::transaction(
            function () use ($booking) {

                $payment =
                    $booking->payment;


                if ($payment) {

                    $payment->update([

                        'status' =>
                            'unpaid',

                        'payment_method' =>
                            null,

                        'payment_reference' =>
                            null,

                        'reviewed_by' =>
                            null,

                        'reviewed_at' =>
                            null,

                        'admin_note' =>
                            null,

                        'rejection_reason' =>
                            null,

                        'paid_at' =>
                            null,

                    ]);

                }


                $booking->update([

                    'payment_status' =>
                        'unpaid',

                    'payment_method' =>
                        null,

                    'payment_reference' =>
                        null,

                    'paid_at' =>
                        null,

                ]);

            }
        );


        /*
        |--------------------------------------------------------------------------
        | NOTIFY STUDENT
        |--------------------------------------------------------------------------
        */

        $this->notifyStudent(
            $booking,
            'payment_unpaid',
            'تحديث حالة الدفع',
            'تمت إعادة حالة الدفع الخاصة بحجزك إلى غير مدفوع.',
            '○',
            'gold',
            null,
            [
                'payment_status' =>
                    'unpaid',
            ]
        );


        return back()->with(
            'success',
            'تم إعادة الحجز إلى حالة غير مدفوع.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PAYMENT - MARK FAILED
    |--------------------------------------------------------------------------
    */

    public function markPaymentFailed(
        Request $request,
        EducationBooking $booking
    ) {

        $validated = $request->validate([

            'payment_reference' => [
                'nullable',
                'string',
                'max:255',
            ],

            'admin_note' => [
                'nullable',
                'string',
                'max:5000',
            ],

        ]);


        DB::transaction(
            function () use (
                $booking,
                $validated
            ) {

                $payment =
                    $booking->payment;


                if (!$payment) {

                    $payment =
                        $booking->payment()->create([

                            'amount' =>
                                (float) $booking->price,

                            'currency' =>
                                $booking->currency
                                ?? 'SAR',

                            'status' =>
                                'unpaid',

                        ]);
                }


                $payment->update([

                    'amount' =>
                        (float) $booking->price,

                    'currency' =>
                        $booking->currency
                        ?? 'SAR',

                    'payment_reference' =>
                        $validated['payment_reference']
                        ?? null,

                    'status' =>
                        'rejected',

                    'admin_note' =>
                        $validated['admin_note']
                        ?? null,

                    'reviewed_by' =>
                        Auth::id(),

                    'reviewed_at' =>
                        now(),

                    'paid_at' =>
                        null,

                ]);


                $booking->update([

                    'payment_status' =>
                        'failed',

                    'payment_reference' =>
                        $validated['payment_reference']
                        ?? null,

                    'paid_at' =>
                        null,

                ]);

            }
        );


        /*
        |--------------------------------------------------------------------------
        | NOTIFY STUDENT
        |--------------------------------------------------------------------------
        */

        $this->notifyStudent(
            $booking,
            'payment_failed',
            'تعذر اعتماد الدفع',
            'لم يتم اعتماد عملية الدفع الخاصة بحجزك. يرجى مراجعة تفاصيل الدفع.',
            '!',
            'red',
            null,
            [
                'payment_status' =>
                    'failed',
            ]
        );


        return back()->with(
            'success',
            'تم تسجيل الدفع كفاشل.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PAYMENT - REFUND
    |--------------------------------------------------------------------------
    */

    public function refundPayment(
        EducationBooking $booking
    ) {

        if (
            $booking->payment_status !==
            'paid'
        ) {

            return back()->with(
                'error',
                'لا يمكن استرداد مبلغ حجز غير مدفوع.'
            );
        }


        DB::transaction(
            function () use ($booking) {

                $payment =
                    $booking->payment;


                if ($payment) {

                    $payment->update([

                        'status' =>
                            'approved',

                        'admin_note' =>
                            'تم تسجيل المبلغ كمسترد.',

                        'paid_at' =>
                            null,

                    ]);

                }


                $booking->update([

                    'payment_status' =>
                        'refunded',

                    'paid_at' =>
                        null,

                ]);

            }
        );


        /*
        |--------------------------------------------------------------------------
        | NOTIFY STUDENT
        |--------------------------------------------------------------------------
        */

        $this->notifyStudent(
            $booking,
            'payment_refunded',
            'تم استرداد المبلغ',
            'تم تسجيل مبلغ حجزك كمسترد.',
            '↩',
            'gold',
            null,
            [
                'payment_status' =>
                    'refunded',
            ]
        );


        return back()->with(
            'success',
            'تم تسجيل المبلغ كمسترد.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PAYMENT - APPROVE STUDENT RECEIPT
    |--------------------------------------------------------------------------
    */

    public function approvePayment(
        EducationBooking $booking
    ) {

        $payment =
            $booking->payment;


        if (!$payment) {

            return back()->with(
                'error',
                'لا توجد عملية دفع مرتبطة بهذا الحجز.'
            );
        }


        if (!$payment->receipt_file) {

            return back()->with(
                'error',
                'لا يوجد إثبات دفع مرفوع لهذا الحجز.'
            );
        }


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
                'حالة عملية الدفع الحالية لا تسمح بالاعتماد.'
            );
        }


        DB::transaction(
            function () use (
                $booking,
                $payment
            ) {

                $payment->update([

                    'status' =>
                        'approved',

                    'reviewed_by' =>
                        Auth::id(),

                    'reviewed_at' =>
                        now(),

                    'rejection_reason' =>
                        null,

                    'paid_at' =>
                        now(),

                ]);


                $booking->update([

                    'payment_status' =>
                        'paid',

                    'paid_at' =>
                        now(),

                ]);

            }
        );


        /*
        |--------------------------------------------------------------------------
        | NOTIFY STUDENT
        |--------------------------------------------------------------------------
        */

        $this->notifyStudent(
            $booking,
            'payment_receipt_approved',
            'تم اعتماد إثبات الدفع',
            'تم اعتماد إثبات الدفع الذي رفعته بنجاح.',
            '✓',
            'green',
            null,
            [
                'payment_status' =>
                    'paid',
            ]
        );


        return back()->with(
            'success',
            'تم اعتماد إثبات الدفع بنجاح.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PAYMENT - REJECT STUDENT RECEIPT
    |--------------------------------------------------------------------------
    */

    public function rejectPayment(
        Request $request,
        EducationBooking $booking
    ) {

        $validated = $request->validate([

            'rejection_reason' => [
                'required',
                'string',
                'max:2000',
            ],

        ]);


        $payment =
            $booking->payment;


        if (!$payment) {

            return back()->with(
                'error',
                'لا توجد عملية دفع مرتبطة بهذا الحجز.'
            );
        }


        if (!$payment->receipt_file) {

            return back()->with(
                'error',
                'لا يوجد إثبات دفع مرفوع لهذا الحجز.'
            );
        }


        DB::transaction(
            function () use (
                $booking,
                $payment,
                $validated
            ) {

                $payment->update([

                    'status' =>
                        'rejected',

                    'reviewed_by' =>
                        Auth::id(),

                    'reviewed_at' =>
                        now(),

                    'rejection_reason' =>
                        $validated['rejection_reason'],

                    'paid_at' =>
                        null,

                ]);


                $booking->update([

                    'payment_status' =>
                        'failed',

                    'paid_at' =>
                        null,

                ]);

            }
        );


        /*
        |--------------------------------------------------------------------------
        | NOTIFY STUDENT
        |--------------------------------------------------------------------------
        */

        $this->notifyStudent(
            $booking,
            'payment_receipt_rejected',
            'تم رفض إثبات الدفع',
            'تم رفض إثبات الدفع المرفوع. السبب: '
                . $validated['rejection_reason'],
            '×',
            'red',
            null,
            [
                'payment_status' =>
                    'failed',

                'rejection_reason' =>
                    $validated['rejection_reason'],
            ]
        );


        return back()->with(
            'success',
            'تم رفض إثبات الدفع وإبلاغ حالة الحجز.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PAYMENT - START REVIEW
    |--------------------------------------------------------------------------
    */

    public function reviewPayment(
        EducationBooking $booking
    ) {

        $payment =
            $booking->payment;


        if (!$payment) {

            return back()->with(
                'error',
                'لا توجد عملية دفع لهذا الحجز.'
            );
        }


        if (
            $payment->status !==
            'submitted'
        ) {

            return back()->with(
                'error',
                'عملية الدفع ليست في حالة تسمح ببدء المراجعة.'
            );
        }


        $payment->update([

            'status' =>
                'under_review',

        ]);


        $booking->update([

            'payment_status' =>
                'pending',

        ]);


        /*
        |--------------------------------------------------------------------------
        | NOTIFY STUDENT
        |--------------------------------------------------------------------------
        */

        $this->notifyStudent(
            $booking,
            'payment_review_started',
            'جاري مراجعة الدفع',
            'بدأت الإدارة مراجعة إثبات الدفع الخاص بحجزك.',
            '⏳',
            'gold',
            null,
            [
                'payment_status' =>
                    'pending',
            ]
        );


        return back()->with(
            'success',
            'تم نقل إثبات الدفع إلى حالة قيد المراجعة.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ADMIN NOTE
    |--------------------------------------------------------------------------
    */

    public function updateNote(
        Request $request,
        EducationBooking $booking
    ) {

        $validated = $request->validate([

            'admin_note' => [
                'nullable',
                'string',
                'max:5000',
            ],

        ]);


        $booking->update([

            'admin_note' =>
                $validated['admin_note']
                ?? null,

        ]);


        /*
        |--------------------------------------------------------------------------
        | NOTIFY STUDENT
        |--------------------------------------------------------------------------
        |
        | نرسل الإشعار فقط إذا كانت هناك ملاحظة فعلية.
        |
        */

        if (
            !empty(
                $validated['admin_note']
            )
        ) {

            $this->notifyStudent(
                $booking,
                'booking_admin_note',
                'لديك ملاحظة جديدة من الإدارة',
                'أضافت الإدارة ملاحظة جديدة مرتبطة بحجزك. يمكنك مراجعة تفاصيل الحجز من لوحة الطالب.',
                '📝',
                'gold',
                null,
                [
                    'has_admin_note' =>
                        true,
                ]
            );
        }


        return back()->with(
            'success',
            'تم حفظ ملاحظة الإدارة.'
        );
    }
}

