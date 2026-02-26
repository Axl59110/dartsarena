@extends('layouts.app')

@section('title', $player->full_name . ' - ' . __('Fiche Joueur') . ' | DartsArena')

@section('breadcrumbs')
    <div class="breadcrumbs py-3">
        <a href="{{ route('home') }}">{{ __('Home') }}</a>
        <span class="text-muted-foreground mx-2">/</span>
        <a href="{{ route('players.index') }}">{{ __('Players') }}</a>
        <span class="text-muted-foreground mx-2">/</span>
        <span class="text-foreground">{{ $player->full_name }}</span>
    </div>
@endsection

@section('content')
    {{-- Schema.org Person Markup --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Person",
        "name": "{{ $player->full_name }}",
        "alternateName": "{{ $player->nickname }}",
        "nationality": "{{ $player->nationality }}",
        @if($player->photo_url)
        "image": "{{ asset($player->photo_url) }}",
        @endif
        @if($player->date_of_birth)
        "birthDate": "{{ $player->date_of_birth->format('Y-m-d') }}",
        @endif
        "description": "{{ strip_tags($player->bio ?? 'Professional darts player') }}",
        "jobTitle": "Professional Darts Player",
        "award": "{{ $player->career_titles }} career titles"
    }
    </script>

    {{-- Player Hero Section --}}
    <section class="bg-gradient-to-b from-muted/30 to-background">
        <div class="container py-8 lg:py-12">
            <div class="flex flex-col lg:flex-row items-center lg:items-start gap-8">
                {{-- Photo with Ranking Badge --}}
                <div class="relative flex-shrink-0">
                    @if($player->photo_url)
                        <img
                            src="{{ $player->photo_url }}"
                            alt="{{ $player->full_name }}"
                            loading="lazy"
                            class="w-32 h-32 lg:w-48 lg:h-48 rounded-full object-cover border-4 border-primary/40 shadow-xl"
                            onerror="this.outerHTML='<div class=\'w-32 h-32 lg:w-48 lg:h-48 bg-gradient-to-br from-primary/20 to-primary/10 rounded-full flex items-center justify-center border-4 border-primary/40 shadow-xl\'><span class=\'text-5xl lg:text-7xl font-bold text-primary\'>{{ strtoupper(substr($player->first_name, 0, 1)) }}{{ strtoupper(substr($player->last_name, 0, 1)) }}</span></div>'"
                        />
                    @else
                        <div class="w-32 h-32 lg:w-48 lg:h-48 bg-gradient-to-br from-primary/20 to-primary/10 rounded-full flex items-center justify-center border-4 border-primary/40 shadow-xl">
                            <span class="text-5xl lg:text-7xl font-bold text-primary">
                                {{ strtoupper(substr($player->first_name, 0, 1)) }}{{ strtoupper(substr($player->last_name, 0, 1)) }}
                            </span>
                        </div>
                    @endif

                    @if($latestRanking)
                        <div class="absolute -bottom-2 -right-2 w-14 h-14 lg:w-16 lg:h-16 bg-primary rounded-full flex items-center justify-center border-4 border-background shadow-lg">
                            <span class="font-display text-lg lg:text-xl font-bold text-primary-foreground">#{{ $latestRanking->position }}</span>
                        </div>
                    @endif
                </div>

                {{-- Player Info --}}
                <div class="flex-1 text-center lg:text-left">
                    <h1 class="font-display text-4xl lg:text-5xl font-bold text-foreground leading-tight mb-2">
                        {{ $player->full_name }}
                    </h1>

                    @if($player->nickname)
                        <p class="text-primary text-xl lg:text-2xl font-semibold italic mb-4">
                            "{{ $player->nickname }}"
                        </p>
                    @endif

                    <div class="flex flex-wrap items-center justify-center lg:justify-start gap-4 text-muted-foreground">
                        @if($player->country_code)
                            <span class="flex items-center gap-2 text-base">
                                <span class="text-2xl">{{ \Illuminate\Support\Str::upper($player->country_code) === 'GB' ? '🇬🇧' : '🌍' }}</span>
                                <span class="font-medium">{{ $player->nationality }}</span>
                            </span>
                        @endif

                        @if($player->date_of_birth)
                            <span class="text-muted-foreground">•</span>
                            <span class="flex items-center gap-2 text-base">
                                <span class="font-medium">{{ $player->date_of_birth->age }} {{ __('ans') }}</span>
                            </span>
                        @endif

                        @if($latestRanking)
                            <span class="text-muted-foreground">•</span>
                            <span class="flex items-center gap-2 text-base">
                                <span class="font-semibold text-primary">#{{ $latestRanking->position }} {{ $latestRanking->federation->name ?? 'PDC' }}</span>
                            </span>
                        @endif
                    </div>

                    {{-- Quick Stats --}}
                    <div class="flex flex-wrap items-center justify-center lg:justify-start gap-6 mt-6">
                        @if($player->career_titles > 0)
                            <div class="text-center">
                                <div class="font-display text-3xl font-bold text-primary">{{ $player->career_titles }}</div>
                                <div class="text-sm text-muted-foreground uppercase tracking-wide">{{ __('Titres') }}</div>
                            </div>
                        @endif

                        @if($player->career_9darters > 0)
                            <div class="text-center">
                                <div class="font-display text-3xl font-bold text-foreground">{{ $player->career_9darters }}</div>
                                <div class="text-sm text-muted-foreground uppercase tracking-wide">9-Darters</div>
                            </div>
                        @endif

                        @if($player->career_highest_average)
                            <div class="text-center">
                                <div class="font-display text-3xl font-bold text-foreground">{{ $player->career_highest_average }}</div>
                                <div class="text-sm text-muted-foreground uppercase tracking-wide">{{ __('Best Avg') }}</div>
                            </div>
                        @endif

                        @if(isset($careerStats['win_rate']) && $careerStats['win_rate'] > 0)
                            <div class="text-center">
                                <div class="font-display text-3xl font-bold text-green-600">{{ $careerStats['win_rate'] }}%</div>
                                <div class="text-sm text-muted-foreground uppercase tracking-wide">{{ __('Win Rate') }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Tabs Section --}}
    <div class="container py-8 lg:py-12" x-data="{ activeTab: window.location.hash ? window.location.hash.substring(1) : 'profil' }">
        <div class="max-w-6xl mx-auto">
            {{-- Tabs Navigation --}}
            <div class="border-b border-border mb-8 overflow-x-auto">
                <nav class="flex gap-1 min-w-max" role="tablist">
                    <button
                        @click="activeTab = 'profil'; window.location.hash = 'profil'"
                        :class="activeTab === 'profil' ? 'border-primary text-primary' : 'border-transparent text-muted-foreground hover:text-foreground hover:border-muted'"
                        class="px-6 py-3 border-b-2 font-semibold transition-colors whitespace-nowrap"
                        role="tab"
                    >
                        {{ __('Profil') }}
                    </button>
                    <button
                        @click="activeTab = 'stats'; window.location.hash = 'stats'"
                        :class="activeTab === 'stats' ? 'border-primary text-primary' : 'border-transparent text-muted-foreground hover:text-foreground hover:border-muted'"
                        class="px-6 py-3 border-b-2 font-semibold transition-colors whitespace-nowrap"
                        role="tab"
                    >
                        {{ __('Statistiques') }}
                    </button>
                    <button
                        @click="activeTab = 'palmares'; window.location.hash = 'palmares'"
                        :class="activeTab === 'palmares' ? 'border-primary text-primary' : 'border-transparent text-muted-foreground hover:text-foreground hover:border-muted'"
                        class="px-6 py-3 border-b-2 font-semibold transition-colors whitespace-nowrap"
                        role="tab"
                    >
                        {{ __('Palmarès') }}
                    </button>
                    <button
                        @click="activeTab = 'matchs'; window.location.hash = 'matchs'"
                        :class="activeTab === 'matchs' ? 'border-primary text-primary' : 'border-transparent text-muted-foreground hover:text-foreground hover:border-muted'"
                        class="px-6 py-3 border-b-2 font-semibold transition-colors whitespace-nowrap"
                        role="tab"
                    >
                        {{ __('Matchs Récents') }}
                    </button>
                </nav>
            </div>

            {{-- Tab: Profil --}}
            <div x-show="activeTab === 'profil'" x-transition role="tabpanel">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    {{-- Bio Card --}}
                    <div class="lg:col-span-2">
                        <x-card class="p-6 lg:p-8">
                            <h2 class="font-display text-2xl font-bold text-foreground mb-4">{{ __('Biographie') }}</h2>
                            @if($player->bio)
                                <p class="text-lg leading-relaxed text-muted-foreground whitespace-pre-line">{{ $player->bio }}</p>
                            @else
                                <p class="text-muted-foreground italic">{{ __('Aucune biographie disponible pour le moment.') }}</p>
                            @endif
                        </x-card>
                    </div>

                    {{-- Info Card --}}
                    <div>
                        <x-card class="p-6">
                            <h3 class="font-display text-xl font-bold text-foreground mb-4">{{ __('Informations') }}</h3>
                            <dl class="space-y-3">
                                <div>
                                    <dt class="text-sm text-muted-foreground font-semibold uppercase tracking-wide mb-1">{{ __('Nom Complet') }}</dt>
                                    <dd class="text-foreground font-medium">{{ $player->full_name }}</dd>
                                </div>

                                @if($player->nickname)
                                <div>
                                    <dt class="text-sm text-muted-foreground font-semibold uppercase tracking-wide mb-1">{{ __('Surnom') }}</dt>
                                    <dd class="text-foreground font-medium italic">"{{ $player->nickname }}"</dd>
                                </div>
                                @endif

                                <div>
                                    <dt class="text-sm text-muted-foreground font-semibold uppercase tracking-wide mb-1">{{ __('Nationalité') }}</dt>
                                    <dd class="text-foreground font-medium">{{ $player->nationality }}</dd>
                                </div>

                                @if($player->date_of_birth)
                                <div>
                                    <dt class="text-sm text-muted-foreground font-semibold uppercase tracking-wide mb-1">{{ __('Date de Naissance') }}</dt>
                                    <dd class="text-foreground font-medium">{{ $player->date_of_birth->format('d/m/Y') }} ({{ $player->date_of_birth->age }} {{ __('ans') }})</dd>
                                </div>
                                @endif

                                @if($latestRanking)
                                <div>
                                    <dt class="text-sm text-muted-foreground font-semibold uppercase tracking-wide mb-1">{{ __('Classement Actuel') }}</dt>
                                    <dd class="text-primary font-bold text-2xl">#{{ $latestRanking->position }}</dd>
                                </div>
                                @endif
                            </dl>
                        </x-card>
                    </div>
                </div>
            </div>

            {{-- Tab: Statistiques --}}
            <div x-show="activeTab === 'stats'" x-transition role="tabpanel">
                <x-card class="p-6 lg:p-8">
                    <h2 class="font-display text-2xl font-bold text-foreground mb-6">{{ __('Statistiques Carrière') }}</h2>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
                        <div class="text-center p-4 bg-muted/30 rounded-[var(--radius-base)]">
                            <div class="font-display text-4xl font-bold text-foreground mb-1">{{ $careerStats['total_matches'] ?? 0 }}</div>
                            <div class="text-sm text-muted-foreground font-semibold uppercase tracking-wide">{{ __('Matchs') }}</div>
                        </div>

                        <div class="text-center p-4 bg-green-500/10 rounded-[var(--radius-base)]">
                            <div class="font-display text-4xl font-bold text-green-600 mb-1">{{ $careerStats['wins'] ?? 0 }}</div>
                            <div class="text-sm text-muted-foreground font-semibold uppercase tracking-wide">{{ __('Victoires') }}</div>
                        </div>

                        <div class="text-center p-4 bg-red-500/10 rounded-[var(--radius-base)]">
                            <div class="font-display text-4xl font-bold text-red-600 mb-1">{{ $careerStats['losses'] ?? 0 }}</div>
                            <div class="text-sm text-muted-foreground font-semibold uppercase tracking-wide">{{ __('Défaites') }}</div>
                        </div>

                        <div class="text-center p-4 bg-primary/10 rounded-[var(--radius-base)]">
                            <div class="font-display text-4xl font-bold text-primary mb-1">{{ $careerStats['win_rate'] ?? 0 }}%</div>
                            <div class="text-sm text-muted-foreground font-semibold uppercase tracking-wide">{{ __('Win Rate') }}</div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-3 border-b border-border">
                            <span class="text-muted-foreground font-medium">{{ __('Moyenne (Average)') }}</span>
                            <span class="font-display text-2xl font-bold text-foreground">{{ $careerStats['avg_average'] ?? '-' }}</span>
                        </div>

                        <div class="flex justify-between items-center py-3 border-b border-border">
                            <span class="text-muted-foreground font-medium">{{ __('Checkout %') }}</span>
                            <span class="font-display text-2xl font-bold text-foreground">{{ $careerStats['avg_checkout'] ?? 0 }}%</span>
                        </div>

                        <div class="flex justify-between items-center py-3 border-b border-border">
                            <span class="text-muted-foreground font-medium">{{ __('Total 180s') }}</span>
                            <span class="font-display text-2xl font-bold text-foreground">{{ $careerStats['total_180s'] ?? 0 }}</span>
                        </div>

                        @if($player->career_9darters > 0)
                        <div class="flex justify-between items-center py-3 border-b border-border">
                            <span class="text-muted-foreground font-medium">{{ __('9-Darters en Carrière') }}</span>
                            <span class="font-display text-2xl font-bold text-primary">{{ $player->career_9darters }}</span>
                        </div>
                        @endif

                        @if($player->career_highest_average)
                        <div class="flex justify-between items-center py-3 border-b border-border">
                            <span class="text-muted-foreground font-medium">{{ __('Meilleure Moyenne') }}</span>
                            <span class="font-display text-2xl font-bold text-primary">{{ $player->career_highest_average }}</span>
                        </div>
                        @endif
                    </div>
                </x-card>
            </div>

            {{-- Tab: Palmarès --}}
            <div x-show="activeTab === 'palmares'" x-transition role="tabpanel">
                <x-card class="p-6 lg:p-8">
                    <h2 class="font-display text-2xl font-bold text-foreground mb-6">{{ __('Palmarès') }}</h2>

                    @if($player->career_titles > 0)
                        <div class="mb-6 p-4 bg-primary/10 rounded-[var(--radius-base)] border-l-4 border-primary">
                            <p class="text-lg">
                                <span class="font-display text-3xl font-bold text-primary">{{ $player->career_titles }}</span>
                                <span class="text-muted-foreground ml-2">{{ __('titres remportés en carrière') }}</span>
                            </p>
                        </div>

                        <div class="text-muted-foreground italic mb-4">
                            {{ __('Le détail des titres par compétition sera bientôt disponible.') }}
                        </div>
                    @else
                        <p class="text-muted-foreground italic">{{ __('Aucun titre remporté pour le moment.') }}</p>
                    @endif
                </x-card>
            </div>

            {{-- Tab: Matchs Récents --}}
            <div x-show="activeTab === 'matchs'" x-transition role="tabpanel">
                <x-card class="p-6 lg:p-8">
                    <h2 class="font-display text-2xl font-bold text-foreground mb-6">{{ __('Matchs Récents') }}</h2>

                    @if($recentMatches && $recentMatches->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentMatches as $match)
                                @php
                                    $isPlayer1 = $match->player1_id === $player->id;
                                    $opponent = $isPlayer1 ? $match->player2 : $match->player1;
                                    $playerScore = $isPlayer1 ? ($match->best_of_sets ? $match->player1_score_sets : $match->player1_score_legs) : ($match->best_of_sets ? $match->player2_score_sets : $match->player2_score_legs);
                                    $opponentScore = $isPlayer1 ? ($match->best_of_sets ? $match->player2_score_sets : $match->best_of_sets ? $match->player1_score_legs) : ($match->best_of_sets ? $match->player1_score_sets : $match->player1_score_legs);
                                    $won = $match->winner_id === $player->id;
                                @endphp

                                <div class="p-4 border border-border rounded-[var(--radius-base)] hover:border-primary transition-colors">
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-3 mb-2">
                                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $won ? 'bg-green-500/20 text-green-600' : 'bg-red-500/20 text-red-600' }}">
                                                    {{ $won ? __('W') : __('L') }}
                                                </span>
                                                <span class="text-sm text-muted-foreground">
                                                    {{ $match->scheduled_at ? $match->scheduled_at->format('d/m/Y') : '-' }}
                                                </span>
                                            </div>

                                            <div class="font-semibold text-foreground mb-1">
                                                {{ __('vs') }} {{ $opponent->full_name }}
                                            </div>

                                            @if($match->season && $match->season->competition)
                                                <div class="text-sm text-muted-foreground">
                                                    {{ $match->season->competition->name }} - {{ $match->round ?? __('Round') }}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="text-center sm:text-right">
                                            <div class="font-display text-2xl font-bold {{ $won ? 'text-green-600' : 'text-foreground' }}">
                                                {{ $playerScore }}-{{ $opponentScore }}
                                            </div>
                                            <div class="text-xs text-muted-foreground">
                                                {{ $match->best_of_sets ? __('Sets') : __('Legs') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted-foreground italic">{{ __('Aucun match récent disponible.') }}</p>
                    @endif
                </x-card>
            </div>

            {{-- Back Button --}}
            <div class="text-center mt-8">
                <a href="{{ route('players.index') }}"
                   class="inline-flex items-center gap-3 px-6 py-3 bg-card text-foreground border-2 border-primary rounded-[var(--radius-base)] font-semibold hover:bg-primary hover:text-primary-foreground transition-all hover:-translate-y-0.5 shadow-sm">
                    <span class="text-xl">←</span>
                    {{ __('Retour aux joueurs') }}
                </a>
            </div>
        </div>
    </div>
@endsection
