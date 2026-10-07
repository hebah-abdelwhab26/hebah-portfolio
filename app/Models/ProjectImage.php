<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectImage extends Model
{
    use HasFactory;

    protected $fillable = [

        'project_id',

        'image',

        'title',

        'alt',

        'sort_order',

        'is_active',

    ];

    protected $casts = [

        'is_active' => 'boolean',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getGalleryImageUrlAttribute(): string
    {
        if (
            $this->image &&
            file_exists(public_path('images/projects/gallery/' . $this->image))
        ) {
            return asset('images/projects/gallery/' . $this->image);
        }

        return asset('images/project-placeholder.webp');
    }
}
