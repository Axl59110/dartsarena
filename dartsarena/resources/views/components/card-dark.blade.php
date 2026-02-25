{{--
    Dark Card - Sidebar card with dark background

    @param string $title - Card header title
    @param string|null $headerClass - Additional header classes

    Usage:
    <x-card-dark title="{{ __('Upcoming Events') }}">
        <div class="space-y-3">
            <!-- Dark card content -->
        </div>
    </x-card-dark>
--}}

@props([
    'title' => '',
    'headerClass' => '',
])

<section {{ $attributes->merge(['class' => 'bg-darker rounded-[var(--radius-base)] overflow-hidden shadow-lg']) }}>
    @if($title)
        <div class="px-5 py-4 border-b border-primary/30 {{ $headerClass }}">
            <h3 class="font-display text-xl font-bold text-white">
                {{ $title }}
            </h3>
        </div>
    @endif

    <div class="p-5">
        <div class="text-white">
            {{ $slot }}
        </div>
    </div>
</section>
