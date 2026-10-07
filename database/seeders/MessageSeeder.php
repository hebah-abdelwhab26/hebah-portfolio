<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
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
        | New Messages
        |--------------------------------------------------------------------------
        */

        Message::create([
            'user_id' => $user?->id,

            'name' => 'Ahmed Mohammed',

            'email' => 'ahmed@example.com',

            'phone' => '+966500000001',

            'subject' => 'Website Development',

            'message' =>
                'Hello, I would like to discuss building a professional website for my business.',

            'status' => 'new',

            'is_read' => false,

            'read_at' => null,

            'replied_at' => null,
        ]);


        Message::create([
            'user_id' => null,

            'name' => 'Sara Khaled',

            'email' => 'sara@example.com',

            'phone' => '+966500000002',

            'subject' => 'Portfolio Project',

            'message' =>
                'I am interested in creating a personal portfolio website. Please let me know about your services.',

            'status' => 'new',

            'is_read' => false,

            'read_at' => null,

            'replied_at' => null,
        ]);


        /*
        |--------------------------------------------------------------------------
        | Read Message
        |--------------------------------------------------------------------------
        */

        Message::create([
            'user_id' => null,

            'name' => 'Omar Hassan',

            'email' => 'omar@example.com',

            'phone' => '+966500000003',

            'subject' => 'Project Inquiry',

            'message' =>
                'I would like to ask about the technologies you use for your projects.',

            'status' => 'read',

            'is_read' => true,

            'read_at' => now()->subHours(5),

            'replied_at' => null,
        ]);


        /*
        |--------------------------------------------------------------------------
        | Replied Message
        |--------------------------------------------------------------------------
        */

        Message::create([
            'user_id' => null,

            'name' => 'Maha Ibrahim',

            'email' => 'maha@example.com',

            'phone' => '+966500000004',

            'subject' => 'Web Development Services',

            'message' =>
                'I would like to know more about your Laravel and React development services.',

            'status' => 'replied',

            'is_read' => true,

            'read_at' => now()->subDay(),

            'replied_at' => now()->subHours(8),
        ]);


        /*
        |--------------------------------------------------------------------------
        | Archived Message
        |--------------------------------------------------------------------------
        */

        Message::create([
            'user_id' => null,

            'name' => 'Yousef Ali',

            'email' => 'yousef@example.com',

            'phone' => null,

            'subject' => 'General Inquiry',

            'message' =>
                'This is a sample archived message for testing the administration panel.',

            'status' => 'archived',

            'is_read' => true,

            'read_at' => now()->subDays(3),

            'replied_at' => null,
        ]);
    }
}
