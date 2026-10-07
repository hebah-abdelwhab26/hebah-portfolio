<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTechnologyRequest;
use App\Models\Technology;
use App\Models\TechnologyCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Traits\HandlesUploads;

class TechnologyController extends Controller
{          use HandlesUploads;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Technology::with('category');

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
                )

                ->orWhere(
                    'slug',
                    'like',
                    '%' . $request->search . '%'
                );

            });

        }

        /*
        |--------------------------------------------------------------------------
        | Category Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('category')) {

            $query->where(

                'technology_category_id',

                $request->category

            );

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



           $technologies = $query->get();


        $categories = TechnologyCategory::orderBy('name')->get();

        return view(

            'admin.technologies.index',

            compact(

                'technologies',

                'categories'

            )

        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = TechnologyCategory::orderBy('name')->get();

        return view(

            'admin.technologies.create',

            compact('categories')

        );
    }

    /**
     * Store a newly created resource.
     */
        public function store(StoreTechnologyRequest $request)
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
            | Create Technology
            |--------------------------------------------------------------------------
            */

            Technology::create($data);

            DB::commit();

            return redirect()
                ->route('admin.technologies.index')
                ->with(
                    'success',
                    'Technology created successfully.'
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
    public function show(Technology $technology)
    {
        $technology->load([
            'category',
            'projects'
        ]);

        return view(
            'admin.technologies.show',
            compact('technology')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        $categories = TechnologyCategory::orderBy('name')->get();

        return view(
            'admin.technologies.edit',
            compact(
                'technology',
                'categories'
            )
        );
    }

    /**
     * Update the specified resource.
     */
        public function update(
        StoreTechnologyRequest $request,
        Technology $technology
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
            | Update Technology
            |--------------------------------------------------------------------------
            */

            $technology->update($data);

            DB::commit();

            return redirect()
                ->route('admin.technologies.index')
                ->with(
                    'success',
                    'Technology updated successfully.'
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
    public function destroy(Technology $technology)
    {
        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | Remove Project Relations
            |--------------------------------------------------------------------------
            */

            $technology->projects()->detach();

            /*
            |--------------------------------------------------------------------------
            | Delete Technology
            |--------------------------------------------------------------------------
            */

            $technology->delete();

            DB::commit();

            return redirect()
                ->route('admin.technologies.index')
                ->with(
                    'success',
                    'Technology deleted successfully.'
                );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with(
                'error',
                $e->getMessage()
            );

        }
    }
}
