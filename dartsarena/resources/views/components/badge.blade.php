{{--
    Badge Component - Generic badge with variants

    @param string $variant - Badge variant (primary|secondary|accent|muted)
    @param string $size - Badge size (sm|md|lg)

    Usage:
    <x-badge variant="primary">
        {{ __('New') }}
    </x-badge>

    <x-badge variant="accent" size="lg">
        {{ __('Premium') }}
    </x-badge>
--}}

@props([
    'variant' => 'primary',
    'size' => 'md',
])

@php
$baseClasses = 'inline-flex items-center justify-center font-bold rounded-[var(--radius-base)]';

$variantClasses = match($variant) {
    'secondary' => 'bg-secondary/10 text-secondary',
    'accent' => 'bg-accent/10 text-accent',
    'muted' => 'bg-muted text-muted-foreground',
    default => 'bg-primary/10 text-primary',
};

$sizeClasses = match($size) {
    'sm' => 'px-1.5 py-0.5 text-[10px]',
    'lg' => 'px-3 py-1.5 text-sm',
    default => 'px-2 py-1 text-xs',
};
@endphp

<span {{ $attributes->merge(['class' => "{$baseClasses} {$variantClasses} {$sizeClasses}"]) }}>
    {{ $slot }}
</span>
