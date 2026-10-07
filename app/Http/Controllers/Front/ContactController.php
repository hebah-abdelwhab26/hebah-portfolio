<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\EducationAdmin;
use App\Models\EducationAdminNotification;
use App\Models\User;
use App\Notifications\NewContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * عرض صفحة التواصل
     */
    public function index(): View
    {
        return view('front.contact');
    }


    /**
     * حفظ رسالة التواصل
     */
    public function store(Request $request): RedirectResponse
    {
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
            ],

            'subject' => [
                'required',
                'string',
                'max:100',
            ],

            'message' => [
                'required',
                'string',
                'min:5',
                'max:5000',
            ],

            /*
            |--------------------------------------------------------------------------
            | Message Source
            |--------------------------------------------------------------------------
            |
            | digital_studio = Digital Studio
            | education      = Education
            |
            */
            'source' => [
                'nullable',
                'string',
                'in:digital_studio,education',
            ],
        ], [
            'name.required' => 'يرجى كتابة الاسم.',
            'name.string' => 'الاسم غير صالح.',
            'name.max' => 'الاسم طويل جدًا.',

            'email.required' => 'يرجى كتابة البريد الإلكتروني.',
            'email.email' => 'يرجى إدخال بريد إلكتروني صحيح.',
            'email.max' => 'البريد الإلكتروني طويل جدًا.',

            'subject.required' => 'يرجى اختيار نوع الاستفسار.',
            'subject.string' => 'نوع الاستفسار غير صالح.',
            'subject.max' => 'نوع الاستفسار غير صالح.',

            'message.required' => 'يرجى كتابة الرسالة.',
            'message.string' => 'الرسالة غير صالحة.',
            'message.min' => 'يجب أن تحتوي الرسالة على 5 أحرف على الأقل.',
            'message.max' => 'الرسالة طويلة جدًا.',

            'source.in' => 'مصدر الرسالة غير صالح.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Determine Source
        |--------------------------------------------------------------------------
        */

        $source = $validated['source'] ?? 'digital_studio';


        /*
        |--------------------------------------------------------------------------
        | Create Contact Message
        |--------------------------------------------------------------------------
        */

        $contactMessage = ContactMessage::create([
            'name' => trim($validated['name']),

            'email' => trim($validated['email']),

            'subject' => $validated['subject'],

            'message' => trim($validated['message']),

            'source' => $source,

            'status' => 'new',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Digital Studio Notifications
        |--------------------------------------------------------------------------
        */

        if ($source === 'digital_studio') {

            $admins = User::query()
                ->whereIn('role', [
                    'admin',
                    'super_admin',
                ])
                ->where('status', 'active')
                ->get();

            foreach ($admins as $admin) {

                $admin->notify(
                    new NewContactMessage(
                        $contactMessage
                    )
                );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Education Notifications
        |--------------------------------------------------------------------------
        */

        if ($source === 'education') {

            $admins = EducationAdmin::query()
                ->pluck('id');

            foreach ($admins as $adminId) {

                EducationAdminNotification::create([
                    'education_admin_id' => $adminId,

                    'type' => 'contact_message',

                    'title' => 'رسالة تواصل جديدة',

                    'message' =>
                        'وصلت رسالة جديدة من ' .
                        $contactMessage->name,

                    'icon' => 'fa-solid fa-envelope',

                    'color' => 'gold',

                    'url' => route(
                        'education.admin.contact-messages.show',
                        $contactMessage
                    ),

                    'read_at' => null,

                    'data' => [
                        'contact_message_id' =>
                            $contactMessage->id,

                        'name' =>
                            $contactMessage->name,

                        'email' =>
                            $contactMessage->email,

                        'subject' =>
                            $contactMessage->subject,
                    ],
                ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Send Email
        |--------------------------------------------------------------------------
        */

        try {

            Mail::to(
                config('mail.from.address')
            )->send(
                new \App\Mail\ContactMessageReceived(
                    $contactMessage
                )
            );

        } catch (\Throwable $exception) {

            report($exception);
        }


        /*
        |--------------------------------------------------------------------------
        | Success
        |--------------------------------------------------------------------------
        */

        return back()->with(
            'contact_success',
            'تم إرسال رسالتك بنجاح. شكرًا لتواصلك معي، وسأقوم بالرد عليك في أقرب وقت ممكن.'
        );
    }
}
