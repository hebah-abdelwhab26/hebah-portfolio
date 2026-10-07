<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Education Admin Translations
    |--------------------------------------------------------------------------
    |
    | All translations for the Education Admin Panel.
    |
    */


    /*
    |--------------------------------------------------------------------------
    | Admin Authentication
    |--------------------------------------------------------------------------
    */

    'admin_auth' => [

        'page_title' =>
            'Admin Login | Hebah Education',

        'brand_name' =>
            'Hebah',

        'brand_subtitle' =>
            'Quran & Arabic Language',

        'admin_panel' =>
            'Admin Panel',

        'welcome' =>
            'Welcome',

        'description' =>
            'Sign in to manage the education section and bookings.',

        'email' =>
            'Email Address',

        'email_placeholder' =>
            'education@hebahgift.com',

        'password' =>
            'Password',

        'password_placeholder' =>
            'Enter your password',

        'show_password' =>
            'Show password',

        'hide_password' =>
            'Hide password',

        'remember_me' =>
            'Remember me',

        'login' =>
            'Sign In',

        'back_to_education' =>
            'Back to Education Website',

        'all_rights_reserved' =>
            'All rights reserved.',

    ],

    /*
    |--------------------------------------------------------------------------
    | Availabilities
    |--------------------------------------------------------------------------
    */

    'availabilities' => [

        'page_title' =>
            'Available Times',

        'eyebrow' =>
            'Schedule Management',

        'title' =>
            'Available Times',

        'description' =>
            'Manage the booking times available to students throughout the week.',

        'add_time' =>
            'Add Available Time',

        'total_times' =>
            'Total Times',

        'active_times' =>
            'Active Times',

        'inactive_times' =>
            'Inactive Times',

        'week_days' =>
            'Week Days',

        'schedule_title' =>
            'Time Schedule',

        'schedule_description' =>
            'All time periods that students can choose when making a booking.',

        'day' =>
            'Day',

        'time' =>
            'Time',

        'description_label' =>
            'Description',

        'sort_order' =>
            'Order',

        'status' =>
            'Status',

        'actions' =>
            'Actions',

        'day_number' =>
            'Day :day',

        'duration_minutes' =>
            ':minutes minutes',

        'no_description' =>
            'No description',

        'available' =>
            'Available',

        'unavailable' =>
            'Unavailable',

        'delete_confirmation' =>
            'Are you sure you want to delete this available time?',

        'empty_title' =>
            'No Available Times',

        'empty_description' =>
            'No booking times have been added yet.',

        'add_first_time' =>
            'Add First Time',

    ],


    /*
    |--------------------------------------------------------------------------
    | Common Admin Actions
    |--------------------------------------------------------------------------
    */

    'common' => [

        'operation_success' =>
            'Operation completed successfully',

        'operation_failed' =>
            'Unable to complete the operation',

        'view' =>
            'View',

        'edit' =>
            'Edit',

        'delete' =>
            'Delete',

    ],

    /*
|--------------------------------------------------------------------------
| Availabilities - Create
|--------------------------------------------------------------------------
*/

'availabilities_create' => [

    'page_title' =>
        'Add Available Time',

    'eyebrow' =>
        'Schedule Management',

    'title' =>
        'Add Available Time',

    'description' =>
        'Add a new time period that students can choose when making a booking.',

    'back_to_availabilities' =>
        'Back to Available Times',

    'review_data' =>
        'Please review the submitted data',

    'form_title' =>
        'Appointment Details',

    'form_description' =>
        'Select the day and time period that will be available for booking.',

    'day' =>
        'Day',

    'select_day' =>
        'Select Day',

    'days' => [
        0 => 'Sunday',
        1 => 'Monday',
        2 => 'Tuesday',
        3 => 'Wednesday',
        4 => 'Thursday',
        5 => 'Friday',
        6 => 'Saturday',
    ],

    'start_time' =>
        'Start Time',

    'end_time' =>
        'End Time',

    'label' =>
        'Appointment Description',

    'optional' =>
        'Optional',

    'label_placeholder' =>
        'Example: Evening Session',

    'sort_order' =>
        'Display Order',

    'sort_order_hint' =>
        'Lower numbers appear first within the day.',

    'status_title' =>
        'Appointment Status',

    'status_description' =>
        'When enabled, this time will appear among the available times for students.',

    'available' =>
        'Available',

    'cancel' =>
        'Cancel',

    'save' =>
        'Save Time',

    'note_title' =>
        'Note',

    'note_description' =>
        'You can add more than one time period on the same day. For example, you can add a morning and an evening appointment on Monday. You can also temporarily disable any appointment without deleting it.',

],

/*
|--------------------------------------------------------------------------
| Availability - Show
|--------------------------------------------------------------------------
*/

'availability_show' => [

    'page_title' =>
        'Available Time Details',

    'title' =>
        'Available Time Details',

    'description' =>
        'View and manage appointment details.',

    'back' =>
        'Back',

    'edit' =>
        'Edit',

    'appointment_information' =>
        'Appointment Information',

    'active' =>
        'Active',

    'inactive' =>
        'Inactive',

    'day' =>
        'Day',

    'display_order' =>
        'Display Order',

    'status' =>
        'Status',

    'available_for_booking' =>
        'Available for Booking',

    'stopped' =>
        'Stopped',

    'appointment_description' =>
        'Appointment Description',

    'note' =>
        'Note',

    'system_information' =>
        'System Information',

    'appointment_number' =>
        'Appointment Number',

    'created_at' =>
        'Created At',

    'updated_at' =>
        'Last Updated',

    'day_numeric' =>
        'Day Number',

    'danger_zone' =>
        'Danger Zone',

    'delete_description' =>
        'Deleting this time will remove it from the list of times available for administration and booking. Make sure it is no longer needed before deleting it.',

    'delete_confirmation' =>
        'Are you sure you want to delete this available time?',

    'delete_time' =>
        'Delete Time',

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
        'Edit Available Time',

    'title' =>
        'Edit Available Time',

    'description' =>
        'Edit appointment details for appointment #:id.',

    'back' =>
        'Back',

    'view' =>
        'View',

    'review_data' =>
        'Please review the following data:',

    'form_title' =>
        'Available Time Details',

    'form_description' =>
        'You can edit the day, time, status, and display order.',

    'day' =>
        'Day',

    'select_day' =>
        'Select Day',

    'days' => [
        0 => 'Sunday',
        1 => 'Monday',
        2 => 'Tuesday',
        3 => 'Wednesday',
        4 => 'Thursday',
        5 => 'Friday',
        6 => 'Saturday',
    ],

    'display_order' =>
        'Display Order',

    'display_order_placeholder' =>
        'Example: 1',

    'display_order_help' =>
        'Used to determine the order in which times appear in the admin panel and booking page.',

    'appointment_time' =>
        'Appointment Time',

    'time_help' =>
        'The end time must be after the start time.',

    'label' =>
        'Appointment Description',

    'label_placeholder' =>
        'Example: Evening time suitable for students',

    'label_help' =>
        'An optional description shown to the administration and potentially used later on the booking page.',

    'activate_time' =>
        'Activate This Time',

    'activate_description' =>
        'When enabled, this time can be used among the available booking times.',

    'current_active' =>
        'Appointment is currently active',

    'current_inactive' =>
        'Appointment is currently inactive',

    'cancel' =>
        'Cancel',

    'save_changes' =>
        'Save Changes',

],

'booking_types' => [

    'page_title' => 'Booking Types',
    'title' => 'Booking Types',
    'description' => 'Manage individual sessions, educational packages, prices, and session counts.',
    'add_booking_type' => 'Add Booking Type',

    'table' => [
        'id' => '#',
        'name' => 'Booking Type',
        'category' => 'Category',
        'price' => 'Price',
        'sessions' => 'Sessions',
        'duration' => 'Duration',
        'status' => 'Status',
        'sort_order' => 'Order',
        'actions' => 'Actions',
    ],

    'category' => [
        'package' => 'Package',
        'single' => 'Single Session',
    ],

    'duration_minutes' => ':minutes minutes',

    'status' => [
        'active' => 'Active',
        'inactive' => 'Inactive',
    ],

    'actions' => [
        'view_details' => 'View Details',
        'edit' => 'Edit',
        'delete' => 'Delete',
    ],

    'delete_confirmation' => 'Are you sure you want to delete this booking type?',

    'empty' => [
        'title' => 'No Booking Types',
        'description' => 'No booking types have been created yet.',
        'add_first' => 'Add First Booking Type',
    ],
],

'booking_types_create' => [

    'page_title' => 'Add New Booking Type',

    'header' => [
        'title' => 'Add New Booking Type',
        'description' => 'Create a new educational session or package that students can book.',
        'back' => 'Back to Booking Types',
    ],

    'validation' => [
        'review' => 'Please review the following data:',
    ],

    'basic_information' => [
        'title' => 'Basic Information',
        'description' => 'Information that will be shown to the student when choosing a booking type.',
    ],

    'fields' => [
        'name' => 'Booking Type Name',
        'slug' => 'Slug',
        'icon' => 'Icon',
        'currency' => 'Currency',
        'description' => 'Description',
        'price' => 'Price',
        'total_sessions' => 'Number of Sessions',
        'session_duration' => 'Session Duration',
        'sort_order' => 'Display Order',
    ],

    'required' => '*',

    'optional' => '(Optional)',

    'placeholders' => [
        'name' => 'Example: Private Quran Session',
        'slug' => 'Example: quran-private',
        'icon' => 'fa-solid fa-book-quran',
        'currency' => 'SAR',
        'description' => 'Write a short description for the booking type or package...',
        'price' => '0.00',
        'session_duration' => '60',
    ],

    'help' => [
        'slug' => 'If left empty, it will be generated automatically from the booking name.',
        'icon' => 'You can use any Font Awesome icon.',
        'currency' => 'A 3-letter currency code, such as SAR.',
        'total_sessions' => 'One session means an individual session; more than one session means a package.',
        'sort_order' => 'Lower numbers appear first.',
    ],

    'price_sessions' => [
        'title' => 'Price & Sessions',
        'description' => 'Set the price, number of sessions, and duration of each session.',
        'currency_unit' => 'SAR',
        'minutes_unit' => 'minutes',
    ],

    'status' => [
        'title' => 'Booking Type Status',
        'description' => 'Choose whether this booking type is available to students.',
        'active' => 'Booking Type Is Active',
        'active_description' => 'It will appear to students and they can select it when creating a new booking.',
    ],

    'actions' => [
        'cancel' => 'Cancel',
        'save' => 'Save Booking Type',
    ],
],

'booking_type_show' => [

    'page_title' => 'Booking Type Details',
    'description' => 'Booking type details and settings',

    'edit' => 'Edit',
    'back_to_list' => 'Back to List',

    'basic_information' => 'Basic Information',
    'booking_type_name' => 'Booking Type Name',
    'slug' => 'Slug',
    'price' => 'Price',
    'total_sessions' => 'Number of Sessions',
    'session_duration' => 'Session Duration',
    'minutes' => 'minutes',
    'not_specified' => 'Not Specified',
    'sort_order' => 'Display Order',

    'status' => 'Status',
    'active' => 'Active',
    'inactive' => 'Inactive',

    'description_title' => 'Description',
    'no_description' => 'No description has been added for this booking type.',

    'related_bookings_count' => 'Related Bookings',

    'booking_type' => 'Booking Type',

    'can_delete_description' => 'You can delete this booking type because it is not currently associated with any bookings.',

    'cannot_delete_description' => 'This booking type cannot be deleted because it is associated with existing bookings. You can disable it instead.',

    'delete_confirmation' => 'Are you sure you want to delete this booking type?',

    'delete_booking_type' => 'Delete Booking Type',
],

'booking_type_edit' => [

    'page_title' => 'Edit Booking Type',
    'title' => 'Edit Booking Type',
    'description' => 'Edit booking type details:',
    'back_to_booking_types' => 'Back to Booking Types',

    'form_title' => 'Booking Type Details',
    'form_description' => 'Edit the required information and save your changes.',

    'booking_type_name' => 'Booking Type Name',

    'slug' => 'Slug',
    'slug_help' => 'You can leave it blank and it will be generated automatically.',

    'description_label' => 'Description',
    'description_placeholder' => 'Write a short description of the booking type...',

    'icon' => 'Icon',
    'icon_help' => 'Example:',
    'icon_example' => 'Font Awesome icon:',

    'price' => 'Price',
    'currency' => 'Currency',

    'total_sessions' => 'Number of Sessions',
    'total_sessions_help' => '1 = single session, more than 1 = package.',

    'session_duration' => 'Session Duration in Minutes',

    'sort_order' => 'Display Order',

    'status_title' => 'Booking Type Status',
    'active_type' => 'Booking Type Is Active',
    'active_type_description' => 'Allows students to select it when creating a new booking.',

    'save_changes' => 'Save Changes',
    'view_type' => 'View Type',
    'cancel' => 'Cancel',
],

'bookings' => [

    'page_title' => 'Bookings',
    'eyebrow' => 'Education Management',
    'title' => 'Bookings',
    'description' => 'Manage and monitor all lesson booking requests.',

    'total_bookings' => 'Total Bookings',
    'pending' => 'Pending',
    'confirmed' => 'Confirmed',
    'completed' => 'Completed',
    'cancelled' => 'Cancelled',

    'search' => 'Search',
    'search_placeholder' => 'Student name, email, or booking type...',
    'booking_status' => 'Booking Status',
    'all_statuses' => 'All Statuses',
    'no_show' => 'No Show',

    'payment_status' => 'Payment Status',
    'unpaid' => 'Unpaid',
    'under_review' => 'Under Review',
    'paid' => 'Paid',
    'payment_failed' => 'Payment Failed',
    'payment_failed_short' => 'Failed',
    'refunded' => 'Refunded',

    'date' => 'Date',
    'search_button' => 'Search',
    'reset' => 'Reset',

    'booking_record' => 'Booking Records',
    'all_requests' => 'All Requests',
    'booking_count' => 'Booking',

    'student' => 'Student',
    'student_initial' => 'S',
    'booking_type' => 'Booking Type',
    'time' => 'Time',
    'price' => 'Price',
    'status' => 'Status',
    'payment' => 'Payment',
    'actions' => 'Actions',

    'package' => 'Package',
    'single_lesson' => 'Single Lesson',
    'sessions' => 'Sessions',

    'unknown_student' => 'Unknown Student',
    'educational_booking' => 'Educational Booking',

    'proof_uploaded' => 'Proof Uploaded',
    'rejected' => 'Rejected',
    'proof_approved' => 'Proof Approved',

    'details' => 'Details',
    'confirm_booking' => 'Confirm Booking',
    'cancel_booking' => 'Cancel Booking',

    'confirm_booking_question' => 'Do you want to confirm this booking?',
    'cancel_booking_question' => 'Do you want to cancel this booking?',

    'empty_title' => 'No Bookings',
    'empty_description' => 'No bookings match the current search criteria.',
    'show_all_bookings' => 'Show All Bookings',

],

'bookings_show' => [

    'page_title' => 'Booking Details',
    'eyebrow' => 'Booking Management',
    'title' => 'Booking Details',
    'description' => 'Review student, lesson, and payment details and update the booking status.',
    'back_to_bookings' => 'Back to Bookings',

    'booking' => 'Booking',
    'booking_information' => 'Booking Information',
    'booking_status' => 'Booking Status',
    'payment_status' => 'Payment Status',
    'booking_value' => 'Booking Value',

    'status_pending' => 'Pending',
    'status_confirmed' => 'Confirmed',
    'status_completed' => 'Completed',
    'status_cancelled' => 'Cancelled',
    'status_no_show' => 'No Show',

    'payment_unpaid' => 'Unpaid',
    'payment_pending' => 'Under Review',
    'payment_paid' => 'Paid',
    'payment_failed' => 'Payment Failed',
    'payment_refunded' => 'Refunded',

    'student' => 'Student',
    'student_information' => 'Student Information',
    'student_initial' => 'S',
    'unknown_student' => 'Unknown',
    'send_email' => 'Send Email',

    'booking_type' => 'Booking Type',
    'lesson_package_details' => 'Lesson & Package Details',
    'educational_booking' => 'Educational Booking',

    'total_sessions' => 'Total Sessions',
    'completed_sessions' => 'Completed Sessions',
    'remaining_sessions' => 'Remaining Sessions',

    'appointment' => 'Appointment',
    'lesson_date_time' => 'Lesson Date & Time',
    'date' => 'Date',
    'time' => 'Time',

    'student_note' => 'Student Note',
    'booking_notes' => 'Booking Notes',

    'administration' => 'Administration',
    'admin_note' => 'Admin Note',
    'admin_note_placeholder' => 'Add a private note for the administration...',
    'save_note' => 'Save Note',

    'booking_management' => 'Booking Management',
    'lesson_status' => 'Lesson Status',

    'confirm_booking' => 'Confirm Booking',
    'confirm_booking_question' => 'Do you want to confirm this booking?',

    'mark_completed' => 'Mark Lesson as Completed',
    'complete_booking_question' => 'Do you want to mark this lesson as completed?',

    'mark_no_show' => 'Mark as No Show',
    'no_show_question' => 'Do you want to mark the student as absent?',

    'cancel_booking' => 'Cancel Booking',
    'cancel_booking_question' => 'Do you want to cancel this booking?',

    'payment' => 'Payment',
    'payment_information' => 'Payment Information',
    'status' => 'Status',
    'method' => 'Method',
    'not_registered' => 'Not Registered',
    'reference_number' => 'Reference Number',
    'payment_date' => 'Payment Date',

    'payment_proof' => 'Payment Proof',
    'student_receipt' => 'Student Receipt',
    'file' => 'File',
    'receipt_submitted' => 'Submitted',
    'payment_under_review' => 'Under Review',
    'receipt_approved' => 'Approved',
    'receipt_rejected' => 'Rejected',
    'view_payment_proof' => 'View Payment Proof',

    'start_review' => 'Start Review',
    'approve_payment' => 'Approve Payment',
    'approve_payment_question' => 'Do you want to approve the payment proof?',
    'reject_payment_proof' => 'Reject Payment Proof',

    'payment_method' => 'Payment Method',
    'bank_transfer' => 'Bank Transfer',
    'payment_method_placeholder' => 'Example: Bank Transfer',

    'transaction_reference' => 'Transaction / Reference Number',
    'reference_placeholder' => 'Transfer or reference number',

    'payment_note' => 'Payment Note',
    'payment_note_placeholder' => 'A private note about the payment...',

    'confirm_payment_received' => 'Confirm Payment Received',
    'confirm_payment_received_question' => 'Do you want to mark the payment as paid?',

    'set_payment_pending' => 'Set Payment Under Review',
    'set_payment_unpaid' => 'Set as Unpaid',

    'mark_payment_failed' => 'Mark Payment as Failed',
    'mark_payment_failed_question' => 'Do you want to mark the payment as failed?',

    'refund_payment' => 'Record Refund',
    'refund_payment_question' => 'Do you want to mark the booking amount as refunded?',

    'financial_information' => 'Financial Information',
    'payment_summary' => 'Payment Summary',
    'booking_price' => 'Booking Price',
    'reference' => 'Reference',
    'received_at' => 'Received At',

    'additional_information' => 'Additional Information',
    'booking_data' => 'Booking Data',
    'booking_number' => 'Booking Number',
    'created_at' => 'Created At',
    'updated_at' => 'Last Updated',
    'reminder' => 'Reminder',
    'reminder_sent' => 'Sent',
    'reminder_not_sent' => 'Not Sent',

    'back_to_all_bookings' => 'Back to All Bookings',

    'rejection_reason_prompt' => 'Please enter the reason for rejecting the payment proof:',
    'rejection_reason_required' => 'You must enter a reason for rejecting the payment proof.',

],

