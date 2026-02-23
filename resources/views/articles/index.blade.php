@extends('layouts.app')

@section('title', __('Actualités Fléchettes') . ' - DartsArena')

@section('content')
    <section class="hero">
        <div class="container hero-content">
            <h1 class="animate-in">{{ __('Actualités') }}</h1>
            <p class="animate-in" style="animation-delay: 0.1s;">{{ __('Toute l\'actualité des fléchettes : résultats, interviews, analyses et news du circuit PDC.') }}</p>
        </div>
    </section>

    <div class="container">
        <!-- Filters -->
        @if($categories->count() > 1)
            <div class="news-filters">
                <a href="{{ route('articles.index') }}"
                   class="filter-btn {{ !$category ? 'active' : '' }}">
                    {{ __('Tous') }}
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('articles.index', ['category' => $cat]) }}"
                       class="filter-btn {{ $category === $cat ? 'active' : '' }}">
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

        <!-- Articles Grid -->
        @if($articles->count() > 0)
            <div class="articles-grid">
                @foreach($articles as $index => $article)
                    <a href="{{ route('articles.show', $article->slug) }}"
                       class="article-card animate-in"
                       style="animation-delay: {{ $index * 0.05 }}s;">
                        <div class="article-image">
                            <div class="article-category-badge">
                                @if($article->category === 'results') {{ __('Résultats') }}
                                @elseif($article->category === 'news') {{ __('News') }}
                                @elseif($article->category === 'interview') {{ __('Interview') }}
                                @elseif($article->category === 'analysis') {{ __('Analyse') }}
                                @else {{ ucfirst($article->category) }}
                                @endif
                            </div>
                            <div class="article-icon">
                                @if($article->category === 'results') 🏆
                                @elseif($article->category === 'interview') 🎤
                                @elseif($article->category === 'analysis') 📊
                                @else 📰
                                @endif
                            </div>
                        </div>

                        <div class="article-content">
                            <div class="article-meta">
                                <span class="article-date">
                                    {{ $article->published_at?->diffForHumans() }}
                                </span>
                            </div>

                            <h3 class="article-title">
                                {{ $article->title }}
                            </h3>

                            <p class="article-excerpt">
                                {{ $article->excerpt }}
                            </p>

                            <div class="article-read-more">
                                {{ __('Lire l\'article') }}
                                <span class="arrow">→</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($articles->hasPages())
                <div class="pagination">
                    @if($articles->onFirstPage())
                        <span class="pagination-btn disabled">
                            ← {{ __('Précédent') }}
                        </span>
                    @else
                        <a href="{{ $articles->previousPageUrl() }}" class="pagination-btn">
                            ← {{ __('Précédent') }}
                        </a>
                    @endif

                    <span class="pagination-current">
                        {{ $articles->currentPage() }} / {{ $articles->lastPage() }}
                    </span>

                    @if($articles->hasMorePages())
                        <a href="{{ $articles->nextPageUrl() }}" class="pagination-btn">
                            {{ __('Suivant') }} →
                        </a>
                    @else
                        <span class="pagination-btn disabled">
                            {{ __('Suivant') }} →
                        </span>
                    @endif
                </div>
            @endif
        @else
            <div class="card" style="text-align: center;">
                <p style="color: var(--da-text-muted);">
                    {{ __('Aucun article disponible pour le moment.') }}
                </p>
            </div>
        @endif
    </div>

    <style>
        .news-filters {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
            margin-bottom: 3rem;
            padding: 1rem;
            background: var(--da-card);
            border-radius: 1rem;
            border: 1px solid var(--da-border);
        }

        .filter-btn {
            padding: 0.65rem 1.5rem;
            border-radius: 0.5rem;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .filter-btn:not(.active) {
            background: transparent;
            color: var(--da-text-muted);
        }

        .filter-btn:not(.active):hover {
            background: rgba(225, 29, 72, 0.1);
            color: white;
            border-color: var(--da-primary);
        }

        .filter-btn.active {
            background: var(--da-gradient-1);
            color: white;
            box-shadow: 0 4px 12px rgba(225, 29, 72, 0.4);
        }

        .articles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .article-card {
            background: var(--da-card);
            border: 1px solid var(--da-border);
            border-radius: 1rem;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .article-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--da-gradient-1);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .article-card:hover {
            transform: translateY(-6px);
            border-color: var(--da-primary);
            box-shadow: 0 20px 60px rgba(225, 29, 72, 0.25);
        }

        .article-card:hover::before {
            transform: scaleX(1);
        }

        .article-image {
            width: 100%;
            height: 240px;
            background: linear-gradient(135deg, #1A1A1A 0%, #262626 100%);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .article-image::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 30% 50%, rgba(225, 29, 72, 0.2), transparent 70%);
        }

        .article-category-badge {
            position: absolute;
            top: 1rem;
            left: 1rem;
            padding: 0.5rem 1rem;
            background: rgba(10, 10, 10, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 0.5rem;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--da-primary);
            border: 1px solid rgba(225, 29, 72, 0.3);
        }

        .article-icon {
            font-size: 4rem;
            filter: drop-shadow(0 4px 20px rgba(225, 29, 72, 0.4));
            position: relative;
            z-index: 1;
            transition: transform 0.4s ease;
        }

        .article-card:hover .article-icon {
            transform: scale(1.15) rotate(-5deg);
        }

        .article-content {
            padding: 1.75rem;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .article-meta {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .article-date {
            color: var(--da-text-muted);
            font-size: 0.85rem;
            font-weight: 500;
        }

        .article-title {
            font-family: 'Bebas Neue', cursive;
            font-size: 1.5rem;
            letter-spacing: 0.03em;
            margin-bottom: 1rem;
            line-height: 1.3;
            color: white;
        }

        .article-excerpt {
            color: var(--da-text-muted);
            font-size: 0.95rem;
            line-height: 1.7;
            margin-bottom: 1.5rem;
            flex: 1;
        }

        .article-read-more {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--da-primary);
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .article-read-more .arrow {
            transition: transform 0.4s ease;
            font-size: 1.25rem;
        }

        .article-card:hover .article-read-more .arrow {
            transform: translateX(6px);
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
            margin-top: 3rem;
        }

        .pagination-btn {
            padding: 0.85rem 1.75rem;
            background: var(--da-card);
            border: 1px solid var(--da-border);
            border-radius: 0.75rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .pagination-btn:not(.disabled):hover {
            background: var(--da-card-hover);
            border-color: var(--da-primary);
            transform: translateY(-2px);
        }

        .pagination-btn.disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        .pagination-current {
            padding: 0.85rem 1.5rem;
            background: var(--da-gradient-1);
            border-radius: 0.75rem;
            font-weight: 700;
            font-family: 'Bebas Neue', cursive;
            font-size: 1.1rem;
            letter-spacing: 0.05em;
        }

        @media (max-width: 768px) {
            .articles-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .news-filters {
                gap: 0.5rem;
                padding: 0.75rem;
            }

            .filter-btn {
                padding: 0.5rem 1rem;
                font-size: 0.8rem;
            }
        }
    </style>
@endsection
