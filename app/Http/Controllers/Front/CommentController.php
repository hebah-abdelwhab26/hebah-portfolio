<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
     * ==================================
     * Comment Form
     * ==================================
     */

   public function create()
{
    /*
    |--------------------------------------------------------------------------
    | Active Projects
    |--------------------------------------------------------------------------
    */

    $projects = Project::where(
            'status',
            'published'
        )
        ->where('is_active', true)
        ->orderBy('title')
        ->get();

    /*
    |--------------------------------------------------------------------------
    | Latest Approved Comments
    |--------------------------------------------------------------------------
    */

    $comments = Comment::with('commentable')
        ->where('status', 'approved')
        ->latest()
        ->take(6)
        ->get();

    return view(
        'tech.comments.create',
        compact(
            'projects',
            'comments'
        )
    );
}

    /**
     * ==================================
     * Store Comment
     * ==================================
     */

    public function store(StoreCommentRequest $request)
    {
        DB::beginTransaction();

        try {

            $data = $request->validated();

            /*
            |--------------------------------------------------------------------------
            | Logged User
            |--------------------------------------------------------------------------
            */

            $data['user_id'] = auth()->id();

            /*
            |--------------------------------------------------------------------------
            | General Comment
            |--------------------------------------------------------------------------
            */

            if (
                empty($data['commentable_id']) ||
                empty($data['commentable_type'])
            ) {

                $data['commentable_id'] = null;

                $data['commentable_type'] = null;

            }

            /*
            |--------------------------------------------------------------------------
            | Default Status
            |--------------------------------------------------------------------------
            */

            $data['status'] = 'pending';

            Comment::create($data);

            DB::commit();

            return redirect()

                ->back()

                ->with(
                    'success',
                    'Thank you! Your comment has been submitted and is awaiting approval.'
                );

        } /* catch (\Throwable $e) {

            DB::rollBack();

            return back()

                ->withInput()

                ->with(
                    'error',
                    'Something went wrong while submitting your comment.'
                );

        }
    } */
   catch (\Throwable $e) {

    DB::rollBack();

    dd($e->getMessage());

}
    }}
