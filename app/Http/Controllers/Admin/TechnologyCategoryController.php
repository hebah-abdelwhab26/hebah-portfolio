<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTechnologyCategoryRequest;
use App\Models\TechnologyCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Traits\HandlesUploads;

class TechnologyCategoryController extends Controller
{            use HandlesUploads;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = TechnologyCategory::withCount('technologies');

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where(
                    'name',
                    'like',
                    '%' . $request->search . '%'
                )

                ->orWhere(
                    'description',
                    'like',
                    '%' . $request->search . '%'
                );

            });

        }

        /*
        |--------------------------------------------------------------------------
        | Active Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('active')) {

            $query->where(
                'is_active',
                $request->active
            );

        }

        $categories = $query
            ->orderBy('sort_order')
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.technology-categories.index',
            compact('categories')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(
            'admin.technology-categories.create'
        );
    }

    /**
     * Store a newly created resource.
     */
        public function store(StoreTechnologyCategoryRequest $request)
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

            TechnologyCategory::create($data);

            DB::commit();

            return redirect()
                ->route('admin.technology-categories.index')
                ->with(
                    'success',
                    'Technology category created successfully.'
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
    public function show(TechnologyCategory $technologyCategory)
    {
        $technologyCategory->load('technologies');

        return view(
            'admin.technology-categories.show',
            compact('technologyCategory')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TechnologyCategory $technologyCategory)
    {
        return view(
            'admin.technology-categories.edit',
            compact('technologyCategory')
        );
    }

    /**
     * Update the specified resource.
     */
        public function update(
        StoreTechnologyCategoryRequest $request,
        TechnologyCategory $technologyCategory
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

            $technologyCategory->update($data);

            DB::commit();

            return redirect()
                ->route('admin.technology-categories.index')
                ->with(
                    'success',
                    'Technology category updated successfully.'
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
    public function destroy(
        TechnologyCategory $technologyCategory
    )
    {
        /*
        |--------------------------------------------------------------------------
        | Prevent Delete
        |--------------------------------------------------------------------------
        */

        if ($technologyCategory->technologies()->count() > 0) {

            return back()->with(

                'error',

                'This category contains technologies and cannot be deleted.'

            );

        }

        try {

            $technologyCategory->delete();

            return redirect()
                ->route('admin.technology-categories.index')
                ->with(
                    'success',
                    'Technology category deleted successfully.'
                );

        } catch (\Exception $e) {

            return back()->with(
                'error',
                $e->getMessage()
            );

        }
    }
}
