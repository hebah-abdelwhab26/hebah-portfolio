@props([
    'badge' => '',
    'title' => '',
    'description' => '',
    'align' => 'right',
    'icon' => 'fa-solid fa-star'
])

<div class="section-header {{ $align }}">

    @if($badge)
        <div class="section-header__badge">
            <i class="{{ $icon }}"></i>
            <span>{{ $badge }}</span>
        </div>
    @endif

    <h2 class="section-header__title">
        {!! $title !!}
    </h2>

    @if($description)
        <p class="section-header__description">
            {{ $description }}
        </p>
    @endif

    <div class="section-header__line"></div>

</div>
