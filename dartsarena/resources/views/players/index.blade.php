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
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-12">
            @forelse($players as $index => $player)
                <a href="{{ route('players.show', $player->slug) }}"
                   class="group relative bg-card border-2 border-border rounded-xl overflow-hidden hover:border-primary hover:shadow-2xl hover:scale-[1.02] transition-all duration-300">

                    {{-- Diagonal Ranking Stripe --}}
                    <div class="absolute top-0 right-0 w-32 h-32 overflow-hidden">
                        <div class="absolute top-3 -right-8 w-40 bg-gradient-to-r from-primary to-primary/80 text-primary-foreground text-center py-2 transform rotate-45 shadow-lg">
                            <span class="font-black text-lg tracking-tighter">
                                #{{ $index + 1 + ($players->currentPage() - 1) * $players->perPage() }}
                            </span>
                        </div>
                    </div>

                    {{-- Header avec Photo --}}
                    <div class="relative bg-gradient-to-br from-muted via-muted/50 to-card p-6 pb-4">
                        <div class="flex items-start gap-4">
                            {{-- Photo/Avatar --}}
                            <div class="flex-shrink-0">
                                @if(isset($player->photo_url) && $player->photo_url)
                                    <div class="w-24 h-24 rounded-lg overflow-hidden border-4 border-primary shadow-xl ring-4 ring-primary/20 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                        <img src="{{ $player->photo_url }}"
                                             alt="{{ $player->full_name }}"
                                             class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div class="w-24 h-24 rounded-lg bg-gradient-to-br from-primary via-accent to-primary/80 flex items-center justify-center border-4 border-primary shadow-xl ring-4 ring-primary/20 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                        <span class="text-3xl font-black text-primary-foreground drop-shadow-lg">
                                            {{ strtoupper(substr($player->first_name, 0, 1)) }}{{ strtoupper(substr($player->last_name, 0, 1)) }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                            {{-- Name + Info --}}
                            <div class="flex-1 min-w-0 pt-1">
                                <h3 class="font-display text-xl font-black text-foreground leading-tight mb-1 group-hover:text-primary transition-colors line-clamp-2">
                                    {{ strtoupper($player->full_name) }}
                                </h3>

                                @if($player->nickname)
                                    <p class="text-primary font-bold text-sm italic mb-1 truncate">
                                        "{{ $player->nickname }}"
                                    </p>
                                @endif

                                <p class="text-xs text-muted-foreground font-semibold uppercase tracking-wide">
                                    {{ $player->nationality }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Stats Bar - DOMINANTE --}}
                    <div class="bg-darker/5 border-t-2 border-primary/20">
                        <div class="grid grid-cols-3 divide-x divide-border">
                            <div class="px-3 py-4 text-center group/stat hover:bg-primary/5 transition-colors">
                                <div class="text-2xl font-black text-foreground tabular-nums group-hover/stat:text-primary transition-colors">
                                    {{ isset($player->average) ? number_format($player->average, 2) : '95.5' }}
                                </div>
                                <div class="text-[10px] font-bold text-muted-foreground uppercase tracking-widest mt-0.5">
                                    {{ __('Avg') }}
                                </div>
                            </div>
                            <div class="px-3 py-4 text-center bg-primary/5 group/stat hover:bg-primary/10 transition-colors">
                                <div class="text-2xl font-black text-primary tabular-nums group-hover/stat:scale-110 transition-transform inline-block">
                                    {{ isset($player->win_rate) ? $player->win_rate : '68' }}<span class="text-lg">%</span>
                                </div>
                                <div class="text-[10px] font-bold text-primary uppercase tracking-widest mt-0.5">
                                    {{ __('Win%') }}
                                </div>
                            </div>
                            <div class="px-3 py-4 text-center group/stat hover:bg-primary/5 transition-colors">
                                <div class="text-2xl font-black text-foreground tabular-nums group-hover/stat:text-primary transition-colors">
                                    {{ isset($player->matches_played) ? $player->matches_played : '142' }}
                                </div>
                                <div class="text-[10px] font-bold text-muted-foreground uppercase tracking-widest mt-0.5">
                                    {{ __('Matchs') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Hover Arrow Indicator --}}
                    <div class="absolute bottom-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </div>
                </a>
            @empty
                {{-- État vide --}}
                <div class="col-span-full text-center py-16">
                    <div class="text-6xl mb-4">🎯</div>
                    <h3 class="font-display text-2xl font-bold text-foreground mb-2">
                        {{ __('Aucun joueur trouvé') }}
                    </h3>
                    <p class="text-muted-foreground">
                        {{ __('Essayez de modifier vos critères de recherche') }}
                    </p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($players->hasPages())
            <nav class="flex justify-center items-center gap-2 mt-8" aria-label="{{ __('Pagination') }}">
                {{-- Previous --}}
                @if ($players->onFirstPage())
                    <span class="px-4 py-2 rounded-[var(--radius-base)] border border-border text-muted-foreground cursor-not-allowed opacity-50">
                        ← {{ __('Précédent') }}
                    </span>
                @else
                    <a href="{{ $players->previousPageUrl() }}"
                       class="px-4 py-2 rounded-[var(--radius-base)] border border-border hover:bg-muted hover:border-primary transition-colors">
                        ← {{ __('Précédent') }}
                    </a>
                @endif

                {{-- Page Numbers --}}
                @php
                    $start = max($players->currentPage() - 2, 1);
                    $end = min($start + 4, $players->lastPage());
                    $start = max($end - 4, 1);
                @endphp

                @if($start > 1)
                    <a href="{{ $players->url(1) }}"
                       class="px-4 py-2 rounded-[var(--radius-base)] border border-border hover:bg-muted hover:border-primary transition-colors">
                        1
                    </a>
                    @if($start > 2)
                        <span class="px-2 text-muted-foreground">...</span>
                    @endif
                @endif

                @for($i = $start; $i <= $end; $i++)
                    @if($i === $players->currentPage())
                        <span class="px-4 py-2 rounded-[var(--radius-base)] bg-primary text-primary-foreground font-semibold">
                            {{ $i }}
                        </span>
                    @else
                        <a href="{{ $players->url($i) }}"
                           class="px-4 py-2 rounded-[var(--radius-base)] border border-border hover:bg-muted hover:border-primary transition-colors">
                            {{ $i }}
                        </a>
                    @endif
                @endfor

                @if($end < $players->lastPage())
                    @if($end < $players->lastPage() - 1)
                        <span class="px-2 text-muted-foreground">...</span>
                    @endif
                    <a href="{{ $players->url($players->lastPage()) }}"
                       class="px-4 py-2 rounded-[var(--radius-base)] border border-border hover:bg-muted hover:border-primary transition-colors">
                        {{ $players->lastPage() }}
                    </a>
                @endif

                {{-- Next --}}
                @if ($players->hasMorePages())
                    <a href="{{ $players->nextPageUrl() }}"
                       class="px-4 py-2 rounded-[var(--radius-base)] border border-border hover:bg-muted hover:border-primary transition-colors">
                        {{ __('Suivant') }} →
                    </a>
                @else
                    <span class="px-4 py-2 rounded-[var(--radius-base)] border border-border text-muted-foreground cursor-not-allowed opacity-50">
                        {{ __('Suivant') }} →
                    </span>
                @endif
            </nav>
        @endif
    </div>
@endsection
