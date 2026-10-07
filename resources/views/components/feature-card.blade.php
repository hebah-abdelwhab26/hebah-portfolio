@props([
    'icon',
    'title',
    'description'
])

<x-glass-card class="feature-card">

    <div class="feature-card__icon">

        <i class="{{ $icon }}"></i>

    </div>

    <h3>

        {{ $title }}

    </h3>

    <p>

        {{ $description }}

    </p>

</x-glass-card>
