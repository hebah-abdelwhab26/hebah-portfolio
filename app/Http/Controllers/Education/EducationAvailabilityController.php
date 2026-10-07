<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\EducationAvailability;
use Illuminate\Http\Request;

class EducationAvailabilityController extends Controller
{
    /**
     * Display a listing of availabilities.
     */
    public function index()
    {
        $availabilities = EducationAvailability::query()
            ->orderBy('day_of_week')
            ->orderBy('sort_order')
            ->orderBy('start_time')
            ->paginate(20);

        return view(
            'education.admin.availabilities.index',
            compact('availabilities')
        );
    }


    /**
     * Show the form for creating a new availability.
     */
    public function create()
    {
        return view(
            'education.admin.availabilities.create'
        );
    }


    /**
     * Store a newly created availability.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'day_of_week' => [
                'required',
                'integer',
                'between:0,6',
            ],

            'start_time' => [
                'required',
                'date_format:H:i',
            ],

            'end_time' => [
                'required',
                'date_format:H:i',
                'after:start_time',
            ],

            'label' => [
                'nullable',
                'string',
                'max:255',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

        ]);


        $validated['is_active'] =
            $request->boolean('is_active');

        $validated['sort_order'] =
            $validated['sort_order'] ?? 0;


        EducationAvailability::create($validated);


        return redirect()
            ->route(
                'education.admin.availabilities.index'
            )
            ->with(
                'success',
                'تمت إضافة الموعد المتاح بنجاح.'
            );
    }


    /**
     * Display the specified availability.
     */
    public function show(
        EducationAvailability $availability
    ) {
        return view(
            'education.admin.availabilities.show',
            compact('availability')
        );
    }


    /**
     * Show the form for editing the specified availability.
     */
    public function edit(
        EducationAvailability $availability
    ) {
        return view(
            'education.admin.availabilities.edit',
            compact('availability')
        );
    }


    /**
     * Update the specified availability.
     */
    public function update(
        Request $request,
        EducationAvailability $availability
    ) {
        $validated = $request->validate([

            'day_of_week' => [
                'required',
                'integer',
                'between:0,6',
            ],

            'start_time' => [
                'required',
                'date_format:H:i',
            ],

            'end_time' => [
                'required',
                'date_format:H:i',
                'after:start_time',
            ],

            'label' => [
                'nullable',
                'string',
                'max:255',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

        ]);


        $validated['is_active'] =
            $request->boolean('is_active');

        $validated['sort_order'] =
            $validated['sort_order'] ?? 0;


        $availability->update($validated);


        return redirect()
            ->route(
                'education.admin.availabilities.index'
            )
            ->with(
                'success',
                'تم تحديث الموعد المتاح بنجاح.'
            );
    }


    /**
     * Remove the specified availability.
     */
    public function destroy(
        EducationAvailability $availability
    ) {
        $availability->delete();


        return redirect()
            ->route(
                'education.admin.availabilities.index'
            )
            ->with(
                'success',
                'تم حذف الموعد المتاح بنجاح.'
            );
    }
}