'comments' => [
    'page_title' => 'Comments',
    'title' => 'Comments',
    'description' => 'Manage public comments submitted by website visitors.',

    'total_comments' => 'Total Comments',
    'pending_review' => 'Pending Review',
    'published' => 'Published',
    'rejected' => 'Rejected',

    'search' => 'Search',
    'search_placeholder' => 'Search by name, email, or comment text',
    'status' => 'Status',
    'all_statuses' => 'All Statuses',
    'filter' => 'Filter',

    'comment_author' => 'Comment Author',
    'comment' => 'Comment',
    'date' => 'Date',
    'actions' => 'Actions',

    'publish' => 'Publish',
    'reject' => 'Reject',
    'edit' => 'Edit',
    'delete' => 'Delete',

    'delete_confirmation' => 'Are you sure you want to delete this comment?',

    'empty' => 'No comments match the search criteria.',

    'edit_page_title' => 'Edit Comment',
'edit_page_description' => 'You can edit the comment details and status before publishing it.',
'name' => 'Name',
'email' => 'Email',
'comment_status' => 'Comment Status',
'save_changes' => 'Save Changes',
'back_to_comments' => 'Back to Comments',
],

'contact_messages' => [
    'page_title' => 'Contact Messages',
    'title' => 'Contact Messages',
    'description' => 'Manage and monitor incoming messages from website visitors and students.',

    'total_messages' => 'Total Messages',
    'new_messages' => 'New Messages',
    'read_messages' => 'Read Messages',
    'replied_messages' => 'Replied Messages',

    'inbox' => 'Message Inbox',
    'latest_messages' => 'Latest Incoming Messages',
    'message_count' => 'Messages',

    'sender' => 'Sender',
    'email' => 'Email',
    'subject' => 'Subject',
    'status' => 'Status',
    'date' => 'Date',
    'actions' => 'Actions',

    'new' => 'New',
    'status_new' => 'New',
    'status_read' => 'Read',
    'status_replied' => 'Replied',

    'view_message' => 'View Message',
    'delete_message' => 'Delete Message',
    'delete_confirmation' => 'Are you sure you want to delete this message?',

    'empty_title' => 'No Messages Yet',
    'empty_description' => 'Contact messages will appear here when they are received.',

    'close' => 'Close',
],

'contact_messages_show' => [
'page_title' => 'View Contact Message',
'title' => 'View Contact Message',
'description' => 'Message details and sender information',

'back' => 'Back',
'delete' => 'Delete',
'delete_confirmation' => 'Are you sure you want to delete this message?',
'close' => 'Close',

'sender_data' => 'Sender Information',
'sender_role' => 'Message Sender',

'email' => 'Email',
'subject' => 'Subject',
'sent_at' => 'Sent At',
'message_status' => 'Message Status',

'status_new' => 'New',
'status_read' => 'Read',
'status_replied' => 'Replied',

'read_at' => 'Read At',
'replied_at' => 'Replied At',

'message_actions' => 'Message Actions',
'mark_replied' => 'Mark as "Replied"',
'reopen' => 'Reopen Message',
'reply_by_email' => 'Reply via Email',

'message_content' => 'Message Content',
'message_subject' => 'Message Subject',
'message_text' => 'Message Text',
'reply_to' => 'Reply to',

],

'conversations' => [
'page_title' => 'Conversations',
'education_management' => 'Education Management',
'title' => 'Conversations',
'description' => 'Manage and monitor conversations received from education students.',

'start_new' => 'Start New Conversation',
'total_conversations' => 'Total Conversations',
'all_conversations' => 'All Conversations',

'subject' => 'Subject',
'student' => 'Student',
'last_message' => 'Last Message',
'status' => 'Status',
'last_update' => 'Last Update',
'actions' => 'Actions',

'untitled_conversation' => 'Untitled Conversation',
'unknown_student' => 'Unknown Student',

'attachment' => 'Attachment',
'message' => 'Message',
'no_messages' => 'No Messages',

'open' => 'Open',
'closed' => 'Closed',

'view' => 'View',
'delete' => 'Delete',
'delete_confirmation' => 'Are you sure you want to delete this conversation? All related messages and attachments will be permanently deleted and this action cannot be undone.',

'empty_title' => 'No Conversations Yet',
'empty_description' => 'You can start a new conversation with one of the education students.',

],

'conversations_create' => [
'page_title' => 'Start New Conversation',
'education_management' => 'Education Management',
'title' => 'Start New Conversation',
'description' => 'Start a direct conversation with an education student and send the first message.',

'back_to_conversations' => 'Back to Conversations',

'review_data' => 'Please review the following data:',

'conversation_data' => 'Conversation Details',
'conversation_data_description' => 'Select the student and write the first message that will appear in the conversation.',

'student' => 'Student',
'select_student' => 'Select Student',
'no_active_students' => 'There are no active students currently',
'student_help' => 'The conversation will be created and linked to this student.',

'first_message' => 'First Message',
'message_text' => 'Message Text',
'message_placeholder' => 'Write the message you want to send to the student...',
'message_help' => 'The maximum message length is 5,000 characters.',

'start_and_send' => 'Start Conversation & Send Message',
'cancel' => 'Cancel',

],

'conversations_show' => [
'page_title' => 'Conversation',

'back_to_conversations' => 'Back to Conversations',
'educational_conversation' => 'Educational Conversation',
'untitled_conversation' => 'Untitled Conversation',
'conversation_id' => 'Conversation #:id',

'reopen_conversation' => 'Reopen Conversation',
'close_conversation' => 'Close Conversation',
'close_confirmation' => 'Are you sure you want to close this conversation?',

'messages' => 'Messages',
'view_attachment' => 'View Attachment',
'admin' => 'Administration',
'student' => 'Student',
'read' => 'Read',
'no_messages' => 'There are no messages in this conversation yet.',

'send_reply' => 'Send Reply',
'reply_placeholder' => 'Write your reply to the student here...',
'send_message' => 'Send Message',

'closed_notice' => 'This conversation is currently closed. Reopen the conversation to send new messages.',

'conversation_information' => 'Conversation Information',
'unknown_student' => 'Unknown Student',

'status' => 'Status',
'closed' => 'Closed',
'open' => 'Open',

'created_at' => 'Conversation Created At',
'last_message' => 'Last Message',
'none' => 'None',
'message_count' => 'Message Count',

],

'header' => [
    'open_menu' => 'Open Menu',
    'education_panel' => 'Education Panel',
    'dashboard' => 'Dashboard',
    'visit_website' => 'Visit Website',
    'notifications' => 'Notifications',
    'latest_notifications' => 'Latest Notifications',
    'mark_all_read' => 'Mark All as Read',
    'loading_notifications' => 'Loading notifications...',
    'view_all_notifications' => 'View All Notifications',
    'no_notifications' => 'No notifications currently',
    'profile' => 'Profile',
    'profile_description' => 'Manage your account details',
    'notifications_description' => 'View latest notifications',
    'website_description' => 'Open the education website',
    'education_admin' => 'Education Administrator',
    'logout' => 'Log Out',
    'logout_description' => 'Log out of the education panel',
    'language' => 'العربية',
],

'sidebar' => [

    'education_panel' => 'Education Panel',
    'close_menu' => 'Close Menu',

    'education_manager' => 'Education Manager',

    'main' => 'Main',
    'dashboard' => 'Dashboard',

    'education_management' => 'Education Management',
    'bookings' => 'Bookings',
    'booking_types' => 'Booking Types & Packages',
    'students' => 'Students',
    'teachers' => 'Teachers',
    'lessons' => 'Lessons',
    'lesson_assignments' => 'Lesson Assignments',
    'student_lessons' => 'Student Lessons',
    'availabilities' => 'Available Times',

    'quizzes_assessments' => 'Quizzes & Assessment',
    'quizzes' => 'Quizzes',
    'quiz_attempts' => 'Student Attempts',

    'financial_management' => 'Financial Management',
    'payments' => 'Payments',
    'financial_reports' => 'Financial Reports',

    'communication' => 'Communication',
    'contact_messages' => 'Contact Messages',
    'conversations' => 'Conversations',
    'comments' => 'Comments',
    'notifications' => 'Notifications',

    'content' => 'Content',
    'news' => 'News & Announcements',
    'lesson_categories' => 'Lesson Categories',
    'faq' => 'FAQ',
    'reviews' => 'Reviews',

    'system' => 'System',
    'education_settings' => 'Education Settings',
    'admin_account' => 'Admin Account',

    'language' => 'Language',
    'switch_language' => 'Switch Language',
    'visit_website' => 'Visit Website',
    'logout' => 'Log Out',

],



'dashboard' => [

    'title' => 'Dashboard',

    'admin_panel' => 'Admin Panel',

    'welcome' => 'Welcome to the Dashboard',

    'description' => 'Manage students, lessons, packages, bookings, and appointments from one place.',

    'today' => 'Today',

    'status' => [
        'pending' => 'Pending Review',
        'confirmed' => 'Confirmed',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
        'no_show' => 'No Show',
    ],

    'students' => 'Students',
    'total_students' => 'Total Students',

    'bookings' => 'Bookings',
    'total_bookings' => 'Total Bookings',

    'review' => 'Review',
    'pending_bookings' => 'Pending Bookings',

    'student_lessons' => 'Student Lessons',
    'active_lessons' => 'Active Lessons',

    'recent_bookings' => 'Recent Bookings',
    'view_all' => 'View All',

    'student' => 'Student',
    'educational_booking' => 'Educational Booking',

    'no_bookings' => 'No bookings yet',
    'new_bookings_here' => 'New bookings will appear here.',

    'shortcuts' => 'Shortcuts',
    'quick_actions' => 'Quick Actions',

    'manage_bookings' => 'Manage Bookings',
    'manage_bookings_description' => 'View and manage all bookings and packages',

    'manage_student_lessons' => 'Student Lessons',
    'manage_student_lessons_description' => 'Manage assigned lessons for each student and package',

    'education_website' => 'Education Website',
    'open_website' => 'Open Website in New Window',

    'appointments' => 'Appointments',
    'upcoming_bookings' => 'Upcoming Bookings',
    'appointments_count' => 'Appointments',

    'no_upcoming_bookings' => 'No upcoming bookings',
    'upcoming_bookings_here' => 'Upcoming appointments will appear here after bookings are created.',

],

