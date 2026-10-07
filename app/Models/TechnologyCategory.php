<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TechnologyCategory extends Model
{
    use HasFactory;

    protected $fillable = [

        'name',

        'slug',

        'icon',

        'color',

        'description',

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

    public function technologies()
    {
        return $this->hasMany(Technology::class);
    }
}
