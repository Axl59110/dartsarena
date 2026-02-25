{{--
    Bullet Indicator Component - Animated bullet point

    @param string $color - Bullet color (primary|accent|success|warning|danger)
    @param string $size - Bullet size (sm|md|lg)
    @param bool $animate - Enable scale animation on hover (default: true)

    Usage:
    <x-bullet-indicator color="primary" />

    <x-bullet-indicator color="success" size="lg" />

    <a href="#" class="group flex items-center gap-2">
        <x-bullet-indicator />
        <span>Link text</span>
    </a>
--}}

@props([
    'color' => 'primary',
    'size' => 'md',
    'animate' => true,
])

@php
$colorClasses = match($color) {
    'accent' => 'bg-accent',
    'success' => 'bg-success',
    'warning' => 'bg-warning',
    'danger' => 'bg-danger',
    'secondary' => 'bg-secondary',
    'white' => 'bg-white',
    default => 'bg-primary',
};

$sizeClasses = match($size) {
    'sm' => 'w-1 h-1',
    'lg' => 'w-2 h-2',
    default => 'w-1.5 h-1.5',
};

$animateClasses = $animate
    ? 'group-hover:scale-125 transition-transform'
    : '';
@endphp

<span {{ $attributes->merge(['class' => "rounded-full flex-shrink-0 {$colorClasses} {$sizeClasses} {$animateClasses}"]) }} aria-hidden="true"></span>
