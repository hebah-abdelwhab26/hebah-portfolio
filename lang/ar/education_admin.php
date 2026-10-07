<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Education Admin Translations
    |--------------------------------------------------------------------------
    |
    | جميع ترجمات لوحة إدارة منصة التعليم.
    |
    */


    /*
    |--------------------------------------------------------------------------
    | Admin Authentication
    |--------------------------------------------------------------------------
    */

    'admin_auth' => [

        'page_title' =>
            'تسجيل دخول الإدارة | Hebah Education',

        'brand_name' =>
            'Hebah',

        'brand_subtitle' =>
            'القرآن الكريم واللغة العربية',

        'admin_panel' =>
            'لوحة الإدارة',

        'welcome' =>
            'مرحبًا بك',

        'description' =>
            'سجّل الدخول لإدارة قسم التعليم والحجوزات.',

        'email' =>
            'البريد الإلكتروني',

        'email_placeholder' =>
            'education@hebahgift.com',

        'password' =>
            'كلمة المرور',

        'password_placeholder' =>
            'أدخل كلمة المرور',

        'show_password' =>
            'إظهار كلمة المرور',

        'hide_password' =>
            'إخفاء كلمة المرور',

        'remember_me' =>
            'تذكرني',

        'login' =>
            'تسجيل الدخول',

        'back_to_education' =>
            'العودة إلى موقع التعليم',

        'all_rights_reserved' =>
            'جميع الحقوق محفوظة.',

    ],

      /*
    |--------------------------------------------------------------------------
    | Availabilities
    |--------------------------------------------------------------------------
    */

    'availabilities' => [

        'page_title' =>
            'الأوقات المتاحة',

        'eyebrow' =>
            'إدارة المواعيد',

        'title' =>
            'الأوقات المتاحة',

        'description' =>
            'إدارة أوقات الحجز المتاحة للطلاب خلال أيام الأسبوع.',

        'add_time' =>
            'إضافة وقت متاح',

        'total_times' =>
            'إجمالي الأوقات',

        'active_times' =>
            'الأوقات النشطة',

        'inactive_times' =>
            'غير النشطة',

        'week_days' =>
            'أيام الأسبوع',

        'schedule_title' =>
            'جدول الأوقات',

        'schedule_description' =>
            'جميع الفترات الزمنية التي يمكن للطالب اختيارها عند الحجز.',

        'day' =>
            'اليوم',

        'time' =>
            'الوقت',

        'description_label' =>
            'الوصف',

        'sort_order' =>
            'الترتيب',

        'status' =>
            'الحالة',

        'actions' =>
            'الإجراءات',

        'day_number' =>
            'اليوم :day',

        'duration_minutes' =>
            ':minutes دقيقة',

        'no_description' =>
            'بدون وصف',

        'available' =>
            'متاح',

        'unavailable' =>
            'غير متاح',

        'delete_confirmation' =>
            'هل أنت متأكد من حذف هذا الوقت المتاح؟',

        'empty_title' =>
            'لا توجد أوقات متاحة',

        'empty_description' =>
            'لم تتم إضافة أي أوقات للحجز حتى الآن.',

        'add_first_time' =>
            'إضافة أول وقت',

    ],

    /*
    |--------------------------------------------------------------------------
    | Common Admin Actions
    |--------------------------------------------------------------------------
    */

    'common' => [

        'operation_success' =>
            'تمت العملية بنجاح',

        'operation_failed' =>
            'تعذر تنفيذ العملية',

        'view' =>
            'عرض',

        'edit' =>
            'تعديل',

        'delete' =>
            'حذف',

    ],

    /*
|--------------------------------------------------------------------------
| Availabilities - Create
|--------------------------------------------------------------------------
*/

'availabilities_create' => [

    'page_title' =>
        'إضافة وقت متاح',

    'eyebrow' =>
        'إدارة المواعيد',

    'title' =>
        'إضافة وقت متاح',

    'description' =>
        'أضف فترة زمنية جديدة يمكن للطلاب اختيارها عند الحجز.',

    'back_to_availabilities' =>
        'العودة للأوقات المتاحة',

    'review_data' =>
        'يرجى مراجعة البيانات',

    'form_title' =>
        'بيانات الموعد',

    'form_description' =>
        'حدد اليوم والفترة الزمنية التي ستكون متاحة للحجز.',

    'day' =>
        'اليوم',

    'select_day' =>
        'اختر اليوم',

    'days' => [
        0 => 'الأحد',
        1 => 'الاثنين',
        2 => 'الثلاثاء',
        3 => 'الأربعاء',
        4 => 'الخميس',
        5 => 'الجمعة',
        6 => 'السبت',
    ],

    'start_time' =>
        'وقت البداية',

    'end_time' =>
        'وقت النهاية',

    'label' =>
        'وصف الموعد',

    'optional' =>
        'اختياري',

    'label_placeholder' =>
        'مثال: الحصة المسائية',

    'sort_order' =>
        'ترتيب الظهور',

    'sort_order_hint' =>
        'الرقم الأصغر يظهر أولًا ضمن أوقات اليوم.',

    'status_title' =>
        'حالة الموعد',

    'status_description' =>
        'عند التفعيل سيظهر هذا الوقت ضمن الأوقات المتاحة للطلاب.',

    'available' =>
        'متاح',

    'cancel' =>
        'إلغاء',

    'save' =>
        'حفظ الوقت',

    'note_title' =>
        'ملاحظة',

    'note_description' =>
        'يمكنك إضافة أكثر من فترة زمنية في نفس اليوم. على سبيل المثال يمكن إضافة موعد صباحي وموعد مسائي في يوم الاثنين. كما يمكنك إيقاف أي موعد مؤقتًا دون حذفه.',

],

/*
|--------------------------------------------------------------------------
| Availability - Show
|--------------------------------------------------------------------------
*/

'availability_show' => [

    'page_title' =>
        'تفاصيل الوقت المتاح',

    'title' =>
        'تفاصيل الوقت المتاح',

    'description' =>
        'عرض تفاصيل الموعد وإدارته.',

    'back' =>
        'العودة',

    'edit' =>
        'تعديل',

    'appointment_information' =>
        'معلومات الموعد',

    'active' =>
        'نشط',

    'inactive' =>
        'غير نشط',

    'day' =>
        'اليوم',

    'display_order' =>
        'ترتيب العرض',

    'status' =>
        'الحالة',

    'available_for_booking' =>
        'متاح للحجز',

    'stopped' =>
        'متوقف',

    'appointment_description' =>
        'وصف الموعد',

    'note' =>
        'الملاحظة',

    'system_information' =>
        'معلومات النظام',

    'appointment_number' =>
        'رقم الموعد',

    'created_at' =>
        'تاريخ الإنشاء',

    'updated_at' =>
        'آخر تحديث',

    'day_numeric' =>
        'اليوم رقميًا',

    'danger_zone' =>
        'منطقة الخطر',

    'delete_description' =>
        'حذف هذا الوقت سيؤدي إلى إزالته من قائمة الأوقات المتاحة للإدارة والحجز. تأكدي من عدم الحاجة إليه قبل الحذف.',

    'delete_confirmation' =>
        'هل أنت متأكد من حذف هذا الوقت المتاح؟',

    'delete_time' =>
        'حذف الوقت',

    'no_value' =>
        '—',

],

/*
|--------------------------------------------------------------------------
| Availability - Edit
|--------------------------------------------------------------------------
*/

'availability_edit' => [

    'page_title' =>
        'تعديل الوقت المتاح',

    'title' =>
        'تعديل الوقت المتاح',

    'description' =>
        'تعديل بيانات الموعد رقم #:id.',

    'back' =>
        'العودة',

    'view' =>
        'عرض',

    'review_data' =>
        'يرجى مراجعة البيانات التالية:',

    'form_title' =>
        'بيانات الوقت المتاح',

    'form_description' =>
        'يمكنك تعديل اليوم والوقت والحالة وترتيب العرض.',

    'day' =>
        'اليوم',

    'select_day' =>
        'اختر اليوم',

    'days' => [
        0 => 'الأحد',
        1 => 'الاثنين',
        2 => 'الثلاثاء',
        3 => 'الأربعاء',
        4 => 'الخميس',
        5 => 'الجمعة',
        6 => 'السبت',
    ],

    'display_order' =>
        'ترتيب العرض',

    'display_order_placeholder' =>
        'مثال: 1',

    'display_order_help' =>
        'يستخدم لتحديد ترتيب ظهور الأوقات في لوحة الإدارة وصفحة الحجز.',

    'appointment_time' =>
        'وقت الموعد',

    'time_help' =>
        'يجب أن يكون وقت الانتهاء بعد وقت البداية.',

    'label' =>
        'وصف الموعد',

    'label_placeholder' =>
        'مثال: موعد مسائي مناسب للطلاب',

    'label_help' =>
        'وصف اختياري يظهر للإدارة ويمكن استخدامه لاحقًا في صفحة الحجز.',

    'activate_time' =>
        'تفعيل هذا الوقت',

    'activate_description' =>
        'عند التفعيل يمكن استخدام هذا الوقت ضمن الأوقات المتاحة للحجز.',

    'current_active' =>
        'الموعد نشط حاليًا',

    'current_inactive' =>
        'الموعد غير نشط حاليًا',

    'cancel' =>
        'إلغاء',

    'save_changes' =>
        'حفظ التعديلات',

],

'booking_types' => [

    'page_title' => 'أنواع الحجز',
    'title' => 'أنواع الحجز',
    'description' => 'إدارة الحصص الفردية والباقات التعليمية والأسعار وعدد الجلسات.',
    'add_booking_type' => 'إضافة نوع حجز',

    'table' => [
        'id' => '#',
        'name' => 'نوع الحجز',
        'category' => 'التصنيف',
        'price' => 'السعر',
        'sessions' => 'الجلسات',
        'duration' => 'المدة',
        'status' => 'الحالة',
        'sort_order' => 'الترتيب',
        'actions' => 'الإجراءات',
    ],

    'category' => [
        'package' => 'باقة',
        'single' => 'حصة واحدة',
    ],

    'duration_minutes' => ':minutes دقيقة',

    'status' => [
        'active' => 'نشط',
        'inactive' => 'غير نشط',
    ],

    'actions' => [
        'view_details' => 'عرض التفاصيل',
        'edit' => 'تعديل',
        'delete' => 'حذف',
    ],

    'delete_confirmation' => 'هل أنت متأكد من حذف نوع الحجز هذا؟',

    'empty' => [
        'title' => 'لا توجد أنواع حجز',
        'description' => 'لم يتم إنشاء أي نوع حجز حتى الآن.',
        'add_first' => 'إضافة أول نوع حجز',
    ],
],

'booking_types_create' => [

    'page_title' => 'إضافة نوع حجز جديد',

    'header' => [
        'title' => 'إضافة نوع حجز جديد',
        'description' => 'إنشاء حصة أو باقة تعليمية جديدة يمكن للطلاب حجزها.',
        'back' => 'العودة إلى أنواع الحجز',
    ],

    'validation' => [
        'review' => 'يرجى مراجعة البيانات التالية:',
    ],

    'basic_information' => [
        'title' => 'المعلومات الأساسية',
        'description' => 'المعلومات التي ستظهر للطالب عند اختيار نوع الحجز.',
    ],

    'fields' => [
        'name' => 'اسم نوع الحجز',
        'slug' => 'الرابط المختصر',
        'icon' => 'الأيقونة',
        'currency' => 'العملة',
        'description' => 'الوصف',
        'price' => 'السعر',
        'total_sessions' => 'عدد الجلسات',
        'session_duration' => 'مدة الجلسة',
        'sort_order' => 'ترتيب الظهور',
    ],

    'required' => '*',

    'optional' => '(اختياري)',

    'placeholders' => [
        'name' => 'مثال: حصة قرآن فردية',
        'slug' => 'مثال: quran-private',
        'icon' => 'fa-solid fa-book-quran',
        'currency' => 'SAR',
        'description' => 'اكتب وصفًا مختصرًا لنوع الحجز أو الباقة...',
        'price' => '0.00',
        'session_duration' => '60',
    ],

    'help' => [
        'slug' => 'إذا تركته فارغًا سيتم إنشاؤه تلقائيًا من اسم الحجز.',
        'icon' => 'يمكنك استخدام أيقونة من Font Awesome.',
        'currency' => 'رمز العملة المكون من 3 أحرف، مثل SAR.',
        'total_sessions' => 'جلسة واحدة تعني حصة فردية، وأكثر من جلسة تعني باقة.',
        'sort_order' => 'الرقم الأصغر يظهر أولًا.',
    ],

    'price_sessions' => [
        'title' => 'السعر والجلسات',
        'description' => 'حدد السعر وعدد الجلسات ومدة كل جلسة.',
        'currency_unit' => 'ريال',
        'minutes_unit' => 'دقيقة',
    ],

    'status' => [
        'title' => 'حالة نوع الحجز',
        'description' => 'يمكنك تحديد ما إذا كان نوع الحجز متاحًا للطلاب.',
        'active' => 'نوع الحجز نشط',
        'active_description' => 'سيظهر للطلاب ويمكنهم اختياره عند إنشاء حجز جديد.',
    ],

    'actions' => [
        'cancel' => 'إلغاء',
        'save' => 'حفظ نوع الحجز',
    ],
],

'booking_type_show' => [

    'page_title' => 'تفاصيل نوع الحجز',
    'description' => 'تفاصيل نوع الحجز وإعداداته',

    'edit' => 'تعديل',
    'back_to_list' => 'العودة للقائمة',

    'basic_information' => 'المعلومات الأساسية',
    'booking_type_name' => 'اسم نوع الحجز',
    'slug' => 'الرابط المختصر',
    'price' => 'السعر',
    'total_sessions' => 'عدد الجلسات',
    'session_duration' => 'مدة الجلسة',
    'minutes' => 'دقيقة',
    'not_specified' => 'غير محددة',
    'sort_order' => 'ترتيب الظهور',

    'status' => 'الحالة',
    'active' => 'نشط',
    'inactive' => 'غير نشط',

    'description_title' => 'الوصف',
    'no_description' => 'لم تتم إضافة وصف لهذا النوع من الحجز.',

    'related_bookings_count' => 'عدد الحجوزات المرتبطة',

    'booking_type' => 'نوع الحجز',

    'can_delete_description' => 'يمكنك حذف نوع الحجز لأنه غير مرتبط بأي حجوزات حاليًا.',

    'cannot_delete_description' => 'لا يمكن حذف نوع الحجز لأنه مرتبط بحجوزات موجودة. يمكنك تعطيله بدلًا من حذفه.',

    'delete_confirmation' => 'هل أنت متأكد من حذف نوع الحجز هذا؟',

    'delete_booking_type' => 'حذف نوع الحجز',
],

'booking_type_edit' => [

    'page_title' => 'تعديل نوع الحجز',
    'title' => 'تعديل نوع الحجز',
    'description' => 'تعديل بيانات نوع الحجز:',
    'back_to_booking_types' => 'العودة إلى أنواع الحجز',

    'form_title' => 'بيانات نوع الحجز',
    'form_description' => 'قم بتعديل البيانات المطلوبة ثم احفظ التغييرات.',

    'booking_type_name' => 'اسم نوع الحجز',

    'slug' => 'الرابط المختصر',
    'slug_help' => 'يمكن تركه فارغًا وسيتم توليده تلقائيًا.',

    'description_label' => 'الوصف',
    'description_placeholder' => 'اكتب وصفًا مختصرًا لنوع الحجز...',

    'icon' => 'الأيقونة',
    'icon_help' => 'مثال:',
    'icon_example' => 'أيقونة Font Awesome:',

    'price' => 'السعر',
    'currency' => 'العملة',

    'total_sessions' => 'عدد الجلسات',
    'total_sessions_help' => '1 = حصة واحدة، أكثر من 1 = باقة.',

    'session_duration' => 'مدة الجلسة بالدقائق',

    'sort_order' => 'ترتيب الظهور',

    'status_title' => 'حالة نوع الحجز',
    'active_type' => 'نوع الحجز نشط',
    'active_type_description' => 'يسمح للطلاب باختياره عند إنشاء حجز جديد.',

    'save_changes' => 'حفظ التعديلات',
    'view_type' => 'عرض النوع',
    'cancel' => 'إلغاء',
],

'bookings' => [

    'page_title' => 'الحجوزات',
    'eyebrow' => 'إدارة التعليم',
    'title' => 'الحجوزات',
    'description' => 'إدارة ومتابعة جميع طلبات حجز الدروس.',

    'total_bookings' => 'إجمالي الحجوزات',
    'pending' => 'قيد الانتظار',
    'confirmed' => 'مؤكدة',
    'completed' => 'مكتملة',
    'cancelled' => 'ملغاة',

    'search' => 'البحث',
    'search_placeholder' => 'اسم الطالب أو البريد أو نوع الحجز...',
    'booking_status' => 'حالة الحجز',
    'all_statuses' => 'جميع الحالات',
    'no_show' => 'لم يحضر',

    'payment_status' => 'حالة الدفع',
    'unpaid' => 'غير مدفوع',
    'under_review' => 'قيد المراجعة',
    'paid' => 'مدفوع',
    'payment_failed' => 'فشل الدفع',
    'payment_failed_short' => 'فشل',
    'refunded' => 'مسترد',

    'date' => 'التاريخ',
    'search_button' => 'بحث',
    'reset' => 'إعادة ضبط',

    'booking_record' => 'سجل الحجوزات',
    'all_requests' => 'جميع الطلبات',
    'booking_count' => 'حجز',

    'student' => 'الطالب',
    'student_initial' => 'ط',
    'booking_type' => 'نوع الحجز',
    'time' => 'الوقت',
    'price' => 'السعر',
    'status' => 'الحالة',
    'payment' => 'الدفع',
    'actions' => 'الإجراءات',

    'package' => 'باقة',
    'single_lesson' => 'درس واحد',
    'sessions' => 'جلسات',

    'unknown_student' => 'طالب غير معروف',
    'educational_booking' => 'حجز تعليمي',

    'proof_uploaded' => 'إثبات مرفوع',
    'rejected' => 'مرفوض',
    'proof_approved' => 'إثبات مقبول',

    'details' => 'التفاصيل',
    'confirm_booking' => 'تأكيد الحجز',
    'cancel_booking' => 'إلغاء الحجز',

    'confirm_booking_question' => 'هل تريد تأكيد هذا الحجز؟',
    'cancel_booking_question' => 'هل تريد إلغاء هذا الحجز؟',

    'empty_title' => 'لا توجد حجوزات',
    'empty_description' => 'لا توجد حجوزات تطابق معايير البحث الحالية.',
    'show_all_bookings' => 'إعادة عرض جميع الحجوزات',

],

'bookings_show' => [

    'page_title' => 'تفاصيل الحجز',
    'eyebrow' => 'إدارة الحجوزات',
    'title' => 'تفاصيل الحجز',
    'description' => 'مراجعة بيانات الطالب والدرس والدفع وتحديث حالة الحجز.',
    'back_to_bookings' => 'العودة إلى الحجوزات',

    'booking' => 'الحجز',
    'booking_information' => 'معلومات الحجز',
    'booking_status' => 'حالة الحجز',
    'payment_status' => 'حالة الدفع',
    'booking_value' => 'قيمة الحجز',

    'status_pending' => 'قيد الانتظار',
    'status_confirmed' => 'مؤكد',
    'status_completed' => 'مكتمل',
    'status_cancelled' => 'ملغي',
    'status_no_show' => 'لم يحضر',

    'payment_unpaid' => 'غير مدفوع',
    'payment_pending' => 'قيد المراجعة',
    'payment_paid' => 'مدفوع',
    'payment_failed' => 'فشل الدفع',
    'payment_refunded' => 'مسترد',

    'student' => 'الطالب',
    'student_information' => 'بيانات الطالب',
    'student_initial' => 'ط',
    'unknown_student' => 'غير معروف',
    'send_email' => 'إرسال بريد',

    'booking_type' => 'نوع الحجز',
    'lesson_package_details' => 'تفاصيل الدرس والحزمة',
    'educational_booking' => 'حجز تعليمي',

    'total_sessions' => 'إجمالي الجلسات',
    'completed_sessions' => 'الجلسات المكتملة',
    'remaining_sessions' => 'الجلسات المتبقية',

    'appointment' => 'الموعد',
    'lesson_date_time' => 'تاريخ ووقت الدرس',
    'date' => 'التاريخ',
    'time' => 'الوقت',

    'student_note' => 'ملاحظة الطالب',
    'booking_notes' => 'ملاحظات الحجز',

    'administration' => 'الإدارة',
    'admin_note' => 'ملاحظة الإدارة',
    'admin_note_placeholder' => 'أضف ملاحظة خاصة بالإدارة...',
    'save_note' => 'حفظ الملاحظة',

    'booking_management' => 'إدارة الحجز',
    'lesson_status' => 'حالة الدرس',

    'confirm_booking' => 'تأكيد الحجز',
    'confirm_booking_question' => 'هل تريد تأكيد هذا الحجز؟',

    'mark_completed' => 'تسجيل الدرس كمكتمل',
    'complete_booking_question' => 'هل تريد تسجيل هذا الدرس كمكتمل؟',

    'mark_no_show' => 'تسجيل عدم الحضور',
    'no_show_question' => 'هل تريد تسجيل الطالب كغير حاضر؟',

    'cancel_booking' => 'إلغاء الحجز',
    'cancel_booking_question' => 'هل تريد إلغاء هذا الحجز؟',

    'payment' => 'الدفع',
    'payment_information' => 'معلومات الدفع',
    'status' => 'الحالة',
    'method' => 'الطريقة',
    'not_registered' => 'غير مسجلة',
    'reference_number' => 'رقم المرجع',
    'payment_date' => 'تاريخ الدفع',

    'payment_proof' => 'إثبات الدفع',
    'student_receipt' => 'إيصال الطالب',
    'file' => 'الملف',
    'receipt_submitted' => 'تم الإرسال',
    'payment_under_review' => 'قيد المراجعة',
    'receipt_approved' => 'معتمد',
    'receipt_rejected' => 'مرفوض',
    'view_payment_proof' => 'عرض إثبات الدفع',

    'start_review' => 'بدء المراجعة',
    'approve_payment' => 'اعتماد الدفع',
    'approve_payment_question' => 'هل تريد اعتماد إثبات الدفع؟',
    'reject_payment_proof' => 'رفض إثبات الدفع',

    'payment_method' => 'طريقة الدفع',
    'bank_transfer' => 'تحويل بنكي',
    'payment_method_placeholder' => 'مثال: تحويل بنكي',

    'transaction_reference' => 'رقم العملية / المرجع',
    'reference_placeholder' => 'رقم الحوالة أو المرجع',

    'payment_note' => 'ملاحظة الدفع',
    'payment_note_placeholder' => 'ملاحظة خاصة بعملية الدفع...',

    'confirm_payment_received' => 'تأكيد استلام الدفع',
    'confirm_payment_received_question' => 'هل تريد تسجيل الدفع كمدفوع؟',

    'set_payment_pending' => 'وضع الدفع قيد المراجعة',
    'set_payment_unpaid' => 'إعادة إلى غير مدفوع',

    'mark_payment_failed' => 'تسجيل فشل الدفع',
    'mark_payment_failed_question' => 'هل تريد تسجيل عملية الدفع كفاشلة؟',

    'refund_payment' => 'تسجيل استرداد المبلغ',
    'refund_payment_question' => 'هل تريد تسجيل مبلغ الحجز كمسترد؟',

    'financial_information' => 'المعلومات المالية',
    'payment_summary' => 'ملخص الدفع',
    'booking_price' => 'سعر الحجز',
    'reference' => 'المرجع',
    'received_at' => 'تاريخ الاستلام',

    'additional_information' => 'معلومات إضافية',
    'booking_data' => 'بيانات الحجز',
    'booking_number' => 'رقم الحجز',
    'created_at' => 'تاريخ الإنشاء',
    'updated_at' => 'آخر تحديث',
    'reminder' => 'التذكير',
    'reminder_sent' => 'تم الإرسال',
    'reminder_not_sent' => 'لم يتم الإرسال',

    'back_to_all_bookings' => 'العودة إلى جميع الحجوزات',

    'rejection_reason_prompt' => 'يرجى كتابة سبب رفض إثبات الدفع:',
    'rejection_reason_required' => 'يجب كتابة سبب رفض إثبات الدفع.',

],

