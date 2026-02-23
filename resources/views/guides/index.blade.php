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
    <!-- Hero Section -->
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
        @foreach($guidesByCategory as $category => $guides)
            <div class="mb-16">
                <h2 class="font-display text-3xl font-bold text-foreground mb-6 flex items-center gap-3">
                    <span>
                        @if($category === 'rules') 📜
                        @elseif($category === 'stats') 📊
                        @elseif($category === 'competitions') 🏆
                        @else 📚
                        @endif
                    </span>
                    @if($category === 'rules') {{ __('Règles') }}
                    @elseif($category === 'stats') {{ __('Statistiques') }}
                    @elseif($category === 'competitions') {{ __('Compétitions') }}
                    @else {{ ucfirst($category) }}
                    @endif
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($guides as $guide)
                        <a href="{{ route('guides.show', $guide->slug) }}"
                           class="bg-card rounded-xl border border-card-border shadow-sm hover:shadow-lg hover:border-border-strong hover:-translate-y-1 transition-all duration-200 group overflow-hidden flex gap-5 p-5">
                            <!-- Icon -->
                            <div class="flex-shrink-0 w-20 h-20 bg-gradient-to-br from-muted to-border rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform">
                                <span class="text-4xl">
                                    @if($category === 'rules') 📜
                                    @elseif($category === 'stats') 📊
                                    @elseif($category === 'competitions') 🏆
                                    @else 📚
                                    @endif
                                </span>
                            </div>

                            <!-- Content -->
                            <div class="flex-1 min-w-0">
                                <h3 class="font-display text-xl font-bold text-foreground group-hover:text-primary transition-colors mb-2 leading-tight">
                                    {{ $guide->title }}
                                </h3>
                                <p class="text-sm text-muted-foreground line-clamp-2 leading-relaxed mb-3">
                                    {{ $guide->excerpt }}
                                </p>
                                <div class="flex items-center gap-2 text-primary font-semibold text-sm">
                                    {{ __('Lire le guide') }}
                                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach

        @if($guidesByCategory->count() === 0)
            <div class="bg-card rounded-xl border border-card-border p-12 text-center">
                <p class="text-muted-foreground">
                    {{ __('Aucun guide disponible pour le moment.') }}
                </p>
            </div>
        @endif
    </div>
@endsection
