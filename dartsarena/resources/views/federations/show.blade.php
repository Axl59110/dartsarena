@extends('layouts.app')

@section('title', $federation->name . ' - DartsArena')

@section('breadcrumbs')
    <div class="breadcrumbs">
        <a href="{{ route('home') }}">{{ __('Accueil') }}</a>
        <span class="separator">/</span>
        <a href="{{ route('federations.index') }}">{{ __('Fédérations') }}</a>
        <span class="separator">/</span>
        <span>{{ $federation->name }}</span>
    </div>
@endsection

@section('content')
    <section class="hero">
        <div class="container">
            <h1>{{ $federation->name }}</h1>
            <p>{{ $federation->description }}</p>
        </div>
    </section>

    <div class="container">
        <h2 class="section-title">
            <span class="icon">🏆</span>
            {{ __('Compétitions') }}
        </h2>

        @if($competitions->count() > 0)
            <div class="grid-2">
                @foreach($competitions as $competition)
                    <a href="{{ route('competitions.show', $competition->slug) }}" class="card">
                        <h3 style="font-weight: 700; margin-bottom: 0.5rem;">
                            {{ $competition->name }}
                        </h3>
                        <p style="color: var(--da-text-muted); font-size: 0.875rem; margin-bottom: 0.75rem;">
                            {{ $competition->description }}
                        </p>
                        @if($competition->prize_money)
                            <div style="color: var(--da-accent); font-weight: 600; font-size: 0.875rem;">
                                💰 ${{ number_format($competition->prize_money) }}
                            </div>
                        @endif
                    </a>
                @endforeach
            </div>
        @else
            <div class="card" style="text-align: center;">
                <p style="color: var(--da-text-muted);">
                    {{ __('Aucune compétition disponible pour cette fédération.') }}
                </p>
            </div>
        @endif
    </div>
@endsection