'comments' => [
    'page_title' => 'التعليقات',
    'title' => 'التعليقات',
    'description' => 'إدارة التعليقات العامة المنشورة من زوار الموقع.',

    'total_comments' => 'إجمالي التعليقات',
    'pending_review' => 'بانتظار المراجعة',
    'published' => 'منشورة',
    'rejected' => 'مرفوضة',

    'search' => 'بحث',
    'search_placeholder' => 'ابحث بالاسم أو البريد أو نص التعليق',
    'status' => 'الحالة',
    'all_statuses' => 'جميع الحالات',
    'filter' => 'تصفية',

    'comment_author' => 'صاحب التعليق',
    'comment' => 'التعليق',
    'date' => 'التاريخ',
    'actions' => 'الإجراءات',

    'publish' => 'نشر',
    'reject' => 'رفض',
    'edit' => 'تعديل',
    'delete' => 'حذف',

    'delete_confirmation' => 'هل أنت متأكد من حذف هذا التعليق؟',

    'empty' => 'لا توجد تعليقات مطابقة للبحث.',

        'edit_page_title' => 'تعديل التعليق',
'edit_page_description' => 'يمكنك تعديل بيانات التعليق وحالته قبل نشره.',
'name' => 'الاسم',
'email' => 'البريد الإلكتروني',
'comment_status' => 'حالة التعليق',
'save_changes' => 'حفظ التعديلات',
'back_to_comments' => 'العودة للتعليقات',
],

'contact_messages' => [
    'page_title' => 'رسائل التواصل',
    'title' => 'رسائل التواصل',
    'description' => 'إدارة ومتابعة الرسائل الواردة من زوار الموقع والطلاب',

    'total_messages' => 'إجمالي الرسائل',
    'new_messages' => 'رسائل جديدة',
    'read_messages' => 'رسائل مقروءة',
    'replied_messages' => 'تم الرد عليها',

    'inbox' => 'صندوق الرسائل',
    'latest_messages' => 'أحدث الرسائل الواردة',
    'message_count' => 'رسالة',

    'sender' => 'المرسل',
    'email' => 'البريد الإلكتروني',
    'subject' => 'الموضوع',
    'status' => 'الحالة',
    'date' => 'التاريخ',
    'actions' => 'الإجراءات',

    'new' => 'جديدة',
    'status_new' => 'جديدة',
    'status_read' => 'مقروءة',
    'status_replied' => 'تم الرد',

    'view_message' => 'عرض الرسالة',
    'delete_message' => 'حذف الرسالة',
    'delete_confirmation' => 'هل أنت متأكد من حذف هذه الرسالة؟',

    'empty_title' => 'لا توجد رسائل حتى الآن',
    'empty_description' => 'ستظهر رسائل التواصل هنا عند استقبالها.',

    'close' => 'إغلاق',
],

'contact_messages_show' => [
'page_title' => 'عرض رسالة التواصل',
'title' => 'عرض رسالة التواصل',
'description' => 'تفاصيل الرسالة ومعلومات المرسل',

'back' => 'العودة',
'delete' => 'حذف',
'delete_confirmation' => 'هل أنت متأكد من حذف هذه الرسالة؟',
'close' => 'إغلاق',

'sender_data' => 'بيانات المرسل',
'sender_role' => 'صاحب الرسالة',

'email' => 'البريد الإلكتروني',
'subject' => 'الموضوع',
'sent_at' => 'تاريخ الإرسال',
'message_status' => 'حالة الرسالة',

'status_new' => 'جديدة',
'status_read' => 'مقروءة',
'status_replied' => 'تم الرد',

'read_at' => 'تمت القراءة',
'replied_at' => 'تم الرد',

'message_actions' => 'إجراءات الرسالة',
'mark_replied' => 'تحديد كـ "تم الرد"',
'reopen' => 'إعادة فتح الرسالة',
'reply_by_email' => 'الرد عبر البريد الإلكتروني',

'message_content' => 'محتوى الرسالة',
'message_subject' => 'موضوع الرسالة',
'message_text' => 'نص الرسالة',
'reply_to' => 'الرد على',

],

'conversations' => [
'page_title' => 'المحادثات',
'education_management' => 'إدارة التعليم',
'title' => 'المحادثات',
'description' => 'إدارة ومتابعة المحادثات الواردة من طلاب التعليم.',

'start_new' => 'بدء محادثة جديدة',
'total_conversations' => 'إجمالي المحادثات',
'all_conversations' => 'جميع المحادثات',

'subject' => 'الموضوع',
'student' => 'الطالب',
'last_message' => 'آخر رسالة',
'status' => 'الحالة',
'last_update' => 'آخر تحديث',
'actions' => 'الإجراءات',

'untitled_conversation' => 'محادثة بدون عنوان',
'unknown_student' => 'طالب غير معروف',

'attachment' => 'مرفق',
'message' => 'رسالة',
'no_messages' => 'لا توجد رسائل',

'open' => 'مفتوحة',
'closed' => 'مغلقة',

'view' => 'عرض',
'delete' => 'حذف',
'delete_confirmation' => 'هل أنت متأكد من حذف هذه المحادثة؟ سيتم حذف جميع الرسائل والمرفقات المرتبطة بها نهائيًا ولا يمكن التراجع عن هذا الإجراء.',

'empty_title' => 'لا توجد محادثات حتى الآن',
'empty_description' => 'يمكنك بدء محادثة جديدة مع أحد طلاب التعليم.',

],

'conversations_create' => [
'page_title' => 'بدء محادثة جديدة',
'education_management' => 'إدارة التعليم',
'title' => 'بدء محادثة جديدة',
'description' => 'ابدأ محادثة مباشرة مع أحد طلاب التعليم وأرسل له الرسالة الأولى.',
'back_to_conversations' => 'العودة إلى المحادثات',

'review_data' => 'يرجى مراجعة البيانات التالية:',

'conversation_data' => 'بيانات المحادثة',
'conversation_data_description' => 'اختر الطالب ثم اكتب الرسالة الأولى التي ستظهر له داخل المحادثة.',

'student' => 'الطالب',
'select_student' => 'اختر الطالب',
'no_active_students' => 'لا يوجد طلاب نشطون حاليًا',
'student_help' => 'سيتم إنشاء المحادثة وربطها بهذا الطالب.',

'first_message' => 'الرسالة الأولى',
'message_text' => 'نص الرسالة',
'message_placeholder' => 'اكتب الرسالة التي تريد إرسالها للطالب...',
'message_help' => 'الحد الأقصى للرسالة 5000 حرف.',

'start_and_send' => 'بدء المحادثة وإرسال الرسالة',
'cancel' => 'إلغاء',

],

'conversations_show' => [
'page_title' => 'المحادثة',

'back_to_conversations' => 'العودة إلى المحادثات',
'educational_conversation' => 'محادثة تعليمية',
'untitled_conversation' => 'محادثة بدون عنوان',
'conversation_id' => 'المحادثة #:id',

'reopen_conversation' => 'إعادة فتح المحادثة',
'close_conversation' => 'إغلاق المحادثة',
'close_confirmation' => 'هل أنت متأكد من إغلاق هذه المحادثة؟',

'messages' => 'الرسائل',
'view_attachment' => 'عرض المرفق',
'admin' => 'الإدارة',
'student' => 'الطالب',
'read' => 'تمت القراءة',
'no_messages' => 'لا توجد رسائل في هذه المحادثة حتى الآن.',

'send_reply' => 'إرسال رد',
'reply_placeholder' => 'اكتب ردك على الطالب هنا...',
'send_message' => 'إرسال الرسالة',

'closed_notice' => 'هذه المحادثة مغلقة حاليًا. أعد فتح المحادثة حتى تتمكن من إرسال رسائل جديدة.',

'conversation_information' => 'معلومات المحادثة',
'unknown_student' => 'طالب غير معروف',

'status' => 'الحالة',
'closed' => 'مغلقة',
'open' => 'مفتوحة',

'created_at' => 'تاريخ إنشاء المحادثة',
'last_message' => 'آخر رسالة',
'none' => 'لا توجد',
'message_count' => 'عدد الرسائل',

],

'header' => [
    'open_menu' => 'فتح القائمة',
    'education_panel' => 'لوحة التعليم',
    'dashboard' => 'لوحة التحكم',
    'visit_website' => 'زيارة الموقع',
    'notifications' => 'الإشعارات',
    'latest_notifications' => 'آخر التنبيهات',
    'mark_all_read' => 'قراءة الكل',
    'loading_notifications' => 'جاري تحميل الإشعارات...',
    'view_all_notifications' => 'عرض جميع الإشعارات',
    'no_notifications' => 'لا توجد إشعارات حاليًا',
    'profile' => 'الصفحة الشخصية',
    'profile_description' => 'إدارة بيانات حسابك',
    'notifications_description' => 'عرض آخر الإشعارات',
    'website_description' => 'فتح الموقع التعليمي',
    'education_admin' => 'مدير التعليم',
    'logout' => 'تسجيل الخروج',
    'logout_description' => 'الخروج من لوحة التعليم',
    'language' => 'English',
],


'sidebar' => [

    'education_panel' => 'لوحة التعليم',
    'close_menu' => 'إغلاق القائمة',

    'education_manager' => 'مدير التعليم',

    'main' => 'الرئيسية',
    'dashboard' => 'لوحة التحكم',

    'education_management' => 'إدارة التعليم',
    'bookings' => 'الحجوزات',
    'booking_types' => 'أنواع الحجز والباقات',
    'students' => 'الطلاب',
    'teachers' => 'المعلمون',
    'lessons' => 'الدروس',
    'lesson_assignments' => 'إسناد الدروس',
    'student_lessons' => 'دروس الطلاب',
    'availabilities' => 'المواعيد المتاحة',

    'quizzes_assessments' => 'الاختبارات والتقييم',
    'quizzes' => 'الاختبارات',
    'quiz_attempts' => 'محاولات الطلاب',

    'financial_management' => 'الإدارة المالية',
    'payments' => 'المدفوعات',
    'financial_reports' => 'التقارير المالية',

    'communication' => 'التواصل',
    'contact_messages' => 'رسائل التواصل',
    'conversations' => 'المحادثات',
    'comments' => 'التعليقات',
    'notifications' => 'الإشعارات',

    'content' => 'المحتوى',
    'news' => 'الأخبار والإعلانات',
    'lesson_categories' => 'تصنيفات الدروس',
    'faq' => 'الأسئلة الشائعة',
    'reviews' => 'التقييمات',

    'system' => 'النظام',
    'education_settings' => 'إعدادات التعليم',
    'admin_account' => 'حساب الإدارة',

    'language' => 'اللغة',
    'switch_language' => 'تغيير اللغة',
    'visit_website' => 'زيارة الموقع',
    'logout' => 'تسجيل الخروج',

],