'lesson_assignments' => [

    'page_title' => 'Lesson Assignments',

    'breadcrumb_management' => 'Education Management',

    'breadcrumb_assignments' => 'Lesson Assignments',

    'title' => 'Lesson Assignments',

    'description' => 'Manage lessons assigned to students and track their progress.',

    'assign_lesson' => 'Assign Lesson',

    'statistics' => [

        'total' => 'Total Assignments',

        'assigned' => 'Assigned',

        'in_progress' => 'In Progress',

        'completed' => 'Completed',

    ],

    'filters' => [

        'search_placeholder' => 'Search by student name or lesson title...',

        'all_statuses' => 'All Statuses',

        'assigned' => 'Assigned',

        'in_progress' => 'In Progress',

        'completed' => 'Completed',

        'search' => 'Search',

        'reset' => 'Reset',

    ],

    'table' => [

        'title' => 'Assignments List',

        'description' => 'All lessons assigned to students.',

        'results' => 'Results',

        'student' => 'Student',

        'lesson' => 'Lesson',

        'booking' => 'Booking',

        'status' => 'Status',

        'assigned_at' => 'Assigned At',

        'student_lesson' => 'Student Lesson',

        'actions' => 'Actions',

    ],

    'student' => [

        'unknown' => 'Not Specified',

    ],

    'lesson' => [

        'untitled' => 'Untitled',

        'not_created' => 'Student Lesson Not Created',

        'pending_creation' => 'The assignment exists and is waiting for the student lesson to be created.',

    ],

    'booking' => [

        'without_booking' => 'No Booking',

    ],

    'status' => [

        'assigned' => 'Assigned',

        'in_progress' => 'In Progress',

        'completed' => 'Completed',

        'unknown' => 'Unknown',

    ],

    'student_lesson_status' => [

        'assigned' => 'Assigned',

        'in_progress' => 'In Progress',

        'completed' => 'Completed',

        'cancelled' => 'Cancelled',

        'not_created' => 'Not Created',

        'unknown' => 'Unknown',

    ],

    'actions' => [

        'view_assignment' => 'View Assignment',

        'create_student_lesson' => 'Create Student Lesson',

        'view_student_lesson' => 'View Student Lesson',

    ],

    'empty' => [

        'title' => 'No Assignments',

        'description' => 'No lessons have been assigned to students yet.',

        'assign_new' => 'Assign New Lesson',

    ],

    'create' => [

        'page_title' => 'Assign Lessons to Student',

        'breadcrumb_assignments' => 'Lesson Assignments',

        'breadcrumb_new' => 'Assign New Lessons',

        'title' => 'Assign Lessons to Student',

        'description' => 'Select the student and paid booking, then add the lesson titles you want to assign.',

        'validation_title' => 'Please review the following information:',

        // -----------------------------------------------------
        // Assignment Details
        // -----------------------------------------------------

        'card_title' => 'Assignment Details',

        'card_description' => 'Create lessons specifically for this student and link them to the selected booking.',

        // -----------------------------------------------------
        // Student
        // -----------------------------------------------------

        'student' => [

            'label' => 'Student',

            'help' => 'Select the student to display only their paid bookings.',

            'placeholder' => 'Select Student',

        ],

        // -----------------------------------------------------
        // Booking
        // -----------------------------------------------------

        'booking' => [

            'label' => 'Booking / Package',

            'help' => 'Only bookings with confirmed payments appear here.',

            'placeholder' => 'Select Booking or Package',

            'educational_booking' => 'Educational Booking',

            'package' => 'Package',

            'remaining' => ':count remaining',

            'single' => 'Single Session',

            'no_paid_bookings' => 'No paid bookings are currently available.',

            'sessions_count' => 'Number of sessions: :total — Completed: :completed — Assigned: :assigned',

            'single_booking' => 'Single-session booking',

        ],

        // -----------------------------------------------------
        // Lessons
        // -----------------------------------------------------

        'lessons' => [

            'label' => 'Lesson Titles',

            'help' => 'Enter the title of the lesson the student needs. These lessons are private to the student and are not linked to the public lessons on the website.',

            'placeholder' => 'Example: Rules of Noon Sakinah',

            'add' => 'Add Lesson',

            'notice_select' => 'Select the student and booking first.',

            'notice_select_booking' => 'Select the student and booking or package first.',

            'available' => 'Available Sessions',

            'remaining_zero' => 'No sessions are available to add a new lesson.',

            'remaining_after' => ':remaining sessions available — after the current selection, :available sessions will remain.',

            'remaining_available' => ':remaining sessions available for adding lessons.',

            'selected_title' => 'Selected Lessons',

            'selected_description' => 'Each title here will become an independent private lesson for the student.',

            'count_one' => ':count Lesson',

            'count_many' => ':count Lessons',

            'empty_title' => 'No Lessons Added',

            'empty_description' => 'Enter the lesson title above, then click “Add Lesson”.',

            'student_lesson_note' => 'Private lesson for the student — content will be added later',

            'remove' => 'Remove Lesson',

        ],

        // -----------------------------------------------------
        // Notes
        // -----------------------------------------------------

        'notes' => [

            'label' => 'Assignment Notes',

            'optional' => 'Optional',

            'placeholder' => 'Add any notes specific to this assignment...',

        ],

        // -----------------------------------------------------
        // Status
        // -----------------------------------------------------

        'active' => 'Lessons are active and accessible to the student.',

        // -----------------------------------------------------
        // Actions
        // -----------------------------------------------------

        'actions' => [

            'cancel' => 'Cancel',

            'save' => 'Assign Lessons',

            'saving' => 'Assigning lessons...',

        ],

        // -----------------------------------------------------
        // Alerts
        // -----------------------------------------------------

        'alerts' => [

            'select_student_first' => 'Please select the student first.',

            'select_booking_first' => 'Please select the booking or package first.',

            'max_sessions' => 'No more lessons can be added. You have reached the number of sessions available for this booking.',

            'duplicate_title' => 'This title has already been added.',

            'select_student' => 'Please select the student.',

            'select_booking' => 'Please select the booking or package.',

            'add_one' => 'Please add at least one lesson.',

        ],

    ],
'show' => [

    'page_title' => 'Lesson Assignment Details',

    'breadcrumb_assignments' => 'Lesson Assignments',

    'assignment_details' => 'Assignment Details',

    'assignment_number' => 'Assignment #:id',

    'lesson' => 'Lesson',

    'description' => 'Manage the student\'s private lesson, content, and evaluation.',

    'back' => 'Back',

    'status' => [
        'label' => 'Assignment Status',
        'assigned' => 'Assigned — Not Started',
        'in_progress' => 'In Progress',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
        'unknown' => 'Unknown',
    ],

    'student' => [
        'title' => 'Student',
        'description' => 'Information about the student associated with this lesson.',
        'unknown' => '—',
    ],

    'student_lesson' => [
        'title' => 'Student Private Lesson',
        'description' => 'The independent lesson associated with this student.',
        'lesson_title' => 'Lesson Title',
        'lesson' => 'Lesson',
        'status' => 'Status',
        'assigned' => 'Assigned',
        'in_progress' => 'In Progress',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
        'unknown' => 'Unknown',
        'content_count' => 'Number of Contents',
        'evaluation' => 'Evaluation',
        'evaluated' => 'Evaluated',
        'not_evaluated' => 'Not Evaluated',
    ],

    'content' => [
        'title' => 'Lesson Content',
        'description' => 'Content specific to this lesson and student only.',
        'untitled' => 'Untitled Content',
        'open_link' => 'Open Link',
        'open_file' => 'Open File',
        'empty_title' => 'No Content Available Yet',
        'empty_description' => 'You can add student-specific content later.',
    ],

    'evaluation' => [
        'title' => 'Student Evaluation',
        'description' => 'Evaluation specific to this lesson.',
        'attendance' => 'Attendance',
        'understanding' => 'Understanding',
        'performance' => 'Performance',
        'memorization' => 'Memorization',
        'tajweed' => 'Tajweed',
        'score' => 'Score',
        'teacher_notes' => 'Teacher Notes',
        'student_feedback' => 'Student Feedback',
        'empty_title' => 'This lesson has not been evaluated yet.',
        'empty_description' => 'The evaluation will appear here once it is added.',
    ],

    'missing_student_lesson' => [
        'title' => 'Student Lesson Has Not Been Created',
        'description' => 'The lesson assignment exists, but the student lesson has not been created yet.',
    ],

    'notes' => [
        'title' => 'Assignment Notes',
        'description' => 'Notes associated with this lesson assignment.',
    ],

    'dates' => [
        'assignment_title' => 'Assignment Dates',
        'assigned_at' => 'Assigned',
        'started_at' => 'Student Started',
        'completed_at' => 'Completed',
        'not_started' => 'Not started yet',
        'not_completed' => 'Not completed yet',
    ],

    'student_lesson_dates' => [
        'title' => 'Lesson Dates',
        'created_at' => 'Lesson Created',
        'started_at' => 'Lesson Started',
        'completed_at' => 'Lesson Completed',
        'not_started' => 'Not started yet',
        'not_completed' => 'Not completed yet',
    ],

    'quick_actions' => [
        'title' => 'Quick Actions',
        'content' => 'Private Lesson Content',
        'evaluation' => 'Student Evaluation',
        'assign_another' => 'Assign Another Lesson',
        'all_assignments' => 'All Assignments',
    ],

],

],
'lessons' => [

    'page_title' => 'Lessons',

    'header_label' => 'Education Management',

    'title' => 'Lessons',

    'description' => 'Manage educational lessons and track their status and information.',

    'add_new' => 'Add New Lesson',

    'common' => [
        'close' => 'Close',
    ],

    'alerts' => [
        'validation_title' => 'Please review the following information:',
    ],

    'statistics' => [
        'total' => 'Page Results',
        'all_lessons' => 'Total Lessons',
        'active' => 'Active Lessons',
        'active_help' => 'Available to students',
        'inactive' => 'Inactive Lessons',
        'inactive_help' => 'Currently unavailable',
    ],

    'filters' => [
        'search' => 'Search',
        'search_placeholder' => 'Search by lesson title...',
        'category' => 'Category',
        'all_categories' => 'All Categories',
        'status' => 'Status',
        'all_statuses' => 'All Statuses',
        'active' => 'Active',
        'inactive' => 'Inactive',
        'sort' => 'Sort Results',
        'newest' => 'Newest First',
        'oldest' => 'Oldest First',
        'title_asc' => 'Title: A - Z',
        'title_desc' => 'Title: Z - A',
        'price_low' => 'Price: Low to High',
        'price_high' => 'Price: High to Low',
        'duration_short' => 'Duration: Shortest First',
        'duration_long' => 'Duration: Longest First',
        'apply' => 'Apply',
        'reset' => 'Reset',
    ],

    'table' => [
        'list' => 'Lessons List',
        'available' => 'Results',
        'count' => 'Count',
        'lesson' => 'Lesson',
        'category' => 'Category',
        'duration' => 'Duration',
        'price' => 'Price',
        'status' => 'Status',
        'sort_order' => 'Sort Order',
        'actions' => 'Actions',
         'lesson_count' => 'Lesson Count',
    ],

    'category' => [
        'not_specified' => 'Not Specified',
    ],

    'duration' => [
        'minute' => 'minute(s)',
        'not_specified' => 'Not Specified',
    ],

    'price' => [
        'free' => 'Free',
    ],

    'status' => [
        'active' => 'Active',
        'inactive' => 'Inactive',
    ],

    'actions' => [
        'view' => 'View Lesson',
        'edit' => 'Edit Lesson',
        'activate' => 'Activate Lesson',
        'deactivate' => 'Deactivate Lesson',
        'delete' => 'Delete Lesson',
        'confirm_delete' => 'Are you sure you want to delete this lesson?',
    ],

    'empty' => [
        'title' => 'No Lessons Found',
        'filtered' => 'No lessons match the current search criteria.',
        'no_lessons' => 'No lessons have been added yet.',
        'add_first' => 'Add First Lesson',
        'show_all' => 'Show All Lessons',
    ],

    'pagination' => [
        'showing' => 'Showing',
        'to' => 'to',
        'of' => 'of',
    ],

    // =========================================================
    // CREATE / ADD LESSON
    // =========================================================

    'create' => [

        'page_title' => 'Add New Lesson',

        'header_label' => 'Lesson Management',

        'title' => 'Add New Lesson',

        'description' => 'Add a new lesson and define its information, price, duration, and status so it can appear on the public website.',

        'back' => 'Back to Lessons',

        'validation_title' => 'Please review the information',

        'basic_information' => 'Basic Information',

        'lesson_data' => 'Lesson Details',

        'title_label' => 'Lesson Title',

        'title_placeholder' => 'Example: Learning Correct Quran Reading',

        'category' => 'Category',

        'category_placeholder' => 'Example: Quran',

        'duration' => 'Lesson Duration',

        'minute' => 'minutes',

        'description_label' => 'Lesson Description',

        'description_placeholder' => 'Write a brief description of the lesson and what the learner will learn...',

        'price_settings' => 'Price & Settings',

        'lesson_settings' => 'Lesson Settings',

        'price' => 'Lesson Price',

        'riyal' => 'SAR',

        'currency' => 'Currency',

        'currencies' => [
            'sar' => 'SAR - Saudi Riyal',
            'usd' => 'USD - US Dollar',
            'eur' => 'EUR - Euro',
        ],

        'sort_order' => 'Display Order',

        'sort_order_help' => 'Used to determine the order in which the lesson appears in the lessons list on the website.',

        'status' => 'Lesson Status',

        'active_lesson' => 'Active Lesson',

        'active_lesson_help' => 'Visible on the public website to visitors.',

        'note_title' => 'Note',

        'note_description' => 'After creating the lesson, you can add its details and educational materials such as text, images, PDF files, links, and evaluations.',

        'cancel' => 'Cancel',

        'save' => 'Save Lesson',

    ],

    // =========================================================
    // SHOW / LESSON DETAILS
    // =========================================================

    'show' => [

        'page_title' => 'Lesson Details',

        'header_label' => 'Lesson Management',

        'description' => 'View the lesson details, information, and educational content.',

        'actions' => [

            'content' => 'Lesson Content',

            'edit' => 'Edit Lesson',

            'back' => 'Back to Lessons',

            'activate' => 'Activate Lesson',

            'deactivate' => 'Deactivate Lesson',

            'delete' => 'Delete Lesson',

            'confirm_delete' => 'Are you sure you want to delete this lesson? This action cannot be undone.',

        ],

        'alerts' => [

            'success_title' => 'Operation Completed Successfully',

            'error_title' => 'Unable to Complete the Operation',

        ],

        'status' => [

            'active' => 'Lesson Is Active',

            'inactive' => 'Lesson Is Inactive',

            'active_description' => 'The lesson is visible on the public website and visitors can view it.',

            'inactive_description' => 'The lesson is currently hidden from the public website.',

        ],

        'statistics' => [

            'duration' => 'Lesson Duration',

            'minute' => 'minute(s)',

            'price' => 'Lesson Price',

            'content' => 'Lesson Content',

            'manage' => 'Manage',

            'sort_order' => 'Display Order',

        ],

        'description_section' => [

            'label' => 'Lesson Overview',

            'title' => 'Lesson Description',

            'empty' => 'No description has been added for this lesson yet.',

        ],

        'content_section' => [

            'label' => 'Lesson Materials',

            'title' => 'Lesson Content',

            'manage_title' => 'Manage Lesson Content',

            'manage_description' => 'Add texts, images, links, and files related to this lesson and arrange them in the order you want them to appear on the website.',

            'open' => 'Open Lesson Content',

        ],

        'public_section' => [

            'label' => 'Public Website',

            'title' => 'Lesson Visibility to Visitors',

            'active_title' => 'Lesson Available on the Public Website',

            'inactive_title' => 'Lesson Hidden from the Public Website',

            'active_description' => 'This lesson is visible to visitors, who can view its details and educational content.',

            'inactive_description' => 'This lesson is currently hidden from visitors while its data and content remain stored inside the admin panel.',

            'available_soon' => 'Available Soon',

            'hidden' => 'Lesson Hidden',

        ],

        'information' => [

            'label' => 'Lesson Information',

            'title' => 'Details',

            'category' => 'Category',

            'not_specified' => 'Not Specified',

            'duration' => 'Duration',

            'price' => 'Price',

            'currency' => 'Currency',

            'slug' => 'Slug',

            'created_at' => 'Created At',

            'updated_at' => 'Last Updated',

        ],

        'quick_actions' => [

            'label' => 'Quick Actions',

            'title' => 'Lesson Management',

            'content_description' => 'Add and manage texts, images, links, and files',

            'edit_description' => 'Edit lesson data and information',

            'deactivate_description' => 'Hide the lesson from the public website',

            'activate_description' => 'Show the lesson on the public website',

            'delete_description' => 'Permanently delete the lesson',

        ],

        'note' => [

            'title' => 'Note',

            'description' => 'When the lesson is activated, it will appear in the educational lessons section on the public website. When deactivated, it will be hidden from visitors while its data and content remain available in the admin panel.',

        ],

    ],

    // =========================================================
    // EDIT LESSON
    // =========================================================

    'edit' => [

        'page_title' => 'Edit Lesson',

        'header_label' => 'Lesson Management',

        'title' => 'Edit Lesson',

        'description' => 'Edit the lesson information, price, duration, and status.',

        'actions' => [

            'view' => 'View Lesson',

            'back' => 'Back to Lessons',

            'cancel' => 'Cancel',

            'save' => 'Save Changes',

        ],

        'alerts' => [

            'validation_title' => 'Please review the information',

        ],

        'summary' => [

            'current_lesson' => 'Current Lesson',

            'active' => 'Active',

            'inactive' => 'Inactive',

        ],

        'basic_information' => [

            'label' => 'Basic Information',

            'title' => 'Lesson Details',

            'lesson_title' => 'Lesson Title',

            'title_placeholder' => 'Example: Learning Correct Quran Reading',

            'category' => 'Category',

            'category_placeholder' => 'Example: Quran',

            'duration' => 'Lesson Duration',

            'minute' => 'minutes',

            'description' => 'Lesson Description',

            'description_placeholder' => 'Write a brief description of the lesson and what the student will learn...',

        ],

        'settings' => [

            'label' => 'Price & Settings',

            'title' => 'Lesson Settings',

            'price' => 'Lesson Price',

            'riyal' => 'SAR',

            'currency' => 'Currency',

            'currencies' => [

                'sar' => 'SAR - Saudi Riyal',

                'usd' => 'USD - US Dollar',

                'eur' => 'EUR - Euro',

            ],

            'sort_order' => 'Display Order',

            'sort_order_help' => 'Used to determine the order in which the lesson appears in the lessons list.',

            'status' => 'Lesson Status',

            'active_lesson' => 'Active Lesson',

            'active_lesson_help' => 'Visible on the public website to visitors.',

        ],

        'information' => [

            'created_at' => 'Created At',

            'updated_at' => 'Last Updated',

            'content' => 'Lesson Content',

            'manage_content' => 'Manage Content',

            'slug' => 'Short URL',

        ],

        'note' => [

            'title' => 'Note',

            'description' => 'If you change the lesson title, a new Slug will be generated automatically to keep the URL correct.',

        ],

    ],

    // =========================================================
    // LESSON CONTENT
    // =========================================================

    'content' => [

        'page_title' => 'Lesson Content',

        'header_label' => 'Lesson Content Management',

        'subtitle' => 'Lesson Content',

        'description' => 'Manage the texts, images, videos, links, and files for this lesson.',

        'actions' => [

            'add' => 'Add Content',

            'back' => 'Back to Lesson',

            'view' => 'View',

            'edit' => 'Edit',

            'disable' => 'Disable',

            'activate' => 'Activate',

            'delete' => 'Delete',

            'confirm_delete' => 'Are you sure you want to delete this content? This action cannot be undone.',

        ],

        'alerts' => [

            'success_title' => 'Operation Completed Successfully',

            'error_title' => 'Unable to Complete the Operation',

            'validation_title' => 'Please Review the Information',

        ],

        'lesson' => [

            'current' => 'Current Lesson',

        ],

        'item' => 'items',

        'statistics' => [

            'total' => 'Total Content',

            'text' => 'Texts',

            'image' => 'Images',

            'video' => 'Videos',

            'link' => 'Links',

            'file' => 'Files',

        ],

        'elements' => [

            'label' => 'Lesson Elements',

            'title' => 'Lesson Content',

        ],

        'types' => [

            'text' => 'Text',

            'image' => 'Image',

            'video' => 'Video',

            'link' => 'Link',

            'file' => 'File',

            'content' => 'Content',

        ],

        'status' => [

            'active' => 'Active',

            'inactive' => 'Inactive',

        ],

        'item_no_title' => 'Untitled',

        'image_alt' => 'Lesson Image',

        'video_not_supported' => 'Your browser does not support video playback.',

        'lesson_file' => 'Lesson File',

        'meta' => [

            'order' => 'Order',

        ],

        'reorder' => [

            'title' => 'Reorder Content',

            'description' => 'Drag the items to change the order in which they appear within the lesson.',

            'save' => 'Save Order',

            'saving' => 'Saving...',

            'saved' => 'Saved',

            'error' => 'An Error Occurred',

        ],

        'empty' => [

            'title' => 'No Content Added to This Lesson Yet',

            'description' => 'Start by adding text, an image, a video, a link, or a file to display it within the lesson content.',

            'add_first' => 'Add First Content',

        ],

        'note' => [

            'title' => 'Note',

            'description' => 'You can arrange the content items in the order you want them to appear to students, and you can temporarily disable any item without deleting it.',

        ],

    ],

    // =========================================================
    // ADD LESSON CONTENT
    // =========================================================

    'content_create' => [

        'page_title' => 'Add Lesson Content',

        'header_label' => 'Lesson Content',

        'title' => 'Add New Content',

        'description' => 'Create multiple educational items inside the lesson and save them all at once.',

        'lesson' => [

            'current' => 'Add Content to Lesson',

        ],

        'old_notice' => 'The information you entered has been preserved because a validation error occurred. For images and files, you must select the file again because browsers do not allow file upload fields to be repopulated automatically.',

        'form' => [

            'label' => 'Build Lesson Content',

            'title' => 'Content Items',

        ],

        'settings' => [

            'title' => 'Lesson Settings',

            'sort_order' => 'Initial Content Order',

            'sort_order_placeholder' => 'Automatically ordered',

            'sort_order_help' => 'If you enter a number, it will be used as the starting order, and the numbers will increase automatically for each item.',

            'note_label' => 'Note',

            'note_description' => 'You can add text, an image, a link, a video, and a file in the same request.',

        ],

        'actions' => [

            'back' => 'Back to Lesson Content',

            'add_item' => 'Add Another Content Item',

            'cancel' => 'Cancel',

            'save' => 'Save All Content Items',

        ],

        'alerts' => [

            'validation_title' => 'Please review the following information:',

        ],

        'help' => [

            'title' => 'Multi-Item Content',

            'description' => 'You can build the lesson from multiple independent items, such as a text explanation, an educational image, a video from YouTube or Google Drive, and a PDF file. All of them are saved within the same lesson. Videos are not uploaded to the website.',

        ],

        'types' => [

            'title' => 'Content Types',

            'text' => [

                'label' => 'Text',

                'title' => 'Text',

                'description' => 'An explanation or educational text displayed directly inside the lesson.',

            ],

            'image' => [

                'label' => 'Image',

                'title' => 'Image',

                'description' => 'An educational image or diagram related to the explanation.',

            ],

            'video' => [

                'label' => 'Video',

                'title' => 'Video',

                'description' => 'A YouTube or Google Drive link that plays inside the lesson page without uploading the video to the website.',

            ],

            'link' => [

                'label' => 'Link',

                'title' => 'Link',

                'description' => 'A standard external link to a website or educational resource.',

            ],

            'file' => [

                'label' => 'File',

                'title' => 'File',

                'description' => 'PDF, Word, Excel, PowerPoint, or ZIP.',

            ],

        ],

        'item' => [

            'title' => 'Content Item',

            'remove' => 'Remove Item',

        ],

        'fields' => [

            'type' => 'Content Type',

            'title' => 'Content Title',

            'title_placeholder' => 'Example: Explanation of Noon Sakinah Rules',

            'sort_order' => 'Display Order',

            'sort_order_placeholder' => 'Automatic',

            'description' => 'Content Description',

            'description_placeholder' => 'Add a brief description for this item...',

            'text_content' => 'Text Content',

            'text_content_placeholder' => 'Write the explanation or educational text here...',

            'video_url' => 'Video URL',

            'video_url_placeholder' => 'https://www.youtube.com/watch?v=... or Google Drive URL',

            'link' => 'Link',

            'link_placeholder' => 'https://example.com/...',

            'image' => 'Image',

            'file' => 'File',

            'publish' => 'Publish this item to students',

            'status_help' => 'The status can be changed later.',

        ],

        'video' => [

            'notice_title' => 'The video will not be uploaded to the website.',

            'notice_description' => 'Enter a YouTube or Google Drive video URL only. It will be converted into a video player inside the lesson page.',

            'preview_title' => 'Video Preview',

        ],

        'upload' => [

            'image_title' => 'Choose Lesson Image',

            'image_description' => 'JPG / JPEG / PNG / WEBP / GIF — up to 10MB',

            'file_title' => 'Choose Lesson File',

            'file_description' => 'PDF / Word / Excel / PowerPoint / ZIP — up to 50MB',

        ],

        'js' => [

            'minimum_item' => 'The lesson must contain at least one content item.',

            'file_too_large' => 'The file ":name" exceeds the allowed size of :sizeMB.',

            'add_at_least_one' => 'Add at least one content item.',

            'complete_required' => 'Please complete all required content item information.',

            'invalid_video' => 'The video URL must be a valid YouTube or Google Drive URL.',

            'saving' => 'Saving content...',

        ],

    ],

    // =========================================================
    // VIEW LESSON CONTENT
    // =========================================================

    'content_show' => [

        'page_title' => 'View Lesson Content',

        'header_label' => 'Lesson Content Management',

        'description' => 'View the details of this content item within the lesson.',

        'untitled' => 'Untitled Content',

        'actions' => [

            'back' => 'Back to Content',

            'edit' => 'Edit Content',

        ],

        'basic_information' => [

            'label' => 'Basic Information',

            'title' => 'Content Details',

            'content_title' => 'Content Title',

            'type' => 'Content Type:',

            'description' => 'Content Description',

        ],

        'content_section' => [

            'label' => 'Content Item',

            'text' => 'Content Text',

            'link' => 'Content Link',

            'video' => 'Video',

            'image' => 'Image',

            'file' => 'File',

        ],

        'types' => [

            'text' => 'Text',

            'image' => 'Image',

            'link' => 'Link',

            'video' => 'Video',

            'file' => 'File',

            'content' => 'Content',

            'unknown' => 'Not Specified',

        ],

        'empty' => [

            'no_text' => 'No text is associated with this content.',

            'no_link' => 'No link is associated with this content.',

            'no_video' => 'No video link is associated with this content.',

            'no_image' => 'No image is associated with this content.',

            'no_file' => 'No file is associated with this content.',

            'unknown_type' => 'Unknown content type.',

        ],

        'video' => [

            'lesson_video' => 'Lesson Video',

            'not_supported' => 'Your browser does not support video playback.',

            'open_original' => 'Open Original Video Link',

        ],

        'image' => [

            'content_image' => 'Content Image',

            'alt' => 'Content Image',

            'current' => 'Current Image',

        ],

        'file' => [

            'content_file' => 'Content File',

            'current' => 'Current File',

            'file' => 'File',

            'view' => 'View File',

        ],

        'settings' => [

            'label' => 'Display Settings',

            'title' => 'Content Status & Order',

            'sort_order' => 'Display Order',

            'status' => 'Content Status',

            'active' => 'Active Content',

            'inactive' => 'Inactive Content',

        ],

        'type_card' => [

            'label' => 'Item Type',

            'title' => 'Current Type',

            'text' => 'Text Content',

            'image' => 'Image',

            'link' => 'External Link',

            'video' => 'Video',

            'file' => 'File',

            'unknown' => 'Unknown Type',

        ],

        'actions_card' => [

            'label' => 'Actions',

            'title' => 'Content Management',

        ],

        'delete' => [

            'title' => 'Delete Content Item',

            'description' => 'This item will be permanently deleted and cannot be restored.',

            'confirm' => 'Are you sure you want to delete this content item? This action cannot be undone.',

            'button' => 'Delete Content',

        ],

        'note' => [

            'title' => 'Note',

            'description' => 'You can edit this item at any time, and you can replace the associated image or file from the edit page.',

        ],

    ],

    // =========================================================
    // EDIT LESSON CONTENT
    // =========================================================

    'content_edit' => [

        'page_title' => 'Edit Lesson Content',

        'header_label' => 'Lesson Content',

        'title' => 'Edit Lesson Content',

        'description' => 'Edit the current content item and update it within the lesson. You can also change the content type after it has been created.',

        'common' => [

            'required' => 'Required',

            'optional' => 'Optional',

            'or' => 'or',

        ],

        'actions' => [

            'back' => 'Back to Content',

            'save_section' => 'Save Changes',

            'title' => 'Actions',

            'save' => 'Save Changes',

            'cancel' => 'Cancel',

        ],

        'alerts' => [

            'success_title' => 'Operation Completed Successfully',

            'validation_title' => 'Please Review the Information',

        ],

        'basic_information' => [

            'label' => 'Basic Information',

            'title' => 'Content Details',

            'type' => 'Content Type',

            'content_title' => 'Content Title',

            'description' => 'Content Description',

        ],

        'types' => [

            'text' => 'Text',

            'image' => 'Image',

            'link' => 'Link',

            'file' => 'File',

            'video' => 'Video',

            'content' => 'Content',

            'text_summary' => 'Text Content',

            'image_summary' => 'Image',

            'link_summary' => 'External Link',

            'file_summary' => 'File',

            'video_summary' => 'Video',

        ],

        'type_help' => 'You can change the content type after it has been created. When switching to an image or file, you will need to upload the appropriate file. Videos use a video URL.',

        'type_change_warning' => [

            'title' => 'The Content Type Will Be Changed',

            'description' => 'The data associated with the previous type will be removed when you save the changes.',

        ],

        'placeholders' => [

            'title' => 'Example: Lesson Explanation or Lecture File',

            'description' => 'Write a brief description of this content item...',

            'text' => 'Write the lesson content here...',

        ],

        'content_section' => [

            'label' => 'Content Item',

            'content' => 'Content',

        ],

        'text' => [

            'content' => 'Text Content',

            'help' => 'You can write the lesson explanation or educational notes here.',

        ],

        'link' => [

            'label' => 'Content Link',

            'help' => 'Enter the full link you want to share with students.',

        ],

        'image' => [

            'current' => 'Current Image',

            'content_image' => 'Content Image',

            'replace' => 'Replace Image',

            'choose_new' => 'Choose a New Image',

            'help' => 'If you are editing an existing image, leave this field empty to keep it. If you change the content type to image, you must upload a new image.',

        ],

        'file' => [

            'current' => 'Current File',

            'replace' => 'Replace File',

            'choose_new' => 'Choose a New File',

            'type' => 'File',

            'view' => 'View',

            'help' => 'If you are editing an existing file, leave this field empty to keep it. If you change the content type to file, you must upload a new file.',

        ],

        'upload' => [

            'max_10mb' => 'Maximum 10MB',

            'max_50mb' => 'Maximum 50MB',

        ],

        'video' => [

            'current' => 'Current Video',

            'current_link' => 'Current Video Link',

            'open' => 'Open Video',

            'url' => 'Video URL',

            'help' => 'Enter the full video URL. The system supports YouTube, Google Drive, Vimeo, and direct video links such as MP4, WEBM, and OGG.',

            'preview' => 'Video Preview',

            'not_supported' => 'Your browser does not support video playback.',

        ],

        'settings' => [

            'label' => 'Display Settings',

            'title' => 'Content Order & Status',

            'sort_order' => 'Display Order',

            'status' => 'Content Status',

            'active' => 'Active Content',

            'active_help' => 'Visible to students inside the lesson',

        ],

        'type_summary' => [

            'label' => 'Content Type',

            'title' => 'Current Type',

            'help' => 'You can change the content type from the list inside the form.',

        ],

        'delete' => [

            'title' => 'Delete Content Item',

            'description' => 'This item will be permanently deleted and cannot be restored.',

            'confirm' => 'Are you sure you want to delete this content item? This action cannot be undone.',

            'button' => 'Delete Content',

            'loading' => 'Deleting...',

        ],

        'errors' => [

            'csrf' => 'Unable to find the CSRF Token.',

            'delete' => 'An error occurred while deleting the content.',

            'connection' => 'Unable to connect to the server. Please try again.',

        ],

        'note' => [

            'title' => 'Note',

            'description' => 'When replacing an image or file, the old version will be deleted automatically and replaced with the new file. Videos are updated by changing their URL directly without uploading a video file to the server.',

        ],

    ],

],

