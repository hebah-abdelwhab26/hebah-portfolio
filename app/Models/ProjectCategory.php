<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectCategory extends Model
{
    use HasFactory;

    protected $fillable = [

        /*
        |--------------------------------------------------------------------------
        | Basic Information
        |--------------------------------------------------------------------------
        */

        'name',

        'slug',

        'description',

        /*
        |--------------------------------------------------------------------------
        | Display
        |--------------------------------------------------------------------------
        */

        'icon',

        'color',

        /*
        |--------------------------------------------------------------------------
        | Category Type
        |--------------------------------------------------------------------------
        |
        | development
        | design
        |
        */

        'type',

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

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeDevelopment($query)
    {
        return $query->where('type', 'development');
    }

    public function scopeDesign($query)
    {
        return $query->where('type', 'design');
    }
}
