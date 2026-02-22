@extends('layouts.app')

@section('title', $article->title . ' - DartsArena')

@section('breadcrumbs')
    <div class="breadcrumbs">
        <a href="{{ route('home') }}">{{ __('Accueil') }}</a>
        <span class="separator">/</span>
        <a href="{{ route('articles.index') }}">{{ __('Actualités') }}</a>
        <span class="separator">/</span>
        <span>{{ $article->title }}</span>
    </div>
@endsection

@section('content')
    <div class="container" style="max-width: 900px;">
        <!-- Article Header -->
        <article class="card" style="margin-bottom: 2rem;">
            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1rem;">
                <span class="badge badge-live">
                    @if($article->category === 'results') {{ __('Résultats') }}
                    @elseif($article->category === 'news') {{ __('News') }}
                    @elseif($article->category === 'interview') {{ __('Interview') }}
                    @elseif($article->category === 'analysis') {{ __('Analyse') }}
                    @else {{ ucfirst($article->category) }}
                    @endif
                </span>
                <span style="color: var(--da-text-muted); font-size: 0.875rem;">
                    📅 {{ $article->published_at?->format('d/m/Y') }} • 🕒 {{ $article->published_at?->diffForHumans() }}
                </span>
            </div>

            <h1 style="font-size: 2rem; font-weight: 800; margin-bottom: 1rem; line-height: 1.2;">
                {{ $article->title }}
            </h1>

            @if($article->excerpt)
                <p style="font-size: 1.125rem; color: var(--da-text-muted); margin-bottom: 2rem; line-height: 1.6; font-weight: 500;">
                    {{ $article->excerpt }}
                </p>
            @endif

            @if($article->featured_image)
                <div style="width: 100%; height: 400px; background: linear-gradient(135deg, var(--da-primary) 0%, var(--da-primary-dark) 100%); border-radius: 0.75rem; margin-bottom: 2rem; display: flex; align-items: center; justify-content: center; font-size: 6rem;">
                    @if($article->category === 'results') 🏆
                    @elseif($article->category === 'interview') 🎤
                    @elseif($article->category === 'analysis') 📊
                    @else 📰
                    @endif
                </div>
            @endif

            <div class="article-content" style="line-height: 1.8; color: var(--da-text);">
                {!! $article->content !!}
            </div>
        </article>

        <!-- Related Articles -->
        @if($relatedArticles->count() > 0)
            <h2 class="section-title">
                <span class="icon">📰</span>
                {{ __('Articles similaires') }}
            </h2>

            <div style="display: grid; gap: 1rem; margin-bottom: 2rem;">
                @foreach($relatedArticles as $related)
                    <a href="{{ route('articles.show', $related->slug) }}" class="card" style="display: flex; gap: 1.5rem;">
                        <div style="flex-shrink: 0; width: 120px; height: 120px; background: linear-gradient(135deg, var(--da-primary) 0%, var(--da-primary-dark) 100%); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; font-size: 2.5rem;">
                            @if($related->category === 'results') 🏆
                            @elseif($related->category === 'interview') 🎤
                            @elseif($related->category === 'analysis') 📊
                            @else 📰
                            @endif
                        </div>
                        <div style="flex: 1;">
                            <div style="margin-bottom: 0.5rem;">
                                <span class="badge badge-upcoming" style="font-size: 0.65rem;">
                                    @if($related->category === 'results') {{ __('Résultats') }}
                                    @elseif($related->category === 'news') {{ __('News') }}
                                    @elseif($related->category === 'interview') {{ __('Interview') }}
                                    @else {{ ucfirst($related->category) }}
                                    @endif
                                </span>
                            </div>
                            <h3 style="font-weight: 700; margin-bottom: 0.5rem;">
                                {{ $related->title }}
                            </h3>
                            <p style="color: var(--da-text-muted); font-size: 0.875rem;">
                                {{ $related->published_at?->diffForHumans() }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif

        <!-- Back to news -->
        <div style="text-align: center; margin-top: 2rem;">
            <a href="{{ route('articles.index') }}"
               style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.5rem; background: var(--da-card); border: 1px solid var(--da-border); border-radius: 0.5rem; font-weight: 600; transition: all 0.2s;">
                ← {{ __('Retour aux actualités') }}
            </a>
        </div>
    </div>

    <style>
        .article-content h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: var(--da-primary);
        }
        .article-content h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
        }
        .article-content p {
            margin-bottom: 1rem;
        }
        .article-content ul, .article-content ol {
            margin-left: 1.5rem;
            margin-bottom: 1rem;
        }
        .article-content li {
            margin-bottom: 0.5rem;
        }
        .article-content strong {
            color: var(--da-accent);
            font-weight: 600;
        }
        .article-content a {
            color: var(--da-primary);
            text-decoration: underline;
        }
    </style>
@endsection