'dashboard' => [

    'title' => 'لوحة التحكم',

    'admin_panel' => 'لوحة الإدارة',

    'welcome' => 'مرحبًا بك في لوحة التحكم',

    'description' => 'إدارة الطلاب والدروس والباقات والحجوزات والمواعيد من مكان واحد.',

    'today' => 'اليوم',

    'status' => [
        'pending' => 'قيد المراجعة',
        'confirmed' => 'مؤكد',
        'completed' => 'مكتمل',
        'cancelled' => 'ملغي',
        'no_show' => 'لم يحضر',
    ],

    'students' => 'الطلاب',
    'total_students' => 'إجمالي الطلاب',

    'bookings' => 'الحجوزات',
    'total_bookings' => 'إجمالي الحجوزات',

    'review' => 'المراجعة',
    'pending_bookings' => 'حجوزات قيد المراجعة',

    'student_lessons' => 'دروس الطلاب',
    'active_lessons' => 'الدروس النشطة',

    'recent_bookings' => 'آخر الحجوزات',
    'view_all' => 'عرض الكل',

    'student' => 'طالب',
    'educational_booking' => 'حجز تعليمي',

    'no_bookings' => 'لا توجد حجوزات بعد',
    'new_bookings_here' => 'ستظهر الحجوزات الجديدة هنا.',

    'shortcuts' => 'اختصارات',
    'quick_actions' => 'إجراءات سريعة',

    'manage_bookings' => 'إدارة الحجوزات',
    'manage_bookings_description' => 'عرض ومتابعة جميع الحجوزات والباقات',

    'manage_student_lessons' => 'إدارة الدروس المسندة لكل طالب وباقة',
    'manage_student_lessons_description' => 'إدارة الدروس المسندة لكل طالب وباقة',

    'education_website' => 'الموقع التعليمي',
    'open_website' => 'فتح الموقع في نافذة جديدة',

    'appointments' => 'المواعيد',
    'upcoming_bookings' => 'الحجوزات القادمة',
    'appointments_count' => 'مواعيد',

    'no_upcoming_bookings' => 'لا توجد حجوزات قادمة',
    'upcoming_bookings_here' => 'ستظهر المواعيد القادمة هنا بعد إنشاء الحجوزات.',

],
'lesson_assignments' => [

    'page_title' => 'إسنادات الدروس',

    'breadcrumb_management' => 'إدارة التعليم',

    'breadcrumb_assignments' => 'إسنادات الدروس',

    'title' => 'إسنادات الدروس',

    'description' => 'إدارة الدروس المسندة للطلاب ومتابعة الحصص الخاصة بهم.',

    'assign_lesson' => 'إسناد درس',

    'statistics' => [

        'total' => 'إجمالي الإسنادات',

        'assigned' => 'مسندة',

        'in_progress' => 'قيد التنفيذ',

        'completed' => 'مكتملة',

    ],

    'filters' => [

        'search_placeholder' => 'ابحث باسم الطالب أو عنوان الحصة...',

        'all_statuses' => 'جميع الحالات',

        'assigned' => 'مسندة',

        'in_progress' => 'قيد التنفيذ',

        'completed' => 'مكتملة',

        'search' => 'بحث',

        'reset' => 'إعادة ضبط',

    ],

    'table' => [

        'title' => 'قائمة الإسنادات',

        'description' => 'جميع الدروس المسندة للطلاب.',

        'results' => 'نتيجة',

        'student' => 'الطالب',

        'lesson' => 'الحصة',

        'booking' => 'الحجز',

        'status' => 'الحالة',

        'assigned_at' => 'تاريخ الإسناد',

        'student_lesson' => 'الحصة الخاصة',

        'actions' => 'الإجراءات',

    ],

    'student' => [

        'unknown' => 'غير محدد',

    ],

    'lesson' => [

        'untitled' => 'بدون عنوان',

        'not_created' => 'لم تُنشأ الحصة الخاصة',

        'pending_creation' => 'الإسناد موجود بانتظار إنشاء الحصة الخاصة.',

    ],

    'booking' => [

        'without_booking' => 'بدون حجز',

    ],

    'status' => [

        'assigned' => 'مسندة',

        'in_progress' => 'قيد التنفيذ',

        'completed' => 'مكتملة',

        'unknown' => 'غير محددة',

    ],

    'student_lesson_status' => [

        'assigned' => 'مسندة',

        'in_progress' => 'قيد الدراسة',

        'completed' => 'مكتملة',

        'cancelled' => 'ملغاة',

        'not_created' => 'لم تنشأ',

        'unknown' => 'غير محددة',

    ],

    'actions' => [

        'view_assignment' => 'عرض الإسناد',

        'create_student_lesson' => 'إنشاء الحصة الخاصة',

        'view_student_lesson' => 'عرض الحصة الخاصة',

    ],

    'empty' => [

        'title' => 'لا توجد إسنادات',

        'description' => 'لم يتم إسناد أي درس للطلاب حتى الآن.',

        'assign_new' => 'إسناد درس جديد',

    ],


    // =========================================================
    // CREATE
    // =========================================================

    'create' => [

        'page_title' => 'إسناد دروس للطالب',

        'breadcrumb_assignments' => 'إسناد الدروس',

        'breadcrumb_new' => 'إسناد دروس جديدة',

        'title' => 'إسناد دروس للطالب',

        'description' => 'اختر الطالب والحجز المدفوع، ثم أضف عناوين الدروس التي تريد إسنادها له.',

        'validation_title' => 'يرجى مراجعة البيانات التالية:',


        // -----------------------------------------------------
        // بيانات الإسناد
        // -----------------------------------------------------

        'card_title' => 'بيانات الإسناد',

        'card_description' => 'أنشئ دروسًا خاصة بهذا الطالب مرتبطة بالحجز المحدد.',


        // -----------------------------------------------------
        // الطالب
        // -----------------------------------------------------

        'student' => [

            'label' => 'الطالب',

            'help' => 'اختر الطالب لعرض حجوزاته المدفوعة فقط.',

            'placeholder' => 'اختر الطالب',

        ],


        // -----------------------------------------------------
        // الحجز
        // -----------------------------------------------------

        'booking' => [

            'label' => 'الحجز / الباقة',

            'help' => 'لا تظهر هنا إلا الحجوزات التي تم تأكيد دفعها.',

            'placeholder' => 'اختر الحجز أو الباقة',

            'educational_booking' => 'حجز تعليمي',

            'package' => 'باقة',

            'remaining' => ':count متبقي',

            'single' => 'حصة فردية',

            'no_paid_bookings' => 'لا توجد حجوزات مدفوعة متاحة حاليًا.',

            'sessions_count' => 'عدد الجلسات: :total — المكتمل: :completed — المسند: :assigned',

            'single_booking' => 'حجز جلسة واحدة',

        ],


        // -----------------------------------------------------
        // الدروس
        // -----------------------------------------------------

        'lessons' => [

            'label' => 'عناوين الدروس',

            'help' => 'اكتب عنوان الدرس الذي يحتاجه الطالب. هذه الدروس خاصة بالطالب وليست مرتبطة بالدروس العامة في الموقع.',

            'placeholder' => 'مثال: أحكام النون الساكنة',

            'add' => 'إضافة الدرس',

            'notice_select' => 'اختر الطالب والحجز أولًا.',

            'notice_select_booking' => 'اختر الطالب والحجز أو الباقة أولًا.',

            'available' => 'الجلسات المتاحة',

            'remaining_zero' => 'لا توجد جلسات متاحة لإضافة درس جديد.',

            'remaining_after' => ':remaining جلسة متاحة — بعد الإضافة الحالية سيتبقى :available جلسة.',

            'remaining_available' => ':remaining جلسة متاحة لإضافة الدروس.',

            'selected_title' => 'الدروس المحددة',

            'selected_description' => 'كل عنوان هنا سيصبح درسًا مستقلًا خاصًا بالطالب.',

            'count_one' => ':count درس',

            'count_many' => ':count دروس',

            'empty_title' => 'لم تتم إضافة أي درس',

            'empty_description' => 'اكتب عنوان الدرس أعلاه ثم اضغط «إضافة الدرس».',

            'student_lesson_note' => 'درس خاص بالطالب — سيتم إضافة المحتوى إليه لاحقًا',

            'remove' => 'إزالة الدرس',

        ],


        // -----------------------------------------------------
        // الملاحظات
        // -----------------------------------------------------

        'notes' => [

            'label' => 'ملاحظات الإسناد',

            'optional' => 'اختياري',

            'placeholder' => 'أضف أي ملاحظات خاصة بهذا الإسناد...',

        ],


        // -----------------------------------------------------
        // الحالة
        // -----------------------------------------------------

        'active' => 'الدروس نشطة ويمكن للطالب الوصول إليها.',


        // -----------------------------------------------------
        // الإجراءات
        // -----------------------------------------------------

        'actions' => [

            'cancel' => 'إلغاء',

            'save' => 'إسناد الدروس',

            'saving' => 'جاري إسناد الدروس...',

        ],


        // -----------------------------------------------------
        // التنبيهات
        // -----------------------------------------------------

        'alerts' => [

            'select_student_first' => 'يرجى اختيار الطالب أولًا.',

            'select_booking_first' => 'يرجى اختيار الحجز أو الباقة أولًا.',

            'max_sessions' => 'لا يمكن إضافة المزيد من الدروس. لقد وصلت إلى عدد الجلسات المتاحة لهذا الحجز.',

            'duplicate_title' => 'هذا العنوان تمت إضافته بالفعل.',

            'select_student' => 'يرجى اختيار الطالب.',

            'select_booking' => 'يرجى اختيار الحجز أو الباقة.',

            'add_one' => 'يرجى إضافة درس واحد على الأقل.',

        ],

    ],


],
'lessons' => [

    'page_title' => 'الدروس',

    'header_label' => 'إدارة التعليم',

    'title' => 'الدروس',

    'description' => 'إدارة الدروس التعليمية ومتابعة حالتها ومعلوماتها.',

    'add_new' => 'إضافة درس جديد',

    'common' => [
        'close' => 'إغلاق',
    ],

    'alerts' => [
        'validation_title' => 'يرجى مراجعة المعلومات التالية:',
    ],

    'statistics' => [

        'total' => 'نتائج الصفحة',

        'all_lessons' => 'إجمالي الدروس',

        'all_lessons_help' => 'جميع الدروس المسجلة',

        'active' => 'الدروس النشطة',

        'active_help' => 'متاحة للطلاب',

        'inactive' => 'الدروس غير النشطة',

        'inactive_help' => 'غير متاحة حاليًا',

        'categories' => 'التصنيفات',

        'categories_help' => 'عدد التصنيفات المستخدمة',

    ],

    'filters' => [

        'search' => 'البحث',

        'search_placeholder' => 'ابحث عن عنوان الدرس...',

        'category' => 'التصنيف',

        'all_categories' => 'جميع التصنيفات',

        'status' => 'الحالة',

        'all_statuses' => 'جميع الحالات',

        'active' => 'نشط',

        'inactive' => 'غير نشط',

        'sort' => 'ترتيب النتائج',

        'newest' => 'الأحدث أولًا',

        'oldest' => 'الأقدم أولًا',

        'title_asc' => 'العنوان: أ - ي',

        'title_desc' => 'العنوان: ي - أ',

        'price_low' => 'السعر: من الأقل إلى الأعلى',

        'price_high' => 'السعر: من الأعلى إلى الأقل',

        'duration_short' => 'المدة: الأقصر أولًا',

        'duration_long' => 'المدة: الأطول أولًا',

        'apply' => 'تطبيق',

        'reset' => 'إعادة ضبط',

    ],

    'table' => [

        'list' => 'قائمة الدروس',
        'available' => 'عدد النتائج',

        'count' => 'العدد',

        'lesson_count' => 'درس',

        'lesson' => 'الدرس',

        'category' => 'التصنيف',

        'duration' => 'المدة',

        'price' => 'السعر',

        'status' => 'الحالة',

        'sort_order' => 'الترتيب',

        'actions' => 'الإجراءات',

        'lesson_count' => 'عدد الدروس',
    ],

    'category' => [

        'not_specified' => 'غير محدد',

    ],

    'duration' => [

        'minute' => 'دقيقة',

        'not_specified' => 'غير محددة',

    ],

    'price' => [

        'free' => 'مجاني',

    ],

    'status' => [

        'active' => 'نشط',

        'inactive' => 'غير نشط',

    ],

    'actions' => [

        'view' => 'عرض الدرس',

        'edit' => 'تعديل الدرس',

        'activate' => 'تفعيل الدرس',

        'deactivate' => 'تعطيل الدرس',

        'delete' => 'حذف الدرس',

        'confirm_delete' => 'هل أنت متأكد من رغبتك في حذف هذا الدرس؟',

    ],

    'empty' => [

        'title' => 'لا توجد دروس',

        'filtered' => 'لم يتم العثور على دروس تطابق معايير البحث الحالية.',

        'no_lessons' => 'لم تتم إضافة أي دروس حتى الآن.',

        'add_first' => 'إضافة أول درس',

        'show_all' => 'عرض جميع الدروس',

    ],

    'pagination' => [

        'showing' => 'عرض',

        'to' => 'إلى',

        'of' => 'من',

    ],


    // =========================================================
    // CREATE / GENERAL
    // =========================================================

    'create' => [

        'page_title' => 'إضافة درس جديد',

        'header_label' => 'إدارة الدروس',

        'title' => 'إضافة درس جديد',

        'description' => 'أضف درسًا جديدًا وحدد معلوماته وسعره ومدته وحالته ليظهر في الموقع العام.',

        'back' => 'العودة إلى الدروس',

        'validation_title' => 'يرجى مراجعة البيانات',

        'basic_information' => 'المعلومات الأساسية',

        'lesson_data' => 'بيانات الدرس',

        'title_label' => 'عنوان الدرس',

        'title_placeholder' => 'مثال: تعليم القراءة الصحيحة للقرآن الكريم',

        'category' => 'التصنيف',

        'category_placeholder' => 'مثال: القرآن الكريم',

        'duration' => 'مدة الدرس',

        'minute' => 'دقيقة',

        'description_label' => 'وصف الدرس',

        'description_placeholder' => 'اكتب وصفًا مختصرًا للدرس وما الذي سيتعلمه القارئ...',

        'price_settings' => 'السعر والإعدادات',

        'lesson_settings' => 'إعدادات الدرس',

        'price' => 'سعر الدرس',

        'riyal' => 'ريال',

        'currency' => 'العملة',

        'currencies' => [

            'sar' => 'SAR - ريال سعودي',

            'usd' => 'USD - دولار أمريكي',

            'eur' => 'EUR - يورو',

        ],

        'sort_order' => 'ترتيب العرض',

        'sort_order_help' => 'يستخدم لتحديد ترتيب ظهور الدرس في قائمة الدروس بالموقع.',

        'status' => 'حالة الدرس',

        'active_lesson' => 'درس نشط',

        'active_lesson_help' => 'يظهر في الموقع العام للزوار.',

        'note_title' => 'ملاحظة',

        'note_description' => 'يمكنك بعد إنشاء الدرس إضافة تفاصيله ومواده التعليمية مثل النصوص والصور وملفات PDF والروابط والتقييمات.',

        'cancel' => 'إلغاء',

        'save' => 'حفظ الدرس',

    ],


    // =========================================================
    // SHOW / LESSON DETAILS
    // =========================================================

    'show' => [

        'page_title' => 'تفاصيل الدرس',

        'header_label' => 'إدارة الدروس',

        'description' => 'عرض تفاصيل الدرس ومعلوماته ومحتواه التعليمي.',

        'actions' => [

            'content' => 'محتوى الدرس',

            'edit' => 'تعديل الدرس',

            'back' => 'العودة إلى الدروس',

            'activate' => 'تفعيل الدرس',

            'deactivate' => 'تعطيل الدرس',

            'delete' => 'حذف الدرس',

            'confirm_delete' => 'هل أنت متأكد من حذف هذا الدرس؟ لا يمكن التراجع عن هذه العملية.',

        ],

        'alerts' => [

            'success_title' => 'تمت العملية بنجاح',

            'error_title' => 'تعذر تنفيذ العملية',

        ],

        'status' => [

            'active' => 'الدرس نشط',

            'inactive' => 'الدرس غير نشط',

            'active_description' => 'الدرس ظاهر في الموقع العام ويمكن للزوار الاطلاع عليه.',

            'inactive_description' => 'الدرس غير ظاهر حاليًا في الموقع العام.',

        ],

        'statistics' => [

            'duration' => 'مدة الدرس',

            'minute' => 'دقيقة',

            'price' => 'سعر الدرس',

            'content' => 'محتوى الدرس',

            'manage' => 'إدارة',

            'sort_order' => 'ترتيب العرض',

        ],

        'description_section' => [

            'label' => 'نبذة عن الدرس',

            'title' => 'وصف الدرس',

            'empty' => 'لم تتم إضافة وصف لهذا الدرس بعد.',

        ],

        'content_section' => [

            'label' => 'مواد الدرس',

            'title' => 'محتوى الدرس',

            'manage_title' => 'إدارة محتويات الدرس',

            'manage_description' => 'أضف النصوص والصور والروابط والملفات الخاصة بهذا الدرس ورتبها بالطريقة التي تريد ظهورها بها في الموقع.',

            'open' => 'فتح محتوى الدرس',

        ],

        'public_section' => [

            'label' => 'الموقع العام',

            'title' => 'ظهور الدرس للزوار',

            'active_title' => 'الدرس متاح في الموقع العام',

            'inactive_title' => 'الدرس مخفي عن الموقع العام',

            'active_description' => 'يظهر هذا الدرس للزوار ويمكنهم الاطلاع على تفاصيله ومحتواه التعليمي.',

            'inactive_description' => 'هذا الدرس غير ظاهر للزوار حاليًا، مع الاحتفاظ ببياناته ومحتواه داخل لوحة التحكم.',

            'available_soon' => 'متاح قريبًا',

            'hidden' => 'الدرس مخفي',

        ],

        'information' => [

            'label' => 'معلومات الدرس',

            'title' => 'التفاصيل',

            'category' => 'التصنيف',

            'not_specified' => 'غير محدد',

            'duration' => 'المدة',

            'price' => 'السعر',

            'currency' => 'العملة',

            'slug' => 'الرابط التعريفي',

            'created_at' => 'تاريخ الإنشاء',

            'updated_at' => 'آخر تحديث',

        ],

        'quick_actions' => [

            'label' => 'إجراءات سريعة',

            'title' => 'إدارة الدرس',

            'content_description' => 'إضافة وإدارة النصوص والصور والروابط والملفات',

            'edit_description' => 'تعديل بيانات ومعلومات الدرس',

            'deactivate_description' => 'إخفاء الدرس عن الموقع العام',

            'activate_description' => 'إظهار الدرس في الموقع العام',

            'delete_description' => 'حذف الدرس نهائيًا',

        ],

        'note' => [

            'title' => 'ملاحظة',

            'description' => 'عند تفعيل الدرس سيظهر في قسم الدروس التعليمية في الموقع العام. وعند تعطيله سيتم إخفاؤه عن الزوار مع الاحتفاظ ببياناته ومحتواه داخل لوحة التحكم.',

        ],

    ],


    // =========================================================
    // EDIT / LESSON
    // =========================================================

    'edit' => [

        'page_title' => 'تعديل الدرس',

        'header_label' => 'إدارة الدروس',

        'title' => 'تعديل الدرس',

        'description' => 'قم بتعديل بيانات الدرس ومعلوماته وسعره ومدته وحالته.',

        'actions' => [

            'view' => 'عرض الدرس',

            'back' => 'العودة إلى الدروس',

            'cancel' => 'إلغاء',

            'save' => 'حفظ التعديلات',

        ],

        'alerts' => [

            'validation_title' => 'يرجى مراجعة البيانات',

        ],

        'summary' => [

            'current_lesson' => 'الدرس الحالي',

            'active' => 'نشط',

            'inactive' => 'غير نشط',

        ],

        'basic_information' => [

            'label' => 'المعلومات الأساسية',

            'title' => 'بيانات الدرس',

            'lesson_title' => 'عنوان الدرس',

            'title_placeholder' => 'مثال: تعليم القراءة الصحيحة للقرآن الكريم',

            'category' => 'التصنيف',

            'category_placeholder' => 'مثال: القرآن الكريم',

            'duration' => 'مدة الدرس',

            'minute' => 'دقيقة',

            'description' => 'وصف الدرس',

            'description_placeholder' => 'اكتب وصفًا مختصرًا للدرس وما الذي سيتعلمه الطالب...',

        ],

        'settings' => [

            'label' => 'السعر والإعدادات',

            'title' => 'إعدادات الدرس',

            'price' => 'سعر الدرس',

            'riyal' => 'ريال',

            'currency' => 'العملة',

            'currencies' => [

                'sar' => 'SAR - ريال سعودي',

                'usd' => 'USD - دولار أمريكي',

                'eur' => 'EUR - يورو',

            ],

            'sort_order' => 'ترتيب العرض',

            'sort_order_help' => 'يستخدم لتحديد ترتيب ظهور الدرس في قائمة الدروس.',

            'status' => 'حالة الدرس',

            'active_lesson' => 'درس نشط',

            'active_lesson_help' => 'يظهر في الموقع العام للزوار.',

        ],

        'information' => [

            'created_at' => 'تاريخ الإنشاء',

            'updated_at' => 'آخر تحديث',

            'content' => 'محتوى الدرس',

            'manage_content' => 'إدارة المحتوى',

            'slug' => 'الرابط المختصر',

        ],

        'note' => [

            'title' => 'ملاحظة',

            'description' => 'إذا قمت بتغيير عنوان الدرس فسيتم إنشاء Slug جديد تلقائيًا للحفاظ على الرابط بشكل صحيح.',

        ],

    ],


    // =========================================================
    // CONTENT / LESSON CONTENT
    // =========================================================

    'content' => [

        'page_title' => 'محتوى الدرس',

        'header_label' => 'إدارة محتوى الدرس',

        'subtitle' => 'محتوى الدرس',

        'description' => 'إدارة النصوص والصور والفيديوهات والروابط والملفات الخاصة بهذا الدرس.',

        'actions' => [

            'add' => 'إضافة محتوى',

            'back' => 'العودة إلى الدرس',

            'view' => 'عرض',

            'edit' => 'تعديل',

            'disable' => 'تعطيل',

            'activate' => 'تفعيل',

            'delete' => 'حذف',

            'confirm_delete' => 'هل أنت متأكد من حذف هذا المحتوى؟ لا يمكن التراجع عن هذه العملية.',

        ],

        'alerts' => [

            'success_title' => 'تمت العملية بنجاح',

            'error_title' => 'تعذر تنفيذ العملية',

            'validation_title' => 'يرجى مراجعة البيانات',

        ],

        'lesson' => [

            'current' => 'الدرس الحالي',

        ],

        'item' => 'عنصر',

        'statistics' => [

            'total' => 'إجمالي المحتوى',

            'text' => 'النصوص',

            'image' => 'الصور',

            'video' => 'الفيديوهات',

            'link' => 'الروابط',

            'file' => 'الملفات',

        ],

        'elements' => [

            'label' => 'عناصر الدرس',

            'title' => 'محتوى الدرس',

        ],

        'types' => [

            'text' => 'نص',

            'image' => 'صورة',

            'video' => 'فيديو',

            'link' => 'رابط',

            'file' => 'ملف',

            'content' => 'محتوى',

        ],

        'status' => [

            'active' => 'نشط',

            'inactive' => 'غير نشط',

        ],

        'item_no_title' => 'بدون عنوان',

        'image_alt' => 'صورة الدرس',

        'video_not_supported' => 'متصفحك لا يدعم تشغيل الفيديو.',

        'lesson_file' => 'ملف الدرس',

        'meta' => [

            'order' => 'ترتيب',

        ],

        'reorder' => [

            'title' => 'إعادة ترتيب المحتوى',

            'description' => 'اسحب العناصر لتغيير ترتيب ظهورها داخل الدرس.',

            'save' => 'حفظ الترتيب',

            'saving' => 'جاري الحفظ...',

            'saved' => 'تم الحفظ',

            'error' => 'حدث خطأ',

        ],

        'empty' => [

            'title' => 'لا يوجد محتوى لهذا الدرس بعد',

            'description' => 'ابدأ بإضافة نص أو صورة أو فيديو أو رابط أو ملف ليظهر ضمن محتوى الدرس.',

            'add_first' => 'إضافة أول محتوى',

        ],

        'note' => [

            'title' => 'ملاحظة',

            'description' => 'يمكنك ترتيب عناصر المحتوى حسب التسلسل الذي تريد أن يظهر به الدرس للطلاب، كما يمكنك تعطيل أي عنصر مؤقتًا دون حذفه.',

        ],

    ],


    // =========================================================
    // CONTENT CREATE
    // =========================================================

    'content_create' => [

        'page_title' => 'إضافة محتوى للدرس',

        'header_label' => 'محتوى الدرس',

        'title' => 'إضافة محتوى جديد',

        'description' => 'أنشئ عدة عناصر تعليمية داخل الدرس واحفظها دفعة واحدة.',

        'lesson' => [

            'current' => 'إضافة محتوى إلى الدرس',

        ],

        'old_notice' => 'تم الاحتفاظ بالبيانات التي أدخلتها بسبب وجود خطأ في التحقق. بالنسبة للصور والملفات، يجب إعادة اختيار الملف مرة أخرى لأن المتصفح لا يسمح بإعادة تعبئة حقول رفع الملفات تلقائيًا.',

        'form' => [

            'label' => 'بناء محتوى الدرس',

            'title' => 'عناصر المحتوى',

        ],

        'settings' => [

            'title' => 'إعدادات الدرس',

            'sort_order' => 'ترتيب أولي للمحتوى',

            'sort_order_placeholder' => 'سيتم الترتيب تلقائيًا',

            'sort_order_help' => 'إذا أدخلت رقمًا فسيكون هو بداية ترتيب العناصر، ثم تزداد الأرقام تلقائيًا لكل عنصر.',

            'note_label' => 'ملاحظة',

            'note_description' => 'يمكنك إضافة نص وصورة ورابط وفيديو وملف في نفس الطلب.',

        ],

        'actions' => [

            'back' => 'العودة إلى محتوى الدرس',

            'add_item' => 'إضافة عنصر محتوى آخر',

            'cancel' => 'إلغاء',

            'save' => 'حفظ جميع عناصر المحتوى',

        ],

        'alerts' => [

            'validation_title' => 'يرجى مراجعة البيانات التالية:',

        ],

        'help' => [

            'title' => 'محتوى متعدد العناصر',

            'description' => 'يمكنك بناء الدرس من عدة عناصر مستقلة، مثل شرح نصي ثم صورة تعليمية ثم فيديو من YouTube أو Google Drive ثم ملف PDF، وكلها تحفظ داخل نفس الدرس. الفيديو لا يتم رفعه إلى الموقع.',

        ],

        'types' => [

            'title' => 'أنواع المحتوى',

            'text' => [

                'label' => 'نص',

                'title' => 'النص',

                'description' => 'شرح أو نص تعليمي يظهر مباشرة داخل الدرس.',

            ],

            'image' => [

                'label' => 'صورة',

                'title' => 'الصورة',

                'description' => 'صورة تعليمية أو مخطط مرتبط بالشرح.',

            ],

            'video' => [

                'label' => 'فيديو',

                'title' => 'الفيديو',

                'description' => 'رابط YouTube أو Google Drive ويُشغّل داخل صفحة الدرس دون رفع الفيديو إلى الموقع.',

            ],

            'link' => [

                'label' => 'رابط',

                'title' => 'الرابط',

                'description' => 'رابط خارجي عادي لموقع أو مصدر تعليمي.',

            ],

            'file' => [

                'label' => 'ملف',

                'title' => 'الملف',

                'description' => 'PDF أو Word أو Excel أو PowerPoint أو ZIP.',

            ],

        ],

        'item' => [

            'title' => 'عنصر محتوى',

            'remove' => 'حذف العنصر',

        ],

        'fields' => [

            'type' => 'نوع المحتوى',

            'title' => 'عنوان المحتوى',

            'title_placeholder' => 'مثال: شرح أحكام النون الساكنة',

            'sort_order' => 'ترتيب العرض',

            'sort_order_placeholder' => 'تلقائي',

            'description' => 'وصف المحتوى',

            'description_placeholder' => 'أضف وصفًا مختصرًا لهذا العنصر...',

            'text_content' => 'محتوى النص',

            'text_content_placeholder' => 'اكتب الشرح أو النص التعليمي هنا...',

            'video_url' => 'رابط الفيديو',

            'video_url_placeholder' => 'https://www.youtube.com/watch?v=... أو رابط Google Drive',

            'link' => 'الرابط',

            'link_placeholder' => 'https://example.com/...',

            'image' => 'الصورة',

            'file' => 'الملف',

            'publish' => 'نشر هذا العنصر للطلاب',

            'status_help' => 'يمكن تعديل الحالة لاحقًا.',

        ],

        'video' => [

            'notice_title' => 'لن يتم رفع الفيديو إلى الموقع.',

            'notice_description' => 'ضع رابط الفيديو من YouTube أو Google Drive فقط، وسيتم تحويله إلى مشغل فيديو داخل صفحة الدرس.',

            'preview_title' => 'معاينة الفيديو',

        ],

        'upload' => [

            'image_title' => 'اختر صورة الدرس',

            'image_description' => 'JPG / JPEG / PNG / WEBP / GIF — حتى 10MB',

            'file_title' => 'اختر ملف الدرس',

            'file_description' => 'PDF / Word / Excel / PowerPoint / ZIP — حتى 50MB',

        ],

        'js' => [

            'minimum_item' => 'يجب أن يحتوي الدرس على عنصر واحد على الأقل.',

            'file_too_large' => 'حجم الملف ":name" يتجاوز الحد المسموح وهو :sizeMB.',

            'add_at_least_one' => 'أضف عنصر محتوى واحدًا على الأقل.',

            'complete_required' => 'يرجى إكمال بيانات جميع عناصر المحتوى المطلوبة.',

            'invalid_video' => 'رابط الفيديو يجب أن يكون رابط YouTube أو Google Drive صالحًا.',

            'saving' => 'جاري حفظ المحتوى...',

        ],

    ],


    // =========================================================
    // CONTENT SHOW
    // =========================================================

    'content_show' => [

        'page_title' => 'عرض محتوى الدرس',

        'header_label' => 'إدارة محتوى الدرس',

        'description' => 'عرض تفاصيل عنصر المحتوى داخل هذا الدرس.',

        'untitled' => 'محتوى بدون عنوان',

        'actions' => [

            'back' => 'العودة إلى المحتوى',

            'edit' => 'تعديل المحتوى',

        ],

        'basic_information' => [

            'label' => 'المعلومات الأساسية',

            'title' => 'بيانات المحتوى',

            'content_title' => 'عنوان المحتوى',

            'type' => 'نوع المحتوى:',

            'description' => 'وصف المحتوى',

        ],

        'content_section' => [

            'label' => 'محتوى العنصر',

            'text' => 'نص المحتوى',

            'link' => 'رابط المحتوى',

            'video' => 'الفيديو',

            'image' => 'الصورة',

            'file' => 'الملف',

        ],

        'types' => [

            'text' => 'نص',

            'image' => 'صورة',

            'link' => 'رابط',

            'video' => 'فيديو',

            'file' => 'ملف',

            'content' => 'المحتوى',

            'unknown' => 'غير محدد',

        ],

        'empty' => [

            'no_text' => 'لا يوجد نص مرتبط بهذا المحتوى.',

            'no_link' => 'لا يوجد رابط مرتبط بهذا المحتوى.',

            'no_video' => 'لا يوجد رابط فيديو مرتبط بهذا المحتوى.',

            'no_image' => 'لا توجد صورة مرتبطة بهذا المحتوى.',

            'no_file' => 'لا يوجد ملف مرتبط بهذا المحتوى.',

            'unknown_type' => 'نوع المحتوى غير معروف.',

        ],

        'video' => [

            'lesson_video' => 'فيديو الدرس',

            'not_supported' => 'متصفحك لا يدعم تشغيل الفيديو.',

            'open_original' => 'فتح رابط الفيديو الأصلي',

        ],

        'image' => [

            'content_image' => 'صورة المحتوى',

            'alt' => 'صورة المحتوى',

            'current' => 'الصورة الحالية',

        ],

        'file' => [

            'content_file' => 'ملف المحتوى',

            'current' => 'الملف الحالي',

            'file' => 'ملف',

            'view' => 'عرض الملف',

        ],

        'settings' => [

            'label' => 'إعدادات العرض',

            'title' => 'حالة وترتيب المحتوى',

            'sort_order' => 'ترتيب العرض',

            'status' => 'حالة المحتوى',

            'active' => 'محتوى نشط',

            'inactive' => 'محتوى غير نشط',

        ],

        'type_card' => [

            'label' => 'نوع العنصر',

            'title' => 'النوع الحالي',

            'text' => 'محتوى نصي',

            'image' => 'صورة',

            'link' => 'رابط خارجي',

            'video' => 'فيديو',

            'file' => 'ملف',

            'unknown' => 'نوع غير معروف',

        ],

        'actions_card' => [

            'label' => 'الإجراءات',

            'title' => 'إدارة المحتوى',

        ],

        'delete' => [

            'title' => 'حذف عنصر المحتوى',

            'description' => 'سيتم حذف هذا العنصر نهائيًا ولا يمكن التراجع عن العملية.',

            'confirm' => 'هل أنت متأكد من حذف عنصر المحتوى هذا؟ لا يمكن التراجع عن هذه العملية.',

            'button' => 'حذف المحتوى',

        ],

        'note' => [

            'title' => 'ملاحظة',

            'description' => 'يمكنك تعديل هذا العنصر في أي وقت، كما يمكنك استبدال الصورة أو الملف المرتبط به من صفحة التعديل.',

        ],

    ],


    // =========================================================
    // CONTENT EDIT
    // =========================================================

    'content_edit' => [

        'page_title' => 'تعديل محتوى الدرس',

        'header_label' => 'محتوى الدرس',

        'title' => 'تعديل محتوى الدرس',

        'description' => 'تعديل بيانات عنصر المحتوى الحالي وتحديثه داخل الدرس. يمكنك أيضًا تغيير نوع المحتوى بعد إنشائه.',

        'common' => [

            'required' => 'مطلوب',

            'optional' => 'اختياري',

            'or' => 'أو',

        ],

        'actions' => [

            'back' => 'العودة إلى المحتوى',

            'save_section' => 'حفظ التعديلات',

            'title' => 'الإجراءات',

            'save' => 'حفظ التعديلات',

            'cancel' => 'إلغاء',

        ],

        'alerts' => [

            'success_title' => 'تمت العملية بنجاح',

            'validation_title' => 'يرجى مراجعة البيانات',

        ],

        'basic_information' => [

            'label' => 'المعلومات الأساسية',

            'title' => 'بيانات المحتوى',

            'type' => 'نوع المحتوى',

            'content_title' => 'عنوان المحتوى',

            'description' => 'وصف المحتوى',

        ],

        'types' => [

            'text' => 'نص',

            'image' => 'صورة',

            'link' => 'رابط',

            'file' => 'ملف',

            'video' => 'فيديو',

            'content' => 'محتوى',

            'text_summary' => 'محتوى نصي',

            'image_summary' => 'صورة',

            'link_summary' => 'رابط خارجي',

            'file_summary' => 'ملف',

            'video_summary' => 'فيديو',

        ],

        'type_help' => 'يمكنك تغيير نوع المحتوى بعد إنشائه. عند الانتقال إلى صورة أو ملف سيطلب منك رفع الملف المناسب، أما الفيديو فيعتمد على رابط الفيديو.',

        'type_change_warning' => [

            'title' => 'سيتم تغيير نوع المحتوى',

            'description' => 'سيتم حذف بيانات النوع القديم عند حفظ التعديلات.',

        ],

        'placeholders' => [

            'title' => 'مثال: شرح الدرس أو ملف المحاضرة',

            'description' => 'اكتب وصفًا مختصرًا لهذا العنصر...',

            'text' => 'اكتب محتوى الدرس هنا...',

        ],

        'content_section' => [

            'label' => 'محتوى العنصر',

            'content' => 'المحتوى',

        ],

        'text' => [

            'content' => 'نص المحتوى',

            'help' => 'يمكنك كتابة شرح الدرس أو الملاحظات التعليمية هنا.',

        ],

        'link' => [

            'label' => 'رابط المحتوى',

            'help' => 'أدخل الرابط الكامل الذي تريد مشاركته مع الطلاب.',

        ],

        'image' => [

            'current' => 'الصورة الحالية',

            'content_image' => 'صورة المحتوى',

            'replace' => 'استبدال الصورة',

            'choose_new' => 'اختر صورة جديدة',

            'help' => 'إذا كنت تعدل صورة موجودة، اترك الحقل فارغًا للاحتفاظ بها. إذا قمت بتحويل نوع المحتوى إلى صورة، يجب رفع صورة جديدة.',

        ],

        'file' => [

            'current' => 'الملف الحالي',

            'replace' => 'استبدال الملف',

            'choose_new' => 'اختر ملفًا جديدًا',

            'type' => 'ملف',

            'view' => 'عرض',

            'help' => 'إذا كنت تعدل ملفًا موجودًا، اترك الحقل فارغًا للاحتفاظ به. إذا قمت بتحويل النوع إلى ملف، يجب رفع ملف جديد.',

        ],

        'upload' => [

            'max_10mb' => 'الحد الأقصى 10MB',

            'max_50mb' => 'الحد الأقصى 50MB',

        ],

        'video' => [

            'current' => 'الفيديو الحالي',

            'current_link' => 'رابط الفيديو الحالي',

            'open' => 'فتح الفيديو',

            'url' => 'رابط الفيديو',

            'help' => 'أدخل رابط الفيديو الكامل. يدعم النظام YouTube وGoogle Drive وVimeo وروابط الفيديو المباشرة مثل MP4 وWEBM وOGG.',

            'preview' => 'معاينة الفيديو',

            'not_supported' => 'متصفحك لا يدعم تشغيل الفيديو.',

        ],

        'settings' => [

            'label' => 'إعدادات العرض',

            'title' => 'ترتيب وحالة المحتوى',

            'sort_order' => 'ترتيب العرض',

            'status' => 'حالة المحتوى',

            'active' => 'محتوى نشط',

            'active_help' => 'يظهر للطلاب داخل الدرس',

        ],

        'type_summary' => [

            'label' => 'نوع العنصر',

            'title' => 'النوع الحالي',

            'help' => 'يمكنك تغيير نوع المحتوى من القائمة داخل النموذج.',

        ],

        'delete' => [

            'title' => 'حذف عنصر المحتوى',

            'description' => 'سيتم حذف هذا العنصر نهائيًا ولا يمكن التراجع عن العملية.',

            'confirm' => 'هل أنت متأكد من حذف عنصر المحتوى هذا؟ لا يمكن التراجع عن هذه العملية.',

            'button' => 'حذف المحتوى',

            'loading' => 'جارٍ الحذف...',

        ],

        'errors' => [

            'csrf' => 'تعذر العثور على CSRF Token.',

            'delete' => 'حدث خطأ أثناء حذف المحتوى.',

            'connection' => 'تعذر الاتصال بالخادم. يرجى المحاولة مرة أخرى.',

        ],

        'note' => [

            'title' => 'ملاحظة',

            'description' => 'عند استبدال صورة أو ملف، سيتم حذف النسخة القديمة تلقائيًا واستبدالها بالملف الجديد. أما الفيديو فيتم تحديث رابطه مباشرة دون رفع ملف فيديو إلى الخادم.',

        ],

    ],

],

