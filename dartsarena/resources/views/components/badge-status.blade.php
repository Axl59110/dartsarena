{{--
    Status Badge - Badge for status indicators

    @param string $status - Status variant (success|warning|danger|info|finished|live|upcoming)
    @param string $size - Badge size (sm|md|lg)

    Usage:
    <x-badge-status status="success">
        {{ __('Winner') }}
    </x-badge-status>

    <x-badge-status status="live">
        {{ __('Live') }}
    </x-badge-status>

    <x-badge-status status="finished">
        {{ __('Finished') }}
    </x-badge-status>
--}}

@props([
    'status' => 'info',
    'size' => 'md',
])

@php
$baseClasses = 'inline-flex items-center justify-center font-semibold rounded-[var(--radius-base)]';

$statusClasses = match($status) {
    'success', 'winner', 'finished' => 'bg-success/10 text-success',
    'warning', 'upcoming' => 'bg-warning/10 text-warning',
    'danger', 'error' => 'bg-danger/10 text-danger',
    'live' => 'bg-primary/10 text-primary animate-pulse',
    default => 'bg-info/10 text-info',
};

$sizeClasses = match($size) {
    'sm' => 'px-1.5 py-0.5 text-[10px]',
    'lg' => 'px-3 py-1.5 text-sm',
    default => 'px-2 py-1 text-xs',
};
@endphp

<span {{ $attributes->merge(['class' => "{$baseClasses} {$statusClasses} {$sizeClasses}"]) }}>
    {{ $slot }}
</span>
