<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
class EducationAdmin extends Authenticatable
{
    use Notifiable;

    /**
     * اسم الجدول
     */
    protected $table = 'education_admins';

    /**
     * الحقول القابلة للتعبئة
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'is_active',
    ];

    /**
     * الحقول المخفية
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * التحويلات
     */
    protected $casts = [
        'is_active' => 'boolean',
        'password' => 'hashed',
    ];

/*
|--------------------------------------------------------------------------
| NOTIFICATIONS
|--------------------------------------------------------------------------
*/

public function notifications(): HasMany
{
    return $this->hasMany(
        EducationAdminNotification::class,
        'education_admin_id'
    );
}


}