'news' => [

    'page_title' => 'الأخبار والإعلانات',
    'header_label' => 'إدارة المحتوى',
    'title' => 'الأخبار والإعلانات',
    'description' => 'أضيفي الأخبار والإعلانات التي ستظهر للزوار في شريط الأخبار بالموقع.',
    'add_new' => 'إضافة خبر جديد',

    'alerts' => [
        'success_title' => 'تمت العملية بنجاح',
        'validation_title' => 'يرجى مراجعة البيانات المدخلة.',
    ],

    'status' => [
        'active' => 'نشط',
        'inactive' => 'غير نشط',
    ],

    'types' => [
        'lesson' => 'درس',
        'announcement' => 'إعلان',
        'update' => 'تحديث',
        'notice' => 'تنبيه',
        'general' => 'عام',
    ],

    'meta' => [
        'added_at' => 'أضيف في',
        'starts_at' => 'يبدأ:',
        'ends_at' => 'ينتهي:',
        'has_link' => 'يحتوي على رابط',
    ],

    'actions' => [
        'view' => 'عرض',
        'edit' => 'تعديل',
        'disable' => 'تعطيل',
        'activate' => 'تفعيل',
        'delete' => 'حذف',
        'confirm_delete' => 'هل أنت متأكد من حذف هذا الخبر؟ لا يمكن التراجع عن هذه العملية.',
    ],

    'empty' => [
        'title' => 'لا توجد أخبار حتى الآن',
        'description' => 'يمكنك إضافة أول خبر أو إعلان ليظهر لاحقًا في شريط الأخبار الموجود في الواجهة الرئيسية للموقع.',
        'add_first' => 'إضافة أول خبر',
    ],
'news_create' => [

    'page_title' => 'إضافة خبر جديد',
    'header_label' => 'الأخبار والإعلانات',
    'title' => 'إضافة خبر جديد',
    'description' => 'أنشئي خبرًا أو إعلانًا ليظهر في شريط الأخبار بالواجهة الرئيسية.',

    'actions' => [
        'back' => 'العودة إلى الأخبار',
        'cancel' => 'إلغاء',
        'save' => 'إضافة الخبر',
    ],

    'form' => [
        'title' => 'بيانات الخبر',
        'description' => 'أدخلي المعلومات الأساسية للخبر وحددي طريقة ظهوره في الموقع.',
    ],

    'fields' => [
        'title' => 'عنوان الخبر',
        'title_placeholder' => 'مثال: تم إضافة درس جديد في التجويد',
        'type' => 'نوع الخبر',
        'type_placeholder' => 'اختر نوع الخبر',
        'sort_order' => 'ترتيب الظهور',
        'sort_order_placeholder' => '0',
        'content' => 'نص الخبر',
        'content_placeholder' => 'اكتبي تفاصيل الخبر أو الإعلان هنا...',
        'link' => 'رابط الخبر',
        'link_placeholder' => 'https://example.com',
        'starts_at' => 'يبدأ الظهور',
        'ends_at' => 'انتهاء الظهور',
    ],

    'types' => [
        'announcement' => 'إعلان',
        'lesson' => 'درس جديد',
        'update' => 'تحديث',
        'notice' => 'تنبيه',
        'general' => 'خبر عام',
    ],

    'help' => [
        'sort_order' => 'الرقم الأصغر يظهر أولًا عند ترتيب الأخبار حسب الترتيب.',
        'content' => 'يمكنك كتابة رسالة قصيرة، إعلان عن درس جديد، تحديث في الموقع، أو أي معلومة تريدين إظهارها للزوار.',
        'link' => 'اختياري. إذا كان الخبر مرتبطًا بصفحة أو درس، يمكنك وضع الرابط هنا ليتمكن الزائر من الانتقال إليه.',
        'starts_at' => 'اتركيه فارغًا ليبدأ الخبر بالظهور مباشرة.',
        'ends_at' => 'اتركيه فارغًا إذا أردتِ أن يستمر الخبر بدون تاريخ انتهاء.',
    ],

    'publishing' => [
        'title' => 'إعدادات النشر',

        'publish' => [
            'title' => 'نشر الخبر',
            'description' => 'عند التفعيل سيكون الخبر متاحًا للظهور في شريط الأخبار حسب فترة الظهور المحددة.',
        ],

        'new_tab' => [
            'title' => 'فتح الرابط في نافذة جديدة',
            'description' => 'عند وجود رابط للخبر سيتم فتحه في تبويب جديد بدل مغادرة الصفحة الحالية.',
        ],
    ],

    'footer' => [
        'note' => 'يمكنك تعديل الخبر أو إيقاف ظهوره في أي وقت من صفحة إدارة الأخبار.',
    ],

    'required' => '*',
],

],
'news_create' => [

    'page_title' => 'إضافة خبر جديد',
    'header_label' => 'الأخبار والإعلانات',
    'title' => 'إضافة خبر جديد',
    'description' => 'أنشئي خبرًا أو إعلانًا ليظهر في شريط الأخبار بالواجهة الرئيسية.',

    'actions' => [
        'back' => 'العودة إلى الأخبار',
        'cancel' => 'إلغاء',
        'save' => 'إضافة الخبر',
    ],

    'form' => [
        'title' => 'بيانات الخبر',
        'description' => 'أدخلي المعلومات الأساسية للخبر وحددي طريقة ظهوره في الموقع.',
    ],

    'fields' => [
        'title' => 'عنوان الخبر',
        'title_placeholder' => 'مثال: تم إضافة درس جديد في التجويد',
        'type' => 'نوع الخبر',
        'type_placeholder' => 'اختر نوع الخبر',
        'sort_order' => 'ترتيب الظهور',
        'sort_order_placeholder' => '0',
        'content' => 'نص الخبر',
        'content_placeholder' => 'اكتبي تفاصيل الخبر أو الإعلان هنا...',
        'link' => 'رابط الخبر',
        'link_placeholder' => 'https://example.com',
        'starts_at' => 'يبدأ الظهور',
        'ends_at' => 'انتهاء الظهور',
    ],

    'types' => [
        'announcement' => 'إعلان',
        'lesson' => 'درس جديد',
        'update' => 'تحديث',
        'notice' => 'تنبيه',
        'general' => 'خبر عام',
    ],

    'help' => [
        'sort_order' => 'الرقم الأصغر يظهر أولًا عند ترتيب الأخبار حسب الترتيب.',
        'content' => 'يمكنك كتابة رسالة قصيرة، إعلان عن درس جديد، تحديث في الموقع، أو أي معلومة تريدين إظهارها للزوار.',
        'link' => 'اختياري. إذا كان الخبر مرتبطًا بصفحة أو درس، يمكنك وضع الرابط هنا ليتمكن الزائر من الانتقال إليه.',
        'starts_at' => 'اتركيه فارغًا ليبدأ الخبر بالظهور مباشرة.',
        'ends_at' => 'اتركيه فارغًا إذا أردتِ أن يستمر الخبر بدون تاريخ انتهاء.',
    ],

    'publishing' => [
        'title' => 'إعدادات النشر',

        'publish' => [
            'title' => 'نشر الخبر',
            'description' => 'عند التفعيل سيكون الخبر متاحًا للظهور في شريط الأخبار حسب فترة الظهور المحددة.',
        ],

        'new_tab' => [
            'title' => 'فتح الرابط في نافذة جديدة',
            'description' => 'عند وجود رابط للخبر سيتم فتحه في تبويب جديد بدل مغادرة الصفحة الحالية.',
        ],
    ],

    'footer' => [
        'note' => 'يمكنك تعديل الخبر أو إيقاف ظهوره في أي وقت من صفحة إدارة الأخبار.',
    ],

    'alerts' => [
        'validation_title' => 'يرجى مراجعة البيانات المدخلة.',
    ],

    'required' => '*',
],

'news_show' => [

    'page_title' => 'عرض الخبر',
    'header_label' => 'الأخبار والإعلانات',
    'title' => 'عرض الخبر',
    'description' => 'معاينة بيانات الخبر وطريقة ظهوره في شريط الأخبار.',

    'actions' => [
        'edit' => 'تعديل',
        'back' => 'العودة للأخبار',
        'edit_news' => 'تعديل الخبر',
        'delete_news' => 'حذف الخبر',
        'confirm_delete' => 'هل أنت متأكدة من حذف هذا الخبر نهائيًا؟',
    ],

    'status' => [
        'label' => 'حالة الخبر:',
        'active' => 'نشط',
        'inactive' => 'غير نشط',
    ],

    'order' => 'ترتيب',

    'content' => [
        'title' => 'محتوى الخبر',
    ],

    'types' => [
        'announcement' => 'إعلان',
        'lesson' => 'درس جديد',
        'update' => 'تحديث',
        'notice' => 'تنبيه',
        'general' => 'خبر عام',
    ],

    'link' => [
        'label' => 'رابط مرتبط بالخبر',
    ],

    'info' => [
        'title' => 'معلومات الخبر',
        'type' => 'نوع الخبر',
        'sort_order' => 'ترتيب الظهور',
        'starts_at' => 'بداية الظهور',
        'ends_at' => 'انتهاء الظهور',
        'starts_immediately' => 'يبدأ مباشرة',
        'no_end_date' => 'بدون تاريخ انتهاء',
        'created_at' => 'تاريخ الإنشاء',
        'updated_at' => 'آخر تعديل',
        'open_link' => 'فتح الرابط',
        'new_window' => 'نافذة جديدة',
        'same_page' => 'نفس الصفحة',
    ],

    'preview' => [
        'title' => 'معاينة شريط الأخبار',
        'description' => 'هذه معاينة تقريبية لطريقة ظهور الخبر في الواجهة الأمامية للموقع.',
        'latest_news' => 'آخر الأخبار',
    ],

],

'news_edit' => [

    'page_title' => 'تعديل الخبر',
    'header_label' => 'الأخبار والإعلانات',
    'title' => 'تعديل الخبر',
    'description' => 'تعديل بيانات الخبر وإعدادات ظهوره في شريط الأخبار.',

    'actions' => [
        'view' => 'عرض الخبر',
        'back' => 'العودة للأخبار',
        'cancel' => 'إلغاء',
        'save' => 'حفظ التعديلات',
    ],

    'current' => [
        'label' => 'الخبر الحالي',
    ],

    'status' => [
        'active' => 'نشط',
        'inactive' => 'غير نشط',
    ],

    'form' => [
        'title' => 'بيانات الخبر',
        'description' => 'عدّلي المعلومات التي تريدين تغييرها ثم احفظي التعديلات.',
    ],

    'fields' => [
        'title' => 'عنوان الخبر',
        'title_placeholder' => 'مثال: تم إضافة درس جديد في التجويد',
        'type' => 'نوع الخبر',
        'type_placeholder' => 'اختر نوع الخبر',
        'sort_order' => 'ترتيب الظهور',
        'content' => 'نص الخبر',
        'content_placeholder' => 'اكتبي تفاصيل الخبر أو الإعلان هنا...',
        'link' => 'رابط الخبر',
        'link_placeholder' => 'https://example.com',
        'starts_at' => 'يبدأ الظهور',
        'ends_at' => 'انتهاء الظهور',
    ],

    'types' => [
        'announcement' => 'إعلان',
        'lesson' => 'درس جديد',
        'update' => 'تحديث',
        'notice' => 'تنبيه',
        'general' => 'خبر عام',
    ],

    'help' => [
        'sort_order' => 'الرقم الأصغر يظهر أولًا عند ترتيب الأخبار.',
        'content' => 'هذا النص سيستخدم في عرض تفاصيل الخبر، ويمكن استخدامه أيضًا داخل شريط الأخبار حسب تصميم الواجهة الأمامية.',
        'link' => 'اختياري. استخدميه لربط الخبر بدرس أو صفحة داخل الموقع أو بأي رابط خارجي.',
        'starts_at' => 'اتركيه فارغًا ليبدأ الخبر بالظهور مباشرة عند تفعيله.',
        'ends_at' => 'اتركيه فارغًا ليستمر الخبر بدون تاريخ انتهاء.',
    ],

    'publishing' => [
        'title' => 'إعدادات النشر',

        'publish' => [
            'title' => 'نشر الخبر',
            'description' => 'عند التفعيل سيكون الخبر متاحًا للظهور في شريط الأخبار وفقًا لفترة الظهور.',
        ],

        'new_tab' => [
            'title' => 'فتح الرابط في نافذة جديدة',
            'description' => 'عند وجود رابط للخبر سيتم فتحه في تبويب جديد.',
        ],
    ],

    'footer' => [
        'note' => 'تأكدي من صحة بيانات الخبر قبل حفظ التعديلات.',
    ],

    'delete' => [
        'title' => 'حذف الخبر',
        'description' => 'حذف هذا الخبر إجراء نهائي ولا يمكن التراجع عنه بعد تنفيذ العملية. إذا كنتِ لا تريدين ظهوره حاليًا، يمكنك تعطيله بدلًا من حذفه.',
        'button' => 'حذف الخبر نهائيًا',
        'confirm' => 'هل أنتِ متأكدة من حذف هذا الخبر نهائيًا؟',
    ],

    'required' => '*',

],

'notifications' => [

    'page_title' => 'الإشعارات',
    'title' => 'الإشعارات',

    'unread_prefix' => 'لديك',
    'unread_suffix' => 'إشعار غير مقروء',

    'read_all' => 'تحديد الكل كمقروء',

    'actions' => [
        'mark_read' => 'تحديد كمقروء',
        'open' => 'فتح',
        'delete' => 'حذف',
    ],

    'empty' => [
        'title' => 'لا توجد إشعارات',
        'description' => 'ستظهر هنا الإشعارات الجديدة الخاصة بلوحة التعليم.',
    ],

],

'payments' => [

    'page_title' => 'المدفوعات',
    'header_label' => 'إدارة التعليم',
    'title' => 'المدفوعات',
    'description' => 'متابعة المدفوعات المرتبطة بالحجوزات التعليمية، ومراجعة إثباتات الدفع وحالات العمليات المالية.',

    'actions' => [
        'bookings' => 'الحجوزات',
        'filter' => 'تصفية',
        'reset' => 'إعادة ضبط',
        'details' => 'التفاصيل',
        'view_payment_details' => 'عرض تفاصيل الدفع',
    ],

    'statistics' => [
        'total' => 'إجمالي المدفوعات',
        'submitted' => 'بانتظار المراجعة',
        'under_review' => 'قيد المراجعة',
        'approved' => 'مدفوعات معتمدة',
        'rejected' => 'مدفوعات مرفوضة',
    ],

    'filters' => [
        'search' => 'البحث',
        'search_placeholder' => 'الطالب، البريد، رقم الحجز، المرجع...',
        'status' => 'حالة الدفع',
        'all_statuses' => 'جميع الحالات',
        'payment_method' => 'طريقة الدفع',
        'all_methods' => 'جميع الطرق',
        'date' => 'التاريخ',
    ],

    'payment_methods' => [
        'bank_transfer' => 'تحويل بنكي',
        'cash' => 'نقدي',
        'other' => 'أخرى',
    ],

    'status' => [
        'unpaid' => 'غير مدفوع',
        'submitted' => 'بانتظار المراجعة',
        'under_review' => 'قيد المراجعة',
        'approved' => 'معتمد',
        'rejected' => 'مرفوض',
    ],

    'table' => [
        'financial_record' => 'السجل المالي',
        'payment_operations' => 'عمليات الدفع',
        'operation_count' => 'عملية',
        'booking_lesson' => 'الحجز / الدرس',
        'student' => 'الطالب',
        'price' => 'السعر',
        'payment_method' => 'طريقة الدفع',
        'status' => 'الحالة',
        'submitted_at' => 'تاريخ الإرسال',
        'action' => 'الإجراء',
    ],

    'sessions' => [
        'single' => 'جلسة',
        'multiple' => 'جلسات',
        'completed' => 'مكتملة',
    ],

    'amount' => [
        'registered_payment' => 'المبلغ المسجل بالدفع:',
    ],

    'mobile' => [
        'booking_price' => 'سعر الحجز',
        'method' => 'الطريقة',
        'sessions' => 'الجلسات',
        'submitted_at' => 'تاريخ الإرسال',
        'payment_reference' => 'مرجع الدفع',
    ],

    'fallbacks' => [
        'educational_booking' => 'حجز تعليمي',
        'student_unavailable' => 'طالب غير متاح',
        'not_submitted' => 'لم يتم الإرسال',
    ],

    'empty' => [
        'title' => 'لا توجد مدفوعات',
        'description' => 'لم يتم العثور على عمليات دفع تطابق معايير البحث الحالية.',
        'show_all' => 'عرض جميع المدفوعات',
    ],

],

