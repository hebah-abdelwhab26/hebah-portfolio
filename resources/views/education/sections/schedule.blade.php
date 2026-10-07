
{{-- ==================================================
    EDUCATION SCHEDULE
    يظهر فقط للطالب المسجل والمعتمد
================================================== --}}

@auth('education')

    @php
        $educationStudent = auth('education')->user();
    @endphp

    @if($educationStudent && $educationStudent->isStudentApproved())

        @php
            /*
            |--------------------------------------------------------------------------
            | DAYS
            |--------------------------------------------------------------------------
            |
            | 0 = Sunday
            | 1 = Monday
            | 2 = Tuesday
            | 3 = Wednesday
            | 4 = Thursday
            | 5 = Friday
            | 6 = Saturday
            |
            */

            $scheduleDays = [
                0 => [
                    'key' => 'sunday',
                ],

                1 => [
                    'key' => 'monday',
                ],

                2 => [
                    'key' => 'tuesday',
                ],

                3 => [
                    'key' => 'wednesday',
                ],

                4 => [
                    'key' => 'thursday',
                ],

                5 => [
                    'key' => 'friday',
                ],

                6 => [
                    'key' => 'saturday',
                ],
            ];


            /*
            |--------------------------------------------------------------------------
            | FEATURED DAY
            |--------------------------------------------------------------------------
            |
            | أول يوم يحتوي على موعد متاح يصبح مميزًا تلقائيًا.
            |
            */

            $featuredDay = $availabilities
                ->where('is_active', true)
                ->sortBy([
                    ['day_of_week', 'asc'],
                    ['sort_order', 'asc'],
                    ['start_time', 'asc'],
                ])
                ->first()?->day_of_week;
        @endphp


        <section
            class="education-schedule-section"
            id="schedule"
            dir="rtl"
            aria-label="{{ __('education.schedule.aria.schedule') }}"
        >

            <div class="education-schedule-container">

                {{-- ==================================================
                    SECTION HEADER
                ================================================== --}}

                <div class="education-schedule-header">

                    <span class="education-section-badge">
                        {{ __('education.schedule.header.badge') }}
                    </span>

                    <h2>
                        {{ __('education.schedule.header.title_line_1') }}

                        <span>
                            {{ __('education.schedule.header.title_line_2') }}
                        </span>
                    </h2>

                    <p>
                        {{ __('education.schedule.header.description') }}
                    </p>

                </div>


                {{-- ==================================================
                    DAYS
                ================================================== --}}

                <div class="education-schedule-days">

                    @foreach($scheduleDays as $dayNumber => $day)

                        @php
                            /*
                            |--------------------------------------------------------------------------
                            | GET DAY SLOTS
                            |--------------------------------------------------------------------------
                            |
                            | جلب المواعيد الخاصة بهذا اليوم فقط.
                            |
                            */

                            $daySlots = $availabilities
                                ->where('day_of_week', $dayNumber)
                                ->where('is_active', true)
                                ->sortBy([
                                    ['sort_order', 'asc'],
                                    ['start_time', 'asc'],
                                ])
                                ->values();

                            $hasSlots = $daySlots->isNotEmpty();

                            $isFeatured =
                                $hasSlots &&
                                $featuredDay === $dayNumber;
                        @endphp


                        <article
                            class="education-day-card
                                {{ $hasSlots ? 'has-slots' : 'unavailable' }}
                                {{ $isFeatured ? 'featured' : '' }}"
                            data-day="{{ $day['key'] }}"
                        >

                            <div class="education-day-card-inner">


                                {{-- ==================================================
                                    DAY TOP
                                ================================================== --}}

                                <div class="education-day-top">

                                    <span class="education-day-icon">

                                        @if($hasSlots)

                                            <i class="fa-regular fa-calendar"></i>

                                        @else

                                            <i class="fa-regular fa-calendar-xmark"></i>

                                        @endif

                                    </span>


                                    <span class="education-day-status">

                                        {{ $hasSlots
                                            ? __('education.schedule.status.available')
                                            : __('education.schedule.status.unavailable')
                                        }}

                                    </span>

                                </div>


                                {{-- ==================================================
                                    DAY NAME
                                ================================================== --}}

                                <div class="education-day-name">

                                    {{ __('education.schedule.days.' . $day['key']) }}

                                </div>


                                {{-- ==================================================
                                    INDICATOR
                                ================================================== --}}

                                <span class="education-day-indicator">
                                    <span></span>
                                </span>


                                {{-- ==================================================
                                    AVAILABLE SLOTS
                                ================================================== --}}

                                @if($hasSlots)

                                    <div class="education-day-slots">


                                        {{-- ==================================================
                                            SLOTS HEADER
                                        ================================================== --}}

                                        <div class="education-day-slots-header">

                                            <span>
                                                {{ __('education.schedule.slots.available_times') }}
                                            </span>

                                            <i class="fa-regular fa-clock"></i>

                                        </div>


                                        {{-- ==================================================
                                            TIME LIST
                                        ================================================== --}}

                                        <div class="education-time-list">

                                            @foreach($daySlots as $slot)

                                                @php
                                                    $startTime = \Carbon\Carbon::parse(
                                                        $slot->start_time
                                                    );

                                                    $endTime = \Carbon\Carbon::parse(
                                                        $slot->end_time
                                                    );
                                                @endphp


                                                <span
                                                    class="education-time-slot"
                                                    @if($slot->label)
                                                        title="{{ $slot->label }}"
                                                    @endif
                                                >

                                                    <i class="fa-regular fa-clock"></i>

                                                    {{ $startTime->format('h:i') }}
                                                    -
                                                    {{ $endTime->format('h:i') }}

                                                    @if($startTime->format('A') === 'AM')
                                                        {{ app()->getLocale() === 'ar' ? 'ص' : 'AM' }}
                                                    @else
                                                        {{ app()->getLocale() === 'ar' ? 'م' : 'PM' }}
                                                    @endif

                                                </span>

                                            @endforeach

                                        </div>


                                        {{-- ==================================================
                                            BOOKING BUTTON
                                        ================================================== --}}

                                        <a
                                            href="{{ route('education.booking.create') }}"
                                            class="education-day-book"
                                        >

                                            {{ __('education.schedule.slots.booking') }}

                                            <i class="fa-solid fa-arrow-left"></i>

                                        </a>


                                    </div>


                                @else

                                    {{-- ==================================================
                                        UNAVAILABLE DAY
                                    ================================================== --}}

                                    <div class="education-day-slots">

                                        <div class="education-day-unavailable-message">

                                            <i class="fa-regular fa-moon"></i>

                                            <span>
                                                {{ __('education.schedule.slots.unavailable_message') }}
                                            </span>

                                        </div>

                                    </div>

                                @endif


                            </div>

                        </article>

                    @endforeach

                </div>


                {{-- ==================================================
                    BOTTOM NOTE
                ================================================== --}}

                <div class="education-schedule-note">

                    <div class="education-schedule-note-icon">

                        <i class="fa-solid fa-circle-info"></i>

                    </div>


                    <div>

                        <strong>
                            {{ __('education.schedule.note.question') }}
                        </strong>

                        <span>
                            {{ __('education.schedule.note.message') }}
                        </span>

                    </div>


                    {{-- ==================================================
                        GENERAL CONTACT
                        يبقى متاحًا للجميع ولا يعتمد على نظام الحجز
                    ================================================== --}}

                    <a href="#contact">

                        {{ __('education.schedule.note.contact') }}

                        <i class="fa-solid fa-arrow-left"></i>

                    </a>

                </div>


            </div>

        </section>

    @endif

@endauth