'news' => [

    'page_title' => 'News & Announcements',
    'header_label' => 'Content Management',
    'title' => 'News & Announcements',
    'description' => 'Add news and announcements that will appear to visitors in the website news ticker.',
    'add_new' => 'Add New News',

    'alerts' => [
        'success_title' => 'Operation Completed Successfully',
        'validation_title' => 'Please review the information entered.',
    ],

    'status' => [
        'active' => 'Active',
        'inactive' => 'Inactive',
    ],

    'types' => [
        'lesson' => 'Lesson',
        'announcement' => 'Announcement',
        'update' => 'Update',
        'notice' => 'Notice',
        'general' => 'General',
    ],

    'meta' => [
        'added_at' => 'Added on',
        'starts_at' => 'Starts:',
        'ends_at' => 'Ends:',
        'has_link' => 'Contains a link',
    ],

    'actions' => [
        'view' => 'View',
        'edit' => 'Edit',
        'disable' => 'Disable',
        'activate' => 'Activate',
        'delete' => 'Delete',
        'confirm_delete' => 'Are you sure you want to delete this news item? This action cannot be undone.',
    ],

    'empty' => [
        'title' => 'No News Yet',
        'description' => 'You can add the first news item or announcement to appear later in the news ticker on the website homepage.',
        'add_first' => 'Add First News',
    ],
'news_create' => [

    'page_title' => 'Add New News',
    'header_label' => 'News & Announcements',
    'title' => 'Add New News',
    'description' => 'Create a news item or announcement to appear in the news ticker on the homepage.',

    'actions' => [
        'back' => 'Back to News',
        'cancel' => 'Cancel',
        'save' => 'Add News',
    ],

    'form' => [
        'title' => 'News Information',
        'description' => 'Enter the basic news information and define how it should appear on the website.',
    ],

    'fields' => [
        'title' => 'News Title',
        'title_placeholder' => 'Example: A new Tajweed lesson has been added',
        'type' => 'News Type',
        'type_placeholder' => 'Select News Type',
        'sort_order' => 'Display Order',
        'sort_order_placeholder' => '0',
        'content' => 'News Content',
        'content_placeholder' => 'Write the news or announcement details here...',
        'link' => 'News Link',
        'link_placeholder' => 'https://example.com',
        'starts_at' => 'Start Showing',
        'ends_at' => 'End Showing',
    ],

    'types' => [
        'announcement' => 'Announcement',
        'lesson' => 'New Lesson',
        'update' => 'Update',
        'notice' => 'Notice',
        'general' => 'General News',
    ],

    'help' => [
        'sort_order' => 'The smaller number appears first when news items are sorted by order.',
        'content' => 'You can write a short message, announce a new lesson, provide a website update, or share any information you want visitors to see.',
        'link' => 'Optional. If the news item is related to a page or lesson, you can add the link here so visitors can navigate to it.',
        'starts_at' => 'Leave empty to start showing the news immediately.',
        'ends_at' => 'Leave empty if you want the news to remain visible without an end date.',
    ],

    'publishing' => [
        'title' => 'Publishing Settings',

        'publish' => [
            'title' => 'Publish News',
            'description' => 'When enabled, the news item will be available in the news ticker according to the specified display period.',
        ],

        'new_tab' => [
            'title' => 'Open Link in New Tab',
            'description' => 'When the news item has a link, it will open in a new tab instead of leaving the current page.',
        ],
    ],

    'footer' => [
        'note' => 'You can edit the news item or disable its display at any time from the news management page.',
    ],

    'required' => '*',
],

],

'news_create' => [

    'page_title' => 'Add New News',
    'header_label' => 'News & Announcements',
    'title' => 'Add New News',
    'description' => 'Create a news item or announcement to appear in the news ticker on the homepage.',

    'actions' => [
        'back' => 'Back to News',
        'cancel' => 'Cancel',
        'save' => 'Add News',
    ],

    'form' => [
        'title' => 'News Information',
        'description' => 'Enter the basic news information and define how it should appear on the website.',
    ],

    'fields' => [
        'title' => 'News Title',
        'title_placeholder' => 'Example: A new Tajweed lesson has been added',
        'type' => 'News Type',
        'type_placeholder' => 'Select News Type',
        'sort_order' => 'Display Order',
        'sort_order_placeholder' => '0',
        'content' => 'News Content',
        'content_placeholder' => 'Write the news or announcement details here...',
        'link' => 'News Link',
        'link_placeholder' => 'https://example.com',
        'starts_at' => 'Start Showing',
        'ends_at' => 'End Showing',
    ],

    'types' => [
        'announcement' => 'Announcement',
        'lesson' => 'New Lesson',
        'update' => 'Update',
        'notice' => 'Notice',
        'general' => 'General News',
    ],

    'help' => [
        'sort_order' => 'The smaller number appears first when news items are sorted by order.',
        'content' => 'You can write a short message, announce a new lesson, provide a website update, or share any information you want visitors to see.',
        'link' => 'Optional. If the news item is related to a page or lesson, you can add the link here so visitors can navigate to it.',
        'starts_at' => 'Leave empty to start showing the news immediately.',
        'ends_at' => 'Leave empty if you want the news to remain visible without an end date.',
    ],

    'publishing' => [
        'title' => 'Publishing Settings',

        'publish' => [
            'title' => 'Publish News',
            'description' => 'When enabled, the news item will be available in the news ticker according to the specified display period.',
        ],

        'new_tab' => [
            'title' => 'Open Link in New Tab',
            'description' => 'When the news item has a link, it will open in a new tab instead of leaving the current page.',
        ],
    ],

    'footer' => [
        'note' => 'You can edit the news item or disable its display at any time from the news management page.',
    ],

    'alerts' => [
        'validation_title' => 'Please review the information entered.',
    ],

    'required' => '*',
],

'news_show' => [

    'page_title' => 'View News',
    'header_label' => 'News & Announcements',
    'title' => 'View News',
    'description' => 'Preview the news details and how it appears in the news ticker.',

    'actions' => [
        'edit' => 'Edit',
        'back' => 'Back to News',
        'edit_news' => 'Edit News',
        'delete_news' => 'Delete News',
        'confirm_delete' => 'Are you sure you want to permanently delete this news item?',
    ],

    'status' => [
        'label' => 'News Status:',
        'active' => 'Active',
        'inactive' => 'Inactive',
    ],

    'order' => 'Order',

    'content' => [
        'title' => 'News Content',
    ],

    'types' => [
        'announcement' => 'Announcement',
        'lesson' => 'New Lesson',
        'update' => 'Update',
        'notice' => 'Notice',
        'general' => 'General News',
    ],

    'link' => [
        'label' => 'Related News Link',
    ],

    'info' => [
        'title' => 'News Information',
        'type' => 'News Type',
        'sort_order' => 'Display Order',
        'starts_at' => 'Start Showing',
        'ends_at' => 'End Showing',
        'starts_immediately' => 'Starts Immediately',
        'no_end_date' => 'No End Date',
        'created_at' => 'Created At',
        'updated_at' => 'Last Updated',
        'open_link' => 'Open Link',
        'new_window' => 'New Window',
        'same_page' => 'Same Page',
    ],

    'preview' => [
        'title' => 'News Ticker Preview',
        'description' => 'This is an approximate preview of how the news item appears on the public website.',
        'latest_news' => 'Latest News',
    ],

],

'news_edit' => [

    'page_title' => 'Edit News',
    'header_label' => 'News & Announcements',
    'title' => 'Edit News',
    'description' => 'Edit the news details and its display settings in the news ticker.',

    'actions' => [
        'view' => 'View News',
        'back' => 'Back to News',
        'cancel' => 'Cancel',
        'save' => 'Save Changes',
    ],

    'current' => [
        'label' => 'Current News',
    ],

    'status' => [
        'active' => 'Active',
        'inactive' => 'Inactive',
    ],

    'form' => [
        'title' => 'News Information',
        'description' => 'Edit the information you want to change, then save your updates.',
    ],

    'fields' => [
        'title' => 'News Title',
        'title_placeholder' => 'Example: A new Tajweed lesson has been added',
        'type' => 'News Type',
        'type_placeholder' => 'Select News Type',
        'sort_order' => 'Display Order',
        'content' => 'News Content',
        'content_placeholder' => 'Write the news or announcement details here...',
        'link' => 'News Link',
        'link_placeholder' => 'https://example.com',
        'starts_at' => 'Start Showing',
        'ends_at' => 'End Showing',
    ],

    'types' => [
        'announcement' => 'Announcement',
        'lesson' => 'New Lesson',
        'update' => 'Update',
        'notice' => 'Notice',
        'general' => 'General News',
    ],

    'help' => [
        'sort_order' => 'The smaller number appears first when news items are sorted.',
        'content' => 'This text is used to display the news details and may also be used in the news ticker depending on the frontend design.',
        'link' => 'Optional. Use it to link the news item to a lesson, page on the website, or any external URL.',
        'starts_at' => 'Leave empty to start showing the news immediately when activated.',
        'ends_at' => 'Leave empty if you want the news to remain visible without an end date.',
    ],

    'publishing' => [
        'title' => 'Publishing Settings',

        'publish' => [
            'title' => 'Publish News',
            'description' => 'When enabled, the news item will be available in the news ticker according to the display period.',
        ],

        'new_tab' => [
            'title' => 'Open Link in New Tab',
            'description' => 'When the news item has a link, it will open in a new tab.',
        ],
    ],

    'footer' => [
        'note' => 'Make sure the news information is correct before saving the changes.',
    ],

    'delete' => [
        'title' => 'Delete News',
        'description' => 'Deleting this news item is permanent and cannot be undone. If you do not want it to appear currently, you can disable it instead of deleting it.',
        'button' => 'Delete News Permanently',
        'confirm' => 'Are you sure you want to permanently delete this news item?',
    ],

    'required' => '*',

],

'notifications' => [

    'page_title' => 'Notifications',
    'title' => 'Notifications',

    'unread_prefix' => 'You have',
    'unread_suffix' => 'unread notification(s)',

    'read_all' => 'Mark All as Read',

    'actions' => [
        'mark_read' => 'Mark as Read',
        'open' => 'Open',
        'delete' => 'Delete',
    ],

    'empty' => [
        'title' => 'No Notifications',
        'description' => 'New notifications related to the education dashboard will appear here.',
    ],

],

'payments' => [

    'page_title' => 'Payments',
    'header_label' => 'Education Management',
    'title' => 'Payments',
    'description' => 'Track payments related to educational bookings, review payment proofs, and monitor financial transaction statuses.',

    'actions' => [
        'bookings' => 'Bookings',
        'filter' => 'Filter',
        'reset' => 'Reset',
        'details' => 'Details',
        'view_payment_details' => 'View Payment Details',
    ],

    'statistics' => [
        'total' => 'Total Payments',
        'submitted' => 'Awaiting Review',
        'under_review' => 'Under Review',
        'approved' => 'Approved Payments',
        'rejected' => 'Rejected Payments',
    ],

    'filters' => [
        'search' => 'Search',
        'search_placeholder' => 'Student, email, booking number, reference...',
        'status' => 'Payment Status',
        'all_statuses' => 'All Statuses',
        'payment_method' => 'Payment Method',
        'all_methods' => 'All Methods',
        'date' => 'Date',
    ],

    'payment_methods' => [
        'bank_transfer' => 'Bank Transfer',
        'cash' => 'Cash',
        'other' => 'Other',
    ],

    'status' => [
        'unpaid' => 'Unpaid',
        'submitted' => 'Awaiting Review',
        'under_review' => 'Under Review',
        'approved' => 'Approved',
        'rejected' => 'Rejected',
    ],

    'table' => [
        'financial_record' => 'Financial Record',
        'payment_operations' => 'Payment Transactions',
        'operation_count' => 'transaction(s)',
        'booking_lesson' => 'Booking / Lesson',
        'student' => 'Student',
        'price' => 'Price',
        'payment_method' => 'Payment Method',
        'status' => 'Status',
        'submitted_at' => 'Submitted At',
        'action' => 'Action',
    ],

    'sessions' => [
        'single' => 'session',
        'multiple' => 'sessions',
        'completed' => 'completed',
    ],

    'amount' => [
        'registered_payment' => 'Recorded payment amount:',
    ],

    'mobile' => [
        'booking_price' => 'Booking Price',
        'method' => 'Method',
        'sessions' => 'Sessions',
        'submitted_at' => 'Submitted At',
        'payment_reference' => 'Payment Reference',
    ],

    'fallbacks' => [
        'educational_booking' => 'Educational Booking',
        'student_unavailable' => 'Student Unavailable',
        'not_submitted' => 'Not Submitted',
    ],

    'empty' => [
        'title' => 'No Payments',
        'description' => 'No payment transactions were found matching the current search criteria.',
        'show_all' => 'View All Payments',
    ],

],

