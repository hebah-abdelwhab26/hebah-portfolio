<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EducationQuizAttempt;
use Illuminate\Http\Request;

class EducationQuizAttemptController extends Controller
{
    /**
     * Display a listing of quiz attempts.
     */
    public function index(Request $request)
    {
        $query = EducationQuizAttempt::query()
            ->with([
                'quiz',
                'student',
            ])
            ->latest('started_at');


        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->input('search');

            $query->where(function ($query) use ($search) {

                $query->whereHas('student', function ($studentQuery) use ($search) {

                    $studentQuery
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");

                })->orWhereHas('quiz', function ($quizQuery) use ($search) {

                    $quizQuery->where(
                        'title',
                        'like',
                        "%{$search}%"
                    );

                });

            });
        }


        /*
        |--------------------------------------------------------------------------
        | STATUS FILTER
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->input('status')
            );
        }


        /*
        |--------------------------------------------------------------------------
        | PASSED FILTER
        |--------------------------------------------------------------------------
        */

        if ($request->filled('passed')) {

            $query->where(
                'passed',
                $request->input('passed')
            );
        }


        /*
        |--------------------------------------------------------------------------
        | PAGINATION
        |--------------------------------------------------------------------------
        */

        $attempts = $query
            ->paginate(15)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'education.admin.quizzes.attempts.index',
            compact('attempts')
        );
    }


    /**
     * Display the specified quiz attempt.
     */
    public function show(EducationQuizAttempt $attempt)
    {
        $attempt->load([
            'quiz.lesson',
            'student',
            'answers.question',
            'answers.selectedOption',
        ]);


        /*
        |--------------------------------------------------------------------------
        | CALCULATED STATISTICS
        |--------------------------------------------------------------------------
        */

        $totalQuestions = $attempt->answers->count();

        $correctAnswers = $attempt->answers
            ->where('is_correct', true)
            ->count();

        $wrongAnswers = $attempt->answers
            ->where('is_correct', false)
            ->count();


        return view(
            'education.admin.quizzes.attempts.show',
            compact(
                'attempt',
                'totalQuestions',
                'correctAnswers',
                'wrongAnswers'
            )
        );
    }
}
