{{--
    SEO Grid - 6 card grid for SEO content sections

    @param string $gap - Grid gap spacing (default: gap-6)

    Usage:
    <x-grid-seo>
        <x-card>
            <x-section-header-colored title="..." emoji="..." />
            <div class="p-6">...</div>
        </x-card>
        <!-- 5 more cards -->
    </x-grid-seo>
--}}

@props([
    'gap' => 'gap-6',
])

<div {{ $attributes->merge(['class' => "grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 {$gap}"]) }}>
    {{ $slot }}
</div>
