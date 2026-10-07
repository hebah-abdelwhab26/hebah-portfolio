<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Controllers
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| MAIN / USER
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\NotificationController;


/*
|--------------------------------------------------------------------------
| FRONT
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Front\TechController;
use App\Http\Controllers\Front\PortfolioController;
use App\Http\Controllers\Front\FigmaController;
use App\Http\Controllers\Front\CommentController;
use App\Http\Controllers\Front\EducationController;
use App\Http\Controllers\Front\ContactController;


/*
|--------------------------------------------------------------------------
| EDUCATION AUTH
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Education\Auth\EducationAuthController;
use App\Http\Controllers\Education\Auth\EducationAdminAuthController;
use App\Http\Controllers\Education\Auth\EducationGoogleAuthController;


/*
|--------------------------------------------------------------------------
| EDUCATION QUIZZES
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Admin\EducationQuizController;
use App\Http\Controllers\Admin\EducationQuizQuestionController;
use App\Http\Controllers\Admin\EducationQuizOptionController;
use App\Http\Controllers\Admin\EducationQuizAttemptController;


/*
|--------------------------------------------------------------------------
| EDUCATION STUDENT
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Education\EducationStudentLessonController;
use App\Http\Controllers\Education\EducationStudentNotificationController;


/*
|--------------------------------------------------------------------------
| EDUCATION STUDENT FRONT
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Education\EducationStudentLessonFrontController;
use App\Http\Controllers\Education\EducationStudentQuizController;


/*
|--------------------------------------------------------------------------
| EDUCATION
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Education\EducationStudentDashboardController;
use App\Http\Controllers\Education\EducationBookingController;
use App\Http\Controllers\Education\EducationDashboardController;
use App\Http\Controllers\Education\EducationAdminBookingController;
use App\Http\Controllers\Education\EducationStudentBookingController;
use App\Http\Controllers\Education\EducationBookingPaymentController;
use App\Http\Controllers\Education\EducationAdminPaymentController;
use App\Http\Controllers\Education\EducationStudentController;
use App\Http\Controllers\Education\EducationLessonController;
use App\Http\Controllers\Education\EducationLessonContentController;
use App\Http\Controllers\Education\EducationResourceController;
use App\Http\Controllers\Education\EducationLessonAssignmentController;
use App\Http\Controllers\Education\EducationStudentLessonContentController;
use App\Http\Controllers\Education\EducationAdminSettingController;
use App\Http\Controllers\Education\EducationBookingTypeController;
use App\Http\Controllers\Education\EducationAvailabilityController;
use App\Http\Controllers\Education\EducationCommentController;
use App\Http\Controllers\Education\Admin\EducationCommentController as EducationAdminCommentController;
use App\Http\Controllers\Education\EducationAdminNotificationController;
use App\Http\Controllers\Education\Auth\EducationAdminProfileController;
use App\Http\Controllers\Education\Admin\EducationContactMessageController;
use App\Http\Controllers\Education\EducationLanguageController;


/*
|--------------------------------------------------------------------------
| EDUCATION STUDENT PROFILE
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Education\EducationProfileController;


/*
|--------------------------------------------------------------------------
| EDUCATION NEWS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Education\Admin\EducationNewsController;


/*
|--------------------------------------------------------------------------
| EDUCATION CONVERSATIONS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Education\EducationConversationController;


/*
|--------------------------------------------------------------------------
| EDUCATION ADMIN CONVERSATIONS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Education\Admin\EducationConversationController as EducationAdminConversationController;


/*
|--------------------------------------------------------------------------
| MAIN ADMIN
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Admin\NotificationController as AdminNotificationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ProjectCategoryController;
use App\Http\Controllers\Admin\TechnologyCategoryController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\UserController;

use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\ConversationController as AdminConversationController;
use App\Http\Controllers\Admin\DigitalStudioNewsController;


/*
|--------------------------------------------------------------------------
| FRONT WEBSITE
|--------------------------------------------------------------------------
*/

Route::view(
    '/',
    'portal.index'
)
    ->middleware('digital.locale')
    ->name('portal');


/*
|--------------------------------------------------------------------------
| EDUCATION LANGUAGE
|--------------------------------------------------------------------------
*/

Route::get(
    '/education/language/{locale}',
    [EducationLanguageController::class, 'switch']
)
    ->where('locale', 'ar|en')
    ->name('education.language');


/*
|--------------------------------------------------------------------------
| EDUCATION MAIN WEBSITE
|--------------------------------------------------------------------------
*/

Route::get(
    '/education',
    [EducationController::class, 'index']
)
    ->middleware('education.locale')
    ->name('education.index');


/*
|--------------------------------------------------------------------------
| EDUCATION PUBLIC COMMENTS
|--------------------------------------------------------------------------
*/

