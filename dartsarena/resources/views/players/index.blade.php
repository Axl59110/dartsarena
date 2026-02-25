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
    {{-- Hero Section --}}
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
        {{-- Filters / Search Section --}}
        <div class="mb-8 flex flex-col sm:flex-row gap-4 items-center justify-between">
            {{-- Search --}}
            <div class="w-full sm:w-auto flex-1 max-w-md">
                <input type="text"
                       placeholder="{{ __('Rechercher un joueur...') }}"
                       class="w-full px-4 py-2 rounded-[var(--radius-base)] border border-card-border bg-card text-foreground focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                       x-data="{ search: '' }"
                       x-model="search">
            </div>

            {{-- Sort Options --}}
            <div class="flex gap-2 overflow-x-auto pb-2 w-full sm:w-auto">
                <button class="px-4 py-2 rounded-[var(--radius-base)] text-sm font-semibold whitespace-nowrap bg-primary text-primary-foreground">
                    {{ __('Classement') }}
                </button>
                <button class="px-4 py-2 rounded-[var(--radius-base)] text-sm font-semibold whitespace-nowrap bg-card text-foreground hover:bg-muted border border-border transition-colors">
                    {{ __('Nom') }}
                </button>
                <button class="px-4 py-2 rounded-[var(--radius-base)] text-sm font-semibold whitespace-nowrap bg-card text-foreground hover:bg-muted border border-border transition-colors">
                    {{ __('Nationalité') }}
                </button>
            </div>
        </div>

        {{-- Players Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach($players as $index => $player)
                <a href="{{ route('players.show', $player->slug) }}"
                   class="group bg-card border border-card-border rounded-[var(--radius-base)] shadow-sm hover:shadow-lg hover:border-primary hover:-translate-y-1 transition-all duration-200 overflow-hidden">

                    {{-- Player Card Content --}}
                    <div class="relative">
                        {{-- Ranking Badge --}}
                        <div class="absolute top-4 right-4 z-10 bg-primary text-primary-foreground px-3 py-1.5 rounded-full font-bold text-sm shadow-lg">
                            #{{ $index + 1 + ($players->currentPage() - 1) * $players->perPage() }}
                        </div>

                        {{-- Player Photo/Avatar --}}
                        <div class="p-8 text-center bg-gradient-to-b from-muted/30 to-card">
                            @if(isset($player->photo_url) && $player->photo_url)
                                <img src="{{ $player->photo_url }}"
                                     alt="{{ $player->full_name }}"
                                     class="w-32 h-32 rounded-full mx-auto object-cover border-4 border-primary shadow-xl group-hover:scale-110 transition-transform">
                            @else
                                {{-- Fallback: Initiales --}}
                                <div class="w-32 h-32 rounded-full mx-auto bg-gradient-to-br from-primary to-accent flex items-center justify-center border-4 border-primary shadow-xl group-hover:scale-110 transition-transform">
                                    <span class="text-4xl font-bold text-primary-foreground">
                                        {{ strtoupper(substr($player->first_name, 0, 1)) }}{{ strtoupper(substr($player->last_name, 0, 1)) }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        {{-- Player Info --}}
                        <div class="p-6 border-t border-card-border space-y-3">
                            {{-- Name --}}
                            <h3 class="font-display text-2xl font-bold text-foreground group-hover:text-primary transition-colors leading-[1.2] text-center">
                                {{ $player->full_name }}
                            </h3>

                            {{-- Nickname --}}
                            @if($player->nickname)
                                <p class="text-primary text-sm font-semibold italic text-center">
                                    "{{ $player->nickname }}"
                                </p>
                            @endif

                            {{-- Nationality --}}
                            <p class="text-sm text-muted-foreground text-center">
                                {{ $player->nationality }}
                            </p>

                            {{-- Stats Grid --}}
                            <div class="grid grid-cols-3 gap-3 pt-4 border-t border-card-border">
                                <div class="text-center">
                                    <p class="text-xs text-muted-foreground mb-1">{{ __('Avg') }}</p>
                                    <p class="font-bold text-lg text-foreground">
                                        {{ isset($player->average) ? number_format($player->average, 2) : '95.50' }}
                                    </p>
                                </div>
                                <div class="text-center">
                                    <p class="text-xs text-muted-foreground mb-1">{{ __('Win%') }}</p>
                                    <p class="font-bold text-lg text-primary">
                                        {{ isset($player->win_rate) ? $player->win_rate : '68' }}%
                                    </p>
                                </div>
                                <div class="text-center">
                                    <p class="text-xs text-muted-foreground mb-1">{{ __('Matchs') }}</p>
                                    <p class="font-bold text-lg text-foreground">
                                        {{ isset($player->matches_played) ? $player->matches_played : '142' }}
                                    </p>
                                </div>
                            </div>

                            {{-- View Profile Link --}}
                            <div class="pt-3">
                                <x-link-arrow href="{{ route('players.show', $player->slug) }}" size="sm" class="w-full justify-center">
                                    {{ __('Voir le profil') }}
                                </x-link-arrow>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
