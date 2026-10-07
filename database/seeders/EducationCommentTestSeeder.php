<?php

namespace Database\Seeders;

use App\Models\EducationComment;
use Illuminate\Database\Seeder;

class EducationCommentTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | DELETE OLD TEST COMMENTS
        |--------------------------------------------------------------------------
        |
        | حذف التعليقات التجريبية السابقة حتى لا تتكرر عند إعادة تشغيل Seeder.
        |
        */

        EducationComment::query()
            ->where('email', 'like', 'test-comment-%@example.com')
            ->delete();


        /*
        |--------------------------------------------------------------------------
        | APPROVED COMMENTS
        |--------------------------------------------------------------------------
        */

        $comments = [

            [
                'name' => 'سارة أحمد',
                'email' => 'test-comment-1@example.com',
                'comment' => 'تجربة جميلة ومفيدة جدًا، أسلوب الشرح واضح وسهل الفهم، جزاكِ الله خيرًا.',
                'status' => 'approved',
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Test Seeder',
            ],

            [
                'name' => 'محمد عبدالله',
                'email' => 'test-comment-2@example.com',
                'comment' => 'استفدت كثيرًا من الدروس، والتنظيم ممتاز والطريقة مريحة جدًا للطالب.',
                'status' => 'approved',
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Test Seeder',
            ],

            [
                'name' => 'نورة خالد',
                'email' => 'test-comment-3@example.com',
                'comment' => 'من أفضل التجارب التعليمية التي خضتها، الشرح هادئ وواضح ويشجع على الاستمرار.',
                'status' => 'approved',
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Test Seeder',
            ],

            [
                'name' => 'عبدالرحمن علي',
                'email' => 'test-comment-4@example.com',
                'comment' => 'الدروس مرتبة بشكل جميل، والمحتوى مناسب جدًا لمن يريد تطوير مستواه في اللغة العربية.',
                'status' => 'approved',
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Test Seeder',
            ],

            [
                'name' => 'ريم محمد',
                'email' => 'test-comment-5@example.com',
                'comment' => 'شكرًا على هذا المحتوى الرائع، أتمنى إضافة المزيد من الدروس والموارد التعليمية.',
                'status' => 'approved',
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Test Seeder',
            ],

            [
                'name' => 'يوسف إبراهيم',
                'email' => 'test-comment-6@example.com',
                'comment' => 'الواجهة جميلة جدًا والمحتوى منظم، تجربة استخدام مميزة وسهلة.',
                'status' => 'approved',
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Test Seeder',
            ],

            [
                'name' => 'هند مصطفى',
                'email' => 'test-comment-7@example.com',
                'comment' => 'أعجبني أسلوب عرض الدروس، وأشعر أن التعلم أصبح أكثر سهولة وتنظيمًا.',
                'status' => 'approved',
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Test Seeder',
            ],

            [
                'name' => 'عمر حسن',
                'email' => 'test-comment-8@example.com',
                'comment' => 'محتوى ممتاز وطريقة شرح بسيطة ومباشرة. بارك الله في جهودكم.',
                'status' => 'approved',
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Test Seeder',
            ],


            /*
            |--------------------------------------------------------------------------
            | PENDING COMMENT
            |--------------------------------------------------------------------------
            |
            | هذا التعليق للتأكد من أنه لا يظهر في الصفحة العامة.
            |
            */

            [
                'name' => 'تعليق قيد المراجعة',
                'email' => 'test-comment-9@example.com',
                'comment' => 'هذا تعليق تجريبي يجب أن يبقى مخفيًا حتى تتم الموافقة عليه من الإدارة.',
                'status' => 'pending',
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Test Seeder',
            ],


            /*
            |--------------------------------------------------------------------------
            | REJECTED COMMENT
            |--------------------------------------------------------------------------
            |
            | هذا التعليق للتأكد من أنه لا يظهر في الصفحة العامة.
            |
            */

            [
                'name' => 'تعليق مرفوض',
                'email' => 'test-comment-10@example.com',
                'comment' => 'هذا تعليق تجريبي مرفوض ويجب ألا يظهر للزوار.',
                'status' => 'rejected',
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Test Seeder',
            ],

        ];


        /*
        |--------------------------------------------------------------------------
        | INSERT COMMENTS
        |--------------------------------------------------------------------------
        */

        foreach ($comments as $comment) {

            EducationComment::create($comment);

        }


        /*
        |--------------------------------------------------------------------------
        | OUTPUT
        |--------------------------------------------------------------------------
        */

        $approvedCount = collect($comments)
            ->where('status', 'approved')
            ->count();

        $pendingCount = collect($comments)
            ->where('status', 'pending')
            ->count();

        $rejectedCount = collect($comments)
            ->where('status', 'rejected')
            ->count();


        $this->command?->info(
            "تم إنشاء بيانات التعليقات التجريبية بنجاح."
        );

        $this->command?->info(
            "التعليقات المعتمدة: {$approvedCount}"
        );

        $this->command?->info(
            "التعليقات قيد المراجعة: {$pendingCount}"
        );

        $this->command?->info(
            "التعليقات المرفوضة: {$rejectedCount}"
        );
    }
}
