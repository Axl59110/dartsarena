{{--
    Link with Arrow - Animated link with arrow icon

    @param string $href - Link URL
    @param string $size - Text size (sm|base|lg)
    @param string $color - Text color class (default: text-primary)

    Usage:
    <x-link-arrow href="{{ route('articles.index') }}">
        {{ __('View All Articles') }}
    </x-link-arrow>

    <x-link-arrow href="#" size="sm">
        {{ __('Read more') }}
    </x-link-arrow>
--}}

@props([
    'href' => '#',
    'size' => 'base',
    'color' => 'text-primary',
])

@php
$sizeClasses = match($size) {
    'sm' => 'text-sm',
    'lg' => 'text-lg',
    default => 'text-base',
};

$iconSize = match($size) {
    'sm' => 'w-3.5 h-3.5',
    'lg' => 'w-5 h-5',
    default => 'w-4 h-4',
};
@endphp

<a
    href="{{ $href }}"
    {{ $attributes->merge(['class' => "{$color} {$sizeClasses} font-semibold hover:text-primary-hover flex items-center gap-1 group transition-colors"]) }}
>
    {{ $slot }}
    <svg
        class="{{ $iconSize }} group-hover:translate-x-1 transition-transform"
        fill="none"
        stroke="currentColor"
        viewBox="0 0 24 24"
        aria-hidden="true"
    >
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
    </svg>
</a>
