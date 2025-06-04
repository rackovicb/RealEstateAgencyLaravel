@props(['href', 'active' => false])

@php
    $classes = $active
    ? 'px-3 py-2 rounded-md text-sm font-semibold text-red-600'
    : 'px-3 py-2 rounded-md text-sm font-medium text-white hover:text-red-400';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
