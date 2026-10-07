<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\EducationLesson;
use Illuminate\Http\Request;

class EducationResourceController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    | عرض جميع الدروس التعليمية النشطة
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $lessons = EducationLesson::query()
            ->where('is_active', true)

            ->with([
                /*
                |--------------------------------------------------------------
                | GENERAL LESSON CONTENT
                |--------------------------------------------------------------
                */

                'contents' => function ($query) {

                    $query->where('is_active', true)
                        ->orderBy('sort_order')
                        ->orderBy('id');
                },


                /*
                |--------------------------------------------------------------
                | GENERAL LESSON QUIZZES
                |--------------------------------------------------------------
                |
                | نحمّل الاختبارات العامة النشطة فقط.
                |
                | لا نحمّل اختبارات الطلاب.
                |
                */

                'quizzes' => function ($query) {

                    $query->where('is_active', true)
                        ->withCount('questions')
                        ->orderBy('sort_order')
                        ->orderBy('id');
                },
            ])

            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | GROUP BY CATEGORY
        |--------------------------------------------------------------------------
        */

        $lessonsByCategory = $lessons->groupBy(function ($lesson) {

            return $this->normalizeCategory(
                $lesson->category
            );
        });


        return view(
            'education.resources.index',
            compact(
                'lessons',
                'lessonsByCategory'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CATEGORY
    |--------------------------------------------------------------------------
    | عرض دروس تصنيف معين
    |--------------------------------------------------------------------------
    */

    public function category(string $category)
    {
        $category = $this->normalizeCategory(
            $category
        );


        $lessons = EducationLesson::query()
            ->where('is_active', true)

            ->where(function ($query) use ($category) {

                $query->where(
                    'category',
                    $category
                );


                /*
                | دعم بعض الأسماء القديمة
                */

                if ($category === 'quran') {

                    $query->orWhere(
                        'category',
                        'القرآن الكريم'
                    );
                }


                if ($category === 'tajweed') {

                    $query->orWhere(
                        'category',
                        'التجويد'
                    );
                }


                if ($category === 'arabic') {

                    $query->orWhere(
                        'category',
                        'اللغة العربية'
                    );
                }


                if ($category === 'videos') {

                    $query->orWhere(
                        'category',
                        'فيديوهات'
                    );
                }


                if ($category === 'materials') {

                    $query->orWhere(
                        'category',
                        'مواد تعليمية'
                    );
                }
            })

            ->with([

                /*
                |--------------------------------------------------------------
                | CONTENT
                |--------------------------------------------------------------
                */

                'contents' => function ($query) {

                    $query->where(
                        'is_active',
                        true
                    )
                        ->orderBy('sort_order')
                        ->orderBy('id');
                },


                /*
                |--------------------------------------------------------------
                | GENERAL QUIZZES
                |--------------------------------------------------------------
                */

                'quizzes' => function ($query) {

                    $query->where(
                        'is_active',
                        true
                    )
                        ->withCount('questions')
                        ->orderBy('sort_order')
                        ->orderBy('id');
                },

            ])

            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | CATEGORY INFORMATION
        |--------------------------------------------------------------------------
        */

        $categoryData =
            $this->getCategoryData(
                $category
            );


        return view(
            'education.resources.category',
            compact(
                'lessons',
                'category',
                'categoryData'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | LESSON
    |--------------------------------------------------------------------------
    | عرض درس واحد مع محتواه واختباراته العامة
    |--------------------------------------------------------------------------
    */

    public function lesson(
        EducationLesson $lesson
    ) {

        /*
        |--------------------------------------------------------------------------
        | ONLY ACTIVE LESSONS
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $lesson->is_active,
            404
        );


        /*
        |--------------------------------------------------------------------------
        | LOAD ACTIVE CONTENT + GENERAL QUIZZES
        |--------------------------------------------------------------------------
        */

        $lesson->load([

            /*
            |--------------------------------------------------------------
            | CONTENT
            |--------------------------------------------------------------
            */

            'contents' => function ($query) {

                $query->where(
                    'is_active',
                    true
                )
                    ->orderBy('sort_order')
                    ->orderBy('id');
            },


            /*
            |--------------------------------------------------------------
            | GENERAL QUIZZES
            |--------------------------------------------------------------
            */

            'quizzes' => function ($query) {

                $query->where(
                    'is_active',
                    true
                )
                    ->withCount('questions')
                    ->orderBy('sort_order')
                    ->orderBy('id');
            },

        ]);


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'education.resources.lesson',
            compact('lesson')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | NORMALIZE CATEGORY
    |--------------------------------------------------------------------------
    */

    private function normalizeCategory(
        ?string $category
    ): string {

        if (!$category) {

            return 'other';
        }


        $value = mb_strtolower(
            trim($category)
        );


        /*
        |--------------------------------------------------------------------------
        | QURAN
        |--------------------------------------------------------------------------
        */

        if (
            in_array(
                $value,
                [
                    'quran',
                    'قرآن',
                    'القرآن',
                    'القرآن الكريم',
                ],
                true
            )
        ) {

            return 'quran';
        }


        /*
        |--------------------------------------------------------------------------
        | TAJWEED
        |--------------------------------------------------------------------------
        */

        if (
            in_array(
                $value,
                [
                    'tajweed',
                    'تجويد',
                    'التجويد',
                ],
                true
            )
        ) {

            return 'tajweed';
        }


        /*
        |--------------------------------------------------------------------------
        | ARABIC
        |--------------------------------------------------------------------------
        */

        if (
            in_array(
                $value,
                [
                    'arabic',
                    'عربي',
                    'العربية',
                    'اللغة العربية',
                ],
                true
            )
        ) {

            return 'arabic';
        }


        /*
        |--------------------------------------------------------------------------
        | VIDEOS
        |--------------------------------------------------------------------------
        */

        if (
            in_array(
                $value,
                [
                    'video',
                    'videos',
                    'فيديو',
                    'فيديوهات',
                    'الفيديوهات',
                ],
                true
            )
        ) {

            return 'videos';
        }


        /*
        |--------------------------------------------------------------------------
        | MATERIALS
        |--------------------------------------------------------------------------
        */

        if (
            in_array(
                $value,
                [
                    'material',
                    'materials',
                    'مواد',
                    'مواد تعليمية',
                    'ملفات',
                ],
                true
            )
        ) {

            return 'materials';
        }


        return 'other';
    }


    /*
    |--------------------------------------------------------------------------
    | CATEGORY DATA
    |--------------------------------------------------------------------------
    */

    private function getCategoryData(
        string $category
    ): array {

        return match ($category) {

            'quran' => [
                'name' => 'القرآن الكريم',
                'title' => 'دروس القرآن الكريم',
                'description' =>
                    'دروس ومواد تساعدك على تحسين القراءة والتلاوة والتقدم بثبات.',
                'icon' => 'fa-solid fa-book-quran',
            ],

            'tajweed' => [
                'name' => 'التجويد',
                'title' => 'دروس التجويد',
                'description' =>
                    'مواد مبسطة تساعدك على فهم أحكام التجويد وتطبيقها أثناء التلاوة.',
                'icon' => 'fa-solid fa-microphone-lines',
            ],

            'arabic' => [
                'name' => 'اللغة العربية',
                'title' => 'تعلم اللغة العربية',
                'description' =>
                    'دروس ومواد عملية تساعدك على تطوير القراءة والكتابة والمفردات.',
                'icon' => 'fa-solid fa-language',
            ],

            'videos' => [
                'name' => 'فيديوهات',
                'title' => 'فيديوهات تعليمية',
                'description' =>
                    'محتوى مرئي مختصر يمكنك متابعته والاستفادة منه في أي وقت.',
                'icon' => 'fa-solid fa-circle-play',
            ],

            'materials' => [
                'name' => 'مواد تعليمية',
                'title' => 'ملفات ومواد مساعدة',
                'description' =>
                    'ملفات وملخصات ومواد مساعدة يمكن الرجوع إليها أثناء التعلم.',
                'icon' => 'fa-solid fa-file-lines',
            ],

            default => [
                'name' => 'موارد تعليمية',
                'title' => 'الموارد التعليمية',
                'description' =>
                    'مجموعة من الدروس والمواد التعليمية المتاحة للتعلم والمراجعة.',
                'icon' => 'fa-solid fa-book-open',
            ],
        };
    }
}