Route::get(
    '/education/comments',
    [EducationCommentController::class, 'index']
)
    ->middleware('education.locale')
    ->name('education.comments.index');


Route::post(
    '/education/comments',
    [EducationCommentController::class, 'store']
)
    ->middleware([
        'education.locale',
        'throttle:5,10',
    ])
    ->name('education.comments.store');


/*
|--------------------------------------------------------------------------
| EDUCATION RESOURCES
|--------------------------------------------------------------------------
*/

Route::get(
    '/education/resources',
    [EducationResourceController::class, 'index']
)
    ->middleware('education.locale')
    ->name('education.resources.index');


Route::get(
    '/education/resources/quiz/{quiz}',
    [\App\Http\Controllers\Education\EducationQuizController::class, 'show']
)
    ->middleware('education.locale')
    ->name('education.resources.quiz');


Route::post(
    '/education/resources/quiz/{quiz}/submit',
    [\App\Http\Controllers\Education\EducationQuizController::class, 'submit']
)
    ->middleware('education.locale')
    ->name('education.resources.quiz.submit');


Route::get(
    '/education/resources/quiz/{quiz}/result',
    [\App\Http\Controllers\Education\EducationQuizController::class, 'result']
)
    ->middleware('education.locale')
    ->name('education.resources.quiz.result');


Route::get(
    '/education/resources/category/{category}',
    [EducationResourceController::class, 'category']
)
    ->middleware('education.locale')
    ->name('education.resources.category');


Route::get(
    '/education/resources/lessons/{lesson:slug}',
    [EducationResourceController::class, 'lesson']
)
    ->middleware('education.locale')
    ->name('education.resources.lesson');


/*
|--------------------------------------------------------------------------
| PUBLIC EDUCATION LESSON
|--------------------------------------------------------------------------
*/

Route::get(
    '/education/lessons/{lesson}',
    [EducationController::class, 'lesson']
)
    ->middleware('education.locale')
    ->name('education.lessons.show');


/*
|--------------------------------------------------------------------------
| PUBLIC EDUCATION LESSON QUIZ
|--------------------------------------------------------------------------
*/

Route::get(
    '/education/lessons/{lesson}/quiz',
    [EducationController::class, 'quiz']
)
    ->middleware('education.locale')
    ->name('education.lessons.quiz');


/*
|--------------------------------------------------------------------------
| EDUCATION ADMIN AUTHENTICATION
|--------------------------------------------------------------------------
*/

Route::prefix('education/admin')
    ->name('education.admin.')
    ->middleware('education.locale')
    ->group(function () {

        Route::get(
            '/login',
            [EducationAdminAuthController::class, 'showLogin']
        )->name('login');


        Route::post(
            '/login',
            [EducationAdminAuthController::class, 'login']
        )->name('login.store');


        Route::post(
            '/logout',
            [EducationAdminAuthController::class, 'logout']
        )->name('logout');

    });


/*
|--------------------------------------------------------------------------
| EDUCATION ADMIN PANEL
|--------------------------------------------------------------------------
*/

