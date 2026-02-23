@extends('layouts.app')

@section('title', 'DartsArena - ' . __('Professional Darts News, Stats & Coverage'))

@section('content')
    <!-- Hero Featured Article -->
    @if($featuredArticle)
        <section class="hero-section relative">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_50%,rgba(239,68,68,0.15),transparent_70%)]"></div>
            <div class="container relative py-8 lg:py-12">
                <a href="{{ route('articles.show', $featuredArticle->slug) }}" class="block group">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                        <!-- Image -->
                        <div class="relative aspect-video rounded-2xl overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-br from-primary/80 to-primary-dark/90 flex items-center justify-center">
                                <span class="text-9xl">
                                    @if($featuredArticle->category === 'results') 🏆
                                    @elseif($featuredArticle->category === 'interview') 🎤
                                    @elseif($featuredArticle->category === 'analysis') 📊
                                    @else 📰
                                    @endif
                                </span>
                            </div>
                            <div class="absolute top-4 left-4">
                                <span class="inline-flex items-center px-3 py-1 bg-primary text-primary-foreground rounded-md text-xs font-bold uppercase tracking-wider">
                                    {{ __('LATEST NEWS') }}
                                </span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="space-y-4 text-white">
                            <div class="flex items-center gap-3 text-sm">
                                <span class="inline-flex items-center px-3 py-1 bg-white/10 backdrop-blur-sm text-white rounded-md text-xs font-semibold uppercase tracking-wide border border-white/20">
                                    @if($featuredArticle->category === 'results') {{ __('Results') }}
                                    @elseif($featuredArticle->category === 'news') {{ __('News') }}
                                    @elseif($featuredArticle->category === 'interview') {{ __('Interview') }}
                                    @elseif($featuredArticle->category === 'analysis') {{ __('Analysis') }}
                                    @endif
                                </span>
                                <span class="text-secondary-foreground/80">{{ $featuredArticle->published_at?->diffForHumans() }}</span>
                            </div>

                            <h1 class="font-display text-4xl lg:text-5xl font-bold leading-tight group-hover:text-primary-light transition-colors">
                                {{ $featuredArticle->title }}
                            </h1>

                            <p class="text-lg text-secondary-foreground/90 leading-relaxed">
                                {{ $featuredArticle->excerpt }}
                            </p>

                            <div class="inline-flex items-center gap-2 text-primary font-semibold group-hover:gap-3 transition-all">
                                {{ __('Read Full Story') }}
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </section>
    @endif

    <!-- Main Content Grid: News + Sidebar -->
    <div class="bg-muted/30">
        <div class="container py-8 lg:py-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Main Content (2/3) -->
                <div class="lg:col-span-2">

                    <!-- Latest News Grid -->
                    <section>
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="font-display text-3xl font-bold text-foreground">{{ __('Latest News') }}</h2>
                            <a href="{{ route('articles.index') }}" class="text-primary font-semibold hover:text-primary-hover flex items-center gap-1 text-sm">
                                {{ __('View All') }}
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>

                        <!-- Federation Tabs -->
                        <div class="mb-6" x-data="{ activeFederation: 'all', activeTournament: 'all' }">
                            <!-- Federation Filter -->
                            <div class="flex items-center gap-2 mb-4 overflow-x-auto pb-2">
                                <button @click="activeFederation = 'all'; activeTournament = 'all'"
                                        :class="activeFederation === 'all' ? 'bg-primary text-primary-foreground' : 'bg-card text-foreground hover:bg-muted'"
                                        class="px-4 py-2 rounded-lg text-sm font-semibold whitespace-nowrap transition-colors">
                                    {{ __('All') }}
                                </button>
                                <button @click="activeFederation = 'pdc'; activeTournament = 'all'"
                                        :class="activeFederation === 'pdc' ? 'bg-primary text-primary-foreground' : 'bg-card text-foreground hover:bg-muted'"
                                        class="px-4 py-2 rounded-lg text-sm font-semibold whitespace-nowrap transition-colors">
                                    PDC
                                </button>
                                <button @click="activeFederation = 'wdf'; activeTournament = 'all'"
                                        :class="activeFederation === 'wdf' ? 'bg-primary text-primary-foreground' : 'bg-card text-foreground hover:bg-muted'"
                                        class="px-4 py-2 rounded-lg text-sm font-semibold whitespace-nowrap transition-colors">
                                    WDF
                                </button>
                                <button @click="activeFederation = 'bdo'; activeTournament = 'all'"
                                        :class="activeFederation === 'bdo' ? 'bg-primary text-primary-foreground' : 'bg-card text-foreground hover:bg-muted'"
                                        class="px-4 py-2 rounded-lg text-sm font-semibold whitespace-nowrap transition-colors">
                                    BDO
                                </button>
                            </div>

                            <!-- Tournament Sub-tabs (PDC) -->
                            <div x-show="activeFederation === 'pdc'" class="flex items-center gap-2 mb-4 overflow-x-auto pb-2">
                                <button @click="activeTournament = 'all'"
                                        :class="activeTournament === 'all' ? 'bg-secondary text-secondary-foreground' : 'bg-card text-muted-foreground hover:bg-muted'"
                                        class="px-3 py-1.5 rounded-md text-xs font-semibold whitespace-nowrap transition-colors">
                                    {{ __('All Tournaments') }}
                                </button>
                                @foreach($majorCompetitions as $competition)
                                    @if($competition->federation->slug === 'pdc')
                                        <a href="{{ route('competitions.show', $competition->slug) }}"
                                           class="px-3 py-1.5 rounded-md text-xs font-semibold whitespace-nowrap transition-colors bg-card text-muted-foreground hover:bg-muted border border-border hover:border-primary">
                                            {{ $competition->name }}
                                        </a>
                                    @endif
                                @endforeach
                                <a href="{{ route('competitions.index') }}"
                                   class="px-3 py-1.5 rounded-md text-xs font-semibold whitespace-nowrap transition-colors bg-primary/10 text-primary hover:bg-primary hover:text-primary-foreground border border-primary/30">
                                    {{ __('All Competitions') }} →
                                </a>
                            </div>

                            <!-- Tournament Sub-tabs (WDF) -->
                            <div x-show="activeFederation === 'wdf'" class="flex items-center gap-2 mb-4 overflow-x-auto pb-2">
                                <button @click="activeTournament = 'all'"
                                        :class="activeTournament === 'all' ? 'bg-secondary text-secondary-foreground' : 'bg-card text-muted-foreground hover:bg-muted'"
                                        class="px-3 py-1.5 rounded-md text-xs font-semibold whitespace-nowrap transition-colors">
                                    {{ __('All Tournaments') }}
                                </button>
                                @foreach($majorCompetitions as $competition)
                                    @if($competition->federation->slug === 'wdf')
                                        <a href="{{ route('competitions.show', $competition->slug) }}"
                                           class="px-3 py-1.5 rounded-md text-xs font-semibold whitespace-nowrap transition-colors bg-card text-muted-foreground hover:bg-muted border border-border hover:border-primary">
                                            {{ $competition->name }}
                                        </a>
                                    @endif
                                @endforeach
                                <a href="{{ route('competitions.index') }}"
                                   class="px-3 py-1.5 rounded-md text-xs font-semibold whitespace-nowrap transition-colors bg-primary/10 text-primary hover:bg-primary hover:text-primary-foreground border border-primary/30">
                                    {{ __('All Competitions') }} →
                                </a>
                            </div>

                            <!-- Tournament Sub-tabs (BDO) -->
                            <div x-show="activeFederation === 'bdo'" class="flex items-center gap-2 mb-4 overflow-x-auto pb-2">
                                <button @click="activeTournament = 'all'"
                                        :class="activeTournament === 'all' ? 'bg-secondary text-secondary-foreground' : 'bg-card text-muted-foreground hover:bg-muted'"
                                        class="px-3 py-1.5 rounded-md text-xs font-semibold whitespace-nowrap transition-colors">
                                    {{ __('All Tournaments') }}
                                </button>
                                @foreach($majorCompetitions as $competition)
                                    @if($competition->federation->slug === 'bdo')
                                        <a href="{{ route('competitions.show', $competition->slug) }}"
                                           class="px-3 py-1.5 rounded-md text-xs font-semibold whitespace-nowrap transition-colors bg-card text-muted-foreground hover:bg-muted border border-border hover:border-primary">
                                            {{ $competition->name }}
                                        </a>
                                    @endif
                                @endforeach
                                <a href="{{ route('competitions.index') }}"
                                   class="px-3 py-1.5 rounded-md text-xs font-semibold whitespace-nowrap transition-colors bg-primary/10 text-primary hover:bg-primary hover:text-primary-foreground border border-primary/30">
                                    {{ __('All Competitions') }} →
                                </a>
                            </div>

                        @if($latestNews->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                                @foreach($latestNews as $article)
                                    <a href="{{ route('articles.show', $article->slug) }}"
                                       class="bg-card rounded-xl border border-card-border shadow-sm hover:shadow-lg hover:border-border-strong hover:-translate-y-1 transition-all duration-200 group overflow-hidden"
                                       x-show="(activeFederation === 'all' || '{{ $article->federation?->slug ?? 'pdc' }}' === activeFederation) && (activeTournament === 'all' || '{{ $article->competition?->slug ?? '' }}' === activeTournament)"
                                       x-transition:enter="transition ease-out duration-200"
                                       x-transition:enter-start="opacity-0 scale-95"
                                       x-transition:enter-end="opacity-100 scale-100">
                                        <!-- Image -->
                                        <div class="aspect-video bg-gradient-to-br from-muted to-border flex items-center justify-center overflow-hidden relative">
                                            <span class="text-5xl">
                                                @if($article->category === 'results') 🏆
                                                @elseif($article->category === 'interview') 🎤
                                                @elseif($article->category === 'analysis') 📊
                                                @else 📰
                                                @endif
                                            </span>
                                            <div class="absolute top-2 left-2">
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider
                                                    @if($article->category === 'results') bg-primary/90 text-primary-foreground
                                                    @elseif($article->category === 'interview') bg-warning/90 text-warning-foreground
                                                    @elseif($article->category === 'analysis') bg-info/90 text-info-foreground
                                                    @else bg-secondary/90 text-secondary-foreground
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
                                            <p class="text-xs text-muted-foreground">{{ $article->published_at?->format('M d, Y') }}</p>
                                            <h3 class="font-display text-lg font-bold text-foreground group-hover:text-primary transition-colors line-clamp-2 leading-tight">
                                                {{ $article->title }}
                                            </h3>
                                            <p class="text-sm text-muted-foreground line-clamp-2 leading-relaxed">
                                                {{ Str::limit($article->excerpt, 100) }}
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
                        <section class="mt-10">
                            <h2 class="font-display text-2xl font-bold text-foreground mb-6">{{ __('Recent Results') }}</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                                @foreach($recentResults as $result)
                                    @php
                                        $allPlayers = $topRankings->pluck('player')->shuffle();
                                        $player1 = $allPlayers->first() ?? null;
                                        $player2 = $allPlayers->skip(1)->first() ?? null;
                                        $score1 = rand(3, 7);
                                        $score2 = rand(0, $score1 - 1);
                                    @endphp
                                    <div class="bg-card border border-card-border rounded-xl overflow-hidden hover:shadow-lg hover:border-border-strong transition-all" x-data="{ open: false }">
                                        <!-- Header -->
                                        <div class="px-4 py-3 border-b border-border flex items-center justify-between">
                                            <span class="text-xs font-semibold text-muted-foreground uppercase tracking-wide">
                                                {{ $result->competition?->name ?? $result->title }}
                                            </span>
                                            <span class="inline-flex items-center px-2 py-1 bg-success/10 text-success border border-success/20 rounded text-[10px] font-bold uppercase">
                                                {{ __('Terminé') }}
                                            </span>
                                        </div>

                                        <!-- Date -->
                                        <div class="px-4 py-2 bg-muted/30 text-xs text-muted-foreground">
                                            {{ $result->end_date->format('d/m/Y - H:i') }}
                                        </div>

                                        <!-- Players Section - Horizontal VS Layout -->
                                        <div class="p-4">
                                            <div class="flex items-center justify-between gap-3">
                                                <!-- Player 1 (Winner) - Left -->
                                                <div class="flex flex-col items-center gap-2 flex-1 min-w-0">
                                                    <div class="relative">
                                                        <div class="w-16 h-16 bg-gradient-to-br from-primary/20 to-primary/10 rounded-full flex items-center justify-center text-3xl border-2 border-primary/40">
                                                            🎯
                                                        </div>
                                                        <div class="absolute -bottom-0.5 -right-0.5 w-6 h-6 bg-success rounded-full flex items-center justify-center border-2 border-card">
                                                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <div class="text-center w-full">
                                                        <p class="font-display text-sm font-bold text-foreground leading-tight truncate">
                                                            {{ $player1?->full_name ?? 'Michael Smith' }}
                                                        </p>
                                                        <p class="text-[10px] text-success font-bold uppercase tracking-wide mt-0.5">{{ __('Winner') }}</p>
                                                    </div>
                                                </div>

                                                <!-- VS Score Center -->
                                                <div class="flex flex-col items-center gap-2 px-3">
                                                    <div class="flex items-center gap-2">
                                                        <div class="text-4xl font-display font-black text-foreground leading-none">{{ $score1 }}</div>
                                                        <div class="text-lg font-bold text-muted-foreground leading-none">-</div>
                                                        <div class="text-4xl font-display font-semibold text-muted-foreground leading-none">{{ $score2 }}</div>
                                                    </div>
                                                    <div class="px-2.5 py-0.5 bg-muted rounded-full">
                                                        <span class="text-[10px] font-bold text-muted-foreground uppercase tracking-wide">VS</span>
                                                    </div>
                                                </div>

                                                <!-- Player 2 (Runner-up) - Right -->
                                                <div class="flex flex-col items-center gap-2 flex-1 min-w-0">
                                                    <div class="w-16 h-16 bg-muted rounded-full flex items-center justify-center text-3xl border-2 border-border">
                                                        🎯
                                                    </div>
                                                    <div class="text-center w-full">
                                                        <p class="font-display text-sm font-normal text-muted-foreground leading-tight truncate">
                                                            {{ $player2?->full_name ?? 'Michael van Gerwen' }}
                                                        </p>
                                                        <p class="text-[10px] text-muted-foreground font-semibold uppercase tracking-wide mt-0.5">{{ __('Runner-up') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Stats Toggle -->
                                        <div class="border-t border-border">
                                            <button @click="open = !open" class="w-full px-4 py-3 flex items-center justify-center gap-2 text-xs font-semibold text-primary hover:bg-muted/50 transition-colors">
                                                <span x-text="open ? '{{ __('Hide Stats') }}' : '{{ __('View Stats') }}'"></span>
                                                <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>
                                        </div>

                                        <!-- Stats Dropdown -->
                                        <div x-show="open"
                                             x-transition:enter="transition ease-out duration-200"
                                             x-transition:enter-start="opacity-0 -translate-y-2"
                                             x-transition:enter-end="opacity-100 translate-y-0"
                                             class="border-t border-border bg-muted/30 px-4 py-4">
                                            <div class="space-y-3">
                                                <!-- Average -->
                                                <div>
                                                    <div class="text-center mb-1.5">
                                                        <span class="text-[10px] font-semibold text-muted-foreground uppercase tracking-wide">{{ __('Average') }}</span>
                                                    </div>
                                                    <div class="flex items-center gap-3">
                                                        <div class="w-12 text-right">
                                                            <span class="font-bold text-foreground text-sm">98.5</span>
                                                        </div>
                                                        <div class="flex-1 flex items-center gap-0.5">
                                                            <div class="flex-1 h-2 bg-primary rounded-l-full"></div>
                                                            <div class="flex-1 h-2 bg-border rounded-r-full"></div>
                                                        </div>
                                                        <div class="w-12 text-left">
                                                            <span class="font-semibold text-foreground text-sm">89.2</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Checkout % -->
                                                <div>
                                                    <div class="text-center mb-1.5">
                                                        <span class="text-[10px] font-semibold text-muted-foreground uppercase tracking-wide">{{ __('Checkout %') }}</span>
                                                    </div>
                                                    <div class="flex items-center gap-3">
                                                        <div class="w-12 text-right">
                                                            <span class="font-bold text-foreground text-sm">42%</span>
                                                        </div>
                                                        <div class="flex-1 flex items-center gap-0.5">
                                                            <div class="flex-1 h-2 bg-accent rounded-l-full"></div>
                                                            <div class="flex-1 h-2 bg-border rounded-r-full"></div>
                                                        </div>
                                                        <div class="w-12 text-left">
                                                            <span class="font-semibold text-foreground text-sm">36%</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- 180s -->
                                                <div>
                                                    <div class="text-center mb-1.5">
                                                        <span class="text-[10px] font-semibold text-muted-foreground uppercase tracking-wide">180s</span>
                                                    </div>
                                                    <div class="flex items-center gap-3">
                                                        <div class="w-12 text-right">
                                                            <span class="font-bold text-foreground text-sm">8</span>
                                                        </div>
                                                        <div class="flex-1 flex items-center gap-0.5">
                                                            <div class="flex-1 h-2 bg-success rounded-l-full"></div>
                                                            <div class="flex-1 h-2 bg-border rounded-r-full"></div>
                                                        </div>
                                                        <div class="w-12 text-left">
                                                            <span class="font-semibold text-foreground text-sm">4</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-4 pt-3 border-t border-border text-xs text-muted-foreground text-center">
                                                📍 {{ $result->venue }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endif
                </div>

                <!-- Sidebar (1/3) -->
                <aside class="space-y-6">

                    <!-- Upcoming Matches -->
                    @if($upcomingEvents->count() > 0)
                        <section class="bg-darker rounded-xl border border-border/50 p-6 shadow-lg">
                            <div class="flex items-center justify-between mb-5">
                                <h3 class="font-display text-xl font-bold text-white">{{ __('Upcoming') }}</h3>
                                <a href="{{ route('calendar.index') }}" class="text-sm text-primary font-semibold hover:text-primary-hover">
                                    {{ __('View All') }} →
                                </a>
                            </div>

                            <div class="space-y-4">
                                @foreach($upcomingEvents as $event)
                                    <div class="pb-4 border-b border-white/10 last:border-0 last:pb-0">
                                        <div class="flex items-start gap-3">
                                            <div class="text-center bg-primary/20 rounded-lg p-2.5 min-w-[60px]">
                                                <div class="text-xs font-bold text-primary uppercase tracking-wide">
                                                    {{ $event->start_date->format('M') }}
                                                </div>
                                                <div class="text-2xl font-display font-bold text-white">
                                                    {{ $event->start_date->format('d') }}
                                                </div>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <h4 class="font-semibold text-sm text-white mb-1 line-clamp-2 leading-tight">{{ $event->title }}</h4>
                                                <p class="text-xs text-white/60 mb-1.5">📍 {{ $event->venue }}</p>
                                                @if($event->competition)
                                                    <span class="inline-block px-2 py-0.5 bg-white/10 text-white/80 text-[10px] rounded font-bold uppercase tracking-wide">
                                                        {{ $event->competition->federation->name }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endif

                    <!-- PDC Rankings -->
                    @if($topRankings->count() > 0)
                        <section class="bg-darker rounded-xl border border-border/50 p-6 shadow-lg">
                            <div class="flex items-center justify-between mb-5">
                                <h3 class="font-display text-xl font-bold text-white">{{ __('PDC Rankings') }}</h3>
                                <a href="{{ route('rankings.index') }}" class="text-sm text-primary font-semibold hover:text-primary-hover">
                                    {{ __('Full Table') }} →
                                </a>
                            </div>

                            <div class="space-y-2">
                                @foreach($topRankings->take(10) as $ranking)
                                    <a href="{{ route('players.show', $ranking->player->slug) }}" class="flex items-center gap-3 py-2.5 px-2 hover:bg-white/5 rounded-lg transition-colors group">
                                        <div class="font-display text-lg font-bold text-primary min-w-[24px]">
                                            {{ $ranking->position }}
                                        </div>
                                        <div class="w-9 h-9 bg-primary/20 rounded-full flex items-center justify-center text-lg flex-shrink-0">
                                            🎯
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="font-semibold text-sm text-white group-hover:text-primary transition-colors truncate">
                                                {{ $ranking->player->full_name }}
                                            </p>
                                            <p class="text-xs text-white/60">{{ $ranking->player->nationality }}</p>
                                        </div>
                                        @if($ranking->previous_position && $ranking->previous_position > $ranking->position)
                                            <div class="text-success text-sm font-bold flex-shrink-0">↑</div>
                                        @elseif($ranking->previous_position && $ranking->previous_position < $ranking->position)
                                            <div class="text-danger text-sm font-bold flex-shrink-0">↓</div>
                                        @else
                                            <div class="text-white/40 text-sm flex-shrink-0">—</div>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        </section>
                    @endif

                    <!-- Featured Players -->
                    @if($featuredPlayers->count() > 0)
                        <section class="bg-card rounded-xl border border-card-border p-6 shadow-sm">
                            <h3 class="font-display text-xl font-bold text-foreground mb-5">{{ __('Top Players') }}</h3>

                            <div class="space-y-4">
                                @foreach($featuredPlayers->take(4) as $player)
                                    <a href="{{ route('players.show', $player->slug) }}" class="block group">
                                        <div class="flex items-center gap-3">
                                            <div class="w-12 h-12 bg-gradient-to-br from-primary/20 to-primary/10 rounded-full flex items-center justify-center text-2xl group-hover:scale-110 transition-transform flex-shrink-0">
                                                🎯
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="font-semibold text-sm text-foreground group-hover:text-primary transition-colors truncate">
                                                    {{ $player->full_name }}
                                                </p>
                                                <p class="text-xs text-muted-foreground">{{ $player->nationality }}</p>
                                            </div>
                                            @if($player->career_titles > 0)
                                                <div class="text-right flex-shrink-0">
                                                    <p class="text-[10px] text-muted-foreground uppercase tracking-wide">{{ __('Titles') }}</p>
                                                    <p class="font-bold text-primary">{{ $player->career_titles }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </a>
                                @endforeach
                            </div>

                            <a href="{{ route('players.index') }}" class="block mt-5 text-center text-sm text-primary font-semibold hover:text-primary-hover">
                                {{ __('View All Players') }} →
                            </a>
                        </section>
                    @endif

                </aside>
            </div>
        </div>
    </div>

    <!-- CTA Banner -->
    <section class="bg-gradient-to-r from-primary via-primary-dark to-primary relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC40Ij48cGF0aCBkPSJNMzYgMzRjMC0yLjIxIDEuNzktNCA0LTRzNCAxLjc5IDQgNC0xLjc5IDQtNCA0LTQtMS43OS00LTR6bTAgMTBjMC0yLjIxIDEuNzktNCA0LTRzNCAxLjc5IDQgNC0xLjc5IDQtNCA0LTQtMS43OS00LTR6TTI4IDQ0YzAtMi4yMSAxLjc5LTQgNC00czQgMS43OSA0IDQtMS43OSA0LTQgNC00LTEuNzktNC00em0wLTEwYzAtMi4yMSAxLjc5LTQgNC00czQgMS43OSA0IDQtMS43OSA0LTQgNC00LTEuNzktNC00eiIvPjwvZz48L2c+PC9zdmc+')]"></div>
        </div>

        <div class="container relative py-12 lg:py-16">
            <div class="max-w-3xl mx-auto text-center space-y-6">
                <h2 class="font-display text-3xl lg:text-4xl font-bold text-white">
                    {{ __('Stay Updated with Professional Darts') }}
                </h2>
                <p class="text-lg text-primary-foreground/90">
                    {{ __('Breaking news, live scores, and in-depth analysis from the PDC circuit.') }}
                </p>
                <div class="flex flex-wrap gap-4 justify-center pt-4">
                    <a href="{{ route('articles.index') }}" class="inline-flex items-center justify-center gap-2 bg-white text-primary hover:bg-white/90 rounded-lg px-8 py-3 text-sm font-semibold transition-all duration-200 shadow-sm">
                        {{ __('Explore News') }}
                    </a>
                    <a href="{{ route('guides.index') }}" class="inline-flex items-center justify-center gap-2 border-2 border-white text-white hover:bg-white hover:text-primary rounded-lg px-8 py-3 text-sm font-semibold transition-all duration-200">
                        {{ __('Learn More') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
