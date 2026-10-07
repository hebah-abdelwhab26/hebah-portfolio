<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Models\EducationBookingType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EducationBookingTypeController extends Controller
{
    /**
     * Display a listing of booking types.
     */
    public function index()
    {
        $bookingTypes = EducationBookingType::query()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(15);

        return view(
            'education.admin.booking-types.index',
            compact('bookingTypes')
        );
    }

    /**
     * Show the form for creating a new booking type.
     */
    public function create()
    {
        return view(
            'education.admin.booking-types.create'
        );
    }

    /**
     * Store a newly created booking type.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:education_booking_types,slug',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'icon' => [
                'nullable',
                'string',
                'max:255',
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

            'total_sessions' => [
                'required',
                'integer',
                'min:1',
            ],

            'session_duration' => [
                'nullable',
                'integer',
                'min:1',
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

        $validated['slug'] = !empty($validated['slug'])
            ? Str::slug($validated['slug'])
            : Str::slug($validated['name']);

        $validated['is_active'] =
            $request->boolean('is_active');

        $validated['sort_order'] =
            $validated['sort_order'] ?? 0;

        EducationBookingType::create($validated);

        return redirect()
            ->route('education.admin.booking-types.index')
            ->with(
                'success',
                'تم إنشاء نوع الحجز بنجاح.'
            );
    }

    /**
     * Display the specified booking type.
     */
    public function show(EducationBookingType $bookingType)
    {
        $bookingType->loadCount('bookings');

        return view(
            'education.admin.booking-types.show',
            compact('bookingType')
        );
    }

    /**
     * Show the form for editing the specified booking type.
     */
    public function edit(EducationBookingType $bookingType)
    {
        return view(
            'education.admin.booking-types.edit',
            compact('bookingType')
        );
    }

    /**
     * Update the specified booking type.
     */
    public function update(
        Request $request,
        EducationBookingType $bookingType
    ) {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:education_booking_types,slug,' .
                    $bookingType->id,
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'icon' => [
                'nullable',
                'string',
                'max:255',
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

            'total_sessions' => [
                'required',
                'integer',
                'min:1',
            ],

            'session_duration' => [
                'nullable',
                'integer',
                'min:1',
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

        $validated['slug'] = !empty($validated['slug'])
            ? Str::slug($validated['slug'])
            : Str::slug($validated['name']);

        $validated['is_active'] =
            $request->boolean('is_active');

        $validated['sort_order'] =
            $validated['sort_order'] ?? 0;

        $bookingType->update($validated);

        return redirect()
            ->route(
                'education.admin.booking-types.index'
            )
            ->with(
                'success',
                'تم تحديث نوع الحجز بنجاح.'
            );
    }

    /**
     * Remove the specified booking type.
     */
    public function destroy(
        EducationBookingType $bookingType
    ) {
        if ($bookingType->bookings()->exists()) {
            return back()->with(
                'error',
                'لا يمكن حذف نوع حجز مرتبط بحجوزات موجودة.'
            );
        }

        $bookingType->delete();

        return redirect()
            ->route(
                'education.admin.booking-types.index'
            )
            ->with(
                'success',
                'تم حذف نوع الحجز بنجاح.'
            );
    }
}
