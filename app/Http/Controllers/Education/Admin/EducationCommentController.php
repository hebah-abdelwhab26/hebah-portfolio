<?php

namespace App\Http\Controllers\Education\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateEducationCommentRequest;
use App\Models\EducationComment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EducationCommentController extends Controller
{
    /**
     * Display comments.
     */
    public function index(Request $request): View
    {
        $query = EducationComment::query();

        /*
        |--------------------------------------------------------------------------
        | FILTER BY STATUS
        |--------------------------------------------------------------------------
        */

        if (
            $request->filled('status') &&
            in_array(
                $request->status,
                [
                    'pending',
                    'approved',
                    'rejected',
                ],
                true
            )
        ) {
            $query->where(
                'status',
                $request->status
            );
        }

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = trim($request->search);

            $query->where(function ($q) use ($search) {

                $q->where(
                    'name',
                    'like',
                    '%' . $search . '%'
                );

                $q->orWhere(
                    'email',
                    'like',
                    '%' . $search . '%'
                );

                $q->orWhere(
                    'comment',
                    'like',
                    '%' . $search . '%'
                );
            });
        }

        /*
        |--------------------------------------------------------------------------
        | PAGINATION
        |--------------------------------------------------------------------------
        */

        $comments = $query
            ->latest()
            ->paginate(15)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | COUNTS
        |--------------------------------------------------------------------------
        */

        $pendingCount = EducationComment::where(
            'status',
            'pending'
        )->count();

        $approvedCount = EducationComment::where(
            'status',
            'approved'
        )->count();

        $rejectedCount = EducationComment::where(
            'status',
            'rejected'
        )->count();

        $totalCount = EducationComment::count();

        return view(
            'education.admin.comments.index',
            compact(
                'comments',
                'pendingCount',
                'approvedCount',
                'rejectedCount',
                'totalCount'
            )
        );
    }

    /**
     * Edit comment.
     */
    public function edit(
        EducationComment $comment
    ): View {

        return view(
            'education.admin.comments.edit',
            compact('comment')
        );
    }

    /**
     * Update comment.
     */
    public function update(
        UpdateEducationCommentRequest $request,
        EducationComment $comment
    ): RedirectResponse {

        $comment->update(
            $request->validated()
        );

        return redirect()
            ->route(
                'education.admin.comments.index'
            )
            ->with(
                'success',
                'تم تحديث التعليق بنجاح.'
            );
    }

    /**
     * Approve comment.
     */
    public function approve(
        EducationComment $comment
    ): RedirectResponse {

        $comment->update([
            'status' => 'approved',
        ]);

        return back()->with(
            'success',
            'تمت الموافقة على التعليق وأصبح ظاهرًا للزوار.'
        );
    }

    /**
     * Reject comment.
     */
    public function reject(
        EducationComment $comment
    ): RedirectResponse {

        $comment->update([
            'status' => 'rejected',
        ]);

        return back()->with(
            'success',
            'تم رفض التعليق.'
        );
    }

    /**
     * Delete comment.
     */
    public function destroy(
        EducationComment $comment
    ): RedirectResponse {

        $comment->delete();

        return back()->with(
            'success',
            'تم حذف التعليق بنجاح.'
        );
    }
}
