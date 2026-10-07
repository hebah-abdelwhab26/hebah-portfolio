@extends('tech.layouts.app')

@section('content')

@include('tech.sections.navbar')

<div class="conversations-page">


<div class="conversations-container">

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="conversations-header">

        <div class="conversations-header-content">

            <span class="page-badge">
                {{ __('digital_studio.conversations.create.badge') }}
            </span>

            <h1>
                {{ __('digital_studio.conversations.create.title') }}
            </h1>

            <p>
                {{ __('digital_studio.conversations.create.description') }}
            </p>

        </div>

        <a
            href="{{ route('conversations.index') }}"
            class="conversation-refresh"
            title="{{ __('digital_studio.conversations.create.back_to_conversations') }}"
            aria-label="{{ __('digital_studio.conversations.create.back_to_conversations') }}"
        >
            <i class="fa-solid fa-arrow-left"></i>
        </a>

    </div>


    {{-- =====================================================
         VALIDATION ERRORS
    ====================================================== --}}

    @if($errors->any())

        <div class="conversation-alert error">

            <i class="fa-solid fa-circle-exclamation"></i>

            <div>

                <strong>
                    {{ __('digital_studio.conversations.create.check_following') }}
                </strong>

                <ul style="margin: 8px 0 0; padding-left: 18px;">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        </div>

    @endif


    {{-- =====================================================
         SUCCESS
    ====================================================== --}}

    @if(session('success'))

        <div class="conversation-alert success">

            <i class="fa-solid fa-circle-check"></i>

            <span>
                {{ session('success') }}
            </span>

        </div>

    @endif


    {{-- =====================================================
         ERROR
    ====================================================== --}}

    @if(session('error'))

        <div class="conversation-alert error">

            <i class="fa-solid fa-circle-exclamation"></i>

            <span>
                {{ session('error') }}
            </span>

        </div>

    @endif


    {{-- =====================================================
         FORM CARD
    ====================================================== --}}

    <div class="conversation-form-card" style="background-color: #101f37">

        <form
            action="{{ route('conversations.store') }}"
            method="POST"
        >

            @csrf


            {{-- =================================================
                 SUBJECT
            ================================================== --}}

            <div class="conversation-form-group">

                <label
                    for="subject"
                    class="conversation-form-label"
                >
                    {{ __('digital_studio.conversations.create.subject') }}
                </label>

                <input
                    type="text"
                    id="subject"
                    name="subject"
                    class="conversation-form-input"
                    value="{{ old('subject') }}"
                    placeholder="{{ __('digital_studio.conversations.create.subject_placeholder') }}"
                    maxlength="255"
                    required
                    autofocus
                >

                @error('subject')

                    <div
                        class="conversation-alert error"
                        style="margin-top: 10px; margin-bottom: 0;"
                    >

                        <i class="fa-solid fa-circle-exclamation"></i>

                        <span>
                            {{ $message }}
                        </span>

                    </div>

                @enderror

            </div>


            {{-- =================================================
                 MESSAGE
            ================================================== --}}

            <div class="conversation-form-group">

                <label
                    for="message"
                    class="conversation-form-label"
                >
                    {{ __('digital_studio.conversations.create.message') }}
                </label>

                <textarea
                    id="message"
                    name="message"
                    class="conversation-form-textarea"
                    rows="9"
                    maxlength="10000"
                    placeholder="{{ __('digital_studio.conversations.create.message_placeholder') }}"
                    required
                >{{ old('message') }}</textarea>


                @error('message')

                    <div
                        class="conversation-alert error"
                        style="margin-top: 10px; margin-bottom: 0;"
                    >

                        <i class="fa-solid fa-circle-exclamation"></i>

                        <span>
                            {{ $message }}
                        </span>

                    </div>

                @enderror


                <div
                    style="
                        display:flex;
                        justify-content:flex-end;
                        margin-top:8px;
                        color:#64748b;
                        font-size:12px;
                    "
                >
                    {{ __('digital_studio.conversations.create.max_characters') }}
                </div>

            </div>


            {{-- =================================================
                 INFORMATION
            ================================================== --}}

            <div
                class="conversation-alert"
                style="
                    margin-top: 5px;
                    margin-bottom: 0;
                    color:#cbd5e1;
                    background:rgba(79,140,255,0.055);
                    border:1px solid rgba(79,140,255,0.14);
                "
            >

                <i
                    class="fa-solid fa-headset"
                    style="
                        color:var(--conversation-primary);
                        font-size:18px;
                    "
                ></i>

                <div>

                    <strong
                        style="
                            display:block;
                            color:#f8fafc;
                            margin-bottom:4px;
                        "
                    >
                        {{ __('digital_studio.conversations.create.support_title') }}
                    </strong>

                    <span
                        style="
                            color:var(--conversation-muted);
                            line-height:1.7;
                        "
                    >
                        {{ __('digital_studio.conversations.create.support_description') }}
                    </span>

                </div>

            </div>


            {{-- =================================================
                 ACTIONS
            ================================================== --}}

            <div class="conversation-form-actions">

                <a
                    href="{{ route('conversations.index') }}"
                    class="conversation-back-btn"
                >

                    <i class="fa-solid fa-arrow-left"></i>

                    <span>
                        {{ __('digital_studio.conversations.create.cancel') }}
                    </span>

                </a>


                <button
                    type="submit"
                    class="new-conversation-btn"
                    style="border:0; cursor:pointer;"
                >

                    <i class="fa-regular fa-paper-plane"></i>

                    <span>
                        {{ __('digital_studio.conversations.create.send_message') }}
                    </span>

                </button>

            </div>

        </form>

    </div>

</div>

</div>

@include('tech.sections.footer')

@endsection
