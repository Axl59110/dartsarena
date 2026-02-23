@extends('layouts.app')

@section('title', __('Guides') . ' - DartsArena')

@section('content')
    <section class="hero">
        <div class="container hero-content">
            <h1 class="animate-in">{{ __('Guides') }}</h1>
            <p class="animate-in" style="animation-delay: 0.1s;">{{ __('Règles, techniques, statistiques et tout ce qu\'il faut savoir sur les fléchettes.') }}</p>
        </div>
    </section>

    <div class="container">
        @foreach($guidesByCategory as $category => $guides)
            <div class="category-section">
                <h2 class="section-title">
                    <span class="icon">
                        @if($category === 'rules') 📜
                        @elseif($category === 'stats') 📊
                        @elseif($category === 'competitions') 🏆
                        @else 📚
                        @endif
                    </span>
                    @if($category === 'rules') {{ __('Règles') }}
                    @elseif($category === 'stats') {{ __('Statistiques') }}
                    @elseif($category === 'competitions') {{ __('Compétitions') }}
                    @else {{ ucfirst($category) }}
                    @endif
                </h2>

                <div class="guides-grid">
                    @foreach($guides as $index => $guide)
                        <a href="{{ route('guides.show', $guide->slug) }}"
                           class="guide-card animate-in"
                           style="animation-delay: {{ $index * 0.06 }}s;">
                            <div class="guide-icon">
                                @if($category === 'rules') 📜
                                @elseif($category === 'stats') 📊
                                @elseif($category === 'competitions') 🏆
                                @else 📚
                                @endif
                            </div>

                            <div class="guide-content">
                                <h3 class="guide-title">{{ $guide->title }}</h3>
                                <p class="guide-excerpt">{{ $guide->excerpt }}</p>

                                <div class="guide-read-more">
                                    <span class="read-text">{{ __('Lire le guide') }}</span>
                                    <span class="read-arrow">→</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach

        @if($guidesByCategory->count() === 0)
            <div class="card" style="text-align: center;">
                <p style="color: var(--da-text-muted);">
                    {{ __('Aucun guide disponible pour le moment.') }}
                </p>
            </div>
        @endif
    </div>

    <style>
        .category-section {
            margin-bottom: 4rem;
        }

        .guides-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(450px, 1fr));
            gap: 1.75rem;
        }

        .guide-card {
            background: var(--da-card);
            border: 1px solid var(--da-border);
            border-radius: 1rem;
            padding: 2rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            gap: 1.75rem;
        }

        .guide-card::before {
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

        .guide-card::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 40%;
            height: 100%;
            background: radial-gradient(circle at center, rgba(225, 29, 72, 0.06), transparent 70%);
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .guide-card:hover::after {
            opacity: 1;
        }

        .guide-card:hover {
            transform: translateY(-6px);
            border-color: var(--da-primary);
            box-shadow: 0 20px 60px rgba(225, 29, 72, 0.25);
        }

        .guide-card:hover::before {
            transform: scaleX(1);
        }

        .guide-icon {
            flex-shrink: 0;
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #1A1A1A, #262626);
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            filter: drop-shadow(0 4px 15px rgba(225, 29, 72, 0.3));
            transition: transform 0.4s ease;
            position: relative;
        }

        .guide-icon::before {
            content: '';
            position: absolute;
            inset: -2px;
            background: var(--da-gradient-1);
            border-radius: 1rem;
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: -1;
        }

        .guide-card:hover .guide-icon {
            transform: scale(1.1) rotate(-5deg);
        }

        .guide-card:hover .guide-icon::before {
            opacity: 0.3;
        }

        .guide-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            position: relative;
            z-index: 1;
        }

        .guide-title {
            font-family: 'Bebas Neue', cursive;
            font-size: 1.6rem;
            letter-spacing: 0.03em;
            margin-bottom: 0.75rem;
            line-height: 1.25;
            color: white;
        }

        .guide-excerpt {
            color: var(--da-text-muted);
            font-size: 0.95rem;
            line-height: 1.7;
            margin-bottom: 1.25rem;
            flex: 1;
        }

        .guide-read-more {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--da-primary);
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .read-arrow {
            font-size: 1.25rem;
            transition: transform 0.4s ease;
        }

        .guide-card:hover .read-arrow {
            transform: translateX(6px);
        }

        @media (max-width: 768px) {
            .guides-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .guide-card {
                flex-direction: column;
                gap: 1.5rem;
            }

            .guide-icon {
                width: 100%;
                height: 100px;
            }

            .category-section {
                margin-bottom: 3rem;
            }
        }
    </style>
@endsection
