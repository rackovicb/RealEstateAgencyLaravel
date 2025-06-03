@props(['href', 'active' => false])

@php
    $classes = $active
        ? 'px-3 py-2 rounded-md text-sm font-semibold text-blue-600 bg-blue-100'
        : 'px-3 py-2 rounded-md text-sm font-medium text-gray-600 hover:text-blue-600 hover:bg-blue-50';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
