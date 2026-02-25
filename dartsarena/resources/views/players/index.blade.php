@extends('layouts.app')

@section('title', __('Joueurs de Fléchettes') . ' - DartsArena')

@section('breadcrumbs')
    <div class="breadcrumbs py-3">
        <a href="{{ route('home') }}">{{ __('Accueil') }}</a>
        <span class="text-muted-foreground mx-2">/</span>
        <span class="text-foreground">{{ __('Joueurs') }}</span>
    </div>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-b from-muted/30 to-background">
        <div class="container py-12 lg:py-16">
            <h1 class="font-display text-4xl lg:text-5xl font-bold text-foreground mb-4">
                {{ __('Joueurs') }}
            </h1>
            <p class="text-lg text-muted-foreground max-w-3xl">
                {{ __('Les meilleurs joueurs de fléchettes du monde.') }}
            </p>
        </div>
    </section>

    <div class="container py-8 lg:py-12">
        <!-- Players Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach($players as $player)
                <a href="{{ route('players.show', $player->slug) }}"
                   class="bg-card rounded-xl border border-card-border shadow-sm hover:shadow-lg hover:border-border-strong hover:-translate-y-1 transition-all duration-200 group overflow-hidden">
                    <!-- Avatar -->
                    <div class="p-6 flex flex-col items-center text-center">
                        <div class="w-24 h-24 bg-gradient-to-br from-muted to-border rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <span class="text-5xl">🎯</span>
                        </div>

                        <h3 class="font-display text-2xl font-bold text-foreground group-hover:text-primary transition-colors mb-2 leading-tight">
                            {{ $player->full_name }}
                        </h3>

                        @if($player->nickname)
                            <p class="text-primary text-sm font-semibold italic mb-3">
                                "{{ $player->nickname }}"
                            </p>
                        @endif

                        <p class="text-sm text-muted-foreground flex items-center gap-2">
                            <span class="text-lg">🌍</span>
                            {{ $player->nationality }}
                        </p>

                        <div class="flex items-center gap-2 text-primary font-semibold text-sm pt-4">
                            {{ __('Voir le profil') }}
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
