@extends('layouts.app')

@section('title', __('News & Articles') . ' - DartsArena')

@section('content')
<div class="bg-muted py-8 lg:py-12">
    <div class="container">
        {{-- Page Header --}}
        <div class="mb-8">
            <h1 class="font-display text-3xl lg:text-4xl font-bold text-foreground mb-3">
                {{ __('News & Articles') }}
            </h1>
            <p class="text-muted-foreground text-lg">
                {{ __('Latest news, results, and analysis from the world of professional darts') }}
            </p>
        </div>

        {{-- EXACTEMENT comme Homepage: Section avec filtres + grille --}}
        <section class="bg-card rounded-[var(--radius-base)] border border-card-border p-6 shadow-sm">

            {{-- Federation Filter (copié identique de homepage) --}}
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

                {{-- Filter Tabs --}}
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

                {{-- Loading State --}}
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

                {{-- Articles Grid - 3 colonnes desktop (CODE IDENTIQUE homepage) --}}
                @if($articles->count() > 0)
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($articles as $article)
                            <a href="{{ route('articles.show', $article->slug) }}"
                               class="group bg-card border border-card-border rounded-[var(--radius-base)] overflow-hidden hover:border-primary hover:shadow-md transition-all"
                               x-show="activeFederation === 'all' || '{{ $article->federation?->slug ?? 'pdc' }}' === activeFederation"
                               x-transition:enter="transition ease-out duration-200"
                               x-transition:enter-start="opacity-0"
                               x-transition:enter-end="opacity-100">

                                {{-- Image --}}
                                <div class="aspect-[16/9] bg-gradient-to-br from-primary/30 via-accent/20 to-darker/40 relative overflow-hidden group-hover:scale-[1.02] transition-transform duration-300">
                                    @if($article->featured_image)
                                        <img src="{{ $article->featured_image }}"
                                             alt="{{ $article->title }}"
                                             class="w-full h-full object-cover"
                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        {{-- Placeholder fallback (hidden by default) --}}
                                        <div class="w-full h-full flex items-center justify-center" style="display: none;">
                                            <svg class="w-16 h-16 text-white/30" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/>
                                            </svg>
                                        </div>
                                    @else
                                        {{-- Placeholder par défaut --}}
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="w-16 h-16 text-white/30" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/>
                                            </svg>
                                        </div>
                                    @endif

                                    {{-- Category Badge --}}
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

                                {{-- Content --}}
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

        {{-- Pagination Simple --}}
        @if($articles->hasPages())
            <nav class="flex justify-center items-center gap-2 mt-8" aria-label="{{ __('Pagination') }}">
                {{-- Previous --}}
                @if ($articles->onFirstPage())
                    <span class="px-3 py-2 rounded-[var(--radius-base)] border border-border text-muted-foreground cursor-not-allowed opacity-50">
                        ← {{ __('Prev') }}
                    </span>
                @else
                    <a href="{{ $articles->previousPageUrl() }}"
                       class="px-3 py-2 rounded-[var(--radius-base)] border border-border hover:bg-muted transition-colors">
                        ← {{ __('Prev') }}
                    </a>
                @endif

                {{-- Page Numbers --}}
                @for($i = 1; $i <= $articles->lastPage(); $i++)
                    @if($i === $articles->currentPage())
                        <span class="px-3 py-2 rounded-[var(--radius-base)] bg-primary text-primary-foreground font-semibold">
                            {{ $i }}
                        </span>
                    @else
                        <a href="{{ $articles->url($i) }}"
                           class="px-3 py-2 rounded-[var(--radius-base)] border border-border hover:bg-muted transition-colors">
                            {{ $i }}
                        </a>
                    @endif
                @endfor

                {{-- Next --}}
                @if ($articles->hasMorePages())
                    <a href="{{ $articles->nextPageUrl() }}"
                       class="px-3 py-2 rounded-[var(--radius-base)] border border-border hover:bg-muted transition-colors">
                        {{ __('Next') }} →
                    </a>
                @else
                    <span class="px-3 py-2 rounded-[var(--radius-base)] border border-border text-muted-foreground cursor-not-allowed opacity-50">
                        {{ __('Next') }} →
                    </span>
                @endif
            </nav>
        @endif
    </div>
</div>
@endsection
