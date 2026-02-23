@extends('layouts.app')

@section('title', __('Compétitions de Fléchettes') . ' - DartsArena')

@section('content')
    <section class="hero">
        <div class="container hero-content">
            <h1 class="animate-in">{{ __('Compétitions') }}</h1>
            <p class="animate-in" style="animation-delay: 0.1s;">{{ __('Tous les tournois majeurs de fléchettes à travers le monde.') }}</p>
        </div>
    </section>

    <div class="container">
        <div class="competitions-grid">
            @foreach($competitions as $index => $competition)
                <a href="{{ route('competitions.show', $competition->slug) }}"
                   class="competition-card animate-in"
                   style="animation-delay: {{ $index * 0.05 }}s;">
                    <div class="competition-bg"></div>

                    <div class="competition-header">
                        <span class="federation-badge">{{ $competition->federation->name }}</span>
                        <span class="trophy-icon">🏆</span>
                    </div>

                    <h3 class="competition-title">{{ $competition->name }}</h3>

                    <p class="competition-description">{{ $competition->description }}</p>

                    @if($competition->prize_money)
                        <div class="competition-footer">
                            <div class="prize-info">
                                <span class="prize-label">{{ __('Prize Money') }}</span>
                                <span class="prize-value">${{ number_format($competition->prize_money) }}</span>
                            </div>
                        </div>
                    @endif

                    <div class="competition-arrow">→</div>
                </a>
            @endforeach
        </div>
    </div>

    <style>
        .competitions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
            gap: 2rem;
        }

        .competition-card {
            background: var(--da-card);
            border: 1px solid var(--da-border);
            border-radius: 1rem;
            padding: 2rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .competition-bg {
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 80% 20%, rgba(225, 29, 72, 0.1), transparent 60%);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .competition-card:hover .competition-bg {
            opacity: 1;
        }

        .competition-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--da-gradient-1);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .competition-card:hover {
            transform: translateY(-6px);
            border-color: var(--da-primary);
            box-shadow: 0 20px 60px rgba(225, 29, 72, 0.25);
        }

        .competition-card:hover::before {
            transform: scaleX(1);
        }

        .competition-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            position: relative;
            z-index: 1;
        }

        .federation-badge {
            padding: 0.5rem 1rem;
            background: rgba(225, 29, 72, 0.15);
            border: 1px solid rgba(225, 29, 72, 0.3);
            border-radius: 0.5rem;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--da-primary);
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .trophy-icon {
            font-size: 2.5rem;
            filter: drop-shadow(0 4px 15px rgba(225, 29, 72, 0.4));
            transition: transform 0.4s ease;
        }

        .competition-card:hover .trophy-icon {
            transform: scale(1.15) rotate(-10deg);
        }

        .competition-title {
            font-family: 'Bebas Neue', cursive;
            font-size: 1.85rem;
            letter-spacing: 0.05em;
            margin-bottom: 1rem;
            line-height: 1.2;
            color: white;
            position: relative;
            z-index: 1;
        }

        .competition-description {
            color: var(--da-text-muted);
            font-size: 0.95rem;
            line-height: 1.7;
            margin-bottom: 1.5rem;
            flex: 1;
            position: relative;
            z-index: 1;
        }

        .competition-footer {
            padding-top: 1.25rem;
            border-top: 1px solid var(--da-border);
            position: relative;
            z-index: 1;
        }

        .prize-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .prize-label {
            color: var(--da-text-muted);
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .prize-value {
            color: var(--da-accent);
            font-size: 1.25rem;
            font-weight: 700;
            font-family: 'Bebas Neue', cursive;
            letter-spacing: 0.05em;
        }

        .competition-arrow {
            margin-top: 1.25rem;
            font-size: 1.75rem;
            color: var(--da-primary);
            transform: translateX(0);
            transition: transform 0.4s ease;
            position: relative;
            z-index: 1;
        }

        .competition-card:hover .competition-arrow {
            transform: translateX(8px);
        }

        @media (max-width: 768px) {
            .competitions-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .competition-card {
                padding: 1.75rem;
            }

            .competition-title {
                font-size: 1.6rem;
            }
        }
    </style>
@endsection
