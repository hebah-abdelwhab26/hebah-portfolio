<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DigitalStudioNews;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DigitalStudioNewsController extends Controller
{
    /**
     * Display a listing of the news.
     */
    public function index(Request $request): View
    {
        $news = DigitalStudioNews::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->toString();

                $query->where(function ($query) use ($search) {
                    $query
                        ->where('title', 'like', "%{$search}%")
                        ->orWhere('content', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('type'), function ($query) use ($request) {
                $query->where('type', $request->string('type')->toString());
            })
            ->when($request->filled('active'), function ($query) use ($request) {
                $query->where(
                    'is_active',
                    $request->input('active') === '1'
                );
            })
            ->orderBy('sort_order')
            ->latest('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new news item.
     */
    public function create(): View
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created news item.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'content' => [
                'nullable',
                'string',
            ],

            'type' => [
                'required',
                'in:announcement,project,update,notice,general',
            ],

            'link' => [
                'nullable',
                'string',
                'max:2048',
            ],

            'link_text' => [
                'nullable',
                'string',
                'max:100',
            ],

            'icon' => [
                'nullable',
                'string',
                'max:100',
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

            'starts_at' => [
                'nullable',
                'date',
            ],

            'ends_at' => [
                'nullable',
                'date',
                'after_or_equal:starts_at',
            ],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        DigitalStudioNews::create($validated);

        return redirect()
            ->route('admin.news.index')
            ->with('success', __('digital_studio_admin.news.flash.created'));
    }

    /**
     * Show the form for editing the specified news item.
     */
    public function edit(DigitalStudioNews $news): View
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified news item.
     */
    public function update(
        Request $request,
        DigitalStudioNews $news
    ): RedirectResponse {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'content' => [
                'nullable',
                'string',
            ],

            'type' => [
                'required',
                'in:announcement,project,update,notice,general',
            ],

            'link' => [
                'nullable',
                'string',
                'max:2048',
            ],

            'link_text' => [
                'nullable',
                'string',
                'max:100',
            ],

            'icon' => [
                'nullable',
                'string',
                'max:100',
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

            'starts_at' => [
                'nullable',
                'date',
            ],

            'ends_at' => [
                'nullable',
                'date',
                'after_or_equal:starts_at',
            ],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $news->update($validated);

        return redirect()
            ->route('admin.news.index')
            ->with('success', __('digital_studio_admin.news.flash.updated'));
    }

    /**
     * Remove the specified news item.
     */
    public function destroy(DigitalStudioNews $news): RedirectResponse
    {
        $news->delete();

        return redirect()
            ->route('admin.news.index')
            ->with('success', __('digital_studio_admin.news.flash.deleted'));
    }
}
