@props([
    'number',
    'title',
    'icon'
])

<x-glass-card class="stat-card">

    <div class="stat-card__icon">

        <i class="{{ $icon }}"></i>

    </div>

    <h3 class="stat-card__number">

        {{ $number }}

    </h3>

    <p class="stat-card__title">

        {{ $title }}

    </p>

</x-glass-card>
