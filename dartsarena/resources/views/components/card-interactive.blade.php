{{--
    Interactive Card - Clickable card with image, title, and content

    @param string $href - Link URL
    @param string $image - Image URL
    @param string $imageAlt - Image alt text
    @param string $title - Card title
    @param string|null $category - Optional category badge
    @param string|null $date - Optional date

    Usage:
    <x-card-interactive
        href="{{ route('articles.show', $article) }}"
        image="{{ $article->image_url }}"
        imageAlt="{{ $article->title }}"
        title="{{ $article->title }}">

        <x-slot:category>
            <x-badge variant="primary">{{ $article->category }}</x-badge>
        </x-slot:category>

        <x-slot:meta>
            <span class="text-sm text-muted-foreground">{{ $article->published_at->format('M d, Y') }}</span>
        </x-slot:meta>

        {{ $article->excerpt }}
    </x-card-interactive>
--}}

@props([
    'href' => '#',
    'image' => null,
    'imageAlt' => '',
    'title' => '',
])

<a href="{{ $href }}"
    {{ $attributes->merge(['class' => 'group bg-card border border-card-border rounded-[var(--radius-base)] overflow-hidden hover:border-primary hover:shadow-md transition-all']) }}>

    @if($image)
        <div class="aspect-[16/9] bg-muted overflow-hidden relative">
            <img
                src="{{ $image }}"
                alt="{{ $imageAlt }}"
                class="w-full h-full object-cover group-hover:scale-[1.02] transition-transform duration-300"
                loading="lazy"
            />

            @isset($category)
                <div class="absolute top-3 left-3">
                    {{ $category }}
                </div>
            @endisset
        </div>
    @endif

    <div class="p-4 space-y-2">
        @isset($meta)
            <div class="flex items-center gap-2 text-xs">
                {{ $meta }}
            </div>
        @endisset

        <h3 class="font-display font-bold text-lg group-hover:text-primary transition-colors line-clamp-2">
            {{ $title }}
        </h3>

        @if($slot->isNotEmpty())
            <div class="text-sm text-muted-foreground line-clamp-2">
                {{ $slot }}
            </div>
        @endif
    </div>
</a>
