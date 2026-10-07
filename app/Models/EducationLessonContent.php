<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EducationLessonContent extends Model
{
    protected $table = 'education_lesson_contents';

    protected $fillable = [

        'education_lesson_id',

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


    protected $casts = [

        'education_lesson_id' => 'integer',

        'sort_order' => 'integer',

        'file_size' => 'integer',

        'is_active' => 'boolean',

    ];


    /*
    |--------------------------------------------------------------------------
    | LESSON
    |--------------------------------------------------------------------------
    */

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(
            EducationLesson::class,
            'education_lesson_id'
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


    public function isGoogleDriveVideo(): bool
    {
        return $this->type === 'google_drive_video';
    }


    /*
    |--------------------------------------------------------------------------
    | GOOGLE DRIVE VIDEO
    |--------------------------------------------------------------------------
    */

    public function getGoogleDriveEmbedUrlAttribute(): ?string
    {
        if (!$this->isGoogleDriveVideo || empty($this->url)) {
            return null;
        }

        $url = trim($this->url);

        /*
        |----------------------------------------------------------------------
        | Already an embed / preview URL
        |----------------------------------------------------------------------
        */

        if (
            str_contains($url, 'drive.google.com/file/d/')
            && str_contains($url, '/preview')
        ) {
            return $url;
        }


        /*
        |----------------------------------------------------------------------
        | Extract Google Drive file ID
        |----------------------------------------------------------------------
        */

        $fileId = null;


        if (
            preg_match(
                '#drive\.google\.com/file/d/([^/]+)#',
                $url,
                $matches
            )
        ) {
            $fileId = $matches[1];
        }


        /*
        |----------------------------------------------------------------------
        | Open?id=FILE_ID
        |----------------------------------------------------------------------
        */

        if (
            !$fileId &&
            preg_match(
                '#drive\.google\.com/open\?id=([^&]+)#',
                $url,
                $matches
            )
        ) {
            $fileId = $matches[1];
        }


        /*
        |----------------------------------------------------------------------
        | uc?id=FILE_ID
        |----------------------------------------------------------------------
        */

        if (
            !$fileId &&
            preg_match(
                '#drive\.google\.com/uc\?(?:[^#]*&)?id=([^&]+)#',
                $url,
                $matches
            )
        ) {
            $fileId = $matches[1];
        }


        if (!$fileId) {
            return null;
        }


        return 'https://drive.google.com/file/d/'
            . $fileId
            . '/preview';
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
    | FILE SIZE FORMATTED
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
