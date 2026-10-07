<?php

namespace Database\Seeders;

use App\Models\EducationLesson;
use App\Models\EducationLessonAssignment;
use App\Models\EducationLessonEvaluation;
use App\Models\EducationStudentLesson;
use App\Models\EducationStudentLessonContent;
use App\Models\EducationUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationStudentLessonTestSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            /*
            |--------------------------------------------------------------------------
            | GET EXISTING STUDENT
            |--------------------------------------------------------------------------
            */

            $student = EducationUser::query()
                ->where('is_active', true)
                ->orderBy('id')
                ->first();

            if (!$student) {
                $this->command->error(
                    'لا يوجد طالب نشط في education_users.'
                );

                return;
            }


            /*
            |--------------------------------------------------------------------------
            | GET EXISTING PUBLIC LESSON
            |--------------------------------------------------------------------------
            */

            $lesson = EducationLesson::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('id')
                ->first();

            if (!$lesson) {
                $this->command->error(
                    'لا يوجد درس عام نشط في education_lessons.'
                );

                return;
            }


            /*
            |--------------------------------------------------------------------------
            | CREATE ASSIGNMENT
            |--------------------------------------------------------------------------
            */

            $assignment = EducationLessonAssignment::create([

                'education_user_id' =>
                    $student->id,

                'education_lesson_id' =>
                    $lesson->id,

                'education_booking_id' =>
                    null,

                'status' =>
                    'assigned',

                'assigned_at' =>
                    now(),

                'started_at' =>
                    null,

                'completed_at' =>
                    null,

                'notes' =>
                    'إسناد تجريبي لاختبار نظام دروس الطالب.',

                'is_active' =>
                    true,

            ]);


            /*
            |--------------------------------------------------------------------------
            | CREATE STUDENT LESSON
            |--------------------------------------------------------------------------
            |
            | هذه هي النسخة الخاصة بالطالب.
            |
            | لا تعتمد في محتواها على محتوى الدرس العام.
            |
            */

            $studentLesson = EducationStudentLesson::create([

                'education_user_id' =>
                    $student->id,

                'education_lesson_assignment_id' =>
                    $assignment->id,

                'education_booking_id' =>
                    null,

                'source_lesson_id' =>
                    $lesson->id,

                'session_number' =>
                    1,

                'title' =>
                    $lesson->title . ' - حصة الطالب',

                'description' =>
                    'هذه نسخة خاصة بالطالب تم إنشاؤها للاختبار.',

                'status' =>
                    'assigned',

                'assigned_at' =>
                    now(),

                'started_at' =>
                    null,

                'completed_at' =>
                    null,

                'notes' =>
                    'ملاحظات خاصة بهذه الحصة.',

                'is_active' =>
                    true,

            ]);


            /*
            |--------------------------------------------------------------------------
            | STUDENT CONTENT #1
            |--------------------------------------------------------------------------
            */

            EducationStudentLessonContent::create([

                'education_student_lesson_id' =>
                    $studentLesson->id,

                'source_content_id' =>
                    null,

                'type' =>
                    'text',

                'title' =>
                    'ملاحظة خاصة بالطالب',

                'description' =>
                    'ملاحظة تعليمية خاصة بهذه الحصة.',

                'content' =>
                    'ركز في هذه الحصة على مراجعة الجزء الذي تم شرحه سابقًا والتدرب عليه بشكل جيد.',

                'url' =>
                    null,

                'file_path' =>
                    null,

                'file_name' =>
                    null,

                'mime_type' =>
                    null,

                'file_size' =>
                    null,

                'sort_order' =>
                    1,

                'is_active' =>
                    true,

            ]);


            /*
            |--------------------------------------------------------------------------
            | STUDENT CONTENT #2
            |--------------------------------------------------------------------------
            */

            EducationStudentLessonContent::create([

                'education_student_lesson_id' =>
                    $studentLesson->id,

                'source_content_id' =>
                    null,

                'type' =>
                    'link',

                'title' =>
                    'رابط تدريبي خاص',

                'description' =>
                    'رابط تجريبي مرتبط بهذه الحصة فقط.',

                'content' =>
                    null,

                'url' =>
                    'https://example.com',

                'file_path' =>
                    null,

                'file_name' =>
                    null,

                'mime_type' =>
                    null,

                'file_size' =>
                    null,

                'sort_order' =>
                    2,

                'is_active' =>
                    true,

            ]);


            /*
            |--------------------------------------------------------------------------
            | STUDENT CONTENT #3
            |--------------------------------------------------------------------------
            */

            EducationStudentLessonContent::create([

                'education_student_lesson_id' =>
                    $studentLesson->id,

                'source_content_id' =>
                    null,

                'type' =>
                    'text',

                'title' =>
                    'واجب الحصة',

                'description' =>
                    'التدريب المطلوب قبل الحصة القادمة.',

                'content' =>
                    'قم بمراجعة المادة المحددة وتسجيل الملاحظات التي واجهتك أثناء المراجعة.',

                'url' =>
                    null,

                'file_path' =>
                    null,

                'file_name' =>
                    null,

                'mime_type' =>
                    null,

                'file_size' =>
                    null,

                'sort_order' =>
                    3,

                'is_active' =>
                    true,

            ]);


            /*
            |--------------------------------------------------------------------------
            | EVALUATION
            |--------------------------------------------------------------------------
            */

            EducationLessonEvaluation::create([

                'education_student_lesson_id' =>
                    $studentLesson->id,

                'attendance_status' =>
                    'present',

                'understanding_score' =>
                    8,

                'performance_score' =>
                    9,

                'memorization_score' =>
                    8,

                'tajweed_score' =>
                    9,

                'score' =>
                    34,

                'max_score' =>
                    40,

                'teacher_notes' =>
                    'أداء جيد جدًا. يحتاج الطالب إلى مزيد من المراجعة والتدريب.',

                'student_feedback' =>
                    'استمر في المراجعة اليومية وستتحسن النتيجة أكثر.',

                'evaluated_at' =>
                    now(),

            ]);


            /*
            |--------------------------------------------------------------------------
            | OUTPUT
            |--------------------------------------------------------------------------
            */

            $this->command->info(
                'تم إنشاء البيانات التجريبية بنجاح.'
            );

            $this->command->info(
                'Student ID: ' . $student->id
            );

            $this->command->info(
                'Public Lesson ID: ' . $lesson->id
            );

            $this->command->info(
                'Assignment ID: ' . $assignment->id
            );

            $this->command->info(
                'Student Lesson ID: ' . $studentLesson->id
            );

        });
    }
}
