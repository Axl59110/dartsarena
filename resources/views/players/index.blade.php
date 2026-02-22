@extends('layouts.app')

@section('title', __('Joueurs de Fléchettes') . ' - DartsArena')

@section('content')
    <section class="hero">
        <div class="container">
            <h1>👤 {{ __('Joueurs') }}</h1>
            <p>{{ __('Les meilleurs joueurs de fléchettes du monde.') }}</p>
        </div>
    </section>

    <div class="container">
        <div class="grid-3">
            @foreach($players as $player)
                <a href="{{ route('players.show', $player->slug) }}" class="card">
                    <div style="text-align: center;">
                        <div style="width: 80px; height: 80px; background: var(--da-darker); border-radius: 50%; margin: 0 auto 1rem; display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                            🎯
                        </div>
                        <h3 style="font-weight: 700; margin-bottom: 0.25rem;">
                            {{ $player->full_name }}
                        </h3>
                        @if($player->nickname)
                            <p style="color: var(--da-primary); font-size: 0.875rem; font-style: italic; margin-bottom: 0.5rem;">
                                "{{ $player->nickname }}"
                            </p>
                        @endif
                        <p style="color: var(--da-text-muted); font-size: 0.875rem;">
                            🌍 {{ $player->nationality }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