'payment_show' => [

    'page_title' => 'تفاصيل الدفع',

    'header_label' => 'إدارة المدفوعات',
    'title' => 'تفاصيل عملية الدفع',
    'description' => 'مراجعة بيانات الحجز ومبلغ الدرس وإثبات الدفع واتخاذ الإجراء المناسب.',

    'actions' => [
        'back' => 'العودة إلى المدفوعات',
    ],

    'reference' => [
        'label' => 'رقم العملية',
    ],

    'status' => [
        'approved' => 'تم الاعتماد',
        'submitted' => 'تم إرسال الإثبات',
        'under_review' => 'قيد المراجعة',
        'rejected' => 'مرفوض',
        'unpaid' => 'غير مدفوع',
    ],

    'payment_info' => [
        'label' => 'معلومات العملية',
        'title' => 'بيانات الدفع',
        'amount' => 'المبلغ المدفوع',
        'booking_price' => 'سعر الحجز / الدرس',
        'payment_method' => 'طريقة الدفع',
        'reference' => 'رقم التحويل / المرجع',
        'submitted_at' => 'تاريخ إرسال الإثبات',
        'paid_at' => 'تاريخ الدفع',
        'created_at' => 'تاريخ إنشاء العملية',
        'updated_at' => 'آخر تحديث',
    ],

    'payment_methods' => [
        'bank_transfer' => 'تحويل بنكي',
        'cash' => 'نقدًا',
        'card' => 'بطاقة',
        'online' => 'دفع إلكتروني',
    ],

    'receipt' => [
        'label' => 'إثبات الدفع',
        'title' => 'إيصال التحويل',
        'alt' => 'إثبات الدفع',
        'open_full_image' => 'فتح الصورة بالحجم الكامل',
        'pdf_file' => 'ملف PDF',
        'default_pdf_name' => 'إثبات الدفع.pdf',
        'file' => 'ملف إثبات الدفع',
        'attached_file' => 'الملف المرفق',
        'open_file' => 'فتح الملف',
        'file_name' => 'اسم الملف',
        'file_type' => 'نوع الملف',
        'file_size' => 'حجم الملف',
        'no_receipt' => 'لا يوجد إثبات دفع',
        'no_receipt_description' => 'لم يتم رفع أي ملف إثبات لهذه العملية حتى الآن.',
    ],

    'student_note' => [
        'label' => 'ملاحظة الطالب',
        'title' => 'ملاحظات الدفع',
    ],

    'admin_review' => [
        'label' => 'المراجعة الإدارية',
        'title' => 'نتيجة المراجعة',
        'reviewed_by' => 'تمت المراجعة بواسطة',
        'admin' => 'الإدارة',
        'reviewed_at' => 'تاريخ المراجعة',
        'admin_note' => 'ملاحظة الإدارة',
        'rejection_reason' => 'سبب رفض العملية',
    ],

    'booking' => [
        'label' => 'الحجز المرتبط',
        'title' => 'معلومات الدرس والحجز',
        'lesson' => 'الدرس',
        'default_lesson' => 'درس تعليمي',
        'price' => 'سعر الحجز',
        'total_sessions' => 'عدد الجلسات',
        'session' => 'جلسة',
        'sessions' => 'جلسات',
        'completed_sessions' => 'الجلسات المكتملة',
        'remaining_sessions' => 'الجلسات المتبقية',
        'category' => 'التصنيف',
        'date' => 'التاريخ',
        'time' => 'الوقت',
        'booking_status' => 'حالة الحجز',
        'payment_status' => 'حالة الدفع',
        'description' => 'وصف الحجز',
        'view_booking' => 'عرض تفاصيل الحجز',
        'not_found' => 'لم يتم العثور على الحجز المرتبط.',

        'categories' => [
            'quran' => 'القرآن الكريم',
            'tajweed' => 'التجويد',
            'arabic' => 'اللغة العربية',
        ],

        'statuses' => [
            'confirmed' => 'مؤكدة',
            'pending' => 'قيد المراجعة',
            'completed' => 'مكتملة',
            'cancelled' => 'ملغاة',
            'rejected' => 'مرفوضة',
        ],

        'payment_statuses' => [
            'paid' => 'مدفوع',
            'pending' => 'قيد الانتظار',
            'unpaid' => 'غير مدفوع',
            'failed' => 'فشل الدفع',
        ],
    ],

    'student' => [
        'label' => 'صاحب العملية',
        'title' => 'الطالب',
        'default_name' => 'طالب',
        'no_data' => 'لا توجد بيانات الطالب.',
    ],

    'status_summary' => [
        'label' => 'حالة العملية',
        'title' => 'ملخص الحالة',

        'approved' => [
            'title' => 'تم اعتماد الدفع',
            'description' => 'تم التحقق من عملية الدفع واعتمادها.',
        ],

        'submitted' => [
            'title' => 'تم إرسال إثبات الدفع',
            'description' => 'الإثبات بانتظار مراجعة الإدارة.',
        ],

        'under_review' => [
            'title' => 'العملية قيد المراجعة',
            'description' => 'تتم مراجعة الإثبات من قبل الإدارة.',
        ],

        'rejected' => [
            'title' => 'تم رفض عملية الدفع',
            'description' => 'يحتاج الطالب إلى إجراء جديد بناءً على سبب الرفض.',
        ],

        'unpaid' => [
            'title' => 'العملية غير مدفوعة',
            'description' => 'لم يتم استكمال الدفع حتى الآن.',
        ],
    ],

    'actions_section' => [
        'label' => 'الإجراءات',
        'title' => 'إدارة العملية',
        'approve' => 'اعتماد الدفع',
        'review' => 'وضع قيد المراجعة',
        'reject' => 'رفض الدفع',
        'reset' => 'إعادة إلى غير مدفوع',
        'no_action' => 'لا توجد إجراءات متاحة حاليًا.',
    ],

    'confirmations' => [
        'approve' => 'هل أنت متأكد من اعتماد عملية الدفع؟',
        'reset' => 'هل تريد إعادة العملية إلى حالة غير مدفوع؟',
    ],

    'modal' => [
        'close' => 'إغلاق',
        'eyebrow' => 'رفض عملية الدفع',
        'title' => 'سبب رفض الإثبات',
        'description' => 'يرجى كتابة سبب واضح للرفض ليتمكن الطالب من معرفة المطلوب منه.',
        'reason_label' => 'سبب الرفض',
        'reason_placeholder' => 'اكتب سبب رفض عملية الدفع...',
        'cancel' => 'إلغاء',
        'confirm_reject' => 'تأكيد الرفض',
    ],

],

'profile' => [

    'page_title' => 'الصفحة الشخصية',

    'description' => 'إدارة بيانات حساب مدير التعليم وإعدادات الدخول.',

    'admin' => [
        'default_name' => 'مدير التعليم',
        'active' => 'الحساب نشط',
        'education_manager' => 'مدير التعليم',
    ],

    'fields' => [
        'name' => 'الاسم',
        'email' => 'البريد الإلكتروني',
        'account_type' => 'نوع الحساب',
    ],

    'personal' => [
        'title' => 'البيانات الشخصية',
        'description' => 'تعديل الاسم والبريد الإلكتروني.',
        'save' => 'حفظ البيانات',
    ],

    'password' => [
        'title' => 'تغيير كلمة المرور',
        'description' => 'استخدم كلمة مرور قوية لحماية حسابك.',
        'current' => 'كلمة المرور الحالية',
        'new' => 'كلمة المرور الجديدة',
        'confirm' => 'تأكيد كلمة المرور',
        'requirement' => 'يجب أن تحتوي كلمة المرور الجديدة على 8 أحرف على الأقل.',
        'save' => 'تغيير كلمة المرور',
    ],

],

'quizzes' => [

    'page_title' => 'الاختبارات',
    'header_label' => 'إدارة التعليم',
    'title' => 'الاختبارات',
    'subtitle' => 'إدارة الاختبارات التعليمية',
    'description' => 'أنشئ الاختبارات العامة واختبارات الطلاب، وأدر الأسئلة والدرجات والمحاولات بسهولة.',

    'actions' => [
        'new' => 'اختبار جديد',
        'view' => 'عرض الاختبار',
        'questions' => 'إدارة الأسئلة والخيارات',
        'edit' => 'تعديل الاختبار',
        'delete' => 'حذف الاختبار',
        'confirm_delete' => 'هل أنت متأكد من حذف هذا الاختبار؟ سيتم حذف الأسئلة والخيارات المرتبطة به أيضًا.',
    ],

    'alerts' => [
        'success_title' => 'تمت العملية بنجاح',
        'error_title' => 'تعذر تنفيذ العملية',
    ],

    'overview' => [
        'total' => 'إجمالي الاختبارات',
        'total_description' => 'اختبار مسجل في النظام',

        'active' => 'الاختبارات النشطة',
        'active_description' => 'متاحة للطلاب',

        'questions' => 'الأسئلة',
        'questions_description' => 'ضمن النتائج الحالية',

        'current_page' => 'الصفحة الحالية',
        'of' => 'من',
    ],

    'filters' => [
        'title' => 'البحث والتصفية',
        'description' => 'ابحث عن اختبار أو قم بتصفية النتائج',

        'search_placeholder' => 'ابحث باسم الاختبار أو الوصف أو الدرس أو الطالب...',

        'all_types' => 'جميع أنواع الاختبارات',
        'general_quizzes' => 'اختبارات الدروس العامة',
        'student_quizzes' => 'اختبارات الطلاب',

        'all_lessons' => 'جميع الدروس العامة',

        'all_statuses' => 'جميع الحالات',

        'apply' => 'تطبيق',
        'reset' => 'إعادة ضبط',
    ],

    'status' => [
        'active' => 'نشط',
        'inactive' => 'غير نشط',
    ],

    'results' => [
        'header_label' => 'إدارة المحتوى',
        'title' => 'قائمة الاختبارات',
        'quiz_count' => 'اختبار',
    ],

    'card' => [
        'no_description' => 'لا يوجد وصف لهذا الاختبار.',
    ],

    'types' => [
        'general_lesson' => 'اختبار درس عام',
        'student' => 'اختبار طالب',
        'unlinked' => 'غير مرتبط',
    ],

    'related' => [
        'general_lesson' => 'الدرس العام',
        'student_lesson' => 'درس الطالب',
        'session' => 'الجلسة',
    ],

    'meta' => [
        'question' => 'سؤال',
        'pass' => 'النجاح',
        'attempts' => 'محاولات',
        'unlimited' => 'غير محدد',
        'minutes' => 'دقيقة',
        'no_time_limit' => 'بدون وقت',
    ],

    'empty' => [
        'title' => 'لا توجد اختبارات',
        'description' => 'لم يتم العثور على أي اختبار مطابق للبحث أو الفلاتر الحالية.',
        'create_first' => 'إنشاء أول اختبار',
    ],

],

'quiz_show' => [

    'page_title' => 'عرض الاختبار',

    'header_label' => 'إدارة الاختبارات',

    'educational_quiz' => 'اختبار تعليمي',

    'description' => 'عرض تفاصيل الاختبار والأسئلة والخيارات والإعدادات الخاصة به.',

    'actions' => [
        'back' => 'العودة إلى الاختبارات',
        'edit' => 'تعديل الاختبار',
    ],

    'alerts' => [
        'success_title' => 'تمت العملية بنجاح',
    ],

    'overview' => [
        'section_label' => 'معلومات الاختبار',
        'title' => 'نظرة عامة',
    ],

    'fields' => [
        'title' => 'عنوان الاختبار',
        'description' => 'وصف الاختبار',
        'no_description' => 'لا يوجد وصف لهذا الاختبار.',
    ],

    'questions' => [
        'section_label' => 'محتوى الاختبار',
        'title' => 'الأسئلة',
        'add' => 'إضافة سؤال',
        'empty_title' => 'لا توجد أسئلة',
        'empty_description' => 'لم تتم إضافة أي سؤال إلى هذا الاختبار حتى الآن.',
        'add_first' => 'إضافة أول سؤال',
    ],

    'status' => [
        'active' => 'نشط',
        'inactive' => 'غير نشط',
    ],

    'question_types' => [
        'multiple_choice' => 'اختيار من متعدد',
        'true_false' => 'صح أو خطأ',
        'text' => 'إجابة نصية',
        'unspecified' => 'غير محدد',
    ],

    'points' => [
        'single' => 'درجة',
        'multiple' => 'درجات',
    ],

    'options' => 'خيارات',

    'question_actions' => [
        'view' => 'عرض السؤال',
        'edit' => 'تعديل السؤال',
    ],

    'explanations' => [
        'section_label' => 'الشروحات',
        'title' => 'شروحات الإجابات',
    ],

    'summary' => [
        'section_label' => 'الاختبار',
        'title' => 'ملخص الاختبار',
    ],

    'statistics' => [
        'section_label' => 'الإحصائيات',
        'title' => 'معلومات الاختبار',
        'questions' => 'عدد الأسئلة',
        'total_points' => 'مجموع الدرجات',
        'pass_percentage' => 'نسبة النجاح',
        'max_attempts' => 'المحاولات المسموحة',
        'time' => 'الوقت',
        'minutes' => 'دقيقة',
        'not_specified_feminine' => 'غير محددة',
        'not_specified' => 'غير محدد',
    ],

    'status_section' => [
        'section_label' => 'الحالة',
        'title' => 'حالة الاختبار',

        'active_title' => 'الاختبار نشط',
        'active_description' => 'الاختبار متاح للطلاب عند استيفاء شروط الظهور.',

        'inactive_title' => 'الاختبار غير نشط',
        'inactive_description' => 'لن يظهر الاختبار للطلاب حتى يتم تفعيله.',
    ],

    'quick_actions' => [
        'section_label' => 'إجراءات سريعة',
        'title' => 'إدارة الاختبار',
        'manage_questions' => 'إدارة الأسئلة',
        'add_question' => 'إضافة سؤال',
        'edit_quiz' => 'تعديل الاختبار',
    ],

    'note' => [
        'title' => 'ملاحظة',
        'description' => 'يمكنك من صفحة الأسئلة إضافة الخيارات وتحديد الإجابة الصحيحة لكل سؤال، ثم تعديل ترتيب الأسئلة حسب الحاجة.',
    ],

],

'quiz_edit' => [

    'page_title' => 'تعديل الاختبار',

    'header_label' => 'إدارة الاختبارات',

    'description' => 'قم بتعديل بيانات الاختبار وإعداداته وارتباطه بالدرس حسب الحاجة.',

    'required' => '*',

    'optional' => 'اختياري',

    'actions' => [
        'back' => 'العودة إلى الاختبار',
        'save' => 'حفظ التعديلات',
        'cancel' => 'إلغاء',
    ],

    'alerts' => [
        'validation_title' => 'يرجى مراجعة البيانات',
    ],

    'basic' => [
        'title' => 'المعلومات الأساسية',
        'heading' => 'بيانات الاختبار',
    ],

    'fields' => [
        'title' => 'عنوان الاختبار',
        'title_placeholder' => 'مثال: اختبار القرآن الكريم',
        'description' => 'وصف الاختبار',
        'description_placeholder' => 'اكتب وصفًا مختصرًا للاختبار...',
    ],

    'lesson_type' => [

        'section_label' => 'ارتباط الاختبار',
        'heading' => 'نوع الدرس المرتبط',

        'label' => 'نوع الدرس',

        'general' => [
            'title' => 'درس عام',
            'description' => 'درس موجود ضمن دروس الموقع العامة.',
        ],

        'student' => [
            'title' => 'درس خاص بالطالب',
            'description' => 'نسخة درس مرتبطة بطالب وحجز محدد.',
        ],

        'general_lesson' => [
            'label' => 'الدرس العام',
            'placeholder' => 'اختر الدرس العام',
            'hint' => 'اختر الدرس العام الذي ينتمي إليه الاختبار.',
        ],

        'student_lesson' => [
            'label' => 'درس الطالب',
            'placeholder' => 'اختر درس الطالب',
            'hint' => 'اختر نسخة الدرس الخاصة بالطالب الذي سيؤدي الاختبار.',
        ],

        'info' => [
            'general' => 'هذا الاختبار مرتبط بدرس عام، ويمكن عرضه للطلاب ضمن محتوى الموقع العام.',
            'student' => 'هذا الاختبار مرتبط بنسخة درس خاصة بالطالب، ولن يظهر ضمن الدروس العامة.',
        ],

    ],

    'settings' => [

        'section_label' => 'إعدادات الاختبار',
        'heading' => 'التحكم في الاختبار',

        'pass_percentage' => 'نسبة النجاح',

        'max_attempts' => 'عدد المحاولات',
        'max_attempts_placeholder' => 'غير محدد',
        'max_attempts_hint' => 'اتركه فارغًا للسماح بعدد غير محدد من المحاولات.',

        'time_limit' => 'مدة الاختبار',
        'time_limit_placeholder' => 'بالدقائق',
        'time_limit_hint' => 'المدة بالدقائق. اتركه فارغًا إذا لم يكن هناك حد زمني.',

        'sort_order' => 'ترتيب العرض',

    ],

    'sidebar' => [

        'quiz_label' => 'الاختبار',
        'current_info' => 'معلومات حالية',

        'general_quiz' => 'اختبار لدرس عام',

    ],

    'status' => [

        'section_label' => 'الحالة',
        'heading' => 'حالة الاختبار',

        'active_title' => 'اختبار نشط',
        'active_description' => 'يظهر الاختبار للطلاب عند تفعيله.',

    ],

    'statistics' => [

        'section_label' => 'الإحصائيات',
        'heading' => 'البيانات الحالية',

        'questions' => 'الأسئلة',
        'total_points' => 'مجموع الدرجات',
        'pass_percentage' => 'نسبة النجاح',

    ],

    'note' => [

        'title' => 'ملاحظة',

        'description' => 'تغيير نوع الدرس أو الدرس المرتبط لا يؤدي إلى حذف الأسئلة أو المحاولات المرتبطة بالاختبار.',

    ],

],

'quiz_attempts' => [

    'page_title' => 'محاولات الاختبارات',
    'header_label' => 'الاختبارات',
    'title' => 'محاولات الطلاب',
    'subtitle' => 'نتائج ومحاولات الاختبارات',
    'description' => 'تابعي محاولات الطلاب ونتائجهم ومستوى أدائهم في الاختبارات التعليمية.',

    'alerts' => [
        'success_title' => 'تمت العملية بنجاح',
    ],

    'statistics' => [
        'total' => 'إجمالي المحاولات',
        'passed' => 'محاولات ناجحة',
        'failed' => 'محاولات غير ناجحة',
        'completed' => 'محاولات مكتملة',
    ],

    'filters' => [
        'header_label' => 'البحث والتصفية',
        'title' => 'البحث في المحاولات',
        'search_placeholder' => 'ابحث باسم الطالب أو البريد الإلكتروني أو اسم الاختبار...',
        'all_statuses' => 'جميع الحالات',
        'all_results' => 'كل النتائج',
        'apply' => 'تطبيق',
        'reset' => 'إعادة ضبط',
    ],

    'results' => [
        'passed' => 'ناجح',
        'failed' => 'غير ناجح',
    ],

    'status' => [
        'completed' => 'مكتملة',
        'in_progress' => 'قيد التنفيذ',
        'cancelled' => 'ملغاة',
    ],

    'table' => [
        'header_label' => 'سجل المحاولات',
        'title' => 'جميع محاولات الطلاب',
        'student' => 'الطالب',
        'quiz' => 'الاختبار',
        'attempt' => 'المحاولة',
        'score' => 'النتيجة',
        'percentage' => 'النسبة',
        'status' => 'الحالة',
        'started_at' => 'تاريخ البدء',
        'actions' => 'الإجراءات',
    ],

    'fallback' => [
        'unknown_student' => 'طالب غير معروف',
        'deleted_quiz' => 'اختبار محذوف',
    ],

    'actions' => [
        'view_result' => 'عرض النتيجة',
    ],

    'empty' => [
        'title' => 'لا توجد محاولات',
        'description' => 'لم يتم العثور على أي محاولات اختبارات تطابق معايير البحث الحالية.',
        'show_all' => 'عرض جميع المحاولات',
    ],

],

'quiz_attempt_show' => [

    'page_title' => 'تفاصيل محاولة الاختبار',
    'header_label' => 'إدارة الاختبارات',
    'title' => 'تفاصيل محاولة الاختبار',
    'description' => 'عرض نتيجة الطالب وتفاصيل المحاولة والإجابات المسجلة لكل سؤال.',

    'actions' => [
        'back' => 'العودة إلى المحاولات',
        'back_all' => 'العودة إلى جميع المحاولات',
    ],

    'alerts' => [
        'success_title' => 'تمت العملية بنجاح',
    ],

    'fallback' => [
        'quiz' => 'اختبار',
        'unknown_student' => 'غير معروف',
        'question_unavailable' => 'السؤال غير متوفر',
    ],

    'result' => [
        'section_label' => 'النتيجة النهائية',
        'title' => 'نتيجة المحاولة',
        'passed' => 'ناجح',
        'failed' => 'غير ناجح',
        'score_label' => 'النتيجة',
        'earned_score' => 'الدرجة المحصلة',
        'total_score' => 'الدرجة الكاملة',
        'passing_score' => 'درجة النجاح',
    ],

    'student' => [
        'section_label' => 'الطالب',
        'title' => 'معلومات الطالب',
    ],

    'answers' => [
        'section_label' => 'تفاصيل الإجابات',
        'title' => 'إجابات الطالب',
        'count' => 'إجابة',
        'correct' => 'صحيحة',
        'wrong' => 'خاطئة',
        'student_answer' => 'إجابة الطالب',
        'no_answer' => 'لم يتم تسجيل إجابة',
        'points' => 'الدرجة',
        'explanation' => 'شرح السؤال',
    ],

    'empty' => [
        'title' => 'لا توجد إجابات',
        'description' => 'لم يتم تسجيل أي إجابات لهذه المحاولة حتى الآن.',
    ],

    'quiz' => [
        'section_label' => 'الاختبار',
        'title' => 'معلومات الاختبار',
    ],

    'attempt' => [
        'section_label' => 'المحاولة',
        'title' => 'معلومات المحاولة',
        'number' => 'رقم المحاولة',
        'status_label' => 'الحالة',
        'started_at' => 'بدأ في',
        'completed_at' => 'انتهى في',
    ],

    'status' => [
        'completed' => 'مكتملة',
        'in_progress' => 'قيد التنفيذ',
        'abandoned' => 'متروكة',
        'unknown' => 'غير محددة',
    ],

    'dates' => [
        'not_available' => 'غير محدد',
        'not_completed' => 'لم ينته بعد',
    ],

    'summary' => [
        'passed' => 'أداء ناجح',
        'needs_improvement' => 'يحتاج إلى تحسين',
        'of' => 'من',
    ],

],

'quiz_questions' => [
    'page_title' => 'أسئلة الاختبار',
    'header_label' => 'إدارة الأسئلة',
    'title' => 'أسئلة الاختبار',
    'description' => 'إدارة أسئلة الاختبار والخيارات والإجابات الصحيحة.',

    'actions' => [
        'add_question' => 'إضافة سؤال',
        'quiz' => 'الاختبار',
        'add_option' => 'إضافة خيار',
        'view_question' => 'عرض السؤال',
        'manage_options' => 'إدارة الاختيارات',
        'edit_question' => 'تعديل السؤال',
        'delete_question' => 'حذف السؤال',
        'confirm_delete' => 'هل أنت متأكد من حذف هذا السؤال؟ سيتم حذف خيارات الإجابة المرتبطة به أيضًا.',
    ],

    'alerts' => [
        'success_title' => 'تمت العملية بنجاح',
        'error_title' => 'تعذر تنفيذ العملية',
    ],

    'summary' => [
        'questions' => 'الأسئلة',
        'pass_percentage' => 'نسبة النجاح',
        'attempts' => 'المحاولات',
        'time' => 'الوقت',
        'minutes' => 'دقيقة',
    ],

    'list' => [
        'section_label' => 'محتوى الاختبار',
        'title' => 'قائمة الأسئلة',
        'question_count' => 'سؤال',
    ],

    'question' => [
        'label' => 'السؤال',
    ],

    'status' => [
        'active' => 'نشط',
        'inactive' => 'غير نشط',
    ],

    'types' => [
        'multiple_choice' => 'اختيار من متعدد',
        'true_false' => 'صح أو خطأ',
        'text' => 'إجابة نصية',
    ],

    'points' => [
        'single' => 'درجة',
        'multiple' => 'درجات',
    ],

    'options' => [
        'single' => 'خيار',
        'multiple' => 'خيارات',
        'more' => 'أخرى',
    ],

    'correct_answers' => [
        'single' => 'إجابة صحيحة',
        'multiple' => 'إجابات صحيحة',
    ],

    'options_summary' => [
        'total' => 'إجمالي الخيارات',
        'active' => 'نشط',
        'correct' => 'صحيحة',
    ],

    'no_options' => [
        'title' => 'لا توجد خيارات لهذا السؤال',
        'description' => 'يجب إضافة خيارات الإجابة حتى يتمكن الطالب من الإجابة على السؤال.',
    ],

    'text_answer' => [
        'description' => 'هذا السؤال يتطلب من الطالب كتابة الإجابة بنفسه.',
    ],

    'empty' => [
        'title' => 'لا توجد أسئلة',
        'description' => 'لم تتم إضافة أي أسئلة إلى هذا الاختبار حتى الآن.',
        'add_first' => 'إضافة أول سؤال',
    ],
],

