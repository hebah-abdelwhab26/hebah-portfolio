<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Technology extends Model
{
    use HasFactory;

    protected $fillable = [

        'technology_category_id',

        'name',

        'slug',

        'icon',

        'color',

        'description',

        'website',

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

    public function category()
    {
        return $this->belongsTo(
            TechnologyCategory::class,
            'technology_category_id'
        );
    }

  public function projects()
{
    return $this->belongsToMany(

        Project::class,

        'project_technology'

    )->withPivot('sort_order')
     ->withTimestamps();
}

}
