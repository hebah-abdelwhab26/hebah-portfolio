<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\EducationUserNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EducationStudentNotificationController extends Controller
{
    /**
     * =========================================================
     * NOTIFICATIONS PAGE
     * =========================================================
     */
    public function index(): View
    {
        $student = Auth::guard('education')->user();

        $notifications = EducationUserNotification::query()
            ->where('education_user_id', $student->id)
            ->latest()
            ->paginate(20);

        return view(
            'education.student.notifications.index',
            compact('notifications')
        );
    }

    /**
     * =========================================================
     * NOTIFICATIONS DATA
     * Used by the notification bell / AJAX polling.
     * =========================================================
     */
    public function data(): JsonResponse
    {
        $student = Auth::guard('education')->user();

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'يرجى تسجيل الدخول أولًا.',
            ], 401);
        }

        $notifications = EducationUserNotification::query()
            ->where('education_user_id', $student->id)
            ->latest()
            ->limit(20)
            ->get()
            ->map(function (EducationUserNotification $notification) {
                return [
                    'id' => $notification->id,
                    'type' => $notification->type,

                    'title' => $notification->title,
                    'message' => $notification->message,

                    /*
                    |---------------------------------------------------------
                    | Always return a clean Font Awesome icon class.
                    |---------------------------------------------------------
                    */
                    'icon' => $notification->icon ?: 'fa-bell',

                    'color' => $notification->color ?: '#235d70',

                    'url' => $notification->url,

                    'is_read' => $notification->read_at !== null,

                    'created_at' => $notification->created_at
                        ? $notification->created_at->diffForHumans()
                        : null,
                ];
            });

        $unreadCount = EducationUserNotification::query()
            ->where('education_user_id', $student->id)
            ->whereNull('read_at')
            ->count();

        return response()->json([
            'success' => true,

            'notifications' => $notifications,

            'unread_count' => $unreadCount,
        ]);
    }

    /**
     * =========================================================
     * MARK ONE NOTIFICATION AS READ
     * =========================================================
     */
    public function markAsRead(
        EducationUserNotification $notification
    ): JsonResponse {
        $student = Auth::guard('education')->user();

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'يرجى تسجيل الدخول أولًا.',
            ], 401);
        }

        /*
        |---------------------------------------------------------
        | Security:
        | Make sure the notification belongs to the logged-in
        | education student.
        |---------------------------------------------------------
        */
        if (
            (int) $notification->education_user_id
            !==
            (int) $student->id
        ) {
            return response()->json([
                'success' => false,
                'message' => 'غير مصرح لك بهذا الإشعار.',
            ], 403);
        }

        $notification->markAsRead();

        $unreadCount = EducationUserNotification::query()
            ->where('education_user_id', $student->id)
            ->whereNull('read_at')
            ->count();

        return response()->json([
            'success' => true,

            'id' => $notification->id,

            'is_read' => true,

            'unread_count' => $unreadCount,
        ]);
    }

    /**
     * =========================================================
     * MARK ALL NOTIFICATIONS AS READ
     * =========================================================
     */
    public function markAllAsRead(): JsonResponse
    {
        $student = Auth::guard('education')->user();

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'يرجى تسجيل الدخول أولًا.',
            ], 401);
        }

        EducationUserNotification::query()
            ->where('education_user_id', $student->id)
            ->whereNull('read_at')
            ->update([
                'read_at' => now(),
            ]);

        return response()->json([
            'success' => true,

            'unread_count' => 0,
        ]);
    }

    /**
     * =========================================================
     * DELETE ONE NOTIFICATION
     * =========================================================
     */
    public function destroy(
        EducationUserNotification $notification
    ): JsonResponse {
        $student = Auth::guard('education')->user();

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'يرجى تسجيل الدخول أولًا.',
            ], 401);
        }

        /*
        |---------------------------------------------------------
        | Security:
        | The student can delete ONLY their own notifications.
        |---------------------------------------------------------
        */
        if (
            (int) $notification->education_user_id
            !==
            (int) $student->id
        ) {
            return response()->json([
                'success' => false,
                'message' => 'غير مصرح لك بحذف هذا الإشعار.',
            ], 403);
        }

        /*
        |---------------------------------------------------------
        | Check whether the notification was unread before deletion.
        |---------------------------------------------------------
        */
        $wasUnread = $notification->read_at === null;

        /*
        |---------------------------------------------------------
        | Delete notification.
        |---------------------------------------------------------
        */
        $notificationId = $notification->id;

        $notification->delete();

        /*
        |---------------------------------------------------------
        | Recalculate unread notifications.
        | This keeps the bell badge synchronized.
        |---------------------------------------------------------
        */
        $unreadCount = EducationUserNotification::query()
            ->where('education_user_id', $student->id)
            ->whereNull('read_at')
            ->count();

        return response()->json([
            'success' => true,

            'message' => 'تم حذف الإشعار بنجاح.',

            'deleted_id' => $notificationId,

            'was_unread' => $wasUnread,

            'unread_count' => $unreadCount,
        ]);
    }
}
