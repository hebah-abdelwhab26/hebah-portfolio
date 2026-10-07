<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(
    basePath: dirname(__DIR__)
)

    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware): void {

        $middleware->alias([

            /*
            |--------------------------------------------------------------------------
            | Main Admin
            |--------------------------------------------------------------------------
            */

            'admin' =>
                \App\Http\Middleware\AdminMiddleware::class,


            /*
            |--------------------------------------------------------------------------
            | Education Authentication
            |--------------------------------------------------------------------------
            */

            'education.auth' =>
                \App\Http\Middleware\EducationAuthenticate::class,


            /*
            |--------------------------------------------------------------------------
            | Education Guest
            |--------------------------------------------------------------------------
            */

            'education.guest' =>
                \App\Http\Middleware\EducationGuest::class,


            /*
            |--------------------------------------------------------------------------
            | Education Approved Student
            |--------------------------------------------------------------------------
            */

            'education.approved' =>
                \App\Http\Middleware\EducationStudentApproved::class,


            /*
            |--------------------------------------------------------------------------
            | Education Admin Authentication
            |--------------------------------------------------------------------------
            */

            'education_admin.auth' =>
                \App\Http\Middleware\EducationAdminAuth::class,


            /*
            |--------------------------------------------------------------------------
            | Education Language
            |--------------------------------------------------------------------------
            */

            'education.locale' =>
                \App\Http\Middleware\SetEducationLocale::class,


            /*
            |--------------------------------------------------------------------------
            | Digital Studio Language
            |--------------------------------------------------------------------------
            */

            'digital.locale' =>
                \App\Http\Middleware\SetDigitalStudioLocale::class,

        ]);

    })

    ->withExceptions(function (Exceptions $exceptions): void {

        //

    })

    ->create();
