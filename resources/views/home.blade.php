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

                            <h1 class="font-display text-3xl lg:text-5xl font-black leading-tight tracking-tight group-hover:text-primary transition-colors">
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
                                            <div class="aspect-[16/9] bg-gradient-to-br from-primary/30 via-accent/20 to-darker/40 relative overflow-hidden group-hover:scale-[1.02] transition-transform duration-300">
                                                @if($article->featured_image)
                                                    <img src="{{ $article->featured_image }}"
                                                         alt="{{ $article->title }}"
                                                         class="w-full h-full object-cover"
                                                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                                    <!-- Placeholder fallback (hidden by default) -->
                                                    <div class="w-full h-full flex items-center justify-center" style="display: none;">
                                                        <svg class="w-16 h-16 text-white/30" fill="currentColor" viewBox="0 0 24 24">
                                                            <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/>
                                                        </svg>
                                                    </div>
                                                @else
                                                    <!-- Placeholder par défaut -->
                                                    <div class="w-full h-full flex items-center justify-center">
                                                        <svg class="w-16 h-16 text-white/30" fill="currentColor" viewBox="0 0 24 24">
                                                            <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/>
                                                        </svg>
                                                    </div>
                                                @endif

                                                <!-- Category Badge -->
                                                <div class="absolute top-2 left-2 z-10">
                                                    <span class="inline-flex px-2 py-1 text-xs font-bold bg-white/90 backdrop-blur-sm rounded-[var(--radius-base)]
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

                                                <h3 class="font-display text-base font-bold leading-snug group-hover:text-primary transition-colors line-clamp-2">
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
                                            <p class="text-xs text-white/85">{{ $event->venue }}</p>
                                            @if($event->competition)
                                                <span class="inline-flex mt-1 px-2 py-0.5 bg-white/10 text-white/85 text-xs font-semibold rounded-[var(--radius-base)]">
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
                                            <p class="text-xs text-white/80 font-semibold uppercase">{{ $ranking->player->nationality }}</p>
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

    <!-- SEO Content Section -->
    <section class="bg-background border-t-2 border-border py-12 lg:py-16">
        <div class="container">
            <div class="max-w-5xl mx-auto space-y-10">
                <!-- Main SEO Content -->
                <div class="prose prose-lg max-w-none">
                    <h2 class="font-display text-2xl lg:text-3xl font-bold text-foreground mb-6">
                        {{ __('DartsArena: Your Complete Professional Darts Hub') }}
                    </h2>
                    <div class="text-muted-foreground leading-relaxed space-y-4">
                        <p>
                            {{ __('Welcome to DartsArena, the ultimate destination for professional darts enthusiasts. Whether you\'re following the') }}
                            <a href="{{ route('federations.show', 'pdc') }}" class="text-primary hover:text-primary-hover font-semibold">{{ __('PDC (Professional Darts Corporation)') }}</a>,
                            <a href="{{ route('federations.show', 'wdf') }}" class="text-primary hover:text-primary-hover font-semibold">{{ __('WDF (World Darts Federation)') }}</a>,
                            {{ __('or the') }}
                            <a href="{{ route('federations.show', 'bdo') }}" class="text-primary hover:text-primary-hover font-semibold">{{ __('BDO (British Darts Organisation)') }}</a>,
                            {{ __('we provide comprehensive coverage of all major darts competitions and events worldwide.') }}
                        </p>
                        <p>
                            {{ __('Track your favorite players, follow live scores, and stay updated with breaking news from the world of professional darts. From the prestigious') }}
                            <a href="{{ route('competitions.index') }}" class="text-primary hover:text-primary-hover font-semibold">{{ __('PDC World Championship') }}</a>
                            {{ __('to the exciting') }}
                            <a href="{{ route('competitions.index') }}" class="text-primary hover:text-primary-hover font-semibold">{{ __('Premier League Darts') }}</a>,
                            {{ __('we cover every major tournament with detailed statistics, player profiles, and expert analysis.') }}
                        </p>
                    </div>
                </div>

                <!-- Internal Links Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Major Federations -->
                    <div class="bg-card border border-card-border rounded-[var(--radius-base)] p-6 shadow-sm">
                        <h3 class="font-display text-lg font-bold text-foreground mb-4 flex items-center gap-2">
                            🏛️ {{ __('Major Federations') }}
                        </h3>
                        <ul class="space-y-2">
                            <li>
                                <a href="{{ route('federations.show', 'pdc') }}" class="text-sm text-muted-foreground hover:text-primary transition-colors flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                                    {{ __('PDC - Professional Darts Corporation') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('federations.show', 'wdf') }}" class="text-sm text-muted-foreground hover:text-primary transition-colors flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                                    {{ __('WDF - World Darts Federation') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('federations.show', 'bdo') }}" class="text-sm text-muted-foreground hover:text-primary transition-colors flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                                    {{ __('BDO - British Darts Organisation') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('federations.index') }}" class="text-sm text-primary hover:text-primary-hover transition-colors flex items-center gap-2 font-semibold">
                                    <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                                    {{ __('View All Federations') }} →
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Major Competitions -->
                    <div class="bg-card border border-card-border rounded-[var(--radius-base)] p-6 shadow-sm">
                        <h3 class="font-display text-lg font-bold text-foreground mb-4 flex items-center gap-2">
                            🏆 {{ __('Major Competitions') }}
                        </h3>
                        <ul class="space-y-2">
                            @foreach($majorCompetitions->take(4) as $competition)
                                <li>
                                    <a href="{{ route('competitions.show', $competition->slug) }}" class="text-sm text-muted-foreground hover:text-primary transition-colors flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                                        {{ $competition->name }}
                                    </a>
                                </li>
                            @endforeach
                            <li>
                                <a href="{{ route('competitions.index') }}" class="text-sm text-primary hover:text-primary-hover transition-colors flex items-center gap-2 font-semibold">
                                    <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                                    {{ __('View All Competitions') }} →
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Top Players -->
                    <div class="bg-card border border-card-border rounded-[var(--radius-base)] p-6 shadow-sm">
                        <h3 class="font-display text-lg font-bold text-foreground mb-4 flex items-center gap-2">
                            ⭐ {{ __('Top Players') }}
                        </h3>
                        <ul class="space-y-2">
                            @foreach($featuredPlayers->take(4) as $player)
                                <li>
                                    <a href="{{ route('players.show', $player->slug) }}" class="text-sm text-muted-foreground hover:text-primary transition-colors flex items-center gap-2">
                                        <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                                        {{ $player->full_name }} <span class="text-xs">({{ $player->nationality }})</span>
                                    </a>
                                </li>
                            @endforeach
                            <li>
                                <a href="{{ route('players.index') }}" class="text-sm text-primary hover:text-primary-hover transition-colors flex items-center gap-2 font-semibold">
                                    <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                                    {{ __('View All Players') }} →
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Quick Links -->
                    <div class="bg-card border border-card-border rounded-[var(--radius-base)] p-6 shadow-sm">
                        <h3 class="font-display text-lg font-bold text-foreground mb-4 flex items-center gap-2">
                            🔗 {{ __('Quick Links') }}
                        </h3>
                        <ul class="space-y-2">
                            <li>
                                <a href="{{ route('rankings.index') }}" class="text-sm text-muted-foreground hover:text-primary transition-colors flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                                    {{ __('PDC Order of Merit') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('calendar.index') }}" class="text-sm text-muted-foreground hover:text-primary transition-colors flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                                    {{ __('Darts Calendar & Fixtures') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('articles.index') }}" class="text-sm text-muted-foreground hover:text-primary transition-colors flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                                    {{ __('Latest Darts News') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('guides.index') }}" class="text-sm text-muted-foreground hover:text-primary transition-colors flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                                    {{ __('Darts Rules & Guides') }}
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Statistics & Analysis -->
                    <div class="bg-card border border-card-border rounded-[var(--radius-base)] p-6 shadow-sm">
                        <h3 class="font-display text-lg font-bold text-foreground mb-4 flex items-center gap-2">
                            📊 {{ __('Statistics & Analysis') }}
                        </h3>
                        <ul class="space-y-2">
                            <li>
                                <a href="{{ route('players.index') }}" class="text-sm text-muted-foreground hover:text-primary transition-colors flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                                    {{ __('Player Statistics & Averages') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('articles.index') }}" class="text-sm text-muted-foreground hover:text-primary transition-colors flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                                    {{ __('Match Results & Archives') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('rankings.index') }}" class="text-sm text-muted-foreground hover:text-primary transition-colors flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                                    {{ __('World Rankings') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('articles.index') }}" class="text-sm text-muted-foreground hover:text-primary transition-colors flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                                    {{ __('Expert Analysis & Predictions') }}
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Special Features -->
                    <div class="bg-card border border-card-border rounded-[var(--radius-base)] p-6 shadow-sm">
                        <h3 class="font-display text-lg font-bold text-foreground mb-4 flex items-center gap-2">
                            ✨ {{ __('Special Features') }}
                        </h3>
                        <ul class="space-y-2">
                            <li>
                                <a href="{{ route('articles.index') }}" class="text-sm text-muted-foreground hover:text-primary transition-colors flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                                    {{ __('Live Match Coverage') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('calendar.index') }}" class="text-sm text-muted-foreground hover:text-primary transition-colors flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                                    {{ __('Tournament Schedules') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('articles.index') }}" class="text-sm text-muted-foreground hover:text-primary transition-colors flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                                    {{ __('Player Interviews') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('guides.index') }}" class="text-sm text-muted-foreground hover:text-primary transition-colors flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 bg-primary rounded-full"></span>
                                    {{ __('Beginner\'s Guide to Darts') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Additional SEO Text -->
                <div class="bg-card border border-card-border rounded-[var(--radius-base)] p-8 shadow-sm">
                    <div class="prose max-w-none">
                        <h3 class="font-display text-xl font-bold text-foreground mb-4">
                            {{ __('Why Choose DartsArena?') }}
                        </h3>
                        <div class="text-sm text-muted-foreground leading-relaxed space-y-3">
                            <p>
                                {{ __('DartsArena offers the most comprehensive coverage of professional darts worldwide. Our platform aggregates real-time results, detailed player statistics, and exclusive insights from all major darts organizations including the PDC, WDF, and BDO.') }}
                            </p>
                            <p>
                                {{ __('Stay informed with our up-to-the-minute news coverage of major tournaments such as the PDC World Championship, Premier League Darts, World Matchplay, UK Open, and many more. We provide detailed match statistics, 180s counts, checkout percentages, and three-dart averages for every professional player.') }}
                            </p>
                            <p>
                                {{ __('Our expert team delivers in-depth analysis, betting tips, player interviews, and tournament previews to enhance your darts viewing experience. Whether you\'re a casual fan or a dedicated follower of the sport, DartsArena is your go-to source for everything related to professional darts.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
