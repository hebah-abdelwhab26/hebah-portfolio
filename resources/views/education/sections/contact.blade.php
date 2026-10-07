<section class="education-contact" id="contact">

<div class="education-contact-container">

    {{-- =========================================================
         HEADER
    ========================================================== --}}
    <div class="education-contact-header">

        <span class="education-section-badge">
            {{ __('education.contact.header.badge') }}
        </span>

        <h2>
            {{ __('education.contact.header.title_start') }}
            <span>{{ __('education.contact.header.title_highlight') }}</span>
        </h2>

        <p>
            {{ __('education.contact.header.description') }}
        </p>

    </div>


    {{-- =========================================================
         SUCCESS MESSAGE
    ========================================================== --}}
    @if(session('contact_success'))

        <div class="education-contact-success" role="alert">

            <i class="fa-solid fa-circle-check"></i>

            <span>
                {{ session('contact_success') }}
            </span>

        </div>

    @endif


    {{-- =========================================================
         CONTACT GRID
    ========================================================== --}}
    <div class="education-contact-grid">


        {{-- =====================================================
             CONTACT INFORMATION
        ====================================================== --}}
        <div class="education-contact-info">

            <div class="education-contact-intro">

                <span>
                    {{ __('education.contact.info.welcome') }}
                </span>

                <h3>
                    {{ __('education.contact.info.title') }}
                </h3>

                <p>
                    {{ __('education.contact.info.description') }}
                </p>

            </div>


            {{-- =================================================
                 CONTACT ITEMS
            ================================================== --}}
            <div class="education-contact-items">


                {{-- =================================================
                     EMAIL
                ================================================== --}}
                <a
                    href="mailto:hebah@hebahgift.com"
                    class="education-contact-item"
                >

                    <div class="education-contact-item-icon">

                        <i class="fa-regular fa-envelope"></i>

                    </div>

                    <div>

                        <span>
                            {{ __('education.contact.items.email.label') }}
                        </span>

                        <strong>
                            hebah@hebahgift.com
                        </strong>

                    </div>

                </a>


                {{-- =================================================
                     WHATSAPP
                     الرقم مخفي ويظهر فقط النص المترجم
                ================================================== --}}
                <a
                    href="https://wa.me/966533812139"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="education-contact-item"
                    aria-label="{{ __('education.contact.items.whatsapp.label') }}"
                >

                    <div class="education-contact-item-icon">

                        <i class="fa-brands fa-whatsapp"></i>

                    </div>

                    <div>

                        <span>
                            {{ __('education.contact.items.whatsapp.label') }}
                        </span>

                        <strong>
                            {{ __('education.contact.items.whatsapp.value') }}
                        </strong>

                    </div>

                </a>


                {{-- =================================================
                     AVAILABILITY
                ================================================== --}}
                <div class="education-contact-item">

                    <div class="education-contact-item-icon">

                        <i class="fa-regular fa-clock"></i>

                    </div>

                    <div>

                        <span>
                            {{ __('education.contact.items.availability.label') }}
                        </span>

                        <strong>
                            {{ __('education.contact.items.availability.value') }}
                        </strong>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 CONTACT NOTE
            ================================================== --}}
            <div class="education-contact-note">

                <i class="fa-solid fa-feather-pointed"></i>

                <span>
                    {{ __('education.contact.note') }}
                </span>

            </div>

        </div>



        {{-- =====================================================
             CONTACT FORM
        ====================================================== --}}
        <div class="education-contact-form-wrapper">

            <form
                method="POST"
                action="{{ route('contact.store') }}"
                class="education-contact-form"
            >

                @csrf

                {{-- تحديد مصدر الرسالة: Education --}}
                <input
                    type="hidden"
                    name="source"
                    value="education">


                {{-- =================================================
                     NAME + EMAIL
                ================================================== --}}
                <div class="education-form-row">


                    {{-- NAME --}}
                    <div class="education-form-field">

                        <label for="contact_name">
                            {{ __('education.contact.form.name.label') }}
                        </label>

                        <input
                            type="text"
                            id="contact_name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="{{ __('education.contact.form.name.placeholder') }}"
                            autocomplete="name"
                            required
                            class="@error('name') is-invalid @enderror"
                        >

                        @error('name')
                            <small class="education-form-error">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>


                    {{-- EMAIL --}}
                    <div class="education-form-field">

                        <label for="contact_email">
                            {{ __('education.contact.form.email.label') }}
                        </label>

                        <input
                            type="email"
                            id="contact_email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="{{ __('education.contact.form.email.placeholder') }}"
                            autocomplete="email"
                            required
                            class="@error('email') is-invalid @enderror"
                        >

                        @error('email')
                            <small class="education-form-error">
                                {{ $message }}
                            </small>
                        @enderror

                    </div>

                </div>



                {{-- =================================================
                     SUBJECT
                ================================================== --}}
                <div class="education-form-field">

                    <label for="contact_subject">
                        {{ __('education.contact.form.subject.label') }}
                    </label>

                    <select
                        id="contact_subject"
                        name="subject"
                        required
                        class="@error('subject') is-invalid @enderror"
                    >

                        <option value="">
                            {{ __('education.contact.form.subject.placeholder') }}
                        </option>

                        <option
                            value="quran"
                            @selected(old('subject') === 'quran')
                        >
                            {{ __('education.contact.form.subject.options.quran') }}
                        </option>

                        <option
                            value="tajweed"
                            @selected(old('subject') === 'tajweed')
                        >
                            {{ __('education.contact.form.subject.options.tajweed') }}
                        </option>

                        <option
                            value="memorization"
                            @selected(old('subject') === 'memorization')
                        >
                            {{ __('education.contact.form.subject.options.memorization') }}
                        </option>

                        <option
                            value="arabic"
                            @selected(old('subject') === 'arabic')
                        >
                            {{ __('education.contact.form.subject.options.arabic') }}
                        </option>

                        <option
                            value="general"
                            @selected(old('subject') === 'general')
                        >
                            {{ __('education.contact.form.subject.options.general') }}
                        </option>

                    </select>

                    @error('subject')
                        <small class="education-form-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>



                {{-- =================================================
                     MESSAGE
                ================================================== --}}
                <div class="education-form-field">

                    <label for="contact_message">
                        {{ __('education.contact.form.message.label') }}
                    </label>

                    <textarea
                        id="contact_message"
                        name="message"
                        rows="6"
                        placeholder="{{ __('education.contact.form.message.placeholder') }}"
                        required
                        class="@error('message') is-invalid @enderror"
                    >{{ old('message') }}</textarea>

                    @error('message')
                        <small class="education-form-error">
                            {{ $message }}
                        </small>
                    @enderror

                </div>



                {{-- =================================================
                     SUBMIT BUTTON
                ================================================== --}}
                <button
                    type="submit"
                    class="education-contact-submit"
                >

                    {{ __('education.contact.form.submit') }}

                    <i class="fa-solid fa-arrow-left"></i>

                </button>

            </form>

        </div>

    </div>

</div>


</section>
