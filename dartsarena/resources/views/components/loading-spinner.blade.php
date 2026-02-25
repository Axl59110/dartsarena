{{--
    Loading Spinner Component - Animated loading indicator

    @param string $size - Spinner size (sm|md|lg)
    @param string $text - Optional loading text
    @param bool $inline - Display inline (default: false)

    Usage:
    <x-loading-spinner />

    <x-loading-spinner size="lg" text="{{ __('Loading...') }}" />

    <x-loading-spinner size="sm" :inline="true" />

    With Alpine.js:
    <div x-show="isLoading">
        <x-loading-spinner text="{{ __('Loading articles...') }}" />
    </div>
--}}

@props([
    'size' => 'md',
    'text' => null,
    'inline' => false,
])

@php
$sizeClasses = match($size) {
    'sm' => 'h-4 w-4',
    'lg' => 'h-8 w-8',
    default => 'h-5 w-5',
};

$textSize = match($size) {
    'sm' => 'text-xs',
    'lg' => 'text-base',
    default => 'text-sm',
};

$containerClasses = $inline
    ? 'inline-flex items-center gap-2'
    : 'flex items-center justify-center gap-2';
@endphp

<div {{ $attributes->merge(['class' => "{$containerClasses} text-muted-foreground"]) }}>
    <svg
        class="animate-spin {{ $sizeClasses }}"
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        aria-hidden="true"
    >
        <circle
            class="opacity-25"
            cx="12"
            cy="12"
            r="10"
            stroke="currentColor"
            stroke-width="4"
        ></circle>
        <path
            class="opacity-75"
            fill="currentColor"
            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
        ></path>
    </svg>

    @if($text)
        <span class="font-medium {{ $textSize }}">{{ $text }}</span>
    @endif
</div>