'payment_show' => [

    'page_title' => 'Payment Details',

    'header_label' => 'Payment Management',
    'title' => 'Payment Details',
    'description' => 'Review the booking details, lesson amount, payment proof, and take the appropriate action.',

    'actions' => [
        'back' => 'Back to Payments',
    ],

    'reference' => [
        'label' => 'Transaction Number',
    ],

    'status' => [
        'approved' => 'Approved',
        'submitted' => 'Proof Submitted',
        'under_review' => 'Under Review',
        'rejected' => 'Rejected',
        'unpaid' => 'Unpaid',
    ],

    'payment_info' => [
        'label' => 'Transaction Information',
        'title' => 'Payment Details',
        'amount' => 'Paid Amount',
        'booking_price' => 'Booking / Lesson Price',
        'payment_method' => 'Payment Method',
        'reference' => 'Transfer / Reference Number',
        'submitted_at' => 'Proof Submitted At',
        'paid_at' => 'Payment Date',
        'created_at' => 'Transaction Created At',
        'updated_at' => 'Last Updated',
    ],

    'payment_methods' => [
        'bank_transfer' => 'Bank Transfer',
        'cash' => 'Cash',
        'card' => 'Card',
        'online' => 'Online Payment',
    ],

    'receipt' => [
        'label' => 'Payment Proof',
        'title' => 'Transfer Receipt',
        'alt' => 'Payment Proof',
        'open_full_image' => 'Open Image Full Size',
        'pdf_file' => 'PDF File',
        'default_pdf_name' => 'Payment Proof.pdf',
        'file' => 'Payment Proof File',
        'attached_file' => 'Attached File',
        'open_file' => 'Open File',
        'file_name' => 'File Name',
        'file_type' => 'File Type',
        'file_size' => 'File Size',
        'no_receipt' => 'No Payment Proof',
        'no_receipt_description' => 'No proof file has been uploaded for this transaction yet.',
    ],

    'student_note' => [
        'label' => 'Student Note',
        'title' => 'Payment Notes',
    ],

    'admin_review' => [
        'label' => 'Administrative Review',
        'title' => 'Review Result',
        'reviewed_by' => 'Reviewed By',
        'admin' => 'Administration',
        'reviewed_at' => 'Review Date',
        'admin_note' => 'Admin Note',
        'rejection_reason' => 'Reason for Rejection',
    ],

    'booking' => [
        'label' => 'Related Booking',
        'title' => 'Lesson & Booking Information',
        'lesson' => 'Lesson',
        'default_lesson' => 'Educational Lesson',
        'price' => 'Booking Price',
        'total_sessions' => 'Total Sessions',
        'session' => 'Session',
        'sessions' => 'Sessions',
        'completed_sessions' => 'Completed Sessions',
        'remaining_sessions' => 'Remaining Sessions',
        'category' => 'Category',
        'date' => 'Date',
        'time' => 'Time',
        'booking_status' => 'Booking Status',
        'payment_status' => 'Payment Status',
        'description' => 'Booking Description',
        'view_booking' => 'View Booking Details',
        'not_found' => 'The related booking could not be found.',

        'categories' => [
            'quran' => 'Quran',
            'tajweed' => 'Tajweed',
            'arabic' => 'Arabic Language',
        ],

        'statuses' => [
            'confirmed' => 'Confirmed',
            'pending' => 'Pending Review',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
            'rejected' => 'Rejected',
        ],

        'payment_statuses' => [
            'paid' => 'Paid',
            'pending' => 'Pending',
            'unpaid' => 'Unpaid',
            'failed' => 'Payment Failed',
        ],
    ],

    'student' => [
        'label' => 'Transaction Owner',
        'title' => 'Student',
        'default_name' => 'Student',
        'no_data' => 'No student information available.',
    ],

    'status_summary' => [
        'label' => 'Transaction Status',
        'title' => 'Status Summary',

        'approved' => [
            'title' => 'Payment Approved',
            'description' => 'The payment has been verified and approved.',
        ],

        'submitted' => [
            'title' => 'Payment Proof Submitted',
            'description' => 'The proof is waiting for administrative review.',
        ],

        'under_review' => [
            'title' => 'Transaction Under Review',
            'description' => 'The payment proof is currently being reviewed by the administration.',
        ],

        'rejected' => [
            'title' => 'Payment Rejected',
            'description' => 'The student needs to take a new action based on the rejection reason.',
        ],

        'unpaid' => [
            'title' => 'Transaction Unpaid',
            'description' => 'The payment has not been completed yet.',
        ],
    ],

    'actions_section' => [
        'label' => 'Actions',
        'title' => 'Manage Transaction',
        'approve' => 'Approve Payment',
        'review' => 'Mark Under Review',
        'reject' => 'Reject Payment',
        'reset' => 'Reset to Unpaid',
        'no_action' => 'No actions are currently available.',
    ],

    'confirmations' => [
        'approve' => 'Are you sure you want to approve this payment?',
        'reset' => 'Do you want to reset this transaction to unpaid?',
    ],

    'modal' => [
        'close' => 'Close',
        'eyebrow' => 'Reject Payment',
        'title' => 'Reason for Rejecting Proof',
        'description' => 'Please provide a clear reason for the rejection so the student knows what is required.',
        'reason_label' => 'Rejection Reason',
        'reason_placeholder' => 'Write the reason for rejecting the payment...',
        'cancel' => 'Cancel',
        'confirm_reject' => 'Confirm Rejection',
    ],

],

'profile' => [

    'page_title' => 'Profile',

    'description' => 'Manage your education administrator account information and login settings.',

    'admin' => [
        'default_name' => 'Education Administrator',
        'active' => 'Account Active',
        'education_manager' => 'Education Administrator',
    ],

    'fields' => [
        'name' => 'Name',
        'email' => 'Email Address',
        'account_type' => 'Account Type',
    ],

    'personal' => [
        'title' => 'Personal Information',
        'description' => 'Update your name and email address.',
        'save' => 'Save Information',
    ],

    'password' => [
        'title' => 'Change Password',
        'description' => 'Use a strong password to protect your account.',
        'current' => 'Current Password',
        'new' => 'New Password',
        'confirm' => 'Confirm Password',
        'requirement' => 'The new password must contain at least 8 characters.',
        'save' => 'Change Password',
    ],

],

'quizzes' => [

    'page_title' => 'Quizzes',
    'header_label' => 'Education Management',
    'title' => 'Quizzes',
    'subtitle' => 'Educational Quiz Management',
    'description' => 'Create general and student quizzes, and easily manage questions, grades, and attempts.',

    'actions' => [
        'new' => 'New Quiz',
        'view' => 'View Quiz',
        'questions' => 'Manage Questions & Options',
        'edit' => 'Edit Quiz',
        'delete' => 'Delete Quiz',
        'confirm_delete' => 'Are you sure you want to delete this quiz? The related questions and options will also be deleted.',
    ],

    'alerts' => [
        'success_title' => 'Operation Completed Successfully',
        'error_title' => 'Unable to Complete the Operation',
    ],

    'overview' => [
        'total' => 'Total Quizzes',
        'total_description' => 'Quiz registered in the system',

        'active' => 'Active Quizzes',
        'active_description' => 'Available to students',

        'questions' => 'Questions',
        'questions_description' => 'Within the current results',

        'current_page' => 'Current Page',
        'of' => 'of',
    ],

    'filters' => [
        'title' => 'Search & Filter',
        'description' => 'Search for a quiz or filter the results',

        'search_placeholder' => 'Search by quiz name, description, lesson, or student...',

        'all_types' => 'All Quiz Types',
        'general_quizzes' => 'General Lesson Quizzes',
        'student_quizzes' => 'Student Quizzes',

        'all_lessons' => 'All General Lessons',

        'all_statuses' => 'All Statuses',

        'apply' => 'Apply',
        'reset' => 'Reset',
    ],

    'status' => [
        'active' => 'Active',
        'inactive' => 'Inactive',
    ],

    'results' => [
        'header_label' => 'Content Management',
        'title' => 'Quiz List',
        'quiz_count' => 'Quiz',
    ],

    'card' => [
        'no_description' => 'No description available for this quiz.',
    ],

    'types' => [
        'general_lesson' => 'General Lesson Quiz',
        'student' => 'Student Quiz',
        'unlinked' => 'Unlinked',
    ],

    'related' => [
        'general_lesson' => 'General Lesson',
        'student_lesson' => 'Student Lesson',
        'session' => 'Session',
    ],

    'meta' => [
        'question' => 'Question',
        'pass' => 'Pass',
        'attempts' => 'Attempts',
        'unlimited' => 'Unlimited',
        'minutes' => 'Minutes',
        'no_time_limit' => 'No Time Limit',
    ],

    'empty' => [
        'title' => 'No Quizzes',
        'description' => 'No quiz matching the current search or filters was found.',
        'create_first' => 'Create First Quiz',
    ],

],

'quiz_show' => [

    'page_title' => 'View Quiz',

    'header_label' => 'Quiz Management',

    'educational_quiz' => 'Educational Quiz',

    'description' => 'View the quiz details, questions, options, and its settings.',

    'actions' => [
        'back' => 'Back to Quizzes',
        'edit' => 'Edit Quiz',
    ],

    'alerts' => [
        'success_title' => 'Operation Completed Successfully',
    ],

    'overview' => [
        'section_label' => 'Quiz Information',
        'title' => 'Overview',
    ],

    'fields' => [
        'title' => 'Quiz Title',
        'description' => 'Quiz Description',
        'no_description' => 'No description available for this quiz.',
    ],

    'questions' => [
        'section_label' => 'Quiz Content',
        'title' => 'Questions',
        'add' => 'Add Question',
        'empty_title' => 'No Questions',
        'empty_description' => 'No questions have been added to this quiz yet.',
        'add_first' => 'Add First Question',
    ],

    'status' => [
        'active' => 'Active',
        'inactive' => 'Inactive',
    ],

    'question_types' => [
        'multiple_choice' => 'Multiple Choice',
        'true_false' => 'True or False',
        'text' => 'Text Answer',
        'unspecified' => 'Unspecified',
    ],

    'points' => [
        'single' => 'Point',
        'multiple' => 'Points',
    ],

    'options' => 'Options',

    'question_actions' => [
        'view' => 'View Question',
        'edit' => 'Edit Question',
    ],

    'explanations' => [
        'section_label' => 'Explanations',
        'title' => 'Answer Explanations',
    ],

    'summary' => [
        'section_label' => 'Quiz',
        'title' => 'Quiz Summary',
    ],

    'statistics' => [
        'section_label' => 'Statistics',
        'title' => 'Quiz Information',
        'questions' => 'Number of Questions',
        'total_points' => 'Total Points',
        'pass_percentage' => 'Pass Percentage',
        'max_attempts' => 'Allowed Attempts',
        'time' => 'Time',
        'minutes' => 'Minutes',
        'not_specified_feminine' => 'Not Specified',
        'not_specified' => 'Not Specified',
    ],

    'status_section' => [
        'section_label' => 'Status',
        'title' => 'Quiz Status',

        'active_title' => 'Quiz is Active',
        'active_description' => 'The quiz is available to students when the display conditions are met.',

        'inactive_title' => 'Quiz is Inactive',
        'inactive_description' => 'The quiz will not be visible to students until it is activated.',
    ],

    'quick_actions' => [
        'section_label' => 'Quick Actions',
        'title' => 'Quiz Management',
        'manage_questions' => 'Manage Questions',
        'add_question' => 'Add Question',
        'edit_quiz' => 'Edit Quiz',
    ],

    'note' => [
        'title' => 'Note',
        'description' => 'From the questions page, you can add options, select the correct answer for each question, and adjust the question order as needed.',
    ],

],

'quiz_edit' => [

    'page_title' => 'Edit Quiz',

    'header_label' => 'Quiz Management',

    'description' => 'Edit the quiz information, settings, and its lesson association as needed.',

    'required' => '*',

    'optional' => 'Optional',

    'actions' => [
        'back' => 'Back to Quiz',
        'save' => 'Save Changes',
        'cancel' => 'Cancel',
    ],

    'alerts' => [
        'validation_title' => 'Please review the information',
    ],

    'basic' => [
        'title' => 'Basic Information',
        'heading' => 'Quiz Information',
    ],

    'fields' => [
        'title' => 'Quiz Title',
        'title_placeholder' => 'Example: Quran Kareem Quiz',
        'description' => 'Quiz Description',
        'description_placeholder' => 'Write a short description of the quiz...',
    ],

    'lesson_type' => [

        'section_label' => 'Quiz Association',
        'heading' => 'Associated Lesson Type',

        'label' => 'Lesson Type',

        'general' => [
            'title' => 'General Lesson',
            'description' => 'A lesson available within the public website lessons.',
        ],

        'student' => [
            'title' => 'Student-Specific Lesson',
            'description' => 'A lesson version associated with a specific student and booking.',
        ],

        'general_lesson' => [
            'label' => 'General Lesson',
            'placeholder' => 'Select General Lesson',
            'hint' => 'Select the general lesson this quiz belongs to.',
        ],

        'student_lesson' => [
            'label' => 'Student Lesson',
            'placeholder' => 'Select Student Lesson',
            'hint' => 'Select the student lesson version for the student who will take the quiz.',
        ],

        'info' => [
            'general' => 'This quiz is associated with a general lesson and can be displayed to students as part of the public website content.',
            'student' => 'This quiz is associated with a student-specific lesson version and will not appear among the public lessons.',
        ],

    ],

    'settings' => [

        'section_label' => 'Quiz Settings',
        'heading' => 'Quiz Controls',

        'pass_percentage' => 'Passing Percentage',

        'max_attempts' => 'Number of Attempts',
        'max_attempts_placeholder' => 'Unlimited',
        'max_attempts_hint' => 'Leave empty to allow an unlimited number of attempts.',

        'time_limit' => 'Quiz Duration',
        'time_limit_placeholder' => 'In minutes',
        'time_limit_hint' => 'Duration in minutes. Leave empty if there is no time limit.',

        'sort_order' => 'Display Order',

    ],

    'sidebar' => [

        'quiz_label' => 'Quiz',
        'current_info' => 'Current Information',

        'general_quiz' => 'General Lesson Quiz',

    ],

    'status' => [

        'section_label' => 'Status',
        'heading' => 'Quiz Status',

        'active_title' => 'Active Quiz',
        'active_description' => 'The quiz will be visible to students when activated.',

    ],

    'statistics' => [

        'section_label' => 'Statistics',
        'heading' => 'Current Data',

        'questions' => 'Questions',
        'total_points' => 'Total Points',
        'pass_percentage' => 'Passing Percentage',

    ],

    'note' => [

        'title' => 'Note',

        'description' => 'Changing the lesson type or associated lesson does not delete the questions or attempts associated with the quiz.',

    ],

],

'quiz_attempts' => [

    'page_title' => 'Quiz Attempts',
    'header_label' => 'Quizzes',
    'title' => 'Student Attempts',
    'subtitle' => 'Quiz Results & Attempts',
    'description' => 'Track student attempts, results, and performance levels in educational quizzes.',

    'alerts' => [
        'success_title' => 'Operation Completed Successfully',
    ],

    'statistics' => [
        'total' => 'Total Attempts',
        'passed' => 'Passed Attempts',
        'failed' => 'Failed Attempts',
        'completed' => 'Completed Attempts',
    ],

    'filters' => [
        'header_label' => 'Search & Filter',
        'title' => 'Search Attempts',
        'search_placeholder' => 'Search by student name, email, or quiz name...',
        'all_statuses' => 'All Statuses',
        'all_results' => 'All Results',
        'apply' => 'Apply',
        'reset' => 'Reset',
    ],

    'results' => [
        'passed' => 'Passed',
        'failed' => 'Failed',
    ],

    'status' => [
        'completed' => 'Completed',
        'in_progress' => 'In Progress',
        'cancelled' => 'Cancelled',
    ],

    'table' => [
        'header_label' => 'Attempt Records',
        'title' => 'All Student Attempts',
        'student' => 'Student',
        'quiz' => 'Quiz',
        'attempt' => 'Attempt',
        'score' => 'Score',
        'percentage' => 'Percentage',
        'status' => 'Status',
        'started_at' => 'Started At',
        'actions' => 'Actions',
    ],

    'fallback' => [
        'unknown_student' => 'Unknown Student',
        'deleted_quiz' => 'Deleted Quiz',
    ],

    'actions' => [
        'view_result' => 'View Result',
    ],

    'empty' => [
        'title' => 'No Attempts Found',
        'description' => 'No quiz attempts were found matching the current search criteria.',
        'show_all' => 'View All Attempts',
    ],

],

'quiz_attempt_show' => [

    'page_title' => 'Quiz Attempt Details',
    'header_label' => 'Quiz Management',
    'title' => 'Quiz Attempt Details',
    'description' => 'View the student result, attempt details, and recorded answers for each question.',

    'actions' => [
        'back' => 'Back to Attempts',
        'back_all' => 'Back to All Attempts',
    ],

    'alerts' => [
        'success_title' => 'Operation Completed Successfully',
    ],

    'fallback' => [
        'quiz' => 'Quiz',
        'unknown_student' => 'Unknown',
        'question_unavailable' => 'Question Unavailable',
    ],

    'result' => [
        'section_label' => 'Final Result',
        'title' => 'Attempt Result',
        'passed' => 'Passed',
        'failed' => 'Failed',
        'score_label' => 'Result',
        'earned_score' => 'Earned Score',
        'total_score' => 'Total Score',
        'passing_score' => 'Passing Score',
    ],

    'student' => [
        'section_label' => 'Student',
        'title' => 'Student Information',
    ],

    'answers' => [
        'section_label' => 'Answer Details',
        'title' => 'Student Answers',
        'count' => 'Answer(s)',
        'correct' => 'Correct',
        'wrong' => 'Incorrect',
        'student_answer' => 'Student Answer',
        'no_answer' => 'No Answer Recorded',
        'points' => 'Points',
        'explanation' => 'Question Explanation',
    ],

    'empty' => [
        'title' => 'No Answers',
        'description' => 'No answers have been recorded for this attempt yet.',
    ],

    'quiz' => [
        'section_label' => 'Quiz',
        'title' => 'Quiz Information',
    ],

    'attempt' => [
        'section_label' => 'Attempt',
        'title' => 'Attempt Information',
        'number' => 'Attempt Number',
        'status_label' => 'Status',
        'started_at' => 'Started At',
        'completed_at' => 'Completed At',
    ],

    'status' => [
        'completed' => 'Completed',
        'in_progress' => 'In Progress',
        'abandoned' => 'Abandoned',
        'unknown' => 'Unknown',
    ],

    'dates' => [
        'not_available' => 'Not Available',
        'not_completed' => 'Not Completed Yet',
    ],

    'summary' => [
        'passed' => 'Successful Performance',
        'needs_improvement' => 'Needs Improvement',
        'of' => 'of',
    ],

],

