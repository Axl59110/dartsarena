@extends('layouts.app')

@section('title', __('Guides') . ' - DartsArena')

@section('content')
    <section class="hero">
        <div class="container">
            <h1>📖 {{ __('Guides') }}</h1>
            <p>{{ __('Règles, techniques, statistiques et tout ce qu\'il faut savoir sur les fléchettes.') }}</p>
        </div>
    </section>

    <div class="container">
        @foreach($guidesByCategory as $category => $guides)
            <div style="margin-bottom: 3rem;">
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

                <div class="grid-2">
                    @foreach($guides as $guide)
                        <a href="{{ route('guides.show', $guide->slug) }}" class="card">
                            <h3 style="font-weight: 700; font-size: 1.25rem; margin-bottom: 0.75rem;">
                                {{ $guide->title }}
                            </h3>
                            <p style="color: var(--da-text-muted); font-size: 0.875rem; line-height: 1.6;">
                                {{ $guide->excerpt }}
                            </p>
                            <div style="margin-top: 1rem; color: var(--da-primary); font-size: 0.875rem; font-weight: 500;">
                                {{ __('Lire le guide') }} →
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
@endsection
