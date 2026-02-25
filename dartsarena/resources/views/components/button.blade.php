{{--
    Button Component - Reusable button with variants

    @param string $variant - Button variant (primary|secondary|outline|ghost)
    @param string $size - Button size (sm|md|lg)
    @param string $type - Button type (button|submit|reset)
    @param bool $disabled - Disabled state

    Usage:
    <x-button variant="primary" type="submit">
        {{ __('Submit') }}
    </x-button>

    <x-button variant="secondary" size="sm">
        {{ __('Cancel') }}
    </x-button>

    <x-button variant="outline" :disabled="true">
        {{ __('Disabled') }}
    </x-button>
--}}

@props([
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'button',
    'disabled' => false,
])

@php
$baseClasses = 'rounded-[var(--radius-base)] font-semibold transition-colors focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-primary/50 disabled:opacity-50 disabled:pointer-events-none inline-flex items-center justify-center gap-2';

$variantClasses = match($variant) {
    'secondary' => 'bg-muted text-foreground hover:bg-muted/80',
    'outline' => 'border-2 border-primary text-primary hover:bg-primary hover:text-primary-foreground',
    'ghost' => 'hover:bg-muted text-foreground',
    default => 'bg-primary text-primary-foreground hover:bg-primary-hover',
};

$sizeClasses = match($size) {
    'sm' => 'px-3 py-1.5 text-xs',
    'lg' => 'px-6 py-3 text-base',
    default => 'px-4 py-2 text-sm',
};
@endphp

<button
    type="{{ $type }}"
    {{ $attributes->merge(['class' => "{$baseClasses} {$variantClasses} {$sizeClasses}"]) }}
    @if($disabled) disabled @endif
>
    {{ $slot }}
</button>
