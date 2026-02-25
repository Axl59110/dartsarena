@extends('layouts.app')

@section('title', __('Guides & Tutorials') . ' - DartsArena')

@section('content')
<div class="bg-muted py-8 lg:py-12">
    <div class="container">
        {{-- Page Header --}}
        <div class="mb-8">
            <h1 class="font-display text-3xl lg:text-4xl font-bold text-foreground mb-3">
                {{ __('Guides & Tutorials') }}
            </h1>
            <p class="text-muted-foreground text-lg">
                {{ __('Learn the rules, improve your technique, and master the game of darts') }}
            </p>
        </div>

        {{-- MÊME PATTERN que Homepage: Section avec filtres + grille --}}
        <section class="bg-card rounded-[var(--radius-base)] border border-card-border p-6 shadow-sm">

            {{-- Category Filter (adapté pour guides) --}}
            <div class="mb-6" x-data="{
                activeCategory: 'all',
                isLoading: false,
                visibleCount: 0,
                async changeCategory(cat) {
                    if (this.isLoading) return;
                    this.isLoading = true;
                    this.activeCategory = cat;
                    await new Promise(resolve => setTimeout(resolve, 150));
                    this.isLoading = false;
                }
            }" x-init="$watch('activeCategory', () => { setTimeout(() => { visibleCount = $el.querySelectorAll('[x-show]:not([style*=\'display: none\'])').length }, 200) })">

                {{-- Filter Tabs par Catégorie --}}
                <div class="flex flex-wrap gap-2 mb-4" role="tablist" aria-label="{{ __('Filter by category') }}">
                    <button @click="changeCategory('all')"
                            :disabled="isLoading"
                            :class="activeCategory === 'all' ? 'bg-primary text-primary-foreground' : 'bg-muted hover:bg-muted/80'"
                            class="px-4 py-2 rounded-[var(--radius-base)] text-sm font-semibold transition-colors disabled:opacity-50"
                            role="tab"
                            :aria-selected="activeCategory === 'all'">
                        {{ __('All') }}
                    </button>
                    <button @click="changeCategory('rules')"
                            :disabled="isLoading"
                            :class="activeCategory === 'rules' ? 'bg-primary text-primary-foreground' : 'bg-muted hover:bg-muted/80'"
                            class="px-4 py-2 rounded-[var(--radius-base)] text-sm font-semibold transition-colors disabled:opacity-50"
                            role="tab"
                            :aria-selected="activeCategory === 'rules'">
                        📜 {{ __('Rules') }}
                    </button>
                    <button @click="changeCategory('techniques')"
                            :disabled="isLoading"
                            :class="activeCategory === 'techniques' ? 'bg-primary text-primary-foreground' : 'bg-muted hover:bg-muted/80'"
                            class="px-4 py-2 rounded-[var(--radius-base)] text-sm font-semibold transition-colors disabled:opacity-50"
                            role="tab"
                            :aria-selected="activeCategory === 'techniques'">
                        🎯 {{ __('Techniques') }}
                    </button>
                    <button @click="changeCategory('stats')"
                            :disabled="isLoading"
                            :class="activeCategory === 'stats' ? 'bg-primary text-primary-foreground' : 'bg-muted hover:bg-muted/80'"
                            class="px-4 py-2 rounded-[var(--radius-base)] text-sm font-semibold transition-colors disabled:opacity-50"
                            role="tab"
                            :aria-selected="activeCategory === 'stats'">
                        📊 {{ __('Statistics') }}
                    </button>
                    <button @click="changeCategory('competitions')"
                            :disabled="isLoading"
                            :class="activeCategory === 'competitions' ? 'bg-primary text-primary-foreground' : 'bg-muted hover:bg-muted/80'"
                            class="px-4 py-2 rounded-[var(--radius-base)] text-sm font-semibold transition-colors disabled:opacity-50"
                            role="tab"
                            :aria-selected="activeCategory === 'competitions'">
                        🏆 {{ __('Competitions') }}
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
                        <span x-text="visibleCount"></span> <span x-text="visibleCount > 1 ? '{{ __('guides') }}' : 'guide'"></span>
                    </div>
                </div>

                {{-- Guides Grid - 3 colonnes desktop (MÊME CODE que articles) --}}
                @if(collect($guidesByCategory)->flatten()->count() > 0)
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($guidesByCategory as $category => $guides)
                            @foreach($guides as $guide)
                                <a href="{{ route('guides.show', $guide->slug) }}"
                                   class="group bg-card border border-card-border rounded-[var(--radius-base)] overflow-hidden hover:border-primary hover:shadow-md transition-all"
                                   x-show="activeCategory === 'all' || '{{ $category }}' === activeCategory"
                                   x-transition:enter="transition ease-out duration-200"
                                   x-transition:enter-start="opacity-0"
                                   x-transition:enter-end="opacity-100">

                                    {{-- Image/Icon --}}
                                    <div class="aspect-[16/9] bg-gradient-to-br from-primary/20 via-accent/10 to-muted relative overflow-hidden group-hover:scale-[1.02] transition-transform duration-300">
                                        @if(isset($guide->featured_image) && $guide->featured_image)
                                            <img src="{{ $guide->featured_image }}"
                                                 alt="{{ $guide->title }}"
                                                 class="w-full h-full object-cover"
                                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                            {{-- Fallback icon --}}
                                            <div class="w-full h-full flex items-center justify-center" style="display: none;">
                                                <span class="text-6xl opacity-30">
                                                    @if($category === 'rules') 📜
                                                    @elseif($category === 'techniques') 🎯
                                                    @elseif($category === 'stats') 📊
                                                    @elseif($category === 'competitions') 🏆
                                                    @else 📚
                                                    @endif
                                                </span>
                                            </div>
                                        @else
                                            {{-- Placeholder par défaut --}}
                                            <div class="w-full h-full flex items-center justify-center">
                                                <span class="text-6xl opacity-30">
                                                    @if($category === 'rules') 📜
                                                    @elseif($category === 'techniques') 🎯
                                                    @elseif($category === 'stats') 📊
                                                    @elseif($category === 'competitions') 🏆
                                                    @else 📚
                                                    @endif
                                                </span>
                                            </div>
                                        @endif

                                        {{-- Category Badge --}}
                                        <div class="absolute top-2 left-2 z-10">
                                            <span class="inline-flex px-2 py-1 text-xs font-bold bg-white/90 backdrop-blur-sm rounded-[var(--radius-base)] text-primary">
                                                @if($category === 'rules') {{ __('Rules') }}
                                                @elseif($category === 'techniques') {{ __('Techniques') }}
                                                @elseif($category === 'stats') {{ __('Statistics') }}
                                                @elseif($category === 'competitions') {{ __('Competitions') }}
                                                @else {{ ucfirst($category) }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>

                                    {{-- Content --}}
                                    <div class="p-4 space-y-2">
                                        <div class="flex items-center gap-2 text-xs text-muted-foreground">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span>{{ $guide->reading_time ?? '5' }} min read</span>
                                        </div>

                                        <h3 class="font-display text-base font-bold leading-snug group-hover:text-primary transition-colors line-clamp-2">
                                            {{ $guide->title }}
                                        </h3>

                                        <p class="text-sm text-muted-foreground leading-relaxed line-clamp-2">
                                            {{ Str::limit($guide->excerpt, 80) }}
                                        </p>
                                    </div>
                                </a>
                            @endforeach
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12 text-muted-foreground">
                        {{ __('No guides available') }}
                    </div>
                @endif
            </div>
        </section>
    </div>
</div>
@endsection
