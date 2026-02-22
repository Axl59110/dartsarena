@extends('layouts.app')

@section('title', __('Fédérations de Fléchettes') . ' - DartsArena')

@section('content')
    <section class="hero">
        <div class="container">
            <h1>🏛️ {{ __('Fédérations') }}</h1>
            <p>{{ __('Les principales organisations régissant le sport des fléchettes dans le monde.') }}</p>
        </div>
    </section>

    <div class="container">
        <div class="grid-2">
            @foreach($federations as $federation)
                <a href="{{ route('federations.show', $federation->slug) }}" class="card">
                    <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem;">
                        {{ $federation->name }}
                    </h2>
                    <p style="color: var(--da-text-muted); margin-bottom: 1rem;">
                        {{ $federation->description }}
                    </p>
                    @if($federation->website_url)
                        <span style="color: var(--da-primary); font-size: 0.875rem; font-weight: 500;">
                            {{ __('Voir les compétitions') }} →
                        </span>
                    @endif
                </a>
            @endforeach
        </div>
    </div>
@endsection
