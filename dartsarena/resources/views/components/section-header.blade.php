{{--
    Section Header - Header with accent bar

    @param string $title - Section title
    @param string $accentColor - Accent bar color (primary|accent|secondary)
    @param bool $withBorder - Show bottom border (default: true)
    @param string $spacing - Bottom spacing (default: mb-6)

    Usage:
    <x-section-header title="{{ __('Latest News') }}" />

    <x-section-header title="{{ __('Rankings') }}" accentColor="accent" />

    <x-section-header title="{{ __('Results') }}">
        <x-slot:actions>
            <x-link-arrow href="{{ route('results.index') }}">
                {{ __('View All') }}
            </x-link-arrow>
        </x-slot:actions>
    </x-section-header>
--}}

@props([
    'title' => '',
    'accentColor' => 'primary',
    'withBorder' => true,
    'spacing' => 'mb-6',
])

@php
$accentClass = match($accentColor) {
    'accent' => 'bg-accent',
    'secondary' => 'bg-secondary',
    default => 'bg-primary',
};

$borderClass = $withBorder ? 'pb-4 border-b border-border' : '';
@endphp

<div {{ $attributes->merge(['class' => "flex items-center justify-between gap-3 {$spacing} {$borderClass}"]) }}>
    <div class="flex items-center gap-3">
        <div class="w-1 h-8 {{ $accentClass }}"></div>
        <h2 class="font-display text-2xl font-bold tracking-tight">
            {{ $title }}
        </h2>
    </div>

    @isset($actions)
        <div class="flex items-center gap-2">
            {{ $actions }}
        </div>
    @endisset
</div>
