{{--
    Colored Section Header - Header with colored background and emoji

    @param string $title - Header title
    @param string|null $emoji - Optional emoji icon
    @param string $bgColor - Background color (primary|accent|warning|info|success|secondary)

    Usage:
    <x-section-header-colored
        title="{{ __('Top Tournaments') }}"
        emoji="🏆"
        bgColor="primary"
    />

    <x-section-header-colored
        title="{{ __('Live Scores') }}"
        emoji="⚡"
        bgColor="accent"
    />
--}}

@props([
    'title' => '',
    'emoji' => null,
    'bgColor' => 'primary',
])

@php
$bgClass = match($bgColor) {
    'accent' => 'bg-accent/5',
    'warning' => 'bg-warning/5',
    'info' => 'bg-info/5',
    'success' => 'bg-success/5',
    'secondary' => 'bg-secondary/5',
    default => 'bg-primary/5',
};
@endphp

<div {{ $attributes->merge(['class' => "{$bgClass} border-b border-card-border px-6 py-4"]) }}>
    <h3 class="font-display text-lg font-bold text-foreground flex items-center gap-2">
        @if($emoji)
            <span class="text-2xl" aria-hidden="true">{{ $emoji }}</span>
        @endif
        {{ $title }}
    </h3>
</div>
