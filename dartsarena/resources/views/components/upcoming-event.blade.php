{{--
    Upcoming Event Component - Display upcoming event with date box

    @param string $title - Event title
    @param string $venue - Event venue/location
    @param string $date - Event date (Carbon instance or string)
    @param string $day - Day number (e.g., "15")
    @param string $month - Month abbreviation (e.g., "Mar")
    @param string|null $href - Link URL

    Usage:
    <x-upcoming-event
        title="PDC World Championship"
        venue="Alexandra Palace, London"
        :date="$event->start_date"
        day="15"
        month="Dec"
        href="{{ route('events.show', $event) }}"
    />
--}}

@props([
    'title' => '',
    'venue' => '',
    'date' => null,
    'day' => '',
    'month' => '',
    'href' => null,
])

@php
$containerTag = $href ? 'a' : 'div';
$containerClasses = $href
    ? 'cursor-pointer'
    : '';
@endphp

<{{ $containerTag }}
    @if($href) href="{{ $href }}" @endif
    {{ $attributes->merge(['class' => "flex gap-3 pb-3 border-b border-white/10 last:border-0 hover:bg-white/5 -mx-2 px-3 py-2 rounded-[var(--radius-base)] transition-colors {$containerClasses}"]) }}
>
    {{-- Date Box --}}
    <div class="flex-shrink-0 text-center bg-primary rounded-[var(--radius-base)] p-2 min-w-[48px]">
        <div class="text-xs font-bold text-white uppercase">{{ $month }}</div>
        <div class="text-xl font-display font-black text-white leading-none">{{ $day }}</div>
    </div>

    {{-- Event Details --}}
    <div class="flex-1 min-w-0">
        <h4 class="font-display font-bold text-sm text-white line-clamp-2 mb-0.5">
            {{ $title }}
        </h4>
        <p class="text-xs text-white/85">
            {{ $venue }}
        </p>
    </div>
</{{ $containerTag }}>