'quiz_question_create' => [
    'page_title' => 'إضافة سؤال جديد',
    'header_label' => 'أسئلة الاختبار',
    'title' => 'إضافة سؤال جديد',
    'description' => 'أضف سؤالًا جديدًا وحدد نوعه والخيارات والإجابة الصحيحة.',

    'optional' => 'اختياري',

    'actions' => [
        'back' => 'العودة إلى الأسئلة',
        'add_option' => 'إضافة خيار',
        'save' => 'حفظ السؤال',
        'cancel' => 'إلغاء',
    ],

    'alerts' => [
        'validation_title' => 'يرجى مراجعة البيانات التالية:',
    ],

    'basic' => [
        'section_label' => 'المعلومات الأساسية',
        'title' => 'بيانات السؤال',
    ],

    'fields' => [
        'question' => 'نص السؤال',
        'question_placeholder' => 'اكتب نص السؤال هنا...',
        'type' => 'نوع السؤال',
        'type_placeholder' => 'اختر نوع السؤال',
        'points' => 'عدد النقاط',
        'explanation' => 'شرح الإجابة',
        'explanation_placeholder' => 'اكتب شرحًا يظهر للطالب بعد الإجابة...',
        'sort_order' => 'ترتيب السؤال',
        'status' => 'حالة السؤال',
        'active_question' => 'سؤال نشط',
    ],

    'types' => [
        'multiple_choice' => 'اختيار من متعدد',
        'true_false' => 'صح / خطأ',
        'text' => 'إجابة نصية',
    ],

    'options' => [
        'section_label' => 'خيارات الإجابة',
        'title' => 'الاختيارات',
        'heading' => 'خيارات السؤال',
        'description' => 'أضف الخيارات وحدد الإجابة الصحيحة.',
        'empty_message' => 'أضف خيارين على الأقل لهذا السؤال.',
    ],

    'display' => [
        'section_label' => 'إعدادات العرض',
        'title' => 'حالة وترتيب السؤال',
    ],

    'quiz' => [
        'section_label' => 'الاختبار',
        'title' => 'الاختبار الحالي',
    ],

    'guide' => [
        'section_label' => 'دليل السؤال',
        'title' => 'أنواع الأسئلة',
        'multiple_choice' => 'عدة خيارات وإجابة صحيحة واحدة.',
        'true_false' => 'اختيار بين إجابة صحيحة وخاطئة.',
        'text' => 'يكتب الطالب الإجابة بنفسه.',
    ],

    'note' => [
        'title' => 'ملاحظة',
        'description' => 'في أسئلة الاختيار من متعدد، يجب تحديد إجابة صحيحة واحدة على الأقل.',
    ],

    'javascript' => [
        'option_placeholder' => 'اكتب نص الخيار...',
        'delete_option' => 'حذف الخيار',
        'true_option' => 'صح',
        'false_option' => 'خطأ',
        'minimum_options' => 'يجب إضافة خيارين على الأقل للسؤال.',
        'select_correct' => 'يرجى تحديد الإجابة الصحيحة.',
    ],
],

'quiz_question_show' => [
    'page_title' => 'عرض السؤال',
    'header_label' => 'إدارة الأسئلة',
    'title' => 'عرض السؤال',
    'description' => 'عرض تفاصيل السؤال وخيارات الإجابة والإعدادات المرتبطة به.',

    'actions' => [
        'back' => 'العودة إلى الأسئلة',
        'edit' => 'تعديل السؤال',
        'add_option' => 'إضافة خيار',
        'view_option' => 'عرض الخيار',
        'edit_option' => 'تعديل الخيار',
        'delete_option' => 'حذف الخيار',
        'add_first_option' => 'إضافة أول خيار',
        'manage_options' => 'إدارة الخيارات',
        'confirm_delete_option' => 'هل أنت متأكد من حذف هذا الخيار؟',
    ],

    'alerts' => [
        'success_title' => 'تمت العملية بنجاح',
    ],

    'question' => [
        'section_label' => 'السؤال',
        'title' => 'نص السؤال',
        'label' => 'السؤال',
        'explanation' => 'شرح الإجابة',
    ],

    'options' => [
        'section_label' => 'إجابات السؤال',
        'title' => 'خيارات الإجابة',
        'correct' => 'الإجابة الصحيحة',
        'incorrect' => 'إجابة غير صحيحة',
        'order' => 'الترتيب:',
        'total' => 'إجمالي الخيارات:',
        'correct_selected' => 'الإجابة الصحيحة محددة',
        'no_correct_selected' => 'لم يتم تحديد إجابة صحيحة',
    ],

    'status' => [
        'active' => 'نشط',
        'inactive' => 'غير نشط',
        'section_label' => 'الحالة',
        'title' => 'حالة السؤال',
        'active_question' => 'سؤال نشط',
        'inactive_question' => 'سؤال غير نشط',
    ],

    'empty_options' => [
        'title' => 'لا توجد خيارات إجابة',
        'description' => 'لم تتم إضافة أي خيارات لهذا السؤال حتى الآن.',
    ],

    'text_answer' => [
        'section_label' => 'طريقة الإجابة',
        'title' => 'إجابة نصية',
        'description' => 'هذا السؤال يتطلب من الطالب كتابة الإجابة بنفسه.',
    ],

    'settings' => [
        'section_label' => 'الإعدادات',
        'title' => 'إعدادات السؤال',
        'points' => 'الدرجة',
        'point' => 'درجة',
        'sort_order' => 'ترتيب العرض',
    ],

    'question_type' => [
        'section_label' => 'نوع السؤال',
        'title' => 'طريقة الإجابة',
        'multiple_choice' => 'اختيار من متعدد',
        'true_false' => 'صح أو خطأ',
        'text' => 'إجابة نصية',
        'unknown' => 'غير محدد',
    ],

    'quiz' => [
        'section_label' => 'الاختبار',
        'title' => 'معلومات الاختبار',
    ],

    'statistics' => [
        'section_label' => 'الإحصائيات',
        'title' => 'ملخص السؤال',
        'points' => 'الدرجة',
        'options_count' => 'عدد الخيارات',
        'correct_answers' => 'الإجابات الصحيحة',
        'sort_order' => 'ترتيب السؤال',
    ],

    'options_management' => [
        'section_label' => 'الخيارات',
        'title' => 'إدارة الإجابات',
    ],

    'actions_section' => [
        'section_label' => 'الإجراءات',
        'title' => 'إدارة السؤال',
    ],

    'delete' => [
        'title' => 'حذف السؤال',
        'description' => 'سيتم حذف السؤال نهائيًا وجميع خياراته المرتبطة به.',
        'button' => 'حذف السؤال',
        'confirm' => 'هل أنت متأكد من حذف هذا السؤال؟ سيتم حذف خيارات الإجابة المرتبطة به أيضًا.',
    ],

    'note' => [
        'title' => 'ملاحظة',
        'description' => 'يمكنك إضافة خيارات متعددة للسؤال، ثم تحديد الإجابة الصحيحة وتعديل ترتيب الخيارات أو حالتها من قسم إدارة الخيارات.',
    ],
],

'question_edit' => [
    'page_title' => 'تعديل السؤال',
    'header_label' => 'إدارة الأسئلة',
    'title' => 'تعديل السؤال',
    'description' => 'تعديل بيانات السؤال ونوعه ودرجته وخيارات الإجابة والإعدادات المرتبطة به.',

    'required' => '*',
    'optional' => 'اختياري',

    'actions' => [
        'back' => 'العودة إلى السؤال',
        'save' => 'حفظ التعديلات',
        'cancel' => 'إلغاء',
    ],

    'alerts' => [
        'validation_title' => 'يرجى مراجعة البيانات',
    ],

    'question' => [
        'section_label' => 'السؤال',
        'heading' => 'بيانات السؤال',
    ],

    'fields' => [
        'question' => 'نص السؤال',
        'question_placeholder' => 'اكتب السؤال هنا...',
        'explanation' => 'شرح الإجابة',
        'explanation_placeholder' => 'اكتب شرحًا أو توضيحًا للإجابة...',
        'explanation_hint' => 'يمكن استخدام هذا الحقل لشرح الإجابة الصحيحة للطالب بعد انتهاء الاختبار.',
    ],

    'type' => [
        'section_label' => 'نوع السؤال',
        'heading' => 'طريقة الإجابة',
    ],

    'types' => [
        'multiple_choice' => [
            'title' => 'اختيار من متعدد',
            'description' => 'يختار الطالب إجابة واحدة من عدة خيارات.',
        ],
        'true_false' => [
            'title' => 'صح أو خطأ',
            'description' => 'يحدد الطالب ما إذا كانت العبارة صحيحة أم خاطئة.',
        ],
        'text' => [
            'title' => 'إجابة نصية',
            'description' => 'يكتب الطالب الإجابة بنفسه.',
        ],
    ],

    'options' => [
        'section_label' => 'الإجابات',
        'heading' => 'خيارات الإجابة',
        'manage_title' => 'إدارة الخيارات',
        'manage_description' => 'يمكنك تعديل الخيارات الحالية أو إضافة خيارات جديدة.',
        'add' => 'إضافة اختيار',
        'option_text' => 'نص الخيار',
        'option_placeholder' => 'اكتب الخيار...',
        'new_option_placeholder' => 'اكتب الخيار الجديد...',
        'correct_answer' => 'الإجابة الصحيحة',
        'active' => 'نشط',
        'delete' => 'حذف الاختيار',
        'remove' => 'إزالة الاختيار',
        'empty' => 'لا توجد خيارات إجابة مرتبطة بهذا السؤال.',
        'correct_hint' => 'اختر إجابة واحدة فقط باعتبارها الإجابة الصحيحة.',
    ],

    'settings' => [
        'section_label' => 'الإعدادات',
        'heading' => 'إعدادات السؤال',
        'points' => 'الدرجة',
        'sort_order' => 'ترتيب العرض',
    ],

    'quiz' => [
        'section_label' => 'الاختبار',
        'title' => 'معلومات الاختبار',
    ],

    'quiz_settings' => [
        'section_label' => 'إعدادات الاختبار',
        'title' => 'معلومات عامة',
        'pass_percentage' => 'نسبة النجاح',
        'attempts' => 'المحاولات',
        'time' => 'الوقت',
        'minutes' => 'دقيقة',
        'unlimited' => 'غير محدد',
    ],

    'status' => [
        'section_label' => 'الحالة',
        'title' => 'حالة السؤال',
        'active_title' => 'سؤال نشط',
        'active_description' => 'يظهر السؤال للطلاب عند تفعيل الاختبار.',
    ],

    'current' => [
        'title' => 'السؤال الحالي',
        'description_before' => 'يتم تعديل السؤال رقم',
        'description_after' => 'داخل هذا الاختبار.',
    ],
],

'quiz_options' => [
    'page_title' => 'خيارات السؤال',
    'header_label' => 'إدارة الخيارات',
    'title' => 'خيارات السؤال',
    'description' => 'إدارة خيارات الإجابة وتحديد الإجابة الصحيحة لهذا السؤال.',

    'actions' => [
        'back' => 'العودة إلى السؤال',
        'add' => 'إضافة خيار',
        'view_option' => 'عرض الخيار',
        'edit_option' => 'تعديل الخيار',
        'delete_option' => 'حذف الخيار',
    ],

    'alerts' => [
        'success_title' => 'تمت العملية بنجاح',
        'error_title' => 'تعذر تنفيذ العملية',
    ],

    'question' => [
        'section_label' => 'السؤال',
        'title' => 'نص السؤال',

        'types' => [
            'multiple_choice' => 'اختيار من متعدد',
            'true_false' => 'صح أو خطأ',
            'text' => 'إجابة نصية',
        ],

        'point' => 'درجة',
        'points' => 'درجات',
        'has_explanation' => 'يوجد شرح للإجابة',
    ],

    'options' => [
        'section_label' => 'الخيارات',
        'title' => 'خيارات الإجابة',
        'count' => 'خيار',
    ],

    'text_question' => [
        'title' => 'هذا السؤال نصي',
        'description' => 'أسئلة الإجابة النصية لا تحتاج إلى خيارات جاهزة.',
    ],

    'option' => [
        'correct' => 'الإجابة الصحيحة',
        'incorrect' => 'إجابة غير صحيحة',
        'order' => 'الترتيب:',
        'active' => 'نشط',
        'inactive' => 'غير نشط',
    ],

    'empty' => [
        'title' => 'لا توجد خيارات لهذا السؤال',
        'description' => 'أضف خيارات الإجابة حتى يتمكن الطالب من اختيار الإجابة المناسبة.',
        'add_first' => 'إضافة أول خيار',
    ],

    'warning' => [
        'title' => 'لا توجد إجابة صحيحة محددة',
        'description' => 'يجب تحديد إجابة صحيحة واحدة على الأقل حتى يتمكن النظام من تصحيح إجابات الطلاب.',
    ],

    'type' => [
        'section_label' => 'نوع السؤال',
        'title' => 'طريقة الإجابة',

        'multiple_choice' => [
            'title' => 'اختيار من متعدد',
            'description' => 'يختار الطالب إجابة واحدة من عدة خيارات.',
        ],

        'true_false' => [
            'title' => 'صح أو خطأ',
            'description' => 'يحدد الطالب ما إذا كانت العبارة صحيحة أم خاطئة.',
        ],

        'text' => [
            'title' => 'إجابة نصية',
            'description' => 'يكتب الطالب الإجابة بنفسه.',
        ],
    ],

    'info' => [
        'section_label' => 'معلومات السؤال',
        'title' => 'الإعدادات',
        'points' => 'الدرجة',
        'sort_order' => 'الترتيب',
        'options_count' => 'عدد الخيارات',
        'correct_count' => 'الإجابات الصحيحة',
    ],

    'status' => [
        'section_label' => 'الحالة',
        'title' => 'حالة السؤال',
        'active' => 'سؤال نشط',
        'inactive' => 'سؤال غير نشط',
    ],

    'management' => [
        'section_label' => 'الإجراءات',
        'title' => 'إدارة السؤال',
        'view_question' => 'عرض السؤال',
        'add_option' => 'إضافة خيار',
        'edit_question' => 'تعديل السؤال',
    ],

    'delete' => [
        'confirm' => 'هل أنت متأكد من حذف هذا الخيار؟ لا يمكن التراجع عن هذه العملية.',
    ],

    'note' => [
        'title' => 'ملاحظة',
        'description' => 'يجب تحديد إجابة صحيحة واحدة على الأقل في أسئلة الاختيار من متعدد وصح أو خطأ حتى يتمكن النظام من تصحيح الإجابات.',
    ],
],

'quiz_option_create' => [
    'page_title' => 'إضافة خيار',
    'header_label' => 'إدارة الخيارات',
    'title' => 'إضافة خيار',
    'description' => 'إضافة خيار إجابة جديد لهذا السؤال وتحديد ما إذا كان إجابة صحيحة.',

    'actions' => [
        'back_to_options' => 'العودة إلى الخيارات',
        'cancel' => 'إلغاء',
        'create' => 'إنشاء الخيار',
        'view_question' => 'عرض السؤال',
        'view_options' => 'عرض الخيارات',
    ],

    'alerts' => [
        'validation_title' => 'يرجى تصحيح الأخطاء التالية',
    ],

    'question' => [
        'section_label' => 'السؤال',
        'heading' => 'السؤال المرتبط بالخيار',
        'type' => 'نوع السؤال',

        'types' => [
            'multiple_choice' => 'اختيار من متعدد',
            'true_false' => 'صح أو خطأ',
            'text' => 'إجابة نصية',
        ],
    ],

    'option' => [
        'section_label' => 'بيانات الخيار',
        'heading' => 'معلومات الإجابة',

        'text' => 'نص الخيار',
        'text_placeholder' => 'اكتب نص خيار الإجابة هنا...',

        'sort_order' => 'ترتيب الخيار',
        'sort_order_help' => 'يحدد ترتيب ظهور هذا الخيار بين بقية الخيارات.',

        'answer_status' => 'حالة الإجابة',
        'correct' => 'هذه إجابة صحيحة',
        'correct_description' => 'سيتم اعتماد هذا الخيار كإجابة صحيحة عند تصحيح إجابات الطالب.',

        'active_status' => 'حالة الخيار',
        'active' => 'خيار نشط',
        'active_description' => 'الخيارات غير النشطة لن يتم عرضها للطلاب أثناء الاختبار.',
    ],

    'type_help' => [
        'true_false' => 'في أسئلة صح أو خطأ يسمح النظام بإجابة صحيحة واحدة فقط. عند تحديد هذا الخيار سيتم إلغاء صحة أي خيار آخر.',
        'multiple_choice' => 'يمكن أن يحتوي سؤال الاختيار من متعدد على أكثر من إجابة صحيحة.',
    ],

    'question_type' => [
        'section_label' => 'نوع السؤال',
        'heading' => 'طريقة الإجابة',

        'multiple_choice' => [
            'title' => 'اختيار من متعدد',
            'description' => 'يختار الطالب إجابة واحدة أو أكثر من مجموعة الخيارات.',
        ],

        'true_false' => [
            'title' => 'صح أو خطأ',
            'description' => 'يحدد الطالب ما إذا كانت العبارة صحيحة أم خاطئة.',
        ],

        'text' => [
            'title' => 'إجابة نصية',
            'description' => 'يكتب الطالب الإجابة بنفسه.',
        ],
    ],

    'question_info' => [
        'section_label' => 'معلومات السؤال',
        'heading' => 'تفاصيل السؤال',
        'points' => 'الدرجة',
        'sort_order' => 'ترتيب السؤال',
        'existing_options' => 'الخيارات الحالية',
    ],

    'note' => [
        'title' => 'ملاحظة',

        'multiple_choice' => 'يمكنك إضافة عدة خيارات صحيحة لهذا السؤال. كل خيار يتم تحديده كإجابة صحيحة سيتم اعتماده أثناء تصحيح إجابات الطالب.',

        'true_false' => 'يجب أن يكون هناك خيار واحد صحيح فقط. عند تحديد خيار جديد كإجابة صحيحة سيتم إلغاء صحة الخيار السابق تلقائيًا.',

        'text' => 'الأسئلة النصية لا تحتاج إلى خيارات جاهزة.',
    ],
],

'quiz_option_show' => [
    'page_title' => 'عرض خيار الإجابة',
    'header_label' => 'إدارة الخيارات',
    'title' => 'عرض خيار الإجابة',
    'description' => 'عرض تفاصيل خيار الإجابة وحالته والإعدادات المرتبطة به.',

    'actions' => [
        'back' => 'العودة إلى الخيارات',
        'edit' => 'تعديل الخيار',
        'delete' => 'حذف الخيار',
    ],

    'alerts' => [
        'success_title' => 'تمت العملية بنجاح',
    ],

    'question' => [
        'section_label' => 'السؤال',
        'heading' => 'السؤال المرتبط بالخيار',
        'has_explanation' => 'يوجد شرح للإجابة',
    ],

    'option' => [
        'section_label' => 'خيار الإجابة',
        'heading' => 'تفاصيل الخيار',
        'number' => 'خيار رقم',
        'text_label' => 'نص الإجابة',
        'correct_status' => 'صحة الإجابة',
        'correct' => 'إجابة صحيحة',
        'incorrect' => 'إجابة غير صحيحة',
        'status' => 'حالة الخيار',
        'active' => 'نشط',
        'inactive' => 'غير نشط',
        'order' => 'الترتيب',
    ],

    'answer_status' => [
        'section_label' => 'حالة الإجابة',
        'heading' => 'نتيجة الخيار',
        'correct' => 'هذا الخيار هو الإجابة الصحيحة',
        'incorrect' => 'هذا الخيار ليس الإجابة الصحيحة',
    ],

    'management' => [
        'section_label' => 'الإجراءات',
        'heading' => 'إدارة الخيار',
    ],

    'question_type' => [
        'section_label' => 'نوع السؤال',
        'heading' => 'طريقة الإجابة',

        'multiple_choice' => [
            'title' => 'اختيار من متعدد',
            'description' => 'يختار الطالب إجابة واحدة من عدة خيارات.',
        ],

        'true_false' => [
            'title' => 'صح أو خطأ',
            'description' => 'يحدد الطالب ما إذا كانت العبارة صحيحة أم خاطئة.',
        ],

        'text' => [
            'title' => 'إجابة نصية',
            'description' => 'يكتب الطالب الإجابة بنفسه.',
        ],
    ],

    'question_info' => [
        'section_label' => 'معلومات السؤال',
        'heading' => 'الإعدادات',
        'points' => 'الدرجة',
        'sort_order' => 'ترتيب السؤال',
        'options_count' => 'عدد الخيارات',
    ],

    'question_status' => [
        'section_label' => 'الحالة',
        'heading' => 'حالة السؤال',
        'active' => 'سؤال نشط',
        'inactive' => 'سؤال غير نشط',
    ],

    'note' => [
        'title' => 'ملاحظة',
        'true_false' => 'في سؤال صح أو خطأ، يجب أن تكون هناك إجابة صحيحة واحدة فقط.',
        'multiple_choice' => 'تأكد من تحديد الإجابة الصحيحة حتى يتمكن النظام من تصحيح إجابة الطالب.',
        'text' => 'السؤال النصي لا يحتاج إلى خيارات إجابة.',
    ],

    'delete' => [
        'confirm' => 'هل أنت متأكد من حذف هذا الخيار؟ لا يمكن التراجع عن هذه العملية.',
    ],
],

