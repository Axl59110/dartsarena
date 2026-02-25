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
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-12">
                @foreach($articles as $article)
                    <a href="{{ route('articles.show', $article->slug) }}"
                       class="group bg-card border border-card-border rounded-[var(--radius-base)] overflow-hidden hover:border-primary hover:shadow-lg hover:-translate-y-1 transition-all duration-200">

                        {{-- Image Placeholder with Category Badge --}}
                        <div class="aspect-video bg-gradient-to-br from-muted to-border flex items-center justify-center overflow-hidden relative">
                            <span class="text-5xl">
                                @if($article->category === 'results') 🏆
                                @elseif($article->category === 'interview') 🎤
                                @elseif($article->category === 'analysis') 📊
                                @else 📰
                                @endif
                            </span>
                            <div class="absolute top-3 left-3">
                                <x-badge-category :category="$article->category" position="overlay">
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
                            <p class="text-xs text-muted-foreground">
                                {{ $article->published_at?->diffForHumans() }}
                            </p>

                            <h3 class="font-display text-xl font-bold text-foreground group-hover:text-primary transition-colors line-clamp-2 leading-tight">
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

            {{-- Pagination --}}
            @if($articles->hasPages())
                <div class="flex justify-center items-center gap-4">
                    @if($articles->onFirstPage())
                        <span class="px-4 py-2 rounded-[var(--radius-base)] text-sm font-semibold bg-card text-muted-foreground border border-border opacity-50 cursor-not-allowed">
                            ← {{ __('Précédent') }}
                        </span>
                    @else
                        <a href="{{ $articles->previousPageUrl() }}" class="px-4 py-2 rounded-[var(--radius-base)] text-sm font-semibold bg-card text-foreground border border-border hover:bg-muted hover:border-primary transition-colors">
                            ← {{ __('Précédent') }}
                        </a>
                    @endif

                    <span class="px-4 py-2 rounded-[var(--radius-base)] text-sm font-bold bg-primary text-primary-foreground">
                        {{ $articles->currentPage() }} / {{ $articles->lastPage() }}
                    </span>

                    @if($articles->hasMorePages())
                        <a href="{{ $articles->nextPageUrl() }}" class="px-4 py-2 rounded-[var(--radius-base)] text-sm font-semibold bg-card text-foreground border border-border hover:bg-muted hover:border-primary transition-colors">
                            {{ __('Suivant') }} →
                        </a>
                    @else
                        <span class="px-4 py-2 rounded-[var(--radius-base)] text-sm font-semibold bg-card text-muted-foreground border border-border opacity-50 cursor-not-allowed">
                            {{ __('Suivant') }} →
                        </span>
                    @endif
                </div>
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