'quiz_questions' => [
    'page_title' => 'Quiz Questions',
    'header_label' => 'Question Management',
    'title' => 'Quiz Questions',
    'description' => 'Manage quiz questions, options, and correct answers.',

    'actions' => [
        'add_question' => 'Add Question',
        'quiz' => 'Quiz',
        'add_option' => 'Add Option',
        'view_question' => 'View Question',
        'manage_options' => 'Manage Options',
        'edit_question' => 'Edit Question',
        'delete_question' => 'Delete Question',
        'confirm_delete' => 'Are you sure you want to delete this question? Its associated answer options will also be deleted.',
    ],

    'alerts' => [
        'success_title' => 'Operation Completed Successfully',
        'error_title' => 'Unable to Complete the Operation',
    ],

    'summary' => [
        'questions' => 'Questions',
        'pass_percentage' => 'Passing Percentage',
        'attempts' => 'Attempts',
        'time' => 'Time',
        'minutes' => 'minutes',
    ],

    'list' => [
        'section_label' => 'Quiz Content',
        'title' => 'Question List',
        'question_count' => 'Question(s)',
    ],

    'question' => [
        'label' => 'Question',
    ],

    'status' => [
        'active' => 'Active',
        'inactive' => 'Inactive',
    ],

    'types' => [
        'multiple_choice' => 'Multiple Choice',
        'true_false' => 'True or False',
        'text' => 'Text Answer',
    ],

    'points' => [
        'single' => 'Point',
        'multiple' => 'Points',
    ],

    'options' => [
        'single' => 'Option',
        'multiple' => 'Options',
        'more' => 'more',
    ],

    'correct_answers' => [
        'single' => 'Correct Answer',
        'multiple' => 'Correct Answers',
    ],

    'options_summary' => [
        'total' => 'Total Options',
        'active' => 'Active',
        'correct' => 'Correct',
    ],

    'no_options' => [
        'title' => 'No Options for This Question',
        'description' => 'Answer options must be added so the student can answer this question.',
    ],

    'text_answer' => [
        'description' => 'This question requires the student to write the answer themselves.',
    ],

    'empty' => [
        'title' => 'No Questions',
        'description' => 'No questions have been added to this quiz yet.',
        'add_first' => 'Add First Question',
    ],
],

'quiz_question_create' => [
    'page_title' => 'Add New Question',
    'header_label' => 'Quiz Questions',
    'title' => 'Add New Question',
    'description' => 'Add a new question and define its type, options, and correct answer.',

    'optional' => 'Optional',

    'actions' => [
        'back' => 'Back to Questions',
        'add_option' => 'Add Option',
        'save' => 'Save Question',
        'cancel' => 'Cancel',
    ],

    'alerts' => [
        'validation_title' => 'Please review the following information:',
    ],

    'basic' => [
        'section_label' => 'Basic Information',
        'title' => 'Question Information',
    ],

    'fields' => [
        'question' => 'Question Text',
        'question_placeholder' => 'Write the question text here...',
        'type' => 'Question Type',
        'type_placeholder' => 'Select Question Type',
        'points' => 'Points',
        'explanation' => 'Answer Explanation',
        'explanation_placeholder' => 'Write an explanation that will appear to the student after answering...',
        'sort_order' => 'Question Order',
        'status' => 'Question Status',
        'active_question' => 'Active Question',
    ],

    'types' => [
        'multiple_choice' => 'Multiple Choice',
        'true_false' => 'True / False',
        'text' => 'Text Answer',
    ],

    'options' => [
        'section_label' => 'Answer Options',
        'title' => 'Options',
        'heading' => 'Question Options',
        'description' => 'Add the options and select the correct answer.',
        'empty_message' => 'Add at least two options for this question.',
    ],

    'display' => [
        'section_label' => 'Display Settings',
        'title' => 'Question Status & Order',
    ],

    'quiz' => [
        'section_label' => 'Quiz',
        'title' => 'Current Quiz',
    ],

    'guide' => [
        'section_label' => 'Question Guide',
        'title' => 'Question Types',
        'multiple_choice' => 'Multiple options with one correct answer.',
        'true_false' => 'Choose between a correct and incorrect answer.',
        'text' => 'The student writes the answer themselves.',
    ],

    'note' => [
        'title' => 'Note',
        'description' => 'For multiple-choice questions, at least one correct answer must be selected.',
    ],

    'javascript' => [
        'option_placeholder' => 'Write the option text...',
        'delete_option' => 'Delete Option',
        'true_option' => 'True',
        'false_option' => 'False',
        'minimum_options' => 'You must add at least two options to the question.',
        'select_correct' => 'Please select the correct answer.',
    ],
],

'quiz_question_show' => [
    'page_title' => 'View Question',
    'header_label' => 'Question Management',
    'title' => 'View Question',
    'description' => 'View the question details, answer options, and related settings.',

    'actions' => [
        'back' => 'Back to Questions',
        'edit' => 'Edit Question',
        'add_option' => 'Add Option',
        'view_option' => 'View Option',
        'edit_option' => 'Edit Option',
        'delete_option' => 'Delete Option',
        'add_first_option' => 'Add First Option',
        'manage_options' => 'Manage Options',
        'confirm_delete_option' => 'Are you sure you want to delete this option?',
    ],

    'alerts' => [
        'success_title' => 'Operation Completed Successfully',
    ],

    'question' => [
        'section_label' => 'Question',
        'title' => 'Question Text',
        'label' => 'Question',
        'explanation' => 'Answer Explanation',
    ],

    'options' => [
        'section_label' => 'Question Answers',
        'title' => 'Answer Options',
        'correct' => 'Correct Answer',
        'incorrect' => 'Incorrect Answer',
        'order' => 'Order:',
        'total' => 'Total Options:',
        'correct_selected' => 'Correct Answer Selected',
        'no_correct_selected' => 'No Correct Answer Selected',
    ],

    'status' => [
        'active' => 'Active',
        'inactive' => 'Inactive',
        'section_label' => 'Status',
        'title' => 'Question Status',
        'active_question' => 'Active Question',
        'inactive_question' => 'Inactive Question',
    ],

    'empty_options' => [
        'title' => 'No Answer Options',
        'description' => 'No options have been added to this question yet.',
    ],

    'text_answer' => [
        'section_label' => 'Answer Method',
        'title' => 'Text Answer',
        'description' => 'This question requires the student to write the answer themselves.',
    ],

    'settings' => [
        'section_label' => 'Settings',
        'title' => 'Question Settings',
        'points' => 'Points',
        'point' => 'Point',
        'sort_order' => 'Display Order',
    ],

    'question_type' => [
        'section_label' => 'Question Type',
        'title' => 'Answer Method',
        'multiple_choice' => 'Multiple Choice',
        'true_false' => 'True or False',
        'text' => 'Text Answer',
        'unknown' => 'Undefined',
    ],

    'quiz' => [
        'section_label' => 'Quiz',
        'title' => 'Quiz Information',
    ],

    'statistics' => [
        'section_label' => 'Statistics',
        'title' => 'Question Summary',
        'points' => 'Points',
        'options_count' => 'Number of Options',
        'correct_answers' => 'Correct Answers',
        'sort_order' => 'Question Order',
    ],

    'options_management' => [
        'section_label' => 'Options',
        'title' => 'Answer Management',
    ],

    'actions_section' => [
        'section_label' => 'Actions',
        'title' => 'Question Management',
    ],

    'delete' => [
        'title' => 'Delete Question',
        'description' => 'The question and all its associated options will be permanently deleted.',
        'button' => 'Delete Question',
        'confirm' => 'Are you sure you want to delete this question? Its associated answer options will also be deleted.',
    ],

    'note' => [
        'title' => 'Note',
        'description' => 'You can add multiple options to the question, select the correct answer, and manage the option order or status from the options management section.',
    ],
],

'question_edit' => [
    'page_title' => 'Edit Question',
    'header_label' => 'Question Management',
    'title' => 'Edit Question',
    'description' => 'Edit the question information, type, score, answer options, and related settings.',

    'required' => '*',
    'optional' => 'Optional',

    'actions' => [
        'back' => 'Back to Question',
        'save' => 'Save Changes',
        'cancel' => 'Cancel',
    ],

    'alerts' => [
        'validation_title' => 'Please review the information',
    ],

    'question' => [
        'section_label' => 'Question',
        'heading' => 'Question Information',
    ],

    'fields' => [
        'question' => 'Question Text',
        'question_placeholder' => 'Write the question here...',
        'explanation' => 'Answer Explanation',
        'explanation_placeholder' => 'Write an explanation or clarification of the answer...',
        'explanation_hint' => 'This field can be used to explain the correct answer to the student after completing the quiz.',
    ],

    'type' => [
        'section_label' => 'Question Type',
        'heading' => 'Answer Method',
    ],

    'types' => [
        'multiple_choice' => [
            'title' => 'Multiple Choice',
            'description' => 'The student selects one answer from several options.',
        ],
        'true_false' => [
            'title' => 'True or False',
            'description' => 'The student determines whether the statement is true or false.',
        ],
        'text' => [
            'title' => 'Text Answer',
            'description' => 'The student writes the answer themselves.',
        ],
    ],

    'options' => [
        'section_label' => 'Answers',
        'heading' => 'Answer Options',
        'manage_title' => 'Manage Options',
        'manage_description' => 'You can edit the existing options or add new ones.',
        'add' => 'Add Option',
        'option_text' => 'Option Text',
        'option_placeholder' => 'Write the option...',
        'new_option_placeholder' => 'Write the new option...',
        'correct_answer' => 'Correct Answer',
        'active' => 'Active',
        'delete' => 'Delete Option',
        'remove' => 'Remove Option',
        'empty' => 'There are no answer options associated with this question.',
        'correct_hint' => 'Select only one answer as the correct answer.',
    ],

    'settings' => [
        'section_label' => 'Settings',
        'heading' => 'Question Settings',
        'points' => 'Points',
        'sort_order' => 'Display Order',
    ],

    'quiz' => [
        'section_label' => 'Quiz',
        'title' => 'Quiz Information',
    ],

    'quiz_settings' => [
        'section_label' => 'Quiz Settings',
        'title' => 'General Information',
        'pass_percentage' => 'Passing Percentage',
        'attempts' => 'Attempts',
        'time' => 'Time',
        'minutes' => 'minutes',
        'unlimited' => 'Unlimited',
    ],

    'status' => [
        'section_label' => 'Status',
        'title' => 'Question Status',
        'active_title' => 'Active Question',
        'active_description' => 'The question is shown to students when the quiz is activated.',
    ],

    'current' => [
        'title' => 'Current Question',
        'description_before' => 'Question number',
        'description_after' => 'is being edited within this quiz.',
    ],
],

'quiz_options' => [
    'page_title' => 'Question Options',
    'header_label' => 'Option Management',
    'title' => 'Question Options',
    'description' => 'Manage answer options and select the correct answer for this question.',

    'actions' => [
        'back' => 'Back to Question',
        'add' => 'Add Option',
        'view_option' => 'View Option',
        'edit_option' => 'Edit Option',
        'delete_option' => 'Delete Option',
    ],

    'alerts' => [
        'success_title' => 'Operation Completed Successfully',
        'error_title' => 'Unable to Complete the Operation',
    ],

    'question' => [
        'section_label' => 'Question',
        'title' => 'Question Text',

        'types' => [
            'multiple_choice' => 'Multiple Choice',
            'true_false' => 'True or False',
            'text' => 'Text Answer',
        ],

        'point' => 'Point',
        'points' => 'Points',
        'has_explanation' => 'Answer explanation available',
    ],

    'options' => [
        'section_label' => 'Options',
        'title' => 'Answer Options',
        'count' => 'Option(s)',
    ],

    'text_question' => [
        'title' => 'This Is a Text Question',
        'description' => 'Text-answer questions do not require predefined options.',
    ],

    'option' => [
        'correct' => 'Correct Answer',
        'incorrect' => 'Incorrect Answer',
        'order' => 'Order:',
        'active' => 'Active',
        'inactive' => 'Inactive',
    ],

    'empty' => [
        'title' => 'No Options for This Question',
        'description' => 'Add answer options so the student can select the appropriate answer.',
        'add_first' => 'Add First Option',
    ],

    'warning' => [
        'title' => 'No Correct Answer Selected',
        'description' => 'At least one correct answer must be selected so the system can grade student answers.',
    ],

    'type' => [
        'section_label' => 'Question Type',
        'title' => 'Answer Method',

        'multiple_choice' => [
            'title' => 'Multiple Choice',
            'description' => 'The student selects one answer from several options.',
        ],

        'true_false' => [
            'title' => 'True or False',
            'description' => 'The student determines whether the statement is true or false.',
        ],

        'text' => [
            'title' => 'Text Answer',
            'description' => 'The student writes the answer themselves.',
        ],
    ],

    'info' => [
        'section_label' => 'Question Information',
        'title' => 'Settings',
        'points' => 'Points',
        'sort_order' => 'Order',
        'options_count' => 'Number of Options',
        'correct_count' => 'Correct Answers',
    ],

    'status' => [
        'section_label' => 'Status',
        'title' => 'Question Status',
        'active' => 'Active Question',
        'inactive' => 'Inactive Question',
    ],

    'management' => [
        'section_label' => 'Actions',
        'title' => 'Question Management',
        'view_question' => 'View Question',
        'add_option' => 'Add Option',
        'edit_question' => 'Edit Question',
    ],

    'delete' => [
        'confirm' => 'Are you sure you want to delete this option? This action cannot be undone.',
    ],

    'note' => [
        'title' => 'Note',
        'description' => 'At least one correct answer must be selected for multiple-choice and true/false questions so the system can grade the answers.',
    ],
],

'quiz_option_create' => [
    'page_title' => 'Add Option',
    'header_label' => 'Option Management',
    'title' => 'Add Option',
    'description' => 'Add a new answer option for this question and specify whether it is correct.',

    'actions' => [
        'back_to_options' => 'Back to Options',
        'cancel' => 'Cancel',
        'create' => 'Create Option',
        'view_question' => 'View Question',
        'view_options' => 'View Options',
    ],

    'alerts' => [
        'validation_title' => 'Please correct the following errors',
    ],

    'question' => [
        'section_label' => 'Question',
        'heading' => 'Question Associated with the Option',
        'type' => 'Question Type',

        'types' => [
            'multiple_choice' => 'Multiple Choice',
            'true_false' => 'True or False',
            'text' => 'Text Answer',
        ],
    ],

    'option' => [
        'section_label' => 'Option Information',
        'heading' => 'Answer Information',

        'text' => 'Option Text',
        'text_placeholder' => 'Write the answer option here...',

        'sort_order' => 'Option Order',
        'sort_order_help' => 'Determines the display order of this option among the other options.',

        'answer_status' => 'Answer Status',
        'correct' => 'This is a correct answer',
        'correct_description' => 'This option will be accepted as a correct answer when grading the student’s answers.',

        'active_status' => 'Option Status',
        'active' => 'Active Option',
        'active_description' => 'Inactive options will not be displayed to students during the quiz.',
    ],

    'type_help' => [
        'true_false' => 'True/false questions allow only one correct answer. Selecting this option as correct will automatically mark any other option as incorrect.',
        'multiple_choice' => 'A multiple-choice question can contain more than one correct answer.',
    ],

    'question_type' => [
        'section_label' => 'Question Type',
        'heading' => 'Answer Method',

        'multiple_choice' => [
            'title' => 'Multiple Choice',
            'description' => 'The student selects one or more answers from the available options.',
        ],

        'true_false' => [
            'title' => 'True or False',
            'description' => 'The student determines whether the statement is true or false.',
        ],

        'text' => [
            'title' => 'Text Answer',
            'description' => 'The student writes the answer themselves.',
        ],
    ],

    'question_info' => [
        'section_label' => 'Question Information',
        'heading' => 'Question Details',
        'points' => 'Points',
        'sort_order' => 'Question Order',
        'existing_options' => 'Existing Options',
    ],

    'note' => [
        'title' => 'Note',

        'multiple_choice' => 'You can add multiple correct options for this question. Each option marked as correct will be accepted when grading the student’s answer.',

        'true_false' => 'There must be only one correct option. When a new option is marked as correct, the previous correct option will automatically be marked as incorrect.',

        'text' => 'Text-answer questions do not require predefined options.',
    ],
],

'quiz_option_show' => [
    'page_title' => 'View Answer Option',
    'header_label' => 'Option Management',
    'title' => 'View Answer Option',
    'description' => 'View the answer option details, status, and related settings.',

    'actions' => [
        'back' => 'Back to Options',
        'edit' => 'Edit Option',
        'delete' => 'Delete Option',
    ],

    'alerts' => [
        'success_title' => 'Operation Completed Successfully',
    ],

    'question' => [
        'section_label' => 'Question',
        'heading' => 'Question Associated with the Option',
        'has_explanation' => 'Answer explanation available',
    ],

    'option' => [
        'section_label' => 'Answer Option',
        'heading' => 'Option Details',
        'number' => 'Option Number',
        'text_label' => 'Answer Text',
        'correct_status' => 'Answer Status',
        'correct' => 'Correct Answer',
        'incorrect' => 'Incorrect Answer',
        'status' => 'Option Status',
        'active' => 'Active',
        'inactive' => 'Inactive',
        'order' => 'Order',
    ],

    'answer_status' => [
        'section_label' => 'Answer Status',
        'heading' => 'Option Result',
        'correct' => 'This option is the correct answer',
        'incorrect' => 'This option is not the correct answer',
    ],

    'management' => [
        'section_label' => 'Actions',
        'heading' => 'Option Management',
    ],

    'question_type' => [
        'section_label' => 'Question Type',
        'heading' => 'Answer Method',

        'multiple_choice' => [
            'title' => 'Multiple Choice',
            'description' => 'The student selects one answer from several options.',
        ],

        'true_false' => [
            'title' => 'True or False',
            'description' => 'The student determines whether the statement is true or false.',
        ],

        'text' => [
            'title' => 'Text Answer',
            'description' => 'The student writes the answer themselves.',
        ],
    ],

    'question_info' => [
        'section_label' => 'Question Information',
        'heading' => 'Settings',
        'points' => 'Points',
        'sort_order' => 'Question Order',
        'options_count' => 'Number of Options',
    ],

    'question_status' => [
        'section_label' => 'Status',
        'heading' => 'Question Status',
        'active' => 'Active Question',
        'inactive' => 'Inactive Question',
    ],

    'note' => [
        'title' => 'Note',
        'true_false' => 'For true/false questions, there must be only one correct answer.',
        'multiple_choice' => 'Make sure to select the correct answer so the system can grade the student’s answer.',
        'text' => 'Text-answer questions do not require answer options.',
    ],

    'delete' => [
        'confirm' => 'Are you sure you want to delete this option? This action cannot be undone.',
    ],
],

