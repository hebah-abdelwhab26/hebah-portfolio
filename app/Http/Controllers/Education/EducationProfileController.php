<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\EducationUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class EducationProfileController extends Controller
{
    /**
     * =========================================================
     * PROFILE PAGE
     * =========================================================
     */
    public function index(): View
    {
        /** @var EducationUser $student */
        $student = Auth::guard('education')->user();

        $stats = [
            'bookings' => $student->bookings()->count(),
            'lessons' => $student->lessonAssignments()->count(),
            'quizzes' => $student->quizAttempts()->count(),
            'conversations' => $student->conversations()->count(),
        ];

        return view('education.student.profile', compact(
            'student',
            'stats'
        ));
    }

    /**
     * =========================================================
     * UPDATE PROFILE
     * =========================================================
     */
    public function update(Request $request): RedirectResponse
    {
        /** @var EducationUser $student */
        $student = Auth::guard('education')->user();

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('education_users', 'email')
                    ->ignore($student->id),
            ],

            'phone' => [
                'nullable',
                'string',
                'max:50',
            ],

            'whatsapp_number' => [
                'nullable',
                'string',
                'max:50',
            ],

            'education_level' => [
                'nullable',
                'string',
                'max:255',
            ],

            'learning_goal' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'whatsapp_reminders_enabled' => [
                'nullable',
                'boolean',
            ],
        ]);

        $validated['whatsapp_reminders_enabled'] =
            $request->boolean('whatsapp_reminders_enabled');

        $student->update($validated);

        return back()->with(
            'profile_success',
            'تم تحديث بيانات حسابك بنجاح.'
        );
    }

    /**
     * =========================================================
     * UPDATE PASSWORD
     * =========================================================
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        /** @var EducationUser $student */
        $student = Auth::guard('education')->user();

        $validated = $request->validate([
            'current_password' => [
                'required',
                'string',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        if (!Hash::check(
            $validated['current_password'],
            $student->password
        )) {
            return back()
                ->withErrors([
                    'current_password' =>
                        'كلمة المرور الحالية غير صحيحة.',
                ])
                ->withInput();
        }

        $student->password = $validated['password'];
        $student->save();

        return back()->with(
            'password_success',
            'تم تغيير كلمة المرور بنجاح.'
        );
    }
}
