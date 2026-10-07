<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\EducationAdminNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EducationAdminNotificationController extends Controller
{
    /**
     * عرض صفحة جميع إشعارات مدير التعليم.
     */
    public function index(): View
    {
        $admin = Auth::guard('education_admin')->user();

        abort_unless($admin, 403);

        $notifications = EducationAdminNotification::query()
            ->where('education_admin_id', $admin->id)
            ->latest()
            ->paginate(15);

        $unreadCount = EducationAdminNotification::query()
            ->where('education_admin_id', $admin->id)
            ->whereNull('read_at')
            ->count();

        return view(
            'education.admin.notifications.index',
            compact(
                'notifications',
                'unreadCount'
            )
        );
    }


    /**
     * بيانات الإشعارات للجرس.
     */
    public function data(): JsonResponse
    {
        $admin = Auth::guard('education_admin')->user();

        if (!$admin) {
            return response()->json([
                'success' => false,
                'message' => 'يرجى تسجيل الدخول أولًا.',
            ], 401);
        }

        $notifications = EducationAdminNotification::query()
            ->where('education_admin_id', $admin->id)
            ->latest()
            ->limit(20)
            ->get()
            ->map(function (EducationAdminNotification $notification) {

                return [
                    'id' => $notification->id,

                    'type' => $notification->type,

                    'title' => $notification->title,

                    'message' => $notification->message,

                    'icon' => $notification->icon
                        ?: 'fa-regular fa-bell',

                    'color' => $notification->color
                        ?: '#d4ae61',

                    'url' => $notification->url,

                    'is_read' => $notification->read_at !== null,

                    'created_at' => $notification->created_at
                        ? $notification->created_at->diffForHumans()
                        : '',
                ];
            });

        $unreadCount = EducationAdminNotification::query()
            ->where('education_admin_id', $admin->id)
            ->whereNull('read_at')
            ->count();

        return response()->json([
            'success' => true,

            'notifications' => $notifications,

            'unread_count' => $unreadCount,
        ]);
    }


    /**
     * تحديد إشعار واحد كمقروء.
     */
    public function read(
        EducationAdminNotification $notification
    ): JsonResponse|\Illuminate\Http\RedirectResponse {

        $admin = Auth::guard('education_admin')->user();

        abort_unless(
            $admin &&
            $notification->education_admin_id === $admin->id,
            403
        );

        $notification->markAsRead();

        /*
        |--------------------------------------------------------------------------
        | إذا كان الطلب AJAX / Fetch
        |--------------------------------------------------------------------------
        */

        if (request()->expectsJson()) {

            $unreadCount = EducationAdminNotification::query()
                ->where('education_admin_id', $admin->id)
                ->whereNull('read_at')
                ->count();

            return response()->json([
                'success' => true,
                'unread_count' => $unreadCount,
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | الطلب العادي
        |--------------------------------------------------------------------------
        */

        if ($notification->url) {
            return redirect($notification->url);
        }

        return back();
    }


    /**
     * تحديد جميع الإشعارات كمقروءة.
     */
    public function markAllAsRead(): JsonResponse|\Illuminate\Http\RedirectResponse
    {
        $admin = Auth::guard('education_admin')->user();

        abort_unless($admin, 403);

        EducationAdminNotification::query()
            ->where('education_admin_id', $admin->id)
            ->whereNull('read_at')
            ->update([
                'read_at' => now(),
            ]);


        /*
        |--------------------------------------------------------------------------
        | AJAX / Fetch
        |--------------------------------------------------------------------------
        */

        if (request()->expectsJson()) {

            return response()->json([
                'success' => true,

                'unread_count' => 0,
            ]);
        }


        return back()->with(
            'success',
            'تم تحديد جميع الإشعارات كمقروءة.'
        );
    }


    /**
     * حذف إشعار.
     */
    public function destroy(
        EducationAdminNotification $notification
    ) {
        $admin = Auth::guard('education_admin')->user();

        abort_unless(
            $admin &&
            $notification->education_admin_id === $admin->id,
            403
        );

        $notification->delete();

        return back()->with(
            'success',
            'تم حذف الإشعار بنجاح.'
        );
    }
}