'quiz_option_edit' => [
    'page_title' => 'Edit Answer Option',
    'header_label' => 'Option Management',
    'title' => 'Edit Answer Option',
    'description' => 'Edit the option text, order, status, and specify whether it is a correct answer.',

    'actions' => [
        'back' => 'Back to Options',
        'view' => 'View Option',
        'cancel' => 'Cancel',
        'save' => 'Save Changes',
        'delete' => 'Delete Option',
    ],

    'alerts' => [
        'error_title' => 'Unable to Update Option',
        'error_description' => 'Please review the entered information and correct the errors.',
    ],

    'question' => [
        'section_label' => 'Question',
        'heading' => 'Question Associated with the Option',
        'has_explanation' => 'Answer explanation available',
    ],

    'option' => [
        'section_label' => 'Edit Option',
        'heading' => 'Answer Information',

        'text' => 'Option Text',
        'text_placeholder' => 'Write the answer option...',
        'text_help' => 'You can edit the answer text without changing the question associated with it.',

        'sort_order' => 'Option Order',
        'sort_placeholder' => '0',
        'sort_help' => 'The lowest number appears first.',

        'status' => 'Option Status',
        'active' => 'Active Option',
        'inactive' => 'Inactive Option',
        'status_help' => 'When the option is disabled, it will not be shown to the student.',
    ],

    'correct_answer' => [
        'section_label' => 'Correct Answer',
        'title' => 'Correct Answer Status',
        'true_false' => 'There can be only one correct option for this question.',
        'multiple_choice' => 'Select the option if this is the correct answer.',
        'correct' => 'Correct Answer',
    ],

    'danger' => [
        'section_label' => 'Danger Zone',
        'title' => 'Delete Option',
        'heading' => 'Delete Answer Option',
        'description' => 'Permanently delete this option from the question. This action cannot be undone.',
        'confirm' => 'Are you sure you want to delete this option? This action cannot be undone.',
    ],

    'question_type' => [
        'section_label' => 'Question Type',
        'heading' => 'Answer Method',

        'multiple_choice' => [
            'title' => 'Multiple Choice',
            'description' => 'The student selects one answer from several options.',
        ],

        'true_false' => [
            'title' => 'True or False',
            'description' => 'The student determines whether the statement is true or false.',
        ],

        'text' => [
            'title' => 'Text Answer',
            'description' => 'The student writes the answer themselves.',
        ],
    ],

    'status' => [
        'section_label' => 'Option Status',
        'heading' => 'Quick Information',
        'number' => 'Option Number',
        'order' => 'Order',
        'answer' => 'Answer',
        'correct' => 'Correct',
        'incorrect' => 'Incorrect',
    ],

    'question_info' => [
        'section_label' => 'Question',
        'heading' => 'Question Information',
        'points' => 'Points',
        'options_count' => 'Number of Options',
        'status' => 'Question Status',
        'active' => 'Active',
        'inactive' => 'Inactive',
    ],

    'note' => [
        'title' => 'Note',
        'true_false' => 'When this option is marked as correct, the system will automatically mark the other options as incorrect.',
        'multiple_choice' => 'Make sure there is at least one correct answer so the question can be graded correctly.',
        'text' => 'Text-answer questions do not use predefined options.',
    ],
],

'settings' => [
    'page_title' => 'Education Settings',
    'title' => 'Education Settings',
    'description' => 'Manage payment and bank account information for the education section.',

    'alerts' => [
        'validation_title' => 'Please correct the following errors:',
    ],

    'payment' => [
        'section_title' => 'Payment Settings',
        'section_description' => 'Bank account information and payment method',

        'status_section' => 'Payment Status',
        'receiving_payments' => 'Receive Payments',
        'receiving_payments_description' => 'When disabled, students will not see the payment option.',
        'enable' => 'Enable Payments',

        'bank_section' => 'Bank Account Information',

        'bank_name' => 'Bank Name',
        'bank_name_placeholder' => 'Example: Al Rajhi Bank',

        'account_name' => 'Account Holder Name',
        'account_name_placeholder' => 'Account holder name',

        'account_number' => 'Account Number',
        'account_number_placeholder' => 'Bank account number',

        'iban' => 'IBAN',
        'iban_placeholder' => 'SA00 0000 0000 0000 0000 0000',

        'instructions_section' => 'Payment Instructions',
        'instructions_label' => 'Instructions Shown to the Student',
        'instructions_placeholder' => 'Write the payment and bank transfer instructions for students here...',
        'instructions_help' => 'You can provide bank transfer steps and any information the student needs to complete the payment.',
    ],

    'actions' => [
        'save' => 'Save Settings',
        'close' => 'Close',
    ],
],

'student_lessons' => [
    'page_title' => 'Student Lessons',

    'header' => [
        'education' => 'Education',
        'title' => 'Student Lessons',
        'description' => 'Manage lessons assigned to students and track their learning progress.',
    ],

    'actions' => [
        'assign_lesson' => 'Assign Lesson',
        'filter' => 'Filter',
        'reset' => 'Reset',
        'view' => 'View Lesson',
        'edit' => 'Edit Lesson',
        'assign_first' => 'Assign First Lesson',
    ],

    'statistics' => [
        'total' => 'Total Lessons',
        'assigned' => 'Assigned',
        'in_progress' => 'In Progress',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
    ],

    'filters' => [
        'search' => 'Search',
        'search_placeholder' => 'Search by student name, email, or lesson title...',
        'status' => 'Status',
        'all_statuses' => 'All Statuses',
        'assigned' => 'Assigned',
        'in_progress' => 'In Progress',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
    ],

    'table' => [
        'title' => 'Student Lessons',
        'student' => 'Student',
        'lesson' => 'Lesson',
        'status' => 'Status',
        'assigned_date' => 'Assigned Date',
        'session' => 'Session',
        'actions' => 'Actions',
        'lesson_count_singular' => 'Lesson',
        'lesson_count_plural' => 'Lessons',
        'original_lesson' => 'Original Lesson:',
        'session_number' => 'Session #:number',
        'no_title' => 'Untitled Lesson',
        'unknown_student' => 'Unknown Student',
        'empty_date' => '—',
    ],

    'status' => [
        'assigned' => 'Assigned',
        'in_progress' => 'In Progress',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
    ],

    'empty' => [
        'title' => 'No Student Lessons',
        'description' => 'There are currently no student lessons matching the selected search or filter criteria.',
    ],
],

'student_lesson_create' => [

    'page_title' => 'Create Student Lesson',

    'header' => [
        'education' => 'Education',
        'student_lessons' => 'Student Lessons',
        'create' => 'Create',

        'title' => 'Create Student Lesson',

        'description' => 'Select the student, then choose the paid and confirmed booking under which the session will be created.',
    ],

    'actions' => [
        'back' => 'Back to Student Lessons',
        'cancel' => 'Cancel',
        'create' => 'Create Student Lesson',
    ],

    'validation' => [
        'title' => 'Please correct the following errors:',
    ],

    'student_booking' => [
        'section_label' => 'Student & Booking',
        'title' => 'Student & Booking',
        'description' => 'Select the student, then choose a paid and confirmed booking.',

        'student' => [
            'label' => 'Student',
            'placeholder' => 'Select Student',
        ],

        'booking' => [
            'label' => 'Student Booking',
            'placeholder_initial' => 'Select a student first',
            'placeholder' => 'Select Paid & Confirmed Booking',

            'remaining' => 'session remaining',
            'remaining_plural' => 'sessions remaining',

            'unpaid' => 'Unpaid',
            'unconfirmed' => 'Unconfirmed',
            'no_remaining' => 'No Sessions Remaining',

            'empty_initial' => 'Select a student to view paid and confirmed bookings.',
            'empty_no_bookings' => 'This student has no paid and confirmed booking with remaining sessions.',
        ],
    ],

    'booking_details' => [
        'title' => 'Booking Details',

        'total_sessions' => 'Total Sessions',
        'created_sessions' => 'Created Sessions',
        'remaining' => 'Remaining',

        'payment' => 'Payment:',
        'booking_status' => 'Booking Status:',

        'payment_status' => [
            'undefined' => 'Undefined',
            'paid' => 'Paid',
            'approved' => 'Approved',
            'pending' => 'Pending',
            'unpaid' => 'Unpaid',
            'failed' => 'Payment Failed',
            'cancelled' => 'Cancelled',
        ],

        'status' => [
            'undefined' => 'Undefined',
            'pending' => 'Pending',
            'confirmed' => 'Confirmed',
            'approved' => 'Approved',
            'active' => 'Active',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
            'rejected' => 'Rejected',
        ],
    ],

    'session' => [
        'label' => 'Session Number',
        'placeholder' => 'Calculated automatically',
        'help' => 'If left empty, the next session number will be created automatically within the booking.',
    ],

    'source_lesson' => [
        'label' => 'General Lesson',
        'optional' => 'Optional',
        'without_lesson' => 'No General Lesson',
        'help' => 'You can select a general lesson as the source of the student lesson content, or leave it empty if the lesson is specific to the booking.',
    ],

    'lesson_data' => [
        'section_label' => 'Lesson Data',
        'title' => 'Lesson Data',
        'description' => 'Enter the information that will be shown to the student.',

        'title_field' => [
            'label' => 'Student Lesson Title',
            'placeholder' => 'Enter the title of the student lesson',
        ],

        'description_field' => [
            'label' => 'Lesson Description',
            'placeholder' => 'Enter a description for the student lesson...',
        ],

        'status' => [
            'label' => 'Lesson Status',
            'assigned' => 'Assigned',
            'in_progress' => 'In Progress',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
        ],

        'assigned_at' => [
            'label' => 'Assigned At',
        ],

        'notes' => [
            'label' => 'Notes',
            'placeholder' => 'Add notes specific to this lesson...',
        ],

        'active' => [
            'title' => 'Active Lesson',
            'description' => 'Make the lesson visible and available to the student.',
        ],
    ],

    'submit' => [
        'invalid_booking' => 'You must select a paid and confirmed booking with remaining sessions.',
        'creating' => 'Creating lesson...',
    ],

],

'student_lesson_show' => [
    'page_title' => 'Student Lesson Details',

    'header' => [
        'dashboard' => 'Dashboard',
        'student_lessons' => 'Student Lessons',
        'current' => 'Lesson Details',
        'title' => 'Student Lesson Details',
        'description' => 'View the details, information, and current status of the lesson assigned to the student.',
    ],

    'actions' => [
        'back' => 'Back to Student Lessons',
        'manage_content' => 'Manage Content',
        'edit' => 'Edit Lesson',
        'start' => 'Start Lesson',
        'complete' => 'Complete Lesson',
        'cancel' => 'Cancel Lesson',
        'delete' => 'Delete',
    ],

    'student' => [
        'title' => 'Student Information',
        'description' => 'Information about the student associated with this lesson.',
        'name' => 'Name',
        'email' => 'Email',
        'phone' => 'Phone',
        'unknown' => 'No student is associated with this lesson.',
    ],

    'lesson' => [
        'title' => 'Lesson Information',
        'description' => 'Details of the general lesson assigned to the student.',
        'number' => 'Lesson Number',
        'slug' => 'Short Link',
        'description_label' => 'Lesson Description',
        'not_found' => 'No general lesson is associated with this lesson.',
    ],

    'student_lesson' => [
        'title' => 'Student Lesson',
        'description' => 'The student-specific version of the lesson.',
        'lesson_title' => 'Lesson Title',
        'number' => 'Student Lesson Number',
        'session_number' => 'Session Number',
        'status' => 'Status',
        'active' => 'Active',
        'inactive' => 'Inactive',
        'description_label' => 'Lesson Description',
    ],

    'assignment' => [
        'title' => 'Assignment Information',
        'description' => 'Details of assigning the lesson to the student.',
        'number' => 'Assignment Number',
        'status' => 'Assignment Status',
        'date' => 'Assigned Date',
        'not_found' => 'No assignment record is associated with this lesson.',

        'statuses' => [
            'assigned' => 'Assigned',
            'in_progress' => 'In Progress',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
            'canceled' => 'Cancelled',
        ],
    ],

    'booking' => [
        'title' => 'Booking Information',
        'description' => 'Details of the booking associated with this lesson.',
        'number' => 'Booking Number',
        'status' => 'Booking Status',
        'scheduled_at' => 'Scheduled Time',
        'not_found' => 'No booking is associated with this lesson.',

        'statuses' => [
            'pending' => 'Pending',
            'confirmed' => 'Confirmed',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
            'canceled' => 'Cancelled',
        ],
    ],

    'status' => [
        'title' => 'Lesson Status',
        'description' => 'The current status of the student lesson.',
        'pending' => 'Pending',
        'assigned' => 'Assigned',
        'in_progress' => 'In Progress',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
        'canceled' => 'Cancelled',
    ],

    'dates' => [
        'title' => 'Lesson Dates',
        'description' => 'Important dates associated with this lesson.',
        'assigned_at' => 'Assigned Date',
        'started_at' => 'Start Date',
        'completed_at' => 'Completion Date',
        'empty' => 'No dates have been recorded for this lesson yet.',
    ],

    'notes' => [
        'title' => 'Notes',
        'description' => 'Additional notes associated with this lesson.',
    ],

    'content' => [
        'title' => 'Lesson Content',
        'description' => 'Content available for this student-specific lesson.',
        'default_title' => 'Lesson Content',
        'not_found' => 'No content is currently available for this lesson.',

        'types' => [
            'text' => 'Text',
            'video' => 'Video',
            'audio' => 'Audio',
            'image' => 'Image',
            'file' => 'File',
            'quiz' => 'Quiz',
            'link' => 'Link',
        ],
    ],

    'management' => [
        'title' => 'Lesson Actions',
        'description' => 'Manage the current status of the lesson.',
        'confirm_cancel' => 'Are you sure you want to cancel this lesson?',
        'confirm_delete' => 'Are you sure you want to permanently delete this student lesson?',
    ],
],

'student_lesson_edit' => [

    'page_title' => 'Edit Student Lesson',

    'header' => [
        'dashboard' => 'Dashboard',
        'student_lessons' => 'Student Lessons',
        'current' => 'Edit',
        'title' => 'Edit Student Lesson',
        'description' => 'Update the student lesson information and settings.',
    ],

    'actions' => [
        'view' => 'View Lesson',
        'back' => 'Back to Student Lessons',
        'cancel' => 'Cancel',
        'save' => 'Save Changes',
    ],

    'validation' => [
        'title' => 'Please correct the following errors:',
    ],

    'form' => [
        'title' => 'Student Lesson Information',
        'description' => 'Edit the basic information for this student lesson.',
    ],

    'fields' => [
        'student' => 'Student',
        'source_lesson' => 'Source Lesson',
        'title' => 'Title',
        'description' => 'Description',
        'status' => 'Status',
        'assigned_at' => 'Assigned At',
        'notes' => 'Notes',
    ],

    'placeholders' => [
        'student' => 'Select Student',
        'lesson' => 'Select Source Lesson',
        'title' => 'Enter lesson title...',
        'description' => 'Enter a short description of the lesson...',
        'notes' => 'Add notes for this lesson...',
    ],

    'hints' => [
        'title' => 'The student lesson title can be edited independently from the source lesson title.',
        'description' => 'You can add a description specific to this student lesson.',
        'notes' => 'These notes are for administration and can be used to track the lesson.',
    ],

    'statuses' => [
        'pending' => 'Pending',
        'assigned' => 'Assigned',
        'in_progress' => 'In Progress',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
    ],

    'active' => [
        'title' => 'Lesson is Active',
        'description' => 'This lesson will be available and active for the student.',
    ],

    'current_info' => [
        'title' => 'Current Information',
        'description' => 'Current lesson information before editing.',
        'student_lesson_number' => 'Student Lesson ID',
        'source_lesson' => 'Source Lesson',
        'created_at' => 'Created At',
        'updated_at' => 'Last Updated',
        'started_at' => 'Started At',
        'completed_at' => 'Completed At',
    ],

    'assignment' => [
        'title' => 'Assignment',
        'description' => 'The current assignment connection for this student lesson.',
        'number' => 'Assignment',
        'connected' => 'This lesson is connected to an assignment.',
        'not_found' => 'No assignment is connected to this lesson.',
    ],

    'source_notice' => [
        'title' => 'Source Lesson',
        'description' => 'This lesson is connected to the selected general lesson as its source. You can change the source above.',
    ],

    'warning' => [
        'title' => 'Notice',
        'description' => 'Changing the student or source lesson may affect this lesson and its related content.',
    ],

    'preview' => [
        'no_description' => 'This lesson has no description.',
        'original_description' => 'Original Lesson Description',
    ],
],

'student_lesson_content' => [

    'page_title' => 'Lesson Content',

    'header' => [
        'student_lessons' => 'Student Lessons',
        'content' => 'Content',
        'title' => 'Lesson Content',
        'description' => 'Manage the educational content available inside this student-specific lesson.',
    ],

    'actions' => [
        'back_to_lesson' => 'Back to Lesson',
        'add_content' => 'Add Content',
        'add_first_content' => 'Add First Content',
    ],

    'content' => [
        'default_title' => 'Student Lesson',
        'count_one' => 'Item',
        'count_many' => 'Items',
        'source_label' => 'Source General Lesson',
        'untitled' => 'Untitled Content',
    ],

    'status' => [
        'active' => 'Active',
        'inactive' => 'Inactive',
    ],

    'actions_item' => [
        'view' => 'View Content',
        'edit' => 'Edit Content',
        'delete' => 'Delete Content',
    ],

    'empty' => [
        'title' => 'No Content Yet',
        'description' => 'This student-specific lesson does not contain any content yet. You can manually add educational content.',
    ],

    'delete' => [
        'confirm' => 'Are you sure you want to delete this content?',
    ],

],

'student_lesson_content_create' => [

    'page_title' => 'Add Lesson Content',

    'header' => [
        'student_lessons' => 'Student Lessons',
        'content' => 'Content',
        'add' => 'Add',
        'title' => 'Add Lesson Content',
        'description' => 'Add educational content to this student lesson.',
    ],

    'actions' => [
        'back_to_content' => 'Back to Content',
        'cancel' => 'Cancel',
        'save' => 'Save Content',
    ],

    'source_lesson' => [
        'title' => 'Source General Lesson',
        'description' => 'You can use the general lesson content as a source for this student-specific lesson.',
    ],

    'form' => [
        'type' => [
            'label' => 'Content Type',
            'placeholder' => 'Select Content Type',
            'text' => 'Text',
            'image' => 'Image',
            'link' => 'Link',
            'file' => 'File',
        ],

        'title' => [
            'label' => 'Title',
            'placeholder' => 'Content Title',
        ],

        'description' => [
            'label' => 'Description',
            'placeholder' => 'Short description of the content...',
        ],

        'content' => [
            'label' => 'Text Content',
            'placeholder' => 'Write the lesson content here...',
            'help' => 'This field is used when the content type is Text.',
        ],

        'url' => [
            'label' => 'URL',
            'placeholder' => 'https://example.com',
            'help' => 'This field is used when the content type is Link.',
        ],

        'file' => [
            'label' => 'File',
            'help' => 'This field is used when adding an image or file.',
        ],

        'sort_order' => [
            'label' => 'Display Order',
        ],

        'status' => [
            'label' => 'Status',
            'active' => 'Active',
            'inactive' => 'Inactive',
        ],
    ],

    'type_info' => [
        'text' => 'The text content will be displayed directly inside the student lesson.',
        'link' => 'Add the URL that the student should open to access this content.',
        'image' => 'Upload an image to display within the lesson content.',
        'file' => 'Upload a file that the student can access from inside the lesson.',
    ],

],

