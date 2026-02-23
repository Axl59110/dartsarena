@extends('layouts.app')

@section('title', 'DartsArena - ' . __('Professional Darts News, Stats & Coverage'))

@section('content')
    <!-- Hero Featured Article -->
    @if($featuredArticle)
        <section class="hero-section relative overflow-hidden">
            <!-- Diagonal accent -->
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-primary to-transparent"></div>

            <div class="container relative py-8 lg:py-12">
                <a href="{{ route('articles.show', $featuredArticle->slug) }}" class="block group">
                    <div class="grid grid-cols-1 lg:grid-cols-[1.2fr_1fr] gap-6 lg:gap-8 items-center">
                        <!-- Image -->
                        <div class="relative img-frame cut-corner-br">
                            <div class="aspect-[16/9] bg-gradient-to-br from-primary/90 via-primary to-darker relative overflow-hidden">
                                <!-- Geometric pattern overlay -->
                                <div class="absolute inset-0 opacity-10">
                                    <div class="absolute top-0 right-0 w-64 h-64 border-4 border-white transform rotate-45 translate-x-32 -translate-y-32"></div>
                                    <div class="absolute bottom-0 left-0 w-48 h-48 border-4 border-white transform -rotate-12 -translate-x-24 translate-y-24"></div>
                                </div>

                                <!-- Live indicator - Simplifié -->
                                <div class="absolute top-0 left-0 flex items-center gap-2 bg-primary px-3 py-2 cut-corner-br">
                                    <div class="w-2 h-2 rounded-full bg-white animate-pulse"></div>
                                    <span class="text-white text-xs font-bold uppercase">{{ __('Live') }}</span>
                                </div>

                                <!-- Category tag -->
                                <div class="absolute bottom-3 left-3">
                                    <span class="inline-flex items-center px-3 py-1.5 text-xs font-bold uppercase border-l-3 border-white bg-white/10 text-white">
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
                        <div class="space-y-4 text-white relative bg-darker p-6 rounded-[var(--radius-base)] border border-white/10">
                            <div class="flex items-center gap-3">
                                <span class="text-primary text-sm font-bold uppercase">{{ $featuredArticle->published_at?->diffForHumans() }}</span>
                                <div class="h-px flex-1 bg-primary/30"></div>
                            </div>

                            <h1 class="font-display text-3xl lg:text-5xl font-black leading-[1.1] tracking-tight group-hover:text-primary transition-colors">
                                {{ $featuredArticle->title }}
                            </h1>

                            <p class="text-base leading-relaxed text-white">
                                {{ $featuredArticle->excerpt }}
                            </p>

                            <div class="flex items-center gap-3 pt-2">
                                <span class="inline-flex items-center gap-2 text-primary font-bold uppercase text-sm group-hover:gap-3 transition-all">
                                    {{ __('Read Full Story') }}
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                                    </svg>
                                </span>
                                <div class="h-px flex-1 bg-gradient-to-r from-primary to-transparent"></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </section>
    @endif

    <!-- Main Content Grid -->
    <div class="bg-muted py-8 lg:py-12">
        <div class="container">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Main Content (2/3) -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Latest News -->
                    <section class="bg-card rounded-[var(--radius-base)] border border-card-border p-6 shadow-sm">
                        <div class="flex items-center justify-between mb-6 pb-4 border-b border-border">
                            <div class="flex items-center gap-3">
                                <div class="w-1 h-8 bg-primary"></div>
                                <h2 class="font-display text-2xl font-bold tracking-tight">{{ __('Latest News') }}</h2>
                            </div>
                            <a href="{{ route('articles.index') }}" class="text-primary font-semibold hover:text-primary-hover flex items-center gap-1 text-sm">
                                {{ __('View All') }}
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>

                        <!-- Federation Filter -->
                        <div class="mb-6" x-data="{
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

                            <!-- Filter Tabs -->
                            <div class="flex flex-wrap gap-2 mb-4" role="tablist" aria-label="{{ __('Filter by federation') }}">
                                <button @click="changeFederation('all')"
                                        :disabled="isLoading"
                                        :class="activeFederation === 'all' ? 'bg-primary text-primary-foreground' : 'bg-muted hover:bg-muted/80'"
                                        class="px-4 py-2 rounded-[var(--radius-base)] text-sm font-semibold transition-colors disabled:opacity-50"
                                        role="tab"
                                        :aria-selected="activeFederation === 'all'"
                                        aria-label="{{ __('Show all federations') }}">
                                    {{ __('All') }}
                                </button>
                                <button @click="changeFederation('pdc')"
                                        :disabled="isLoading"
                                        :class="activeFederation === 'pdc' ? 'bg-primary text-primary-foreground' : 'bg-muted hover:bg-muted/80'"
                                        class="px-4 py-2 rounded-[var(--radius-base)] text-sm font-semibold transition-colors disabled:opacity-50"
                                        role="tab"
                                        :aria-selected="activeFederation === 'pdc'"
                                        aria-label="{{ __('Show PDC federation') }}">
                                    PDC
                                </button>
                                <button @click="changeFederation('wdf')"
                                        :disabled="isLoading"
                                        :class="activeFederation === 'wdf' ? 'bg-primary text-primary-foreground' : 'bg-muted hover:bg-muted/80'"
                                        class="px-4 py-2 rounded-[var(--radius-base)] text-sm font-semibold transition-colors disabled:opacity-50"
                                        role="tab"
                                        :aria-selected="activeFederation === 'wdf'"
                                        aria-label="{{ __('Show WDF federation') }}">
                                    WDF
                                </button>
                                <button @click="changeFederation('bdo')"
                                        :disabled="isLoading"
                                        :class="activeFederation === 'bdo' ? 'bg-primary text-primary-foreground' : 'bg-muted hover:bg-muted/80'"
                                        class="px-4 py-2 rounded-[var(--radius-base)] text-sm font-semibold transition-colors disabled:opacity-50"
                                        role="tab"
                                        :aria-selected="activeFederation === 'bdo'"
                                        aria-label="{{ __('Show BDO federation') }}">
                                    BDO
                                </button>
                            </div>

                            <!-- Loading State -->
                            <div class="min-h-[24px] mb-4">
                                <div x-show="isLoading" class="flex items-center gap-2 text-sm text-muted-foreground">
                                    <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <span>{{ __('Loading...') }}</span>
                                </div>
                                <div x-show="!isLoading && visibleCount > 0" class="text-sm text-muted-foreground">
                                    <span x-text="visibleCount"></span> <span x-text="visibleCount > 1 ? '{{ __('articles') }}' : 'article'"></span>
                                </div>
                            </div>

                            <!-- Articles Grid - 3 colonnes desktop -->
                            @if($latestNews->count() > 0)
                                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach($latestNews as $article)
                                        <a href="{{ route('articles.show', $article->slug) }}"
                                           class="group bg-card border border-card-border rounded-[var(--radius-base)] overflow-hidden hover:border-primary hover:shadow-md transition-all"
                                           x-show="activeFederation === 'all' || '{{ $article->federation?->slug ?? 'pdc' }}' === activeFederation"
                                           x-transition:enter="transition ease-out duration-200"
                                           x-transition:enter-start="opacity-0"
                                           x-transition:enter-end="opacity-100">

                                            <!-- Image -->
                                            <div class="aspect-[16/9] bg-muted relative">
                                                <!-- Category Badge -->
                                                <div class="absolute top-2 left-2">
                                                    <span class="inline-flex px-2 py-1 text-xs font-bold bg-white/90 rounded-[var(--radius-base)]
                                                        @if($article->category === 'results') text-primary
                                                        @elseif($article->category === 'interview') text-warning
                                                        @elseif($article->category === 'analysis') text-info
                                                        @else text-secondary
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
                                            <div class="p-4 space-y-2">
                                                <time class="text-xs font-semibold text-muted-foreground uppercase">
                                                    {{ $article->published_at?->format('M d, Y') }}
                                                </time>

                                                <h3 class="font-display text-base font-bold leading-tight group-hover:text-primary transition-colors line-clamp-2">
                                                    {{ $article->title }}
                                                </h3>

                                                <p class="text-sm text-muted-foreground leading-relaxed line-clamp-2">
                                                    {{ Str::limit($article->excerpt, 80) }}
                                                </p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </section>

                    <!-- Recent Results -->
                    @if($recentResults->count() > 0)
                        <section class="bg-card rounded-[var(--radius-base)] border border-card-border p-6 shadow-sm">
                            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-border">
                                <div class="w-1 h-8 bg-primary"></div>
                                <h2 class="font-display text-2xl font-bold tracking-tight">{{ __('Recent Results') }}</h2>
                            </div>

                            <div class="grid md:grid-cols-2 gap-4">
                                @foreach($recentResults as $result)
                                    @php
                                        $allPlayers = $topRankings->pluck('player')->shuffle();
                                        $player1 = $allPlayers->first() ?? null;
                                        $player2 = $allPlayers->skip(1)->first() ?? null;
                                        $score1 = rand(3, 7);
                                        $score2 = rand(0, $score1 - 1);
                                    @endphp
                                    <div class="bg-card border border-card-border rounded-[var(--radius-base)] overflow-hidden" x-data="{ open: false }">
                                        <!-- Competition Header -->
                                        <div class="px-4 py-2 bg-muted/50 border-b border-border flex items-center justify-between">
                                            <span class="text-sm font-bold truncate">{{ $result->competition?->name ?? $result->title }}</span>
                                            <span class="inline-flex px-2 py-1 bg-success/10 text-success text-xs font-semibold rounded-[var(--radius-base)]">
                                                {{ __('Finished') }}
                                            </span>
                                        </div>

                                        <!-- Match Result -->
                                        <div class="p-4">
                                            <div class="flex items-center justify-between gap-4">
                                                <!-- Winner -->
                                                <div class="flex-1 min-w-0">
                                                    <p class="font-display text-base font-bold truncate">{{ $player1?->full_name ?? 'Michael Smith' }}</p>
                                                    <p class="text-xs text-success font-semibold uppercase">{{ __('Winner') }}</p>
                                                </div>

                                                <!-- Score -->
                                                <div class="flex items-center gap-2">
                                                    <span class="font-display text-4xl font-bold text-primary">{{ $score1 }}</span>
                                                    <span class="text-xl font-bold text-muted-foreground">-</span>
                                                    <span class="font-display text-3xl font-bold text-muted-foreground">{{ $score2 }}</span>
                                                </div>

                                                <!-- Runner-up -->
                                                <div class="flex-1 min-w-0 text-right">
                                                    <p class="font-display text-base font-bold text-muted-foreground truncate">{{ $player2?->full_name ?? 'Michael van Gerwen' }}</p>
                                                    <p class="text-xs text-muted-foreground font-semibold uppercase">{{ __('Runner-up') }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Stats Toggle -->
                                        <div class="border-t border-border">
                                            <button @click="open = !open" class="w-full px-4 py-2 flex items-center justify-center gap-2 text-xs font-semibold text-primary hover:bg-primary/5 transition-colors">
                                                <span x-text="open ? '{{ __('Hide Stats') }}' : '{{ __('View Stats') }}'"></span>
                                                <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>
                                        </div>

                                        <!-- Stats Panel -->
                                        <div x-show="open" x-transition class="border-t border-border bg-muted/30 p-4 space-y-3">
                                            <div>
                                                <div class="flex items-center justify-between mb-2">
                                                    <span class="text-xs font-semibold text-muted-foreground">{{ __('Average') }}</span>
                                                    <div class="flex items-center gap-3">
                                                        <span class="font-display text-base font-bold text-primary">98.5</span>
                                                        <span class="text-xs text-muted-foreground">vs</span>
                                                        <span class="font-display text-base font-bold text-muted-foreground">89.2</span>
                                                    </div>
                                                </div>
                                                <div class="h-2 bg-muted rounded-full overflow-hidden">
                                                    <div class="h-full bg-primary rounded-full" style="width: 68%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endif
                </div>

                <!-- Sidebar (1/3) - Sticky + Dark Backgrounds -->
                <aside class="space-y-6 lg:sticky lg:top-24 lg:self-start">

                    <!-- Upcoming Events - Dark -->
                    @if($upcomingEvents->count() > 0)
                        <section class="bg-darker rounded-[var(--radius-base)] overflow-hidden shadow-lg">
                            <div class="px-5 py-4 border-b border-primary/30 flex items-center justify-between">
                                <h3 class="font-display text-xl font-bold text-white">{{ __('Upcoming') }}</h3>
                                <a href="{{ route('calendar.index') }}" class="text-xs text-primary font-bold hover:text-primary-hover uppercase flex items-center gap-1">
                                    {{ __('View All') }}
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>

                            <div class="p-5 space-y-3">
                                @foreach($upcomingEvents as $event)
                                    <div class="flex gap-3 pb-3 border-b border-white/10 last:border-0 last:pb-0 hover:bg-white/5 -mx-2 px-3 py-2 rounded-[var(--radius-base)] transition-colors">
                                        <div class="flex-shrink-0 text-center bg-primary rounded-[var(--radius-base)] p-2 min-w-[48px]">
                                            <div class="text-xs font-bold text-white uppercase">{{ $event->start_date->format('M') }}</div>
                                            <div class="text-xl font-display font-black text-white leading-none mt-1">{{ $event->start_date->format('d') }}</div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-display font-bold text-sm text-white mb-1 line-clamp-2 leading-tight">{{ $event->title }}</h4>
                                            <p class="text-xs text-white/70">{{ $event->venue }}</p>
                                            @if($event->competition)
                                                <span class="inline-flex mt-1 px-2 py-0.5 bg-white/10 text-white/70 text-xs font-semibold rounded-[var(--radius-base)]">
                                                    {{ $event->competition->federation->name }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endif

                    <!-- PDC Rankings - Dark -->
                    @if($topRankings->count() > 0)
                        <section class="bg-darker rounded-[var(--radius-base)] overflow-hidden shadow-lg">
                            <div class="px-5 py-4 border-b border-accent/30 flex items-center justify-between">
                                <h3 class="font-display text-xl font-bold text-white">{{ __('PDC Rankings') }}</h3>
                                <a href="{{ route('rankings.index') }}" class="text-xs text-accent font-bold hover:text-accent-hover uppercase flex items-center gap-1">
                                    {{ __('Full Table') }}
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>

                            <div class="p-5 space-y-1">
                                @foreach($topRankings->take(10) as $ranking)
                                    <a href="{{ route('players.show', $ranking->player->slug) }}" class="flex items-center gap-3 py-2 px-3 hover:bg-white/5 border-l-2 border-transparent hover:border-accent transition-all group -mx-3 rounded-[var(--radius-base)]">
                                        <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center bg-accent/20 rounded-[var(--radius-base)] font-display text-sm font-bold text-accent">
                                            {{ $ranking->position }}
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="font-display font-bold text-sm text-white group-hover:text-accent transition-colors truncate">
                                                {{ $ranking->player->full_name }}
                                            </p>
                                            <p class="text-xs text-white/60 font-semibold uppercase">{{ $ranking->player->nationality }}</p>
                                        </div>
                                        @if($ranking->previous_position && $ranking->previous_position > $ranking->position)
                                            <svg class="w-4 h-4 text-success flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                        @elseif($ranking->previous_position && $ranking->previous_position < $ranking->position)
                                            <svg class="w-4 h-4 text-danger flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        </section>
                    @endif
                </aside>
            </div>
        </div>
    </div>
@endsection
