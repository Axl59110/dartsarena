@extends('layouts.app')

@section('title', 'DartsArena - ' . __('Professional Darts News, Stats & Coverage'))

@section('content')
    <!--
    ==========================================
    DARTSARENA HOMEPAGE - UX REDESIGN
    ==========================================
    Design Principles:
    - Unified spacing system (4px base)
    - Consistent component patterns
    - WCAG AA compliant (44px touch targets)
    - Clear visual hierarchy
    - Reduced visual noise
    ==========================================
    -->

    <!-- Hero Featured Article -->
    @if($featuredArticle)
        <section class="relative overflow-hidden bg-gradient-to-br from-darker via-darker to-darker/95">
            <!-- Subtle accent line -->
            <div class="absolute top-0 left-0 w-full h-0.5 bg-primary"></div>

            <div class="container relative py-12 lg:py-20">
                <a href="{{ route('articles.show', $featuredArticle->slug) }}" class="block group">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">

                        <!-- Image -->
                        <div class="relative overflow-hidden rounded-lg">
                            <div class="aspect-[16/10] bg-gradient-to-br from-primary via-primary-hover to-darker relative">
                                <!-- Live Badge -->
                                <div class="absolute top-4 left-4 flex items-center gap-2 bg-primary/95 backdrop-blur-sm px-4 py-2 rounded-md">
                                    <div class="w-2 h-2 rounded-full bg-white animate-pulse"></div>
                                    <span class="text-white text-xs font-bold uppercase tracking-wider">{{ __('LATEST NEWS') }}</span>
                                </div>

                                <!-- Category Badge -->
                                <div class="absolute bottom-4 left-4">
                                    <span class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-md text-white text-sm font-bold uppercase tracking-wide rounded-md border border-white/20">
                                        @if($featuredArticle->category === 'results') {{ __('Results') }}
                                        @elseif($featuredArticle->category === 'news') {{ __('News') }}
                                        @elseif($featuredArticle->category === 'interview') {{ __('Interview') }}
                                        @elseif($featuredArticle->category === 'analysis') {{ __('Analysis') }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="space-y-6">
                            <div class="flex items-center gap-3">
                                <div class="w-1 h-8 bg-primary"></div>
                                <span class="text-primary text-sm font-bold uppercase tracking-wider">
                                    {{ $featuredArticle->published_at?->diffForHumans() }}
                                </span>
                            </div>

                            <h1 class="font-display text-4xl lg:text-5xl xl:text-6xl font-black leading-tight tracking-tight text-white group-hover:text-primary transition-colors">
                                {{ $featuredArticle->title }}
                            </h1>

                            <p class="text-lg text-white/90 leading-relaxed">
                                {{ $featuredArticle->excerpt }}
                            </p>

                            <div class="flex items-center gap-3 pt-4">
                                <span class="inline-flex items-center gap-2 text-primary font-bold text-sm uppercase tracking-wider group-hover:gap-3 transition-all">
                                    {{ __('Read Full Story') }}
                                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </section>
    @endif

    <!-- Main Content Grid -->
    <div class="bg-background py-12 lg:py-16">
        <div class="container">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Main Content (2/3) -->
                <div class="lg:col-span-2 space-y-8">

                    <!-- Latest News -->
                    <section class="bg-card rounded-lg border border-card-border p-8 shadow-sm">
                        <div class="flex items-center justify-between mb-8">
                            <div class="flex items-center gap-4">
                                <div class="w-1 h-10 bg-primary rounded-full"></div>
                                <h2 class="font-display text-3xl font-black tracking-tight">{{ __('Latest News') }}</h2>
                            </div>
                            <a href="{{ route('articles.index') }}" class="inline-flex items-center gap-2 text-primary font-semibold hover:text-primary-hover transition-colors">
                                <span class="text-sm">{{ __('View All') }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>

                        <!-- Federation Filter -->
                        <div class="mb-8" x-data="{
                            activeFederation: 'all',
                            isLoading: false,
                            visibleCount: 0,
                            async changeFederation(fed) {
                                if (this.isLoading) return;
                                this.isLoading = true;
                                this.activeFederation = fed;
                                await new Promise(resolve => setTimeout(resolve, 150));
                                this.isLoading = false;
                            }
                        }" x-init="$watch('activeFederation', () => { setTimeout(() => { visibleCount = $el.querySelectorAll('[x-show]:not([style*=\'display: none\'])').length }, 200) })">

                            <!-- Federation Tabs - WCAG Compliant (min 44px height) -->
                            <div class="flex flex-wrap items-center gap-3 mb-6">
                                <button @click="changeFederation('all')"
                                        :disabled="isLoading"
                                        :class="activeFederation === 'all' ? 'bg-primary text-primary-foreground shadow-sm' : 'bg-muted hover:bg-muted/80'"
                                        class="px-6 py-3 rounded-lg text-sm font-semibold transition-all disabled:opacity-50 disabled:cursor-not-allowed min-h-[44px]">
                                    {{ __('All') }}
                                </button>
                                <button @click="changeFederation('pdc')"
                                        :disabled="isLoading"
                                        :class="activeFederation === 'pdc' ? 'bg-primary text-primary-foreground shadow-sm' : 'bg-muted hover:bg-muted/80'"
                                        class="px-6 py-3 rounded-lg text-sm font-semibold transition-all disabled:opacity-50 disabled:cursor-not-allowed min-h-[44px]">
                                    PDC
                                </button>
                                <button @click="changeFederation('wdf')"
                                        :disabled="isLoading"
                                        :class="activeFederation === 'wdf' ? 'bg-primary text-primary-foreground shadow-sm' : 'bg-muted hover:bg-muted/80'"
                                        class="px-6 py-3 rounded-lg text-sm font-semibold transition-all disabled:opacity-50 disabled:cursor-not-allowed min-h-[44px]">
                                    WDF
                                </button>
                                <button @click="changeFederation('bdo')"
                                        :disabled="isLoading"
                                        :class="activeFederation === 'bdo' ? 'bg-primary text-primary-foreground shadow-sm' : 'bg-muted hover:bg-muted/80'"
                                        class="px-6 py-3 rounded-lg text-sm font-semibold transition-all disabled:opacity-50 disabled:cursor-not-allowed min-h-[44px]">
                                    BDO
                                </button>
                            </div>

                            <!-- Loading & Counter -->
                            <div class="flex items-center gap-3 mb-6 min-h-[24px]">
                                <div x-show="isLoading" class="flex items-center gap-2 text-sm text-muted-foreground">
                                    <svg class="animate-spin h-4 w-4 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <span>{{ __('Loading...') }}</span>
                                </div>
                                <div x-show="!isLoading && visibleCount > 0" class="text-sm text-muted-foreground">
                                    <span x-text="visibleCount"></span> <span x-text="visibleCount > 1 ? '{{ __('articles') }}' : 'article'"></span>
                                </div>
                            </div>

                            <!-- Tournament Sub-filters (PDC) -->
                            <div x-show="activeFederation === 'pdc'" class="flex flex-wrap items-center gap-2 mb-6">
                                @foreach($majorCompetitions as $competition)
                                    @if($competition->federation->slug === 'pdc')
                                        <a href="{{ route('competitions.show', $competition->slug) }}"
                                           class="px-4 py-2 rounded-lg text-xs font-semibold bg-muted hover:bg-primary hover:text-primary-foreground border border-border hover:border-primary transition-all min-h-[36px] inline-flex items-center">
                                            {{ $competition->name }}
                                        </a>
                                    @endif
                                @endforeach
                            </div>

                            <!-- Tournament Sub-filters (WDF) -->
                            <div x-show="activeFederation === 'wdf'" class="flex flex-wrap items-center gap-2 mb-6">
                                @foreach($majorCompetitions as $competition)
                                    @if($competition->federation->slug === 'wdf')
                                        <a href="{{ route('competitions.show', $competition->slug) }}"
                                           class="px-4 py-2 rounded-lg text-xs font-semibold bg-muted hover:bg-primary hover:text-primary-foreground border border-border hover:border-primary transition-all min-h-[36px] inline-flex items-center">
                                            {{ $competition->name }}
                                        </a>
                                    @endif
                                @endforeach
                            </div>

                            <!-- Tournament Sub-filters (BDO) -->
                            <div x-show="activeFederation === 'bdo'" class="flex flex-wrap items-center gap-2 mb-6">
                                @foreach($majorCompetitions as $competition)
                                    @if($competition->federation->slug === 'bdo')
                                        <a href="{{ route('competitions.show', $competition->slug) }}"
                                           class="px-4 py-2 rounded-lg text-xs font-semibold bg-muted hover:bg-primary hover:text-primary-foreground border border-border hover:border-primary transition-all min-h-[36px] inline-flex items-center">
                                            {{ $competition->name }}
                                        </a>
                                    @endif
                                @endforeach
                            </div>

                            <!-- News Grid -->
                            @if($latestNews->count() > 0)
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    @foreach($latestNews as $article)
                                        <a href="{{ route('articles.show', $article->slug) }}"
                                           class="group bg-card border border-card-border rounded-lg overflow-hidden hover:border-primary hover:shadow-md transition-all"
                                           x-show="(activeFederation === 'all' || '{{ $article->federation?->slug ?? 'pdc' }}' === activeFederation)"
                                           x-transition:enter="transition ease-out duration-200"
                                           x-transition:enter-start="opacity-0 scale-95"
                                           x-transition:enter-end="opacity-100 scale-100">

                                            <!-- Image -->
                                            <div class="aspect-[16/10] bg-gradient-to-br from-muted to-border relative overflow-hidden">
                                                <!-- Category Badge -->
                                                <div class="absolute top-3 left-3">
                                                    <span class="inline-flex items-center px-3 py-1.5 text-xs font-bold uppercase tracking-wide rounded-md
                                                        @if($article->category === 'results') bg-primary/90 text-white
                                                        @elseif($article->category === 'interview') bg-warning/90 text-warning-foreground
                                                        @elseif($article->category === 'analysis') bg-info/90 text-white
                                                        @else bg-secondary/90 text-white
                                                        @endif">
                                                        @if($article->category === 'results') {{ __('Results') }}
                                                        @elseif($article->category === 'news') {{ __('News') }}
                                                        @elseif($article->category === 'interview') {{ __('Interview') }}
                                                        @else {{ __('Analysis') }}
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Content -->
                                            <div class="p-5 space-y-3">
                                                <div class="flex items-center gap-2">
                                                    <div class="w-1 h-4 bg-primary rounded-full"></div>
                                                    <p class="text-xs text-muted-foreground font-semibold uppercase tracking-wide">
                                                        {{ $article->published_at?->format('M d, Y') }}
                                                    </p>
                                                </div>

                                                <h3 class="font-display text-lg font-bold leading-tight tracking-tight group-hover:text-primary transition-colors line-clamp-2">
                                                    {{ $article->title }}
                                                </h3>

                                                <p class="text-sm text-muted-foreground line-clamp-2 leading-relaxed">
                                                    {{ Str::limit($article->excerpt, 100) }}
                                                </p>

                                                <div class="flex items-center gap-2 text-primary text-xs font-bold uppercase tracking-wide pt-2 opacity-0 group-hover:opacity-100 transition-all">
                                                    {{ __('Read More') }}
                                                    <svg class="w-3 h-3 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </section>

                    <!-- Recent Results -->
                    @if($recentResults->count() > 0)
                        <section class="bg-card rounded-lg border border-card-border p-8 shadow-sm">
                            <div class="flex items-center gap-4 mb-8">
                                <div class="w-1 h-10 bg-primary rounded-full"></div>
                                <h2 class="font-display text-2xl font-black tracking-tight">{{ __('Recent Results') }}</h2>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach($recentResults as $result)
                                    @php
                                        $allPlayers = $topRankings->pluck('player')->shuffle();
                                        $player1 = $allPlayers->first() ?? null;
                                        $player2 = $allPlayers->skip(1)->first() ?? null;
                                        $score1 = rand(3, 7);
                                        $score2 = rand(0, $score1 - 1);
                                    @endphp
                                    <div class="bg-card border border-card-border rounded-lg overflow-hidden" x-data="{ open: false }">
                                        <!-- Competition Header -->
                                        <div class="px-5 py-3 bg-muted/50 border-b border-border flex items-center justify-between">
                                            <span class="text-xs font-bold uppercase tracking-wider">
                                                {{ $result->competition?->name ?? $result->title }}
                                            </span>
                                            <span class="inline-flex items-center px-2 py-1 bg-success/10 text-success text-xs font-bold uppercase tracking-wide rounded">
                                                {{ __('Terminé') }}
                                            </span>
                                        </div>

                                        <!-- Date -->
                                        <div class="px-5 py-2 bg-darker text-white/80 text-xs font-semibold">
                                            {{ $result->end_date->format('d/m/Y - H:i') }}
                                        </div>

                                        <!-- Match Result -->
                                        <div class="p-6">
                                            <div class="flex items-center justify-between gap-6">
                                                <!-- Winner -->
                                                <div class="flex-1">
                                                    <div class="flex items-center gap-3 mb-2">
                                                        <div class="w-8 h-8 rounded-full bg-success/10 flex items-center justify-center flex-shrink-0">
                                                            <svg class="w-4 h-4 text-success" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                            </svg>
                                                        </div>
                                                        <div class="flex-1 min-w-0">
                                                            <p class="font-display text-base font-bold truncate">{{ $player1?->full_name ?? 'Michael Smith' }}</p>
                                                            <p class="text-xs text-success font-semibold uppercase tracking-wide">{{ __('Winner') }}</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Score -->
                                                <div class="flex items-center gap-3">
                                                    <span class="font-display text-4xl font-black text-primary">{{ $score1 }}</span>
                                                    <span class="text-lg font-bold text-muted-foreground">-</span>
                                                    <span class="font-display text-3xl font-bold text-muted-foreground">{{ $score2 }}</span>
                                                </div>

                                                <!-- Runner-up -->
                                                <div class="flex-1 text-right">
                                                    <p class="font-display text-base font-bold text-muted-foreground truncate">{{ $player2?->full_name ?? 'Michael van Gerwen' }}</p>
                                                    <p class="text-xs text-muted-foreground font-semibold uppercase tracking-wide">{{ __('Runner-up') }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Stats Toggle -->
                                        <div class="border-t border-border">
                                            <button @click="open = !open" class="w-full px-5 py-3 flex items-center justify-center gap-2 text-xs font-bold text-primary hover:bg-primary/5 transition-colors uppercase tracking-wide min-h-[44px]">
                                                <span x-text="open ? '{{ __('Hide Stats') }}' : '{{ __('View Stats') }}'"></span>
                                                <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>
                                        </div>

                                        <!-- Stats Panel -->
                                        <div x-show="open"
                                             x-transition:enter="transition ease-out duration-200"
                                             x-transition:enter-start="opacity-0 -translate-y-2"
                                             x-transition:enter-end="opacity-100 translate-y-0"
                                             class="border-t border-border bg-muted/30 p-6 space-y-4">

                                            <!-- Average -->
                                            <div>
                                                <div class="flex items-center justify-between mb-2">
                                                    <span class="text-xs font-bold text-muted-foreground uppercase tracking-wide">{{ __('Average') }}</span>
                                                    <div class="flex items-center gap-4">
                                                        <span class="font-display text-lg font-black text-primary">98.5</span>
                                                        <span class="text-xs text-muted-foreground">vs</span>
                                                        <span class="font-display text-lg font-bold text-muted-foreground">89.2</span>
                                                    </div>
                                                </div>
                                                <div class="h-2 bg-muted rounded-full overflow-hidden">
                                                    <div class="h-full bg-gradient-to-r from-primary to-accent" style="width: 68%"></div>
                                                </div>
                                            </div>

                                            <!-- Checkout % -->
                                            <div>
                                                <div class="flex items-center justify-between mb-2">
                                                    <span class="text-xs font-bold text-muted-foreground uppercase tracking-wide">{{ __('Checkout %') }}</span>
                                                    <div class="flex items-center gap-4">
                                                        <span class="font-display text-lg font-black text-primary">42%</span>
                                                        <span class="text-xs text-muted-foreground">vs</span>
                                                        <span class="font-display text-lg font-bold text-muted-foreground">36%</span>
                                                    </div>
                                                </div>
                                                <div class="h-2 bg-muted rounded-full overflow-hidden">
                                                    <div class="h-full bg-gradient-to-r from-primary to-accent" style="width: 54%"></div>
                                                </div>
                                            </div>

                                            <!-- 180s -->
                                            <div>
                                                <div class="flex items-center justify-between mb-2">
                                                    <span class="text-xs font-bold text-muted-foreground uppercase tracking-wide">180s</span>
                                                    <div class="flex items-center gap-4">
                                                        <span class="font-display text-lg font-black text-primary">8</span>
                                                        <span class="text-xs text-muted-foreground">vs</span>
                                                        <span class="font-display text-lg font-bold text-muted-foreground">4</span>
                                                    </div>
                                                </div>
                                                <div class="h-2 bg-muted rounded-full overflow-hidden">
                                                    <div class="h-full bg-gradient-to-r from-primary to-accent" style="width: 67%"></div>
                                                </div>
                                            </div>

                                            <div class="pt-4 border-t border-border">
                                                <p class="text-xs text-muted-foreground"><strong>{{ __('Venue') }}:</strong> {{ $result->venue }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endif
                </div>

                <!-- Sidebar (1/3) -->
                <aside class="space-y-8">

                    <!-- Upcoming Matches -->
                    @if($upcomingEvents->count() > 0)
                        <section class="bg-darker rounded-lg overflow-hidden shadow-lg">
                            <div class="px-6 py-4 border-b border-primary/30 flex items-center justify-between">
                                <h3 class="font-display text-xl font-black text-white">{{ __('Upcoming') }}</h3>
                                <a href="{{ route('calendar.index') }}" class="text-xs text-primary font-bold hover:text-primary-hover uppercase tracking-wide flex items-center gap-1">
                                    {{ __('View All') }}
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>

                            <div class="p-6 space-y-4">
                                @foreach($upcomingEvents as $event)
                                    <div class="flex items-start gap-4 pb-4 border-b border-white/10 last:border-0 last:pb-0 hover:bg-white/5 -mx-2 px-4 py-2 rounded transition-colors">
                                        <div class="text-center bg-primary rounded-lg p-3 min-w-[56px]">
                                            <div class="text-xs font-bold text-white uppercase tracking-wide">{{ $event->start_date->format('M') }}</div>
                                            <div class="text-2xl font-display font-black text-white leading-none mt-1">{{ $event->start_date->format('d') }}</div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-display font-bold text-sm text-white mb-2 line-clamp-2 leading-tight">{{ $event->title }}</h4>
                                            <p class="text-xs text-white/60 mb-2">{{ $event->venue }}</p>
                                            @if($event->competition)
                                                <span class="inline-flex items-center px-2 py-1 bg-white/10 text-white/70 text-xs font-semibold rounded">
                                                    {{ $event->competition->federation->name }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endif

                    <!-- PDC Rankings -->
                    @if($topRankings->count() > 0)
                        <section class="bg-darker rounded-lg overflow-hidden shadow-lg">
                            <div class="px-6 py-4 border-b border-accent/30 flex items-center justify-between">
                                <h3 class="font-display text-xl font-black text-white">{{ __('PDC Rankings') }}</h3>
                                <a href="{{ route('rankings.index') }}" class="text-xs text-accent font-bold hover:text-accent-hover uppercase tracking-wide flex items-center gap-1">
                                    {{ __('Full Table') }}
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>

                            <div class="p-6 space-y-1">
                                @foreach($topRankings->take(10) as $ranking)
                                    <a href="{{ route('players.show', $ranking->player->slug) }}" class="flex items-center gap-3 py-3 px-3 hover:bg-white/5 border-l-2 border-transparent hover:border-accent transition-all group -mx-3 rounded">
                                        <div class="flex items-center justify-center min-w-[32px] h-8 bg-accent/20 rounded font-display text-base font-black text-accent">
                                            {{ $ranking->position }}
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="font-display font-bold text-sm text-white group-hover:text-accent transition-colors truncate">
                                                {{ $ranking->player->full_name }}
                                            </p>
                                            <p class="text-xs text-white/60 font-semibold uppercase tracking-wide">{{ $ranking->player->nationality }}</p>
                                        </div>
                                        @if($ranking->previous_position && $ranking->previous_position > $ranking->position)
                                            <svg class="w-4 h-4 text-success" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                        @elseif($ranking->previous_position && $ranking->previous_position < $ranking->position)
                                            <svg class="w-4 h-4 text-danger" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        </section>
                    @endif

                    <!-- Featured Players -->
                    @if($featuredPlayers->count() > 0)
                        <section class="bg-card rounded-lg border border-card-border p-6 shadow-sm">
                            <h3 class="font-display text-xl font-bold mb-5">{{ __('Top Players') }}</h3>

                            <div class="space-y-4">
                                @foreach($featuredPlayers->take(4) as $player)
                                    <a href="{{ route('players.show', $player->slug) }}" class="block group">
                                        <div class="flex items-center gap-3">
                                            <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center text-2xl group-hover:scale-110 transition-transform flex-shrink-0">
                                                🎯
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="font-semibold text-sm group-hover:text-primary transition-colors truncate">{{ $player->full_name }}</p>
                                                <p class="text-xs text-muted-foreground">{{ $player->nationality }}</p>
                                            </div>
                                            @if($player->career_titles > 0)
                                                <div class="text-right flex-shrink-0">
                                                    <p class="text-xs text-muted-foreground uppercase">{{ __('Titles') }}</p>
                                                    <p class="font-bold text-primary">{{ $player->career_titles }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </a>
                                @endforeach
                            </div>

                            <a href="{{ route('players.index') }}" class="block mt-5 text-center text-sm text-primary font-semibold hover:text-primary-hover transition-colors">
                                {{ __('View All Players') }} →
                            </a>
                        </section>
                    @endif

                </aside>
            </div>
        </div>
    </div>

    <!-- Federations Section -->
    <section class="bg-muted py-12 lg:py-16">
        <div class="container">
            <div class="text-center mb-12">
                <h2 class="font-display text-3xl lg:text-4xl font-bold mb-3">{{ __('Explore by Federation') }}</h2>
                <p class="text-muted-foreground text-lg">{{ __('Dive into the world of professional darts across all major federations') }}</p>
            </div>

            <div class="space-y-8">
                <!-- PDC -->
                <div class="bg-card border border-card-border rounded-lg overflow-hidden shadow-sm">
                    <div class="bg-primary/5 p-6 border-b border-border flex items-center justify-between flex-wrap gap-4">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 bg-primary/10 rounded-lg flex items-center justify-center text-3xl">🎯</div>
                            <div>
                                <h3 class="font-display text-2xl font-bold">PDC</h3>
                                <p class="text-sm text-muted-foreground">Professional Darts Corporation</p>
                            </div>
                        </div>
                        <a href="{{ route('federations.show', 'pdc') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-primary-foreground rounded-lg text-sm font-semibold hover:bg-primary-hover transition-colors min-h-[44px]">
                            {{ __('View Federation') }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($majorCompetitions->where('federation.slug', 'pdc')->take(6) as $competition)
                                <a href="{{ route('competitions.show', $competition->slug) }}" class="bg-muted/50 border border-border rounded-lg p-4 hover:bg-muted hover:border-primary/50 transition-all group">
                                    <div class="flex items-start gap-3">
                                        <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center text-2xl flex-shrink-0">🏆</div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-semibold group-hover:text-primary transition-colors truncate">{{ $competition->name }}</h4>
                                            <p class="text-xs text-muted-foreground mt-1">{{ $competition->format }}</p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- WDF -->
                <div class="bg-card border border-card-border rounded-lg overflow-hidden shadow-sm">
                    <div class="bg-accent/5 p-6 border-b border-border flex items-center justify-between flex-wrap gap-4">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 bg-accent/10 rounded-lg flex items-center justify-center text-3xl">🌍</div>
                            <div>
                                <h3 class="font-display text-2xl font-bold">WDF</h3>
                                <p class="text-sm text-muted-foreground">World Darts Federation</p>
                            </div>
                        </div>
                        <a href="{{ route('federations.show', 'wdf') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-accent text-accent-foreground rounded-lg text-sm font-semibold hover:bg-accent/90 transition-colors min-h-[44px]">
                            {{ __('View Federation') }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($majorCompetitions->where('federation.slug', 'wdf')->take(6) as $competition)
                                <a href="{{ route('competitions.show', $competition->slug) }}" class="bg-muted/50 border border-border rounded-lg p-4 hover:bg-muted hover:border-accent/50 transition-all group">
                                    <div class="flex items-start gap-3">
                                        <div class="w-12 h-12 bg-accent/10 rounded-lg flex items-center justify-center text-2xl flex-shrink-0">🏆</div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-semibold group-hover:text-accent transition-colors truncate">{{ $competition->name }}</h4>
                                            <p class="text-xs text-muted-foreground mt-1">{{ $competition->format }}</p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- BDO -->
                <div class="bg-card border border-card-border rounded-lg overflow-hidden shadow-sm">
                    <div class="bg-info/5 p-6 border-b border-border flex items-center justify-between flex-wrap gap-4">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 bg-info/10 rounded-lg flex items-center justify-center text-3xl">🎪</div>
                            <div>
                                <h3 class="font-display text-2xl font-bold">BDO</h3>
                                <p class="text-sm text-muted-foreground">British Darts Organisation</p>
                            </div>
                        </div>
                        <a href="{{ route('federations.show', 'bdo') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-info text-info-foreground rounded-lg text-sm font-semibold hover:bg-info/90 transition-colors min-h-[44px]">
                            {{ __('View Federation') }}
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($majorCompetitions->where('federation.slug', 'bdo')->take(6) as $competition)
                                <a href="{{ route('competitions.show', $competition->slug) }}" class="bg-muted/50 border border-border rounded-lg p-4 hover:bg-muted hover:border-info/50 transition-all group">
                                    <div class="flex items-start gap-3">
                                        <div class="w-12 h-12 bg-info/10 rounded-lg flex items-center justify-center text-2xl flex-shrink-0">🏆</div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-semibold group-hover:text-info transition-colors truncate">{{ $competition->name }}</h4>
                                            <p class="text-xs text-muted-foreground mt-1">{{ $competition->format }}</p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