Route::prefix('education/admin')
    ->name('education.admin.')
    ->middleware([
        'education.locale',
        'education_admin.auth',
    ])
    ->group(function () {

        Route::get(
            '/',
            [EducationDashboardController::class, 'index']
        )->name('dashboard');


        Route::get(
            '/notifications',
            [EducationAdminNotificationController::class, 'index']
        )->name('notifications.index');


        Route::get(
            '/notifications/data',
            [EducationAdminNotificationController::class, 'data']
        )->name('notifications.data');


        Route::patch(
            '/notifications/read-all',
            [EducationAdminNotificationController::class, 'markAllAsRead']
        )->name('notifications.read_all');


        Route::patch(
            '/notifications/{notification}/read',
            [EducationAdminNotificationController::class, 'read']
        )->name('notifications.read');


        Route::delete(
            '/notifications/{notification}',
            [EducationAdminNotificationController::class, 'destroy']
        )->name('notifications.destroy');


        Route::get(
            '/profile',
            [EducationAdminProfileController::class, 'edit']
        )->name('profile.edit');


        Route::put(
            '/profile',
            [EducationAdminProfileController::class, 'update']
        )->name('profile.update');


        Route::put(
            '/profile/password',
            [EducationAdminProfileController::class, 'updatePassword']
        )->name('profile.password.update');


        Route::resource(
            'news',
            EducationNewsController::class
        );


        Route::post(
            '/news/{news}/toggle',
            [EducationNewsController::class, 'toggle']
        )->name('news.toggle');


        /*
        |--------------------------------------------------------------------------
        | CONVERSATIONS
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/conversations',
            [EducationAdminConversationController::class, 'index']
        )->name('conversations.index');


        Route::get(
            '/conversations/create',
            [EducationAdminConversationController::class, 'create']
        )->name('conversations.create');


        Route::post(
            '/conversations',
            [EducationAdminConversationController::class, 'store']
        )->name('conversations.store');


        Route::get(
            '/conversations/{conversation}',
            [EducationAdminConversationController::class, 'show']
        )->name('conversations.show');


        Route::post(
            '/conversations/{conversation}/messages',
            [EducationAdminConversationController::class, 'storeMessage']
        )->name('conversations.messages.store');


        Route::patch(
            '/conversations/{conversation}/close',
            [EducationAdminConversationController::class, 'close']
        )->name('conversations.close');


        Route::patch(
            '/conversations/{conversation}/reopen',
            [EducationAdminConversationController::class, 'reopen']
        )->name('conversations.reopen');


        Route::delete(
            '/conversations/{conversation}',
            [EducationAdminConversationController::class, 'destroy']
        )->name('conversations.destroy');


        /*
        |--------------------------------------------------------------------------
        | CONTACT MESSAGES
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/contact-messages',
            [EducationContactMessageController::class, 'index']
        )->name('contact-messages.index');


        Route::get(
            '/contact-messages/{contactMessage}',
            [EducationContactMessageController::class, 'show']
        )->name('contact-messages.show');


        Route::patch(
            '/contact-messages/{contactMessage}/replied',
            [EducationContactMessageController::class, 'markAsReplied']
        )->name('contact-messages.replied');


        Route::patch(
            '/contact-messages/{contactMessage}/close',
            [EducationContactMessageController::class, 'close']
        )->name('contact-messages.close');


        Route::patch(
            '/contact-messages/{contactMessage}/reopen',
            [EducationContactMessageController::class, 'reopen']
        )->name('contact-messages.reopen');


        Route::delete(
            '/contact-messages/{contactMessage}',
            [EducationContactMessageController::class, 'destroy']
        )->name('contact-messages.destroy');


        Route::resource(
            'booking-types',
            EducationBookingTypeController::class
        );


        Route::resource(
            'availabilities',
            EducationAvailabilityController::class
        );


        Route::get(
            '/settings',
            [EducationAdminSettingController::class, 'edit']
        )->name('settings.edit');


        Route::put(
            '/settings',
            [EducationAdminSettingController::class, 'updatePaymentSettings']
        )->name('settings.update');


        Route::get(
            '/comments',
            [EducationAdminCommentController::class, 'index']
        )->name('comments.index');


        Route::get(
            '/comments/{comment}/edit',
            [EducationAdminCommentController::class, 'edit']
        )->name('comments.edit');


        Route::put(
            '/comments/{comment}',
            [EducationAdminCommentController::class, 'update']
        )->name('comments.update');


        Route::patch(
            '/comments/{comment}/approve',
            [EducationAdminCommentController::class, 'approve']
        )->name('comments.approve');


        Route::patch(
            '/comments/{comment}/reject',
            [EducationAdminCommentController::class, 'reject']
        )->name('comments.reject');


        Route::delete(
            '/comments/{comment}',
            [EducationAdminCommentController::class, 'destroy']
        )->name('comments.destroy');


        Route::get(
            '/student-lessons',
            [EducationStudentLessonController::class, 'index']
        )->name('student-lessons.index');


        Route::get(
            '/student-lessons/create',
            [EducationStudentLessonController::class, 'create']
        )->name('student-lessons.create');


        Route::post(
            '/student-lessons',
            [EducationStudentLessonController::class, 'store']
        )->name('student-lessons.store');


        Route::get(
            '/student-lessons/create-from-assignment/{assignment}',
            [EducationStudentLessonController::class, 'createFromAssignment']
        )->name('student-lessons.create-from-assignment');


        Route::get(
            '/student-lessons/{studentLesson}',
            [EducationStudentLessonController::class, 'show']
        )->name('student-lessons.show');


        Route::get(
            '/student-lessons/{studentLesson}/edit',
            [EducationStudentLessonController::class, 'edit']
        )->name('student-lessons.edit');


        Route::put(
            '/student-lessons/{studentLesson}',
            [EducationStudentLessonController::class, 'update']
        )->name('student-lessons.update');


        Route::post(
            '/student-lessons/{studentLesson}/start',
            [EducationStudentLessonController::class, 'start']
        )->name('student-lessons.start');


        Route::post(
            '/student-lessons/{studentLesson}/complete',
            [EducationStudentLessonController::class, 'complete']
        )->name('student-lessons.complete');


        Route::post(
            '/student-lessons/{studentLesson}/cancel',
            [EducationStudentLessonController::class, 'cancel']
        )->name('student-lessessones.cancel');


        Route::delete(
            '/student-lessons/{studentLesson}',
            [EducationStudentLessonController::class, 'destroy']
        )->name('student-lessons.destroy');


        Route::get(
            '/student-lessons/{studentLesson}/content',
            [EducationStudentLessonContentController::class, 'index']
        )->name('student-lessons.content.index');


        Route::get(
            '/student-lessons/{studentLesson}/content/create',
            [EducationStudentLessonContentController::class, 'create']
        )->name('student-lessons.content.create');


        Route::post(
            '/student-lessons/{studentLesson}/content',
            [EducationStudentLessonContentController::class, 'store']
        )->name('student-lessons.content.store');


        Route::get(
            '/student-lessons/{studentLesson}/content/{content}',
            [EducationStudentLessonContentController::class, 'show']
        )->name('student-lessessones.content.show');


        Route::get(
            '/student-lessons/{studentLesson}/content/{content}/edit',
            [EducationStudentLessonContentController::class, 'edit']
        )->name('student-lessons.content.edit');


        Route::put(
            '/student-lessons/{studentLesson}/content/{content}',
            [EducationStudentLessonContentController::class, 'update']
        )->name('student-lessessones.content.update');


        Route::patch(
            '/student-lessons/{studentLesson}/content/{content}/toggle-status',
            [EducationStudentLessonContentController::class, 'toggleStatus']
        )->name('student-lessessones.content.toggle-status');


        Route::delete(
            '/student-lessons/{studentLesson}/content/{content}',
            [EducationStudentLessonContentController::class, 'destroy']
        )->name('student-lessessones.content.destroy');


        Route::post(
            '/student-lessons/{studentLesson}/content/reorder',
            [EducationStudentLessonContentController::class, 'reorder']
        )->name('student-lessessones.content.reorder');


        Route::prefix('lesson-assignments')
            ->name('lesson-assignments.')
            ->group(function () {

                Route::get(
                    '/',
                    [EducationLessonAssignmentController::class, 'index']
                )->name('index');


                Route::get(
                    '/create',
                    [EducationLessonAssignmentController::class, 'create']
                )->name('create');


                Route::post(
                    '/',
                    [EducationLessonAssignmentController::class, 'store']
                )->name('store');


                Route::get(
                    '/{assignment}',
                    [EducationLessonAssignmentController::class, 'show']
                )->name('show');


                Route::get(
                    '/{assignment}/edit',
                    [EducationLessonAssignmentController::class, 'edit']
                )->name('edit');


                Route::put(
                    '/{assignment}',
                    [EducationLessonAssignmentController::class, 'update']
                )->name('update');


                Route::delete(
                    '/{assignment}',
                    [EducationLessonAssignmentController::class, 'destroy']
                )->name('destroy');

            });


        Route::resource(
            'quizzes',
            EducationQuizController::class
        );


        Route::resource(
            'quizzes.questions',
            EducationQuizQuestionController::class
        );


        Route::resource(
            'quizzes.questions.options',
            EducationQuizOptionController::class
        );


        Route::get(
            '/quiz-attempts',
            [EducationQuizAttemptController::class, 'index']
        )->name('quiz-attempts.index');


        Route::get(
            '/quiz-attempts/{attempt}',
            [EducationQuizAttemptController::class, 'show']
        )->name('quiz-attempts.show');


        Route::resource(
            'lessons',
            EducationLessonController::class
        );


        Route::patch(
            '/lessons/{lesson}/toggle-status',
            [EducationLessonController::class, 'toggleStatus']
        )->name('lessons.toggle-status');


        Route::get(
            '/lessons/{lesson}/content',
            [EducationLessonContentController::class, 'index']
        )->name('lessons.content.index');


        Route::get(
            '/lessons/{lesson}/content/create',
            [EducationLessonContentController::class, 'create']
        )->name('lessons.content.create');


        Route::post(
            '/lessons/{lesson}/content',
            [EducationLessonContentController::class, 'store']
        )->name('lessons.content.store');


        Route::get(
            '/lessons/{lesson}/content/{content}',
            [EducationLessonContentController::class, 'show']
        )->name('lessons.content.show');


        Route::get(
            '/lessons/{lesson}/content/{content}/edit',
            [EducationLessonContentController::class, 'edit']
        )->name('lessons.content.edit');


        Route::put(
            '/lessons/{lesson}/content/{content}',
            [EducationLessonContentController::class, 'update']
        )->name('lessons.content.update');


        Route::patch(
            '/lessons/{lesson}/content/{content}/toggle-status',
            [EducationLessonContentController::class, 'toggleStatus']
        )->name('lessons.content.toggle-status');


        Route::delete(
            '/lessons/{lesson}/content/{content}',
            [EducationLessonContentController::class, 'destroy']
        )->name('lessons.content.destroy');


        Route::post(
            '/lessons/{lesson}/content/reorder',
            [EducationLessonContentController::class, 'reorder']
        )->name('lessens.content.reorder');


        Route::prefix('students')
            ->name('students.')
            ->group(function () {

                Route::get(
                    '/',
                    [EducationStudentController::class, 'index']
                )->name('index');


                Route::get(
                    '/create',
                    [EducationStudentController::class, 'create']
                )->name('create');


                Route::post(
                    '/',
                    [EducationStudentController::class, 'store']
                )->name('store');


                Route::get(
                    '/{student}',
                    [EducationStudentController::class, 'show']
                )->name('show');


                Route::get(
                    '/{student}/edit',
                    [EducationStudentController::class, 'edit']
                )->name('edit');


                Route::put(
                    '/{student}',
                    [EducationStudentController::class, 'update']
                )->name('update');


                Route::patch(
                    '/{student}/toggle-status',
                    [EducationStudentController::class, 'toggle-status']
                )->name('toggle-status');


                Route::delete(
                    '/{student}',
                    [EducationStudentController::class, 'destroy']
                )->name('destroy');

            });


        Route::get(
            '/bookings',
            [EducationAdminBookingController::class, 'index']
        )->name('bookings.index');


        Route::get(
            '/bookings/{booking}',
            [EducationAdminBookingController::class, 'show']
        )->name('bookings.show');


        Route::patch(
            '/bookings/{booking}/confirm',
            [EducationAdminBookingController::class, 'confirm']
        )->name('bookings.confirm');


        Route::patch(
            '/bookings/{booking}/status',
            [EducationAdminBookingController::class, 'updateStatus']
        )->name('bookings.status');


        Route::patch(
            '/bookings/{booking}/complete',
            [EducationAdminBookingController::class, 'complete']
        )->name('bookings.complete');


        Route::patch(
            '/bookings/{booking}/cancel',
            [EducationAdminBookingController::class, 'cancel']
        )->name('bookings.cancel');


        Route::patch(
            '/bookings/{booking}/no-show',
            [EducationAdminBookingController::class, 'noShow']
        )->name('bookings.no_show');


        Route::patch(
            '/bookings/{booking}/payment/paid',
            [EducationAdminBookingController::class, 'markAsPaid']
        )->name('bookings.payment.paid');


        Route::patch(
            '/bookings/{booking}/payment/pending',
            [EducationAdminBookingController::class, 'markPaymentPending']
        )->name('bookings.payment.pending');


        Route::patch(
            '/bookings/{booking}/payment/unpaid',
            [EducationAdminBookingController::class, 'markAsUnpaid']
        )->name('bookings.payment.unpaid');


        Route::patch(
            '/bookings/{booking}/payment/failed',
            [EducationAdminBookingController::class, 'markPaymentFailed']
        )->name('bookings.payment.failed');


        Route::patch(
            '/bookings/{booking}/payment/refund',
            [EducationAdminBookingController::class, 'refundPayment']
        )->name('bookings.payment.refund');


        Route::patch(
            '/bookings/{booking}/note',
            [EducationAdminBookingController::class, 'updateNote']
        )->name('bookings.note');


        Route::get(
            '/payments',
            [EducationAdminPaymentController::class, 'index']
        )->name('payments.index');


        Route::get(
            '/payments/{payment}',
            [EducationAdminPaymentController::class, 'show']
        )->name('payments.show');


        Route::patch(
            '/payments/{payment}/review',
            [EducationAdminPaymentController::class, 'review']
        )->name('payments.review');


        Route::patch(
            '/payments/{payment}/approve',
            [EducationAdminPaymentController::class, 'approve']
        )->name('payments.approve');


        Route::patch(
            '/payments/{payment}/reject',
            [EducationAdminPaymentController::class, 'reject']
        )->name('payments.reject');


        Route::patch(
            '/payments/{payment}/reset',
            [EducationAdminPaymentController::class, 'reset']
        )->name('payments.reset');

    });


/*
|--------------------------------------------------------------------------
| EDUCATION STUDENT GOOGLE AUTHENTICATION
|--------------------------------------------------------------------------
*/

Route::get(
    '/education/auth/google',
    [
        EducationGoogleAuthController::class,
        'redirect',
    ]
)->name('education.google.redirect');


Route::get(
    '/education/auth/google/callback',
    [
        EducationGoogleAuthController::class,
        'callback',
    ]
)->name('education.google.callback');


/*
|--------------------------------------------------------------------------
| EDUCATION STUDENT AUTHENTICATION
|--------------------------------------------------------------------------
*/

Route::prefix('education')
    ->name('education.')
    ->middleware('education.locale')
    ->group(function () {

        Route::middleware('education.guest')
            ->group(function () {

                Route::get(
                    '/login',
                    [EducationAuthController::class, 'showLogin']
                )->name('login');


                Route::post(
                    '/login',
                    [EducationAuthController::class, 'login']
                )->name('login.store');


                Route::get(
                    '/register',
                    [EducationAuthController::class, 'showRegister']
                )->name('register');


                Route::post(
                    '/register',
                    [EducationAuthController::class, 'register']
                )->name('register.store');


                Route::get(
                    '/forgot-password',
                    [EducationAuthController::class, 'showForgotPassword']
                )->name('password.request');


                Route::post(
                    '/forgot-password',
                    [EducationAuthController::class, 'sendResetLinkEmail']
                )->name('password.email');


                Route::get(
                    '/reset-password/{token}',
                    [EducationAuthController::class, 'showResetPassword']
                )->name('password.reset');


                Route::post(
                    '/reset-password',
                    [EducationAuthController::class, 'resetPassword']
                )->name('password.update');

            });


        Route::middleware('education.auth')
            ->group(function () {

                Route::get(
                    '/profile',
                    [EducationProfileController::class, 'index']
                )->name('profile.index');


                Route::put(
                    '/profile',
                    [EducationProfileController::class, 'update']
                )->name('profile.update');


                Route::put(
                    '/profile/password',
                    [EducationProfileController::class, 'updatePassword']
                )->name('profile.password.update');


                Route::post(
                    '/logout',
                    [EducationAuthController::class, 'logout']
                )->name('logout');


                Route::middleware('education.approved')
                    ->group(function () {

                        Route::get(
                            '/dashboard',
                            [EducationStudentDashboardController::class, 'index']
                        )->name('dashboard');


                        Route::prefix('notifications')
                            ->name('notifications.')
                            ->group(function () {

                                Route::view(
                                    '/all',
                                    'education.student.notifications.index'
                                )->name('all');


                                Route::get(
                                    '/',
                                    [EducationStudentNotificationController::class, 'index']
                                )->name('index');


                                Route::get(
                                    '/data',
                                    [EducationStudentNotificationController::class, 'data']
                                )->name('data');


                                Route::patch(
                                    '/read-all',
                                    [EducationStudentNotificationController::class, 'markAllAsRead']
                                )->name('read_all');


                                Route::patch(
                                    '/{notification}/read',
                                    [EducationStudentNotificationController::class, 'markAsRead']
                                )->name('read');


                                Route::delete(
                                    '/{notification}',
                                    [EducationStudentNotificationController::class, 'destroy']
                                )->name('destroy');

                            });


                        Route::get(
                            '/conversations',
                            [EducationConversationController::class, 'index']
                        )->name('conversations.index');


                        Route::get(
                            '/conversations/create',
                            [EducationConversationController::class, 'create']
                        )->name('conversations.create');


                        Route::post(
                            '/conversations',
                            [EducationConversationController::class, 'store']
                        )->name('conversations.store');


                        Route::get(
                            '/conversations/{conversation}',
                            [EducationConversationController::class, 'show']
                        )->name('conversations.show');


                        Route::post(
                            '/conversations/{conversation}/messages',
                            [EducationConversationController::class, 'storeMessage']
                        )->name('conversations.messages.store');


                        Route::post(
                            '/conversations/{conversation}/close',
                            [EducationConversationController::class, 'close']
                        )->name('conversations.close');


                        Route::post(
                            '/conversations/{conversation}/reopen',
                            [EducationConversationController::class, 'reopen']
                        )->name('conversations.reopen');


                        Route::delete(
                            '/conversations/{conversation}',
                            [EducationConversationController::class, 'destroy']
                        )->name('conversations.destroy');


                        Route::get(
                            '/student/lessons',
                            [EducationStudentLessonFrontController::class, 'index']
                        )->name('student.lessons.index');


                        Route::get(
                            '/student/lessons/{studentLesson}',
                            [EducationStudentLessonFrontController::class, 'show']
                        )->name('student.lessons.show');


                        Route::post(
                            '/student/lessons/{studentLesson}/start',
                            [EducationStudentLessonFrontController::class, 'start']
                        )->name('student.lessons.start');


                        Route::post(
                            '/student/lessons/{studentLesson}/complete',
                            [EducationStudentLessonFrontController::class, 'complete']
                        )->name('student.lessons.complete');


                        Route::get(
                            '/quizzes',
                            [EducationStudentQuizController::class, 'index']
                        )->name('student.quizzes.index');


                        Route::get(
                            '/quizzes/{quiz}',
                            [EducationStudentQuizController::class, 'show']
                        )->name('student.quizzes.show');


                        Route::post(
                            '/quizzes/{quiz}/submit',
                            [EducationStudentQuizController::class, 'submit']
                        )->name('student.quizzes.submit');


                        Route::get(
                            '/quiz-attempts/{attempt}/result',
                            [EducationStudentQuizController::class, 'result']
                        )->name('student.quizzes.result');


                        Route::get(
                            '/book',
                            [EducationBookingController::class, 'create']
                        )->name('booking.create');


                        Route::post(
                            '/book',
                            [EducationBookingController::class, 'store']
                        )->name('booking.store');


                        Route::get(
                            '/bookings/{booking}',
                            [EducationStudentBookingController::class, 'show']
                        )->name('booking.show');


                        Route::get(
                            '/bookings/{booking}/payment',
                            [EducationBookingPaymentController::class, 'show']
                        )->name('booking.payment.show');


                        Route::post(
                            '/bookings/{booking}/payment',
                            [EducationBookingPaymentController::class, 'store']
                        )->name('booking.payment.store');


                        Route::patch(
                            '/bookings/{booking}/cancel',
                            [EducationStudentBookingController::class, 'cancel']
                        )->name('booking.cancel');

                    });

            });

    });


/*
|--------------------------------------------------------------------------
| TECH WEBSITE / DIGITAL STUDIO
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| DIGITAL STUDIO LANGUAGE
|--------------------------------------------------------------------------
*/

Route::get(
    '/tech/language/{locale}',
    function (string $locale) {

        session([
            'digital_studio_locale' => $locale,
        ]);

        app()->setLocale($locale);

        return redirect()->route('tech.index');

    }
)
    ->where('locale', 'ar|en')
    ->name('tech.language');


/*
|--------------------------------------------------------------------------
| DIGITAL STUDIO FRONT
|--------------------------------------------------------------------------
*/

Route::middleware('digital.locale')
    ->group(function () {

        Route::get(
            '/tech',
            [TechController::class, 'index']
        )->name('tech.index');


        Route::get(
            '/projects',
            [PortfolioController::class, 'index']
        )->name('projects.index');


        Route::get(
            '/projects/{project:slug}',
            [PortfolioController::class, 'show']
        )->name('projects.show');


        Route::get(
            '/figma/{slug}',
            [FigmaController::class, 'show']
        )->name('figma.show');


        Route::get(
            '/comments',
            [CommentController::class, 'create']
        )->name('comments.create');


        Route::post(
            '/comments',
            [CommentController::class, 'store']
        )->name('comments.store');


        /*
        |--------------------------------------------------------------------------
        | CONTACT FORM
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/contact',
            [ContactController::class, 'store']
        )->name('contact.store');

    });


/*
|--------------------------------------------------------------------------
| ACADEMY
|--------------------------------------------------------------------------
*/

Route::view(
    '/academy',
    'academy.index'
)->name('academy.index');


/*
|--------------------------------------------------------------------------
| AUTHENTICATED USER NOTIFICATIONS COUNT
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'digital.locale',
])->group(function () {

    Route::get(
        '/notifications/count',
        [NotificationController::class, 'count']
    )->name('notifications.count');

});


/*
|--------------------------------------------------------------------------
| MAIN ADMIN LANGUAGE
|--------------------------------------------------------------------------
*/

Route::get(
    '/admin/language/{locale}',
    function (string $locale) {

        session([
            'digital_studio_locale' => $locale,
        ]);

        app()->setLocale($locale);

        return redirect()->back();

    }
)
    ->where('locale', 'ar|en')
    ->name('admin.language');


/*
|--------------------------------------------------------------------------
| MAIN ADMIN PANEL
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'verified',
    'admin',
    'digital.locale',
])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | DIGITAL STUDIO NEWS
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'news',
            DigitalStudioNewsController::class
        )->except(['show']);


        /*
        |--------------------------------------------------------------------------
        | NOTIFICATION COUNTS
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/notifications/counts',
            [AdminNotificationController::class, 'counts']
        )->name('notifications.counts');


        /*
        |--------------------------------------------------------------------------
        | DASHBOARD
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/',
            [DashboardController::class, 'index']
        )->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | PROJECTS
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'projects',
            ProjectController::class
        );


        Route::delete(
            'projects/{project}/gallery/{image}',
            [ProjectController::class, 'deleteGallery']
        )->name('projects.gallery.delete');


        /*
        |--------------------------------------------------------------------------
        | PROJECT CATEGORIES
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'project-categories',
            ProjectCategoryController::class
        );


        /*
        |--------------------------------------------------------------------------
        | TECHNOLOGY CATEGORIES
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'technology-categories',
            TechnologyCategoryController::class
        );


        /*
        |--------------------------------------------------------------------------
        | TECHNOLOGIES
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'technologies',
            TechnologyController::class
        );


        /*
        |--------------------------------------------------------------------------
        | COMMENTS
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'comments',
            AdminCommentController::class
        );


        Route::patch(
            'comments/{comment}/status',
            [AdminCommentController::class, 'changeStatus']
        )->name('comments.changeStatus');


        /*
        |--------------------------------------------------------------------------
        | USERS
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'users',
            UserController::class
        );


        /*
        |--------------------------------------------------------------------------
        | CONVERSATIONS / MESSAGES
        |--------------------------------------------------------------------------
        */

        Route::get(
            'conversations',
            [AdminConversationController::class, 'index']
        )->name('conversations.index');


        /*
        |--------------------------------------------------------------------------
        | VISITOR CONTACT MESSAGES
        |--------------------------------------------------------------------------
        |
        | رسائل الزوار القادمة من نموذج الاتصال العام.
        | تظهر داخل نفس قسم الرسائل في Digital Studio.
        |
        | يجب أن تأتي هذه Routes قبل:
        | conversations/{conversation}
        |
        | حتى لا يتم تفسير كلمة contact على أنها conversation.
        |
        */

        Route::get(
            'conversations/contact/{contactMessage}',
            [AdminConversationController::class, 'showContactMessage']
        )->name('conversations.contact.show');


        /*
        |--------------------------------------------------------------------------
        | تعليم رسالة الزائر كمقروءة
        |--------------------------------------------------------------------------
        */

        Route::post(
            'conversations/contact/{contactMessage}/read',
            [AdminConversationController::class, 'markContactMessageAsRead']
        )->name('conversations.contact.read');


        /*
        |--------------------------------------------------------------------------
        | تعليم رسالة الزائر بأنه تمت الإجابة عليها
        |--------------------------------------------------------------------------
        */

        Route::post(
            'conversations/contact/{contactMessage}/replied',
            [AdminConversationController::class, 'markContactMessageAsReplied']
        )->name('conversations.contact.replied');


        /*
        |--------------------------------------------------------------------------
        | الرد على رسالة الزائر عبر البريد الإلكتروني
        |--------------------------------------------------------------------------
        */

        Route::post(
            'conversations/contact/{contactMessage}/reply',
            [AdminConversationController::class, 'replyToContactMessage']
        )->name('conversations.contact.reply');


        /*
        |--------------------------------------------------------------------------
        | حذف رسالة الزائر
        |--------------------------------------------------------------------------
        */

        Route::delete(
            'conversations/contact/{contactMessage}',
            [AdminConversationController::class, 'destroyContactMessage']
        )->name('conversations.contact.destroy');


        /*
        |--------------------------------------------------------------------------
        | AUTHENTICATED USER CONVERSATIONS
        |--------------------------------------------------------------------------
        */

        Route::get(
            'conversations/{conversation}',
            [AdminConversationController::class, 'show']
        )->name('conversations.show');


        Route::post(
            'conversations/{conversation}/messages',
            [AdminConversationController::class, 'sendMessage']
        )->name('conversations.send');


        Route::post(
            'conversations/{conversation}/read',
            [AdminConversationController::class, 'markAsRead']
        )->name('conversations.read');


        Route::post(
            'conversations/{conversation}/close',
            [AdminConversationController::class, 'close']
        )->name('conversations.close');


        Route::post(
            'conversations/{conversation}/reopen',
            [AdminConversationController::class, 'reopen']
        )->name('conversations.reopen');


        Route::post(
            'conversations/{conversation}/archive',
            [AdminConversationController::class, 'archive']
        )->name('conversations.archive');


        Route::delete(
            'conversations/{conversation}',
            [AdminConversationController::class, 'destroy']
        )->name('conversations.destroy');

    });


/*
|--------------------------------------------------------------------------
| MAIN AUTHENTICATED USER AREA
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'digital.locale',
])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | NOTIFICATIONS
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/notifications/check',
        [NotificationController::class, 'check']
    )->name('notifications.check');


    /*
    |--------------------------------------------------------------------------
    | CONVERSATIONS
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/conversations',
        [ConversationController::class, 'index']
    )->name('conversations.index');


    Route::get(
        '/conversations/create',
        [ConversationController::class, 'create']
    )->name('conversations.create');


    Route::post(
        '/conversations',
        [ConversationController::class, 'store']
    )->name('conversations.store');


    Route::get(
        '/conversations/{conversation}',
        [ConversationController::class, 'show']
    )->name('conversations.show');


    Route::post(
        '/conversations/{conversation}/messages',
        [ConversationController::class, 'sendMessage']
    )->name('conversations.messages.send');


    Route::post(
        '/conversations/{conversation}/close',
        [ConversationController::class, 'close']
    )->name('conversations.close');


    Route::post(
        '/conversations/{conversation}/reopen',
        [ConversationController::class, 'reopen']
    )->name('conversations.reopen');


    /*
    |--------------------------------------------------------------------------
    | USER PROFILE
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');


    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');


    Route::patch(
        '/profile/password',
        [
            ProfileController::class,
            'updatePassword',
        ]
    )->name('profile.password.update');


    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');

});


/*
|--------------------------------------------------------------------------
| GOOGLE AUTHENTICATION
|--------------------------------------------------------------------------
*/

Route::get(
    '/auth/google',
    [
        GoogleAuthController::class,
        'redirect',
    ]
)->name('google.redirect');


Route::get(
    '/auth/google/callback',
    [
        GoogleAuthController::class,
        'callback',
    ]
)->name('google.callback');


require __DIR__ . '/auth.php';
