<x-mail::message>

# 📚 {{ trans('education.email.lesson_reminder_title', [], $mailLocale) }}

{{ trans('education.email.lesson_reminder_greeting', [
    'name' => $booking->student?->name
        ?? trans('education.email.default_student', [], $mailLocale)
], $mailLocale) }}

{{ trans('education.email.lesson_reminder_message', [], $mailLocale) }}

<x-mail::panel>

**📚 {{ trans('education.email.lesson', [], $mailLocale) }}:**
{{ $booking->title }}

**📅 {{ trans('education.email.date', [], $mailLocale) }}:**
{{ $booking->booking_date?->format('Y-m-d') }}

**🕐 {{ trans('education.email.start_time', [], $mailLocale) }}:**
{{ $booking->start_time?->format('H:i') }}

**🕐 {{ trans('education.email.end_time', [], $mailLocale) }}:**
{{ $booking->end_time?->format('H:i') }}

</x-mail::panel>

{{ trans('education.email.prepare_message', [], $mailLocale) }}

@if(Route::has('education.booking.show'))
<x-mail::button :url="route('education.booking.show', ['booking' => $booking->id])">
{{ trans('education.email.view_booking', [], $mailLocale) }}
</x-mail::button>
@endif

{{ trans('education.email.success_message', [], $mailLocale) }}

{{ trans('education.email.signature', [], $mailLocale) }}

</x-mail::message>
