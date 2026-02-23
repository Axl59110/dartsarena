@extends('layouts.app')

@section('title', $guide->title . ' - DartsArena')

@section('breadcrumbs')
    <div class="breadcrumbs">
        <a href="{{ route('home') }}">{{ __('Accueil') }}</a>
        <span class="separator">/</span>
        <a href="{{ route('guides.index') }}">{{ __('Guides') }}</a>
        <span class="separator">/</span>
        <span>{{ Str::limit($guide->title, 50) }}</span>
    </div>
@endsection

@section('content')
    <!-- Guide Hero -->
    <section class="guide-hero">
        <div class="container">
            <div class="guide-hero-content">
                <div class="guide-category-badge">
                    @if($guide->category === 'rules') {{ __('Règles') }}
                    @elseif($guide->category === 'stats') {{ __('Statistiques') }}
                    @elseif($guide->category === 'competitions') {{ __('Compétitions') }}
                    @else {{ ucfirst($guide->category) }}
                    @endif
                </div>
                <h1 class="guide-hero-title">{{ $guide->title }}</h1>
                @if($guide->excerpt)
                    <p class="guide-hero-excerpt">{{ $guide->excerpt }}</p>
                @endif
            </div>
        </div>
    </section>

    <div class="container guide-page">
        <!-- Guide Content -->
        <div class="guide-content-card">
            <div class="guide-body">
                {!! $guide->content !!}
            </div>
        </div>

        <!-- Back Button -->
        <div class="back-button-container">
            <a href="{{ route('guides.index') }}" class="back-button">
                <span class="back-arrow">←</span>
                {{ __('Retour aux guides') }}
            </a>
        </div>
    </div>

    <style>
        .guide-hero {
            background: linear-gradient(135deg, #0A0A0A 0%, #1A1A1A 50%, #0A0A0A 100%);
            padding: 4rem 0 3rem;
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
        }

        .guide-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 30% 50%, rgba(225, 29, 72, 0.15), transparent 50%),
                        radial-gradient(circle at 70% 50%, rgba(251, 191, 36, 0.08), transparent 50%);
            pointer-events: none;
        }

        .guide-hero::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--da-primary), var(--da-accent), transparent);
        }

        .guide-hero-content {
            position: relative;
            z-index: 1;
            max-width: 900px;
        }

        .guide-category-badge {
            display: inline-flex;
            padding: 0.5rem 1.25rem;
            background: var(--da-gradient-1);
            border-radius: 9999px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 1.5rem;
            color: white;
            box-shadow: 0 4px 15px rgba(225, 29, 72, 0.4);
        }

        .guide-hero-title {
            font-family: 'Bebas Neue', cursive;
            font-size: 3.5rem;
            letter-spacing: 0.05em;
            margin-bottom: 1rem;
            line-height: 1.15;
            background: linear-gradient(135deg, #FAFAFA 0%, var(--da-primary-light) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .guide-hero-excerpt {
            font-size: 1.25rem;
            line-height: 1.7;
            color: var(--da-text-muted);
            font-weight: 500;
        }

        .guide-page {
            max-width: 900px;
        }

        .guide-content-card {
            background: var(--da-card);
            border: 1px solid var(--da-border);
            border-radius: 1.5rem;
            padding: 3rem;
            margin-bottom: 3rem;
        }

        .guide-body {
            line-height: 1.9;
            color: var(--da-text);
        }

        .guide-body h2 {
            font-family: 'Bebas Neue', cursive;
            font-size: 2.25rem;
            letter-spacing: 0.05em;
            margin-top: 2.5rem;
            margin-bottom: 1.25rem;
            color: white;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid rgba(225, 29, 72, 0.3);
        }

        .guide-body h2:first-child {
            margin-top: 0;
        }

        .guide-body h3 {
            font-family: 'Bebas Neue', cursive;
            font-size: 1.6rem;
            letter-spacing: 0.05em;
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: var(--da-primary-light);
        }

        .guide-body p {
            margin-bottom: 1.25rem;
            font-size: 1.05rem;
        }

        .guide-body ul,
        .guide-body ol {
            margin-left: 2rem;
            margin-bottom: 1.5rem;
        }

        .guide-body li {
            margin-bottom: 0.75rem;
            font-size: 1.05rem;
            padding-left: 0.5rem;
        }

        .guide-body ul li {
            list-style: none;
            position: relative;
        }

        .guide-body ul li::before {
            content: '▸';
            position: absolute;
            left: -1.5rem;
            color: var(--da-primary);
            font-weight: 700;
        }

        .guide-body ol li {
            padding-left: 0.25rem;
        }

        .guide-body strong {
            color: var(--da-accent);
            font-weight: 700;
        }

        .guide-body a {
            color: var(--da-primary);
            font-weight: 600;
            text-decoration: underline;
            text-decoration-thickness: 2px;
            text-underline-offset: 2px;
            transition: color 0.2s ease;
        }

        .guide-body a:hover {
            color: var(--da-primary-light);
        }

        .guide-body code {
            background: var(--da-darker);
            padding: 0.25rem 0.5rem;
            border-radius: 0.375rem;
            font-family: 'Courier New', monospace;
            font-size: 0.9em;
            color: var(--da-accent);
        }

        .guide-body pre {
            background: var(--da-darker);
            padding: 1.5rem;
            border-radius: 0.75rem;
            overflow-x: auto;
            margin-bottom: 1.5rem;
            border: 1px solid var(--da-border);
        }

        .guide-body pre code {
            background: none;
            padding: 0;
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
            .guide-hero {
                padding: 3rem 0 2rem;
            }

            .guide-hero-title {
                font-size: 2.5rem;
            }

            .guide-hero-excerpt {
                font-size: 1.05rem;
            }

            .guide-content-card {
                padding: 2rem 1.5rem;
            }

            .guide-body h2 {
                font-size: 1.85rem;
            }

            .guide-body h3 {
                font-size: 1.4rem;
            }

            .guide-body p,
            .guide-body li {
                font-size: 1rem;
            }
        }
    </style>
@endsection
