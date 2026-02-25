@props([
    'guide',
    'difficulty' => 'beginner',
    'showMeta' => true,
])

@php
    $badgeColors = [
        'beginner' => 'bg-green-500/90 text-white',
        'intermediate' => 'bg-blue-500/90 text-white',
        'advanced' => 'bg-purple-500/90 text-white',
    ];

    $bgGradients = [
        'beginner' => 'from-green-500/10',
        'intermediate' => 'from-blue-500/10',
        'advanced' => 'from-purple-500/10',
    ];

    $iconMap = [
        'rules' => '📜',
        'stats' => '📊',
        'competitions' => '🏆',
        'beginner' => '🎯',
        'intermediate' => '🎪',
        'advanced' => '🏅',
    ];
@endphp

<a href="{{ route('guides.show', $guide->slug) }}"
   {{ $attributes->merge(['class' => 'group bg-card border border-card-border rounded-[var(--radius-base)] overflow-hidden hover:border-primary hover:shadow-lg hover:-translate-y-1 transition-all duration-200']) }}>

    {{-- Image/Icon Header --}}
    <div class="aspect-video bg-gradient-to-br {{ $bgGradients[$difficulty] ?? 'from-primary/10' }} via-muted to-accent/10 flex items-center justify-center relative overflow-hidden">
        @if(isset($guide->image_url) && $guide->image_url)
            <img src="{{ $guide->image_url }}"
                 alt="{{ $guide->title }}"
                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
        @else
            {{-- Fallback icon --}}
            <span class="text-6xl opacity-40">
                {{ $iconMap[$guide->category] ?? '📚' }}
            </span>
        @endif

        {{-- Difficulty Badge --}}
        <div class="absolute top-3 left-3">
            <span class="px-3 py-1 rounded-full text-xs font-bold backdrop-blur-sm {{ $badgeColors[$difficulty] ?? 'bg-primary/90' }} shadow-lg">
                @if($difficulty === 'beginner') {{ __('Débutant') }}
                @elseif($difficulty === 'intermediate') {{ __('Intermédiaire') }}
                @elseif($difficulty === 'advanced') {{ __('Avancé') }}
                @else {{ ucfirst($difficulty) }}
                @endif
            </span>
        </div>
    </div>

    {{-- Content --}}
    <div class="p-6 space-y-3">
        <h3 class="font-display text-xl font-bold text-foreground group-hover:text-primary transition-colors line-clamp-2 leading-[1.2]">
            {{ $guide->title }}
        </h3>

        @if(isset($guide->excerpt) && $guide->excerpt)
            <p class="text-sm text-muted-foreground line-clamp-2 leading-relaxed">
                {{ $guide->excerpt }}
            </p>
        @endif

        {{-- Meta Info --}}
        @if($showMeta)
            <div class="flex items-center gap-4 pt-3 border-t border-card-border text-xs text-muted-foreground">
                <span class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ isset($guide->reading_time) ? $guide->reading_time : '5' }} min
                </span>
                <span class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    @if($guide->category === 'rules') {{ __('Règles') }}
                    @elseif($guide->category === 'stats') {{ __('Statistiques') }}
                    @elseif($guide->category === 'competitions') {{ __('Compétitions') }}
                    @else {{ ucfirst($guide->category) }}
                    @endif
                </span>
            </div>
        @endif

        <x-link-arrow href="{{ route('guides.show', $guide->slug) }}" size="sm" class="pt-2">
            {{ __('Lire le guide') }}
        </x-link-arrow>
    </div>
</a>
