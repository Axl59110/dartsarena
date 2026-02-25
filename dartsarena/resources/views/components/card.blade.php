{{--
    Card Component - Standard Card Container

    @param string $variant - Card variant (default|interactive|dark)
    @param string $padding - Padding override (default: p-6)
    @param string $shadow - Shadow variant (default: shadow-sm)

    Usage:
    <x-card>
        <h3 class="font-display text-xl font-bold mb-4">Title</h3>
        <p class="text-muted-foreground">Content</p>
    </x-card>

    <x-card variant="interactive">
        Interactive card with hover effects
    </x-card>

    <x-card variant="dark">
        Dark sidebar card
    </x-card>
--}}

@props([
    'variant' => 'default', // default, interactive, dark
    'padding' => 'p-6',
    'shadow' => 'shadow-sm',
])

@php
$classes = match($variant) {
    'dark' => 'bg-darker text-white shadow-lg',
    'interactive' => 'bg-card hover:border-primary hover:shadow-md transition-all group cursor-pointer',
    default => 'bg-card shadow-sm',
};

$borderClasses = $variant === 'dark' ? '' : 'border border-card-border';
@endphp

<div {{ $attributes->merge(['class' => "rounded-[var(--radius-base)] {$borderClasses} {$padding} {$shadow} {$classes}"]) }}>
    {{ $slot }}
</div>
