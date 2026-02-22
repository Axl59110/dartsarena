@extends('layouts.app')

@section('title', __('Compétitions de Fléchettes') . ' - DartsArena')

@section('content')
    <section class="hero">
        <div class="container">
            <h1>🏆 {{ __('Compétitions') }}</h1>
            <p>{{ __('Tous les tournois majeurs de fléchettes à travers le monde.') }}</p>
        </div>
    </section>

    <div class="container">
        <div class="grid-2">
            @foreach($competitions as $competition)
                <a href="{{ route('competitions.show', $competition->slug) }}" class="card">
                    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 0.5rem;">
                        <h2 style="font-size: 1.25rem; font-weight: 700;">
                            {{ $competition->name }}
                        </h2>
                        <span style="font-size: 0.7rem; color: var(--da-text-muted); text-transform: uppercase; letter-spacing: 0.05em;">
                            {{ $competition->federation->name }}
                        </span>
                    </div>
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
    </div>
@endsection
