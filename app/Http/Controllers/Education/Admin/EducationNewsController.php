<?php

namespace App\Http\Controllers\Education\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Education\Admin\StoreEducationNewsRequest;
use App\Http\Requests\Education\Admin\UpdateEducationNewsRequest;
use App\Models\EducationNews;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EducationNewsController extends Controller
{
    /**
     * عرض جميع الأخبار.
     */
    public function index(): View
    {
        $news = EducationNews::query()
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('education.admin.news.index', compact('news'));
    }

    /**
     * صفحة إضافة خبر جديد.
     */
    public function create(): View
    {
        return view('education.admin.news.create');
    }

    /**
     * حفظ خبر جديد.
     */
    public function store(StoreEducationNewsRequest $request): RedirectResponse
    {
        EducationNews::create($request->validated());

        return redirect()
            ->route('education.admin.news.index')
            ->with('success', 'تمت إضافة الخبر بنجاح.');
    }

    /**
     * عرض خبر محدد.
     */
    public function show(EducationNews $news): View
    {
        return view('education.admin.news.show', compact('news'));
    }

    /**
     * صفحة تعديل الخبر.
     */
    public function edit(EducationNews $news): View
    {
        return view('education.admin.news.edit', compact('news'));
    }

    /**
     * تحديث الخبر.
     */
    public function update(
        UpdateEducationNewsRequest $request,
        EducationNews $news
    ): RedirectResponse {
        $news->update($request->validated());

        return redirect()
            ->route('education.admin.news.index')
            ->with('success', 'تم تحديث الخبر بنجاح.');
    }

    /**
     * حذف الخبر.
     */
    public function destroy(EducationNews $news): RedirectResponse
    {
        $news->delete();

        return redirect()
            ->route('education.admin.news.index')
            ->with('success', 'تم حذف الخبر بنجاح.');
    }

    /**
     * تفعيل / تعطيل الخبر.
     */
    public function toggle(EducationNews $news): RedirectResponse
    {
        $news->update([
            'is_active' => ! $news->is_active,
        ]);

        $message = $news->is_active
            ? 'تم تفعيل الخبر بنجاح.'
            : 'تم تعطيل الخبر بنجاح.';

        return redirect()
            ->back()
            ->with('success', $message);
    }
}