'student_lesson_content_show' => [
    'page_title' => 'View Lesson Content',

    'header' => [
        'student_lessons' => 'Student Lessons',
        'student_lesson_default' => 'Student Lesson',
        'content' => 'Content',
        'title' => 'View Lesson Content',
        'description' => 'View the educational content associated with this student lesson.',
    ],

    'actions' => [
        'back_to_content' => 'Back to Content',
        'edit_content' => 'Edit Content',
        'edit' => 'Edit',
        'delete' => 'Delete',
    ],

    'types' => [
        'text' => 'Text',
        'image' => 'Image',
        'link' => 'Link',
        'file' => 'File',
        'default' => 'Content',
    ],

    'file' => [
        'units' => [
            'megabyte' => 'MB',
            'kilobyte' => 'KB',
            'byte' => 'Bytes',
        ],
        'default_name' => 'Attached File',
        'open' => 'Open File',
    ],

    'content' => [
        'untitled' => 'Untitled Content',
        'type_label' => 'Content Type:',
    ],

    'status' => [
        'active' => 'Active',
        'inactive' => 'Inactive',
    ],

    'sections' => [
        'description' => 'Description',
        'text_content' => 'Text Content',
        'image' => 'Image',
        'link' => 'Link',
        'attached_file' => 'Attached File',
        'original_content' => 'Original Content',
        'content_information' => 'Content Information',
    ],

    'empty' => [
        'no_text_title' => 'No Text',
        'no_text_description' => 'No text has been added to this content.',

        'no_image_title' => 'No Image',
        'no_image_description' => 'No image has been attached to this content.',

        'no_link_title' => 'No Link',
        'no_link_description' => 'No link has been added to this content.',

        'no_file_title' => 'No File',
        'no_file_description' => 'No file has been attached to this content.',
    ],

    'image' => [
        'default_alt' => 'Content Image',
    ],

    'source' => [
        'label' => 'Copied from General Lesson',
        'untitled' => 'Untitled Original Content',
        'note' => 'This content was added to the student lesson from the general lesson content.',
    ],

    'meta' => [
        'type' => 'Type',
        'sort_order' => 'Content Order',
        'status' => 'Status',
        'file_name' => 'File Name',
        'mime_type' => 'File Type',
        'file_size' => 'File Size',
    ],

    'delete' => [
        'confirm' => 'Are you sure you want to delete this content?',
    ],
],

'student_lesson_content_edit' => [
    'page_title' => 'Edit Lesson Content',

    'header' => [
        'education' => 'Education',
        'student_lessons' => 'Student Lessons',
        'content' => 'Content',
        'edit' => 'Edit',
        'title' => 'Edit Lesson Content',
        'description' => 'Update this content, and you can also add multiple new content items.',
    ],

    'actions' => [
        'back_to_content' => 'Back to Content',
        'cancel' => 'Cancel',
        'save_changes' => 'Save Changes',
        'saving' => 'Saving...',
    ],

    'form' => [
        'information' => [
            'title' => 'Content Information',
            'description' => 'Edit the current content.',
        ],

        'title' => [
            'label' => 'Title',
            'placeholder' => 'Enter content title...',
        ],

        'type' => [
            'label' => 'Content Type',
            'text' => 'Text',
            'image' => 'Image',
            'link' => 'Link',
            'file' => 'File',
        ],

        'sort_order' => [
            'label' => 'Display Order',
            'placeholder' => 'Automatic',
        ],

        'type_info' => [
            'label' => 'Content Type:',
            'description' => 'Choose whether the lesson content is text, an image, an external link, or a file.',
        ],

        'description' => [
            'label' => 'Description',
            'placeholder' => 'Add a short description for this content...',
        ],

        'content' => [
            'label' => 'Content',
            'placeholder' => 'Write the lesson content here...',
        ],

        'url' => [
            'label' => 'URL',
            'placeholder' => 'https://example.com/...',
        ],

        'file' => [
            'label' => 'Replace File',
            'kilobyte' => 'KB',
        ],

        'image' => [
            'label' => 'Replace Image',
            'current' => 'Current image:',
            'preview_alt' => 'New image preview',
        ],

        'status' => [
            'label' => 'Status',
            'active_description' => 'Content is active and visible to the student',
        ],
    ],

    'additional_content' => [
        'title' => 'Add More Content',
        'description' => 'You can add multiple new content items before saving.',
        'add_item' => 'Add Content Item',
        'new_item' => 'New Content',
        'remove' => 'Remove this content',
        'empty' => 'No additional content has been added yet.',
        'type' => 'Type',
        'title_label' => 'Title',
        'title_placeholder' => 'Content title...',
        'description_label' => 'Description',
        'description_placeholder' => 'Description...',
        'content_label' => 'Content',
        'content_placeholder' => 'Content...',
        'url_label' => 'URL',
        'file_label' => 'File / Image',
    ],

    'sidebar' => [
        'lesson_information' => 'Lesson Information',
        'lesson' => 'Lesson',
        'student_lesson' => 'Student Lesson',
        'identifier' => 'Identifier',
        'student' => 'Student',
        'content_number' => 'Content Number',
        'type' => 'Type',
        'order' => 'Order',

        'source_content' => 'Original Content',
        'source' => 'Source Content',
        'original_content' => 'Original Content',

        'editing_tips' => 'Editing Tips',
        'tip_edit' => 'You can edit the current content normally.',
        'tip_replace' => 'When you upload a replacement image or file, the old file will be replaced.',
        'tip_add' => 'Use Add Content Item to add multiple new items in a single save operation.',
        'tip_storage' => 'New files and images are stored in:',

        'danger_zone' => 'Danger Zone',
        'danger_description' => 'Deleting this content is permanent and cannot be undone.',
        'delete_content' => 'Delete Content',
    ],

    'delete' => [
        'confirm' => 'Are you sure you want to delete this content?',
    ],
],

'students' => [

    'page_title' => 'Students',

    'header' => [
        'eyebrow' => 'Student Management',
        'title' => 'Students',
        'description' => 'Manage registered students and monitor their information, educational status, and approval status.',
    ],

    'actions' => [
        'add_student' => 'Add Student',
        'view' => 'View Student',
        'edit' => 'Edit Student',
        'delete' => 'Delete Student',
        'activate' => 'Activate Account',
        'deactivate' => 'Deactivate Account',
    ],

    'statistics' => [
        'total' => [
            'label' => 'Total Students',
            'description' => 'All registered students',
        ],
        'active' => [
            'label' => 'Active Students',
            'description' => 'Active accounts',
        ],
        'pending' => [
            'label' => 'Pending Approval',
            'description' => 'Requests awaiting review',
        ],
        'approved' => [
            'label' => 'Approved Students',
            'description' => 'Approved accounts',
        ],
        'goals' => [
            'label' => 'Learning Goals',
            'description' => 'Students with a learning goal',
        ],
        'inactive' => [
            'label' => 'Inactive',
            'description' => 'Inactive accounts',
        ],
    ],

    'filters' => [
        'tools' => 'Search Tools',
        'title' => 'Search & Filter',
        'reset' => 'Reset',

        'search' => [
            'label' => 'Search',
            'placeholder' => 'Search by student name, email, or phone...',
        ],

        'account_status' => [
            'label' => 'Account Status',
            'all' => 'All Statuses',
            'active' => 'Active',
            'inactive' => 'Inactive',
        ],

        'approval_status' => [
            'label' => 'Approval Status',
            'all' => 'All Approval Statuses',
            'pending' => 'Pending Approval',
            'approved' => 'Approved',
            'rejected' => 'Rejected',
        ],

        'education_level' => [
            'label' => 'Education Level',
            'all' => 'All Levels',
        ],

        'sort' => [
            'label' => 'Sort',
            'latest' => 'Newest',
            'oldest' => 'Oldest',
            'name_asc' => 'Name A–Z',
            'name_desc' => 'Name Z–A',
        ],

        'apply' => 'Apply',
    ],

    'table' => [
        'eyebrow' => 'Student List',
        'title' => 'Registered Students',
        'count' => ':count Students',

        'student' => 'Student',
        'email' => 'Email',
        'phone' => 'Phone',
        'level' => 'Level',
        'approval_status' => 'Approval Status',
        'account_status' => 'Account Status',
        'registered_at' => 'Registration Date',
        'actions' => 'Actions',

        'student_role' => 'Student',
        'no_name' => 'No Name',
        'empty_value' => '—',
    ],

    'statuses' => [
        'approval' => [
            'approved' => 'Approved',
            'rejected' => 'Rejected',
            'pending' => 'Pending Approval',
        ],

        'account' => [
            'active' => 'Active',
            'inactive' => 'Inactive',
        ],
    ],

    'empty' => [
        'title' => 'No Students',
        'description' => 'No students were found matching the current search criteria.',
        'show_all' => 'View All Students',
    ],

    'pagination' => [
        'showing' => 'Showing',
        'to' => 'to',
        'of' => 'of',
        'student' => 'students',
    ],

    'confirm' => [
        'delete' => 'Are you sure you want to delete this student? This action cannot be undone.',
    ],
],

'students_create' => [

    'page_title' => 'Add Student',

    'header' => [
        'back' => 'Back to Students',
        'eyebrow' => 'Student Management',
        'title' => 'Add New Student',
        'description' => 'Add a new student to the system and enter their basic information, educational details, and account information.',
    ],

    'validation' => [
        'title' => 'Please correct the following errors:',
    ],

    'basic' => [
        'eyebrow' => 'Basic Information',
        'title' => 'Student Details',
    ],

    'education' => [
        'eyebrow' => 'Educational Information',
        'title' => 'Education Details',
    ],

    'account' => [
        'eyebrow' => 'Account Information',
        'title' => 'Login Details',
    ],

    'fields' => [

        'name' => [
            'label' => 'Student Name',
            'placeholder' => 'Enter the student full name',
        ],

        'email' => [
            'label' => 'Email Address',
            'placeholder' => 'example@email.com',
        ],

        'phone' => [
            'label' => 'Phone Number',
            'placeholder' => '05xxxxxxxx',
        ],

        'whatsapp' => [
            'label' => 'WhatsApp Number',
            'placeholder' => '9665xxxxxxxx',
        ],

        'whatsapp_reminders' => [
            'label' => 'Enable WhatsApp Reminders',
            'description' => 'This option can be used to send reminders related to lessons and bookings in the future.',
        ],

        'education_level' => [
            'label' => 'Education Level',
            'placeholder' => 'Example: Beginner, Intermediate, Advanced',
        ],

        'learning_goal' => [
            'label' => 'Learning Goal',
            'placeholder' => 'Write the goal the student wants to achieve through learning...',
        ],

        'password' => [
            'label' => 'Password',
            'placeholder' => 'Enter a password for the student',
            'description' => 'The password must be at least 8 characters or numbers.',
        ],

        'password_confirmation' => [
            'label' => 'Confirm Password',
            'placeholder' => 'Re-enter the password',
        ],

        'password_note' => 'A student account will be created using the password you specify here. The student can later change their password from their account settings.',
    ],

    'status' => [

        'eyebrow' => 'Account Status',
        'title' => 'Student Activation',

        'active' => [
            'label' => 'Active Account',
            'description' => 'When the student is created from the admin panel, they will be approved automatically. You can disable the account later from the edit page.',
        ],

    ],

    'approval' => [

        'eyebrow' => 'Student Approval',
        'title' => 'Registration Status',

        'auto_approved_title' => 'Student Automatically Approved',

        'auto_approved_description' => 'Students created directly from the admin panel are registered with the status',

        'approved' => 'Approved',

        'auto_approved_suffix' => 'automatically and do not require any additional approval action.',

    ],

    'actions' => [
        'cancel' => 'Cancel',
        'submit' => 'Add Student',
    ],

],

'students_show' => [

    'page_title' => 'Student Details',

    'header' => [
        'back' => 'Back to Students',
        'eyebrow' => 'Student Management',
        'title' => 'Student Details',
        'description' => 'View student information, contact details, approval status, and bookings.',
    ],

    'actions' => [
        'edit' => 'Edit Student',
    ],

    'temporary_password' => [
        'title' => 'Temporary Password',
        'message' => 'A temporary password has been created for the student:',
        'note' => 'Keep it secure and share it with the student when needed.',
    ],

    'profile' => [
        'role' => 'Student',
        'no_name' => 'No Name',
    ],

    'info' => [
        'email' => 'Email Address',
        'phone' => 'Phone Number',
        'whatsapp' => 'WhatsApp',
        'education_level' => 'Education Level',
        'approval_status' => 'Student Approval Status',
        'registered_at' => 'Registration Date',
    ],

    'statistics' => [
        'bookings' => 'Total Bookings',
        'level' => 'Level',
        'account_status' => 'Account Status',
        'approval_status' => 'Approval Status',
    ],

    'statuses' => [

        'account' => [
            'active' => 'Active',
            'inactive' => 'Inactive',
        ],

        'approval' => [
            'approved' => 'Approved',
            'pending' => 'Pending Approval',
            'rejected' => 'Rejected',
            'unknown' => 'Not Specified',
        ],

        'whatsapp' => [
            'active' => 'Enabled',
            'inactive' => 'Disabled',
        ],

    ],

    'common' => [
        'not_specified' => 'Not Specified',
    ],

    'details' => [

        'eyebrow' => 'Personal Information',
        'title' => 'Student Details',

        'fields' => [
            'full_name' => 'Full Name',
            'email' => 'Email Address',
            'phone' => 'Phone Number',
            'whatsapp' => 'WhatsApp Number',
            'whatsapp_reminders' => 'WhatsApp Reminders',
            'education_level' => 'Education Level',
            'approval_status' => 'Student Approval Status',
            'registered_at' => 'Registration Date',
            'updated_at' => 'Last Updated',
            'account_status' => 'Account Status',
        ],

    ],

    'learning_goal' => [

        'eyebrow' => 'Learning Goal',
        'title' => 'What Does the Student Want to Learn?',
        'empty' => 'The student has not specified a learning goal yet.',

    ],

    'approval' => [

        'eyebrow' => 'Registration Status',
        'title' => 'Student Approval Status',

        'current_status' => 'Current Status',
        'account_status' => 'Account Status',
        'description_label' => 'Status Description',

        'account_active' => 'Account Active',
        'account_inactive' => 'Account Inactive',

        'descriptions' => [
            'approved' => 'The student can use their account as an approved student.',
            'pending' => 'The student registration request is still awaiting administrative review and approval.',
            'rejected' => 'The student registration request has been rejected.',
            'unknown' => 'No approval status has been specified for this student.',
        ],

    ],

    'bookings' => [

        'eyebrow' => 'Bookings',
        'title' => 'Student Bookings',
        'count_label' => 'Bookings',

        'booking_number' => 'Booking #:id',
        'details' => 'Booking Details',

        'view_all' => 'View All Bookings',

        'status' => [
            'confirmed' => 'Confirmed',
            'pending' => 'Pending',
            'cancelled' => 'Cancelled',
            'completed' => 'Completed',
            'no_show' => 'No Show',
        ],

        'empty' => [
            'title' => 'No Bookings',
            'description' => 'This student has not made any bookings yet.',
        ],

    ],

    'footer' => [
        'back' => 'Back to Students List',
        'edit' => 'Edit Student Details',
    ],

],

'student_edit' => [

    'page_title' => 'Edit Student',

    'header' => [
        'back_to_student' => 'Back to Student Details',
        'eyebrow' => 'Student Management',
        'title' => 'Edit Student Information',
        'description' => 'Edit the student’s basic information, educational details, account status, and approval status.',
    ],

    'student_id' => [
        'label' => 'Student ID',
    ],

    'validation' => [
        'title' => 'Please correct the following errors:',
    ],

    'basic' => [
        'section_label' => 'Basic Information',
        'title' => 'Student Details',
    ],

    'fields' => [

        'name' => [
            'label' => 'Student Name',
            'placeholder' => 'Enter the student’s full name',
        ],

        'email' => [
            'label' => 'Email Address',
            'placeholder' => 'example@email.com',
        ],

        'phone' => [
            'label' => 'Phone Number',
            'placeholder' => '05xxxxxxxx',
        ],

        'whatsapp' => [
            'label' => 'WhatsApp Number',
            'placeholder' => '05xxxxxxxx',
        ],

        'whatsapp_reminders' => [
            'label' => 'WhatsApp Reminders',
            'toggle' => 'Enable Reminders',
            'description' => 'Allow lesson and booking reminders to be sent via WhatsApp.',
        ],

        'education_level' => [
            'label' => 'Education Level',
            'placeholder' => 'Example: Beginner, Intermediate, Advanced',
        ],

        'learning_goal' => [
            'label' => 'Learning Goal',
            'placeholder' => 'Write the goal the student wants to achieve through learning...',
        ],

    ],

    'education' => [
        'section_label' => 'Educational Information',
        'title' => 'Education Details',
    ],

    'approval' => [

        'section_label' => 'Student Approval Status',
        'title' => 'Account Approval',
        'status_label' => 'Student Status',

        'statuses' => [
            'pending' => 'Pending',
            'approved' => 'Approved',
            'rejected' => 'Rejected',
        ],

        'info' => [

            'approved' => [
                'title' => 'Student Approved',
                'description' => 'The student account has been approved and can use the services available to the account.',
            ],

            'rejected' => [
                'title' => 'Student Rejected',
                'description' => 'The student registration request has been rejected.',
            ],

            'pending' => [
                'title' => 'Student Pending Approval',
                'description' => 'The student registration request has not been approved yet.',
            ],

        ],

    ],

    'account' => [
        'section_label' => 'Account Status',
        'title' => 'Student Activation',
        'active_title' => 'Active Account',
        'active_description' => 'When the account is disabled, the student will not be able to use services associated with the account.',
    ],

    'password' => [
        'section_label' => 'Account Security',
        'title' => 'Change Password',
        'new_password' => 'New Password',
        'password_placeholder' => 'Leave blank to keep the current password',
        'confirm_password' => 'Confirm Password',
        'confirm_placeholder' => 'Re-enter the new password',
        'note' => 'Leave both password fields empty if you do not want to change the current password.',
    ],

    'actions' => [
        'cancel' => 'Cancel',
        'save' => 'Save Changes',
    ],

],




];

