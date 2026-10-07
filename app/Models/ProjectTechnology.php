<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectTechnology extends Model
{
    use HasFactory;

    protected $table = 'project_technology';

    protected $fillable = [

        'project_id',

        'technology_id',

        'sort_order',

    ];

}
