{{--
    Filter Tabs Component - Tab navigation for filtering content

    @param array $tabs - Array of tabs ['value' => 'Label']
    @param string $active - Currently active tab value
    @param string $xModel - Alpine.js model name (default: 'activeTab')

    Usage:
    <x-filter-tabs
        :tabs="['all' => 'All', 'results' => 'Results', 'news' => 'News']"
        active="all"
        xModel="filter"
    />

    With Alpine.js:
    <div x-data="{ filter: 'all' }">
        <x-filter-tabs
            :tabs="['all' => 'All', 'pdc' => 'PDC', 'wdf' => 'WDF']"
            xModel="filter"
        />

        <div x-show="filter === 'all'">All content</div>
        <div x-show="filter === 'pdc'">PDC content</div>
    </div>
--}}

@props([
    'tabs' => [],
    'active' => null,
    'xModel' => 'activeTab',
])

<div {{ $attributes->merge(['class' => 'flex flex-wrap gap-2 mb-4']) }} role="tablist">
    @foreach($tabs as $value => $label)
        @php
        $isActive = $active === $value;
        $activeClasses = $isActive
            ? 'bg-primary text-primary-foreground'
            : 'bg-muted hover:bg-muted/80';
        @endphp

        <button
            @if($xModel)
                @click="{{ $xModel }} = '{{ $value }}'"
                :class="{{ $xModel }} === '{{ $value }}' ? 'bg-primary text-primary-foreground' : 'bg-muted hover:bg-muted/80'"
            @endif
            class="px-4 py-2 rounded-[var(--radius-base)] text-sm font-semibold transition-colors disabled:opacity-50 {{ !$xModel ? $activeClasses : '' }}"
            role="tab"
            aria-selected="{{ $isActive ? 'true' : 'false' }}"
            type="button"
        >
            {{ $label }}
        </button>
    @endforeach
</div>
