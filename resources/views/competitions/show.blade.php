@extends('layouts.app')

@section('title', $competition->name . ' - DartsArena')

@section('breadcrumbs')
    <div class="breadcrumbs">
        <a href="{{ route('home') }}">{{ __('Accueil') }}</a>
        <span class="separator">/</span>
        <a href="{{ route('competitions.index') }}">{{ __('Compétitions') }}</a>
        <span class="separator">/</span>
        <span>{{ $competition->name }}</span>
    </div>
@endsection

@section('content')
    <!-- Competition Hero -->
    <section class="competition-hero">
        <div class="container">
            <div class="competition-hero-content">
                <div class="competition-trophy">
                    <div class="trophy-bg"></div>
                    <span class="trophy-icon-lg">🏆</span>
                </div>
                <div class="competition-info">
                    <h1 class="competition-hero-title">{{ $competition->name }}</h1>
                    <p class="competition-hero-desc">{{ $competition->description }}</p>
                </div>
            </div>
        </div>
    </section>

    <div class="container competition-details">
        <!-- Info Cards -->
        <div class="info-grid">
            <!-- General Info -->
            <div class="info-card">
                <h3 class="info-card-title">
                    <span class="info-icon">📋</span>
                    {{ __('Informations') }}
                </h3>
                <div class="info-list">
                    <div class="info-item">
                        <span class="info-label">{{ __('Fédération') }}</span>
                        <a href="{{ route('federations.show', $competition->federation->slug) }}"
                           class="info-value federation-link">
                            {{ $competition->federation->name }}
                        </a>
                    </div>
                    <div class="info-item">
                        <span class="info-label">{{ __('Format') }}</span>
                        <span class="info-value format-badge">{{ ucfirst($competition->format) }}</span>
                    </div>
                    @if($competition->prize_money)
                        <div class="info-item">
                            <span class="info-label">{{ __('Prize Money') }}</span>
                            <span class="info-value prize-highlight">
                                ${{ number_format($competition->prize_money) }}
                            </span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Seasons -->
            <div class="info-card">
                <h3 class="info-card-title">
                    <span class="info-icon">📅</span>
                    {{ __('Saisons') }}
                </h3>
                @if($competition->seasons->count() > 0)
                    <div class="seasons-list">
                        @foreach($competition->seasons as $season)
                            <div class="season-item">
                                <div class="season-year">{{ $season->year }}</div>
                                <div class="season-dates">
                                    {{ $season->start_date?->format('d/m/Y') }} - {{ $season->end_date?->format('d/m/Y') }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="empty-message">
                        {{ __('Aucune saison disponible.') }}
                    </p>
                @endif
            </div>
        </div>

        <!-- Back Button -->
        <div class="back-button-container">
            <a href="{{ route('competitions.index') }}" class="back-button">
                <span class="back-arrow">←</span>
                {{ __('Retour aux compétitions') }}
            </a>
        </div>
    </div>

    <style>
        .competition-hero {
            background: linear-gradient(135deg, #0A0A0A 0%, #1A1A1A 50%, #0A0A0A 100%);
            padding: 4rem 0 3rem;
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
        }

        .competition-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 30% 50%, rgba(225, 29, 72, 0.18), transparent 50%),
                        radial-gradient(circle at 70% 50%, rgba(251, 191, 36, 0.1), transparent 50%);
            pointer-events: none;
        }

        .competition-hero::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--da-primary), var(--da-accent), transparent);
        }

        .competition-hero-content {
            display: flex;
            align-items: center;
            gap: 2.5rem;
            position: relative;
            z-index: 1;
        }

        .competition-trophy {
            width: 140px;
            height: 140px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            flex-shrink: 0;
        }

        .trophy-bg {
            position: absolute;
            inset: -10px;
            background: radial-gradient(circle, rgba(225, 29, 72, 0.3), transparent 70%);
            border-radius: 50%;
            animation: pulse 3s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.6; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }

        .trophy-icon-lg {
            font-size: 7rem;
            filter: drop-shadow(0 10px 40px rgba(225, 29, 72, 0.6));
            position: relative;
            z-index: 1;
        }

        .competition-info {
            flex: 1;
        }

        .competition-hero-title {
            font-family: 'Bebas Neue', cursive;
            font-size: 3.5rem;
            letter-spacing: 0.05em;
            margin-bottom: 1rem;
            line-height: 1.1;
            background: linear-gradient(135deg, #FAFAFA 0%, var(--da-primary-light) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .competition-hero-desc {
            color: var(--da-text-muted);
            font-size: 1.2rem;
            line-height: 1.7;
            font-weight: 500;
        }

        .competition-details {
            max-width: 1000px;
        }

        /* Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .info-card {
            background: var(--da-card);
            border: 1px solid var(--da-border);
            border-radius: 1rem;
            padding: 2rem;
            transition: all 0.4s ease;
        }

        .info-card:hover {
            border-color: var(--da-primary);
            box-shadow: 0 12px 40px rgba(225, 29, 72, 0.2);
        }

        .info-card-title {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-family: 'Bebas Neue', cursive;
            font-size: 1.75rem;
            letter-spacing: 0.05em;
            margin-bottom: 1.5rem;
            color: white;
        }

        .info-icon {
            font-size: 1.75rem;
            filter: drop-shadow(0 2px 8px rgba(225, 29, 72, 0.4));
        }

        .info-list {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background: var(--da-darker);
            border-radius: 0.75rem;
            gap: 1rem;
        }

        .info-label {
            color: var(--da-text-muted);
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .info-value {
            font-weight: 700;
            font-size: 1rem;
        }

        .federation-link {
            color: var(--da-primary);
            transition: color 0.2s ease;
        }

        .federation-link:hover {
            color: var(--da-primary-light);
        }

        .format-badge {
            padding: 0.4rem 1rem;
            background: rgba(225, 29, 72, 0.15);
            border: 1px solid rgba(225, 29, 72, 0.3);
            border-radius: 0.5rem;
            color: var(--da-primary);
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .prize-highlight {
            color: var(--da-accent);
            font-family: 'Bebas Neue', cursive;
            font-size: 1.5rem;
            letter-spacing: 0.05em;
        }

        /* Seasons */
        .seasons-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .season-item {
            padding: 1rem 1.25rem;
            background: var(--da-darker);
            border-radius: 0.75rem;
            border-left: 3px solid var(--da-primary);
            transition: all 0.3s ease;
        }

        .season-item:hover {
            background: #1A1A1A;
            transform: translateX(4px);
        }

        .season-year {
            font-family: 'Bebas Neue', cursive;
            font-size: 1.5rem;
            letter-spacing: 0.05em;
            color: white;
            margin-bottom: 0.25rem;
        }

        .season-dates {
            color: var(--da-text-muted);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .empty-message {
            color: var(--da-text-muted);
            font-size: 0.95rem;
            font-style: italic;
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

        @media (max-width: 1024px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .competition-hero {
                padding: 3rem 0 2rem;
            }

            .competition-hero-content {
                flex-direction: column;
                text-align: center;
                gap: 1.5rem;
            }

            .competition-trophy {
                width: 120px;
                height: 120px;
            }

            .trophy-icon-lg {
                font-size: 5rem;
            }

            .competition-hero-title {
                font-size: 2.5rem;
            }

            .competition-hero-desc {
                font-size: 1.05rem;
            }

            .info-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
        }
    </style>
@endsection
