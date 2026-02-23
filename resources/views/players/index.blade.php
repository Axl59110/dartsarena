@extends('layouts.app')

@section('title', __('Joueurs de Fléchettes') . ' - DartsArena')

@section('content')
    <section class="hero">
        <div class="container hero-content">
            <h1 class="animate-in">{{ __('Joueurs') }}</h1>
            <p class="animate-in" style="animation-delay: 0.1s;">{{ __('Les meilleurs joueurs de fléchettes du monde.') }}</p>
        </div>
    </section>

    <div class="container">
        <div class="players-grid">
            @foreach($players as $index => $player)
                <a href="{{ route('players.show', $player->slug) }}"
                   class="player-card animate-in"
                   style="animation-delay: {{ $index * 0.04 }}s;">
                    <div class="player-card-bg"></div>
                    <div class="player-avatar">
                        <span class="player-icon">🎯</span>
                    </div>
                    <div class="player-content">
                        <h3 class="player-name">{{ $player->full_name }}</h3>
                        @if($player->nickname)
                            <p class="player-nickname">"{{ $player->nickname }}"</p>
                        @endif
                        <p class="player-nationality">
                            <span class="flag-icon">🌍</span>
                            {{ $player->nationality }}
                        </p>
                    </div>
                    <div class="player-arrow">→</div>
                </a>
            @endforeach
        </div>
    </div>

    <style>
        .players-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.5rem;
        }

        .player-card {
            background: var(--da-card);
            border: 1px solid var(--da-border);
            border-radius: 1rem;
            padding: 2rem 1.75rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .player-card-bg {
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 50% 0%, rgba(225, 29, 72, 0.08), transparent 70%);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .player-card:hover .player-card-bg {
            opacity: 1;
        }

        .player-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--da-gradient-1);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .player-card:hover {
            transform: translateY(-8px);
            border-color: var(--da-primary);
            box-shadow: 0 20px 60px rgba(225, 29, 72, 0.3);
        }

        .player-card:hover::before {
            transform: scaleX(1);
        }

        .player-avatar {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #1A1A1A, #262626);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            border: 3px solid transparent;
            position: relative;
            transition: all 0.4s ease;
        }

        .player-avatar::before {
            content: '';
            position: absolute;
            inset: -3px;
            background: var(--da-gradient-1);
            border-radius: 50%;
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: -1;
        }

        .player-card:hover .player-avatar::before {
            opacity: 1;
        }

        .player-card:hover .player-avatar {
            transform: scale(1.1) rotate(-5deg);
        }

        .player-icon {
            font-size: 3rem;
            filter: drop-shadow(0 4px 15px rgba(225, 29, 72, 0.4));
        }

        .player-content {
            flex: 1;
            position: relative;
            z-index: 1;
        }

        .player-name {
            font-family: 'Bebas Neue', cursive;
            font-size: 1.65rem;
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
            color: white;
            line-height: 1.2;
        }

        .player-nickname {
            color: var(--da-primary);
            font-size: 1rem;
            font-style: italic;
            font-weight: 500;
            margin-bottom: 0.75rem;
        }

        .player-nationality {
            color: var(--da-text-muted);
            font-size: 0.95rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .flag-icon {
            font-size: 1.1rem;
        }

        .player-arrow {
            margin-top: 1.25rem;
            font-size: 1.5rem;
            color: var(--da-primary);
            transform: translateX(0);
            transition: transform 0.4s ease;
        }

        .player-card:hover .player-arrow {
            transform: translateX(8px);
        }

        @media (max-width: 768px) {
            .players-grid {
                grid-template-columns: 1fr;
                gap: 1.25rem;
            }
        }
    </style>
@endsection
