<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\DigitalStudioNews;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\TechnologyCategory;

class TechController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Featured Development Projects
        |--------------------------------------------------------------------------
        */

        $featuredProjects = Project::with([
                'category',
                'technologies',
                'images',
            ])
            ->where('status', 'published')
            ->where('featured', true)
            ->where('is_active', true)
            ->whereHas('category', function ($query) {

                $query->where('type', 'development');

            })
            ->orderBy('sort_order')
            ->latest()
            ->get();


        /*
        |--------------------------------------------------------------------------
        | All Design Projects
        |--------------------------------------------------------------------------
        */

        $designProjects = Project::with([
                'category',
                'technologies',
                'images',
            ])
            ->where('status', 'published')
            ->where('is_active', true)
            ->whereHas('category', function ($query) {

                $query->where('type', 'design');

            })
            ->orderBy('sort_order')
            ->latest()
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Separate Design Categories
        |--------------------------------------------------------------------------
        */

        $webDesignProjects = $designProjects->filter(function ($project) {

            return $project->category?->slug === 'web-design';

        });


        $mobileProjects = $designProjects->filter(function ($project) {

            return $project->category?->slug === 'mobile-design';

        });


        $dashboardDesignProjects = $designProjects->filter(function ($project) {

            return $project->category?->slug === 'dashboard-design';

        });


        /*
        |--------------------------------------------------------------------------
        | Mobile Design Projects
        |--------------------------------------------------------------------------
        */

        $mobileDesignProjects = Project::with([
                'category',
                'technologies',
                'images',
            ])
            ->where('status', 'published')
            ->where('is_active', true)
            ->whereHas('category', function ($query) {

                $query->where('slug', 'mobile-design');

            })
            ->orderBy('sort_order')
            ->latest()
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Dashboard Design Projects
        |--------------------------------------------------------------------------
        */

        $dashboardDesignProjects = Project::with([
                'category',
                'technologies',
                'images',
            ])
            ->where('status', 'published')
            ->where('is_active', true)
            ->whereHas('category', function ($query) {

                $query->where('slug', 'dashboard-design');

            })
            ->orderBy('sort_order')
            ->latest()
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Development Categories
        |--------------------------------------------------------------------------
        */

        $portfolioCategories = ProjectCategory::where(
                'type',
                'development'
            )
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Design Categories
        |--------------------------------------------------------------------------
        */

        $designCategories = ProjectCategory::where(
                'type',
                'design'
            )
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Technology Categories
        |--------------------------------------------------------------------------
        */

        $technologyCategories = TechnologyCategory::with('technologies')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Approved Comments
        |--------------------------------------------------------------------------
        */

        $comments = Comment::with([
                'user',
                'commentable.category'
            ])
            ->where('status', 'approved')
            ->latest()
            ->take(6)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Digital Studio News
        |--------------------------------------------------------------------------
        |
        | Only active news items that are currently within their
        | start/end publishing dates will be displayed.
        |
        */

        $news = DigitalStudioNews::published()->get();


        /*
        |--------------------------------------------------------------------------
        | Return View
        |--------------------------------------------------------------------------
        */

        return view(
            'tech.index',
            compact(
                'featuredProjects',
                'designProjects',
                'webDesignProjects',
                'mobileProjects',
                'dashboardDesignProjects',
                'portfolioCategories',
                'designCategories',
                'technologyCategories',
                'comments',
                'news'
            )
        );
    }
}
