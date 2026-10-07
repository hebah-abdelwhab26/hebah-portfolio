<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EducationStudentLessonContent extends Model
{
    protected $table = 'education_student_lesson_contents';


    /*
    |--------------------------------------------------------------------------
    | MASS ASSIGNMENT
    |--------------------------------------------------------------------------
    */

    protected $fillable = [

        'education_student_lesson_id',

        'source_content_id',

        'type',

        'title',

        'description',

        'content',

        'url',

        'file_path',

        'file_name',

        'mime_type',

        'file_size',

        'sort_order',

        'is_active',

    ];


    /*
    |--------------------------------------------------------------------------
    | CASTS
    |--------------------------------------------------------------------------
    */

    protected $casts = [

        'education_student_lesson_id' => 'integer',

        'source_content_id' => 'integer',

        'sort_order' => 'integer',

        'file_size' => 'integer',

        'is_active' => 'boolean',

    ];


    /*
    |--------------------------------------------------------------------------
    | STUDENT LESSON
    |--------------------------------------------------------------------------
    */

    public function studentLesson(): BelongsTo
    {
        return $this->belongsTo(
            EducationStudentLesson::class,
            'education_student_lesson_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SOURCE CONTENT
    |--------------------------------------------------------------------------
    |
    | المحتوى العام الذي تم النسخ منه.
    |
    | هذا للمرجعية فقط.
    |
    */

    public function sourceContent(): BelongsTo
    {
        return $this->belongsTo(
            EducationLessonContent::class,
            'source_content_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | TYPE HELPERS
    |--------------------------------------------------------------------------
    */

    public function isText(): bool
    {
        return $this->type === 'text';
    }


    public function isImage(): bool
    {
        return $this->type === 'image';
    }


    public function isLink(): bool
    {
        return $this->type === 'link';
    }


    public function isFile(): bool
    {
        return $this->type === 'file';
    }


    /*
    |--------------------------------------------------------------------------
    | FILE URL
    |--------------------------------------------------------------------------
    */

    public function getFileUrlAttribute(): ?string
    {
        if (empty($this->file_path)) {
            return null;
        }

        return asset($this->file_path);
    }


    /*
    |--------------------------------------------------------------------------
    | FILE SIZE
    |--------------------------------------------------------------------------
    */

    public function getFormattedFileSizeAttribute(): ?string
    {
        if (!$this->file_size) {
            return null;
        }

        $size = $this->file_size;

        if ($size < 1024) {
            return $size . ' B';
        }

        if ($size < 1024 * 1024) {
            return round($size / 1024, 1) . ' KB';
        }

        if ($size < 1024 * 1024 * 1024) {
            return round(
                $size / (1024 * 1024),
                1
            ) . ' MB';
        }

        return round(
            $size / (1024 * 1024 * 1024),
            1
        ) . ' GB';
    }
}
