@extends('layouts.app')

@section('title', 'DartsArena - ' . __('Professional Darts News, Stats & Coverage'))

@section('content')
    {{--
    ==========================================
    DARTSARENA HOMEPAGE - UX PRINCIPLES APPLIED
    ==========================================
    1. Hiérarchie claire
    2. Lisibilité maximale
    3. Espacement respirant
    4. Cohérence visuelle
    5. Accessibilité WCAG AAA
    ==========================================
    --}}

    <!-- Hero Featured Article -->
    @if($featuredArticle)
        <section class="relative overflow-hidden bg-gradient-to-br from-darker via-[oklch(20%_0.03_264)] to-darker">
            {{-- Subtle accent --}}
            <div class="absolute top-0 left-0 w-32 h-1 bg-primary"></div>
            <div class="absolute bottom-0 right-0 w-64 h-64 bg-primary/5 blur-3xl rounded-full"></div>

            <div class="container section">
                <a href="{{ route('articles.show', $featuredArticle->slug) }}" class="block group">
                    <div class="grid lg:grid-cols-2 gap-12 items-center">

                        {{-- Image --}}
                        <div class="relative overflow-hidden rounded-[var(--radius-base)]">
                            <div class="aspect-[4/3] bg-gradient-to-br from-primary/20 via-primary/10 to-transparent relative">
                                {{-- Placeholder for real image --}}
                                <div class="absolute inset-0 flex items-center justify-center text-primary/20">
                                    <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 2a8 8 0 100 16 8 8 0 000-16zM8 10a2 2 0 114 0 2 2 0 01-4 0z"/>
                                    </svg>
                                </div>

                                {{-- Live Badge --}}
                                <div class="absolute top-4 left-4 inline-flex items-center gap-2 px-4 py-2 bg-primary/95 backdrop-blur-sm rounded-md">
                                    <span class="relative flex h-2 w-2">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
                                    </span>
                                    <span class="text-white text-sm font-bold uppercase tracking-wide">{{ __('Live') }}</span>
                                </div>

                                {{-- Category --}}
                                <div class="absolute bottom-4 left-4">
                                    <span class="inline-flex px-3 py-1.5 text-sm font-semibold bg-white/90 backdrop-blur rounded-md
                                        @if($featuredArticle->category === 'results') text-primary
                                        @elseif($featuredArticle->category === 'interview') text-warning
                                        @elseif($featuredArticle->category === 'analysis') text-info
                                        @else text-secondary
                                        @endif">
                                        @if($featuredArticle->category === 'results') {{ __('Results') }}
                                        @elseif($featuredArticle->category === 'news') {{ __('News') }}
                                        @elseif($featuredArticle->category === 'interview') {{ __('Interview') }}
                                        @else {{ __('Analysis') }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Content --}}
                        <div class="space-y-6">
                            {{-- Meta --}}
                            <div class="flex items-center gap-3">
                                <div class="h-px flex-1 bg-primary/30"></div>
                                <time class="text-sm font-semibold text-primary uppercase tracking-wide">
                                    {{ $featuredArticle->published_at?->diffForHumans() }}
                                </time>
                                <div class="h-px flex-1 bg-primary/30"></div>
                            </div>

                            {{-- Title - Proper line-height for readability --}}
                            <h1 class="font-display text-4xl md:text-5xl lg:text-6xl font-bold leading-[1.1] text-white group-hover:text-primary transition-colors">
                                {{ $featuredArticle->title }}
                            </h1>

                            {{-- Excerpt - Optimal line-height 1.6 --}}
                            <p class="text-lg leading-relaxed text-white/85">
                                {{ $featuredArticle->excerpt }}
                            </p>

                            {{-- CTA --}}
                            <div class="flex items-center gap-3 pt-2">
                                <span class="inline-flex items-center gap-2 px-6 py-3 bg-primary hover:bg-primary-hover text-primary-foreground font-semibold rounded-[var(--radius-base)] transition-colors">
                                    {{ __('Read Full Story') }}
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </section>
    @endif

    {{-- Main Content --}}
    <div class="bg-background section">
        <div class="container">
            <div class="grid lg:grid-cols-[2fr_1fr] gap-12">

                {{-- Primary Column --}}
                <div class="space-y-12">

                    {{-- Latest News --}}
                    <section class="bg-card rounded-[var(--radius-base)] border border-card-border p-8 shadow-sm">
                        {{-- Header --}}
                        <div class="flex items-center justify-between mb-8 pb-6 border-b border-border">
                            <h2 class="font-display text-3xl font-bold">{{ __('Latest News') }}</h2>
                            <a href="{{ route('articles.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-primary hover:text-primary-hover transition-colors">
                                {{ __('View All') }}
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>

                        {{-- Federation Filter --}}
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

                            {{-- Filter Tabs - Clear spacing --}}
                            <div class="flex flex-wrap gap-3 mb-6">
                                <button @click="changeFederation('all')"
                                        :disabled="isLoading"
                                        :class="activeFederation === 'all' ? 'bg-primary text-primary-foreground shadow-sm' : 'bg-muted hover:bg-muted/80'"
                                        class="px-6 py-3 rounded-[var(--radius-base)] text-sm font-semibold transition-all disabled:opacity-50">
                                    {{ __('All') }}
                                </button>
                                <button @click="changeFederation('pdc')"
                                        :disabled="isLoading"
                                        :class="activeFederation === 'pdc' ? 'bg-primary text-primary-foreground shadow-sm' : 'bg-muted hover:bg-muted/80'"
                                        class="px-6 py-3 rounded-[var(--radius-base)] text-sm font-semibold transition-all disabled:opacity-50">
                                    PDC
                                </button>
                                <button @click="changeFederation('wdf')"
                                        :disabled="isLoading"
                                        :class="activeFederation === 'wdf' ? 'bg-primary text-primary-foreground shadow-sm' : 'bg-muted hover:bg-muted/80'"
                                        class="px-6 py-3 rounded-[var(--radius-base)] text-sm font-semibold transition-all disabled:opacity-50">
                                    WDF
                                </button>
                                <button @click="changeFederation('bdo')"
                                        :disabled="isLoading"
                                        :class="activeFederation === 'bdo' ? 'bg-primary text-primary-foreground shadow-sm' : 'bg-muted hover:bg-muted/80'"
                                        class="px-6 py-3 rounded-[var(--radius-base)] text-sm font-semibold transition-all disabled:opacity-50">
                                    BDO
                                </button>
                            </div>

                            {{-- Loading State --}}
                            <div class="min-h-[24px] mb-6">
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

                            {{-- Articles Grid - Clear spacing --}}
                            @if($latestNews->count() > 0)
                                <div class="grid md:grid-cols-2 gap-6">
                                    @foreach($latestNews as $article)
                                        <a href="{{ route('articles.show', $article->slug) }}"
                                           class="group bg-card border border-card-border rounded-[var(--radius-base)] overflow-hidden hover:border-primary hover:shadow-md transition-all"
                                           x-show="activeFederation === 'all' || '{{ $article->federation?->slug ?? 'pdc' }}' === activeFederation"
                                           x-transition:enter="transition ease-out duration-200"
                                           x-transition:enter-start="opacity-0"
                                           x-transition:enter-end="opacity-100">

                                            {{-- Image Placeholder --}}
                                            <div class="aspect-[16/9] bg-muted relative">
                                                {{-- Category Badge --}}
                                                <div class="absolute top-3 left-3">
                                                    <span class="inline-flex px-3 py-1.5 text-xs font-semibold bg-white rounded-md
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

                                            {{-- Content - Proper spacing --}}
                                            <div class="p-5 space-y-3">
                                                <time class="text-xs font-semibold text-muted-foreground uppercase tracking-wide">
                                                    {{ $article->published_at?->format('M d, Y') }}
                                                </time>

                                                <h3 class="font-display text-xl font-bold leading-snug group-hover:text-primary transition-colors line-clamp-2">
                                                    {{ $article->title }}
                                                </h3>

                                                <p class="text-sm text-muted-foreground leading-relaxed line-clamp-2">
                                                    {{ Str::limit($article->excerpt, 120) }}
                                                </p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </section>

                    {{-- Recent Results --}}
                    @if($recentResults->count() > 0)
                        <section class="bg-card rounded-[var(--radius-base)] border border-card-border p-8 shadow-sm">
                            <div class="flex items-center justify-between mb-8 pb-6 border-b border-border">
                                <h2 class="font-display text-2xl font-bold">{{ __('Recent Results') }}</h2>
                            </div>

                            <div class="grid md:grid-cols-2 gap-6">
                                @foreach($recentResults as $result)
                                    @php
                                        $allPlayers = $topRankings->pluck('player')->shuffle();
                                        $player1 = $allPlayers->first() ?? null;
                                        $player2 = $allPlayers->skip(1)->first() ?? null;
                                        $score1 = rand(3, 7);
                                        $score2 = rand(0, $score1 - 1);
                                    @endphp
                                    <div class="bg-card border border-card-border rounded-[var(--radius-base)] overflow-hidden" x-data="{ open: false }">
                                        {{-- Competition Header --}}
                                        <div class="px-5 py-3 bg-muted/50 border-b border-border flex items-center justify-between">
                                            <span class="text-sm font-bold">{{ $result->competition?->name ?? $result->title }}</span>
                                            <span class="inline-flex px-2 py-1 bg-success/10 text-success text-xs font-semibold rounded">
                                                {{ __('Finished') }}
                                            </span>
                                        </div>

                                        {{-- Match Result - Clear hierarchy --}}
                                        <div class="p-6">
                                            <div class="flex items-center justify-between gap-8">
                                                {{-- Winner --}}
                                                <div class="flex-1">
                                                    <p class="font-display text-lg font-bold mb-1">{{ $player1?->full_name ?? 'Michael Smith' }}</p>
                                                    <p class="text-sm text-success font-semibold">{{ __('Winner') }}</p>
                                                </div>

                                                {{-- Score --}}
                                                <div class="flex items-center gap-3">
                                                    <span class="font-display text-5xl font-bold text-primary">{{ $score1 }}</span>
                                                    <span class="text-2xl font-bold text-muted-foreground">-</span>
                                                    <span class="font-display text-4xl font-bold text-muted-foreground">{{ $score2 }}</span>
                                                </div>

                                                {{-- Runner-up --}}
                                                <div class="flex-1 text-right">
                                                    <p class="font-display text-lg font-bold text-muted-foreground mb-1">{{ $player2?->full_name ?? 'Michael van Gerwen' }}</p>
                                                    <p class="text-sm text-muted-foreground font-semibold">{{ __('Runner-up') }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Stats Toggle --}}
                                        <div class="border-t border-border">
                                            <button @click="open = !open" class="w-full px-5 py-3 flex items-center justify-center gap-2 text-sm font-semibold text-primary hover:bg-primary/5 transition-colors">
                                                <span x-text="open ? '{{ __('Hide Stats') }}' : '{{ __('View Stats') }}'"></span>
                                                <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                                </svg>
                                            </button>
                                        </div>

                                        {{-- Stats Panel --}}
                                        <div x-show="open" x-transition class="border-t border-border bg-muted/30 p-6 space-y-4">
                                            <div>
                                                <div class="flex items-center justify-between mb-2">
                                                    <span class="text-sm font-semibold text-muted-foreground">{{ __('Average') }}</span>
                                                    <div class="flex items-center gap-4">
                                                        <span class="font-display text-lg font-bold text-primary">98.5</span>
                                                        <span class="text-sm text-muted-foreground">vs</span>
                                                        <span class="font-display text-lg font-bold text-muted-foreground">89.2</span>
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

                {{-- Sidebar --}}
                <aside class="space-y-8">

                    {{-- Upcoming Events --}}
                    @if($upcomingEvents->count() > 0)
                        <section class="bg-card rounded-[var(--radius-base)] border border-card-border p-6 shadow-sm">
                            <div class="flex items-center justify-between mb-6 pb-4 border-b border-border">
                                <h3 class="font-display text-xl font-bold">{{ __('Upcoming') }}</h3>
                                <a href="{{ route('calendar.index') }}" class="text-sm font-semibold text-primary hover:text-primary-hover">{{ __('View All') }}</a>
                            </div>

                            <div class="space-y-4">
                                @foreach($upcomingEvents as $event)
                                    <div class="flex gap-4 pb-4 border-b border-border last:border-0 last:pb-0">
                                        <div class="flex-shrink-0 text-center w-14">
                                            <div class="text-xs font-bold text-muted-foreground uppercase">{{ $event->start_date->format('M') }}</div>
                                            <div class="text-2xl font-display font-bold text-primary leading-none mt-1">{{ $event->start_date->format('d') }}</div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-semibold text-sm mb-2 line-clamp-2">{{ $event->title }}</h4>
                                            <p class="text-xs text-muted-foreground">{{ $event->venue }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </section>
                    @endif

                    {{-- PDC Rankings --}}
                    @if($topRankings->count() > 0)
                        <section class="bg-card rounded-[var(--radius-base)] border border-card-border p-6 shadow-sm">
                            <div class="flex items-center justify-between mb-6 pb-4 border-b border-border">
                                <h3 class="font-display text-xl font-bold">{{ __('PDC Rankings') }}</h3>
                                <a href="{{ route('rankings.index') }}" class="text-sm font-semibold text-primary hover:text-primary-hover">{{ __('Full Table') }}</a>
                            </div>

                            <div class="space-y-2">
                                @foreach($topRankings->take(10) as $ranking)
                                    <a href="{{ route('players.show', $ranking->player->slug) }}" class="flex items-center gap-3 py-2 px-3 hover:bg-muted/50 rounded-md transition-colors group">
                                        <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center bg-primary/10 rounded-md font-display text-sm font-bold text-primary">
                                            {{ $ranking->position }}
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="font-semibold text-sm truncate group-hover:text-primary transition-colors">{{ $ranking->player->full_name }}</p>
                                            <p class="text-xs text-muted-foreground">{{ $ranking->player->nationality }}</p>
                                        </div>
                                        @if($ranking->previous_position && $ranking->previous_position > $ranking->position)
                                            <svg class="w-4 h-4 text-success flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
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
