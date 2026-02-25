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
    {{-- Hero Section --}}
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
        {{-- Competitions Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach($competitions as $competition)
                <a href="{{ route('competitions.show', $competition->slug) }}"
                   class="group bg-card border border-card-border rounded-[var(--radius-base)] shadow-sm hover:shadow-lg hover:border-primary hover:-translate-y-1 transition-all duration-200 overflow-hidden">

                    {{-- Header with Federation Badge --}}
                    <div class="p-5 flex items-center justify-between border-b border-border">
                        <x-badge-category category="tournament">
                            {{ $competition->federation->name }}
                        </x-badge-category>
                        <span class="text-4xl group-hover:scale-110 group-hover:rotate-12 transition-transform">🏆</span>
                    </div>

                    {{-- Content --}}
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

                        <x-link-arrow href="{{ route('competitions.show', $competition->slug) }}" size="sm" class="pt-2">
                            {{ __('Voir les détails') }}
                        </x-link-arrow>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
