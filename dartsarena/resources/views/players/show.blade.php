@extends('layouts.app')

@section('title', $player->full_name . ' - DartsArena')

@section('breadcrumbs')
    <div class="breadcrumbs py-3">
        <a href="{{ route('home') }}">{{ __('Accueil') }}</a>
        <span class="text-muted-foreground mx-2">/</span>
        <a href="{{ route('players.index') }}">{{ __('Joueurs') }}</a>
        <span class="text-muted-foreground mx-2">/</span>
        <span class="text-foreground">{{ $player->full_name }}</span>
    </div>
@endsection

@section('content')
    {{-- Player Hero --}}
    <section class="bg-gradient-to-b from-muted/30 to-background">
        <div class="container py-12 lg:py-16">
            <div class="flex flex-col lg:flex-row items-center lg:items-start gap-8">
                {{-- Avatar with Ranking Badge --}}
                <div class="relative flex-shrink-0">
                    <div class="w-32 h-32 lg:w-40 lg:h-40 bg-gradient-to-br from-primary/20 to-primary/10 rounded-full flex items-center justify-center border-4 border-primary/40">
                        <span class="text-7xl lg:text-8xl">🎯</span>
                    </div>
                    @if($latestRanking)
                        <div class="absolute -bottom-2 -right-2 w-14 h-14 bg-primary rounded-full flex items-center justify-center border-4 border-background shadow-lg">
                            <span class="font-display text-lg font-bold text-primary-foreground">#{{ $latestRanking->position }}</span>
                        </div>
                    @endif
                </div>

                {{-- Player Info --}}
                <div class="flex-1 text-center lg:text-left">
                    <h1 class="font-display text-4xl lg:text-5xl font-bold text-foreground mb-3">
                        {{ $player->full_name }}
                    </h1>

                    @if($player->nickname)
                        <p class="text-primary text-xl font-semibold italic mb-4">
                            "{{ $player->nickname }}"
                        </p>
                    @endif

                    <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4 text-muted-foreground">
                        <span class="flex items-center gap-2">
                            <span class="text-xl">🌍</span>
                            {{ $player->nationality }}
                        </span>
                        @if($player->date_of_birth)
                            <span>•</span>
                            <span class="flex items-center gap-2">
                                <span class="text-xl">🎂</span>
                                {{ $player->date_of_birth->format('d/m/Y') }}
                                ({{ $player->date_of_birth->age }} {{ __('ans') }})
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container py-8 lg:py-12">
        <div class="max-w-5xl mx-auto">
            {{-- Stats Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 mb-12">
                @if($latestRanking)
                    <x-card class="bg-gradient-to-br from-primary/10 to-primary/5 border-primary/30 p-6 text-center">
                        <div class="text-4xl mb-2">🏆</div>
                        <div class="font-display text-4xl font-bold text-primary mb-1">#{{ $latestRanking->position }}</div>
                        <div class="text-sm text-muted-foreground font-semibold uppercase tracking-wide">{{ __('Classement Actuel') }}</div>
                    </x-card>
                @endif

                @if($player->career_titles > 0)
                    <x-card class="p-6 text-center hover:shadow-lg hover:border-primary transition-all">
                        <div class="text-4xl mb-2">🏅</div>
                        <div class="font-display text-4xl font-bold text-foreground mb-1">{{ $player->career_titles }}</div>
                        <div class="text-sm text-muted-foreground font-semibold uppercase tracking-wide">{{ __('Titres en Carrière') }}</div>
                    </x-card>
                @endif

                @if($player->career_9darters > 0)
                    <x-card class="p-6 text-center hover:shadow-lg hover:border-primary transition-all">
                        <div class="text-4xl mb-2">🎯</div>
                        <div class="font-display text-4xl font-bold text-foreground mb-1">{{ $player->career_9darters }}</div>
                        <div class="text-sm text-muted-foreground font-semibold uppercase tracking-wide">{{ __('9-Darters') }}</div>
                    </x-card>
                @endif

                @if($player->career_highest_average)
                    <x-card class="p-6 text-center hover:shadow-lg hover:border-primary transition-all">
                        <div class="text-4xl mb-2">📈</div>
                        <div class="font-display text-4xl font-bold text-foreground mb-1">{{ $player->career_highest_average }}</div>
                        <div class="text-sm text-muted-foreground font-semibold uppercase tracking-wide">{{ __('Meilleure Moyenne') }}</div>
                    </x-card>
                @endif
            </div>

            {{-- Bio Section --}}
            @if($player->bio)
                <div class="mb-12">
                    <x-section-header title="{{ __('Biographie') }}" spacing="mb-6" />
                    <x-card class="p-6 lg:p-8">
                        <p class="text-lg leading-relaxed text-muted-foreground">{{ $player->bio }}</p>
                    </x-card>
                </div>
            @endif

            {{-- Back Button --}}
            <div class="text-center">
                <a href="{{ route('players.index') }}"
                   class="inline-flex items-center gap-3 px-6 py-3 bg-card text-foreground border-2 border-primary rounded-[var(--radius-base)] font-semibold hover:bg-primary hover:text-primary-foreground transition-all hover:-translate-y-0.5 shadow-sm">
                    <span class="text-xl">←</span>
                    {{ __('Retour aux joueurs') }}
                </a>
            </div>
        </div>
    </div>
@endsection
