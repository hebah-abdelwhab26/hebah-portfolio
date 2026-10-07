<?php

namespace App\Models;

use App\Notifications\EducationResetPassword;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class EducationUser extends Authenticatable
{
    use Notifiable;

    protected $table = 'education_users';

    /*
    |--------------------------------------------------------------------------
    | MASS ASSIGNMENT
    |--------------------------------------------------------------------------
    */

    protected $fillable = [

        'name',
        'email',
        'google_id',
        'password',
        'phone',
        'whatsapp_number',
        'whatsapp_reminders_enabled',
        'education_level',
        'learning_goal',
        'locale',
        'is_active',
        'student_status',

    ];

    /*
    |--------------------------------------------------------------------------
    | HIDDEN
    |--------------------------------------------------------------------------
    */

    protected $hidden = [

        'password',
        'remember_token',

    ];

    /*
    |--------------------------------------------------------------------------
    | CASTS
    |--------------------------------------------------------------------------
    */

    protected function casts(): array
    {
        return [

            'password' => 'hashed',

            'whatsapp_reminders_enabled' => 'boolean',

            'is_active' => 'boolean',

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | PASSWORD RESET
    |--------------------------------------------------------------------------
    */

    /**
     * إرسال إشعار إعادة تعيين كلمة المرور الخاص بطلاب Education.
     *
     * نستخدم Notification مخصصة حتى يتم إنشاء الرابط
     * باستخدام education.password.reset بدل password.reset.
     */
    public function sendPasswordResetNotification($token): void
    {
        $this->notify(
            new EducationResetPassword($token)
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STUDENT STATUS
    |--------------------------------------------------------------------------
    */

    /**
     * هل الحساب بانتظار اعتماد الطالب؟
     */
    public function isStudentPending(): bool
    {
        return $this->student_status === 'pending';
    }

    /**
     * هل تمت الموافقة على الطالب؟
     */
    public function isStudentApproved(): bool
    {
        return $this->student_status === 'approved';
    }

    /**
     * هل تم رفض الطالب؟
     */
    public function isStudentRejected(): bool
    {
        return $this->student_status === 'rejected';
    }

    /*
    |--------------------------------------------------------------------------
    | QUIZ ATTEMPTS
    |--------------------------------------------------------------------------
    */

    public function quizAttempts(): HasMany
    {
        return $this->hasMany(
            EducationQuizAttempt::class,
            'education_user_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STUDENT BOOKINGS
    |--------------------------------------------------------------------------
    */

    public function bookings(): HasMany
    {
        return $this->hasMany(
            EducationBooking::class,
            'education_user_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | LESSON ASSIGNMENTS
    |--------------------------------------------------------------------------
    */

    public function lessonAssignments(): HasMany
    {
        return $this->hasMany(
            EducationLessonAssignment::class,
            'education_user_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CONVERSATIONS
    |--------------------------------------------------------------------------
    */

    public function conversations(): HasMany
    {
        return $this->hasMany(
            EducationConversation::class,
            'education_user_id'
        );
    }
}
