<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectImage;
use App\Models\Technology;
use App\Models\TechnologyCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ProjectController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {

        $query = Project::with([
            'category',
            'technologies',
            'images',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where(
                    'title',
                    'like',
                    '%' . $request->search . '%'
                )
                ->orWhere(
                    'subtitle',
                    'like',
                    '%' . $request->search . '%'
                )
                ->orWhere(
                    'short_description',
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
                'project_category_id',
                $request->category
            );

        }



        /*
        |--------------------------------------------------------------------------
        | Status Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );

        }



        /*
        |--------------------------------------------------------------------------
        | Featured Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('featured')) {

            $query->where(
                'featured',
                $request->featured
            );

        }



        $projects = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();



        $categories = ProjectCategory::where(
                'is_active',
                true
            )
            ->orderBy('type')
            ->orderBy('sort_order')
            ->get();



        return view(
            'admin.projects.index',
            compact(
                'projects',
                'categories'
            )
        );

    }





    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

   public function create()
{
    /*
    |--------------------------------------------------------------------------
    | Project Categories
    |--------------------------------------------------------------------------
    */

    $categories = ProjectCategory::where('is_active', true)
        ->orderBy('type')
        ->orderBy('sort_order')
        ->get();

    $developmentCategories = $categories
        ->where('type', 'development')
        ->values();

    $designCategories = $categories
        ->where('type', 'design')
        ->values();

    /*
    |--------------------------------------------------------------------------
    | Technologies
    |--------------------------------------------------------------------------
    */

    $technologies = Technology::with('category')
        ->where('is_active', true)
        ->orderBy('sort_order')
        ->get();

    /*
    |--------------------------------------------------------------------------
    | Return View
    |--------------------------------------------------------------------------
    */

    return view(
        'admin.projects.create',
        compact(
            'categories',
            'developmentCategories',
            'designCategories',
            'technologies'
        )
    );
}
        /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(StoreProjectRequest $request)
    {

        DB::beginTransaction();


        try {


            $data = $request->validated();



            /*
            |--------------------------------------------------------------------------
            | Slug
            |--------------------------------------------------------------------------
            */

            $data['slug'] = $request->filled('slug')
                ? Str::slug($request->slug)
                : Str::slug($request->title);



            $data['featured'] = $request->boolean('featured');

            $data['is_active'] = $request->boolean('is_active');





            /*
            |--------------------------------------------------------------------------
            | Upload Thumbnail
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('thumbnail')) {


                $file = $request->file('thumbnail');


                $extension = $file->getClientOriginalExtension();


                $originalName = pathinfo(
                    $file->getClientOriginalName(),
                    PATHINFO_FILENAME
                );



                $thumbnailName =
                    time()
                    . '_thumb_'
                    . Str::slug($originalName)
                    . '.'
                    . $extension;



                $file->move(
                    public_path('images/projects/thumbnails'),
                    $thumbnailName
                );



                $data['thumbnail'] = $thumbnailName;

            }





            /*
            |--------------------------------------------------------------------------
            | Upload Cover Image
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('cover_image')) {


                $file = $request->file('cover_image');


                $extension = $file->getClientOriginalExtension();


                $originalName = pathinfo(
                    $file->getClientOriginalName(),
                    PATHINFO_FILENAME
                );



                $coverName =
                    time()
                    . '_cover_'
                    . Str::slug($originalName)
                    . '.'
                    . $extension;



                $file->move(
                    public_path('images/projects/covers'),
                    $coverName
                );



                $data['cover_image'] = $coverName;

            }





            /*
            |--------------------------------------------------------------------------
            | Create Project
            |--------------------------------------------------------------------------
            */

            $project = Project::create($data);





            /*
            |--------------------------------------------------------------------------
            | Sync Technologies
            |--------------------------------------------------------------------------
            */

            if ($request->filled('technologies')) {


                $technologyData = [];



                foreach ($request->technologies as $index => $technologyId) {


                    $technologyData[$technologyId] = [

                        'sort_order' => $index + 1,

                    ];


                }



                $project
                    ->technologies()
                    ->sync($technologyData);


            }






            /*
            |--------------------------------------------------------------------------
            | Gallery Images
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('gallery')) {


                foreach ($request->file('gallery') as $image) {



                    $extension =
                        $image->getClientOriginalExtension();



                    $originalName = pathinfo(
                        $image->getClientOriginalName(),
                        PATHINFO_FILENAME
                    );



                    $imageName =
                        time()
                        . '_'
                        . uniqid()
                        . '_'
                        . Str::slug($originalName)
                        . '.'
                        . $extension;



                    $image->move(
                        public_path('images/projects/gallery'),
                        $imageName
                    );



                    $project->images()->create([

                        'image' => $imageName,

                        'title' => null,

                        'alt' => $project->title,

                        'sort_order' => 0,

                        'is_active' => true,

                    ]);


                }

            }





            DB::commit();



            return redirect()

                ->route('admin.projects.index')

                ->with(
                    'success',
                    'Project created successfully.'
                );




        } catch (\Throwable $e) {


            DB::rollBack();



            return back()

                ->withInput()

                ->withErrors([

                    'error' => $e->getMessage(),

                ]);


        }


    }






    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show(Project $project)
    {


        $project->load([

            'category',

            'technologies',

            'images',

        ]);



        return view(

            'admin.projects.show',

            compact('project')

        );


    }






    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(Project $project)
    {


        $project->load([

            'category',

            'technologies',

            'images',

        ]);





        $categories = ProjectCategory::where(
                'is_active',
                true
            )
            ->orderBy('type')
            ->orderBy('sort_order')
            ->get();





        $developmentCategories = $categories
            ->where('type','development')
            ->values();





        $designCategories = $categories
            ->where('type','design')
            ->values();






        $technologies = Technology::with('category')
            ->where('is_active',true)
            ->orderBy('sort_order')
            ->get();





        $technologyCategories = TechnologyCategory::with([
                'technologies'
            ])
            ->where('is_active',true)
            ->orderBy('sort_order')
            ->get();





        $developmentTechnologies = $technologies
            ->filter(function ($technology){

                return optional(
                    $technology->category
                )->slug === 'development';

            })
            ->values();





        $designTechnologies = $technologies
            ->filter(function ($technology){

                return optional(
                    $technology->category
                )->slug === 'design';

            })
            ->values();





        return view(

            'admin.projects.edit',

            compact(

                'project',

                'categories',

                'technologies',

                'technologyCategories',

                'developmentCategories',

                'designCategories',

                'developmentTechnologies',

                'designTechnologies'

            )

        );


    }
        /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

  /*
|--------------------------------------------------------------------------
| UPDATE
|--------------------------------------------------------------------------
*/

public function update(
    UpdateProjectRequest $request,
    Project $project
) {
    DB::beginTransaction();

    try {

        $data = $request->validated();

        /*
        |--------------------------------------------------------------------------
        | SLUG
        |--------------------------------------------------------------------------
        */

        $data['slug'] = $request->filled('slug')
            ? Str::slug($request->slug)
            : Str::slug($request->title);


        /*
        |--------------------------------------------------------------------------
        | BOOLEAN VALUES
        |--------------------------------------------------------------------------
        */

        $data['featured'] = $request->boolean('featured');

        $data['is_active'] = $request->boolean('is_active');


        /*
        |--------------------------------------------------------------------------
        | COVER IMAGE
        |--------------------------------------------------------------------------
        */

        /*
        |--------------------------------------------------------------------------
        | DELETE COVER
        |--------------------------------------------------------------------------
        */

        if ($request->boolean('remove_cover_image')) {

            if ($project->cover_image) {

                $oldCoverPath = public_path(
                    'images/projects/covers/' .
                    $project->cover_image
                );

                if (file_exists($oldCoverPath)) {
                    unlink($oldCoverPath);
                }
            }

            /*
             * IMPORTANT:
             * Database column does not allow NULL.
             * Therefore we use an empty string.
             */

            $data['cover_image'] = '';

        }


        /*
        |--------------------------------------------------------------------------
        | REPLACE COVER WITH NEW IMAGE
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('cover_image')) {

            /*
             * Delete old cover
             */

            if ($project->cover_image) {

                $oldCoverPath = public_path(
                    'images/projects/covers/' .
                    $project->cover_image
                );

                if (file_exists($oldCoverPath)) {
                    unlink($oldCoverPath);
                }
            }


            /*
             * Upload new cover
             */

            $file = $request->file('cover_image');

            $extension = $file->getClientOriginalExtension();

            $originalName = pathinfo(
                $file->getClientOriginalName(),
                PATHINFO_FILENAME
            );


            $coverName =
                time()
                . '_cover_'
                . Str::slug($originalName)
                . '.'
                . $extension;


            $file->move(
                public_path('images/projects/covers'),
                $coverName
            );


            /*
             * IMPORTANT:
             * Store filename only,
             * exactly like STORE method.
             */

            $data['cover_image'] = $coverName;
        }


        /*
        |--------------------------------------------------------------------------
        | THUMBNAIL
        |--------------------------------------------------------------------------
        */

        /*
        |--------------------------------------------------------------------------
        | DELETE THUMBNAIL
        |--------------------------------------------------------------------------
        */

        if ($request->boolean('remove_thumbnail')) {

            if ($project->thumbnail) {

                $oldThumbnailPath = public_path(
                    'images/projects/thumbnails/' .
                    $project->thumbnail
                );

                if (file_exists($oldThumbnailPath)) {
                    unlink($oldThumbnailPath);
                }
            }

            /*
             * Database column does not allow NULL.
             * Therefore we use an empty string.
             */

            $data['thumbnail'] = '';

        }


        /*
        |--------------------------------------------------------------------------
        | REPLACE THUMBNAIL WITH NEW IMAGE
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('thumbnail')) {

            /*
             * Delete old thumbnail
             */

            if ($project->thumbnail) {

                $oldThumbnailPath = public_path(
                    'images/projects/thumbnails/' .
                    $project->thumbnail
                );

                if (file_exists($oldThumbnailPath)) {
                    unlink($oldThumbnailPath);
                }
            }


            /*
             * Upload new thumbnail
             */

            $file = $request->file('thumbnail');

            $extension = $file->getClientOriginalExtension();

            $originalName = pathinfo(
                $file->getClientOriginalName(),
                PATHINFO_FILENAME
            );


            $thumbnailName =
                time()
                . '_thumb_'
                . Str::slug($originalName)
                . '.'
                . $extension;


            $file->move(
                public_path('images/projects/thumbnails'),
                $thumbnailName
            );


            /*
             * Store filename only,
             * exactly like STORE method.
             */

            $data['thumbnail'] = $thumbnailName;
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE PROJECT
        |--------------------------------------------------------------------------
        */

        $project->update($data);


        /*
        |--------------------------------------------------------------------------
        | SYNC TECHNOLOGIES
        |--------------------------------------------------------------------------
        */

        $technologyData = [];


        if ($request->filled('technologies')) {

            foreach ($request->technologies as $index => $technologyId) {

                $technologyData[$technologyId] = [
                    'sort_order' => $index + 1,
                ];

            }
        }


        $project
            ->technologies()
            ->sync($technologyData);


        /*
        |--------------------------------------------------------------------------
        | ADD GALLERY IMAGES
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('gallery')) {

            foreach ($request->file('gallery') as $image) {

                $extension =
                    $image->getClientOriginalExtension();


                $originalName = pathinfo(
                    $image->getClientOriginalName(),
                    PATHINFO_FILENAME
                );


                $imageName =
                    time()
                    . '_'
                    . uniqid()
                    . '_'
                    . Str::slug($originalName)
                    . '.'
                    . $extension;


                $image->move(
                    public_path('images/projects/gallery'),
                    $imageName
                );


                $project->images()->create([

                    'image' => $imageName,

                    'title' => null,

                    'alt' => $project->title,

                    'sort_order' =>
                        $project->images()->count() + 1,

                    'is_active' => true,

                ]);

            }
        }


        /*
        |--------------------------------------------------------------------------
        | COMMIT
        |--------------------------------------------------------------------------
        */

        DB::commit();


        return redirect()

            ->route('admin.projects.index')

            ->with(
                'success',
                'Project updated successfully.'
            );


    } catch (\Throwable $e) {

        DB::rollBack();


        return back()

            ->withInput()

            ->withErrors([

                'error' => $e->getMessage(),

            ]);

    }
}






    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    public function destroy(Project $project)
    {


        DB::beginTransaction();


        try {



            if (

                $project->thumbnail &&

                file_exists(

                    public_path(
                        'images/projects/thumbnails/' .
                        $project->thumbnail
                    )

                )

            ) {


                unlink(

                    public_path(
                        'images/projects/thumbnails/' .
                        $project->thumbnail
                    )

                );


            }





            if (

                $project->cover_image &&

                file_exists(

                    public_path(
                        'images/projects/covers/' .
                        $project->cover_image
                    )

                )

            ) {


                unlink(

                    public_path(
                        'images/projects/covers/' .
                        $project->cover_image
                    )

                );


            }






            foreach ($project->images as $image) {



                if (

                    $image->image &&

                    file_exists(

                        public_path(
                            'images/projects/gallery/' .
                            $image->image
                        )

                    )

                ) {


                    unlink(

                        public_path(
                            'images/projects/gallery/' .
                            $image->image
                        )

                    );


                }



                $image->delete();


            }





            $project->technologies()->detach();



            $project->delete();





            DB::commit();




            return redirect()

                ->route('admin.projects.index')

                ->with(

                    'success',

                    'Project deleted successfully.'

                );




        } catch (\Throwable $e) {



            DB::rollBack();



            return back()

                ->withErrors([

                    'error' => $e->getMessage(),

                ]);


        }


    }








    /*
    |--------------------------------------------------------------------------
    | DELETE GALLERY IMAGE
    |--------------------------------------------------------------------------
    */

    public function deleteGallery(
        Project $project,
        ProjectImage $image
    )
    {


        try {


            if ($image->project_id != $project->id) {


                return response()->json([

                    'success' => false,

                    'message' =>
                        'This image does not belong to this project.'

                ],404);


            }





            $path = public_path(
                'images/projects/gallery/' .
                $image->image
            );





            if (

                $image->image &&

                file_exists($path)

            ) {


                unlink($path);


            }





            $image->delete();





            return response()->json([

                'success' => true,

                'message' =>
                    'Image deleted successfully.'

            ]);




        } catch (\Throwable $e) {


            return response()->json([

                'success' => false,

                'message' =>
                    $e->getMessage(),

            ],500);


        }


    }


}
