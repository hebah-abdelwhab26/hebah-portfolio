<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Users
        |--------------------------------------------------------------------------
        */

        $user = User::where('role', 'user')->first();


        /*
        |--------------------------------------------------------------------------
        | Comments
        |--------------------------------------------------------------------------
        */

        Comment::create([
            'user_id' => $user?->id,

            'commentable_type' => null,
            'commentable_id' => null,

            'name' => 'Sarah Ahmed',

            'email' => 'sarah@example.com',

            'message' =>
                'Your portfolio looks amazing. I really like the clean design and the way the projects are presented.',

            'status' => 'pending',
        ]);


        Comment::create([
            'user_id' => null,

            'commentable_type' => null,
            'commentable_id' => null,

            'name' => 'Mohammed Ali',

            'email' => 'mohammed@example.com',

            'message' =>
                'The website has a very professional look. The project section is especially impressive.',

            'status' => 'approved',
        ]);


        Comment::create([
            'user_id' => null,

            'commentable_type' => null,
            'commentable_id' => null,

            'name' => 'Lina Hassan',

            'email' => 'lina@example.com',

            'message' =>
                'I enjoyed browsing the website. The navigation is simple and easy to use.',

            'status' => 'approved',
        ]);


        Comment::create([
            'user_id' => null,

            'commentable_type' => null,
            'commentable_id' => null,

            'name' => 'Omar Khaled',

            'email' => 'omar@example.com',

            'message' =>
                'This is a test rejected comment for the administration panel.',

            'status' => 'rejected',
        ]);


        Comment::create([
            'user_id' => null,

            'commentable_type' => null,
            'commentable_id' => null,

            'name' => 'Nora Ibrahim',

            'email' => 'nora@example.com',

            'message' =>
                'I would like to know more about the services you provide.',

            'status' => 'pending',
        ]);
    }
}
