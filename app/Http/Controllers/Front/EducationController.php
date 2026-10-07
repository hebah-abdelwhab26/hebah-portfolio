<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\EducationAvailability;
use App\Models\EducationComment;
use App\Models\EducationLesson;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
{
    /**
     * =========================================================
     * EDUCATION HOME PAGE
     * =========================================================
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | AUTHENTICATED EDUCATION USER
        |--------------------------------------------------------------------------
        */

        $educationUser = Auth::guard('education')->user();


        /*
        |--------------------------------------------------------------------------
        | APPROVED STUDENT AVAILABILITIES
        |--------------------------------------------------------------------------
        |
        | المواعيد تظهر فقط للطالب المعتمد.
        |
        */

        $availabilities = collect();

        if (
            $educationUser &&
            $educationUser->isStudentApproved()
        ) {
            $availabilities = EducationAvailability::query()
                ->where('is_active', true)
                ->orderBy('day_of_week')
                ->orderBy('sort_order')
                ->orderBy('start_time')
                ->get();
        }


        /*
        |--------------------------------------------------------------------------
        | APPROVED PUBLIC COMMENTS
        |--------------------------------------------------------------------------
        */

        $comments = EducationComment::query()
            ->where('status', 'approved')
            ->latest()
            ->take(12)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | EDUCATION RESOURCES
        |--------------------------------------------------------------------------
        |
        | جلب الدروس النشطة من قاعدة البيانات.
        |
        | هذه الدروس هي التي تظهر في قسم:
        | "موارد تعليمية"
        |
        | ولا نقوم بجلب الدروس غير النشطة.
        |
        */

        $lessons = EducationLesson::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | GROUP LESSONS BY CATEGORY
        |--------------------------------------------------------------------------
        |
        | التصنيفات المستخدمة في قسم الموارد:
        |
        | quran
        | tajweed
        | arabic
        | videos
        | materials
        |
        */

        $lessonsByCategory = collect([
            'quran' => collect(),
            'tajweed' => collect(),
            'arabic' => collect(),
            'videos' => collect(),
            'materials' => collect(),
        ]);


        foreach ($lessons as $lesson) {

            $category = strtolower(
                trim((string) $lesson->category)
            );


            /*
            |--------------------------------------------------------------------------
            | CATEGORY ALIASES
            |--------------------------------------------------------------------------
            |
            | في حال كانت بعض البيانات القديمة تستخدم أسماء مختلفة
            | نحولها إلى التصنيف الأساسي المستخدم في الموارد.
            |
            */

            $category = match ($category) {

                'quran',
                'القرآن',
                'القرآن الكريم',
                'قرآن',
                'قران' => 'quran',

                'tajweed',
                'تجويد',
                'التجويد' => 'tajweed',

                'arabic',
                'عربي',
                'العربية',
                'اللغة العربية' => 'arabic',

                'videos',
                'video',
                'فيديو',
                'فيديوهات',
                'الفيديوهات' => 'videos',

                'materials',
                'material',
                'مواد',
                'مواد تعليمية',
                'الملفات',
                'ملفات' => 'materials',

                default => null,
            };


            /*
            |--------------------------------------------------------------------------
            | ADD LESSON TO CATEGORY
            |--------------------------------------------------------------------------
            */

            if ($category !== null) {

                $lessonsByCategory[$category]->push($lesson);

            }
        }


        /*
        |--------------------------------------------------------------------------
        | EDUCATION HOME VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'education.index',
            compact(
                'comments',
                'availabilities',
                'lessonsByCategory'
            )
        );
    }


    /**
     * =========================================================
     * PUBLIC LESSON
     * =========================================================
     */
    public function lesson(string $lesson)
    {
        /*
        |--------------------------------------------------------------------------
        | FIND ACTIVE LESSON
        |--------------------------------------------------------------------------
        */

        $educationLesson = EducationLesson::query()
            ->where('is_active', true)
            ->where(function ($query) use ($lesson) {

                $query
                    ->where('slug', $lesson)
                    ->orWhere('id', $lesson);

            })
            ->with([

                /*
                |--------------------------------------------------------------------------
                | ACTIVE CONTENTS
                |--------------------------------------------------------------------------
                */

                'contents' => function ($query) {

                    $query
                        ->where('is_active', true)
                        ->orderBy('sort_order')
                        ->orderBy('id');

                },


                /*
                |--------------------------------------------------------------------------
                | ACTIVE QUIZZES
                |--------------------------------------------------------------------------
                */

                'quizzes' => function ($query) {

                    $query
                        ->where('is_active', true)
                        ->orderBy('sort_order')
                        ->orderBy('id');

                },


                /*
                |--------------------------------------------------------------------------
                | QUIZ QUESTIONS
                |--------------------------------------------------------------------------
                */

                'quizzes.questions' => function ($query) {

                    $query
                        ->where('is_active', true)
                        ->orderBy('sort_order')
                        ->orderBy('id');

                },


                /*
                |--------------------------------------------------------------------------
                | QUIZ OPTIONS
                |--------------------------------------------------------------------------
                */

                'quizzes.questions.options' => function ($query) {

                    $query
                        ->where('is_active', true)
                        ->orderBy('sort_order')
                        ->orderBy('id');

                },

            ])
            ->first();


        /*
        |--------------------------------------------------------------------------
        | LESSON NOT FOUND
        |--------------------------------------------------------------------------
        */

        abort_unless($educationLesson, 404);


        /*
        |--------------------------------------------------------------------------
        | LESSON DATA
        |--------------------------------------------------------------------------
        */

        $contents = $educationLesson->contents;

        $activeQuizzes = $educationLesson->quizzes;


        /*
        |--------------------------------------------------------------------------
        | QUIZ STATISTICS
        |--------------------------------------------------------------------------
        */

        $quizStatistics = [
            'total' => $activeQuizzes->count(),

            'questions' => $activeQuizzes->sum(
                fn ($quiz) => $quiz->questions->count()
            ),
        ];


        /*
        |--------------------------------------------------------------------------
        | LESSON VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'education.lessons.show',
            compact(
                'educationLesson',
                'contents',
                'activeQuizzes',
                'quizStatistics'
            )
        );
    }
}
