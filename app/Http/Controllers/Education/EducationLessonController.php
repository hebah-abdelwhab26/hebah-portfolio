<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\EducationLesson;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EducationLessonController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    | عرض قائمة الدروس في لوحة التحكم
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = EducationLesson::query();


        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = trim($request->search);

            $query->where(function ($q) use ($search) {

                $q->where(
                    'title',
                    'like',
                    "%{$search}%"
                )

                ->orWhere(
                    'category',
                    'like',
                    "%{$search}%"
                )

                ->orWhere(
                    'description',
                    'like',
                    "%{$search}%"
                );

            });
        }


        /*
        |--------------------------------------------------------------------------
        | STATUS
        |--------------------------------------------------------------------------
        */

        if ($request->status === 'active') {

            $query->where(
                'is_active',
                true
            );

        } elseif ($request->status === 'inactive') {

            $query->where(
                'is_active',
                false
            );
        }


        /*
        |--------------------------------------------------------------------------
        | CATEGORY
        |--------------------------------------------------------------------------
        */

        if ($request->filled('category')) {

            $query->where(
                'category',
                $request->category
            );
        }


        /*
        |--------------------------------------------------------------------------
        | SORT
        |--------------------------------------------------------------------------
        */

        switch ($request->sort) {

            case 'oldest':

                $query->orderBy(
                    'created_at',
                    'asc'
                );

                break;


            case 'title_asc':

                $query->orderBy(
                    'title',
                    'asc'
                );

                break;


            case 'title_desc':

                $query->orderBy(
                    'title',
                    'desc'
                );

                break;


            case 'price_low':

                $query->orderBy(
                    'price',
                    'asc'
                );

                break;


            case 'price_high':

                $query->orderBy(
                    'price',
                    'desc'
                );

                break;


            case 'duration_short':

                $query->orderBy(
                    'duration',
                    'asc'
                );

                break;


            case 'duration_long':

                $query->orderBy(
                    'duration',
                    'desc'
                );

                break;


            case 'sort_order':

                $query->orderBy(
                    'sort_order',
                    'asc'
                );

                $query->orderBy(
                    'created_at',
                    'desc'
                );

                break;


            default:

                $query->orderBy(
                    'created_at',
                    'desc'
                );

                break;
        }


        /*
        |--------------------------------------------------------------------------
        | STATISTICS
        |--------------------------------------------------------------------------
        */

        $totalLessons = EducationLesson::query()
            ->count();


        $activeLessons = EducationLesson::query()
            ->where(
                'is_active',
                true
            )
            ->count();


        $inactiveLessons = EducationLesson::query()
            ->where(
                'is_active',
                false
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | CATEGORIES
        |--------------------------------------------------------------------------
        */

        $categories = EducationLesson::query()
            ->whereNotNull('category')
            ->where(
                'category',
                '!=',
                ''
            )
            ->distinct()
            ->orderBy(
                'category',
                'asc'
            )
            ->pluck('category');


        /*
        |--------------------------------------------------------------------------
        | LESSONS
        |--------------------------------------------------------------------------
        */

        $lessons = $query
            ->paginate(15)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'education.admin.lessons.index',
            compact(
                'lessons',
                'totalLessons',
                'activeLessons',
                'inactiveLessons',
                'categories'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | FRONT INDEX
    |--------------------------------------------------------------------------
    | عرض الدروس في الواجهة الأمامية
    |--------------------------------------------------------------------------
    |
    | مثال:
    | /education/lessons
    | /education/lessons?category=القرآن الكريم
    |
    */

    public function frontIndex(Request $request)
    {
        $query = EducationLesson::query()
            ->where(
                'is_active',
                true
            );


        /*
        |--------------------------------------------------------------------------
        | CATEGORY
        |--------------------------------------------------------------------------
        */

        if ($request->filled('category')) {

            $query->where(
                'category',
                $request->category
            );
        }


        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = trim(
                $request->search
            );

            $query->where(function ($q) use ($search) {

                $q->where(
                    'title',
                    'like',
                    "%{$search}%"
                )

                ->orWhere(
                    'description',
                    'like',
                    "%{$search}%"
                );

            });
        }


        /*
        |--------------------------------------------------------------------------
        | ORDER
        |--------------------------------------------------------------------------
        */

        $lessons = $query
            ->orderBy(
                'sort_order',
                'asc'
            )
            ->orderBy(
                'created_at',
                'desc'
            )
            ->paginate(12)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | CATEGORIES
        |--------------------------------------------------------------------------
        */

        $categories = EducationLesson::query()
            ->where(
                'is_active',
                true
            )
            ->whereNotNull('category')
            ->where(
                'category',
                '!=',
                ''
            )
            ->distinct()
            ->orderBy(
                'category',
                'asc'
            )
            ->pluck('category');


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'education.front.lessons.index',
            compact(
                'lessons',
                'categories'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | FRONT SHOW
    |--------------------------------------------------------------------------
    | عرض درس واحد في الواجهة الأمامية
    |--------------------------------------------------------------------------
    |
    | يعرض:
    | - بيانات الدرس
    | - محتويات الدرس
    | - النصوص
    | - الصور
    | - الروابط
    | - الملفات
    |
    */

    public function frontShow(
        EducationLesson $lesson
    ) {

        /*
        |--------------------------------------------------------------------------
        | ACTIVE LESSON ONLY
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $lesson->is_active,
            404
        );


        /*
        |--------------------------------------------------------------------------
        | LOAD CONTENTS
        |--------------------------------------------------------------------------
        |
        | نعرض فقط المحتويات المفعّلة.
        |
        */

        $lesson->load([
            'contents' => function ($query) {

                $query
                    ->where(
                        'is_active',
                        true
                    )
                    ->orderBy(
                        'sort_order',
                        'asc'
                    )
                    ->orderBy(
                        'id',
                        'asc'
                    );

            }
        ]);


        /*
        |--------------------------------------------------------------------------
        | RELATED LESSONS
        |--------------------------------------------------------------------------
        |
        | دروس أخرى من نفس القسم.
        |
        */

        $relatedLessons = EducationLesson::query()
            ->where(
                'is_active',
                true
            )
            ->where(
                'id',
                '!=',
                $lesson->id
            )
            ->when(
                $lesson->category,
                function ($query) use ($lesson) {

                    $query->where(
                        'category',
                        $lesson->category
                    );

                }
            )
            ->orderBy(
                'sort_order',
                'asc'
            )
            ->orderBy(
                'created_at',
                'desc'
            )
            ->limit(4)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'education.front.lessons.show',
            compact(
                'lesson',
                'relatedLessons'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    | صفحة إضافة درس
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view(
            'education.admin.lessons.create'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    | حفظ درس جديد
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'category' => [
                'nullable',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'duration' => [
                'required',
                'integer',
                'min:1',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'currency' => [
                'required',
                'string',
                'size:3',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | DEFAULT VALUES
        |--------------------------------------------------------------------------
        */

        $validated['slug'] =
            $this->generateUniqueSlug(
                $validated['title']
            );


        $validated['is_active'] =
            $request->boolean(
                'is_active',
                true
            );


        $validated['sort_order'] =
            $validated['sort_order'] ?? 0;


        $validated['currency'] =
            strtoupper(
                $validated['currency']
            );


        /*
        |--------------------------------------------------------------------------
        | CREATE
        |--------------------------------------------------------------------------
        */

        EducationLesson::create(
            $validated
        );


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'education.admin.lessons.index'
            )
            ->with(
                'success',
                'تمت إضافة الدرس بنجاح.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    | عرض تفاصيل الدرس
    |--------------------------------------------------------------------------
    */

    public function show(
        EducationLesson $lesson
    ) {

        /*
        |--------------------------------------------------------------------------
        | LOAD CONTENTS
        |--------------------------------------------------------------------------
        |
        | صفحة تفاصيل الدرس العام لا علاقة لها بالحجوزات.
        |
        */

        $lesson->load([
            'contents' => function ($query) {

                $query
                    ->orderBy(
                        'sort_order',
                        'asc'
                    )
                    ->orderBy(
                        'id',
                        'asc'
                    );

            }
        ]);


        return view(
            'education.admin.lessons.show',
            compact('lesson')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    | صفحة تعديل الدرس
    |--------------------------------------------------------------------------
    */

    public function edit(
        EducationLesson $lesson
    ) {

        return view(
            'education.admin.lessons.edit',
            compact('lesson')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    | تحديث الدرس
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        EducationLesson $lesson
    ) {

        $validated = $request->validate([

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'category' => [
                'nullable',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'duration' => [
                'required',
                'integer',
                'min:1',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'currency' => [
                'required',
                'string',
                'size:3',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | SLUG
        |--------------------------------------------------------------------------
        |
        | إذا تغير عنوان الدرس نعيد إنشاء الـ slug.
        |
        */

        if (
            $lesson->title !== $validated['title']
        ) {

            $validated['slug'] =
                $this->generateUniqueSlug(
                    $validated['title'],
                    $lesson->id
                );
        }


        /*
        |--------------------------------------------------------------------------
        | BOOLEAN VALUES
        |--------------------------------------------------------------------------
        */

        $validated['is_active'] =
            $request->boolean(
                'is_active'
            );


        $validated['sort_order'] =
            $validated['sort_order'] ?? 0;


        $validated['currency'] =
            strtoupper(
                $validated['currency']
            );


        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $lesson->update(
            $validated
        );


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'education.admin.lessons.show',
                $lesson
            )
            ->with(
                'success',
                'تم تحديث بيانات الدرس بنجاح.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | TOGGLE STATUS
    |--------------------------------------------------------------------------
    | تفعيل / تعطيل الدرس
    |--------------------------------------------------------------------------
    */

    public function toggleStatus(
        EducationLesson $lesson
    ) {

        $lesson->update([

            'is_active' => ! $lesson->is_active,

        ]);


        return back()
            ->with(
                'success',
                $lesson->is_active
                    ? 'تم تفعيل الدرس بنجاح.'
                    : 'تم تعطيل الدرس بنجاح.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    | حذف الدرس
    |--------------------------------------------------------------------------
    |
    | الدرس الآن مستقل تمامًا عن الحجوزات.
    |
    */

    public function destroy(
        EducationLesson $lesson
    ) {

        /*
        |--------------------------------------------------------------------------
        | DELETE
        |--------------------------------------------------------------------------
        */

        $lesson->delete();


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'education.admin.lessons.index'
            )
            ->with(
                'success',
                'تم حذف الدرس بنجاح.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | GENERATE UNIQUE SLUG
    |--------------------------------------------------------------------------
    */

    private function generateUniqueSlug(
        string $title,
        ?int $ignoreId = null
    ): string {

        $baseSlug = Str::slug(
            $title
        );


        /*
        |--------------------------------------------------------------------------
        | FALLBACK
        |--------------------------------------------------------------------------
        |
        | في حالة كان العنوان عربيًا ولم ينتج Str::slug
        | slug مناسبًا، نستخدم قيمة فريدة.
        |
        */

        if (
            empty($baseSlug)
        ) {

            $baseSlug =
                'lesson-' .
                Str::lower(
                    Str::random(8)
                );
        }


        $slug = $baseSlug;

        $counter = 1;


        while (true) {

            $query = EducationLesson::query()
                ->where(
                    'slug',
                    $slug
                );


            if (
                $ignoreId !== null
            ) {

                $query->where(
                    'id',
                    '!=',
                    $ignoreId
                );
            }


            if (
                ! $query->exists()
            ) {

                break;
            }


            $slug =
                $baseSlug .
                '-' .
                $counter;

            $counter++;
        }


        return $slug;
    }
}
