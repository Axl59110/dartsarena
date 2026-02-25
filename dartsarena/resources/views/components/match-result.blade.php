{{--
    Match Result Component - Display match result with winner/loser and score

    @param string $competition - Competition name
    @param string $status - Match status (finished|live|upcoming)
    @param string $player1Name - Player 1 name
    @param string $player2Name - Player 2 name
    @param int $player1Score - Player 1 score
    @param int $player2Score - Player 2 score
    @param string|null $player1Subtitle - Player 1 subtitle (e.g., "Winner")
    @param string|null $player2Subtitle - Player 2 subtitle (e.g., "Runner-up")
    @param string|null $date - Match date
    @param string|null $href - Link URL

    Usage:
    <x-match-result
        competition="PDC World Championship"
        status="finished"
        player1Name="Luke Humphries"
        player2Name="Luke Littler"
        :player1Score="7"
        :player2Score="4"
        player1Subtitle="{{ __('Winner') }}"
        player2Subtitle="{{ __('Runner-up') }}"
        date="2024-01-03"
        href="{{ route('matches.show', $match) }}"
    />
--}}

@props([
    'competition' => '',
    'status' => 'finished',
    'player1Name' => '',
    'player2Name' => '',
    'player1Score' => 0,
    'player2Score' => 0,
    'player1Subtitle' => null,
    'player2Subtitle' => null,
    'date' => null,
    'href' => null,
])

@php
$containerTag = $href ? 'a' : 'div';
$containerClasses = $href
    ? 'hover:border-primary transition-all cursor-pointer'
    : '';

$winner = $player1Score > $player2Score ? 1 : 2;
@endphp

<{{ $containerTag }}
    @if($href) href="{{ $href }}" @endif
    {{ $attributes->merge(['class' => "bg-card border border-card-border rounded-[var(--radius-base)] overflow-hidden {$containerClasses}"]) }}
>
    {{-- Header --}}
    <div class="px-4 py-2 bg-muted/50 border-b border-border flex items-center justify-between gap-3">
        <span class="text-sm font-bold truncate">{{ $competition }}</span>

        <div class="flex items-center gap-2 flex-shrink-0">
            @if($date)
                <span class="text-xs text-muted-foreground">{{ $date }}</span>
            @endif
            <x-badge-status :status="$status">
                {{ __($status) }}
            </x-badge-status>
        </div>
    </div>

    {{-- Match Result --}}
    <div class="p-4">
        <div class="flex items-center justify-between gap-4">
            {{-- Player 1 --}}
            <div class="flex-1 min-w-0">
                <p class="font-display font-bold {{ $winner === 1 ? 'text-foreground' : 'text-muted-foreground' }} truncate">
                    {{ $player1Name }}
                </p>
                @if($player1Subtitle)
                    <p class="text-xs font-semibold {{ $winner === 1 ? 'text-success' : 'text-muted-foreground' }}">
                        {{ $player1Subtitle }}
                    </p>
                @endif
            </div>

            {{-- Score --}}
            <div class="flex items-center gap-2 flex-shrink-0">
                <span class="font-display font-bold {{ $winner === 1 ? 'text-4xl text-primary' : 'text-3xl text-muted-foreground' }}">
                    {{ $player1Score }}
                </span>
                <span class="text-xl text-muted-foreground">-</span>
                <span class="font-display font-bold {{ $winner === 2 ? 'text-4xl text-primary' : 'text-3xl text-muted-foreground' }}">
                    {{ $player2Score }}
                </span>
            </div>

            {{-- Player 2 --}}
            <div class="flex-1 text-right min-w-0">
                <p class="font-display font-bold {{ $winner === 2 ? 'text-foreground' : 'text-muted-foreground' }} truncate">
                    {{ $player2Name }}
                </p>
                @if($player2Subtitle)
                    <p class="text-xs font-semibold {{ $winner === 2 ? 'text-success' : 'text-muted-foreground' }}">
                        {{ $player2Subtitle }}
                    </p>
                @endif
            </div>
        </div>
    </div>
</{{ $containerTag }}>
