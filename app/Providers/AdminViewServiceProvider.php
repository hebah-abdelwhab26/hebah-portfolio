<?php

namespace App\Providers;

use App\Models\Project;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AdminViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
   public function boot(): void
{
    View::composer('admin.*', function ($view) {

        $view->with('navbar', [

            /*
            |--------------------------------------------------------------------------
            | Projects
            |--------------------------------------------------------------------------
            */

            'projects' => \App\Models\Project::count(),

            'published_projects' => \App\Models\Project::where(
                'status',
                'published'
            )->count(),

            'draft_projects' => \App\Models\Project::where(
                'status',
                'draft'
            )->count(),

            /*
            |--------------------------------------------------------------------------
            | Categories
            |--------------------------------------------------------------------------
            */

            'categories' => \App\Models\ProjectCategory::count(),

            /*
            |--------------------------------------------------------------------------
            | Technologies
            |--------------------------------------------------------------------------
            */

            'technologies' => \App\Models\Technology::count(),

            /*
            |--------------------------------------------------------------------------
            | Users
            |--------------------------------------------------------------------------
            */

            'users' => \App\Models\User::count(),

            /*
            |--------------------------------------------------------------------------
            | Comments
            |--------------------------------------------------------------------------
            | سننشئ الجدول لاحقاً
            */

            'comments' => class_exists(\App\Models\Comment::class)
                ? \App\Models\Comment::count()
                : 0,

            /*
            |--------------------------------------------------------------------------
            | Current User
            |--------------------------------------------------------------------------
            */

            'user' => auth()->user(),

        ]);

    });
}
}
