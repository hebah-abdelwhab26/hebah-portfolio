<section
    class="contact-section"
    id="contact">

<div class="container">

    <!--==================================================
            SECTION HEADER
    ==================================================-->

    <div class="section-header">

        <span
            class="section-badge"
            style="color: #f2b824">

            {{ __('digital_studio.contact.badge') }}

        </span>

        <h2>

            {{ __('digital_studio.contact.title_before') }}

            <span>
                {{ __('digital_studio.contact.title_highlight') }}
            </span>

        </h2>

        <p>

            {{ __('digital_studio.contact.description') }}

        </p>

    </div>


    <!--==================================================
            SUCCESS MESSAGE
    ==================================================-->

    @if(session('contact_success'))

        <div class="contact-alert contact-alert-success">

            <i class="fa-solid fa-circle-check"></i>

            <span>
                {{ session('contact_success') }}
            </span>

        </div>

    @endif


    <!--==================================================
            ERROR MESSAGE
    ==================================================-->

    @if($errors->any())

        <div class="contact-alert contact-alert-error">

            <i class="fa-solid fa-circle-exclamation"></i>

            <div>

                <strong>
                    {{ __('digital_studio.contact.form_check') }}
                </strong>

                <ul>

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        </div>

    @endif


    <!--==================================================
            CONTACT CONTENT
    ==================================================-->

    <div class="contact-wrapper">


        <!--==================================================
                LEFT SIDE
        ==================================================-->

        <div class="contact-info">


            <!--==================================================
                    INTRO CARD
            ==================================================-->

            <div class="contact-intro-card">

                <div class="contact-intro-icon">

                    <i class="fa-regular fa-comments"></i>

                </div>

                <div>

                    <h3>
                        {{ __('digital_studio.contact.intro.title') }}
                    </h3>

                    <p>
                        {{ __('digital_studio.contact.intro.description') }}
                    </p>

                </div>

            </div>


            <!--==================================================
                    EMAIL
            ==================================================-->

            <a
                href="mailto:hebah@hebahgift.com"
                class="info-card"
                aria-label="Email Hebah">

                <div class="info-icon">

                    <i class="fa-solid fa-envelope"></i>

                </div>

                <div class="info-content">

                    <h4>
                        {{ __('digital_studio.contact.info.email.title') }}
                    </h4>

                    <p>
                        hebah@hebahgift.com
                    </p>

                </div>

            </a>


            <!--==================================================
                    PHONE
            ==================================================-->

            <a
                href="tel:+966533812139"
                class="info-card"
                aria-label="Call Hebah">

                <div class="info-icon">

                    <i class="fa-solid fa-phone"></i>

                </div>

                <div class="info-content">

                    <h4>
                        {{ __('digital_studio.contact.info.phone.title') }}
                    </h4>

                    <p dir="ltr">
                        +966 53 381 2139
                    </p>

                </div>

            </a>


            <!--==================================================
                    WHATSAPP
            ==================================================-->

            <a
                href="https://wa.me/966533812139"
                class="info-card"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="WhatsApp Hebah">

                <div class="info-icon">

                    <i class="fa-brands fa-whatsapp"></i>

                </div>

                <div class="info-content">

                    <h4>
                        {{ __('digital_studio.contact.info.whatsapp.title') }}
                    </h4>

                    <p>
                        {{ __('digital_studio.contact.info.whatsapp.description') }}
                    </p>

                </div>

            </a>


            <!--==================================================
                    RESPONSE TIME
            ==================================================-->

            <div class="info-card">

                <div class="info-icon">

                    <i class="fa-regular fa-clock"></i>

                </div>

                <div class="info-content">

                    <h4>
                        {{ __('digital_studio.contact.info.response.title') }}
                    </h4>

                    <p>
                        {{ __('digital_studio.contact.info.response.description') }}
                    </p>

                </div>

            </div>


            <!--==================================================
                    WORLDWIDE
            ==================================================-->

            <div class="info-card">

                <div class="info-icon">

                    <i class="fa-solid fa-globe"></i>

                </div>

                <div class="info-content">

                    <h4>
                        {{ __('digital_studio.contact.info.worldwide.title') }}
                    </h4>

                    <p>
                        {{ __('digital_studio.contact.info.worldwide.description') }}
                    </p>

                </div>

            </div>


            <!--==================================================
                    SOCIAL LINKS
            ==================================================-->

            <div class="social-box">

                <h4>
                    {{ __('digital_studio.contact.social.title') }}
                </h4>

                <div class="social-links">

                    <a
                        href="#"
                        aria-label="GitHub">

                        <i class="fa-brands fa-github"></i>

                    </a>

                    <a
                        href="#"
                        aria-label="LinkedIn">

                        <i class="fa-brands fa-linkedin-in"></i>

                    </a>

                    <a
                        href="#"
                        aria-label="Figma">

                        <i class="fa-brands fa-figma"></i>

                    </a>

                    <a
                        href="#"
                        aria-label="Behance">

                        <i class="fa-brands fa-behance"></i>

                    </a>

                    <a
                        href="#"
                        aria-label="Facebook">

                        <i class="fa-brands fa-facebook-f"></i>

                    </a>

                    <a
                        href="#"
                        aria-label="Instagram">

                        <i class="fa-brands fa-instagram"></i>

                    </a>

                </div>

            </div>

        </div>


        <!--==================================================
                RIGHT SIDE
        ==================================================-->

        <div class="contact-form-card">


            <!--==================================================
                    CONTACT FORM
            ==================================================-->

            <div class="contact-form-header">

                <span class="contact-form-label">

                    {{ __('digital_studio.contact.form.label') }}

                </span>

                <h3>

                    {{ __('digital_studio.contact.form.title') }}

                </h3>

                <p>

                    {{ __('digital_studio.contact.form.description') }}

                </p>

            </div>


            <form
                id="contactForm"
                action="{{ route('contact.store') }}"
                method="POST">

                @csrf

                {{-- تحديد مصدر الرسالة: Digital Studio --}}
                <input
                    type="hidden"
                    name="source"
                    value="digital_studio">


                <!--==================================================
                        GUEST / AUTH USER INFORMATION
                ==================================================-->

                @guest

                    <!--==================================================
                            NAME
                    ==================================================-->

                    <div class="form-group">

                        <label for="contactName">

                            {{ __('digital_studio.contact.form.name.label') }}

                        </label>

                        <input
                            type="text"
                            id="contactName"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="{{ __('digital_studio.contact.form.name.placeholder') }}"
                            maxlength="255"
                            autocomplete="name"
                            required>

                    </div>


                    <!--==================================================
                            EMAIL
                    ==================================================-->

                    <div class="form-group">

                        <label for="contactEmail">

                            {{ __('digital_studio.contact.form.email.label') }}

                        </label>

                        <input
                            type="email"
                            id="contactEmail"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="{{ __('digital_studio.contact.form.email.placeholder') }}"
                            maxlength="255"
                            autocomplete="email"
                            dir="ltr"
                            required>

                    </div>

                @else

                    <!--==================================================
                            AUTHENTICATED USER PREVIEW
                    ==================================================-->

                    <div class="contact-user-preview">

                        <div class="contact-user-avatar">

                            @if(auth()->user()->avatar)

                                <img
                                    src="{{ asset(auth()->user()->avatar) }}"
                                    alt="{{ auth()->user()->name }}">

                            @else

                                <span>

                                    {{ strtoupper(
                                        substr(
                                            auth()->user()->name,
                                            0,
                                            1
                                        )
                                    ) }}

                                </span>

                            @endif

                        </div>

                        <div class="contact-user-info">

                            <strong>

                                {{ auth()->user()->name }}

                            </strong>

                            <span>

                                {{ auth()->user()->email }}

                            </span>

                        </div>

                    </div>

                    {{-- يتم إرسال بيانات المستخدم المسجل تلقائيًا --}}

                    <input
                        type="hidden"
                        name="name"
                        value="{{ auth()->user()->name }}">

                    <input
                        type="hidden"
                        name="email"
                        value="{{ auth()->user()->email }}">

                @endguest


                <!--==================================================
                        SUBJECT
                ==================================================-->

                <div class="form-group">

                    <label for="contactSubject">

                        {{ __('digital_studio.contact.form.subject.label') }}

                    </label>

                    <input
                        type="text"
                        id="contactSubject"
                        name="subject"
                        value="{{ old('subject') }}"
                        placeholder="{{ __('digital_studio.contact.form.subject.placeholder') }}"
                        maxlength="100"
                        required>

                </div>


                <!--==================================================
                        MESSAGE
                ==================================================-->

                <div class="form-group full-width">

                    <label for="contactMessage">

                        {{ __('digital_studio.contact.form.message.label') }}

                    </label>

                    <textarea
                        id="contactMessage"
                        name="message"
                        rows="8"
                        maxlength="5000"
                        placeholder="{{ __('digital_studio.contact.form.message.placeholder') }}"
                        required>{{ old('message') }}</textarea>

                </div>


                <!--==================================================
                        SUBMIT
                ==================================================-->

                <button
                    type="submit"
                    class="contact-btn">

                    <span>
                        {{ __('digital_studio.contact.form.submit') }}
                    </span>

                    <i class="fa-solid fa-arrow-right"></i>

                </button>

            </form>

        </div>

    </div>


    <!--==================================================
            USER CONVERSATIONS
    ==================================================-->

    @auth

        @php

            $recentConversations = auth()
                ->user()
                ->conversations()
                ->with('latestMessage')
                ->latest('last_message_at')
                ->take(3)
                ->get();

        @endphp


        @if($recentConversations->count())

            <div class="contact-conversations">


                <!--==================================================
                        CONVERSATIONS HEADER
                ==================================================-->

                <div class="contact-conversations-header">

                    <div>

                        <span class="contact-form-label">

                            {{ __('digital_studio.contact.conversations.label') }}

                        </span>

                        <h3>

                            {{ __('digital_studio.contact.conversations.title') }}

                        </h3>

                    </div>


                    <a
                        href="{{ route('conversations.index') }}"
                        class="contact-view-all">

                        {{ __('digital_studio.contact.conversations.view_all') }}

                        <i class="fa-solid fa-arrow-right"></i>

                    </a>

                </div>


                <!--==================================================
                        CONVERSATIONS LIST
                ==================================================-->

                <div class="contact-conversations-list">

                    @foreach(
                        $recentConversations
                        as $conversation
                    )

                        <a
                            href="{{ route(
                                'conversations.show',
                                $conversation
                            ) }}"
                            class="contact-conversation-item">


                            <!--==================================================
                                    CONVERSATION ICON
                            ==================================================-->

                            <div class="contact-conversation-icon">

                                <i class="fa-regular fa-comments"></i>

                            </div>


                            <!--==================================================
                                    CONVERSATION CONTENT
                            ==================================================-->

                            <div class="contact-conversation-content">

                                <div class="contact-conversation-top">

                                    <strong>

                                        {{ $conversation->subject }}

                                    </strong>


                                    <span
                                        class="conversation-status
                                        conversation-status-{{ $conversation->status }}">

                                        {{ ucfirst(
                                            $conversation->status
                                        ) }}

                                    </span>

                                </div>


                                @if($conversation->latestMessage)

                                    <p>

                                        {{ \Illuminate\Support\Str::limit(
                                            $conversation->latestMessage->message,
                                            100
                                        ) }}

                                    </p>

                                @else

                                    <p>

                                        {{ __('digital_studio.contact.conversations.no_messages') }}

                                    </p>

                                @endif


                                <small>

                                    @if($conversation->last_message_at)

                                        {{ $conversation->last_message_at
                                            ->diffForHumans()
                                        }}

                                    @else

                                        {{ __('digital_studio.contact.conversations.no_activity') }}

                                    @endif

                                </small>

                            </div>


                            <!--==================================================
                                    ARROW
                            ==================================================-->

                            <i
                                class="fa-solid fa-chevron-right contact-conversation-arrow">
                            </i>

                        </a>

                    @endforeach

                </div>

            </div>

        @endif

    @endauth

</div>

</section>
