@extends('layouts.app')

@section('title', 'DartsArena - ' . __('Professional Darts News, Stats & Coverage'))

@section('content')
    <!-- Hero Featured Article -->
    @if($featuredArticle)
        <section class="hero-section relative overflow-hidden animate-[fade-in_0.6s_ease-out]">
            <!-- Diagonal accent lines -->
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-primary to-transparent"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-primary/5 blur-3xl"></div>

            <div class="container relative py-10 lg:py-16 animate-[slide-up_0.6s_ease-out]">
                <a href="{{ route('articles.show', $featuredArticle->slug) }}" class="block group">
                    <div class="grid grid-cols-1 lg:grid-cols-[1.2fr_1fr] gap-10 items-center">
                        <!-- Image -->
                        <div class="relative img-frame cut-corner-br">
                            <div class="aspect-[16/10] bg-gradient-to-br from-primary/90 via-primary to-darker relative overflow-hidden">
                                <!-- Geometric pattern overlay -->
                                <div class="absolute inset-0 opacity-10">
                                    <div class="absolute top-0 right-0 w-64 h-64 border-4 border-white transform rotate-45 translate-x-32 -translate-y-32"></div>
                                    <div class="absolute bottom-0 left-0 w-48 h-48 border-4 border-white transform -rotate-12 -translate-x-24 translate-y-24"></div>
                                </div>

                                <!-- Live indicator for breaking news -->
                                <div class="absolute top-0 left-0 flex items-center gap-2 bg-primary px-4 py-2 cut-corner-br">
                                    <div class="w-2 h-2 rounded-full bg-white pulse-glow"></div>
                                    <span class="text-white text-xs font-bold uppercase tracking-wider">{{ __('LATEST NEWS') }}</span>
                                </div>

                                <!-- Category tag -->
                                <div class="absolute bottom-4 left-4">
                                    <div class="tag text-white">
                                        @if($featuredArticle->category === 'results') {{ __('Results') }}
                                        @elseif($featuredArticle->category === 'news') {{ __('News') }}
                                        @elseif($featuredArticle->category === 'interview') {{ __('Interview') }}
                                        @elseif($featuredArticle->category === 'analysis') {{ __('Analysis') }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="space-y-5 text-white relative bg-darker/90 p-6 lg:p-8 rounded-[var(--radius-base)] backdrop-blur-sm border border-white/10">
                            <div class="flex items-center gap-4 text-sm">
                                <span class="text-primary font-bold uppercase tracking-wider">{{ $featuredArticle->published_at?->diffForHumans() }}</span>
                                <div class="h-1 flex-1 bg-gradient-to-r from-primary/50 to-transparent"></div>
                            </div>

                            <h1 class="font-display text-4xl lg:text-6xl font-black leading-[0.95] tracking-tight group-hover:text-primary transition-colors animate-[fade-in_0.6s_ease-out_0.5s_both]">
                                {{ $featuredArticle->title }}
                            </h1>

                            <p class="text-base lg:text-lg text-white/95 leading-relaxed font-medium">
                                {{ $featuredArticle->excerpt }}
                            </p>

                            <div class="flex items-center gap-3 pt-2">
                                <div class="inline-flex items-center gap-2 text-primary font-bold uppercase text-sm tracking-wider group-hover:gap-4 transition-all">
                                    {{ __('Read Full Story') }}
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                                <div class="h-0.5 flex-1 bg-gradient-to-r from-primary to-transparent"></div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </section>
    @endif

    <!-- Main Content Grid: News + Sidebar -->
    <div class="bg-muted section">
        <div class="container">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Main Content (2/3) -->
                <div class="lg:col-span-2">

                    <!-- Latest News Grid -->
                    <section class="bg-card rounded-[var(--radius-base)] border border-card-border p-6 lg:p-8 shadow-sm">
                        <div class="flex items-center justify-between mb-8">
                            <div class="flex items-center gap-4">
                                <div class="w-1 h-8 bg-primary"></div>
                                <h2 class="font-display text-3xl font-black text-foreground tracking-tight">{{ __('Latest News') }}</h2>
                            </div>
                            <a href="{{ route('articles.index') }}" class="text-primary font-semibold hover:text-primary-hover flex items-center gap-1 text-sm">
                                {{ __('View All') }}
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>

                        <!-- Federation Tabs -->
                        <div class="mb-6" x-data="{
                            activeFederation: 'all',
                            activeTournament: 'all',
                            isLoading: false,
                            visibleCount: 0,
                            async changeFederation(fed) {
                                if (this.isLoading) return;
                                this.isLoading = true;
                                this.activeFederation = fed;
                                this.activeTournament = 'all';
                                await new Promise(resolve => setTimeout(resolve, 150));
                                this.isLoading = false;
                            }
                        }" x-init="$watch('activeFederation', () => { setTimeout(() => { visibleCount = $el.querySelectorAll('[x-show]:not([style*=\'display: none\'])').length }, 200) })">
                            <!-- Federation Filter -->
                            <div class="flex items-center gap-2 mb-4 overflow-x-auto pb-2">
                                <button @click="changeFederation('all')"
                                        :disabled="isLoading"
                                        :class="activeFederation === 'all' ? 'bg-primary text-primary-foreground' : 'bg-card text-foreground hover:bg-muted'"
                                        class="px-4 py-2 rounded-[var(--radius-md)] text-sm font-semibold whitespace-nowrap transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                                    {{ __('All') }}
                                </button>
                                <button @click="changeFederation('pdc')"
                                        :disabled="isLoading"
                                        :class="activeFederation === 'pdc' ? 'bg-primary text-primary-foreground' : 'bg-card text-foreground hover:bg-muted'"
                                        class="px-4 py-2 rounded-[var(--radius-md)] text-sm font-semibold whitespace-nowrap transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                                    PDC
                                </button>
                                <button @click="changeFederation('wdf')"
                                        :disabled="isLoading"
                                        :class="activeFederation === 'wdf' ? 'bg-primary text-primary-foreground' : 'bg-card text-foreground hover:bg-muted'"
                                        class="px-4 py-2 rounded-[var(--radius-md)] text-sm font-semibold whitespace-nowrap transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                                    WDF
                                </button>
                                <button @click="changeFederation('bdo')"
                                        :disabled="isLoading"
                                        :class="activeFederation === 'bdo' ? 'bg-primary text-primary-foreground' : 'bg-card text-foreground hover:bg-muted'"
                                        class="px-4 py-2 rounded-[var(--radius-md)] text-sm font-semibold whitespace-nowrap transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                                    BDO
                                </button>
                            </div>

                            <!-- Loading Indicator and Counter -->
                            <div class="flex items-center gap-3 mb-4 min-h-[24px]">
                                <div x-show="isLoading" class="flex items-center gap-2 text-sm text-muted-foreground">
                                    <svg class="animate-spin h-4 w-4 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <span>Chargement...</span>
                                </div>
                                <div x-show="!isLoading && visibleCount > 0" class="text-sm text-muted-foreground">
                                    <span x-text="visibleCount"></span> <span x-text="visibleCount > 1 ? '{{ __('articles') }}' : 'article'"></span>
                                </div>
                            </div>

                            <!-- Tournament Sub-tabs (PDC) -->
                            <div x-show="activeFederation === 'pdc'" class="flex items-center gap-2 mb-4 overflow-x-auto pb-2">
                                <button @click="activeTournament = 'all'"
                                        :class="activeTournament === 'all' ? 'bg-secondary text-secondary-foreground' : 'bg-card text-muted-foreground hover:bg-muted'"
                                        class="px-3 py-1.5 rounded-[var(--radius-sm)] text-xs font-semibold whitespace-nowrap transition-colors">
                                    {{ __('All Tournaments') }}
                                </button>
                                @foreach($majorCompetitions as $competition)
                                    @if($competition->federation->slug === 'pdc')
                                        <a href="{{ route('competitions.show', $competition->slug) }}"
                                           class="px-3 py-1.5 rounded-[var(--radius-sm)] text-xs font-semibold whitespace-nowrap transition-colors bg-card text-muted-foreground hover:bg-muted border border-border hover:border-primary">
                                            {{ $competition->name }}
                                        </a>
                                    @endif
                                @endforeach
                                <a href="{{ route('competitions.index') }}"
                                   class="px-3 py-1.5 rounded-[var(--radius-sm)] text-xs font-semibold whitespace-nowrap transition-colors bg-primary/10 text-primary hover:bg-primary hover:text-primary-foreground border border-primary/30">
                                    {{ __('All Competitions') }} →
                                </a>
                            </div>

                            <!-- Tournament Sub-tabs (WDF) -->
                            <div x-show="activeFederation === 'wdf'" class="flex items-center gap-2 mb-4 overflow-x-auto pb-2">
                                <button @click="activeTournament = 'all'"
                                        :class="activeTournament === 'all' ? 'bg-secondary text-secondary-foreground' : 'bg-card text-muted-foreground hover:bg-muted'"
                                        class="px-3 py-1.5 rounded-[var(--radius-sm)] text-xs font-semibold whitespace-nowrap transition-colors">
                                    {{ __('All Tournaments') }}
                                </button>
                                @foreach($majorCompetitions as $competition)
                                    @if($competition->federation->slug === 'wdf')
                                        <a href="{{ route('competitions.show', $competition->slug) }}"
                                           class="px-3 py-1.5 rounded-[var(--radius-sm)] text-xs font-semibold whitespace-nowrap transition-colors bg-card text-muted-foreground hover:bg-muted border border-border hover:border-primary">
                                            {{ $competition->name }}
                                        </a>
                                    @endif
                                @endforeach
                                <a href="{{ route('competitions.index') }}"
                                   class="px-3 py-1.5 rounded-[var(--radius-sm)] text-xs font-semibold whitespace-nowrap transition-colors bg-primary/10 text-primary hover:bg-primary hover:text-primary-foreground border border-primary/30">
                                    {{ __('All Competitions') }} →
                                </a>
                            </div>

                            <!-- Tournament Sub-tabs (BDO) -->
                            <div x-show="activeFederation === 'bdo'" class="flex items-center gap-2 mb-4 overflow-x-auto pb-2">
                                <button @click="activeTournament = 'all'"
                                        :class="activeTournament === 'all' ? 'bg-secondary text-secondary-foreground' : 'bg-card text-muted-foreground hover:bg-muted'"
                                        class="px-3 py-1.5 rounded-[var(--radius-sm)] text-xs font-semibold whitespace-nowrap transition-colors">
                                    {{ __('All Tournaments') }}
                                </button>
                                @foreach($majorCompetitions as $competition)
                                    @if($competition->federation->slug === 'bdo')
                                        <a href="{{ route('competitions.show', $competition->slug) }}"
                                           class="px-3 py-1.5 rounded-[var(--radius-sm)] text-xs font-semibold whitespace-nowrap transition-colors bg-card text-muted-foreground hover:bg-muted border border-border hover:border-primary">
                                            {{ $competition->name }}
                                        </a>
                                    @endif
                                @endforeach
                                <a href="{{ route('competitions.index') }}"
                                   class="px-3 py-1.5 rounded-[var(--radius-sm)] text-xs font-semibold whitespace-nowrap transition-colors bg-primary/10 text-primary hover:bg-primary hover:text-primary-foreground border border-primary/30">
                                    {{ __('All Competitions') }} →
                                </a>
                            </div>

                        @if($latestNews->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach($latestNews as $article)
                                    <a href="{{ route('articles.show', $article->slug) }}"
                                       class="sharp-box-hover group overflow-hidden rounded-[var(--radius-base)] border-2 border-transparent hover:border-primary transition-all duration-300"
                                       x-show="(activeFederation === 'all' || '{{ $article->federation?->slug ?? 'pdc' }}' === activeFederation) && (activeTournament === 'all' || '{{ $article->competition?->slug ?? '' }}' === activeTournament)"
                                       x-transition:enter="transition ease-out duration-200"
                                       x-transition:enter-start="opacity-0 scale-95"
                                       x-transition:enter-end="opacity-100 scale-100">
                                        <!-- Image -->
                                        <div class="aspect-[16/10] bg-gradient-to-br from-muted to-border relative overflow-hidden diagonal-overlay group-hover:scale-[1.02] transition-transform duration-300">
                                            <!-- Pattern overlay -->
                                            <div class="absolute inset-0 opacity-5">
                                                <div class="absolute top-0 right-0 w-32 h-32 border-2 border-current transform rotate-12"></div>
                                            </div>

                                            <!-- Category tag - top left -->
                                            <div class="absolute top-0 left-0 tag
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
                                            </div>
                                        </div>

                                        <!-- Content -->
                                        <div class="p-5 space-y-3 bg-card">
                                            <div class="flex items-center gap-2">
                                                <div class="w-1 h-3 bg-primary"></div>
                                                <p class="text-[11px] text-muted-foreground font-bold uppercase tracking-wider">
                                                    {{ $article->published_at?->format('M d, Y') }}
                                                </p>
                                            </div>

                                            <h3 class="font-display text-lg font-black text-foreground group-hover:text-primary transition-colors line-clamp-2 line-clamp-fade leading-tight tracking-tight">
                                                {{ $article->title }}
                                            </h3>

                                            <p class="text-sm text-muted-foreground line-clamp-2 line-clamp-fade leading-relaxed">
                                                {{ Str::limit($article->excerpt, 100) }}
                                            </p>

                                            <div class="flex items-center gap-2 text-primary text-xs font-bold uppercase tracking-wider opacity-0 group-hover:opacity-100 transition-all duration-300 group-hover:gap-3">
                                                {{ __('Read More') }}
                                                <svg class="w-3 h-3 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
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
                        <section class="mt-8 bg-card rounded-[var(--radius-base)] border border-card-border p-6 lg:p-8 shadow-sm">
                            <div class="flex items-center gap-4 mb-8">
                                <div class="w-1 h-8 bg-primary"></div>
                                <h2 class="font-display text-2xl font-black text-foreground tracking-tight">{{ __('Recent Results') }}</h2>
                                <div class="h-0.5 flex-1 bg-gradient-to-r from-border to-transparent"></div>
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
                                    <div class="sharp-box overflow-hidden group relative rounded-[var(--radius-base)]" x-data="{ open: false }">
                                        <!-- Competition header with diagonal cut -->
                                        <div class="px-5 py-3 bg-muted/30 border-b-2 border-border flex items-center justify-between relative">
                                            <div class="absolute top-0 left-0 w-20 h-full bg-primary/10"></div>
                                            <span class="text-[11px] font-black text-foreground uppercase tracking-wider relative z-10">
                                                {{ $result->competition?->name ?? $result->title }}
                                            </span>
                                            <div class="tag text-success text-[10px] relative z-10">
                                                {{ __('Terminé') }}
                                            </div>
                                        </div>

                                        <!-- Date bar -->
                                        <div class="px-5 py-2 bg-darker text-white/60 text-[10px] font-bold uppercase tracking-wider">
                                            {{ $result->end_date->format('d/m/Y - H:i') }}
                                        </div>

                                        <!-- Players Section - Horizontal VS Layout -->
                                        <div class="p-5 bg-card">
                                            <div class="flex items-center justify-between gap-4">
                                                <!-- Player 1 (Winner) - Left -->
                                                <div class="flex flex-col items-start gap-2 flex-1 min-w-0 bg-success/5 -m-5 p-5 mr-0 rounded-l-[var(--radius-base)]">
                                                    <div class="flex items-center gap-3 w-full">
                                                        <div class="hex-badge bg-gradient-to-br from-primary to-primary-dark flex-shrink-0">
                                                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                            </svg>
                                                        </div>
                                                        <div class="flex-1 min-w-0">
                                                            <p class="font-display text-lg font-black text-foreground leading-tight truncate tracking-tight">
                                                                {{ $player1?->full_name ?? 'Michael Smith' }}
                                                            </p>
                                                            <div class="flex items-center gap-2 mt-0.5">
                                                                <div class="w-8 h-0.5 bg-success"></div>
                                                                <p class="text-[10px] text-success font-bold uppercase tracking-wider">{{ __('Winner') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- VS Score Center -->
                                                <div class="flex flex-col items-center gap-1 px-4 relative">
                                                    <div class="absolute inset-0 bg-gradient-to-b from-primary/5 to-transparent"></div>
                                                    <div class="flex items-baseline gap-3 relative">
                                                        <div class="impact-number !text-5xl !from-primary !to-primary">{{ $score1 }}</div>
                                                        <div class="text-base font-black text-muted-foreground">–</div>
                                                        <div class="text-4xl font-display font-bold text-muted-foreground">{{ $score2 }}</div>
                                                    </div>
                                                    <div class="text-[9px] font-black text-muted-foreground uppercase tracking-widest">VS</div>
                                                </div>

                                                <!-- Player 2 (Runner-up) - Right -->
                                                <div class="flex flex-col items-end gap-2 flex-1 min-w-0">
                                                    <div class="flex items-center gap-3 w-full justify-end">
                                                        <div class="flex-1 min-w-0 text-right">
                                                            <p class="font-display text-base font-bold text-muted-foreground leading-tight truncate tracking-tight">
                                                                {{ $player2?->full_name ?? 'Michael van Gerwen' }}
                                                            </p>
                                                            <div class="flex items-center gap-2 mt-0.5 justify-end">
                                                                <p class="text-[10px] text-muted-foreground font-semibold uppercase tracking-wider">{{ __('Runner-up') }}</p>
                                                                <div class="w-8 h-0.5 bg-border"></div>
                                                            </div>
                                                        </div>
                                                        <div class="hex-badge bg-muted flex-shrink-0">
                                                            <div class="w-3 h-3 border-2 border-border transform rotate-45"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Stats Toggle -->
                                        <div class="border-t-2 border-border">
                                            <button @click="open = !open" class="w-full px-5 py-3 flex items-center justify-center gap-2 text-[10px] font-black text-primary hover:bg-primary/5 transition-colors uppercase tracking-widest">
                                                <span x-text="open ? '{{ __('Hide Stats') }}' : '{{ __('View Stats') }}'"></span>
                                                <svg class="w-3 h-3 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>
                                        </div>

                                        <!-- Stats Dropdown -->
                                        <div x-show="open"
                                             x-transition:enter="transition ease-out duration-200"
                                             x-transition:enter-start="opacity-0 -translate-y-2"
                                             x-transition:enter-end="opacity-100 translate-y-0"
                                             class="border-t-2 border-border bg-muted/50 px-5 py-5">
                                            <div class="space-y-4">
                                                <!-- Average -->
                                                <div>
                                                    <div class="flex items-center justify-between mb-2">
                                                        <span class="text-[10px] font-black text-muted-foreground uppercase tracking-widest">{{ __('Average') }}</span>
                                                        <div class="flex items-center gap-4">
                                                            <span class="font-display text-lg font-black text-primary">98.5</span>
                                                            <span class="text-xs font-bold text-muted-foreground">vs</span>
                                                            <span class="font-display text-lg font-bold text-muted-foreground">89.2</span>
                                                        </div>
                                                    </div>
                                                    <div class="stat-bar" style="--stat-width: 68%"></div>
                                                </div>

                                                <!-- Checkout % -->
                                                <div>
                                                    <div class="flex items-center justify-between mb-2">
                                                        <span class="text-[10px] font-black text-muted-foreground uppercase tracking-widest">{{ __('Checkout %') }}</span>
                                                        <div class="flex items-center gap-4">
                                                            <span class="font-display text-lg font-black text-primary">42%</span>
                                                            <span class="text-xs font-bold text-muted-foreground">vs</span>
                                                            <span class="font-display text-lg font-bold text-muted-foreground">36%</span>
                                                        </div>
                                                    </div>
                                                    <div class="stat-bar" style="--stat-width: 54%"></div>
                                                </div>

                                                <!-- 180s -->
                                                <div>
                                                    <div class="flex items-center justify-between mb-2">
                                                        <span class="text-[10px] font-black text-muted-foreground uppercase tracking-widest">180s</span>
                                                        <div class="flex items-center gap-4">
                                                            <span class="font-display text-lg font-black text-primary">8</span>
                                                            <span class="text-xs font-bold text-muted-foreground">vs</span>
                                                            <span class="font-display text-lg font-bold text-muted-foreground">4</span>
                                                        </div>
                                                    </div>
                                                    <div class="stat-bar" style="--stat-width: 67%"></div>
                                                </div>
                                            </div>

                                            <div class="mt-5 pt-4 border-t border-border flex items-center gap-2">
                                                <div class="w-1 h-4 bg-primary"></div>
                                                <span class="text-[11px] text-muted-foreground font-semibold">{{ $result->venue }}</span>
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
                        <section class="bg-darker cut-corner-tr overflow-hidden rounded-[var(--radius-base)] shadow-lg">
                            <!-- Header with accent -->
                            <div class="relative px-6 py-4 border-b-2 border-primary/30">
                                <div class="absolute top-0 left-0 w-32 h-full bg-primary/10"></div>
                                <div class="flex items-center justify-between relative z-10">
                                    <h3 class="font-display text-xl font-black text-white tracking-tight">{{ __('Upcoming') }}</h3>
                                    <a href="{{ route('calendar.index') }}" class="text-xs text-primary font-black hover:text-primary-hover uppercase tracking-widest flex items-center gap-1">
                                        {{ __('View All') }}
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <div class="p-6 space-y-4">
                                @foreach($upcomingEvents as $event)
                                    <div class="bracket-line pl-4 pb-4 border-b border-white/5 last:border-0 last:pb-0 hover:bg-white/5 -mx-2 px-6 py-2 transition-colors">
                                        <div class="flex items-start gap-4">
                                            <div class="text-center bg-gradient-to-br from-primary to-primary-dark cut-corner-br p-3 min-w-[56px]">
                                                <div class="text-[9px] font-black text-white uppercase tracking-widest">
                                                    {{ $event->start_date->format('M') }}
                                                </div>
                                                <div class="text-2xl font-display font-black text-white leading-none mt-1">
                                                    {{ $event->start_date->format('d') }}
                                                </div>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <h4 class="font-display font-black text-sm text-white mb-2 line-clamp-2 leading-tight tracking-tight">{{ $event->title }}</h4>
                                                <div class="flex items-center gap-2 mb-2">
                                                    <div class="w-1 h-3 bg-primary/50"></div>
                                                    <p class="text-[11px] text-white/50 font-medium">{{ $event->venue }}</p>
                                                </div>
                                                @if($event->competition)
                                                    <div class="tag text-white/70 text-[9px]">
                                                        {{ $event->competition->federation->name }}
                                                    </div>
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
                        <section class="bg-darker cut-corner-tl overflow-hidden rounded-[var(--radius-base)] shadow-lg">
                            <!-- Header with accent -->
                            <div class="relative px-6 py-4 border-b-2 border-accent/30">
                                <div class="absolute top-0 right-0 w-32 h-full bg-accent/10"></div>
                                <div class="flex items-center justify-between relative z-10">
                                    <h3 class="font-display text-xl font-black text-white tracking-tight">{{ __('PDC Rankings') }}</h3>
                                    <a href="{{ route('rankings.index') }}" class="text-xs text-accent font-black hover:text-accent-hover uppercase tracking-widest flex items-center gap-1">
                                        {{ __('Full Table') }}
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <div class="p-6 space-y-1">
                                @foreach($topRankings->take(10) as $ranking)
                                    <a href="{{ route('players.show', $ranking->player->slug) }}" class="flex items-center gap-3 py-3 px-3 hover:bg-white/5 border-l-2 border-transparent hover:border-accent transition-all group -mx-3">
                                        <div class="flex items-center justify-center min-w-[32px] h-8 bg-gradient-to-br from-accent/20 to-accent/10 font-display text-base font-black text-accent">
                                            {{ $ranking->position }}
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="font-display font-black text-sm text-white group-hover:text-accent transition-colors truncate tracking-tight">
                                                {{ $ranking->player->full_name }}
                                            </p>
                                            <p class="text-[10px] text-white/50 font-semibold uppercase tracking-wider mt-0.5">{{ $ranking->player->nationality }}</p>
                                        </div>
                                        @if($ranking->previous_position && $ranking->previous_position > $ranking->position)
                                            <div class="flex items-center gap-1 text-success text-xs font-black flex-shrink-0">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                        @elseif($ranking->previous_position && $ranking->previous_position < $ranking->position)
                                            <div class="flex items-center gap-1 text-danger text-xs font-black flex-shrink-0">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                        @else
                                            <div class="w-3 h-0.5 bg-white/20 flex-shrink-0"></div>
                                        @endif
                                    </a>
                                @endforeach
                            </div>
                        </section>
                    @endif

                    <!-- Featured Players -->
                    @if($featuredPlayers->count() > 0)
                        <section class="bg-card rounded-[var(--radius-base)] border border-card-border p-6 shadow-sm">
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

    <!-- Federations Sections -->
    <section class="bg-background section">
        <div class="container">
            <div class="text-center mb-10">
                <h2 class="font-display text-3xl lg:text-4xl font-bold text-foreground mb-3">
                    {{ __('Explore by Federation') }}
                </h2>
                <p class="text-muted-foreground text-lg">
                    {{ __('Dive into the world of professional darts across all major federations') }}
                </p>
            </div>

            <div class="space-y-10">
                <!-- PDC Section -->
                <div class="bg-card border border-card-border rounded-[var(--radius-base)] overflow-hidden shadow-md" x-data="{ activeComp: 'all' }">
                    <div class="bg-gradient-to-r from-primary/10 to-primary/5 p-6 border-b border-border">
                        <div class="flex items-center justify-between flex-wrap gap-4">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 bg-primary/20 rounded-xl flex items-center justify-center text-3xl"><span role="img" aria-label="{{ __('DartsArena logo - dart target') }}">🎯</span></div>
                                <div>
                                    <h3 class="font-display text-xl lg:text-2xl font-bold text-foreground">PDC</h3>
                                    <p class="text-xs lg:text-sm text-muted-foreground">Professional Darts Corporation</p>
                                </div>
                            </div>
                            <a href="{{ route('federations.show', 'pdc') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-primary-foreground rounded-[var(--radius-md)] text-sm font-semibold hover:bg-primary-hover transition-colors">
                                {{ __('View Federation') }}
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Competitions Tabs -->
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-6 overflow-x-auto pb-2">
                            <button @click="activeComp = 'all'"
                                    :class="activeComp === 'all' ? 'bg-primary text-primary-foreground' : 'bg-muted text-foreground hover:bg-muted/80'"
                                    class="px-4 py-2 rounded-[var(--radius-md)] text-sm font-semibold whitespace-nowrap transition-colors">
                                {{ __('All') }}
                            </button>
                            <button @click="activeComp = 'worlds'"
                                    :class="activeComp === 'worlds' ? 'bg-primary text-primary-foreground' : 'bg-muted text-foreground hover:bg-muted/80'"
                                    class="px-4 py-2 rounded-[var(--radius-md)] text-sm font-semibold whitespace-nowrap transition-colors">
                                <span role="img" aria-label="Trophy">🏆</span> {{ __('World Championship') }}
                            </button>
                            <button @click="activeComp = 'premier'"
                                    :class="activeComp === 'premier' ? 'bg-primary text-primary-foreground' : 'bg-muted text-foreground hover:bg-muted/80'"
                                    class="px-4 py-2 rounded-[var(--radius-md)] text-sm font-semibold whitespace-nowrap transition-colors">
                                <span role="img" aria-label="Star">⭐</span> {{ __('Premier League') }}
                            </button>
                            <button @click="activeComp = 'majors'"
                                    :class="activeComp === 'majors' ? 'bg-primary text-primary-foreground' : 'bg-muted text-foreground hover:bg-muted/80'"
                                    class="px-4 py-2 rounded-[var(--radius-md)] text-sm font-semibold whitespace-nowrap transition-colors">
                                <span role="img" aria-label="Diamond">💎</span> {{ __('Major Tournaments') }}
                            </button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($majorCompetitions->where('federation.slug', 'pdc')->take(6) as $competition)
                                <a href="{{ route('competitions.show', $competition->slug) }}"
                                   class="bg-muted/50 border border-border rounded-[var(--radius-md)] p-4 hover:bg-muted hover:border-primary/50 transition-all group">
                                    <div class="flex items-start gap-3">
                                        <div class="w-12 h-12 bg-primary/10 rounded-[var(--radius-md)] flex items-center justify-center text-2xl flex-shrink-0"><span role="img" aria-label="Trophy">🏆</span></div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-semibold text-foreground group-hover:text-primary transition-colors truncate">
                                                {{ $competition->name }}
                                            </h4>
                                            <p class="text-xs text-muted-foreground mt-1">{{ $competition->format }}</p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- WDF Section -->
                <div class="bg-card border border-card-border rounded-[var(--radius-base)] overflow-hidden shadow-md" x-data="{ activeComp: 'all' }">
                    <div class="bg-gradient-to-r from-accent/10 to-accent/5 p-6 border-b border-border">
                        <div class="flex items-center justify-between flex-wrap gap-4">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 bg-accent/20 rounded-xl flex items-center justify-center text-3xl"><span role="img" aria-label="World">🌍</span></div>
                                <div>
                                    <h3 class="font-display text-xl lg:text-2xl font-bold text-foreground">WDF</h3>
                                    <p class="text-xs lg:text-sm text-muted-foreground">World Darts Federation</p>
                                </div>
                            </div>
                            <a href="{{ route('federations.show', 'wdf') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-accent text-accent-foreground rounded-[var(--radius-md)] text-sm font-semibold hover:bg-accent/90 transition-colors">
                                {{ __('View Federation') }}
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-6 overflow-x-auto pb-2">
                            <button @click="activeComp = 'all'"
                                    :class="activeComp === 'all' ? 'bg-accent text-accent-foreground' : 'bg-muted text-foreground hover:bg-muted/80'"
                                    class="px-4 py-2 rounded-[var(--radius-md)] text-sm font-semibold whitespace-nowrap transition-colors">
                                {{ __('All') }}
                            </button>
                            <button @click="activeComp = 'worlds'"
                                    :class="activeComp === 'worlds' ? 'bg-accent text-accent-foreground' : 'bg-muted text-foreground hover:bg-muted/80'"
                                    class="px-4 py-2 rounded-[var(--radius-md)] text-sm font-semibold whitespace-nowrap transition-colors">
                                <span role="img" aria-label="Trophy">🏆</span> {{ __('World Cup') }}
                            </button>
                            <button @click="activeComp = 'europe'"
                                    :class="activeComp === 'europe' ? 'bg-accent text-accent-foreground' : 'bg-muted text-foreground hover:bg-muted/80'"
                                    class="px-4 py-2 rounded-[var(--radius-md)] text-sm font-semibold whitespace-nowrap transition-colors">
                                <span role="img" aria-label="Europe">🇪🇺</span> {{ __('European Championships') }}
                            </button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($majorCompetitions->where('federation.slug', 'wdf')->take(6) as $competition)
                                <a href="{{ route('competitions.show', $competition->slug) }}"
                                   class="bg-muted/50 border border-border rounded-[var(--radius-md)] p-4 hover:bg-muted hover:border-accent/50 transition-all group">
                                    <div class="flex items-start gap-3">
                                        <div class="w-12 h-12 bg-accent/10 rounded-[var(--radius-md)] flex items-center justify-center text-2xl flex-shrink-0"><span role="img" aria-label="Trophy">🏆</span></div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-semibold text-foreground group-hover:text-accent transition-colors truncate">
                                                {{ $competition->name }}
                                            </h4>
                                            <p class="text-xs text-muted-foreground mt-1">{{ $competition->format }}</p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- BDO Section -->
                <div class="bg-card border border-card-border rounded-[var(--radius-base)] overflow-hidden shadow-md" x-data="{ activeComp: 'all' }">
                    <div class="bg-gradient-to-r from-info/10 to-info/5 p-6 border-b border-border">
                        <div class="flex items-center justify-between flex-wrap gap-4">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 bg-info/20 rounded-xl flex items-center justify-center text-3xl"><span role="img" aria-label="Events">🎪</span></div>
                                <div>
                                    <h3 class="font-display text-xl lg:text-2xl font-bold text-foreground">BDO</h3>
                                    <p class="text-xs lg:text-sm text-muted-foreground">British Darts Organisation</p>
                                </div>
                            </div>
                            <a href="{{ route('federations.show', 'bdo') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-info text-info-foreground rounded-[var(--radius-md)] text-sm font-semibold hover:bg-info/90 transition-colors">
                                {{ __('View Federation') }}
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-6 overflow-x-auto pb-2">
                            <button @click="activeComp = 'all'"
                                    :class="activeComp === 'all' ? 'bg-info text-info-foreground' : 'bg-muted text-foreground hover:bg-muted/80'"
                                    class="px-4 py-2 rounded-[var(--radius-md)] text-sm font-semibold whitespace-nowrap transition-colors">
                                {{ __('All') }}
                            </button>
                            <button @click="activeComp = 'classics'"
                                    :class="activeComp === 'classics' ? 'bg-info text-info-foreground' : 'bg-muted text-foreground hover:bg-muted/80'"
                                    class="px-4 py-2 rounded-[var(--radius-md)] text-sm font-semibold whitespace-nowrap transition-colors">
                                <span role="img" aria-label="Scroll">📜</span> {{ __('Classic Tournaments') }}
                            </button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($majorCompetitions->where('federation.slug', 'bdo')->take(6) as $competition)
                                <a href="{{ route('competitions.show', $competition->slug) }}"
                                   class="bg-muted/50 border border-border rounded-[var(--radius-md)] p-4 hover:bg-muted hover:border-info/50 transition-all group">
                                    <div class="flex items-start gap-3">
                                        <div class="w-12 h-12 bg-info/10 rounded-[var(--radius-md)] flex items-center justify-center text-2xl flex-shrink-0"><span role="img" aria-label="Trophy">🏆</span></div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-semibold text-foreground group-hover:text-info transition-colors truncate">
                                                {{ $competition->name }}
                                            </h4>
                                            <p class="text-xs text-muted-foreground mt-1">{{ $competition->format }}</p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- MODUS Super Series Section -->
                <div class="bg-card border border-card-border rounded-[var(--radius-base)] overflow-hidden shadow-md" x-data="{ activeComp: 'all' }">
                    <div class="bg-gradient-to-r from-warning/10 to-warning/5 p-6 border-b border-border">
                        <div class="flex items-center justify-between flex-wrap gap-4">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 bg-warning/20 rounded-xl flex items-center justify-center text-3xl"><span role="img" aria-label="Fast">⚡</span></div>
                                <div>
                                    <h3 class="font-display text-xl lg:text-2xl font-bold text-foreground">MODUS Super Series</h3>
                                    <p class="text-xs lg:text-sm text-muted-foreground">{{ __('Fast-paced competitive darts') }}</p>
                                </div>
                            </div>
                            <a href="{{ route('competitions.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-warning text-warning-foreground rounded-[var(--radius-md)] text-sm font-semibold hover:bg-warning/90 transition-colors">
                                {{ __('View Series') }}
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-6 overflow-x-auto pb-2">
                            <button @click="activeComp = 'all'"
                                    :class="activeComp === 'all' ? 'bg-warning text-warning-foreground' : 'bg-muted text-foreground hover:bg-muted/80'"
                                    class="px-4 py-2 rounded-[var(--radius-md)] text-sm font-semibold whitespace-nowrap transition-colors">
                                {{ __('All') }}
                            </button>
                            <button @click="activeComp = 'live'"
                                    :class="activeComp === 'live' ? 'bg-warning text-warning-foreground' : 'bg-muted text-foreground hover:bg-muted/80'"
                                    class="px-4 py-2 rounded-[var(--radius-md)] text-sm font-semibold whitespace-nowrap transition-colors">
                                🔴 {{ __('Live Events') }}
                            </button>
                            <button @click="activeComp = 'online'"
                                    :class="activeComp === 'online' ? 'bg-warning text-warning-foreground' : 'bg-muted text-foreground hover:bg-muted/80'"
                                    class="px-4 py-2 rounded-[var(--radius-md)] text-sm font-semibold whitespace-nowrap transition-colors">
                                💻 {{ __('Online Series') }}
                            </button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div class="bg-muted/50 border border-border rounded-[var(--radius-md)] p-4 hover:bg-muted hover:border-warning/50 transition-all group">
                                <div class="flex items-start gap-3">
                                    <div class="w-12 h-12 bg-warning/10 rounded-[var(--radius-md)] flex items-center justify-center text-2xl flex-shrink-0"><span role="img" aria-label="Fast">⚡</span></div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-semibold text-foreground group-hover:text-warning transition-colors">
                                            {{ __('MODUS Icons of Darts Live League') }}
                                        </h4>
                                        <p class="text-xs text-muted-foreground mt-1">{{ __('Best of 9 Legs') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-muted/50 border border-border rounded-[var(--radius-md)] p-4 hover:bg-muted hover:border-warning/50 transition-all group">
                                <div class="flex items-start gap-3">
                                    <div class="w-12 h-12 bg-warning/10 rounded-[var(--radius-md)] flex items-center justify-center text-2xl flex-shrink-0">💻</div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-semibold text-foreground group-hover:text-warning transition-colors">
                                            {{ __('MODUS Online Live League') }}
                                        </h4>
                                        <p class="text-xs text-muted-foreground mt-1">{{ __('Best of 7 Legs') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-muted/50 border border-border rounded-[var(--radius-md)] p-4 hover:bg-muted hover:border-warning/50 transition-all group">
                                <div class="flex items-start gap-3">
                                    <div class="w-12 h-12 bg-warning/10 rounded-[var(--radius-md)] flex items-center justify-center text-2xl flex-shrink-0">🏆</div>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-semibold text-foreground group-hover:text-warning transition-colors">
                                            {{ __('MODUS Super Series Events') }}
                                        </h4>
                                        <p class="text-xs text-muted-foreground mt-1">{{ __('Various Formats') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Betting Tips Section -->
    <section class="bg-muted section">
        <div class="container">
            <div class="text-center mb-10">
                <h2 class="font-display text-3xl lg:text-4xl font-bold text-foreground mb-3">
                    {{ __('Betting Tips & Predictions') }}
                </h2>
                <p class="text-muted-foreground text-lg">
                    {{ __('Expert analysis and insights for upcoming matches') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Betting Tip Card 1 -->
                <div class="bg-card border border-card-border rounded-[var(--radius-base)] overflow-hidden hover:shadow-xl hover:border-primary/50 transition-all group">
                    <div class="bg-gradient-to-br from-primary/20 to-primary/5 p-6 border-b border-border">
                        <div class="flex items-center justify-between mb-4">
                            <span class="inline-flex items-center px-3 py-1 bg-success/20 text-success border border-success/30 rounded-[var(--radius-sm)] text-xs font-bold uppercase tracking-wide">
                                <span role="img" aria-label="Target">🎯</span> {{ __('Hot Tip') }}
                            </span>
                            <span class="text-xs font-semibold text-muted-foreground">{{ __('Today') }}</span>
                        </div>
                        <h3 class="font-display text-xl font-bold text-foreground mb-2">
                            {{ __('World Championship Final') }}
                        </h3>
                        <p class="text-sm text-muted-foreground">PDC World Championship</p>
                    </div>

                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4 pb-4 border-b border-border">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center text-xl"><span role="img" aria-label="Target">🎯</span></div>
                                <span class="font-semibold text-foreground">Michael Smith</span>
                            </div>
                            <span class="font-bold text-primary text-lg">2.5</span>
                        </div>

                        <div class="space-y-3 mb-5">
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-success mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm text-muted-foreground">{{ __('Excellent recent form with 98+ average') }}</span>
                            </div>
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-success mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm text-muted-foreground">{{ __('Strong head-to-head record') }}</span>
                            </div>
                        </div>

                        <div class="bg-primary/5 rounded-[var(--radius-md)] p-3 border border-primary/20">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-semibold text-muted-foreground uppercase">{{ __('Confidence') }}</span>
                                <span class="font-bold text-primary">85%</span>
                            </div>
                            <div class="w-full bg-border rounded-full h-2 mt-2">
                                <div class="bg-primary h-2 rounded-full" style="width: 85%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Betting Tip Card 2 -->
                <div class="bg-card border border-card-border rounded-[var(--radius-base)] overflow-hidden hover:shadow-xl hover:border-accent/50 transition-all group">
                    <div class="bg-gradient-to-br from-accent/20 to-accent/5 p-6 border-b border-border">
                        <div class="flex items-center justify-between mb-4">
                            <span class="inline-flex items-center px-3 py-1 bg-warning/20 text-warning border border-warning/30 rounded-full text-xs font-bold uppercase tracking-wide">
                                <span role="img" aria-label="Fast">⚡</span> {{ __('Value Bet') }}
                            </span>
                            <span class="text-xs font-semibold text-muted-foreground">{{ __('Tomorrow') }}</span>
                        </div>
                        <h3 class="font-display text-xl font-bold text-foreground mb-2">
                            {{ __('Premier League Night 5') }}
                        </h3>
                        <p class="text-sm text-muted-foreground">PDC Premier League</p>
                    </div>

                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4 pb-4 border-b border-border">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-accent/10 rounded-full flex items-center justify-center text-xl"><span role="img" aria-label="Target">🎯</span></div>
                                <span class="font-semibold text-foreground">Peter Wright</span>
                            </div>
                            <span class="font-bold text-accent text-lg">3.2</span>
                        </div>

                        <div class="space-y-3 mb-5">
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-success mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm text-muted-foreground">{{ __('Great value odds for top performer') }}</span>
                            </div>
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-success mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm text-muted-foreground">{{ __('Favorable venue statistics') }}</span>
                            </div>
                        </div>

                        <div class="bg-accent/5 rounded-[var(--radius-md)] p-3 border border-accent/20">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-semibold text-muted-foreground uppercase">{{ __('Confidence') }}</span>
                                <span class="font-bold text-accent">70%</span>
                            </div>
                            <div class="w-full bg-border rounded-full h-2 mt-2">
                                <div class="bg-accent h-2 rounded-full" style="width: 70%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Betting Tip Card 3 -->
                <div class="bg-card border border-card-border rounded-[var(--radius-base)] overflow-hidden hover:shadow-xl hover:border-info/50 transition-all group">
                    <div class="bg-gradient-to-br from-info/20 to-info/5 p-6 border-b border-border">
                        <div class="flex items-center justify-between mb-4">
                            <span class="inline-flex items-center px-3 py-1 bg-info/20 text-info border border-info/30 rounded-full text-xs font-bold uppercase tracking-wide">
                                📊 {{ __('Stats Play') }}
                            </span>
                            <span class="text-xs font-semibold text-muted-foreground">{{ __('This Week') }}</span>
                        </div>
                        <h3 class="font-display text-xl font-bold text-foreground mb-2">
                            {{ __('Over 4.5 180s') }}
                        </h3>
                        <p class="text-sm text-muted-foreground">PDC Pro Tour</p>
                    </div>

                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4 pb-4 border-b border-border">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-info/10 rounded-full flex items-center justify-center text-xl"><span role="img" aria-label="Target">🎯</span></div>
                                <span class="font-semibold text-foreground">MVG vs Price</span>
                            </div>
                            <span class="font-bold text-info text-lg">1.9</span>
                        </div>

                        <div class="space-y-3 mb-5">
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-success mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm text-muted-foreground">{{ __('Both players average 6+ per match') }}</span>
                            </div>
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-success mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm text-muted-foreground">{{ __('Historical data supports this bet') }}</span>
                            </div>
                        </div>

                        <div class="bg-info/5 rounded-[var(--radius-md)] p-3 border border-info/20">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-semibold text-muted-foreground uppercase">{{ __('Confidence') }}</span>
                                <span class="font-bold text-info">78%</span>
                            </div>
                            <div class="w-full bg-border rounded-full h-2 mt-2">
                                <div class="bg-info h-2 rounded-full" style="width: 78%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-10 mb-6 max-w-3xl mx-auto">
                <div class="bg-warning/10 border border-warning/30 rounded-[var(--radius-md)] p-4 text-center">
                    <p class="text-sm text-muted-foreground">
                        <span role="img" aria-label="Warning">⚠️</span> {{ __('Gambling can be addictive. Please play responsibly. 18+') }}
                    </p>
                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('articles.index') }}" class="inline-flex items-center gap-2 bg-primary text-primary-foreground hover:bg-primary-hover rounded-[var(--radius-md)] px-8 py-3 text-sm font-semibold transition-colors">
                    {{ __('View All Betting Tips') }}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Banner -->
    <section class="bg-gradient-to-r from-primary via-primary-dark to-primary relative overflow-hidden section-sm">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC40Ij48cGF0aCBkPSJNMzYgMzRjMC0yLjIxIDEuNzktNCA0LTRzNCAxLjc5IDQgNC0xLjc5IDQtNCA0LTQtMS43OS00LTR6bTAgMTBjMC0yLjIxIDEuNzktNCA0LTRzNCAxLjc5IDQgNC0xLjc5IDQtNCA0LTQtMS43OS00LTR6TTI4IDQ0YzAtMi4yMSAxLjc5LTQgNC00czQgMS43OSA0IDQtMS43OSA0LTQgNC00LTEuNzktNC00em0wLTEwYzAtMi4yMSAxLjc5LTQgNC00czQgMS43OSA0IDQtMS43OSA0LTQgNC00LTEuNzktNC00eiIvPjwvZz48L2c+PC9zdmc+')]"></div>
        </div>

        <div class="container relative">
            <div class="max-w-3xl mx-auto text-center space-y-6">
                <h2 class="font-display text-3xl lg:text-4xl font-bold text-white">
                    {{ __('Stay Updated with Professional Darts') }}
                </h2>
                <p class="text-lg text-primary-foreground/90">
                    {{ __('Breaking news, live scores, and in-depth analysis from the PDC circuit.') }}
                </p>
                <div class="flex flex-wrap gap-4 justify-center pt-4">
                    <a href="{{ route('articles.index') }}" class="inline-flex items-center justify-center gap-2 bg-white text-primary hover:bg-white/90 rounded-[var(--radius-md)] px-8 py-3 text-sm font-semibold transition-all duration-200 shadow-sm">
                        {{ __('Explore News') }}
                    </a>
                    <a href="{{ route('guides.index') }}" class="inline-flex items-center justify-center gap-2 border-2 border-white text-white hover:bg-white hover:text-primary rounded-[var(--radius-md)] px-8 py-3 text-sm font-semibold transition-all duration-200">
                        {{ __('Learn More') }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- SEO Content Section -->
    <section class="bg-background border-t-2 border-border section">
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
                            <span role="img" aria-label="Trophy">🏆</span> {{ __('Major Competitions') }}
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
                            <span role="img" aria-label="Star">⭐</span> {{ __('Top Players') }}
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
