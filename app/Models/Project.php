<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [

        'project_category_id',

        'title',

        'slug',

        'subtitle',

        'short_description',

        'description',

        'cover_image',

        'thumbnail',

        'live_demo',

        'github',

        'figma',

        'client',

        'project_date',

        'duration',

        'featured',

        'is_active',

        'sort_order',

        'status',

    ];

    protected $casts = [

        'featured'     => 'boolean',

        'is_active'    => 'boolean',

        'project_date' => 'date',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function category()
    {
        return $this->belongsTo(
            ProjectCategory::class,
            'project_category_id'
        );
    }

   public function images()
{
    return $this->hasMany(ProjectImage::class)
        ->where('is_active', true)
        ->orderBy('sort_order');
}

   public function technologies()
{
    return $this->belongsToMany(

        Technology::class,

        'project_technology'

    )
    ->withPivot('sort_order')
    ->withTimestamps()
    ->orderByPivot('sort_order');
}


/*
|--------------------------------------------------------------------------
| Comments
|--------------------------------------------------------------------------
*/

public function comments()
{
    return $this->morphMany(
        Comment::class,
        'commentable'
    );
}

    /*
    |--------------------------------------------------------------------------
    | Image URLs
    |--------------------------------------------------------------------------
    */

    public function getThumbnailUrlAttribute()
    {
        if (empty($this->thumbnail)) {

            return asset('images/no-image.png');

        }

        return asset(
            'images/projects/thumbnails/' . $this->thumbnail
        );
    }

    public function getCoverImageUrlAttribute()
    {
        if (empty($this->cover_image)) {

            return asset('images/no-image.png');

        }

        return asset(
            'images/projects/covers/' . $this->cover_image
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Route Key
    |--------------------------------------------------------------------------
    */

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
