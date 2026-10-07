<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Project;

class FigmaController extends Controller
{
    /**
     * Display the specified design.
     */
    public function show(string $slug)
    {
        /*
        |--------------------------------------------------------------------------
        | Current Project
        |--------------------------------------------------------------------------
        */

        $project = Project::with([
                'category',
                'technologies',
                'images',
            ])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->where('is_active', true)
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Related Projects
        |--------------------------------------------------------------------------
        */

        $relatedProjects = Project::with([
                'category',
            ])
            ->where('project_category_id', $project->project_category_id)
            ->where('id', '!=', $project->id)
            ->where('status', 'published')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->latest()
            ->take(3)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Return View
        |--------------------------------------------------------------------------
        */

        return view(
            'tech.figma.show',
            compact(
                'project',
                'relatedProjects'
            )
        );
    }
}
