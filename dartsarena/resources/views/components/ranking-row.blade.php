{{--
    Ranking Row Component - Display player ranking with movement indicator

    @param int $position - Player position in ranking
    @param string $playerName - Player name
    @param string|null $playerNationality - Player nationality code
    @param string|null $movement - Movement direction (up|down|same|null)
    @param string|null $href - Link URL
    @param string|null $avatar - Optional player avatar URL

    Usage:
    <x-ranking-row
        :position="1"
        playerName="Luke Humphries"
        playerNationality="ENG"
        movement="up"
        href="{{ route('players.show', $player) }}"
    />

    <x-ranking-row
        :position="2"
        playerName="Michael van Gerwen"
        playerNationality="NED"
        movement="down"
    />
--}}

@props([
    'position' => 0,
    'playerName' => '',
    'playerNationality' => null,
    'movement' => null,
    'href' => null,
    'avatar' => null,
])

@php
$containerTag = $href ? 'a' : 'div';
$containerClasses = $href
    ? 'cursor-pointer'
    : '';
@endphp

<{{ $containerTag }}
    @if($href) href="{{ $href }}" @endif
    {{ $attributes->merge(['class' => "flex items-center gap-3 py-2 px-3 hover:bg-white/5 border-l-2 border-transparent hover:border-accent transition-all group -mx-3 rounded-[var(--radius-base)] {$containerClasses}"]) }}
>
    {{-- Position Badge --}}
    <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center bg-accent/20 rounded-[var(--radius-base)] font-display text-sm font-bold text-accent">
        {{ $position }}
    </div>

    {{-- Player Avatar (optional) --}}
    @if($avatar)
        <div class="flex-shrink-0 w-10 h-10 rounded-[var(--radius-base)] overflow-hidden bg-muted">
            <img src="{{ $avatar }}" alt="{{ $playerName }}" class="w-full h-full object-cover" loading="lazy" />
        </div>
    @endif

    {{-- Player Info --}}
    <div class="flex-1 min-w-0">
        <p class="font-display font-bold text-sm text-white group-hover:text-accent transition-colors truncate">
            {{ $playerName }}
        </p>
        @if($playerNationality)
            <p class="text-xs text-white/80 font-semibold uppercase">
                {{ $playerNationality }}
            </p>
        @endif
    </div>

    {{-- Movement Indicator --}}
    @if($movement === 'up')
        <svg class="w-4 h-4 text-success flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-label="Moving up">
            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
        </svg>
    @elseif($movement === 'down')
        <svg class="w-4 h-4 text-danger flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" aria-label="Moving down">
            <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd" />
        </svg>
    @elseif($movement === 'same')
        <span class="w-4 h-0.5 bg-white/30 flex-shrink-0" aria-label="No change"></span>
    @endif
</{{ $containerTag }}>
