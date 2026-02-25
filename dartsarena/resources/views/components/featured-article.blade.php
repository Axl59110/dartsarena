@props([
    'article',
    'category' => $article->category ?? 'news',
    'title' => $article->title ?? '',
    'excerpt' => $article->excerpt ?? '',
    'publishedAt' => $article->published_at ?? null,
    'slug' => $article->slug ?? '#',
])

{{-- Featured Article Hero (ESPN/BBC Style) --}}
<article {{ $attributes->merge(['class' => 'grid lg:grid-cols-3 gap-8 p-6 lg:p-8 bg-card border border-card-border rounded-[var(--radius-base)] hover:border-primary transition-colors']) }}>
    {{-- Image 2/3 --}}
    <a href="{{ route('articles.show', $slug) }}" class="lg:col-span-2 group">
        <div class="aspect-video rounded-[var(--radius-base)] overflow-hidden relative bg-gradient-to-br from-primary/20 via-muted to-accent/20">
            {{-- Fallback Image avec icône catégorie --}}
            @if(isset($article->image_url) && $article->image_url)
                <img src="{{ $article->image_url }}"
                     alt="{{ $title }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            @else
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="text-8xl opacity-20">
                        @if($category === 'results') 🏆
                        @elseif($category === 'interview') 🎤
                        @elseif($category === 'analysis') 📊
                        @else 📰
                        @endif
                    </div>
                </div>
            @endif

            {{-- Badge catégorie avec backdrop-blur --}}
            <div class="absolute top-4 left-4 backdrop-blur-md bg-background/80 rounded-[var(--radius-base)] px-3 py-1.5 border border-card-border">
                <x-badge-category :category="$category">
                    @if($category === 'results') {{ __('Résultats') }}
                    @elseif($category === 'news') {{ __('News') }}
                    @elseif($category === 'interview') {{ __('Interview') }}
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
        @if($publishedAt)
            <div class="flex items-center gap-3 text-sm text-muted-foreground">
                <time>{{ $publishedAt->diffForHumans() }}</time>
            </div>
        @endif

        <a href="{{ route('articles.show', $slug) }}" class="group">
            <h2 class="font-display text-3xl lg:text-4xl font-bold text-foreground group-hover:text-primary transition-colors leading-[1.1] mb-4">
                {{ $title }}
            </h2>
        </a>

        <p class="text-base text-muted-foreground leading-relaxed">
            {{ $excerpt }}
        </p>

        <div class="pt-2">
            <x-link-arrow href="{{ route('articles.show', $slug) }}">
                {{ __('Lire l\'article') }}
            </x-link-arrow>
        </div>
    </div>
</article>
