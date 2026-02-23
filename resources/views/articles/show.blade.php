@extends('layouts.app')

@section('title', $article->title . ' - DartsArena')

@section('breadcrumbs')
    <div class="breadcrumbs">
        <a href="{{ route('home') }}">{{ __('Accueil') }}</a>
        <span class="separator">/</span>
        <a href="{{ route('articles.index') }}">{{ __('Actualités') }}</a>
        <span class="separator">/</span>
        <span>{{ Str::limit($article->title, 50) }}</span>
    </div>
@endsection

@section('content')
    <div class="container article-page">
        <!-- Article Header -->
        <article class="article-main">
            <div class="article-header-card">
                <div class="article-header-image">
                    <div class="article-header-icon">
                        @if($article->category === 'results') 🏆
                        @elseif($article->category === 'interview') 🎤
                        @elseif($article->category === 'analysis') 📊
                        @else 📰
                        @endif
                    </div>
                    <div class="article-header-category">
                        @if($article->category === 'results') {{ __('Résultats') }}
                        @elseif($article->category === 'news') {{ __('News') }}
                        @elseif($article->category === 'interview') {{ __('Interview') }}
                        @elseif($article->category === 'analysis') {{ __('Analyse') }}
                        @else {{ ucfirst($article->category) }}
                        @endif
                    </div>
                </div>

                <div class="article-header-content">
                    <div class="article-meta-info">
                        <span class="meta-date">
                            📅 {{ $article->published_at?->format('d/m/Y') }}
                        </span>
                        <span class="meta-separator">•</span>
                        <span class="meta-relative">
                            🕒 {{ $article->published_at?->diffForHumans() }}
                        </span>
                    </div>

                    <h1 class="article-main-title">
                        {{ $article->title }}
                    </h1>

                    @if($article->excerpt)
                        <p class="article-excerpt-lg">
                            {{ $article->excerpt }}
                        </p>
                    @endif
                </div>
            </div>

            <!-- Article Content -->
            <div class="article-body">
                {!! $article->content !!}
            </div>
        </article>

        <!-- Related Articles -->
        @if($relatedArticles->count() > 0)
            <div class="related-section">
                <h2 class="section-title">
                    <span class="icon">📰</span>
                    {{ __('Articles similaires') }}
                </h2>

                <div class="related-grid">
                    @foreach($relatedArticles as $related)
                        <a href="{{ route('articles.show', $related->slug) }}" class="related-card">
                            <div class="related-image">
                                <div class="related-icon">
                                    @if($related->category === 'results') 🏆
                                    @elseif($related->category === 'interview') 🎤
                                    @elseif($related->category === 'analysis') 📊
                                    @else 📰
                                    @endif
                                </div>
                            </div>
                            <div class="related-content">
                                <div class="related-badge">
                                    @if($related->category === 'results') {{ __('Résultats') }}
                                    @elseif($related->category === 'news') {{ __('News') }}
                                    @elseif($related->category === 'interview') {{ __('Interview') }}
                                    @else {{ ucfirst($related->category) }}
                                    @endif
                                </div>
                                <h3 class="related-title">
                                    {{ $related->title }}
                                </h3>
                                <p class="related-date">
                                    {{ $related->published_at?->diffForHumans() }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Back Button -->
        <div class="back-button-container">
            <a href="{{ route('articles.index') }}" class="back-button">
                <span class="back-arrow">←</span>
                {{ __('Retour aux actualités') }}
            </a>
        </div>
    </div>

    <style>
        .article-page {
            max-width: 900px;
            padding-top: 1rem;
        }

        .article-main {
            margin-bottom: 4rem;
        }

        .article-header-card {
            background: var(--da-card);
            border: 1px solid var(--da-border);
            border-radius: 1.5rem;
            overflow: hidden;
            margin-bottom: 2.5rem;
        }

        .article-header-image {
            width: 100%;
            height: 350px;
            background: linear-gradient(135deg, #1A1A1A 0%, #262626 100%);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .article-header-image::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at center, rgba(225, 29, 72, 0.25), transparent 70%);
        }

        .article-header-category {
            position: absolute;
            top: 1.5rem;
            left: 1.5rem;
            padding: 0.65rem 1.5rem;
            background: rgba(10, 10, 10, 0.95);
            backdrop-filter: blur(15px);
            border-radius: 0.75rem;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: white;
            border: 2px solid var(--da-primary);
            box-shadow: 0 4px 20px rgba(225, 29, 72, 0.4);
        }

        .article-header-icon {
            font-size: 6rem;
            filter: drop-shadow(0 8px 30px rgba(225, 29, 72, 0.5));
            position: relative;
            z-index: 1;
        }

        .article-header-content {
            padding: 2.5rem;
        }

        .article-meta-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
            color: var(--da-text-muted);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .meta-separator {
            opacity: 0.4;
        }

        .article-main-title {
            font-family: 'Bebas Neue', cursive;
            font-size: 3rem;
            letter-spacing: 0.03em;
            margin-bottom: 1.5rem;
            line-height: 1.15;
            background: linear-gradient(135deg, #FAFAFA 0%, var(--da-primary-light) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .article-excerpt-lg {
            font-size: 1.2rem;
            line-height: 1.8;
            color: var(--da-text-muted);
            font-weight: 500;
            padding-left: 1rem;
            border-left: 3px solid var(--da-primary);
        }

        .article-body {
            background: var(--da-card);
            border: 1px solid var(--da-border);
            border-radius: 1.5rem;
            padding: 3rem;
            line-height: 1.9;
            color: var(--da-text);
        }

        .article-body h2 {
            font-family: 'Bebas Neue', cursive;
            font-size: 2rem;
            letter-spacing: 0.05em;
            margin-top: 2.5rem;
            margin-bottom: 1.25rem;
            color: white;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid rgba(225, 29, 72, 0.3);
        }

        .article-body h3 {
            font-family: 'Bebas Neue', cursive;
            font-size: 1.5rem;
            letter-spacing: 0.05em;
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: var(--da-primary-light);
        }

        .article-body p {
            margin-bottom: 1.25rem;
            font-size: 1.05rem;
        }

        .article-body ul,
        .article-body ol {
            margin-left: 2rem;
            margin-bottom: 1.5rem;
        }

        .article-body li {
            margin-bottom: 0.75rem;
            font-size: 1.05rem;
        }

        .article-body strong {
            color: var(--da-accent);
            font-weight: 700;
        }

        .article-body a {
            color: var(--da-primary);
            font-weight: 600;
            text-decoration: underline;
            text-decoration-thickness: 2px;
            text-underline-offset: 2px;
            transition: color 0.2s ease;
        }

        .article-body a:hover {
            color: var(--da-primary-light);
        }

        /* Related Articles */
        .related-section {
            margin-bottom: 3rem;
        }

        .related-grid {
            display: grid;
            gap: 1.25rem;
        }

        .related-card {
            background: var(--da-card);
            border: 1px solid var(--da-border);
            border-radius: 1rem;
            padding: 1.5rem;
            display: flex;
            gap: 1.5rem;
            transition: all 0.4s ease;
            position: relative;
        }

        .related-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--da-gradient-1);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .related-card:hover {
            transform: translateY(-3px);
            border-color: var(--da-primary);
            box-shadow: 0 12px 40px rgba(225, 29, 72, 0.2);
        }

        .related-card:hover::before {
            transform: scaleX(1);
        }

        .related-image {
            flex-shrink: 0;
            width: 140px;
            height: 140px;
            background: linear-gradient(135deg, #1A1A1A, #262626);
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .related-image::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle, rgba(225, 29, 72, 0.15), transparent 70%);
        }

        .related-icon {
            font-size: 3.5rem;
            filter: drop-shadow(0 4px 15px rgba(225, 29, 72, 0.4));
            position: relative;
            z-index: 1;
        }

        .related-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .related-badge {
            display: inline-block;
            padding: 0.4rem 0.85rem;
            background: rgba(225, 29, 72, 0.15);
            color: var(--da-primary);
            border-radius: 0.5rem;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 0.75rem;
            width: fit-content;
            border: 1px solid rgba(225, 29, 72, 0.3);
        }

        .related-title {
            font-family: 'Bebas Neue', cursive;
            font-size: 1.35rem;
            letter-spacing: 0.03em;
            margin-bottom: 0.5rem;
            line-height: 1.3;
            color: white;
        }

        .related-date {
            color: var(--da-text-muted);
            font-size: 0.85rem;
            font-weight: 500;
        }

        /* Back Button */
        .back-button-container {
            text-align: center;
            margin-top: 3rem;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 2rem;
            background: var(--da-card);
            border: 1px solid var(--da-border);
            border-radius: 0.75rem;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            background: var(--da-card-hover);
            border-color: var(--da-primary);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(225, 29, 72, 0.2);
        }

        .back-arrow {
            font-size: 1.25rem;
            transition: transform 0.3s ease;
        }

        .back-button:hover .back-arrow {
            transform: translateX(-4px);
        }

        @media (max-width: 768px) {
            .article-header-image {
                height: 250px;
            }

            .article-header-icon {
                font-size: 4rem;
            }

            .article-header-content {
                padding: 2rem 1.5rem;
            }

            .article-main-title {
                font-size: 2rem;
            }

            .article-excerpt-lg {
                font-size: 1.05rem;
            }

            .article-body {
                padding: 2rem 1.5rem;
            }

            .related-card {
                flex-direction: column;
            }

            .related-image {
                width: 100%;
                height: 180px;
            }
        }
    </style>
@endsection
