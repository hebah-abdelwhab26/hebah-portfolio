<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Project;

class PortfolioController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Portfolio Page
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $projects = Project::with([
                'category',
                'technologies',
            ])
            ->where('status', 'published')
            ->where('is_active', true)
            ->latest()
            ->paginate(9);

        return view(
            'tech.portfolio.index',
            compact('projects')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Single Project
    |--------------------------------------------------------------------------
    */

    public function show(Project $project)
    {
        abort_if(
            !$project->is_active ||
            $project->status !== 'published',
            404
        );

        /*
        |--------------------------------------------------------------------------
        | Load Relations
        |--------------------------------------------------------------------------
        */

        $project->load([

            'category',

            'technologies' => function ($query) {

                $query->orderBy('name');

            },

            'images' => function ($query) {

                $query->orderBy('sort_order')
                      ->orderBy('id');

            },

        ]);

        /*
        |--------------------------------------------------------------------------
        | Previous Project
        |--------------------------------------------------------------------------
        */

        $previousProject = Project::where('status', 'published')
            ->where('is_active', true)
            ->where('id', '<', $project->id)
            ->latest('id')
            ->first();

        /*
        |--------------------------------------------------------------------------
        | Next Project
        |--------------------------------------------------------------------------
        */

        $nextProject = Project::where('status', 'published')
            ->where('is_active', true)
            ->where('id', '>', $project->id)
            ->oldest('id')
            ->first();

        /*
        |--------------------------------------------------------------------------
        | Related Projects
        |--------------------------------------------------------------------------
        */

        $relatedProjects = Project::with([
                'category',
                'technologies',
            ])
            ->where('project_category_id', $project->project_category_id)
            ->where('id', '!=', $project->id)
            ->where('status', 'published')
            ->where('is_active', true)
            ->latest()
            ->take(3)
            ->get();

        if ($relatedProjects->count() < 3) {

            $exclude = $relatedProjects
                ->pluck('id')
                ->push($project->id);

            $additional = Project::with([
                    'category',
                    'technologies',
                ])
                ->whereNotIn('id', $exclude)
                ->where('status', 'published')
                ->where('is_active', true)
                ->latest()
                ->take(3 - $relatedProjects->count())
                ->get();

            $relatedProjects = $relatedProjects->concat($additional);
        }

        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        */

        $galleryCount = $project->images->count();

        $technologyCount = $project->technologies->count();

        /*
        |--------------------------------------------------------------------------
        | View
        |--------------------------------------------------------------------------
        */

        return view(
            'tech.portfolio.show',
            compact(
                'project',
                'relatedProjects',
                'previousProject',
                'nextProject',
                'galleryCount',
                'technologyCount'
            )
        );
    }
}
