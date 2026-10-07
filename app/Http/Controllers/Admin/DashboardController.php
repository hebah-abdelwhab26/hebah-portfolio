<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Technology;
use App\Models\TechnologyCategory;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        */

        $stats = [

            'projects'      => Project::count(),

            'featured'      => Project::where('featured', true)->count(),

            'categories'    => ProjectCategory::count(),

            'technologies'  => Technology::count(),

            'users'         => User::count(),

        ];

        /*
        |--------------------------------------------------------------------------
        | Latest Projects
        |--------------------------------------------------------------------------
        */

        $latestProjects = Project::with('category')
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Latest Technologies
        |--------------------------------------------------------------------------
        */

        $latestTechnologies = Technology::latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Projects Chart (Last 6 Months)
        |--------------------------------------------------------------------------
        */

        $chartMonths = [];

        $chartData = [];

        for ($i = 5; $i >= 0; $i--) {

            $date = Carbon::now()->subMonths($i);

            $chartMonths[] = $date->format('M');

            $chartData[] = Project::whereYear(
                'created_at',
                $date->year
            )
            ->whereMonth(
                'created_at',
                $date->month
            )
            ->count();
        }

        /*
        |--------------------------------------------------------------------------
        | Recent Activity
        |--------------------------------------------------------------------------
        */

        $activities = collect();

        /*
        |--------------------------------------------------------------------------
        | Projects
        |--------------------------------------------------------------------------
        */

        foreach (Project::latest()->take(3)->get() as $project) {

            $activities->push([

                'icon'        => 'fa-folder-open',

                'color'       => 'primary',

                'title'       => 'New Project',

                'description' => $project->title,

                'time'        => $project->created_at,

            ]);

        }

        /*
        |--------------------------------------------------------------------------
        | Technologies
        |--------------------------------------------------------------------------
        */

        foreach (Technology::latest()->take(3)->get() as $technology) {

            $activities->push([

                'icon'        => 'fa-microchip',

                'color'       => 'success',

                'title'       => 'New Technology',

                'description' => $technology->name,

                'time'        => $technology->created_at,

            ]);

        }
                /*
        |--------------------------------------------------------------------------
        | Project Categories
        |--------------------------------------------------------------------------
        */

        foreach (ProjectCategory::latest()->take(2)->get() as $category) {

            $activities->push([

                'icon'        => 'fa-layer-group',

                'color'       => 'warning',

                'title'       => 'New Category',

                'description' => $category->name,

                'time'        => $category->created_at,

            ]);

        }

        /*
        |--------------------------------------------------------------------------
        | Technology Categories
        |--------------------------------------------------------------------------
        */

        foreach (TechnologyCategory::latest()->take(2)->get() as $category) {

            $activities->push([

                'icon'        => 'fa-sitemap',

                'color'       => 'info',

                'title'       => 'Technology Category',

                'description' => $category->name,

                'time'        => $category->created_at,

            ]);

        }

        /*
        |--------------------------------------------------------------------------
        | Users
        |--------------------------------------------------------------------------
        */

        foreach (User::latest()->take(2)->get() as $user) {

            $activities->push([

                'icon'        => 'fa-user',

                'color'       => 'danger',

                'title'       => 'New User',

                'description' => $user->name,

                'time'        => $user->created_at,

            ]);

        }

        $activities = $activities
            ->sortByDesc('time')
            ->take(10)
            ->values();
                    return view(
            'admin.dashboard.index',
            compact(
                'stats',
                'latestProjects',
                'latestTechnologies',
                'chartMonths',
                'chartData',
                'activities'
            )
        );
    }
}
