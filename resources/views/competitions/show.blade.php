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
    <section class="hero">
        <div class="container">
            <h1>{{ $competition->name }}</h1>
            <p>{{ $competition->description }}</p>
        </div>
    </section>

    <div class="container">
        <div class="grid-2">
            <div class="card">
                <h3 style="font-weight: 700; margin-bottom: 1rem;">
                    📋 {{ __('Informations') }}
                </h3>
                <div style="display: grid; gap: 0.5rem;">
                    <div>
                        <span style="color: var(--da-text-muted); font-size: 0.875rem;">{{ __('Fédération') }}:</span>
                        <a href="{{ route('federations.show', $competition->federation->slug) }}"
                           style="color: var(--da-primary); font-weight: 500; margin-left: 0.5rem;">
                            {{ $competition->federation->name }}
                        </a>
                    </div>
                    <div>
                        <span style="color: var(--da-text-muted); font-size: 0.875rem;">{{ __('Format') }}:</span>
                        <span style="font-weight: 500; margin-left: 0.5rem;">{{ ucfirst($competition->format) }}</span>
                    </div>
                    @if($competition->prize_money)
                        <div>
                            <span style="color: var(--da-text-muted); font-size: 0.875rem;">{{ __('Prize Money') }}:</span>
                            <span style="color: var(--da-accent); font-weight: 600; margin-left: 0.5rem;">
                                ${{ number_format($competition->prize_money) }}
                            </span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card">
                <h3 style="font-weight: 700; margin-bottom: 1rem;">
                    📅 {{ __('Saisons') }}
                </h3>
                @if($competition->seasons->count() > 0)
                    <div style="display: grid; gap: 0.5rem;">
                        @foreach($competition->seasons as $season)
                            <div style="padding: 0.5rem; background: var(--da-darker); border-radius: 0.5rem;">
                                <span style="font-weight: 600;">{{ $season->year }}</span>
                                <span style="color: var(--da-text-muted); font-size: 0.875rem; margin-left: 0.5rem;">
                                    {{ $season->start_date?->format('d/m/Y') }} - {{ $season->end_date?->format('d/m/Y') }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p style="color: var(--da-text-muted); font-size: 0.875rem;">
                        {{ __('Aucune saison disponible.') }}
                    </p>
                @endif
            </div>
        </div>
    </div>
@endsection
