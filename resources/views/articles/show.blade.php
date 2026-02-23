@extends('layouts.app')

@section('title', $article->title . ' - DartsArena')

@section('breadcrumbs')
    <div class="breadcrumbs py-3">
        <a href="{{ route('home') }}">{{ __('Accueil') }}</a>
        <span class="text-muted-foreground mx-2">/</span>
        <a href="{{ route('articles.index') }}">{{ __('Actualités') }}</a>
        <span class="text-muted-foreground mx-2">/</span>
        <span class="text-foreground">{{ Str::limit($article->title, 50) }}</span>
    </div>
@endsection

@section('content')
    <div class="container py-8 lg:py-12">
        <div class="max-w-4xl mx-auto">
            <!-- Article Header -->
            <article class="mb-12">
                <div class="bg-card rounded-xl border border-card-border overflow-hidden mb-8">
                    <!-- Image -->
                    <div class="aspect-video bg-gradient-to-br from-muted to-border flex items-center justify-center overflow-hidden relative">
                        <span class="text-9xl">
                            @if($article->category === 'results') 🏆
                            @elseif($article->category === 'interview') 🎤
                            @elseif($article->category === 'analysis') 📊
                            @else 📰
                            @endif
                        </span>
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex items-center px-3 py-1.5 rounded-md text-xs font-bold uppercase tracking-wider bg-card/90 backdrop-blur-sm text-foreground border border-border">
                                @if($article->category === 'results') {{ __('Résultats') }}
                                @elseif($article->category === 'news') {{ __('News') }}
                                @elseif($article->category === 'interview') {{ __('Interview') }}
                                @elseif($article->category === 'analysis') {{ __('Analyse') }}
                                @else {{ ucfirst($article->category) }}
                                @endif
                            </span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6 lg:p-8">
                        <div class="flex items-center gap-3 text-sm text-muted-foreground mb-4">
                            <span>📅 {{ $article->published_at?->format('d/m/Y') }}</span>
                            <span>•</span>
                            <span>🕒 {{ $article->published_at?->diffForHumans() }}</span>
                        </div>

                        <h1 class="font-display text-4xl lg:text-5xl font-bold text-foreground mb-6 leading-tight">
                            {{ $article->title }}
                        </h1>

                        @if($article->excerpt)
                            <p class="text-lg text-muted-foreground leading-relaxed pl-4 border-l-4 border-primary mb-6">
                                {{ $article->excerpt }}
                            </p>
                        @endif
                    </div>
                </div>

                <!-- Article Body -->
                <div class="bg-card rounded-xl border border-card-border p-6 lg:p-8 prose prose-invert prose-lg max-w-none">
                    <div class="article-content">
                        {!! $article->content !!}
                    </div>
                </div>
            </article>

            <!-- Related Articles -->
            @if($relatedArticles->count() > 0)
                <div class="mb-12">
                    <h2 class="font-display text-3xl font-bold text-foreground mb-6 flex items-center gap-3">
                        <span>📰</span>
                        {{ __('Articles similaires') }}
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($relatedArticles as $related)
                            <a href="{{ route('articles.show', $related->slug) }}"
                               class="bg-card rounded-xl border border-card-border shadow-sm hover:shadow-lg hover:border-border-strong hover:-translate-y-1 transition-all duration-200 group overflow-hidden flex gap-4 p-4">
                                <!-- Image -->
                                <div class="w-24 h-24 flex-shrink-0 bg-gradient-to-br from-muted to-border rounded-lg flex items-center justify-center overflow-hidden relative">
                                    <span class="text-3xl">
                                        @if($related->category === 'results') 🏆
                                        @elseif($related->category === 'interview') 🎤
                                        @elseif($related->category === 'analysis') 📊
                                        @else 📰
                                        @endif
                                    </span>
                                </div>

                                <!-- Content -->
                                <div class="flex-1 min-w-0">
                                    <div class="mb-2">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider bg-primary/10 text-primary border border-primary/30">
                                            @if($related->category === 'results') {{ __('Résultats') }}
                                            @elseif($related->category === 'news') {{ __('News') }}
                                            @elseif($related->category === 'interview') {{ __('Interview') }}
                                            @else {{ ucfirst($related->category) }}
                                            @endif
                                        </span>
                                    </div>
                                    <h3 class="font-display text-lg font-bold text-foreground group-hover:text-primary transition-colors line-clamp-2 leading-tight mb-1">
                                        {{ $related->title }}
                                    </h3>
                                    <p class="text-xs text-muted-foreground">
                                        {{ $related->published_at?->diffForHumans() }}
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Back Button -->
            <div class="text-center">
                <a href="{{ route('articles.index') }}" class="inline-flex items-center gap-3 px-6 py-3 bg-card text-foreground border border-border rounded-lg font-semibold hover:bg-muted hover:border-primary transition-all hover:-translate-y-0.5 shadow-sm">
                    <span class="text-xl">←</span>
                    {{ __('Retour aux actualités') }}
                </a>
            </div>
        </div>
    </div>

    <style>
        /* Article Content Styling */
        .article-content h2 {
            font-family: 'Bebas Neue', cursive;
            font-size: 2rem;
            letter-spacing: 0.05em;
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: white;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid rgba(225, 29, 72, 0.3);
        }

        .article-content h3 {
            font-family: 'Bebas Neue', cursive;
            font-size: 1.5rem;
            letter-spacing: 0.05em;
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
            color: #EF4444;
        }

        .article-content p {
            margin-bottom: 1rem;
            line-height: 1.8;
            color: #D1D5DB;
        }

        .article-content ul,
        .article-content ol {
            margin-left: 2rem;
            margin-bottom: 1.5rem;
        }

        .article-content li {
            margin-bottom: 0.5rem;
            color: #D1D5DB;
        }

        .article-content strong {
            color: #FBBF24;
            font-weight: 700;
        }

        .article-content a {
            color: #EF4444;
            font-weight: 600;
            text-decoration: underline;
            text-decoration-thickness: 2px;
            text-underline-offset: 2px;
            transition: color 0.2s ease;
        }

        .article-content a:hover {
            color: #F87171;
        }
    </style>
@endsection
