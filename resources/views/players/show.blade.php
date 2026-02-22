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
    <section class="hero">
        <div class="container">
            <div style="display: flex; align-items: center; gap: 2rem;">
                <div style="width: 120px; height: 120px; background: var(--da-card); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 4rem; border: 3px solid var(--da-primary);">
                    🎯
                </div>
                <div>
                    <h1 style="margin-bottom: 0.25rem;">{{ $player->full_name }}</h1>
                    @if($player->nickname)
                        <p style="color: var(--da-primary); font-size: 1.25rem; font-style: italic; margin-bottom: 0.5rem;">
                            "{{ $player->nickname }}"
                        </p>
                    @endif
                    <p style="color: var(--da-text-muted);">
                        🌍 {{ $player->nationality }}
                        @if($player->date_of_birth)
                            • 🎂 {{ $player->date_of_birth->format('d/m/Y') }}
                            ({{ $player->date_of_birth->age }} {{ __('ans') }})
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="grid-2">
            @if($player->bio)
                <div class="card">
                    <h3 style="font-weight: 700; margin-bottom: 1rem;">
                        📖 {{ __('Biographie') }}
                    </h3>
                    <p style="color: var(--da-text-muted); line-height: 1.6;">
                        {{ $player->bio }}
                    </p>
                </div>
            @endif

            <div class="card">
                <h3 style="font-weight: 700; margin-bottom: 1rem;">
                    📊 {{ __('Statistiques') }}
                </h3>
                <div style="display: grid; gap: 0.75rem;">
                    @if($latestRanking)
                        <div style="padding: 0.75rem; background: var(--da-darker); border-radius: 0.5rem;">
                            <div style="font-size: 0.75rem; color: var(--da-text-muted); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.25rem;">
                                {{ __('Classement Actuel') }}
                            </div>
                            <div style="font-size: 2rem; font-weight: 800; color: var(--da-primary);">
                                #{{ $latestRanking->position }}
                            </div>
                        </div>
                    @endif

                    @if($player->career_titles > 0)
                        <div>
                            <span style="color: var(--da-text-muted); font-size: 0.875rem;">{{ __('Titres') }}:</span>
                            <span style="font-weight: 600; margin-left: 0.5rem;">🏆 {{ $player->career_titles }}</span>
                        </div>
                    @endif

                    @if($player->career_9darters > 0)
                        <div>
                            <span style="color: var(--da-text-muted); font-size: 0.875rem;">{{ __('9-Darters') }}:</span>
                            <span style="font-weight: 600; margin-left: 0.5rem;">🎯 {{ $player->career_9darters }}</span>
                        </div>
                    @endif

                    @if($player->career_highest_average)
                        <div>
                            <span style="color: var(--da-text-muted); font-size: 0.875rem;">{{ __('Meilleure Moyenne') }}:</span>
                            <span style="font-weight: 600; margin-left: 0.5rem;">📈 {{ $player->career_highest_average }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
