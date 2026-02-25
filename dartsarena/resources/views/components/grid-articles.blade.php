{{--
    Article Grid - 3 column responsive grid for articles

    @param string $gap - Grid gap spacing (default: gap-4)
    @param string $cols - Column breakpoints (default: md:grid-cols-2 lg:grid-cols-3)

    Usage:
    <x-grid-articles>
        <x-card-interactive ... />
        <x-card-interactive ... />
        <x-card-interactive ... />
    </x-grid-articles>

    <x-grid-articles gap="gap-6" cols="md:grid-cols-2 lg:grid-cols-4">
        <!-- 4 columns on large screens -->
    </x-grid-articles>
--}}

@props([
    'gap' => 'gap-4',
    'cols' => 'md:grid-cols-2 lg:grid-cols-3',
])

<div {{ $attributes->merge(['class' => "grid grid-cols-1 {$cols} {$gap}"]) }}>
    {{ $slot }}
</div>
