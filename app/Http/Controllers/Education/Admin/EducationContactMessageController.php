<?php

namespace App\Http\Controllers\Education\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EducationContactMessageController extends Controller
{
    /**
     * عرض رسائل التواصل الخاصة بـ Education فقط
     */
    public function index(): View
    {
        $messages = ContactMessage::query()
            ->where('source', 'education')
            ->latest()
            ->paginate(15);

        $totalMessages = ContactMessage::query()
            ->where('source', 'education')
            ->count();

        $newMessages = ContactMessage::query()
            ->where('source', 'education')
            ->new()
            ->count();

        $readMessages = ContactMessage::query()
            ->where('source', 'education')
            ->read()
            ->count();

        $repliedMessages = ContactMessage::query()
            ->where('source', 'education')
            ->replied()
            ->count();

        return view(
            'education.admin.contact-messages.index',
            compact(
                'messages',
                'totalMessages',
                'newMessages',
                'readMessages',
                'repliedMessages'
            )
        );
    }


    /**
     * عرض رسالة Education
     */
    public function show(
        ContactMessage $contactMessage
    ): View {

        /*
        |--------------------------------------------------------------------------
        | حماية إضافية
        |--------------------------------------------------------------------------
        |
        | إذا حاول أحد الوصول إلى رسالة Digital Studio
        | من رابط Education فلن يتم عرضها.
        |
        */

        abort_unless(
            $contactMessage->source === 'education',
            404
        );

        $contactMessage->markAsRead();

        return view(
            'education.admin.contact-messages.show',
            compact('contactMessage')
        );
    }


    /**
     * تحديد الرسالة كمجاب عليها
     */
    public function markAsReplied(
        ContactMessage $contactMessage
    ): RedirectResponse {

        abort_unless(
            $contactMessage->source === 'education',
            404
        );

        $contactMessage->markAsReplied();

        return back()->with(
            'success',
            'تم تحديث حالة الرسالة إلى "تم الرد".'
        );
    }


    /**
     * إعادة فتح الرسالة
     */
    public function reopen(
        ContactMessage $contactMessage
    ): RedirectResponse {

        abort_unless(
            $contactMessage->source === 'education',
            404
        );

        $contactMessage->update([
            'status' => 'read',
        ]);

        return back()->with(
            'success',
            'تم إعادة فتح الرسالة.'
        );
    }


    /**
     * حذف الرسالة
     */
    public function destroy(
        ContactMessage $contactMessage
    ): RedirectResponse {

        abort_unless(
            $contactMessage->source === 'education',
            404
        );

        $contactMessage->delete();

        return redirect()
            ->route(
                'education.admin.contact-messages.index'
            )
            ->with(
                'success',
                'تم حذف الرسالة بنجاح.'
            );
    }
}
