<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Email
    |--------------------------------------------------------------------------
    */

    'email' => [
        'lesson_reminder_subject' => 'Lesson Reminder – Starting in 10 Minutes',
        'lesson_reminder_title' => 'Lesson Reminder',
        'lesson_reminder_greeting' => 'Assalamu Alaikum :name,',
        'lesson_reminder_message' => 'This is a reminder that your lesson will start in approximately 10 minutes.',
        'lesson' => 'Lesson',
        'date' => 'Date',
        'start_time' => 'Start Time',
        'end_time' => 'End Time',
        'prepare_message' => 'Please be ready to join the lesson at the scheduled time.',
        'view_booking' => 'View Booking Details',
        'success_message' => 'We wish you a successful and beneficial lesson 🌿',
        'signature' => 'Education Platform',
        'default_student' => 'Dear Student',
    ],

    /*
    |--------------------------------------------------------------------------
    | Navbar
    |--------------------------------------------------------------------------
    */

    'navbar' => [
        'home' => 'Home',
        'about' => 'About Me',
        'lessons' => 'Lessons',
        'resources' => 'Resources',
        'comments' => 'Comments',
        'contact' => 'Contact',
        'programming_site' => 'Programming Website',
        'account' => 'My Account',
        'logout' => 'Logout',
        'login' => 'Login',
        'start_learning' => 'Start Learning',
        'create_account' => 'Create Account',
        'open_menu' => 'Open Menu',
        'switch_to_english' => 'Switch to English',
        'switch_to_arabic' => 'Switch to Arabic',
        'english' => 'English',
        'arabic' => 'Arabic',
    ],

    /*
    |--------------------------------------------------------------------------
    | News
    |--------------------------------------------------------------------------
    */

    'news' => [
        'aria_label' => 'Latest News and Announcements',
        'latest_news' => 'Latest News',

        'types' => [
            'announcement' => 'Announcement',
            'lesson' => 'New Lesson',
            'update' => 'Update',
            'notice' => 'Notice',
            'general' => 'General',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Hero
    |--------------------------------------------------------------------------
    */

    'hero' => [
        'badge' => 'Quran and Arabic Language Education',

        'title_line_1' => 'A Journey Closer',
        'title_line_2' => 'to the Quran and Arabic Language',

        'description' => 'I share lessons and educational resources that help you learn the Holy Quran and Arabic in a clear, calm, and accessible way for different levels.',

        'actions' => [
            'lessons' => 'Explore Lessons',
            'about' => 'Get to Know Me',
        ],

        'meta' => [
            'quran' => [
                'title' => 'Holy Quran',
                'description' => 'Recitation and Learning',
            ],

            'arabic' => [
                'title' => 'Arabic Language',
                'description' => 'Learning and Practice',
            ],
        ],

        'visual' => [
            'image_alt' => 'Holy Quran and Arabic Language Education Website',
            'floating_title' => 'Lessons and Resources',
            'floating_description' => 'Available to you anytime',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | About
    |--------------------------------------------------------------------------
    */

    'about' => [
        'visual' => [
            'quran_badge' => 'Holy Quran',
            'book_title' => 'The Book of Allah',
            'book_ornament' => '﴿',
            'book_subtitle' => 'Guidance • Knowledge • Light',
            'arabic_title' => 'Arabic Language',
            'arabic_description' => 'The Language of the Quran',
            'quran_title' => 'Holy Quran',
            'quran_description' => 'Learning • Revision • Mastery',
        ],

        'label' => 'About Me',

        'title_line_1' => 'A Simple Journey Toward',
        'title_line_2' => 'Better Learning',

        'description' => [
            'first' => 'This website is my personal space for sharing what I offer in teaching the Holy Quran and Arabic, as well as providing resources, links, and lessons that support simple and organized learning.',

            'second' => 'I believe that learning the Quran and Arabic does not need to be complicated. It needs consistency, patience, and a clear approach that suits the needs of each learner.',
        ],

        'areas' => [
            'quran' => [
                'title' => 'Holy Quran',
                'description' => 'Recitation, revision, and memorization, with useful lessons and resources.',
            ],

            'arabic' => [
                'title' => 'Arabic Language',
                'description' => 'Helping learners develop their reading, comprehension, and Arabic language skills.',
            ],
        ],

        'values' => [
            'love' => 'Teaching with Care',
            'gradual' => 'Gradual Learning',
            'useful_knowledge' => 'Beneficial Knowledge',
        ],

        'action' => 'Discover Lessons',
    ],

    /*
    |--------------------------------------------------------------------------
    | Services
    |--------------------------------------------------------------------------
    */

    'services' => [
        'header' => [
            'badge' => 'What Do I Offer?',
            'title_line_1' => 'Learn in a Way',
            'title_line_2' => 'That Suits You',
            'description' => 'Private lessons and simplified educational content in the Holy Quran and Arabic, while taking your level and learning goals into consideration.',
        ],

        'items' => [
            'quran' => [
                'label' => 'Holy Quran',
                'title' => 'Holy Quran Education',
                'description' => 'Learn to read the Holy Quran correctly and gradually, with attention to pronunciation and articulation points.',
                'action' => 'Start Learning',
            ],

            'tajweed' => [
                'label' => 'Recitation and Tajweed',
                'title' => 'Recitation and Tajweed Correction',
                'description' => 'Improve your recitation and apply Tajweed rules practically, with error correction and step-by-step progress tracking.',
                'action' => 'Learn More',
            ],

            'memorization' => [
                'label' => 'Memorization and Revision',
                'title' => 'Quran Memorization and Revision',
                'description' => 'Create a suitable memorization and revision plan with continuous follow-up to help reinforce what you have memorized.',
                'action' => 'Start Now',
            ],

            'arabic' => [
                'label' => 'Arabic Language',
                'title' => 'Arabic Language Education',
                'description' => 'Learn Arabic through a practical approach that combines reading, writing, vocabulary, and communication according to your level.',
                'action' => 'Learn Arabic',
            ],

            'reading_writing' => [
                'label' => 'Basic Skills',
                'title' => 'Arabic Reading and Writing',
                'description' => 'Build a strong foundation in Arabic reading and writing through simple and gradual exercises.',
                'action' => 'Start from the Basics',
            ],

            'private_lessons' => [
                'label' => 'Private Education',
                'title' => 'Personalized Private Lessons',
                'description' => 'Lessons organized according to your goals and level, whether in the Holy Quran or Arabic language.',
                'action' => 'Contact Me',
            ],
        ],

        'controls' => [
            'previous' => 'Previous Service',
            'next' => 'Next Service',
            'hint' => 'Swipe to explore services',
        ],

        'cta' => [
            'question' => 'Have a specific learning goal?',
            'message' => 'Tell me what you would like to learn, and we will choose the right starting point.',
            'action' => 'Contact Me',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Schedule
    |--------------------------------------------------------------------------
    */

    'schedule' => [
        'header' => [
            'badge' => 'Available Appointments',
            'title_line_1' => 'Choose the Time',
            'title_line_2' => 'That Suits You',
            'description' => 'Lesson times vary according to available days. Choose a suitable day and time, then book your lesson easily.',
        ],

        'days' => [
            'sunday' => 'Sunday',
            'monday' => 'Monday',
            'tuesday' => 'Tuesday',
            'wednesday' => 'Wednesday',
            'thursday' => 'Thursday',
            'friday' => 'Friday',
            'saturday' => 'Saturday',
        ],

        'status' => [
            'available' => 'Available',
            'unavailable' => 'Unavailable',
        ],

        'slots' => [
            'available_times' => 'Available Times',
            'unavailable_message' => 'No available appointments',
            'booking' => 'Book a Lesson',
        ],

        'note' => [
            'question' => 'Would a different time suit you?',
            'message' => 'You can contact me and we will try to find a suitable appointment.',
            'contact' => 'Contact Me',
        ],

        'aria' => [
            'schedule' => 'Available appointment schedule',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resources
    |--------------------------------------------------------------------------
    */

    'resources' => [
        'header' => [
            'badge' => 'Educational Resources',
            'title_line_1' => 'Learn at',
            'title_line_2' => 'Any Time',
            'description' => 'A curated collection of lessons and educational materials to help you continue your learning journey.',
        ],

        'navigation' => [
            'previous' => 'Previous',
            'next' => 'Next',
        ],

        'categories' => [
            'quran' => [
                'category' => 'Holy Quran',
                'title' => 'Quran Lessons',
                'description' => 'Lessons and materials to help you improve reading, recitation, and make steady progress.',
                'available_action' => 'Explore Lessons',
                'unavailable' => 'Lessons will be available soon',
            ],

            'tajweed' => [
                'category' => 'Tajweed',
                'title' => 'Tajweed Lessons',
                'description' => 'Simple materials to help you understand Tajweed rules and apply them during recitation.',
                'available_action' => 'Explore Lessons',
                'unavailable' => 'Lessons will be available soon',
            ],

            'arabic' => [
                'category' => 'Arabic Language',
                'title' => 'Learn Arabic',
                'description' => 'Practical lessons and materials to help you develop reading, writing, and vocabulary skills.',
                'available_action' => 'Explore Lessons',
                'unavailable' => 'Lessons will be available soon',
            ],

            'videos' => [
                'category' => 'Videos',
                'title' => 'Educational Videos',
                'description' => 'Short visual content that you can watch and benefit from at any time.',
                'available_action' => 'Watch Videos',
                'unavailable' => 'Videos will be available soon',
            ],

            'materials' => [
                'category' => 'Educational Materials',
                'title' => 'Files and Supporting Materials',
                'description' => 'Files, summaries, and supporting materials you can refer to during your learning journey.',
                'available_action' => 'View Materials',
                'unavailable' => 'Materials will be available soon',
            ],
        ],

        'footer' => [
            'message' => 'More lessons and educational materials will be added continuously.',
            'all_resources' => 'All Resources',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resources Page
    |--------------------------------------------------------------------------
    */

    'resources_page' => [

        'page_title' => 'Educational Resources',

        'breadcrumb' => [
            'home' => 'Home',
            'resources' => 'Educational Resources',
        ],

        'category' => [
            'lesson_count' => '{0} Lessons|{1} Lesson|[2,*] Lessons',
            'available_lessons' => 'Available Lessons',
            'choose_lesson' => 'Choose the lesson you want to start with',
            'all_resources' => 'All Resources',
        ],

        'hero' => [
            'badge' => 'Educational Library',
            'title_line_1' => 'Resources to Help You',
            'title_line_2' => 'Keep Learning',
            'description' => 'Explore a collection of lessons and educational materials designed to help you develop your skills in the Quran, Tajweed, and Arabic, with easy access to each lesson’s content.',
        ],

        'stats' => [
            'lessons' => 'Available Lessons',
            'categories' => 'Educational Categories',
            'materials' => 'Learning Materials',
        ],

        /*
        |--------------------------------------------------------------------------
        | Quiz Page
        |--------------------------------------------------------------------------
        */

        'quiz_page' => [

            'breadcrumb' => [
                'home' => 'Home',
                'resources' => 'Educational Resources',
            ],

            'hero' => [
                'badge' => 'Lesson Quiz',
                'fallback_description' => 'Test your understanding of the educational content and see how well you have understood the lesson.',
            ],

         'meta' => [
    'lessons' => 'Lessons',
    'minutes' => 'Minutes',
    'contents' => 'Contents',
    'quizzes' => 'Quizzes',
],

            'questions' => [
                'badge' => 'Questions',
                'title' => 'Test Your Understanding',
                'question_count' => 'Question',
                'question' => 'Question',
                'points' => 'Point',
                'points_plural' => 'Points',
                'missing_options' => 'There are no options for this question.',
            ],

            'submit' => [
                'question' => 'Have you answered all the questions?',
                'review' => 'Review your answers before submitting.',
                'button' => 'Submit Quiz',
            ],

            'sidebar' => [
                'info_title' => 'Quiz Information',
                'info_subtitle' => 'Quick Summary',
                'questions' => 'Questions',
                'pass' => 'Pass',
                'time' => 'Time',
                'attempts' => 'Attempts',
                'status' => 'Status',
                'available' => 'Available',

                'lesson_title' => 'Related Lesson',
                'lesson_subtitle' => 'This quiz belongs to this lesson',
                'view_lesson' => 'View Lesson',

                'instructions_title' => 'Before You Start',
                'instructions_subtitle' => 'Simple Tips',

                'instructions' => [
                    'read_question' => 'Read each question carefully.',
                    'choose_answer' => 'Choose the most suitable answer.',
                    'watch_time' => 'Keep an eye on the time limit.',
                    'review_answers' => 'Review your answers before submitting.',
                ],

                'back_to_lesson' => 'Back to Lesson',
                'all_resources' => 'All Resources',
            ],

            'empty' => [
                'title' => 'No Questions Available for This Quiz Yet',
                'description' => 'No questions have been added to this quiz yet.',
                'back_to_lesson' => 'Back to Lesson',
                'all_resources' => 'All Resources',
            ],

            'bottom' => [
                'back_to_lesson' => 'Back to Lesson',
                'all_resources' => 'All Resources',
                'description' => 'Keep learning and test your understanding of the content.',
            ],
        ],

        /*
        |--------------------------------------------------------------------------
        | Quiz Result Page
        |--------------------------------------------------------------------------
        */

        'quiz_result_page' => [

            'page_title' => 'Quiz Result',

            'breadcrumb' => [
                'home' => 'Home',
                'resources' => 'Educational Resources',
                'result' => 'Quiz Result',
            ],

            'hero' => [
                'label' => 'Quiz Result',
            ],

            'status' => [
                'passed' => 'Well done! You have successfully passed the quiz.',
                'failed' => 'You did not reach the required passing percentage this time.',
            ],

            'score' => [
                'label' => 'Result',
            ],

            'details' => [
                'score' => 'Score',
                'pass_percentage' => 'Pass Percentage',
                'status' => 'Quiz Status',
                'passed' => 'Passed',
                'not_passed' => 'Not Passed',
            ],

            'actions' => [
                'retry' => 'Retry Quiz',
                'back_to_lesson' => 'Back to Lesson',
                'resources' => 'Educational Resources',
            ],

            'message' => [
                'title' => 'Keep Learning',
                'description' => 'Review the lesson again and try to improve your score next time.',
            ],
        ],

        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */

        'categories' => [

            'section_label' => 'Explore by Field',

            'title' => 'Educational Categories',

            'description' => 'Choose the field you want to learn in to access related lessons and materials.',

            'names' => [
                'quran' => 'Holy Quran',
                'tajweed' => 'Tajweed',
                'arabic' => 'Arabic Language',
                'videos' => 'Videos',
                'materials' => 'Educational Materials',
                'other' => 'Other Resources',
            ],

            'descriptions' => [
                'quran' => 'Lessons to help you improve Quran reading, recitation, and understanding.',
                'tajweed' => 'Simple materials to understand Tajweed rules and apply them during recitation.',
                'arabic' => 'Practical lessons to develop Arabic reading, writing, and vocabulary.',
                'videos' => 'Educational video content you can watch and benefit from at any time.',
                'materials' => 'Files and supporting materials you can refer to throughout your learning journey.',
                'other' => 'A collection of varied educational resources.',
            ],

            'view_category' => 'View Category',
        ],

        /*
        |--------------------------------------------------------------------------
        | Lesson Cards
        |--------------------------------------------------------------------------
        */

        'lesson' => [

            'available' => 'Available',

            'fallback_description' => 'An educational lesson available under :category.',

            'content_types' => [
                'text' => 'Texts',
                'image' => 'Images',
                'video' => 'Videos',
                'link' => 'Links',
                'file' => 'Files',
                'other' => 'Content',
            ],

            'quizzes' => [
                'title' => 'Quizzes for This Lesson',
                'questions' => ':count Questions',
                'minutes' => ':count Minutes',
                'pass' => 'Pass :percentage%',
                'start' => 'Start Quiz',
                'login_required' => 'You must log in to your education account to start the quiz.',
                'login' => 'Log In',
            ],

            'meta' => [
                'minutes' => '{0} Minutes|{1} Minute|[2,*] Minutes',
                'contents' => '{0} Contents|{1} Content|[2,*] Contents',
                'quizzes' => '{0} Quizzes|{1} Quiz|[2,*] Quizzes',
            ],

            'price' => [
                'free' => 'Free',
            ],

            'view' => 'View Lesson',
        ],

        /*
        |--------------------------------------------------------------------------
        | Lesson Page
        |--------------------------------------------------------------------------
        */

        'lesson_page' => [

            'breadcrumb' => [
                'home' => 'Home',
                'resources' => 'Educational Resources',
            ],

            'hero' => [
                'fallback_description' => 'A structured educational lesson designed to help you develop your skills and benefit from the learning content step by step.',
                'available' => 'Available to Learn',
            ],

            'meta' => [
                'duration' => 'Lesson Duration',
                'minute' => 'Minute',
                'content' => 'Content',
                'item' => 'Item',
                'price' => 'Price',
                'free' => 'Free',
                'status' => 'Status',
                'available' => 'Available',
            ],

            'content' => [
                'badge' => 'Lesson Content',
                'title' => 'Start Your Learning Journey',
                'count' => 'Content',

                'types' => [
                    'text' => 'Explanation & Text',
                    'image' => 'Educational Image',
                    'video' => 'Educational Video',
                    'link' => 'External Link',
                    'file' => 'Educational File',
                    'other' => 'Content',
                ],

                'missing' => [
                    'text' => 'There is no text for this content.',
                    'image' => 'No image has been specified for this content.',
                    'video' => 'No video has been specified for this content.',
                    'link' => 'No link has been specified.',
                    'file' => 'The file has not been uploaded.',
                ],

                'video_not_supported' => 'Your browser does not support video playback.',

                'link' => [
                    'external' => 'External Link',
                    'open' => 'Open Link',
                ],

                'file' => [
                    'name' => 'Educational File',
                    'download' => 'Download',
                ],

                'footer' => 'Lesson Content :number',
            ],

            'empty' => [
                'title' => 'No Content Available for This Lesson Yet',
                'description' => 'The content for this lesson will be added soon.',
            ],

            'quizzes' => [
                'badge' => 'Lesson Quizzes',
                'title' => 'Test Your Understanding',
                'count' => 'Quiz',
                'label' => 'Lesson Quiz',
                'question' => 'Question',
                'pass_from' => 'Pass From',
                'minute' => 'Minute',
                'start' => 'Start Quiz',
            ],

            'sidebar' => [
                'about' => 'About This Lesson',
                'quick_info' => 'Quick Information',
                'category' => 'Category',
                'content' => 'Content',
                'duration' => 'Duration',
                'quizzes' => 'Quizzes',
                'status' => 'Status',
                'available' => 'Available',

                'content_types' => 'Lesson Content',
                'what_you_find' => 'What You’ll Find Here',

                'types' => [
                    'text' => 'Texts & Explanations',
                    'image' => 'Educational Images',
                    'video' => 'Educational Videos',
                    'link' => 'Links',
                    'file' => 'Files',
                    'other' => 'Content',
                ],

                'quizzes_title' => 'Lesson Quizzes',
                'quizzes_subtitle' => 'Test Your Understanding',

                'back_to_category' => 'Back to Category',
                'all_resources' => 'All Resources',
            ],

            'bottom' => [
                'all_resources' => 'All Resources',
                'description' => 'Keep learning and explore more lessons and educational materials.',
            ],
        ],

        /*
        |--------------------------------------------------------------------------
        | Empty States
        |--------------------------------------------------------------------------
        */

        'empty' => [

            'category' => 'No lessons are currently available in this category.',

            'category_title' => 'No Lessons Available',

            'category_description' => 'No lessons have been added to this category yet. More educational content will be added continuously.',

            'back_to_resources' => 'Back to All Resources',

            'all_title' => 'No Educational Resources Available',

            'all_description' => 'Lessons and educational materials will be added soon.',
        ],

        /*
        |--------------------------------------------------------------------------
        | Bottom Section
        |--------------------------------------------------------------------------
        */

        'bottom' => [

            'title' => 'Ready to Start Learning?',

            'description' => 'Choose the right lesson for you and begin your learning journey step by step.',

            'action' => 'Explore Lessons',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Comments
    |--------------------------------------------------------------------------
    */

    'comments' => [
        'page_title' => 'Comments | Education',
        'page_description' => 'We would be happy to hear your opinion and experience.',
        'list_title' => 'Comments',

        'header' => [
            'eyebrow' => 'Visitors’ Opinions',
            'title' => 'What Do Visitors Say?',
            'description' => 'Your kind words and comments are greatly appreciated.',
        ],

        'navigation' => [
            'previous' => 'Previous Comment',
            'next' => 'Next Comment',
        ],

        'card' => [
            'approved' => 'Approved Comment',
        ],

        'indicators' => [
            'comment' => 'Comment :number',
        ],

        'empty' => [
            'title' => 'Be the First to Leave a Comment',
            'description' => 'We would be happy to hear your opinion and experience.',
            'action' => 'Write Your Comment',
            'message' => 'There are no published comments yet. Be the first to share your opinion.',
        ],

        'form' => [
            'title' => 'Write Your Comment',
            'optional' => '(Optional)',

            'name' => [
                'label' => 'Name',
                'placeholder' => 'Enter your name',
            ],

            'email' => [
                'label' => 'Email',
                'placeholder' => 'example@email.com',
            ],

            'comment' => [
                'label' => 'Comment',
                'placeholder' => 'Write your comment here...',
            ],

            'submit' => 'Submit Comment',

            'note' => 'Your comment will be reviewed before being published on the website.',
        ],

        'action' => [
            'share_opinion' => 'Share Your Opinion',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Contact
    |--------------------------------------------------------------------------
    */

    'contact' => [
        'header' => [
            'badge' => 'Contact Me',
            'title_start' => 'Let’s Begin',
            'title_highlight' => 'Your Learning Journey',
            'description' => 'If you have a question or would like to know the best way to learn, you can contact me and I will help you choose what suits your goals and level.',
        ],

        'info' => [
            'welcome' => 'Welcome',
            'title' => 'How Can I Help You?',
            'description' => 'You can send your inquiry about Quran lessons, Tajweed, memorization and revision, or learning Arabic.',
        ],

        'items' => [
            'email' => [
                'label' => 'Email',
                'value' => 'hello@example.com',
            ],

            'whatsapp' => [
                'label' => 'WhatsApp',
                'value' => 'Contact Me Directly',
            ],

            'availability' => [
                'label' => 'Availability',
                'value' => 'According to Available Times',
            ],
        ],

        'note' => 'You do not need to know your level in advance. We can determine the right approach together.',

        'form' => [
            'name' => [
                'label' => 'Name',
                'placeholder' => 'Enter your name',
            ],

            'email' => [
                'label' => 'Email',
                'placeholder' => 'example@email.com',
            ],

            'subject' => [
                'label' => 'What Would You Like to Learn?',
                'placeholder' => 'Choose the type of inquiry',

                'options' => [
                    'quran' => 'Holy Quran Education',
                    'tajweed' => 'Tajweed and Recitation Correction',
                    'memorization' => 'Quran Memorization and Revision',
                    'arabic' => 'Arabic Language Education',
                    'general' => 'General Inquiry',
                ],
            ],

            'message' => [
                'label' => 'Your Message',
                'placeholder' => 'Write your message or question here...',
            ],

            'submit' => 'Send Message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Footer
    |--------------------------------------------------------------------------
    */

    'footer' => [
        'brand' => [
            'name' => 'Hebah',
            'subtitle' => 'Quran & Arabic Language',
            'description' => 'A personal educational space dedicated to providing Quran and Arabic language education in a calm, clear, and learner-friendly way.',
        ],

        'social' => [
            'whatsapp' => 'WhatsApp',
            'youtube' => 'YouTube',
            'telegram' => 'Telegram',
            'instagram' => 'Instagram',
        ],

        'quick_links' => [
            'title' => 'Quick Links',
            'home' => 'Home',
            'about' => 'About Me',
            'services' => 'Services',
            'appointments' => 'Appointments',
            'contact' => 'Contact Me',
        ],

        'education' => [
            'title' => 'Education',
            'quran' => 'Holy Quran',
            'tajweed' => 'Tajweed',
            'memorization' => 'Memorization and Revision',
            'arabic' => 'Arabic Language',
            'resources' => 'Educational Resources',
        ],

        'contact' => [
            'title' => 'Contact Me',
            'email' => 'hello@example.com',
            'whatsapp' => 'WhatsApp',
            'availability' => 'Available Times',
        ],

        'bottom' => [
            'copyright' => 'All rights reserved.',
            'privacy' => 'Privacy',
            'terms' => 'Terms',
            'admin' => 'Website Administration',
            'back_to_main' => 'Back to Main Website',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    */

    'layout' => [
        'default_title' => 'Holy Quran and Arabic Language',
        'default_description' => 'Personal Quran and Arabic language education with Hebah.',
        'back_to_top' => 'Back to Top',
        'back_to_top_title' => 'Back to Top',
    ],

    /*
    |--------------------------------------------------------------------------
    | Profile Page
    |--------------------------------------------------------------------------
    */

    'profile_page' => [

        'page_title' => 'Profile',

        'meta_description' => 'Student profile in the Quran and Arabic Language section.',

        'heading' => [
            'title' => 'Profile',
            'description' => 'Welcome to your profile in the Quran and Arabic Language section',
        ],

        'status' => [
            'approved' => 'Approved Account',
            'pending' => 'Under Review',
            'rejected' => 'Application Rejected',
            'unknown' => 'Unknown Status',
        ],

        'personal_information' => [
            'title' => 'Personal Information',
        ],

        'fields' => [
            'full_name' => 'Full Name',
            'email' => 'Email Address',
            'phone' => 'Phone Number',
            'phone_empty' => 'No phone number has been added',
            'whatsapp' => 'WhatsApp Number',
            'whatsapp_empty' => 'No WhatsApp number has been added',
            'education_level' => 'Education Level',
            'education_level_empty' => 'Education level has not been specified',
            'learning_goal' => 'Learning Goal',
            'learning_goal_empty' => 'Learning goal has not been specified',
        ],

        'status_message' => [

            'pending' => [
                'title' => 'Your Account Is Under Review',
                'description' => 'Your account has been created successfully, and your application is currently under review by the administration. You will be notified once your account is approved and you are allowed to use all student services.',
            ],

            'approved' => [
                'title' => 'Your Account Is Approved',
                'description' => 'Your account is approved. You can now access the student dashboard, lessons, bookings, quizzes, and other available services.',
            ],

            'rejected' => [
                'title' => 'Your Registration Application Was Rejected',
                'description' => 'Your student registration application was rejected. If you believe this happened by mistake, please contact the administration.',
            ],
        ],

        'actions' => [
            'dashboard' => 'Student Dashboard',
            'education_home' => 'Back to Education',
        ],
    ],

    'dashboard_page' => [
'page_title' => 'Student Dashboard',

'header' => [
    'eyebrow' => 'Your Educational Space',
    'welcome' => 'Welcome,',
    'description' => 'From here, you can follow your lessons and appointments and continue your educational journey.',
    'main_website' => 'Main Website',
    'logout' => 'Log Out',
],

'welcome' => [
    'eyebrow' => 'Your Learning Journey',
    'title' => 'A Small Step Every Day,',
    'highlight' => 'Makes a Big Difference.',
    'description' => 'Track your progress, review your appointments, and prepare for your next lesson.',
],

'statistics' => [
    'upcoming' => 'Upcoming Lessons',
    'completed' => 'Completed Lessons',
    'total' => 'Total Bookings',
],

'next_lesson' => [
    'eyebrow' => 'Next Appointment',
    'title' => 'Upcoming Lesson',
    'empty_title' => 'No Upcoming Appointments',
    'empty_description' => 'When you book a new lesson, its appointment will appear here.',
],

'quick_actions' => [
    'eyebrow' => 'Quick Access',
    'title' => 'What Would You Like to Do?',

    'book_lesson' => [
        'title' => 'Book a Lesson',
        'description' => 'Choose a suitable appointment for you',
    ],

    'services' => [
        'title' => 'Education Services',
        'description' => 'Explore the available services',
    ],

    'contact' => [
        'title' => 'Contact Me',
        'description' => 'Send your inquiry or message',
    ],

    'conversation' => [
        'title' => 'Contact Administration',
        'description' => 'Communicate directly with the administration',
    ],
],

'bookings' => [
    'eyebrow' => 'Your Appointments',
    'title' => 'Upcoming Lessons',
    'empty_title' => 'No Upcoming Lessons',
    'empty_description' => 'Your booked lessons will appear here.',
],

'recent' => [
    'eyebrow' => 'Learning History',
    'title' => 'Recent Lessons',
    'empty_title' => 'No History Yet',
    'empty_description' => 'Completed lessons will appear here after you begin your learning journey.',
],

'status' => [
    'confirmed' => 'Confirmed',
    'pending' => 'Pending Confirmation',
    'review' => 'Under Review',
    'cancelled' => 'Cancelled',
    'completed' => 'Completed',
],

'actions' => [
    'view_details' => 'View Details',
    'book_appointment' => 'Book an Appointment',
    'book_lesson' => 'Book a Lesson',
],

'fallback' => [
    'educational_lesson' => 'Educational Lesson',
    'not_specified' => 'Not Specified',
    'date_not_specified' => 'Date Not Specified',
],

],

'student_navigation' => [
    'aria_label' => 'Student educational navigation',
    'brand' => 'My Learning Space',
    'welcome' => 'Welcome :name',
    'dashboard' => 'Dashboard',
    'lessons' => 'Lessons',
    'quizzes' => 'Quizzes',
    'messages' => 'Messages',
    'mobile_menu_open' => 'Open student menu',
    'notifications' => 'Notifications',
    'your_notifications' => 'Your notifications',
    'mark_all_read' => 'Mark all as read',
    'new_notification' => 'New notification',
    'new' => 'New',
    'mark_as_read' => 'Mark as read',
    'view_details' => 'View details',
    'view_all' => 'View all notifications',
    'empty' => [
        'title' => 'No notifications',
        'description' => 'Notifications related to your lessons, quizzes, and appointments will appear here.',
    ],
],

'notifications_page' => [
    'page_title' => 'Notifications',

    'header' => [
        'brand' => 'My Learning Space',
        'title' => 'Notifications',
        'description' => 'All notifications related to your lessons, quizzes, and bookings.',
    ],

    'actions' => [
        'mark_all_read' => 'Mark All as Read',
        'open' => 'Open',
        'mark_as_read' => 'Mark as Read',
        'delete' => 'Delete Notification',
        'back_to_dashboard' => 'Back to Dashboard',
    ],

    'status' => [
        'unread' => 'Unread',
        'read' => 'Read',
    ],

    'empty' => [
        'title' => 'No Notifications',
        'description' => 'Notifications related to your lessons, quizzes, appointments, and bookings will appear here.',
    ],

    'loading' => [
        'updating' => 'Updating...',
    ],

    'messages' => [
        'delete_failed' => 'Unable to delete the notification.',
        'delete_error' => 'An error occurred while deleting the notification.',
        'delete_confirm' => 'Do you want to delete this notification?',
    ],
],

'booking_show_page' => [
    'page_title' => 'Booking Details | Education',

    'navigation' => [
        'back_to_dashboard' => 'Back to Student Dashboard',
    ],

    'header' => [
        'eyebrow' => 'Booking Details',
        'title' => 'Lesson Details',
        'description' => 'Review your appointment details, booking status, and payment status here.',
    ],

    'status' => [
        'confirmed' => 'Confirmed',
        'pending' => 'Under Review',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
        'rejected' => 'Rejected',
        'no_show' => 'Student Did Not Attend',
        'unknown' => 'Unknown',
    ],

    'status_messages' => [
        'confirmed' => 'Your lesson appointment has been confirmed.',
        'pending' => 'Your booking request is under review and will be confirmed by the administration.',
        'completed' => 'This lesson has been completed successfully.',
        'cancelled' => 'This booking has been cancelled.',
        'rejected' => 'This booking was not approved.',
        'no_show' => 'This booking was recorded as a no-show.',
        'current' => 'Current booking status: :status',
    ],

    'booking_info' => [
        'label' => 'Booking Information',
        'title' => 'Appointment Details',
        'date' => 'Lesson Date',
        'time' => 'Lesson Time',
        'number' => 'Booking Number',
        'created_at' => 'Request Submitted',
        'not_specified' => 'Not Specified',
    ],

    'sessions' => [
        'total' => 'Total Sessions',
        'completed' => 'Completed Sessions',
        'remaining' => 'Remaining Sessions',
    ],

    'price' => [
        'label' => 'Booking Value',
    ],

    'payment' => [
        'status' => 'Payment Status',
        'approved' => 'Paid',
        'submitted' => 'Proof Submitted',
        'under_review' => 'Under Review',
        'rejected' => 'Rejected',
        'failed' => 'Payment Failed',
        'unpaid' => 'Unpaid',
        'method' => 'Payment Method',
        'bank_transfer' => 'Bank Transfer',
        'cash' => 'Cash',
        'reference' => 'Transaction Reference',
        'submitted_at' => 'Proof Submitted At',
    ],

    'payment_action' => [
        'question' => 'Have You Made the Bank Transfer?',
        'description' => 'Upload your transfer proof so the administration team can review it.',
        'send_proof' => 'Submit Payment Proof',
        'resend_proof' => 'Resubmit Payment Proof',
    ],

    'payment_messages' => [
        'pending_title' => 'Payment Proof Under Review',
        'pending_description' => 'Your payment proof has been received and will be reviewed by the administration.',
        'approved_title' => 'Payment Approved',
        'approved_description' => 'Your payment proof has been approved successfully, and the lesson content is now available to you.',
    ],

    'bank_transfer' => [
        'method' => 'Payment Method',
        'title' => 'Bank Transfer',
        'description' => 'You can pay for your booking by transferring the amount to the bank account shown below, then upload the transfer proof.',
        'account_name' => 'Account Holder Name',
        'account_number' => 'Account Number',
        'iban' => 'IBAN',
        'copy' => 'Copy',
        'amount' => 'Amount Required',
        'booking_value' => 'Booking Value',
        'instructions' => 'Payment Instructions',
        'copied_successfully' => 'Copied Successfully',
        'copy_success' => 'Copied',
    ],

    'notes' => [
        'student' => 'Your Booking Note',
        'admin' => 'Administration Note',
    ],

    'lesson_content' => [
        'label' => 'Lesson Content',
        'available_title' => 'Lesson Content Is Available',
        'available_description' => 'Your payment has been approved. You can now access your assigned lessons and review their content.',
        'open' => 'Open Lesson Content',
        'assigned_title' => 'Lesson Assigned to You',
        'assigned_description' => 'This lesson has been assigned to your account. Its content will become available after payment approval.',
        'locked' => 'Lesson content is not currently available. It will appear after payment approval.',
        'available_now' => 'Available Now',
        'not_available_yet' => 'Not Available Yet',
    ],

    'summary' => [
        'label' => 'Booking Summary',
        'title' => 'Quick Information',
        'booking_type' => 'Booking Type',
        'date' => 'Date',
        'time' => 'Time',
        'price' => 'Price',
        'payment' => 'Payment',
        'status' => 'Status',
        'lesson_content' => 'Lesson Content',
    ],

    'actions' => [
        'dashboard' => 'Student Dashboard',
        'new_booking' => 'Book a New Lesson',
        'lesson_content' => 'Lesson Content',
        'pay_booking' => 'Pay for Booking',
        'resubmit_payment' => 'Resubmit Payment Proof',
        'cancel_booking' => 'Cancel Booking',
        'confirm_cancel' => 'Are you sure you want to cancel this booking?',
    ],

    'timeline' => [
        'label' => 'Booking Progress',
        'title' => 'Request Tracking',

        'booking_submitted' => 'Booking Request Submitted',
        'booking_reviewed' => 'Request Reviewed',
        'booking_reviewed_description' => 'The booking request was recorded and reviewed by the administration.',

        'booking_confirmed' => 'Appointment Confirmed',
        'booking_confirmed_description' => 'The lesson appointment is now confirmed.',

        'payment_submitted' => 'Payment Proof Submitted',
        'payment_submitted_description' => 'The payment proof was submitted successfully.',

        'payment_approved' => 'Payment Approved',
        'payment_approved_description' => 'The payment proof was approved and the lesson content is now available to you.',

        'payment_rejected' => 'Payment Proof Rejected',
        'payment_rejected_description' => 'You can upload a new payment proof from the payment page.',

        'lesson_completed' => 'Lesson Completed',
        'lesson_completed_description' => 'The lesson was recorded as completed.',

        'booking_cancelled' => 'Booking Cancelled',
        'booking_cancelled_description' => 'This appointment is no longer active.',

        'booking_rejected' => 'Booking Not Approved',
        'booking_rejected_description' => 'You can return to the student dashboard and choose a new appointment.',

        'no_show' => 'Student Did Not Attend',
        'no_show_description' => 'The booking was recorded as a no-show.',

        'lesson_available' => 'Lesson Content Is Available',
        'lesson_available_description' => 'You can now access the lesson content from your lessons page.',
    ],
],

'booking_show_page' => [
'page_title' => 'Booking Details | Education',

'navigation' => [
    'back_to_dashboard' => 'Back to Student Dashboard',
],

'header' => [
    'eyebrow' => 'Booking Details',
    'title' => 'Lesson Details',
    'description' => 'Review your appointment details, booking status, and payment status here.',
],

'status' => [
    'confirmed' => 'Confirmed',
    'pending' => 'Under Review',
    'completed' => 'Completed',
    'cancelled' => 'Cancelled',
    'rejected' => 'Rejected',
    'no_show' => 'Student Did Not Attend',
    'unknown' => 'Unknown',
],

'status_messages' => [
    'confirmed' => 'Your lesson appointment has been confirmed.',
    'pending' => 'Your booking request is under review and will be confirmed by the administration.',
    'completed' => 'This lesson has been completed successfully.',
    'cancelled' => 'This booking has been cancelled.',
    'rejected' => 'This booking was not approved.',
    'no_show' => 'This booking was recorded as a no-show.',
    'current' => 'Current booking status: :status',
],

'booking_info' => [
    'label' => 'Booking Information',
    'title' => 'Appointment Details',
    'date' => 'Lesson Date',
    'time' => 'Lesson Time',
    'number' => 'Booking Number',
    'created_at' => 'Request Submitted',
    'not_specified' => 'Not Specified',
],

'sessions' => [
    'total' => 'Total Sessions',
    'completed' => 'Completed Sessions',
    'remaining' => 'Remaining Sessions',
],

'price' => [
    'label' => 'Booking Value',
],

'payment' => [
    'status' => 'Payment Status',
    'approved' => 'Paid',
    'submitted' => 'Proof Submitted',
    'under_review' => 'Under Review',
    'rejected' => 'Rejected',
    'failed' => 'Payment Failed',
    'unpaid' => 'Unpaid',
    'method' => 'Payment Method',
    'bank_transfer' => 'Bank Transfer',
    'cash' => 'Cash',
    'reference' => 'Transaction Reference',
    'submitted_at' => 'Proof Submitted At',
],

'payment_action' => [
    'question' => 'Have You Made the Bank Transfer?',
    'description' => 'Upload your transfer proof so the administration team can review it.',
    'send_proof' => 'Submit Payment Proof',
    'resend_proof' => 'Resubmit Payment Proof',
],

'payment_messages' => [
    'pending_title' => 'Payment Proof Under Review',
    'pending_description' => 'Your payment proof has been received and will be reviewed by the administration.',
    'approved_title' => 'Payment Approved',
    'approved_description' => 'Your payment proof has been approved successfully, and the lesson content is now available to you.',
],

'bank_transfer' => [
    'method' => 'Payment Method',
    'title' => 'Bank Transfer',
    'description' => 'You can pay for your booking by transferring the amount to the bank account shown below, then upload the transfer proof.',
    'account_name' => 'Account Holder Name',
    'account_number' => 'Account Number',
    'iban' => 'IBAN',
    'copy' => 'Copy',
    'amount' => 'Amount Required',
    'booking_value' => 'Booking Value',
    'instructions' => 'Payment Instructions',
    'copied_successfully' => 'Copied Successfully',
    'copy_success' => 'Copied',
],

'notes' => [
    'student' => 'Your Booking Note',
    'admin' => 'Administration Note',
],

'lesson_content' => [
    'label' => 'Lesson Content',
    'available_title' => 'Lesson Content Is Available',
    'available_description' => 'Your payment has been approved. You can now access your assigned lessons and review their content.',
    'open' => 'Open Lesson Content',
    'assigned_title' => 'Lesson Assigned to You',
    'assigned_description' => 'This lesson has been assigned to your account. Its content will become available after payment approval.',
    'locked' => 'Lesson content is not currently available. It will appear after payment approval.',
    'available_now' => 'Available Now',
    'not_available_yet' => 'Not Available Yet',
],

'summary' => [
    'label' => 'Booking Summary',
    'title' => 'Quick Information',
    'booking_type' => 'Booking Type',
    'date' => 'Date',
    'time' => 'Time',
    'price' => 'Price',
    'payment' => 'Payment',
    'status' => 'Status',
    'lesson_content' => 'Lesson Content',
],

'actions' => [
    'dashboard' => 'Student Dashboard',
    'new_booking' => 'Book a New Lesson',
    'lesson_content' => 'Lesson Content',
    'pay_booking' => 'Pay for Booking',
    'resubmit_payment' => 'Resubmit Payment Proof',
    'cancel_booking' => 'Cancel Booking',
    'confirm_cancel' => 'Are you sure you want to cancel this booking?',
],

'timeline' => [
    'label' => 'Booking Progress',
    'title' => 'Request Tracking',

    'booking_submitted' => 'Booking Request Submitted',
    'booking_reviewed' => 'Request Reviewed',
    'booking_reviewed_description' => 'The booking request was recorded and reviewed by the administration.',

    'booking_confirmed' => 'Appointment Confirmed',
    'booking_confirmed_description' => 'The lesson appointment is now confirmed.',

    'payment_submitted' => 'Payment Proof Submitted',
    'payment_submitted_description' => 'The payment proof was submitted successfully.',

    'payment_approved' => 'Payment Approved',
    'payment_approved_description' => 'The payment proof was approved and the lesson content is now available to you.',

    'payment_rejected' => 'Payment Proof Rejected',
    'payment_rejected_description' => 'You can upload a new payment proof from the payment page.',

    'lesson_completed' => 'Lesson Completed',
    'lesson_completed_description' => 'The lesson was recorded as completed.',

    'booking_cancelled' => 'Booking Cancelled',
    'booking_cancelled_description' => 'This appointment is no longer active.',

    'booking_rejected' => 'Booking Not Approved',
    'booking_rejected_description' => 'You can return to the student dashboard and choose a new appointment.',

    'no_show' => 'Student Did Not Attend',
    'no_show_description' => 'The booking was recorded as a no-show.',

    'lesson_available' => 'Lesson Content Is Available',
    'lesson_available_description' => 'You can now access the lesson content from your lessons page.',
],

'fallback' => [
    'lesson' => 'Lesson',
],

],

'booking_page' => [
    'page_title' => 'Book an Appointment',

    'header' => [
        'badge' => 'Book Your Appointment',
        'title' => 'Choose Your Booking Type',
        'title_highlight' => 'and the Appointment That Suits You',
        'description' => 'Choose a booking type, then select a suitable day and time to submit your booking request.',
    ],

    'errors' => [
        'title' => 'Unable to Complete Booking',
    ],

    'steps' => [
        'first' => 'Step One',
        'second' => 'Step Two',
        'third' => 'Step Three',
        'fourth' => 'Step Four',
    ],

    'booking_type' => [
        'title' => 'Choose Booking Type',
        'sessions' => ':count Sessions',
        'empty_title' => 'No Booking Types Available',
        'empty_description' => 'There are currently no booking types available.',
    ],

    'date' => [
        'title' => 'Choose a Day',
        'label' => 'Lesson Date',
        'choose_date' => 'Choose Lesson Date',
        'choose_day' => 'Select a suitable day for you',
        'choose_action' => 'Choose Date',
    ],

    'times' => [
        'title' => 'Available Times',
        'empty_title' => 'No Available Times',
        'empty_description' => 'There are no available appointments for this day. You can choose another day.',
    ],

    'confirmation' => [
        'title' => 'Confirm Booking Details',

        'summary' => [
            'booking_type' => 'Booking Type',
            'booking_type_empty' => 'No booking type selected',
            'date' => 'Date',
            'time' => 'Appointment',
            'time_empty' => 'No time selected',
        ],

        'note' => [
            'label' => 'Additional Notes',
            'placeholder' => 'Do you have a specific goal or note regarding the lessons?',
        ],

        'submit' => 'Submit Booking Request',
    ],
],

'payment_page' => [
    'page_title' => 'Payment | Education',

    'header' => [
        'eyebrow' => 'Complete Payment',
        'title' => 'Complete Booking Payment',
        'description' => 'Review your lesson details, then submit your transfer information and payment proof for administration review.',
    ],

    'alerts' => [
        'success_title' => 'Success',
        'error_title' => 'An Error Occurred',
        'validation_title' => 'Please Review the Information',
    ],

    'booking' => [
        'label' => 'Booking Details',
        'title' => 'Lesson Information',
    ],

    'amount' => [
        'required' => 'Amount Required',
    ],

    'summary' => [
        'lesson' => 'Lesson',
        'category' => 'Category',
        'date' => 'Date',
        'time' => 'Time',
        'booking_number' => 'Booking Number',
    ],

    'categories' => [
        'quran' => 'Quran Kareem',
        'tajweed' => 'Tajweed',
        'arabic' => 'Arabic Language',
    ],

    'fallback' => [
        'not_specified' => 'Not Specified',
    ],

    'payment_status' => [
        'current' => 'Current Payment Status',
        'approved' => 'Payment Approved',
        'submitted' => 'Proof Submitted',
        'under_review' => 'Under Review',
        'rejected' => 'Proof Rejected',
        'paid' => 'Paid',
        'pending' => 'Processing',
        'unpaid' => 'Not Paid Yet',
    ],

    'actions' => [
        'back_to_booking' => 'Back to Booking Details',
        'submit' => 'Submit Payment Proof',
        'cancel' => 'Cancel',
    ],

    'payment_proof' => [
        'label' => 'Payment Proof',
        'title' => 'Transfer Information',
    ],

    'messages' => [
        'submitted' => [
            'title' => 'Payment Proof Submitted',
            'description' => 'Your transfer proof has been received and is now awaiting administration review.',
        ],

        'review' => [
            'title' => 'Payment Under Review',
            'description' => 'The administration is currently reviewing your payment proof.',
        ],

        'approved' => [
            'title' => 'Payment Approved',
            'description' => 'Your payment has been approved successfully.',
        ],

        'rejected' => [
            'title' => 'Payment Proof Rejected',
            'fallback' => 'Please submit a new payment proof.',
        ],
    ],

    'form' => [
        'optional' => 'Optional',

        'payment_method' => [
            'label' => 'Payment Method',
            'placeholder' => 'Choose Payment Method',
            'bank_transfer' => 'Bank Transfer',
            'cash' => 'Cash',
            'other' => 'Other',
        ],

        'reference' => [
            'label' => 'Transaction / Reference Number',
            'placeholder' => 'Enter the transfer number or transaction reference',
        ],

        'receipt' => [
            'label' => 'Transfer Proof',
            'upload' => 'Click to Upload Transfer Proof',
            'formats' => 'JPG, PNG, WEBP or PDF',
            'max_size' => 'Maximum 5 MB',
            'no_file' => 'No file selected',
        ],

        'note' => [
            'label' => 'Notes',
            'placeholder' => 'You can add any notes related to the payment...',
        ],
    ],

    'important_note' => [
        'title' => 'Important Note',
        'description' => 'After submitting the transfer proof, the administration will review it and approve the payment.',
    ],
],

'student_lessons_page' => [
    'page_title' => 'My Lessons | Education',

    'meta_description' => 'Your educational lessons, reviews, and quizzes in one place.',

    'navigation' => [
        'back_to_dashboard' => 'Back to Student Dashboard',
        'new_booking' => 'Book a New Lesson',
    ],

    'header' => [
        'eyebrow' => 'Your Learning Space',
        'title' => 'My Lessons',
        'description' => 'Here you can find the lessons linked to your bookings, along with the educational content, reviews, and quizzes for each lesson.',
    ],

    'statistics' => [
        'total' => 'Total Lessons',
        'completed' => 'Completed Lessons',
        'quizzes' => 'Available Quizzes',
    ],

    'section' => [
        'title' => 'My Lessons',
        'lesson_count' => 'Lesson',
    ],

    'status' => [
        'completed' => 'Completed',
        'in_progress' => 'In Progress',
    ],

    'categories' => [
        'quran' => 'Holy Quran',
        'tajweed' => 'Tajweed',
        'arabic' => 'Arabic Language',
    ],

    'booking' => [
        'date' => 'Lesson Date',
        'time' => 'Lesson Time',
        'number' => 'Booking',
    ],

    'quiz' => [
        'label' => 'Lesson Quiz',
        'open' => 'Take Quiz',
    ],

    'actions' => [
        'view_lesson' => 'View Lesson',
    ],

    'empty' => [
        'title' => 'No Lessons Yet',
        'description' => 'Once a lesson is assigned to you or the related session is completed, your educational materials, reviews, and quizzes will appear here.',
        'book_first_lesson' => 'Book Your First Lesson',
    ],

    'fallback' => [
        'lesson' => 'Educational Lesson',
        'not_specified' => 'Not Specified',
    ],
],

'student_lesson_show_page' => [
    'page_title' => 'Lesson',

    'meta_description' => 'View the educational lesson content and related quizzes.',

    'navigation' => [
        'back_to_lessons' => 'Back to My Lessons',
    ],

    'hero' => [
        'badge' => 'Educational Lesson',
    ],

    'meta' => [
        'content' => 'Content',
        'quiz' => 'Quiz',
    ],

    'content' => [
        'title' => 'Lesson Content',
        'link' => [
            'title' => 'Educational Link',
            'open' => 'Open Link',
        ],
        'file' => [
            'name' => 'Lesson File',
            'kb' => 'KB',
            'educational' => 'Educational File',
            'open' => 'Open File',
        ],
        'empty' => 'No content is currently available for this lesson.',
    ],

    'quizzes' => [
        'title' => 'Lesson Quizzes',
        'question' => 'Question',
        'questions' => 'Questions',
        'enter' => 'Enter Quiz',
        'login' => 'Log In to Take Quiz',
    ],

    'sidebar' => [
        'information' => 'Lesson Information',
        'level' => 'Level',
        'general' => 'General',
        'duration' => 'Duration',
        'contents' => 'Content',
        'quizzes' => 'Quizzes',
        'questions' => 'Questions',
    ],
],

'student_quizzes_page' => [
    'page_title' => 'Quizzes | Student Dashboard',

    'header' => [
        'eyebrow' => 'Your Learning Journey',
        'title' => 'Quizzes',
        'description' => 'Test your understanding and track your progress in your educational lessons.',
    ],

    'status' => [
        'in_progress' => 'In Progress',
        'passed' => 'Quiz Passed',
        'failed' => 'Quiz Not Passed',
        'new' => 'New Quiz',
    ],

    'fallback' => [
        'description' => 'An educational quiz designed to measure your understanding and comprehension of the lesson.',
    ],

    'meta' => [
        'question' => 'Question',
        'questions' => 'Questions',
        'attempts' => 'Attempts',
        'pass' => 'Pass',
    ],

    'actions' => [
        'continue' => 'Continue Quiz',
        'start' => 'Start Quiz',
        'attempts_exhausted' => 'Attempts Exhausted',
        'last_result' => 'Last Result',
        'view_lessons' => 'View My Lessons',
    ],

    'empty' => [
        'title' => 'No Quizzes Available',
        'description' => 'Quizzes for your lessons will appear here once they are prepared by the administration.',
    ],
],

'student_quiz_page' => [
    'page_title_suffix' => 'Education',

    'meta' => [
        'fallback_description' => 'Quiz',
        'questions_count' => 'Number of Questions',
        'pass_percentage' => 'Pass Score',
        'time' => 'Time',
        'minute' => 'Minute',
        'open' => 'Open',
    ],

    'navigation' => [
        'back_to_lesson' => 'Back to Lesson',
        'back_to_lessons' => 'Back to My Lessons',
    ],

    'timer' => [
        'remaining' => 'Time Remaining:',
    ],

    'hero' => [
        'badge' => 'Lesson Quiz',
    ],

    'questions' => [
        'title' => 'Quiz Questions',
        'question' => 'Question',
        'points' => 'Point',
        'points_plural' => 'Points',
        'no_options' => 'No options are available for this question.',
    ],

    'submit' => [
        'title' => 'Have You Finished Answering?',
        'description' => 'Make sure to review your answers before submitting the quiz.',
        'button' => 'Submit Quiz',
    ],

    'messages' => [
        'confirm_submit' => 'Are you sure you want to submit the quiz? Your answers will be graded after submission.',
        'grading' => 'Grading quiz...',
        'submitting' => 'Submitting quiz...',
    ],
],

'student_quiz_result_page' => [
    'page_title' => 'Quiz Result',
    'meta_description' => 'Quiz result: :quiz',

    'navigation' => [
        'back_to_lessons' => 'Back to My Lessons',
        'back_to_quiz' => 'Back to Quiz',
    ],

    'status' => [
        'passed' => 'You Passed the Quiz',
        'failed' => 'You Did Not Reach the Passing Score',
    ],

    'hero' => [
        'title' => 'Quiz Result',
        'score' => 'Result',
    ],

    'meta' => [
        'points' => 'Points',
        'pass_percentage' => 'Passing Score',
        'attempt_number' => 'Attempt Number',
        'completed_at' => 'Completion Date',
    ],

    'answers' => [
        'title' => 'Review Answers',
        'correct' => 'Correct',
        'wrong' => 'Incorrect',
        'your_answer' => 'Your Answer',
        'not_answered' => 'No answer was selected.',
        'correct_answer' => 'Correct Answer',
        'explanation' => 'Explanation:',
        'earned_points' => 'Points Earned:',
    ],

    'actions' => [
        'back_to_lessons' => 'Back to My Lessons',
        'back_to_quiz' => 'Back to Quiz',
    ],
],

'conversations_page' => [
    'page_title' => 'Conversations | Education',
    'header' => [
        'title' => 'Conversations',
        'description' => 'Contact the teacher and send your questions or notes.',
        'new' => 'New Conversation',
    ],
    'status' => [
        'closed' => 'Closed',
        'open' => 'Open',
    ],
    'messages' => [
        'empty' => 'No messages yet',
        'message' => 'Message',
        'messages' => 'Messages',
    ],
    'actions' => [
        'delete' => 'Delete Conversation',
        'delete_confirm' => 'Are you sure you want to delete this conversation? All related messages will be permanently deleted.',
    ],
    'empty' => [
        'title' => 'No Conversations Yet',
        'description' => 'You can start a new conversation to contact the teacher.',
        'start' => 'Start a New Conversation',
    ],
],

'conversation_create_page' => [
    'page_title' => 'Start a New Conversation',
    'header' => [
        'label' => 'Conversations',
        'title' => 'Start a New Conversation',
        'description' => 'Send your question or message to the teacher, and you will receive a reply through this conversation.',
    ],
    'card' => [
        'title' => 'Conversation Details',
        'description' => 'Write a clear subject and explain your question in detail.',
    ],
    'validation' => [
        'title' => 'Please review the following information:',
    ],
    'fields' => [
        'subject' => [
            'label' => 'Conversation Subject',
            'placeholder' => 'Example: Question about booking or lessons',
            'hint' => 'Write a short title that describes the subject of your message.',
        ],
        'message' => [
            'label' => 'Message',
            'placeholder' => 'Write your message or question here...',
            'hint' => 'You can describe your question or issue clearly so the teacher can assist you better.',
        ],
    ],
    'actions' => [
        'back' => 'Back to Conversations',
        'submit' => 'Send and Start Conversation',
    ],
],

'conversation_show_page' => [
'page_title' => 'Conversation | Education',

'fallback' => [
    'title' => 'Educational Conversation',
],

'header' => [
    'description' => 'Conversation with the Education Administration',
],

'status' => [
    'open' => 'Conversation Open',
    'closed' => 'Conversation Closed',
],

'sender' => [
    'student' => 'You',
    'admin' => 'Education Administration',
],

'empty' => [
    'title' => 'No Messages Yet',
    'description' => 'Write your first message and we will communicate with you through this conversation.',
],

'form' => [
    'placeholder' => 'Write your message here...',
    'send' => 'Send Message',
],

'closed_message' => 'This conversation is closed and no new messages can be sent.',

'actions' => [
    'back' => 'Conversations',
    'close' => 'Close Conversation',
    'reopen' => 'Reopen Conversation',
],

'confirm' => [
    'close' => 'Are you sure you want to close this conversation?',
],

],

'login_page' => [

    'page_title' => 'Login | Quran & Arabic',
'google' => [
    'divider' => 'OR CONTINUE WITH',
    'button' => 'Continue with Google',
],
    'intro' => [

        'welcome' => 'Welcome Back',

        'title' => 'Continue',

        'title_highlight' => 'Your Learning Journey',

        'description' => 'Sign in to your account to follow your lessons, appointments, and continue your journey with the Quran and Arabic language.',

        'features' => [

            'lessons' => [
                'title' => 'Follow Your Lessons',
                'description' => 'Access your lessons and educational content.',
            ],

            'appointments' => [
                'title' => 'Your Appointments',
                'description' => 'Review your upcoming lesson appointments.',
            ],

            'reminders' => [
                'title' => 'Reminders',
                'description' => 'Never miss your upcoming lesson.',
            ],

        ],

    ],

    'card' => [

        'back_to_site' => 'Back to Website',

        'welcome' => 'Welcome Back',

        'title' => 'Sign In',

        'description' => 'Enter your email address or phone number to continue.',

    ],

    'validation' => [

        'invalid_credentials' => 'The login credentials are incorrect.',

    ],

    'fields' => [

        'login' => [

            'label' => 'Email Address or Phone Number',

            'placeholder' => 'example@email.com or 05xxxxxxxx',

        ],

        'password' => [

            'label' => 'Password',

            'placeholder' => 'Enter your password',

            'show' => 'Show password',

            'hide' => 'Hide password',

        ],

    ],

    'options' => [

        'remember_me' => 'Remember me',

        'forgot_password' => 'Forgot your password?',

    ],

    'actions' => [

        'login' => 'Sign In',

    ],

    'register' => [

        'question' => "Don't have an account?",

        'action' => 'Create an Account',

    ],

    'security' => [

        'message' => 'Secure connection and protection for your account data.',

    ],

],

'register_page' => [

    'page_title' => 'Create Account | Quran & Arabic',

    'intro' => [

        'badge' => 'A New Beginning in Your Learning Journey',

        'title' => 'Create Your',

        'title_highlight' => 'Personal Learning Space',

        'description' => 'Create your account to follow your lessons and appointments and benefit from educational content tailored to your goals and level.',

        'features' => [

            'account' => [
                'title' => 'Your Learning Account',
                'description' => 'A private space to follow your learning journey.',
            ],

            'booking' => [
                'title' => 'Book Your Appointment',
                'description' => 'Choose the time that works best for you.',
            ],

            'reminders' => [
                'title' => 'Lesson Reminders',
                'description' => 'We will help you remember your upcoming appointments.',
            ],

        ],

    ],

    'card' => [

        'back_to_login' => 'Back to Sign In',

        'welcome' => 'Welcome',

        'title' => 'Create Account',

        'description' => 'Create your account and begin your learning journey.',

    ],

    'validation' => [

        'review' => 'Please review the entered information.',

    ],

    'fields' => [

        'name' => [
            'label' => 'Full Name',
            'placeholder' => 'Enter your full name',
        ],

        'email' => [
            'label' => 'Email Address',
            'placeholder' => 'example@email.com',
        ],

        'password' => [
            'label' => 'Password',
            'placeholder' => 'Create a strong password',
            'show' => 'Show password',
            'hide' => 'Hide password',
        ],

        'password_confirmation' => [
            'label' => 'Confirm Password',
            'placeholder' => 'Re-enter your password',
            'show' => 'Show password',
            'hide' => 'Hide password',
        ],

    ],

    'whatsapp' => [

        'title' => 'Lesson Reminders',

        'description' => 'You can add a WhatsApp number later from your account settings to receive reminders.',

    ],

    'terms' => [

        'agree' => 'I agree to the',

        'usage' => 'Terms of Use',

        'and' => 'and Privacy Policy.',

    ],

    'actions' => [

        'register' => 'Create Account',

    ],

    'login' => [

        'question' => 'Already have an account?',

        'action' => 'Sign In',

    ],

    'security' => [

        'message' => 'Your account information is securely protected.',

    ],

],

'forgot_password_page' => [

    'page_title' => 'Forgot Password | Quran & Arabic',

    'intro' => [

        'badge' => 'Account Recovery',

        'title' => "Don't Worry",

        'title_highlight' => 'We Will Help You Get Back',

        'description' => 'If you forgot your account password, enter your email address and we will send you a secure link to create a new password.',

        'features' => [

            'email' => [
                'title' => 'Enter Your Email',
                'description' => 'Use the email address linked to your account.',
            ],

            'verify' => [
                'title' => 'Check Your Email',
                'description' => 'You will receive a password reset link.',
            ],

            'new_password' => [
                'title' => 'Create a New Password',
                'description' => 'Choose a new and secure password for your account.',
            ],

        ],

    ],

    'card' => [

        'back_to_login' => 'Back to Sign In',

        'small_label' => 'Password Recovery',

        'title' => 'Forgot Your Password?',

        'description' => 'Enter your email address and we will send you a link to reset your password.',

    ],

    'fields' => [

        'email' => [
            'label' => 'Email Address',
            'placeholder' => 'example@email.com',
        ],

    ],

    'actions' => [

        'send_reset_link' => 'Send Reset Link',

    ],

    'login' => [

        'question' => 'Remember your password?',

        'action' => 'Sign In',

    ],

    'security' => [

        'message' => 'A secure link will be sent to your email address.',

    ],

],

'auth' => [

'reset_password' => 'Reset Password',

'reset_password_description' =>
    'Enter your new password, then confirm it to complete the password reset process.',

'email' => 'Email Address',

'email_placeholder' =>
    'Enter your email address',

'new_password' =>
    'New Password',

'new_password_placeholder' =>
    'Enter your new password',

'confirm_new_password' =>
    'Confirm New Password',

'confirm_password_placeholder' =>
    'Re-enter your password',

'password_hint' =>
    'It is recommended to use a strong password containing letters, numbers, and symbols.',

'show_password' =>
    'Show password',

'hide_password' =>
    'Hide password',

'save_new_password' =>
    'Save New Password',

'back_to_login' =>
    'Back to Login',

'reset_password_note' =>
    'After changing your password, you can log in directly using your new password.',


],




    /*
    |--------------------------------------------------------------------------
    | Brand
    |--------------------------------------------------------------------------
    */

    'brand' => [
        'name' => 'Hebah',
        'quran_arabic' => 'Holy Quran and Arabic Language',
    ],
];
