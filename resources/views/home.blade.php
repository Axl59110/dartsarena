@extends('layouts.app')

@section('title', 'DartsArena - ' . __('Actualités, Résultats et Statistiques Fléchettes'))

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>🎯 {{ __('Bienvenue sur DartsArena') }}</h1>
            <p>{{ __('Votre hub complet pour les fléchettes : résultats en direct, classements, calendrier, statistiques et guides.') }}</p>
        </div>
    </section>

    <div class="container">
        <!-- Quick Links Grid -->
        <div class="grid-3" style="margin-bottom: 2rem;">
            <a href="{{ route('competitions.index') }}" class="card" style="text-align: center;">
                <div style="font-size: 2rem; margin-bottom: 0.5rem;">🏆</div>
                <h3 style="font-weight: 700; margin-bottom: 0.25rem;">{{ __('Compétitions') }}</h3>
                <p style="color: var(--da-text-muted); font-size: 0.875rem;">{{ __('PDC, WDF, Premier League, World Championship...') }}</p>
            </a>
            <a href="{{ route('rankings.index') }}" class="card" style="text-align: center;">
                <div style="font-size: 2rem; margin-bottom: 0.5rem;">📊</div>
                <h3 style="font-weight: 700; margin-bottom: 0.25rem;">{{ __('Classements') }}</h3>
                <p style="color: var(--da-text-muted); font-size: 0.875rem;">{{ __('Order of Merit, stats et rankings par fédération') }}</p>
            </a>
            <a href="{{ route('calendar.index') }}" class="card" style="text-align: center;">
                <div style="font-size: 2rem; margin-bottom: 0.5rem;">📅</div>
                <h3 style="font-weight: 700; margin-bottom: 0.25rem;">{{ __('Calendrier') }}</h3>
                <p style="color: var(--da-text-muted); font-size: 0.875rem;">{{ __('Tous les événements et dates à ne pas manquer') }}</p>
            </a>
            <div class="card" style="text-align: center; opacity: 0.6;">
                <div style="font-size: 2rem; margin-bottom: 0.5rem;">🎯</div>
                <h3 style="font-weight: 700; margin-bottom: 0.25rem;">{{ __('Matchs du jour') }}</h3>
                <p style="color: var(--da-text-muted); font-size: 0.875rem;">{{ __('Scores en direct et résultats des rencontres') }}</p>
                <span class="badge badge-upcoming" style="margin-top: 0.5rem;">{{ __('Bientôt') }}</span>
            </div>
            <a href="{{ route('players.index') }}" class="card" style="text-align: center;">
                <div style="font-size: 2rem; margin-bottom: 0.5rem;">👤</div>
                <h3 style="font-weight: 700; margin-bottom: 0.25rem;">{{ __('Joueurs') }}</h3>
                <p style="color: var(--da-text-muted); font-size: 0.875rem;">{{ __('Fiches détaillées, stats et palmarès') }}</p>
            </a>
            <a href="{{ route('guides.index') }}" class="card" style="text-align: center;">
                <div style="font-size: 2rem; margin-bottom: 0.5rem;">📖</div>
                <h3 style="font-weight: 700; margin-bottom: 0.25rem;">{{ __('Guides') }}</h3>
                <p style="color: var(--da-text-muted); font-size: 0.875rem;">{{ __('Règles, techniques et tout pour débuter') }}</p>
            </a>
        </div>

        <!-- Site Info -->
        <div class="card" style="text-align: center; border-color: var(--da-primary);">
            <h2 style="font-weight: 700; margin-bottom: 0.5rem; color: var(--da-primary);">
                {{ __('POC en développement') }} 🚀
            </h2>
            <p style="color: var(--da-text-muted);">
                {{ __('DartsArena est en phase de développement. Explorez les compétitions, joueurs, classements et calendrier déjà disponibles !') }}
            </p>
        </div>
    </div>
@endsection
