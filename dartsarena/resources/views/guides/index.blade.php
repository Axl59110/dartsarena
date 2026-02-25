@extends('layouts.app')

@section('title', __('Guides') . ' - DartsArena')

@section('breadcrumbs')
    <div class="breadcrumbs py-3">
        <a href="{{ route('home') }}">{{ __('Accueil') }}</a>
        <span class="text-muted-foreground mx-2">/</span>
        <span class="text-foreground">{{ __('Guides') }}</span>
    </div>
@endsection

@section('content')
    {{-- Hero Section --}}
    <section class="bg-gradient-to-b from-muted/30 to-background">
        <div class="container py-12 lg:py-16">
            <h1 class="font-display text-4xl lg:text-5xl font-bold text-foreground mb-4">
                {{ __('Guides') }}
            </h1>
            <p class="text-lg text-muted-foreground max-w-3xl">
                {{ __('Règles, techniques, statistiques et tout ce qu\'il faut savoir sur les fléchettes.') }}
            </p>
        </div>
    </section>

    <div class="container py-8 lg:py-12">
        {{-- Difficulty Level Tabs --}}
        <div class="flex items-center gap-2 mb-12 overflow-x-auto pb-2" x-data="{ level: 'all' }">
            <button @click="level = 'all'"
                    :class="level === 'all' ? 'bg-primary text-primary-foreground' : 'bg-card text-foreground hover:bg-muted border border-border'"
                    class="px-4 py-2 rounded-[var(--radius-base)] text-sm font-semibold whitespace-nowrap transition-colors">
                {{ __('Tous les niveaux') }}
            </button>
            <button @click="level = 'beginner'"
                    :class="level === 'beginner' ? 'bg-primary text-primary-foreground' : 'bg-card text-foreground hover:bg-muted border border-border'"
                    class="px-4 py-2 rounded-[var(--radius-base)] text-sm font-semibold whitespace-nowrap transition-colors">
                {{ __('Débutant') }}
            </button>
            <button @click="level = 'intermediate'"
                    :class="level === 'intermediate' ? 'bg-primary text-primary-foreground' : 'bg-card text-foreground hover:bg-muted border border-border'"
                    class="px-4 py-2 rounded-[var(--radius-base)] text-sm font-semibold whitespace-nowrap transition-colors">
                {{ __('Intermédiaire') }}
            </button>
            <button @click="level = 'advanced'"
                    :class="level === 'advanced' ? 'bg-primary text-primary-foreground' : 'bg-card text-foreground hover:bg-muted border border-border'"
                    class="px-4 py-2 rounded-[var(--radius-base)] text-sm font-semibold whitespace-nowrap transition-colors">
                {{ __('Avancé') }}
            </button>
        </div>

        @php
            // Map categories to difficulty levels (you can add 'difficulty' field to Guide model)
            $guidesByLevel = [
                'beginner' => [],
                'intermediate' => [],
                'advanced' => []
            ];

            // Redistribute guides by difficulty (fallback logic based on category)
            foreach($guidesByCategory as $category => $guides) {
                foreach($guides as $guide) {
                    // If guide has difficulty field, use it; otherwise, map by category
                    if (isset($guide->difficulty)) {
                        $guidesByLevel[$guide->difficulty][] = $guide;
                    } else {
                        // Fallback: map by category
                        if ($category === 'rules') {
                            $guidesByLevel['beginner'][] = $guide;
                        } elseif ($category === 'stats') {
                            $guidesByLevel['intermediate'][] = $guide;
                        } else {
                            $guidesByLevel['advanced'][] = $guide;
                        }
                    }
                }
            }

            // Icon mapping
            $iconMap = [
                'rules' => '📜',
                'stats' => '📊',
                'competitions' => '🏆',
                'beginner' => '🎯',
                'intermediate' => '🎪',
                'advanced' => '🏅',
            ];
        @endphp

        @foreach($guidesByLevel as $level => $guides)
            @if(count($guides) > 0)
                <div class="mb-12" x-show="level === 'all' || level === '{{ $level }}'">
                    {{-- Level Header --}}
                    <x-section-header spacing="mb-6">
                        <x-slot:title>
                            @if($level === 'beginner') {{ __('Débutant') }}
                            @elseif($level === 'intermediate') {{ __('Intermédiaire') }}
                            @elseif($level === 'advanced') {{ __('Avancé') }}
                            @endif
                        </x-slot:title>
                        <x-slot:description>
                            @if($level === 'beginner') {{ __('Guides pour bien démarrer aux fléchettes') }}
                            @elseif($level === 'intermediate') {{ __('Guides pour progresser et affiner sa technique') }}
                            @elseif($level === 'advanced') {{ __('Guides avancés pour les joueurs expérimentés') }}
                            @endif
                        </x-slot:description>
                    </x-section-header>

                    {{-- Guides Grid (Vertical Cards) --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($guides as $index => $guide)
                            <a href="{{ route('guides.show', $guide->slug) }}"
                               class="group bg-card border border-card-border rounded-[var(--radius-base)] overflow-hidden hover:border-primary hover:shadow-lg hover:-translate-y-1 transition-all duration-200">

                                {{-- Image/Icon Header --}}
                                <div class="aspect-video bg-gradient-to-br from-{{ $level === 'beginner' ? 'green' : ($level === 'intermediate' ? 'blue' : 'purple') }}-500/10 via-muted to-accent/10 flex items-center justify-center relative overflow-hidden">
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
                                        @php
                                            $badgeColors = [
                                                'beginner' => 'bg-green-500/90 text-white',
                                                'intermediate' => 'bg-blue-500/90 text-white',
                                                'advanced' => 'bg-purple-500/90 text-white',
                                            ];
                                        @endphp
                                        <span class="px-3 py-1 rounded-full text-xs font-bold backdrop-blur-sm {{ $badgeColors[$level] ?? 'bg-primary/90' }} shadow-lg">
                                            @if($level === 'beginner') {{ __('Débutant') }}
                                            @elseif($level === 'intermediate') {{ __('Intermédiaire') }}
                                            @elseif($level === 'advanced') {{ __('Avancé') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                {{-- Content --}}
                                <div class="p-6 space-y-3">
                                    <h3 class="font-display text-xl font-bold text-foreground group-hover:text-primary transition-colors line-clamp-2 leading-[1.2]">
                                        {{ $guide->title }}
                                    </h3>

                                    <p class="text-sm text-muted-foreground line-clamp-2 leading-relaxed">
                                        {{ $guide->excerpt }}
                                    </p>

                                    {{-- Meta Info --}}
                                    <div class="flex items-center gap-4 pt-3 border-t border-card-border text-xs text-muted-foreground">
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ isset($guide->reading_time) ? $guide->reading_time : (5 + ($index % 10)) }} min
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

                                    <x-link-arrow href="{{ route('guides.show', $guide->slug) }}" size="sm" class="pt-2">
                                        {{ __('Lire le guide') }}
                                    </x-link-arrow>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach

        @if(collect($guidesByLevel)->flatten()->count() === 0)
            <x-card class="p-12 text-center">
                <p class="text-muted-foreground">
                    {{ __('Aucun guide disponible pour le moment.') }}
                </p>
            </x-card>
        @endif
    </div>
@endsection
