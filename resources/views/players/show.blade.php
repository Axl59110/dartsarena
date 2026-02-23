@extends('layouts.app')

@section('title', $player->full_name . ' - DartsArena')

@section('breadcrumbs')
    <div class="breadcrumbs">
        <a href="{{ route('home') }}">{{ __('Accueil') }}</a>
        <span class="separator">/</span>
        <a href="{{ route('players.index') }}">{{ __('Joueurs') }}</a>
        <span class="separator">/</span>
        <span>{{ $player->full_name }}</span>
    </div>
@endsection

@section('content')
    <!-- Player Hero -->
    <section class="player-hero">
        <div class="container">
            <div class="player-hero-content">
                <div class="player-hero-avatar">
                    <div class="player-hero-icon">🎯</div>
                    @if($latestRanking)
                        <div class="player-rank-badge">
                            #{{ $latestRanking->position }}
                        </div>
                    @endif
                </div>
                <div class="player-hero-info">
                    <h1 class="player-hero-name">{{ $player->full_name }}</h1>
                    @if($player->nickname)
                        <p class="player-hero-nickname">"{{ $player->nickname }}"</p>
                    @endif
                    <div class="player-hero-meta">
                        <span class="meta-item">
                            <span class="meta-icon">🌍</span>
                            {{ $player->nationality }}
                        </span>
                        @if($player->date_of_birth)
                            <span class="meta-separator">•</span>
                            <span class="meta-item">
                                <span class="meta-icon">🎂</span>
                                {{ $player->date_of_birth->format('d/m/Y') }}
                                ({{ $player->date_of_birth->age }} {{ __('ans') }})
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container player-details">
        <!-- Stats Grid -->
        <div class="stats-grid">
            @if($latestRanking)
                <div class="stat-card featured">
                    <div class="stat-icon">🏆</div>
                    <div class="stat-value">#{{ $latestRanking->position }}</div>
                    <div class="stat-label">{{ __('Classement Actuel') }}</div>
                </div>
            @endif

            @if($player->career_titles > 0)
                <div class="stat-card">
                    <div class="stat-icon">🏅</div>
                    <div class="stat-value">{{ $player->career_titles }}</div>
                    <div class="stat-label">{{ __('Titres en Carrière') }}</div>
                </div>
            @endif

            @if($player->career_9darters > 0)
                <div class="stat-card">
                    <div class="stat-icon">🎯</div>
                    <div class="stat-value">{{ $player->career_9darters }}</div>
                    <div class="stat-label">{{ __('9-Darters') }}</div>
                </div>
            @endif

            @if($player->career_highest_average)
                <div class="stat-card">
                    <div class="stat-icon">📈</div>
                    <div class="stat-value">{{ $player->career_highest_average }}</div>
                    <div class="stat-label">{{ __('Meilleure Moyenne') }}</div>
                </div>
            @endif
        </div>

        <!-- Bio Section -->
        @if($player->bio)
            <div class="bio-section">
                <h2 class="section-title">
                    <span class="icon">📖</span>
                    {{ __('Biographie') }}
                </h2>
                <div class="bio-card">
                    <p class="bio-text">{{ $player->bio }}</p>
                </div>
            </div>
        @endif

        <!-- Back Button -->
        <div class="back-button-container">
            <a href="{{ route('players.index') }}" class="back-button">
                <span class="back-arrow">←</span>
                {{ __('Retour aux joueurs') }}
            </a>
        </div>
    </div>

    <style>
        .player-hero {
            background: linear-gradient(135deg, #0A0A0A 0%, #1A1A1A 50%, #0A0A0A 100%);
            padding: 4rem 0 3rem;
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
        }

        .player-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 50%, rgba(225, 29, 72, 0.2), transparent 50%),
                        radial-gradient(circle at 80% 50%, rgba(251, 191, 36, 0.12), transparent 50%);
            pointer-events: none;
        }

        .player-hero::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--da-primary), var(--da-accent), transparent);
        }

        .player-hero-content {
            display: flex;
            align-items: center;
            gap: 2.5rem;
            position: relative;
            z-index: 1;
        }

        .player-hero-avatar {
            width: 150px;
            height: 150px;
            background: linear-gradient(135deg, #1A1A1A, #262626);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 4px solid transparent;
            background-clip: padding-box;
            position: relative;
            flex-shrink: 0;
        }

        .player-hero-avatar::before {
            content: '';
            position: absolute;
            inset: -4px;
            background: var(--da-gradient-1);
            border-radius: 50%;
            z-index: -1;
        }

        .player-hero-icon {
            font-size: 5rem;
            filter: drop-shadow(0 8px 25px rgba(225, 29, 72, 0.6));
        }

        .player-rank-badge {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 50px;
            height: 50px;
            background: var(--da-gradient-1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Bebas Neue', cursive;
            font-size: 1.25rem;
            font-weight: 700;
            color: white;
            border: 3px solid #0A0A0A;
            box-shadow: 0 4px 15px rgba(225, 29, 72, 0.6);
        }

        .player-hero-info {
            flex: 1;
        }

        .player-hero-name {
            font-family: 'Bebas Neue', cursive;
            font-size: 3.5rem;
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
            line-height: 1;
            background: linear-gradient(135deg, #FAFAFA 0%, var(--da-primary-light) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .player-hero-nickname {
            color: var(--da-primary);
            font-size: 1.5rem;
            font-style: italic;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .player-hero-meta {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: var(--da-text-muted);
            font-size: 1.05rem;
            font-weight: 500;
            flex-wrap: wrap;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .meta-icon {
            font-size: 1.25rem;
        }

        .meta-separator {
            opacity: 0.4;
        }

        .player-details {
            max-width: 1200px;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            background: var(--da-card);
            border: 1px solid var(--da-border);
            border-radius: 1rem;
            padding: 2rem 1.5rem;
            text-align: center;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
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

        .stat-card:hover {
            transform: translateY(-4px);
            border-color: var(--da-primary);
            box-shadow: 0 12px 40px rgba(225, 29, 72, 0.25);
        }

        .stat-card:hover::before {
            transform: scaleX(1);
        }

        .stat-card.featured {
            background: linear-gradient(135deg, var(--da-card) 0%, #262626 100%);
            border-color: var(--da-primary);
        }

        .stat-card.featured::before {
            transform: scaleX(1);
        }

        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            filter: drop-shadow(0 4px 12px rgba(225, 29, 72, 0.3));
        }

        .stat-value {
            font-family: 'Bebas Neue', cursive;
            font-size: 3rem;
            letter-spacing: 0.05em;
            line-height: 1;
            background: var(--da-gradient-1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.75rem;
        }

        .stat-label {
            color: var(--da-text-muted);
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        /* Bio Section */
        .bio-section {
            margin-bottom: 3rem;
        }

        .bio-card {
            background: var(--da-card);
            border: 1px solid var(--da-border);
            border-radius: 1rem;
            padding: 2.5rem;
        }

        .bio-text {
            font-size: 1.1rem;
            line-height: 1.9;
            color: var(--da-text);
        }

        /* Back Button */
        .back-button-container {
            text-align: center;
            margin-top: 3rem;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 2rem;
            background: var(--da-card);
            border: 1px solid var(--da-border);
            border-radius: 0.75rem;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            background: var(--da-card-hover);
            border-color: var(--da-primary);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(225, 29, 72, 0.2);
        }

        .back-arrow {
            font-size: 1.25rem;
            transition: transform 0.3s ease;
        }

        .back-button:hover .back-arrow {
            transform: translateX(-4px);
        }

        @media (max-width: 768px) {
            .player-hero {
                padding: 3rem 0 2rem;
            }

            .player-hero-content {
                flex-direction: column;
                text-align: center;
                gap: 1.5rem;
            }

            .player-hero-avatar {
                width: 120px;
                height: 120px;
            }

            .player-hero-icon {
                font-size: 4rem;
            }

            .player-hero-name {
                font-size: 2.5rem;
            }

            .player-hero-nickname {
                font-size: 1.2rem;
            }

            .player-hero-meta {
                justify-content: center;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                gap: 1.25rem;
            }

            .bio-card {
                padding: 2rem 1.5rem;
            }
        }
    </style>
@endsection
