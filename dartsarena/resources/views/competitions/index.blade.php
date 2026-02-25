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

                    {{-- Competition Image/Logo --}}
                    <div class="aspect-video bg-gradient-to-br from-primary/10 via-muted to-accent/10 flex items-center justify-center overflow-hidden relative">
                        @if(isset($competition->logo_url) && $competition->logo_url)
                            <img src="{{ $competition->logo_url }}"
                                 alt="{{ $competition->name }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        @else
                            {{-- Fallback: Logo badge stylisé --}}
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-24 h-24 rounded-full bg-gradient-to-br from-primary to-accent flex items-center justify-center border-4 border-background shadow-xl">
                                    <span class="text-4xl">🏆</span>
                                </div>
                                <span class="text-sm font-bold text-foreground/80 uppercase tracking-wider">
                                    {{ $competition->federation->code ?? 'PDC' }}
                                </span>
                            </div>
                        @endif

                        {{-- Federation Badge --}}
                        <div class="absolute top-3 left-3 backdrop-blur-sm bg-background/70 rounded-[var(--radius-base)] px-2.5 py-1 border border-card-border/50">
                            <x-badge-category category="tournament" size="sm">
                                {{ $competition->federation->name }}
                            </x-badge-category>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="p-6 space-y-4">
                        <h3 class="font-display text-2xl font-bold text-foreground group-hover:text-primary transition-colors leading-[1.2]">
                            {{ $competition->name }}
                        </h3>

                        <p class="text-sm text-muted-foreground line-clamp-2 leading-relaxed">
                            {{ $competition->description }}
                        </p>

                        {{-- Stats Grid --}}
                        <div class="pt-4 border-t border-border space-y-3">
                            {{-- Prize Money --}}
                            @if($competition->prize_money)
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-muted-foreground font-semibold">{{ __('Prize Money') }}</span>
                                    <span class="font-display text-xl font-bold text-accent">
                                        £{{ number_format($competition->prize_money) }}
                                    </span>
                                </div>
                            @endif

                            {{-- Participants Count --}}
                            @if(isset($competition->participants_count))
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-muted-foreground font-semibold">{{ __('Participants') }}</span>
                                    <span class="font-bold text-foreground">
                                        {{ $competition->participants_count }} {{ __('joueurs') }}
                                    </span>
                                </div>
                            @endif

                            {{-- Start Date --}}
                            @if(isset($competition->start_date))
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-muted-foreground font-semibold">{{ __('Début') }}</span>
                                    <time class="text-sm text-foreground">
                                        {{ \Carbon\Carbon::parse($competition->start_date)->format('d M Y') }}
                                    </time>
                                </div>
                            @endif
                        </div>

                        <x-link-arrow href="{{ route('competitions.show', $competition->slug) }}" size="sm" class="pt-2">
                            {{ __('Voir les détails') }}
                        </x-link-arrow>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