'quiz_option_edit' => [
    'page_title' => 'تعديل خيار الإجابة',
    'header_label' => 'إدارة الخيارات',
    'title' => 'تعديل خيار الإجابة',
    'description' => 'تعديل نص الخيار وترتيبه وحالته وتحديد ما إذا كان إجابة صحيحة.',

    'actions' => [
        'back' => 'العودة إلى الخيارات',
        'view' => 'عرض الخيار',
        'cancel' => 'إلغاء',
        'save' => 'حفظ التعديلات',
        'delete' => 'حذف الخيار',
    ],

    'alerts' => [
        'error_title' => 'تعذر تحديث الخيار',
        'error_description' => 'يرجى مراجعة البيانات المدخلة وتصحيح الأخطاء.',
    ],

    'question' => [
        'section_label' => 'السؤال',
        'heading' => 'السؤال المرتبط بالخيار',
        'has_explanation' => 'يوجد شرح للإجابة',
    ],

    'option' => [
        'section_label' => 'تعديل الخيار',
        'heading' => 'بيانات الإجابة',

        'text' => 'نص الخيار',
        'text_placeholder' => 'اكتب نص خيار الإجابة...',
        'text_help' => 'يمكنك تعديل نص الإجابة دون تغيير السؤال المرتبط بها.',

        'sort_order' => 'ترتيب الخيار',
        'sort_placeholder' => '0',
        'sort_help' => 'الرقم الأقل يظهر أولًا.',

        'status' => 'حالة الخيار',
        'active' => 'خيار نشط',
        'inactive' => 'خيار غير نشط',
        'status_help' => 'عند تعطيل الخيار لن يظهر للطالب.',
    ],

    'correct_answer' => [
        'section_label' => 'الإجابة الصحيحة',
        'title' => 'حالة الإجابة الصحيحة',
        'true_false' => 'يمكن أن يكون هناك خيار صحيح واحد فقط لهذا السؤال.',
        'multiple_choice' => 'حدد الخيار إذا كانت هذه الإجابة هي الإجابة الصحيحة.',
        'correct' => 'إجابة صحيحة',
    ],

    'danger' => [
        'section_label' => 'منطقة الخطر',
        'title' => 'حذف الخيار',
        'heading' => 'حذف خيار الإجابة',
        'description' => 'حذف هذا الخيار نهائيًا من السؤال. لا يمكن التراجع عن هذه العملية.',
        'confirm' => 'هل أنت متأكد من حذف هذا الخيار؟ لا يمكن التراجع عن هذه العملية.',
    ],

    'question_type' => [
        'section_label' => 'نوع السؤال',
        'heading' => 'طريقة الإجابة',

        'multiple_choice' => [
            'title' => 'اختيار من متعدد',
            'description' => 'يختار الطالب إجابة واحدة من عدة خيارات.',
        ],

        'true_false' => [
            'title' => 'صح أو خطأ',
            'description' => 'يحدد الطالب ما إذا كانت العبارة صحيحة أم خاطئة.',
        ],

        'text' => [
            'title' => 'إجابة نصية',
            'description' => 'يكتب الطالب الإجابة بنفسه.',
        ],
    ],

    'status' => [
        'section_label' => 'حالة الخيار',
        'heading' => 'معلومات مختصرة',
        'number' => 'رقم الخيار',
        'order' => 'الترتيب',
        'answer' => 'الإجابة',
        'correct' => 'صحيحة',
        'incorrect' => 'غير صحيحة',
    ],

    'question_info' => [
        'section_label' => 'السؤال',
        'heading' => 'معلومات السؤال',
        'points' => 'الدرجة',
        'options_count' => 'عدد الخيارات',
        'status' => 'حالة السؤال',
        'active' => 'نشط',
        'inactive' => 'غير نشط',
    ],

    'note' => [
        'title' => 'ملاحظة',
        'true_false' => 'عند جعل هذا الخيار صحيحًا، سيقوم النظام بإلغاء صحة الخيارات الأخرى تلقائيًا.',
        'multiple_choice' => 'تأكد من وجود إجابة صحيحة واحدة على الأقل حتى يتم تصحيح السؤال بشكل صحيح.',
        'text' => 'الأسئلة النصية لا تستخدم خيارات جاهزة.',
    ],
],

'settings' => [
    'page_title' => 'إعدادات التعليم',
    'title' => 'إعدادات التعليم',
    'description' => 'إدارة بيانات الدفع والحساب البنكي الخاصة بقسم التعليم.',

    'alerts' => [
        'validation_title' => 'يرجى تصحيح الأخطاء التالية:',
    ],

    'payment' => [
        'section_title' => 'إعدادات الدفع',
        'section_description' => 'بيانات الحساب البنكي وطريقة الدفع',

        'status_section' => 'حالة الدفع',
        'receiving_payments' => 'استقبال المدفوعات',
        'receiving_payments_description' => 'عند التعطيل لن يظهر للطلاب خيار الدفع.',
        'enable' => 'تفعيل الدفع',

        'bank_section' => 'بيانات الحساب البنكي',

        'bank_name' => 'اسم البنك',
        'bank_name_placeholder' => 'مثال: مصرف الراجحي',

        'account_name' => 'اسم صاحب الحساب',
        'account_name_placeholder' => 'اسم صاحب الحساب',

        'account_number' => 'رقم الحساب',
        'account_number_placeholder' => 'رقم الحساب البنكي',

        'iban' => 'رقم الآيبان IBAN',
        'iban_placeholder' => 'SA00 0000 0000 0000 0000 0000',

        'instructions_section' => 'تعليمات الدفع',
        'instructions_label' => 'التعليمات التي ستظهر للطالب',
        'instructions_placeholder' => 'اكتب هنا تعليمات الدفع والتحويل البنكي للطلاب...',
        'instructions_help' => 'يمكنك كتابة خطوات التحويل البنكي وأي معلومات يحتاجها الطالب لإتمام الدفع.',
    ],

    'actions' => [
        'save' => 'حفظ الإعدادات',
        'close' => 'إغلاق',
    ],
],

'student_lessons' => [
    'page_title' => 'دروس الطلاب',

    'header' => [
        'education' => 'التعليم',
        'title' => 'دروس الطلاب',
        'description' => 'إدارة الدروس المسندة إلى الطلاب ومتابعة تقدمهم في التعلم.',
    ],

    'actions' => [
        'assign_lesson' => 'إسناد درس',
        'filter' => 'تصفية',
        'reset' => 'إعادة ضبط',
        'view' => 'عرض الدرس',
        'edit' => 'تعديل الدرس',
        'assign_first' => 'إسناد أول درس',
    ],

    'statistics' => [
        'total' => 'إجمالي الدروس',
        'assigned' => 'مسندة',
        'in_progress' => 'قيد التنفيذ',
        'completed' => 'مكتملة',
        'cancelled' => 'ملغاة',
    ],

    'filters' => [
        'search' => 'البحث',
        'search_placeholder' => 'ابحث باسم الطالب أو البريد الإلكتروني أو عنوان الدرس...',
        'status' => 'الحالة',
        'all_statuses' => 'جميع الحالات',
        'assigned' => 'مسند',
        'in_progress' => 'قيد التنفيذ',
        'completed' => 'مكتمل',
        'cancelled' => 'ملغى',
    ],

    'table' => [
        'title' => 'دروس الطلاب',
        'student' => 'الطالب',
        'lesson' => 'الدرس',
        'status' => 'الحالة',
        'assigned_date' => 'تاريخ الإسناد',
        'session' => 'الجلسة',
        'actions' => 'الإجراءات',
        'lesson_count_singular' => 'درس',
        'lesson_count_plural' => 'دروس',
        'original_lesson' => 'الدرس الأصلي:',
        'session_number' => 'الجلسة #:number',
        'no_title' => 'درس بدون عنوان',
        'unknown_student' => 'طالب غير معروف',
        'empty_date' => '—',
    ],

    'status' => [
        'assigned' => 'مسند',
        'in_progress' => 'قيد التنفيذ',
        'completed' => 'مكتمل',
        'cancelled' => 'ملغى',
    ],

    'empty' => [
        'title' => 'لا توجد دروس للطلاب',
        'description' => 'لا توجد حاليًا دروس للطلاب تطابق معايير البحث أو التصفية المحددة.',
    ],
],

'student_lesson_create' => [

    'page_title' => 'إنشاء درس للطالب',

    'header' => [
        'education' => 'التعليم',
        'student_lessons' => 'دروس الطلاب',
        'create' => 'إنشاء',

        'title' => 'إنشاء درس للطالب',

        'description' => 'اختر الطالب ثم اختر الحجز المدفوع والمؤكد الذي سيتم إنشاء الجلسة ضمنه.',
    ],

    'actions' => [
        'back' => 'العودة إلى دروس الطلاب',
        'cancel' => 'إلغاء',
        'create' => 'إنشاء درس للطالب',
    ],

    'validation' => [
        'title' => 'يرجى تصحيح الأخطاء التالية:',
    ],

    'student_booking' => [
        'section_label' => 'الطالب والحجز',
        'title' => 'الطالب والحجز',
        'description' => 'اختر الطالب ثم اختر حجزًا مدفوعًا ومؤكدًا.',

        'student' => [
            'label' => 'الطالب',
            'placeholder' => 'اختر الطالب',
        ],

        'booking' => [
            'label' => 'حجز الطالب',
            'placeholder_initial' => 'اختر الطالب أولًا',
            'placeholder' => 'اختر الحجز المدفوع والمؤكد',

            'remaining' => 'جلسة متبقية',
            'remaining_plural' => 'جلسات متبقية',

            'unpaid' => 'غير مدفوع',
            'unconfirmed' => 'غير مؤكد',
            'no_remaining' => 'لا توجد جلسات متبقية',

            'empty_initial' => 'اختر الطالب لعرض الحجوزات المدفوعة والمؤكدة.',
            'empty_no_bookings' => 'لا يوجد لهذا الطالب حجز مدفوع ومؤكد يحتوي على جلسات متبقية.',
        ],
    ],

    'booking_details' => [
        'title' => 'تفاصيل الحجز',

        'total_sessions' => 'إجمالي الجلسات',
        'created_sessions' => 'الجلسات المنشأة',
        'remaining' => 'المتبقي',

        'payment' => 'الدفع:',
        'booking_status' => 'حالة الحجز:',

        'payment_status' => [
            'undefined' => 'غير محدد',
            'paid' => 'مدفوع',
            'approved' => 'معتمد',
            'pending' => 'قيد الانتظار',
            'unpaid' => 'غير مدفوع',
            'failed' => 'فشل الدفع',
            'cancelled' => 'ملغي',
        ],

        'status' => [
            'undefined' => 'غير محدد',
            'pending' => 'قيد الانتظار',
            'confirmed' => 'مؤكد',
            'approved' => 'معتمد',
            'active' => 'نشط',
            'completed' => 'مكتمل',
            'cancelled' => 'ملغي',
            'rejected' => 'مرفوض',
        ],
    ],

    'session' => [
        'label' => 'رقم الجلسة',
        'placeholder' => 'سيتم حسابه تلقائيًا',
        'help' => 'إذا تركته فارغًا سيتم إنشاء رقم الجلسة التالي تلقائيًا داخل الحجز.',
    ],

    'source_lesson' => [
        'label' => 'الدرس العام',
        'optional' => 'اختياري',
        'without_lesson' => 'بدون درس عام',
        'help' => 'يمكنك اختيار درس عام كمصدر لمحتوى درس الطالب، أو تركه فارغًا إذا كان الدرس خاصًا بالحجز.',
    ],

    'lesson_data' => [
        'section_label' => 'بيانات الدرس',
        'title' => 'بيانات الدرس',
        'description' => 'أدخل المعلومات التي ستظهر للطالب.',

        'title_field' => [
            'label' => 'عنوان درس الطالب',
            'placeholder' => 'أدخل عنوان الدرس الخاص بالطالب',
        ],

        'description_field' => [
            'label' => 'وصف الدرس',
            'placeholder' => 'أدخل وصفًا للدرس الخاص بالطالب...',
        ],

        'status' => [
            'label' => 'حالة الدرس',
            'assigned' => 'مسند',
            'in_progress' => 'قيد التنفيذ',
            'completed' => 'مكتمل',
            'cancelled' => 'ملغي',
        ],

        'assigned_at' => [
            'label' => 'تاريخ الإسناد',
        ],

        'notes' => [
            'label' => 'ملاحظات',
            'placeholder' => 'أضف ملاحظات خاصة بهذا الدرس...',
        ],

        'active' => [
            'title' => 'الدرس نشط',
            'description' => 'اجعل الدرس ظاهرًا ومتاحًا للطالب.',
        ],
    ],

    'submit' => [
        'invalid_booking' => 'يجب اختيار حجز مدفوع ومؤكد ويحتوي على جلسات متبقية.',
        'creating' => 'جارٍ إنشاء الدرس...',
    ],

],

'student_lesson_show' => [
    'page_title' => 'تفاصيل درس الطالب',

    'header' => [
        'dashboard' => 'لوحة التحكم',
        'student_lessons' => 'دروس الطلاب',
        'current' => 'تفاصيل الدرس',
        'title' => 'تفاصيل درس الطالب',
        'description' => 'عرض تفاصيل الدرس المسند إلى الطالب ومعلوماته وحالته.',
    ],

    'actions' => [
        'back' => 'العودة إلى دروس الطلاب',
        'manage_content' => 'إدارة المحتوى',
        'edit' => 'تعديل الدرس',
        'start' => 'بدء الدرس',
        'complete' => 'إكمال الدرس',
        'cancel' => 'إلغاء الدرس',
        'delete' => 'حذف',
    ],

    'student' => [
        'title' => 'معلومات الطالب',
        'description' => 'بيانات الطالب المرتبط بهذا الدرس.',
        'name' => 'الاسم',
        'email' => 'البريد الإلكتروني',
        'phone' => 'الهاتف',
        'unknown' => 'لا يوجد طالب مرتبط بهذا الدرس.',
    ],

    'lesson' => [
        'title' => 'معلومات الدرس',
        'description' => 'تفاصيل الدرس العام الذي تم إسناده للطالب.',
        'number' => 'رقم الدرس',
        'slug' => 'الرابط المختصر',
        'description_label' => 'وصف الدرس',
        'not_found' => 'لا يوجد درس عام مرتبط بهذا الدرس.',
    ],

    'student_lesson' => [
        'title' => 'درس الطالب',
        'description' => 'النسخة الخاصة بهذا الطالب من الدرس.',
        'lesson_title' => 'عنوان الدرس',
        'number' => 'رقم درس الطالب',
        'session_number' => 'رقم الجلسة',
        'status' => 'الحالة',
        'active' => 'نشط',
        'inactive' => 'غير نشط',
        'description_label' => 'وصف الدرس',
    ],

    'assignment' => [
        'title' => 'معلومات الإسناد',
        'description' => 'تفاصيل عملية إسناد الدرس إلى الطالب.',
        'number' => 'رقم الإسناد',
        'status' => 'حالة الإسناد',
        'date' => 'تاريخ الإسناد',
        'not_found' => 'لا يوجد سجل إسناد مرتبط بهذا الدرس.',

        'statuses' => [
            'assigned' => 'مسند',
            'in_progress' => 'قيد التنفيذ',
            'completed' => 'مكتمل',
            'cancelled' => 'ملغي',
            'canceled' => 'ملغي',
        ],
    ],

    'booking' => [
        'title' => 'معلومات الحجز',
        'description' => 'بيانات الحجز المرتبط بهذا الدرس.',
        'number' => 'رقم الحجز',
        'status' => 'حالة الحجز',
        'scheduled_at' => 'الموعد',
        'not_found' => 'لا يوجد حجز مرتبط بهذا الدرس.',

        'statuses' => [
            'pending' => 'قيد الانتظار',
            'confirmed' => 'مؤكد',
            'completed' => 'مكتمل',
            'cancelled' => 'ملغي',
            'canceled' => 'ملغي',
        ],
    ],

    'status' => [
        'title' => 'حالة الدرس',
        'description' => 'الحالة الحالية لدرس الطالب.',
        'pending' => 'قيد الانتظار',
        'assigned' => 'مسند',
        'in_progress' => 'قيد التنفيذ',
        'completed' => 'مكتمل',
        'cancelled' => 'ملغي',
        'canceled' => 'ملغي',
    ],

    'dates' => [
        'title' => 'تواريخ الدرس',
        'description' => 'أهم التواريخ المرتبطة بهذا الدرس.',
        'assigned_at' => 'تاريخ الإسناد',
        'started_at' => 'تاريخ البدء',
        'completed_at' => 'تاريخ الإكمال',
        'empty' => 'لم يتم تسجيل أي تواريخ لهذا الدرس بعد.',
    ],

    'notes' => [
        'title' => 'الملاحظات',
        'description' => 'الملاحظات الإضافية المرتبطة بهذا الدرس.',
    ],

    'content' => [
        'title' => 'محتوى الدرس',
        'description' => 'المحتوى المتاح لهذا الدرس الخاص بالطالب.',
        'default_title' => 'محتوى الدرس',
        'not_found' => 'لا يوجد محتوى متاح لهذا الدرس حاليًا.',

        'types' => [
            'text' => 'نص',
            'video' => 'فيديو',
            'audio' => 'صوت',
            'image' => 'صورة',
            'file' => 'ملف',
            'quiz' => 'اختبار',
            'link' => 'رابط',
        ],
    ],

    'management' => [
        'title' => 'إجراءات الدرس',
        'description' => 'إدارة الحالة الحالية للدرس.',
        'confirm_cancel' => 'هل أنت متأكد من رغبتك في إلغاء هذا الدرس؟',
        'confirm_delete' => 'هل أنت متأكد من رغبتك في حذف درس الطالب نهائيًا؟',
    ],
],

'student_lesson_edit' => [

    'page_title' => 'تعديل درس الطالب',

    'header' => [
        'dashboard' => 'لوحة التحكم',
        'student_lessons' => 'دروس الطلاب',
        'current' => 'تعديل',
        'title' => 'تعديل درس الطالب',
        'description' => 'قم بتحديث بيانات درس الطالب وتعديل إعداداته.',
    ],

    'actions' => [
        'view' => 'عرض الدرس',
        'back' => 'العودة إلى دروس الطلاب',
        'cancel' => 'إلغاء',
        'save' => 'حفظ التغييرات',
    ],

    'validation' => [
        'title' => 'يرجى تصحيح الأخطاء التالية:',
    ],

    'form' => [
        'title' => 'بيانات درس الطالب',
        'description' => 'قم بتعديل البيانات الأساسية الخاصة بهذا الدرس.',
    ],

    'fields' => [
        'student' => 'الطالب',
        'source_lesson' => 'الدرس المصدر',
        'title' => 'العنوان',
        'description' => 'الوصف',
        'status' => 'الحالة',
        'assigned_at' => 'تاريخ ووقت التعيين',
        'notes' => 'الملاحظات',
    ],

    'placeholders' => [
        'student' => 'اختر الطالب',
        'lesson' => 'اختر الدرس المصدر',
        'title' => 'أدخل عنوان الدرس...',
        'description' => 'أدخل وصفًا مختصرًا للدرس...',
        'notes' => 'أضف ملاحظات خاصة بهذا الدرس...',
    ],

    'hints' => [
        'title' => 'يمكن تعديل عنوان درس الطالب بشكل مستقل عن عنوان الدرس المصدر.',
        'description' => 'يمكنك إضافة وصف خاص بهذا الدرس للطالب.',
        'notes' => 'هذه الملاحظات خاصة بالإدارة ويمكن استخدامها لمتابعة الدرس.',
    ],

    'statuses' => [
        'pending' => 'قيد الانتظار',
        'assigned' => 'مُعيّن',
        'in_progress' => 'قيد التنفيذ',
        'completed' => 'مكتمل',
        'cancelled' => 'ملغى',
    ],

    'active' => [
        'title' => 'الدرس نشط',
        'description' => 'سيكون هذا الدرس متاحًا ونشطًا للطالب.',
    ],

    'current_info' => [
        'title' => 'المعلومات الحالية',
        'description' => 'معلومات الدرس الحالية قبل التعديل.',
        'student_lesson_number' => 'رقم درس الطالب',
        'source_lesson' => 'الدرس المصدر',
        'created_at' => 'تاريخ الإنشاء',
        'updated_at' => 'آخر تحديث',
        'started_at' => 'بدأ في',
        'completed_at' => 'اكتمل في',
    ],

    'assignment' => [
        'title' => 'التعيين',
        'description' => 'حالة ارتباط درس الطالب بالتعيين.',
        'number' => 'التعيين',
        'connected' => 'هذا الدرس مرتبط بتعيين.',
        'not_found' => 'لا يوجد تعيين مرتبط بهذا الدرس.',
    ],

    'source_notice' => [
        'title' => 'الدرس المصدر',
        'description' => 'هذا الدرس مرتبط بالدرس العام المحدد كمصدر. يمكنك تغيير المصدر من النموذج أعلاه.',
    ],

    'warning' => [
        'title' => 'تنبيه',
        'description' => 'تغيير الطالب أو الدرس المصدر قد يؤثر على ارتباطات هذا الدرس ومحتواه.',
    ],

    'preview' => [
        'no_description' => 'لا يوجد وصف لهذا الدرس.',
        'original_description' => 'وصف الدرس الأصلي',
    ],
],

'student_lesson_content' => [

    'page_title' => 'محتوى الدرس',

    'header' => [
        'student_lessons' => 'دروس الطالب',
        'content' => 'المحتوى',
        'title' => 'محتوى الدرس',
        'description' => 'إدارة المحتوى التعليمي المتاح داخل هذا الدرس المخصص للطالب.',
    ],

    'actions' => [
        'back_to_lesson' => 'العودة إلى الدرس',
        'add_content' => 'إضافة محتوى',
        'add_first_content' => 'إضافة أول محتوى',
    ],

    'content' => [
        'default_title' => 'درس الطالب',
        'count_one' => 'عنصر',
        'count_many' => 'عناصر',
        'source_label' => 'الدرس العام المصدر',
        'untitled' => 'محتوى بدون عنوان',
    ],

    'status' => [
        'active' => 'نشط',
        'inactive' => 'غير نشط',
    ],

    'actions_item' => [
        'view' => 'عرض المحتوى',
        'edit' => 'تعديل المحتوى',
        'delete' => 'حذف المحتوى',
    ],

    'empty' => [
        'title' => 'لا يوجد محتوى بعد',
        'description' => 'لا يحتوي هذا الدرس المخصص للطالب على أي محتوى حتى الآن. يمكنك إضافة محتوى تعليمي يدويًا.',
    ],

    'delete' => [
        'confirm' => 'هل أنت متأكد من رغبتك في حذف هذا المحتوى؟',
    ],

],

'student_lesson_content_create' => [

    'page_title' => 'إضافة محتوى الدرس',

    'header' => [
        'student_lessons' => 'دروس الطلاب',
        'content' => 'المحتوى',
        'add' => 'إضافة',
        'title' => 'إضافة محتوى للدرس',
        'description' => 'أضف محتوى تعليمياً إلى درس هذا الطالب.',
    ],

    'actions' => [
        'back_to_content' => 'العودة إلى المحتوى',
        'cancel' => 'إلغاء',
        'save' => 'حفظ المحتوى',
    ],

    'source_lesson' => [
        'title' => 'الدرس العام المصدر',
        'description' => 'يمكنك استخدام محتوى الدرس العام كمصدر لهذا الدرس الخاص بالطالب.',
    ],

    'form' => [
        'type' => [
            'label' => 'نوع المحتوى',
            'placeholder' => 'اختر نوع المحتوى',
            'text' => 'نص',
            'image' => 'صورة',
            'link' => 'رابط',
            'file' => 'ملف',
        ],

        'title' => [
            'label' => 'العنوان',
            'placeholder' => 'عنوان المحتوى',
        ],

        'description' => [
            'label' => 'الوصف',
            'placeholder' => 'وصف مختصر للمحتوى...',
        ],

        'content' => [
            'label' => 'المحتوى النصي',
            'placeholder' => 'اكتب محتوى الدرس هنا...',
            'help' => 'يستخدم هذا الحقل عندما يكون نوع المحتوى نصاً.',
        ],

        'url' => [
            'label' => 'الرابط',
            'placeholder' => 'https://example.com',
            'help' => 'يستخدم هذا الحقل عندما يكون نوع المحتوى رابطاً.',
        ],

        'file' => [
            'label' => 'الملف',
            'help' => 'يستخدم هذا الحقل عند إضافة صورة أو ملف.',
        ],

        'sort_order' => [
            'label' => 'ترتيب العرض',
        ],

        'status' => [
            'label' => 'الحالة',
            'active' => 'نشط',
            'inactive' => 'غير نشط',
        ],
    ],

    'type_info' => [
        'text' => 'سيتم عرض المحتوى النصي مباشرة داخل درس الطالب.',
        'link' => 'أضف الرابط الذي يجب على الطالب فتحه للوصول إلى هذا المحتوى.',
        'image' => 'ارفع صورة ليتم عرضها ضمن محتوى الدرس.',
        'file' => 'ارفع ملفاً يمكن للطالب الوصول إليه من داخل الدرس.',
    ],

],

