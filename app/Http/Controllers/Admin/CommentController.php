<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCommentRequest;
use App\Http\Requests\Admin\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
     * ==================================
     * Display Comments
     * ==================================
     */

    public function index(Request $request)
    {
        $query = Comment::with([
            'user',
            'commentable',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('name', 'like', '%' . $request->search . '%')

                    ->orWhere('email', 'like', '%' . $request->search . '%')

                    ->orWhere('message', 'like', '%' . $request->search . '%');

            });

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

        $comments = $query

            ->latest()

            ->paginate(10)

            ->withQueryString();
            /*
|--------------------------------------------------------------------------
| Statistics
|--------------------------------------------------------------------------
*/

$totalComments = Comment::count();

$pendingComments = Comment::where(
    'status',
    'pending'
)->count();

$approvedComments = Comment::where(
    'status',
    'approved'
)->count();

$rejectedComments = Comment::where(
    'status',
    'rejected'
)->count();

       return view(
    'admin.comments.index',
    compact(
        'comments',
        'totalComments',
        'pendingComments',
        'approvedComments',
        'rejectedComments'
    )
);
    }

    /**
     * ==================================
     * Create
     * ==================================
     */

    public function create()
    {
        $projects = Project::where(
                'is_active',
                true
            )
            ->orderBy('title')
            ->get();

        return view(
            'admin.comments.create',
            compact('projects')
        );
    }
        /**
     * ==================================
     * Edit
     * ==================================
     */

    public function edit(Comment $comment)
    {
        $projects = \App\Models\Project::where(
                'is_active',
                true
            )
            ->orderBy('title')
            ->get();

        return view(
            'admin.comments.edit',
            compact(
                'comment',
                'projects'
            )
        );
    }
public function show(Comment $comment)
{
    return view('admin.comments.show', compact('comment'));
}
    /**
     * ==================================
     * Update
     * ==================================
     */

    public function update(
        UpdateCommentRequest $request,
        Comment $comment
    )
    {
        DB::beginTransaction();

        try {

            $data = $request->validated();

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

            $comment->update($data);

            DB::commit();

            return redirect()

                ->route('admin.comments.index')

                ->with(
                    'success',
                    'Comment updated successfully.'
                );

        } catch (\Throwable $e) {

            DB::rollBack();

            return back()

                ->withInput()

                ->with(
                    'error',
                    'Something went wrong while updating comment.'
                );

        }
    }
/**
 * ==================================
 * Change Comment Status
 * ==================================
 */

public function changeStatus(
    Request $request,
    Comment $comment
)
{
    $request->validate([

        'status' => [

            'required',

            'in:pending,approved,rejected',

        ],

    ]);

    $comment->update([

        'status' => $request->status,

    ]);

    return redirect()

        ->back()

        ->with(

            'success',

            'Comment status updated successfully.'

        );
}
    /**
     * ==================================
     * Destroy
     * ==================================
     */

    public function destroy(Comment $comment)
    {
        DB::beginTransaction();

        try {

            $comment->delete();

            DB::commit();

            return redirect()

                ->route('admin.comments.index')

                ->with(
                    'success',
                    'Comment deleted successfully.'
                );

        } catch (\Throwable $e) {

            DB::rollBack();

            return back()

                ->with(
                    'error',
                    'Unable to delete comment.'
                );

        }
    }

}
