<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\ConversationMessage;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Admin Counters
        |--------------------------------------------------------------------------
        */

        View::composer('admin.*', function ($view) {

            /*
            |--------------------------------------------------------------------------
            | Pending Comments
            |--------------------------------------------------------------------------
            */

            $pendingComments = Comment::where(
                'status',
                'pending'
            )->count();

            /*
            |--------------------------------------------------------------------------
            | New Messages
            |--------------------------------------------------------------------------
            */

            $newMessages = ConversationMessage::where(
                'sender_type',
                'user'
            )
                ->where(
                    'is_read',
                    false
                )
                ->count();

            /*
            |--------------------------------------------------------------------------
            | New Users
            |--------------------------------------------------------------------------
            */

            $usersSeenAt = session(
                'users_notification_seen_at'
            );

            if ($usersSeenAt) {

                $newUsers = User::where(
                    'created_at',
                    '>',
                    $usersSeenAt
                )->count();

            } else {

                $newUsers = 0;
            }

            /*
            |--------------------------------------------------------------------------
            | Share With Admin Views
            |--------------------------------------------------------------------------
            */

            $view->with([

                'pendingComments' => $pendingComments,

                'newMessages' => $newMessages,

                'newUsers' => $newUsers,

            ]);
        });


        /*
        |--------------------------------------------------------------------------
        | Front User Notifications
        |--------------------------------------------------------------------------
        |
        | Make authenticated user's unread notifications available
        | to the frontend Navbar.
        |
        */

        View::composer('*', function ($view) {

            /*
            |--------------------------------------------------------------------------
            | Default Values
            |--------------------------------------------------------------------------
            */

            $userNotifications = collect();

            $userNotificationsCount = 0;

            $unreadMessagesCount = 0;


            /*
            |--------------------------------------------------------------------------
            | Authenticated User
            |--------------------------------------------------------------------------
            */

            if (auth()->check()) {

                $user = auth()->user();


                /*
                |--------------------------------------------------------------------------
                | Unread Database Notifications
                |--------------------------------------------------------------------------
                */

                $userNotifications = $user
                    ->unreadNotifications()
                    ->latest()
                    ->take(10)
                    ->get();


                $userNotificationsCount =
                    $userNotifications->count();


                /*
                |--------------------------------------------------------------------------
                | Unread Conversation Messages
                |--------------------------------------------------------------------------
                |
                | Only messages sent by admin are counted for the user.
                |
                */

                $unreadMessagesCount =
                    ConversationMessage::where(
                        'user_id',
                        $user->id
                    )
                        ->where(
                            'sender_type',
                            'admin'
                        )
                        ->where(
                            'is_read',
                            false
                        )
                        ->count();
            }


            /*
            |--------------------------------------------------------------------------
            | Share With Frontend
            |--------------------------------------------------------------------------
            */

            $view->with([

                'userNotifications' =>
                    $userNotifications,

                'userNotificationsCount' =>
                    $userNotificationsCount,

                'unreadMessagesCount' =>
                    $unreadMessagesCount,

            ]);
        });
    }
}
