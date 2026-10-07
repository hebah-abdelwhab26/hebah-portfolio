<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEducationCommentRequest;
use App\Models\EducationAdmin;
use App\Models\EducationAdminNotification;
use App\Models\EducationComment;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EducationCommentController extends Controller
{
    /**
     * Display approved public comments.
     */
    public function index(): View
    {
        $comments = EducationComment::query()
            ->where('status', 'approved')
            ->latest()
            ->paginate(10);

        return view(
            'education.comments.index',
            compact('comments')
        );
    }


    /**
     * Store a new public comment.
     */
    public function store(
        StoreEducationCommentRequest $request
    ): RedirectResponse {

        /*
        |--------------------------------------------------------------------------
        | VALIDATED DATA
        |--------------------------------------------------------------------------
        */

        $validated = $request->validated();


        /*
        |--------------------------------------------------------------------------
        | CREATE COMMENT
        |--------------------------------------------------------------------------
        |
        | جميع التعليقات الجديدة تبدأ بحالة pending
        | حتى يقوم الأدمن بمراجعتها والموافقة عليها.
        |
        */

        $comment = EducationComment::create([
            'name' =>
                $validated['name'],

            'email' =>
                $validated['email'],

            'comment' =>
                $validated['comment'],

            /*
            |--------------------------------------------------------------------------
            | ADMIN APPROVAL
            |--------------------------------------------------------------------------
            */

            'status' =>
                'pending',

            /*
            |--------------------------------------------------------------------------
            | VISITOR META
            |--------------------------------------------------------------------------
            */

            'ip_address' =>
                $request->ip(),

            'user_agent' =>
                $request->userAgent(),
        ]);


        /*
        |--------------------------------------------------------------------------
        | NOTIFY EDUCATION ADMINS
        |--------------------------------------------------------------------------
        |
        | عند وصول تعليق جديد:
        |
        | 1. نحصل على جميع مديري التعليم النشطين.
        | 2. ننشئ إشعارًا لكل مدير.
        | 3. الإشعار يقود مباشرة إلى صفحة إدارة التعليقات.
        |
        */

        $admins = EducationAdmin::query()
            ->where('is_active', true)
            ->get();


        foreach ($admins as $admin) {

            EducationAdminNotification::create([
                'education_admin_id' =>
                    $admin->id,

                'type' =>
                    'new_comment',

                'title' =>
                    'تعليق جديد بانتظار المراجعة',

                'message' =>
                    $comment->name .
                    ' أرسل تعليقًا جديدًا ويحتاج إلى المراجعة.',

                'icon' =>
                    'fa-regular fa-comments',

                'color' =>
                    'gold',

                'url' =>
                    route(
                        'education.admin.comments.index',
                        [
                            'status' => 'pending',
                        ]
                    ),

                'read_at' =>
                    null,

                'data' => [
                    'comment_id' =>
                        $comment->id,

                    'comment_name' =>
                        $comment->name,

                    'comment_email' =>
                        $comment->email,

                    'status' =>
                        $comment->status,
                ],
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'education.comments.index'
            )
            ->with(
                'success',
                'تم إرسال تعليقك بنجاح، وسيظهر بعد مراجعته.'
            );
    }
}

