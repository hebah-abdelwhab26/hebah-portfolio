<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * ==========================================
     * Check User Notifications
     * ==========================================
     */
    public function check(Request $request): JsonResponse
    {
        /*
        |--------------------------------------------------------------------------
        | Current User
        |--------------------------------------------------------------------------
        */

        $user = $request->user();

        /*
        |--------------------------------------------------------------------------
        | Unread Notifications
        |--------------------------------------------------------------------------
        */

        $notifications = $user
            ->unreadNotifications()
            ->latest()
            ->take(10)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Format Notifications
        |--------------------------------------------------------------------------
        */

        $formattedNotifications = $notifications
            ->map(function ($notification) {

                $data = $notification->data ?? [];

                return [
                    'id' => $notification->id,

                    'type' => $notification->type,

                    'title' => $data['title']
                        ?? 'Notification',

                    'message' => $data['message']
                        ?? '',

                    'icon' => $data['icon']
                        ?? 'fa-bell',

                    'url' => $data['url']
                        ?? '#',

                    'conversation_id' =>
                        $data['conversation_id']
                        ?? null,

                    'created_at' =>
                        optional(
                            $notification->created_at
                        )->diffForHumans(),
                ];
            })
            ->values();

        /*
        |--------------------------------------------------------------------------
        | Response
        |--------------------------------------------------------------------------
        */

        return response()->json([
            'success' => true,

            'count' =>
                $user->unreadNotifications()->count(),

            'notifications' =>
                $formattedNotifications,
        ]);
    }
}