'student_lesson_content_show' => [
    'page_title' => 'عرض محتوى الدرس',

    'header' => [
        'student_lessons' => 'دروس الطلاب',
        'student_lesson_default' => 'درس الطالب',
        'content' => 'المحتوى',
        'title' => 'عرض محتوى الدرس',
        'description' => 'عرض المحتوى التعليمي المرتبط بهذا الدرس المخصص للطالب.',
    ],

    'actions' => [
        'back_to_content' => 'العودة إلى المحتوى',
        'edit_content' => 'تعديل المحتوى',
        'edit' => 'تعديل',
        'delete' => 'حذف',
    ],

    'types' => [
        'text' => 'نص',
        'image' => 'صورة',
        'link' => 'رابط',
        'file' => 'ملف',
        'default' => 'محتوى',
    ],

    'file' => [
        'units' => [
            'megabyte' => 'ميجابايت',
            'kilobyte' => 'كيلوبايت',
            'byte' => 'بايت',
        ],
        'default_name' => 'ملف مرفق',
        'open' => 'فتح الملف',
    ],

    'content' => [
        'untitled' => 'محتوى بدون عنوان',
        'type_label' => 'نوع المحتوى:',
    ],

    'status' => [
        'active' => 'نشط',
        'inactive' => 'غير نشط',
    ],

    'sections' => [
        'description' => 'الوصف',
        'text_content' => 'نص المحتوى',
        'image' => 'الصورة',
        'link' => 'الرابط',
        'attached_file' => 'الملف المرفق',
        'original_content' => 'المحتوى الأصلي',
        'content_information' => 'معلومات المحتوى',
    ],

    'empty' => [
        'no_text_title' => 'لا يوجد نص',
        'no_text_description' => 'لم تتم إضافة نص لهذا المحتوى.',

        'no_image_title' => 'لا توجد صورة',
        'no_image_description' => 'لم يتم إرفاق صورة بهذا المحتوى.',

        'no_link_title' => 'لا يوجد رابط',
        'no_link_description' => 'لم تتم إضافة رابط لهذا المحتوى.',

        'no_file_title' => 'لا يوجد ملف',
        'no_file_description' => 'لم يتم إرفاق ملف بهذا المحتوى.',
    ],

    'image' => [
        'default_alt' => 'صورة المحتوى',
    ],

    'source' => [
        'label' => 'منسوخ من الدرس العام',
        'untitled' => 'محتوى أصلي بدون عنوان',
        'note' => 'تمت إضافة هذا المحتوى إلى درس الطالب من محتوى الدرس العام.',
    ],

    'meta' => [
        'type' => 'النوع',
        'sort_order' => 'ترتيب المحتوى',
        'status' => 'الحالة',
        'file_name' => 'اسم الملف',
        'mime_type' => 'نوع الملف',
        'file_size' => 'حجم الملف',
    ],

    'delete' => [
        'confirm' => 'هل أنت متأكد من حذف هذا المحتوى؟',
    ],
],

'student_lesson_content_edit' => [
    'page_title' => 'تعديل محتوى الدرس',

    'header' => [
        'education' => 'التعليم',
        'student_lessons' => 'دروس الطلاب',
        'content' => 'المحتوى',
        'edit' => 'تعديل',
        'title' => 'تعديل محتوى الدرس',
        'description' => 'قم بتحديث هذا المحتوى، ويمكنك أيضًا إضافة عدة عناصر جديدة من المحتوى.',
    ],

    'actions' => [
        'back_to_content' => 'العودة إلى المحتوى',
        'cancel' => 'إلغاء',
        'save_changes' => 'حفظ التغييرات',
        'saving' => 'جاري الحفظ...',
    ],

    'form' => [
        'information' => [
            'title' => 'معلومات المحتوى',
            'description' => 'تعديل المحتوى الحالي.',
        ],

        'title' => [
            'label' => 'العنوان',
            'placeholder' => 'أدخل عنوان المحتوى...',
        ],

        'type' => [
            'label' => 'نوع المحتوى',
            'text' => 'نص',
            'image' => 'صورة',
            'link' => 'رابط',
            'file' => 'ملف',
        ],

        'sort_order' => [
            'label' => 'ترتيب العرض',
            'placeholder' => 'تلقائي',
        ],

        'type_info' => [
            'label' => 'نوع المحتوى:',
            'description' => 'اختر ما إذا كان محتوى الدرس نصًا، أو صورة، أو رابطًا خارجيًا، أو ملفًا.',
        ],

        'description' => [
            'label' => 'الوصف',
            'placeholder' => 'أضف وصفًا مختصرًا لهذا المحتوى...',
        ],

        'content' => [
            'label' => 'المحتوى',
            'placeholder' => 'اكتب محتوى الدرس هنا...',
        ],

        'url' => [
            'label' => 'الرابط',
            'placeholder' => 'https://example.com/...',
        ],

        'file' => [
            'label' => 'استبدال الملف',
            'kilobyte' => 'كيلوبايت',
        ],

        'image' => [
            'label' => 'استبدال الصورة',
            'current' => 'الصورة الحالية:',
            'preview_alt' => 'معاينة الصورة الجديدة',
        ],

        'status' => [
            'label' => 'الحالة',
            'active_description' => 'المحتوى نشط ويظهر للطالب',
        ],
    ],

    'additional_content' => [
        'title' => 'إضافة محتوى آخر',
        'description' => 'يمكنك إضافة عدة عناصر جديدة من المحتوى قبل الحفظ.',
        'add_item' => 'إضافة عنصر محتوى',
        'new_item' => 'محتوى جديد',
        'remove' => 'حذف هذا المحتوى',
        'empty' => 'لم تتم إضافة أي محتوى إضافي بعد.',
        'type' => 'النوع',
        'title_label' => 'العنوان',
        'title_placeholder' => 'عنوان المحتوى...',
        'description_label' => 'الوصف',
        'description_placeholder' => 'الوصف...',
        'content_label' => 'المحتوى',
        'content_placeholder' => 'المحتوى...',
        'url_label' => 'الرابط',
        'file_label' => 'ملف / صورة',
    ],

    'sidebar' => [
        'lesson_information' => 'معلومات الدرس',
        'lesson' => 'الدرس',
        'student_lesson' => 'درس الطالب',
        'identifier' => 'المعرف',
        'student' => 'الطالب',
        'content_number' => 'رقم المحتوى',
        'type' => 'النوع',
        'order' => 'الترتيب',

        'source_content' => 'المحتوى الأصلي',
        'source' => 'المحتوى المصدر',
        'original_content' => 'المحتوى الأصلي',

        'editing_tips' => 'نصائح التعديل',
        'tip_edit' => 'يمكنك تعديل المحتوى الحالي بشكل طبيعي.',
        'tip_replace' => 'عند رفع صورة أو ملف بديل، سيتم استبدال الملف القديم فعليًا.',
        'tip_add' => 'استخدم إضافة عنصر محتوى لإضافة عدة عناصر جديدة في عملية حفظ واحدة.',
        'tip_storage' => 'يتم تخزين الملفات والصور الجديدة داخل:',

        'danger_zone' => 'منطقة الخطر',
        'danger_description' => 'حذف هذا المحتوى نهائي ولا يمكن التراجع عنه.',
        'delete_content' => 'حذف المحتوى',
    ],

    'delete' => [
        'confirm' => 'هل أنت متأكد من رغبتك في حذف هذا المحتوى؟',
    ],
],

'students' => [

    'page_title' => 'الطلاب',

    'header' => [
        'eyebrow' => 'إدارة الطلاب',
        'title' => 'الطلاب',
        'description' => 'إدارة الطلاب المسجلين ومتابعة بياناتهم وحالاتهم التعليمية والاعتمادية.',
    ],

    'actions' => [
        'add_student' => 'إضافة طالب',
        'view' => 'عرض الطالب',
        'edit' => 'تعديل الطالب',
        'delete' => 'حذف الطالب',
        'activate' => 'تفعيل الحساب',
        'deactivate' => 'تعطيل الحساب',
    ],

    'statistics' => [
        'total' => [
            'label' => 'إجمالي الطلاب',
            'description' => 'جميع الطلاب المسجلين',
        ],
        'active' => [
            'label' => 'الطلاب النشطون',
            'description' => 'حسابات نشطة',
        ],
        'pending' => [
            'label' => 'بانتظار الاعتماد',
            'description' => 'طلبات تحتاج إلى مراجعة',
        ],
        'approved' => [
            'label' => 'الطلاب المعتمدون',
            'description' => 'حسابات معتمدة',
        ],
        'goals' => [
            'label' => 'أهداف تعليمية',
            'description' => 'طلاب لديهم هدف تعليمي',
        ],
        'inactive' => [
            'label' => 'غير نشط',
            'description' => 'حسابات غير نشطة',
        ],
    ],

    'filters' => [
        'tools' => 'أدوات البحث',
        'title' => 'البحث والتصفية',
        'reset' => 'إعادة ضبط',

        'search' => [
            'label' => 'البحث',
            'placeholder' => 'ابحث باسم الطالب أو البريد أو الهاتف...',
        ],

        'account_status' => [
            'label' => 'حالة الحساب',
            'all' => 'جميع الحالات',
            'active' => 'نشط',
            'inactive' => 'غير نشط',
        ],

        'approval_status' => [
            'label' => 'حالة الاعتماد',
            'all' => 'جميع حالات الاعتماد',
            'pending' => 'بانتظار الاعتماد',
            'approved' => 'معتمد',
            'rejected' => 'مرفوض',
        ],

        'education_level' => [
            'label' => 'المستوى التعليمي',
            'all' => 'جميع المستويات',
        ],

        'sort' => [
            'label' => 'الترتيب',
            'latest' => 'الأحدث',
            'oldest' => 'الأقدم',
            'name_asc' => 'الاسم من أ إلى ي',
            'name_desc' => 'الاسم من ي إلى أ',
        ],

        'apply' => 'تطبيق',
    ],

    'table' => [
        'eyebrow' => 'قائمة الطلاب',
        'title' => 'الطلاب المسجلون',
        'count' => ':count طالب',

        'student' => 'الطالب',
        'email' => 'البريد الإلكتروني',
        'phone' => 'الهاتف',
        'level' => 'المستوى',
        'approval_status' => 'حالة الاعتماد',
        'account_status' => 'حالة الحساب',
        'registered_at' => 'تاريخ التسجيل',
        'actions' => 'الإجراءات',

        'student_role' => 'طالب',
        'no_name' => 'بدون اسم',
        'empty_value' => '—',
    ],

    'statuses' => [
        'approval' => [
            'approved' => 'معتمد',
            'rejected' => 'مرفوض',
            'pending' => 'بانتظار الاعتماد',
        ],

        'account' => [
            'active' => 'نشط',
            'inactive' => 'غير نشط',
        ],
    ],

    'empty' => [
        'title' => 'لا يوجد طلاب',
        'description' => 'لم يتم العثور على طلاب مطابقين لمعايير البحث الحالية.',
        'show_all' => 'عرض جميع الطلاب',
    ],

    'pagination' => [
        'showing' => 'عرض',
        'to' => 'إلى',
        'of' => 'من',
        'student' => 'طالب',
    ],

    'confirm' => [
        'delete' => 'هل أنت متأكد من حذف هذا الطالب؟ لا يمكن التراجع عن هذه العملية.',
    ],
],

'students_create' => [

    'page_title' => 'إضافة طالب',

    'header' => [
        'back' => 'العودة إلى الطلاب',
        'eyebrow' => 'إدارة الطلاب',
        'title' => 'إضافة طالب جديد',
        'description' => 'إضافة طالب جديد إلى النظام وإدخال بياناته الأساسية ومعلوماته التعليمية وبيانات حسابه.',
    ],

    'validation' => [
        'title' => 'يرجى تصحيح الأخطاء التالية:',
    ],

    'basic' => [
        'eyebrow' => 'المعلومات الأساسية',
        'title' => 'بيانات الطالب',
    ],

    'education' => [
        'eyebrow' => 'المعلومات التعليمية',
        'title' => 'بيانات التعليم',
    ],

    'account' => [
        'eyebrow' => 'معلومات الحساب',
        'title' => 'بيانات تسجيل الدخول',
    ],

    'fields' => [

        'name' => [
            'label' => 'اسم الطالب',
            'placeholder' => 'أدخل اسم الطالب الكامل',
        ],

        'email' => [
            'label' => 'البريد الإلكتروني',
            'placeholder' => 'example@email.com',
        ],

        'phone' => [
            'label' => 'رقم الهاتف',
            'placeholder' => '05xxxxxxxx',
        ],

        'whatsapp' => [
            'label' => 'رقم واتساب',
            'placeholder' => '9665xxxxxxxx',
        ],

        'whatsapp_reminders' => [
            'label' => 'تفعيل تذكيرات واتساب',
            'description' => 'يمكن استخدام هذا الخيار لإرسال التذكيرات المرتبطة بالدروس والحجوزات مستقبلًا.',
        ],

        'education_level' => [
            'label' => 'المستوى التعليمي',
            'placeholder' => 'مثال: مبتدئ، متوسط، متقدم',
        ],

        'learning_goal' => [
            'label' => 'الهدف التعليمي',
            'placeholder' => 'اكتب الهدف الذي يريد الطالب تحقيقه من خلال التعلم...',
        ],

        'password' => [
            'label' => 'كلمة المرور',
            'placeholder' => 'أدخل كلمة مرور للطالب',
            'description' => 'يجب أن تتكون كلمة المرور من 8 أحرف أو أرقام على الأقل.',
        ],

        'password_confirmation' => [
            'label' => 'تأكيد كلمة المرور',
            'placeholder' => 'أعد إدخال كلمة المرور',
        ],

        'password_note' => 'سيتم إنشاء حساب للطالب باستخدام كلمة المرور التي تحددها هنا. ويمكن للطالب لاحقًا تغيير كلمة المرور الخاصة به من إعدادات حسابه.',
    ],

    'status' => [

        'eyebrow' => 'حالة الحساب',
        'title' => 'تفعيل الطالب',

        'active' => [
            'label' => 'حساب نشط',
            'description' => 'عند إنشاء الطالب من لوحة الإدارة سيتم اعتماده تلقائيًا، ويمكنك تعطيل الحساب إذا أردت من خلال صفحة التعديل.',
        ],

    ],

    'approval' => [

        'eyebrow' => 'اعتماد الطالب',
        'title' => 'حالة التسجيل',

        'auto_approved_title' => 'الطالب معتمد تلقائيًا',

        'auto_approved_description' => 'الطلاب الذين يتم إنشاؤهم مباشرة من لوحة الإدارة يتم تسجيلهم بحالة',

        'approved' => 'معتمد',

        'auto_approved_suffix' => 'تلقائيًا، ولا يحتاجون إلى إجراء اعتماد إضافي.',

    ],

    'actions' => [
        'cancel' => 'إلغاء',
        'submit' => 'إضافة الطالب',
    ],

],

'students_show' => [

    'page_title' => 'تفاصيل الطالب',

    'header' => [
        'back' => 'العودة إلى الطلاب',
        'eyebrow' => 'إدارة الطلاب',
        'title' => 'تفاصيل الطالب',
        'description' => 'عرض معلومات الطالب وبيانات التواصل وحالة الاعتماد والحجوزات الخاصة به.',
    ],

    'actions' => [
        'edit' => 'تعديل الطالب',
    ],

    'temporary_password' => [
        'title' => 'كلمة المرور المؤقتة',
        'message' => 'تم إنشاء كلمة مرور مؤقتة للطالب:',
        'note' => 'احتفظ بها بشكل آمن وشاركها مع الطالب عند الحاجة.',
    ],

    'profile' => [
        'role' => 'طالب',
        'no_name' => 'بدون اسم',
    ],

    'info' => [
        'email' => 'البريد الإلكتروني',
        'phone' => 'رقم الهاتف',
        'whatsapp' => 'واتساب',
        'education_level' => 'المستوى التعليمي',
        'approval_status' => 'حالة اعتماد الطالب',
        'registered_at' => 'تاريخ التسجيل',
    ],

    'statistics' => [
        'bookings' => 'إجمالي الحجوزات',
        'level' => 'المستوى',
        'account_status' => 'حالة الحساب',
        'approval_status' => 'حالة الاعتماد',
    ],

    'statuses' => [

        'account' => [
            'active' => 'نشط',
            'inactive' => 'غير نشط',
        ],

        'approval' => [
            'approved' => 'معتمد',
            'pending' => 'بانتظار الاعتماد',
            'rejected' => 'مرفوض',
            'unknown' => 'غير محددة',
        ],

        'whatsapp' => [
            'active' => 'مفعلة',
            'inactive' => 'غير مفعلة',
        ],

    ],

    'common' => [
        'not_specified' => 'غير محدد',
    ],

    'details' => [

        'eyebrow' => 'المعلومات الشخصية',
        'title' => 'بيانات الطالب',

        'fields' => [
            'full_name' => 'الاسم الكامل',
            'email' => 'البريد الإلكتروني',
            'phone' => 'رقم الهاتف',
            'whatsapp' => 'رقم واتساب',
            'whatsapp_reminders' => 'تذكيرات واتساب',
            'education_level' => 'المستوى التعليمي',
            'approval_status' => 'حالة اعتماد الطالب',
            'registered_at' => 'تاريخ التسجيل',
            'updated_at' => 'آخر تحديث',
            'account_status' => 'حالة الحساب',
        ],

    ],

    'learning_goal' => [

        'eyebrow' => 'الهدف التعليمي',
        'title' => 'ما الذي يريد الطالب تعلمه؟',
        'empty' => 'لم يقم الطالب بتحديد هدف تعليمي حتى الآن.',

    ],

    'approval' => [

        'eyebrow' => 'حالة التسجيل',
        'title' => 'حالة اعتماد الطالب',

        'current_status' => 'الحالة الحالية',
        'account_status' => 'حالة الحساب',
        'description_label' => 'وصف الحالة',

        'account_active' => 'الحساب نشط',
        'account_inactive' => 'الحساب غير نشط',

        'descriptions' => [
            'approved' => 'يمكن للطالب استخدام حسابه باعتباره طالبًا معتمدًا.',
            'pending' => 'طلب الطالب ما زال بانتظار مراجعة واعتماد الإدارة.',
            'rejected' => 'تم رفض طلب تسجيل الطالب.',
            'unknown' => 'لم يتم تحديد حالة اعتماد للطالب.',
        ],

    ],

    'bookings' => [

        'eyebrow' => 'الحجوزات',
        'title' => 'حجوزات الطالب',
        'count_label' => 'حجز',

        'booking_number' => 'حجز #:id',
        'details' => 'تفاصيل الحجز',

        'view_all' => 'عرض جميع الحجوزات',

        'status' => [
            'confirmed' => 'مؤكد',
            'pending' => 'قيد الانتظار',
            'cancelled' => 'ملغي',
            'completed' => 'مكتمل',
            'no_show' => 'لم يحضر',
        ],

        'empty' => [
            'title' => 'لا توجد حجوزات',
            'description' => 'لم يقم هذا الطالب بإجراء أي حجز حتى الآن.',
        ],

    ],

    'footer' => [
        'back' => 'العودة إلى قائمة الطلاب',
        'edit' => 'تعديل بيانات الطالب',
    ],

],

'student_edit' => [

    'page_title' => 'تعديل الطالب',

    'header' => [
        'back_to_student' => 'العودة إلى تفاصيل الطالب',
        'eyebrow' => 'إدارة الطلاب',
        'title' => 'تعديل بيانات الطالب',
        'description' => 'تعديل البيانات الأساسية والمعلومات التعليمية وحالة حساب الطالب واعتماده.',
    ],

    'student_id' => [
        'label' => 'رقم الطالب',
    ],

    'validation' => [
        'title' => 'يرجى تصحيح الأخطاء التالية:',
    ],

    'basic' => [
        'section_label' => 'المعلومات الأساسية',
        'title' => 'بيانات الطالب',
    ],

    'fields' => [

        'name' => [
            'label' => 'اسم الطالب',
            'placeholder' => 'أدخل اسم الطالب الكامل',
        ],

        'email' => [
            'label' => 'البريد الإلكتروني',
            'placeholder' => 'example@email.com',
        ],

        'phone' => [
            'label' => 'رقم الهاتف',
            'placeholder' => '05xxxxxxxx',
        ],

        'whatsapp' => [
            'label' => 'رقم واتساب',
            'placeholder' => '05xxxxxxxx',
        ],

        'whatsapp_reminders' => [
            'label' => 'تذكيرات واتساب',
            'toggle' => 'تفعيل التذكيرات',
            'description' => 'السماح بإرسال تذكيرات الحصص والحجوزات عبر واتساب.',
        ],

        'education_level' => [
            'label' => 'المستوى التعليمي',
            'placeholder' => 'مثال: مبتدئ، متوسط، متقدم',
        ],

        'learning_goal' => [
            'label' => 'الهدف التعليمي',
            'placeholder' => 'اكتب الهدف الذي يريد الطالب تحقيقه من خلال التعلم...',
        ],

    ],

    'education' => [
        'section_label' => 'المعلومات التعليمية',
        'title' => 'بيانات التعليم',
    ],

    'approval' => [

        'section_label' => 'حالة اعتماد الطالب',
        'title' => 'اعتماد الحساب',
        'status_label' => 'حالة الطالب',

        'statuses' => [
            'pending' => 'قيد الانتظار',
            'approved' => 'معتمد',
            'rejected' => 'مرفوض',
        ],

        'info' => [

            'approved' => [
                'title' => 'الطالب معتمد',
                'description' => 'تم اعتماد حساب الطالب ويمكنه استخدام الخدمات المسموح بها للحساب.',
            ],

            'rejected' => [
                'title' => 'الطالب مرفوض',
                'description' => 'تم رفض طلب تسجيل الطالب.',
            ],

            'pending' => [
                'title' => 'الطالب بانتظار الاعتماد',
                'description' => 'لم يتم اعتماد طلب الطالب حتى الآن.',
            ],

        ],

    ],

    'account' => [
        'section_label' => 'حالة الحساب',
        'title' => 'تفعيل الطالب',
        'active_title' => 'حساب نشط',
        'active_description' => 'عند تعطيل الحساب لن يتمكن الطالب من استخدام الخدمات المرتبطة بالحساب.',
    ],

    'password' => [
        'section_label' => 'أمان الحساب',
        'title' => 'تغيير كلمة المرور',
        'new_password' => 'كلمة المرور الجديدة',
        'password_placeholder' => 'اتركها فارغة للإبقاء على الحالية',
        'confirm_password' => 'تأكيد كلمة المرور',
        'confirm_placeholder' => 'أعد كتابة كلمة المرور الجديدة',
        'note' => 'اترك حقلي كلمة المرور فارغين إذا كنت لا تريد تغيير كلمة المرور الحالية.',
    ],

    'actions' => [
        'cancel' => 'إلغاء',
        'save' => 'حفظ التعديلات',
    ],

],




];

