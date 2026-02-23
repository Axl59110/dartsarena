@extends('layouts.app')

@section('title', __('Compétitions de Fléchettes') . ' - DartsArena')

@section('breadcrumbs')
    <div class="breadcrumbs py-3">
        <a href="{{ route('home') }}">{{ __('Accueil') }}</a>
        <span class="text-muted-foreground mx-2">/</span>
        <span class="text-foreground">{{ __('Compétitions') }}</span>
    </div>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-b from-muted/30 to-background">
        <div class="container py-12 lg:py-16">
            <h1 class="font-display text-4xl lg:text-5xl font-bold text-foreground mb-4">
                {{ __('Compétitions') }}
            </h1>
            <p class="text-lg text-muted-foreground max-w-3xl">
                {{ __('Tous les tournois majeurs de fléchettes à travers le monde.') }}
            </p>
        </div>
    </section>

    <div class="container py-8 lg:py-12">
        <!-- Competitions Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach($competitions as $competition)
                <a href="{{ route('competitions.show', $competition->slug) }}"
                   class="bg-card rounded-xl border border-card-border shadow-sm hover:shadow-lg hover:border-border-strong hover:-translate-y-1 transition-all duration-200 group overflow-hidden">
                    <!-- Header -->
                    <div class="p-5 flex items-center justify-between border-b border-border">
                        <span class="inline-flex items-center px-2.5 py-1 bg-primary/10 text-primary border border-primary/30 rounded text-xs font-bold uppercase tracking-wider">
                            {{ $competition->federation->name }}
                        </span>
                        <span class="text-4xl group-hover:scale-110 group-hover:rotate-12 transition-transform">🏆</span>
                    </div>

                    <!-- Content -->
                    <div class="p-6 space-y-4">
                        <h3 class="font-display text-2xl font-bold text-foreground group-hover:text-primary transition-colors leading-tight">
                            {{ $competition->name }}
                        </h3>

                        <p class="text-sm text-muted-foreground line-clamp-3 leading-relaxed">
                            {{ $competition->description }}
                        </p>

                        @if($competition->prize_money)
                            <div class="pt-4 border-t border-border flex items-center justify-between">
                                <span class="text-xs text-muted-foreground font-semibold uppercase tracking-wide">{{ __('Prize Money') }}</span>
                                <span class="font-display text-xl font-bold text-accent">${{ number_format($competition->prize_money) }}</span>
                            </div>
                        @endif

                        <div class="flex items-center gap-2 text-primary font-semibold text-sm pt-2">
                            {{ __('Voir les détails') }}
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
