<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectCategoryRequest;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Traits\HandlesUploads;

class ProjectCategoryController extends Controller
{
    use HandlesUploads;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ProjectCategory::withCount('projects');

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');

            });

        }

        /*
        |--------------------------------------------------------------------------
        | Type Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('type')) {

            $query->where('type', $request->type);

        }

        /*
        |--------------------------------------------------------------------------
        | Active Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('active')) {

            $query->where('is_active', $request->active);

        }

        $categories = $query
            ->orderBy('sort_order')
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.project-categories.index',
            compact('categories')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.project-categories.create');
    }

    /**
     * Store a newly created resource.
     */
    public function store(StoreProjectCategoryRequest $request)
    {
        DB::beginTransaction();

        try {

            $data = $request->validated();

            /*
            |--------------------------------------------------------------------------
            | Generate Slug
            |--------------------------------------------------------------------------
            */

            if (empty($data['slug'])) {

                $data['slug'] = Str::slug($data['name']);

            }

            /*
            |--------------------------------------------------------------------------
            | Boolean
            |--------------------------------------------------------------------------
            */

            $data['is_active'] = $request->boolean('is_active');

            /*
            |--------------------------------------------------------------------------
            | Create Category
            |--------------------------------------------------------------------------
            */

            ProjectCategory::create($data);

            DB::commit();

            return redirect()
                ->route('admin.project-categories.index')
                ->with(
                    'success',
                    'Project category created successfully.'
                );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with(
                    'error',
                    $e->getMessage()
                );

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ProjectCategory $projectCategory)
    {
        $projectCategory->load('projects');

        return view(
            'admin.project-categories.show',
            compact('projectCategory')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectCategory $projectCategory)
    {
        return view(
            'admin.project-categories.edit',
            compact('projectCategory')
        );
    }

    /**
     * Update the specified resource.
     */
    public function update(
        StoreProjectCategoryRequest $request,
        ProjectCategory $projectCategory
    )
    {
        DB::beginTransaction();

        try {

            $data = $request->validated();

            /*
            |--------------------------------------------------------------------------
            | Generate Slug
            |--------------------------------------------------------------------------
            */

            if (empty($data['slug'])) {

                $data['slug'] = Str::slug($data['name']);

            }

            /*
            |--------------------------------------------------------------------------
            | Boolean
            |--------------------------------------------------------------------------
            */

            $data['is_active'] = $request->boolean('is_active');

            /*
            |--------------------------------------------------------------------------
            | Update Category
            |--------------------------------------------------------------------------
            */

            $projectCategory->update($data);

            DB::commit();

            return redirect()
                ->route('admin.project-categories.index')
                ->with(
                    'success',
                    'Project category updated successfully.'
                );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with(
                    'error',
                    $e->getMessage()
                );

        }
    }

    /**
     * Remove the specified resource.
     */
    public function destroy(ProjectCategory $projectCategory)
    {
        /*
        |--------------------------------------------------------------------------
        | Prevent delete if category has projects
        |--------------------------------------------------------------------------
        */

        if ($projectCategory->projects()->count() > 0) {

            return back()->with(

                'error',

                'This category contains projects and cannot be deleted.'

            );

        }

        try {

            $projectCategory->delete();

            return redirect()
                ->route('admin.project-categories.index')
                ->with(
                    'success',
                    'Project category deleted successfully.'
                );

        } catch (\Exception $e) {

            return back()->with(
                'error',
                $e->getMessage()
            );

        }
    }
}
