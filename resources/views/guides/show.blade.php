@extends('layouts.app')

@section('title', $guide->title . ' - DartsArena')

@section('breadcrumbs')
    <div class="breadcrumbs">
        <a href="{{ route('home') }}">{{ __('Accueil') }}</a>
        <span class="separator">/</span>
        <a href="{{ route('guides.index') }}">{{ __('Guides') }}</a>
        <span class="separator">/</span>
        <span>{{ $guide->title }}</span>
    </div>
@endsection

@section('content')
    <section class="hero">
        <div class="container">
            <div style="display: inline-block; padding: 0.25rem 0.75rem; background: var(--da-primary); border-radius: 9999px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 1rem;">
                @if($guide->category === 'rules') {{ __('Règles') }}
                @elseif($guide->category === 'stats') {{ __('Statistiques') }}
                @elseif($guide->category === 'competitions') {{ __('Compétitions') }}
                @else {{ ucfirst($guide->category) }}
                @endif
            </div>
            <h1>{{ $guide->title }}</h1>
            @if($guide->excerpt)
                <p style="font-size: 1.125rem; color: var(--da-text-muted);">
                    {{ $guide->excerpt }}
                </p>
            @endif
        </div>
    </section>

    <div class="container">
        <div class="card" style="max-width: 900px; margin: 0 auto;">
            <div class="guide-content" style="line-height: 1.8; color: var(--da-text);">
                {!! $guide->content !!}
            </div>
        </div>

        <!-- Back to guides -->
        <div style="text-align: center; margin-top: 2rem;">
            <a href="{{ route('guides.index') }}"
               style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.5rem; background: var(--da-card); border: 1px solid var(--da-border); border-radius: 0.5rem; font-weight: 600; transition: all 0.2s;">
                ← {{ __('Retour aux guides') }}
            </a>
        </div>
    </div>

    <style>
        .guide-content h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: var(--da-primary);
        }
        .guide-content h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
        }
        .guide-content p {
            margin-bottom: 1rem;
        }
        .guide-content ul, .guide-content ol {
            margin-left: 1.5rem;
            margin-bottom: 1rem;
        }
        .guide-content li {
            margin-bottom: 0.5rem;
        }
        .guide-content strong {
            color: var(--da-accent);
            font-weight: 600;
        }
        .guide-content a {
            color: var(--da-primary);
            text-decoration: underline;
        }
    </style>
@endsection
