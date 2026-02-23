@extends('layouts.app')

@section('title', __('Classements') . ' - DartsArena')

@section('content')
    <section class="hero">
        <div class="container hero-content">
            <h1 class="animate-in">{{ __('Classements') }}</h1>
            <p class="animate-in" style="animation-delay: 0.1s;">{{ __('Les classements officiels des joueurs par fédération.') }}</p>
        </div>
    </section>

    <div class="container">
        <!-- Federation Filter -->
        <div class="federation-filter">
            <form method="GET" action="{{ route('rankings.index') }}">
                <label class="filter-label">
                    {{ __('Fédération') }}
                </label>
                <select name="federation" onchange="this.form.submit()" class="federation-select">
                    @foreach($federations as $fed)
                        <option value="{{ $fed->slug }}" {{ $federation->slug === $fed->slug ? 'selected' : '' }}>
                            {{ $fed->name }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        <!-- Rankings Table -->
        @if($rankings->count() > 0)
            <div class="rankings-container">
                <div class="rankings-header">
                    <div class="rank-col">#</div>
                    <div class="player-col">{{ __('Joueur') }}</div>
                    <div class="prize-col">{{ __('Prize Money') }}</div>
                    <div class="evolution-col">{{ __('Évolution') }}</div>
                </div>

                <div class="rankings-body">
                    @foreach($rankings as $index => $ranking)
                        <a href="{{ route('players.show', $ranking->player->slug) }}"
                           class="ranking-row animate-in"
                           style="animation-delay: {{ $index * 0.03 }}s;">
                            <div class="rank-col">
                                <div class="rank-number {{ $ranking->position <= 3 ? 'top-' . $ranking->position : '' }}">
                                    {{ $ranking->position }}
                                </div>
                            </div>
                            <div class="player-col">
                                <div class="player-info">
                                    <div class="player-avatar-small">🎯</div>
                                    <div class="player-details">
                                        <div class="player-name">{{ $ranking->player->full_name }}</div>
                                        <div class="player-nationality">
                                            <span class="flag">🌍</span>
                                            {{ $ranking->player->nationality }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="prize-col">
                                <div class="prize-amount">${{ number_format($ranking->prize_money) }}</div>
                            </div>
                            <div class="evolution-col">
                                @if($ranking->previous_position && $ranking->previous_position > $ranking->position)
                                    <div class="evolution up">
                                        <span class="arrow">↑</span>
                                        <span class="value">{{ $ranking->previous_position - $ranking->position }}</span>
                                    </div>
                                @elseif($ranking->previous_position && $ranking->previous_position < $ranking->position)
                                    <div class="evolution down">
                                        <span class="arrow">↓</span>
                                        <span class="value">{{ $ranking->position - $ranking->previous_position }}</span>
                                    </div>
                                @else
                                    <div class="evolution stable">—</div>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @else
            <div class="card" style="text-align: center;">
                <p style="color: var(--da-text-muted);">
                    {{ __('Aucun classement disponible.') }}
                </p>
            </div>
        @endif
    </div>

    <style>
        .federation-filter {
            background: var(--da-card);
            border: 1px solid var(--da-border);
            border-radius: 1rem;
            padding: 2rem;
            margin-bottom: 2.5rem;
        }

        .filter-label {
            display: block;
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--da-text-muted);
            margin-bottom: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .federation-select {
            width: 100%;
            max-width: 400px;
            padding: 0.9rem 1.25rem;
            background: var(--da-darker);
            border: 1px solid var(--da-border);
            border-radius: 0.75rem;
            color: white;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .federation-select:hover {
            border-color: var(--da-primary);
            background: #1A1A1A;
        }

        .federation-select:focus {
            outline: none;
            border-color: var(--da-primary);
            box-shadow: 0 0 0 3px rgba(225, 29, 72, 0.1);
        }

        .rankings-container {
            background: var(--da-card);
            border: 1px solid var(--da-border);
            border-radius: 1rem;
            overflow: hidden;
        }

        .rankings-header {
            display: grid;
            grid-template-columns: 80px 1fr 180px 120px;
            gap: 1rem;
            padding: 1.25rem 1.5rem;
            background: var(--da-darker);
            border-bottom: 2px solid var(--da-border);
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--da-text-muted);
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .rankings-body {
            display: flex;
            flex-direction: column;
        }

        .ranking-row {
            display: grid;
            grid-template-columns: 80px 1fr 180px 120px;
            gap: 1rem;
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--da-border);
            transition: all 0.3s ease;
            position: relative;
        }

        .ranking-row::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: var(--da-gradient-1);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .ranking-row:hover {
            background: rgba(225, 29, 72, 0.05);
        }

        .ranking-row:hover::before {
            transform: scaleY(1);
        }

        .ranking-row:last-child {
            border-bottom: none;
        }

        .rank-col {
            display: flex;
            align-items: center;
        }

        .rank-number {
            font-family: 'Bebas Neue', cursive;
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--da-primary);
            letter-spacing: 0.05em;
        }

        .rank-number.top-1 {
            font-size: 2.25rem;
            background: linear-gradient(135deg, #FFD700, #FFA500);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 20px rgba(255, 215, 0, 0.3);
        }

        .rank-number.top-2 {
            font-size: 2rem;
            background: linear-gradient(135deg, #C0C0C0, #A8A8A8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .rank-number.top-3 {
            font-size: 1.9rem;
            background: linear-gradient(135deg, #CD7F32, #B8732B);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .player-col {
            display: flex;
            align-items: center;
        }

        .player-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .player-avatar-small {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #1A1A1A, #262626);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            border: 2px solid var(--da-border);
            flex-shrink: 0;
            transition: all 0.3s ease;
        }

        .ranking-row:hover .player-avatar-small {
            border-color: var(--da-primary);
            transform: scale(1.1);
        }

        .player-details {
            flex: 1;
        }

        .player-name {
            font-family: 'Bebas Neue', cursive;
            font-size: 1.25rem;
            letter-spacing: 0.03em;
            color: white;
            line-height: 1.2;
            margin-bottom: 0.15rem;
        }

        .player-nationality {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            color: var(--da-text-muted);
            font-size: 0.85rem;
            font-weight: 500;
        }

        .flag {
            font-size: 1rem;
        }

        .prize-col {
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .prize-amount {
            color: var(--da-accent);
            font-weight: 700;
            font-size: 1.05rem;
            font-family: 'Space Grotesk', monospace;
        }

        .evolution-col {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .evolution {
            display: flex;
            align-items: center;
            gap: 0.35rem;
            font-weight: 700;
            font-size: 0.95rem;
            padding: 0.4rem 0.85rem;
            border-radius: 0.5rem;
        }

        .evolution.up {
            color: #22C55E;
            background: rgba(34, 197, 94, 0.1);
        }

        .evolution.down {
            color: #EF4444;
            background: rgba(239, 68, 68, 0.1);
        }

        .evolution.stable {
            color: var(--da-text-muted);
        }

        .evolution .arrow {
            font-size: 1.15rem;
        }

        @media (max-width: 1024px) {
            .rankings-header,
            .ranking-row {
                grid-template-columns: 60px 1fr 140px 100px;
                gap: 0.75rem;
                padding: 1rem;
            }

            .rank-number {
                font-size: 1.5rem;
            }

            .rank-number.top-1 {
                font-size: 1.9rem;
            }

            .rank-number.top-2,
            .rank-number.top-3 {
                font-size: 1.7rem;
            }

            .player-name {
                font-size: 1.1rem;
            }

            .prize-amount {
                font-size: 0.95rem;
            }
        }

        @media (max-width: 768px) {
            .rankings-header {
                display: none;
            }

            .ranking-row {
                grid-template-columns: 1fr;
                gap: 1rem;
                padding: 1.5rem 1rem;
            }

            .rank-col {
                position: absolute;
                top: 1rem;
                right: 1rem;
            }

            .player-col {
                margin-top: 0.5rem;
            }

            .prize-col,
            .evolution-col {
                justify-content: flex-start;
            }

            .prize-col::before {
                content: 'Prize: ';
                color: var(--da-text-muted);
                margin-right: 0.5rem;
                font-size: 0.85rem;
            }
        }
    </style>
@endsection
