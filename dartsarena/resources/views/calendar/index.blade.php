@extends('layouts.app')

@section('title', __('Calendrier') . ' - DartsArena')

@section('breadcrumbs')
    <div class="breadcrumbs py-3">
        <a href="{{ route('home') }}">{{ __('Accueil') }}</a>
        <span class="text-muted-foreground mx-2">/</span>
        <span class="text-foreground">{{ __('Calendrier') }}</span>
    </div>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-b from-muted/30 to-background">
        <div class="container py-12 lg:py-16">
            <h1 class="font-display text-4xl lg:text-5xl font-bold text-foreground mb-4">
                {{ __('Calendrier') }}
            </h1>
            <p class="text-lg text-muted-foreground max-w-3xl">
                {{ __('Tous les événements et dates des compétitions de fléchettes.') }}
            </p>
        </div>
    </section>

    <div class="container py-8 lg:py-12">
        <!-- Upcoming Events -->
        <h2 class="font-display text-3xl font-bold text-foreground mb-6 flex items-center gap-3">
            <span>🔜</span>
            {{ __('Événements à venir') }}
        </h2>

        @if($upcomingEvents->count() > 0)
            <div class="grid grid-cols-1 gap-6 mb-12">
                @foreach($upcomingEvents as $event)
                    <div class="bg-card rounded-xl border border-card-border shadow-sm hover:shadow-lg hover:border-border-strong transition-all duration-200 overflow-hidden group">
                        <!-- Header -->
                        <div class="p-5 flex flex-wrap items-center justify-between gap-4 border-b border-border">
                            <div class="flex items-center gap-3 flex-wrap">
                                <span class="inline-flex items-center px-3 py-1 bg-accent/10 text-accent border border-accent/30 rounded-md text-xs font-bold uppercase tracking-wider">
                                    {{ __('À venir') }}
                                </span>
                                @if($event->competition)
                                    <span class="inline-flex items-center px-2.5 py-1 bg-primary/10 text-primary border border-primary/30 rounded text-xs font-semibold uppercase">
                                        {{ $event->competition->federation->name }}
                                    </span>
                                @endif
                            </div>
                            @if($event->ticket_url)
                                <a href="{{ $event->ticket_url }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-primary-foreground rounded-lg text-sm font-bold uppercase tracking-wide hover:bg-primary-hover transition-all shadow-sm hover:shadow-md">
                                    <span class="text-lg">🎟️</span>
                                    <span>{{ __('Billets') }}</span>
                                </a>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <h3 class="font-display text-2xl font-bold text-foreground mb-4 group-hover:text-primary transition-colors">
                                {{ $event->title }}
                            </h3>

                            <div class="space-y-3">
                                <div class="flex items-center gap-3 text-muted-foreground">
                                    <span class="text-xl flex-shrink-0">📍</span>
                                    <span>{{ $event->venue }}</span>
                                </div>
                                <div class="flex items-center gap-3 text-muted-foreground">
                                    <span class="text-xl flex-shrink-0">📅</span>
                                    <span>{{ $event->start_date->format('d/m/Y') }} - {{ $event->end_date->format('d/m/Y') }}</span>
                                </div>
                                <div class="flex items-center gap-3 text-accent font-semibold">
                                    <span class="text-xl flex-shrink-0">⏳</span>
                                    <span>{{ __('Dans') }} {{ $event->start_date->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-card rounded-xl border border-card-border p-12 text-center mb-12">
                <p class="text-muted-foreground">
                    {{ __('Aucun événement à venir pour le moment.') }}
                </p>
            </div>
        @endif

        <!-- Past Events -->
        @if($pastEvents->count() > 0)
            <h2 class="font-display text-3xl font-bold text-foreground mb-6 flex items-center gap-3 mt-12">
                <span>✅</span>
                {{ __('Événements passés') }}
            </h2>

            <div class="grid grid-cols-1 gap-6">
                @foreach($pastEvents as $event)
                    <div class="bg-card rounded-xl border border-card-border shadow-sm hover:shadow-lg transition-all duration-200 overflow-hidden opacity-75 hover:opacity-100">
                        <!-- Header -->
                        <div class="p-5 border-b border-border">
                            <span class="inline-flex items-center px-3 py-1 bg-success/10 text-success border border-success/30 rounded-md text-xs font-bold uppercase tracking-wider">
                                {{ __('Terminé') }}
                            </span>
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <h3 class="font-display text-2xl font-bold text-foreground mb-4">
                                {{ $event->title }}
                            </h3>

                            <div class="space-y-3">
                                <div class="flex items-center gap-3 text-muted-foreground">
                                    <span class="text-xl flex-shrink-0">📍</span>
                                    <span>{{ $event->venue }}</span>
                                </div>
                                <div class="flex items-center gap-3 text-muted-foreground">
                                    <span class="text-xl flex-shrink-0">📅</span>
                                    <span>{{ $event->start_date->format('d/m/Y') }} - {{ $event->end_date->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
