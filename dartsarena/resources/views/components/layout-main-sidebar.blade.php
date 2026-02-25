{{--
    Main + Sidebar Layout - 2/3 main content + 1/3 sticky sidebar

    @param string $gap - Grid gap spacing (default: gap-6)
    @param bool $stickyTop - Sidebar sticky offset (default: 24 = 6rem)

    Usage:
    <x-layout-main-sidebar>
        <x-slot:main>
            <!-- Main content (2/3 width) -->
        </x-slot:main>

        <x-slot:sidebar>
            <!-- Sticky sidebar (1/3 width) -->
        </x-slot:sidebar>
    </x-layout-main-sidebar>
--}}

@props([
    'gap' => 'gap-6',
    'stickyTop' => 'top-24',
])

<div {{ $attributes->merge(['class' => "grid grid-cols-1 lg:grid-cols-3 {$gap}"]) }}>
    <div class="lg:col-span-2">
        {{ $main }}
    </div>

    <aside class="space-y-6 lg:sticky lg:{{ $stickyTop }} lg:self-start">
        {{ $sidebar }}
    </aside>
</div>
