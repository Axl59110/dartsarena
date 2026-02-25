@extends('layouts.app')

@section('title', __('Actualités Fléchettes') . ' - DartsArena')

@section('breadcrumbs')
    <div class="breadcrumbs py-3">
        <a href="{{ route('home') }}">{{ __('Accueil') }}</a>
        <span class="text-muted-foreground mx-2">/</span>
        <span class="text-foreground">{{ __('Actualités') }}</span>
    </div>
@endsection

@section('content')
    {{-- Hero Section --}}
    <section class="bg-gradient-to-b from-muted/30 to-background">
        <div class="container py-12 lg:py-16">
            <h1 class="font-display text-4xl lg:text-5xl font-bold text-foreground mb-4">
                {{ __('Actualités') }}
            </h1>
            <p class="text-lg text-muted-foreground max-w-3xl">
                {{ __('Toute l\'actualité des fléchettes : résultats, interviews, analyses et news du circuit PDC.') }}
            </p>
        </div>
    </section>

    <div class="container py-8 lg:py-12">
        {{-- Filters Section --}}
        @if($categories->count() > 1)
            <div class="flex items-center gap-2 mb-8 overflow-x-auto pb-2">
                <a href="{{ route('articles.index') }}"
                   class="px-4 py-2 rounded-[var(--radius-base)] text-sm font-semibold whitespace-nowrap transition-colors {{ !$category ? 'bg-primary text-primary-foreground' : 'bg-card text-foreground hover:bg-muted border border-border' }}">
                    {{ __('Tous') }}
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('articles.index', ['category' => $cat]) }}"
                       class="px-4 py-2 rounded-[var(--radius-base)] text-sm font-semibold whitespace-nowrap transition-colors {{ $category === $cat ? 'bg-primary text-primary-foreground' : 'bg-card text-foreground hover:bg-muted border border-border' }}">
                        @if($cat === 'results') {{ __('Résultats') }}
                        @elseif($cat === 'news') {{ __('News') }}
                        @elseif($cat === 'interview') {{ __('Interviews') }}
                        @elseif($cat === 'analysis') {{ __('Analyses') }}
                        @else {{ ucfirst($cat) }}
                        @endif
                    </a>
                @endforeach
            </div>
        @endif

        {{-- Articles Grid --}}
        @if($articles->count() > 0)
            {{-- Featured Article Hero (Premier article) --}}
            @if($articles->isNotEmpty() && $articles->currentPage() === 1)
                @php $featuredArticle = $articles->first(); @endphp
                <article class="grid lg:grid-cols-3 gap-8 mb-12 p-6 lg:p-8 bg-card border border-card-border rounded-[var(--radius-base)] hover:border-primary transition-colors">
                    {{-- Image 2/3 --}}
                    <a href="{{ route('articles.show', $featuredArticle->slug) }}" class="lg:col-span-2 group">
                        <div class="aspect-video rounded-[var(--radius-base)] overflow-hidden relative bg-gradient-to-br from-primary/20 via-muted to-accent/20">
                            {{-- Fallback Image avec icône catégorie --}}
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="text-8xl opacity-20">
                                    @if($featuredArticle->category === 'results') 🏆
                                    @elseif($featuredArticle->category === 'interview') 🎤
                                    @elseif($featuredArticle->category === 'analysis') 📊
                                    @else 📰
                                    @endif
                                </div>
                            </div>

                            {{-- Badge catégorie avec backdrop-blur --}}
                            <div class="absolute top-4 left-4 backdrop-blur-md bg-background/80 rounded-[var(--radius-base)] px-3 py-1.5 border border-card-border">
                                <x-badge-category :category="$featuredArticle->category">
                                    @if($featuredArticle->category === 'results') {{ __('Résultats') }}
                                    @elseif($featuredArticle->category === 'news') {{ __('News') }}
                                    @elseif($featuredArticle->category === 'interview') {{ __('Interview') }}
                                    @else {{ __('Analyse') }}
                                    @endif
                                </x-badge-category>
                            </div>

                            {{-- Hover effect --}}
                            <div class="absolute inset-0 bg-primary/0 group-hover:bg-primary/10 transition-colors"></div>
                        </div>
                    </a>

                    {{-- Contenu 1/3 --}}
                    <div class="flex flex-col justify-center space-y-4">
                        <div class="flex items-center gap-3 text-sm text-muted-foreground">
                            <time>{{ $featuredArticle->published_at?->diffForHumans() }}</time>
                        </div>

                        <a href="{{ route('articles.show', $featuredArticle->slug) }}" class="group">
                            <h2 class="font-display text-3xl lg:text-4xl font-bold text-foreground group-hover:text-primary transition-colors leading-[1.1] mb-4">
                                {{ $featuredArticle->title }}
                            </h2>
                        </a>

                        <p class="text-base text-muted-foreground leading-relaxed">
                            {{ $featuredArticle->excerpt }}
                        </p>

                        <div class="pt-2">
                            <x-link-arrow href="{{ route('articles.show', $featuredArticle->slug) }}">
                                {{ __('Lire l\'article') }}
                            </x-link-arrow>
                        </div>
                    </div>
                </article>
            @endif

            {{-- Regular Articles Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-12">
                @foreach($articles as $index => $article)
                    {{-- Skip first article on first page (already featured) --}}
                    @if($articles->currentPage() === 1 && $index === 0)
                        @continue
                    @endif

                    <a href="{{ route('articles.show', $article->slug) }}"
                       class="group bg-card border border-card-border rounded-[var(--radius-base)] overflow-hidden hover:border-primary hover:shadow-lg hover:-translate-y-1 transition-all duration-200">

                        {{-- Image with Category Badge --}}
                        <div class="aspect-video bg-gradient-to-br from-primary/10 via-muted to-accent/10 flex items-center justify-center overflow-hidden relative group-hover:scale-105 transition-transform duration-300">
                            {{-- Fallback icon --}}
                            <div class="text-5xl opacity-30">
                                @if($article->category === 'results') 🏆
                                @elseif($article->category === 'interview') 🎤
                                @elseif($article->category === 'analysis') 📊
                                @else 📰
                                @endif
                            </div>

                            {{-- Badge with backdrop-blur --}}
                            <div class="absolute top-3 left-3 backdrop-blur-sm bg-background/70 rounded-[var(--radius-base)] px-2.5 py-1 border border-card-border/50">
                                <x-badge-category :category="$article->category" size="sm">
                                    @if($article->category === 'results') {{ __('Résultats') }}
                                    @elseif($article->category === 'news') {{ __('News') }}
                                    @elseif($article->category === 'interview') {{ __('Interview') }}
                                    @else {{ __('Analyse') }}
                                    @endif
                                </x-badge-category>
                            </div>
                        </div>

                        {{-- Content --}}
                        <div class="p-5 space-y-3">
                            <p class="text-sm text-muted-foreground">
                                {{ $article->published_at?->diffForHumans() }}
                            </p>

                            <h3 class="font-display text-xl font-bold text-foreground group-hover:text-primary transition-colors line-clamp-2 leading-[1.2]">
                                {{ $article->title }}
                            </h3>

                            <p class="text-sm text-muted-foreground line-clamp-3 leading-relaxed">
                                {{ $article->excerpt }}
                            </p>

                            <x-link-arrow href="{{ route('articles.show', $article->slug) }}" size="sm" class="pt-2">
                                {{ __('Lire l\'article') }}
                            </x-link-arrow>
                        </div>
                    </a>
                @endforeach
            </div>

            {{-- Pagination Améliorée avec numéros cliquables --}}
            @if($articles->hasPages())
                <nav class="flex justify-center items-center gap-2">
                    {{-- Previous --}}
                    @if($articles->onFirstPage())
                        <span class="px-3 py-2 rounded-[var(--radius-base)] text-sm font-semibold bg-card text-muted-foreground border border-border opacity-50 cursor-not-allowed">
                            ←
                        </span>
                    @else
                        <a href="{{ $articles->previousPageUrl() }}" class="px-3 py-2 rounded-[var(--radius-base)] text-sm font-semibold bg-card text-foreground border border-border hover:bg-primary hover:text-primary-foreground hover:border-primary transition-all">
                            ←
                        </a>
                    @endif

                    {{-- Page Numbers --}}
                    @php
                        $currentPage = $articles->currentPage();
                        $lastPage = $articles->lastPage();
                        $start = max(1, $currentPage - 2);
                        $end = min($lastPage, $currentPage + 2);
                    @endphp

                    {{-- First page --}}
                    @if($start > 1)
                        <a href="{{ $articles->url(1) }}" class="px-3 py-2 rounded-[var(--radius-base)] text-sm font-semibold bg-card text-foreground border border-border hover:bg-primary hover:text-primary-foreground hover:border-primary transition-all">
                            1
                        </a>
                        @if($start > 2)
                            <span class="px-2 text-muted-foreground">...</span>
                        @endif
                    @endif

                    {{-- Page range --}}
                    @for($page = $start; $page <= $end; $page++)
                        @if($page === $currentPage)
                            <span class="px-3 py-2 rounded-[var(--radius-base)] text-sm font-bold bg-primary text-primary-foreground border border-primary">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $articles->url($page) }}" class="px-3 py-2 rounded-[var(--radius-base)] text-sm font-semibold bg-card text-foreground border border-border hover:bg-primary hover:text-primary-foreground hover:border-primary transition-all">
                                {{ $page }}
                            </a>
                        @endif
                    @endfor

                    {{-- Last page --}}
                    @if($end < $lastPage)
                        @if($end < $lastPage - 1)
                            <span class="px-2 text-muted-foreground">...</span>
                        @endif
                        <a href="{{ $articles->url($lastPage) }}" class="px-3 py-2 rounded-[var(--radius-base)] text-sm font-semibold bg-card text-foreground border border-border hover:bg-primary hover:text-primary-foreground hover:border-primary transition-all">
                            {{ $lastPage }}
                        </a>
                    @endif

                    {{-- Next --}}
                    @if($articles->hasMorePages())
                        <a href="{{ $articles->nextPageUrl() }}" class="px-3 py-2 rounded-[var(--radius-base)] text-sm font-semibold bg-card text-foreground border border-border hover:bg-primary hover:text-primary-foreground hover:border-primary transition-all">
                            →
                        </a>
                    @else
                        <span class="px-3 py-2 rounded-[var(--radius-base)] text-sm font-semibold bg-card text-muted-foreground border border-border opacity-50 cursor-not-allowed">
                            →
                        </span>
                    @endif
                </nav>
            @endif
        @else
            <x-card class="p-12 text-center">
                <p class="text-muted-foreground">
                    {{ __('Aucun article disponible pour le moment.') }}
                </p>
            </x-card>
        @endif
    </div>
@endsection
