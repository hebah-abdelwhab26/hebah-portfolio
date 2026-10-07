@props([
    'class' => '',
])

<div {{ $attributes->merge([
    'class' => 'glass glass-premium glass-border '.$class
]) }}>

    {{ $slot }}

</div>
