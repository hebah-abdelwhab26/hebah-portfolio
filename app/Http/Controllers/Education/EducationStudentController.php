<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\EducationUser;
use Illuminate\Http\Request;

class EducationStudentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    | عرض قائمة الطلاب
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = EducationUser::query();


        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = trim($request->search);

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere(
                        'whatsapp_number',
                        'like',
                        "%{$search}%"
                    );

            });
        }


        /*
        |--------------------------------------------------------------------------
        | ACCOUNT STATUS
        |--------------------------------------------------------------------------
        */

        if ($request->status === 'active') {

            $query->where('is_active', true);

        } elseif ($request->status === 'inactive') {

            $query->where('is_active', false);

        }


        /*
        |--------------------------------------------------------------------------
        | STUDENT APPROVAL STATUS
        |--------------------------------------------------------------------------
        */

        if ($request->filled('student_status')) {

            $query->where(
                'student_status',
                $request->student_status
            );
        }


        /*
        |--------------------------------------------------------------------------
        | EDUCATION LEVEL
        |--------------------------------------------------------------------------
        */

        if ($request->filled('level')) {

            $query->where(
                'education_level',
                $request->level
            );

        } elseif ($request->filled('education_level')) {

            $query->where(
                'education_level',
                $request->education_level
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


            case 'name_asc':

                $query->orderBy(
                    'name',
                    'asc'
                );

                break;


            case 'name_desc':

                $query->orderBy(
                    'name',
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

        $totalStudents = EducationUser::query()
            ->count();


        $activeStudents = EducationUser::query()
            ->where('is_active', true)
            ->count();


        $inactiveStudents = EducationUser::query()
            ->where('is_active', false)
            ->count();


        $pendingStudents = EducationUser::query()
            ->where(
                'student_status',
                'pending'
            )
            ->count();


        $approvedStudents = EducationUser::query()
            ->where(
                'student_status',
                'approved'
            )
            ->count();


        $rejectedStudents = EducationUser::query()
            ->where(
                'student_status',
                'rejected'
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | STUDENTS WITH LEARNING GOALS
        |--------------------------------------------------------------------------
        */

        $studentsWithGoals = EducationUser::query()
            ->whereNotNull('learning_goal')
            ->where(
                'learning_goal',
                '!=',
                ''
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | BOOKINGS
        |--------------------------------------------------------------------------
        */

        $totalBookings = EducationUser::query()
            ->withCount('bookings')
            ->get()
            ->sum('bookings_count');


        /*
        |--------------------------------------------------------------------------
        | EDUCATION LEVELS
        |--------------------------------------------------------------------------
        */

        $educationLevels = EducationUser::query()
            ->whereNotNull('education_level')
            ->where(
                'education_level',
                '!=',
                ''
            )
            ->distinct()
            ->orderBy(
                'education_level',
                'asc'
            )
            ->pluck('education_level');


        /*
        |--------------------------------------------------------------------------
        | STUDENTS
        |--------------------------------------------------------------------------
        */

        $students = $query
            ->paginate(15)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'education.admin.students.index',
            compact(
                'students',
                'totalStudents',
                'activeStudents',
                'inactiveStudents',
                'pendingStudents',
                'approvedStudents',
                'rejectedStudents',
                'studentsWithGoals',
                'totalBookings',
                'educationLevels'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    | صفحة إضافة طالب
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view(
            'education.admin.students.create'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    | حفظ طالب جديد من لوحة الإدارة
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
                'unique:education_users,email',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'whatsapp_number' => [
                'nullable',
                'string',
                'max:30',
            ],

            'whatsapp_reminders_enabled' => [
                'nullable',
                'boolean',
            ],

            'education_level' => [
                'nullable',
                'string',
                'max:255',
            ],

            'learning_goal' => [
                'nullable',
                'string',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | BOOLEAN VALUES
        |--------------------------------------------------------------------------
        */

        $validated['is_active'] =
            $request->boolean(
                'is_active',
                true
            );


        $validated['whatsapp_reminders_enabled'] =
            $request->boolean(
                'whatsapp_reminders_enabled',
                false
            );


        /*
        |--------------------------------------------------------------------------
        | ADMIN CREATED STUDENT
        |--------------------------------------------------------------------------
        |
        | أي طالب يتم إنشاؤه مباشرة من لوحة الإدارة
        | يعتبر معتمدًا تلقائيًا.
        |
        */

        $validated['student_status'] = 'approved';


        /*
        |--------------------------------------------------------------------------
        | CREATE STUDENT
        |--------------------------------------------------------------------------
        |
        | EducationUser يحتوي على:
        |
        | 'password' => 'hashed'
        |
        | لذلك Laravel سيقوم بتشفير كلمة المرور
        | تلقائيًا عند إنشاء النموذج.
        |
        */

        $student = EducationUser::create(
            $validated
        );


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'education.admin.students.show',
                $student
            )
            ->with(
                'success',
                'تمت إضافة الطالب بنجاح.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    | عرض بيانات الطالب
    |--------------------------------------------------------------------------
    */

    public function show(EducationUser $student)
    {
        /*
        |--------------------------------------------------------------------------
        | LOAD RELATIONS
        |--------------------------------------------------------------------------
        */

        $student->load([
            'bookings' => function ($query) {

                $query->latest();

            }
        ]);


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'education.admin.students.show',
            compact('student')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    | صفحة تعديل الطالب
    |--------------------------------------------------------------------------
    */

    public function edit(EducationUser $student)
    {
        return view(
            'education.admin.students.edit',
            compact('student')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    | تحديث بيانات الطالب
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        EducationUser $student
    ) {

        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
                'unique:education_users,email,' . $student->id,
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'whatsapp_number' => [
                'nullable',
                'string',
                'max:30',
            ],

            'whatsapp_reminders_enabled' => [
                'nullable',
                'boolean',
            ],

            'education_level' => [
                'nullable',
                'string',
                'max:255',
            ],

            'learning_goal' => [
                'nullable',
                'string',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

            'student_status' => [
                'nullable',
                'in:pending,approved,rejected',
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | BOOLEAN VALUES
        |--------------------------------------------------------------------------
        */

        $validated['is_active'] =
            $request->boolean(
                'is_active'
            );


        $validated['whatsapp_reminders_enabled'] =
            $request->boolean(
                'whatsapp_reminders_enabled'
            );


        /*
        |--------------------------------------------------------------------------
        | STUDENT STATUS
        |--------------------------------------------------------------------------
        */

        if (
            ! array_key_exists(
                'student_status',
                $validated
            )
        ) {

            unset(
                $validated['student_status']
            );
        }


        /*
        |--------------------------------------------------------------------------
        | PASSWORD
        |--------------------------------------------------------------------------
        |
        | إذا لم يتم إدخال كلمة مرور جديدة،
        | نحافظ على كلمة المرور الحالية.
        |
        */

        if (
            empty(
                $validated['password']
                ?? null
            )
        ) {

            unset(
                $validated['password']
            );
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $student->update(
            $validated
        );


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'education.admin.students.show',
                $student
            )
            ->with(
                'success',
                'تم تحديث بيانات الطالب بنجاح.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | TOGGLE STATUS
    |--------------------------------------------------------------------------
    | تفعيل / تعطيل الحساب
    |--------------------------------------------------------------------------
    */

    public function toggleStatus(
        EducationUser $student
    ) {

        $student->update([

            'is_active' => ! $student->is_active,

        ]);


        return back()
            ->with(
                'success',
                $student->is_active
                    ? 'تم تفعيل حساب الطالب بنجاح.'
                    : 'تم تعطيل حساب الطالب بنجاح.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    | حذف الطالب
    |--------------------------------------------------------------------------
    */

    public function destroy(
        EducationUser $student
    ) {

        $student->delete();


        return redirect()
            ->route(
                'education.admin.students.index'
            )
            ->with(
                'success',
                'تم حذف الطالب بنجاح.'
            );
    }
}
