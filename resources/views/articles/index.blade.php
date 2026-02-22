@extends('layouts.app')

@section('title', __('Actualités Fléchettes') . ' - DartsArena')

@section('content')
    <section class="hero">
        <div class="container">
            <h1>📰 {{ __('Actualités') }}</h1>
            <p>{{ __('Toute l\'actualité des fléchettes : résultats, interviews, analyses et news du circuit PDC.') }}</p>
        </div>
    </section>

    <div class="container">
        <!-- Filters -->
        @if($categories->count() > 1)
            <div style="margin-bottom: 2rem; display: flex; gap: 0.5rem; flex-wrap: wrap;">
                <a href="{{ route('articles.index') }}"
                   class="badge {{ !$category ? 'badge-live' : 'badge-upcoming' }}"
                   style="padding: 0.5rem 1rem; cursor: pointer;">
                    {{ __('Tous') }}
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('articles.index', ['category' => $cat]) }}"
                       class="badge {{ $category === $cat ? 'badge-live' : 'badge-upcoming' }}"
                       style="padding: 0.5rem 1rem; cursor: pointer;">
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
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
                @foreach($articles as $article)
                    <a href="{{ route('articles.show', $article->slug) }}" class="card" style="display: flex; flex-direction: column;">
                        @if($article->featured_image)
                            <div style="width: 100%; height: 200px; background: var(--da-darker); border-radius: 0.5rem; margin-bottom: 1rem; overflow: hidden;">
                                <div style="width: 100%; height: 100%; background: linear-gradient(135deg, var(--da-primary) 0%, var(--da-primary-dark) 100%); display: flex; align-items: center; justify-content: center; font-size: 3rem;">
                                    @if($article->category === 'results') 🏆
                                    @elseif($article->category === 'interview') 🎤
                                    @elseif($article->category === 'analysis') 📊
                                    @else 📰
                                    @endif
                                </div>
                            </div>
                        @endif

                        <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem;">
                            <span class="badge badge-upcoming" style="font-size: 0.65rem;">
                                @if($article->category === 'results') {{ __('Résultats') }}
                                @elseif($article->category === 'news') {{ __('News') }}
                                @elseif($article->category === 'interview') {{ __('Interview') }}
                                @elseif($article->category === 'analysis') {{ __('Analyse') }}
                                @else {{ ucfirst($article->category) }}
                                @endif
                            </span>
                            <span style="color: var(--da-text-muted); font-size: 0.75rem;">
                                {{ $article->published_at?->diffForHumans() }}
                            </span>
                        </div>

                        <h3 style="font-weight: 700; font-size: 1.125rem; margin-bottom: 0.75rem; line-height: 1.4;">
                            {{ $article->title }}
                        </h3>

                        <p style="color: var(--da-text-muted); font-size: 0.875rem; line-height: 1.6; margin-bottom: 1rem; flex: 1;">
                            {{ $article->excerpt }}
                        </p>

                        <div style="color: var(--da-primary); font-size: 0.875rem; font-weight: 500;">
                            {{ __('Lire l\'article') }} →
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($articles->hasPages())
                <div style="display: flex; justify-content: center; gap: 0.5rem; margin-top: 2rem;">
                    @if($articles->onFirstPage())
                        <span style="padding: 0.5rem 1rem; background: var(--da-card); border-radius: 0.5rem; opacity: 0.5;">
                            ← {{ __('Précédent') }}
                        </span>
                    @else
                        <a href="{{ $articles->previousPageUrl() }}"
                           style="padding: 0.5rem 1rem; background: var(--da-card); border: 1px solid var(--da-border); border-radius: 0.5rem; font-weight: 500;">
                            ← {{ __('Précédent') }}
                        </a>
                    @endif

                    <span style="padding: 0.5rem 1rem; background: var(--da-primary); border-radius: 0.5rem; font-weight: 600;">
                        {{ $articles->currentPage() }} / {{ $articles->lastPage() }}
                    </span>

                    @if($articles->hasMorePages())
                        <a href="{{ $articles->nextPageUrl() }}"
                           style="padding: 0.5rem 1rem; background: var(--da-card); border: 1px solid var(--da-border); border-radius: 0.5rem; font-weight: 500;">
                            {{ __('Suivant') }} →
                        </a>
                    @else
                        <span style="padding: 0.5rem 1rem; background: var(--da-card); border-radius: 0.5rem; opacity: 0.5;">
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
@endsection
