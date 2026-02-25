{{--
    Category Badge - Badge for article categories

    @param string $category - Category name (results|interview|analysis|news|tournament)
    @param string $position - Badge position (default|overlay)

    Usage:
    <x-badge-category category="results">
        {{ __('Results') }}
    </x-badge-category>

    <x-badge-category category="interview" position="overlay">
        {{ __('Interview') }}
    </x-badge-category>
--}}

@props([
    'category' => 'news',
    'position' => 'default',
])

@php
$baseClasses = 'inline-flex items-center justify-center px-2 py-1 text-xs font-bold rounded-[var(--radius-base)]';

$categoryClasses = match($category) {
    'results', 'result' => 'text-primary',
    'interview' => 'text-warning',
    'analysis' => 'text-info',
    'tournament' => 'text-accent',
    default => 'text-secondary',
};

$bgClasses = $position === 'overlay'
    ? 'bg-white/90 backdrop-blur-sm'
    : 'bg-white border border-card-border';
@endphp

<span {{ $attributes->merge(['class' => "{$baseClasses} {$categoryClasses} {$bgClasses}"]) }}>
    {{ $slot }}
</span>
