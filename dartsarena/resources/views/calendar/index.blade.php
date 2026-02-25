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
    {{-- Hero Section --}}
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
        {{-- Upcoming Events --}}
        <x-section-header title="{{ __('Événements à venir') }}" spacing="mb-6" />

        @if($upcomingEvents->count() > 0)
            <div class="grid grid-cols-1 gap-6 mb-12">
                @foreach($upcomingEvents as $event)
                    <x-card class="shadow-sm hover:shadow-lg hover:border-primary transition-all duration-200 overflow-hidden p-0 group">
                        {{-- Event Header --}}
                        <div class="p-5 flex flex-wrap items-center justify-between gap-4 border-b border-border">
                            <div class="flex items-center gap-3 flex-wrap">
                                <x-badge-category category="tournament">
                                    {{ __('À venir') }}
                                </x-badge-category>
                                @if($event->competition)
                                    <x-badge-category category="tournament">
                                        {{ $event->competition->federation->name }}
                                    </x-badge-category>
                                @endif
                            </div>
                            @if($event->ticket_url)
                                <a href="{{ $event->ticket_url }}" target="_blank"
                                   class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-primary-foreground rounded-[var(--radius-base)] text-sm font-bold uppercase tracking-wide hover:bg-primary-hover transition-all shadow-sm hover:shadow-md">
                                    <span class="text-lg">🎟️</span>
                                    <span>{{ __('Billets') }}</span>
                                </a>
                            @endif
                        </div>

                        {{-- Event Content --}}
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
                    </x-card>
                @endforeach
            </div>
        @else
            <x-card class="p-12 text-center mb-12">
                <p class="text-muted-foreground">
                    {{ __('Aucun événement à venir pour le moment.') }}
                </p>
            </x-card>
        @endif

        {{-- Past Events --}}
        @if($pastEvents->count() > 0)
            <x-section-header title="{{ __('Événements passés') }}" spacing="mb-6 mt-12" />

            <div class="grid grid-cols-1 gap-6">
                @foreach($pastEvents as $event)
                    <x-card class="shadow-sm hover:shadow-lg transition-all duration-200 overflow-hidden opacity-75 hover:opacity-100 p-0">
                        {{-- Event Header --}}
                        <div class="p-5 border-b border-border">
                            <x-badge-category category="tournament">
                                {{ __('Terminé') }}
                            </x-badge-category>
                        </div>

                        {{-- Event Content --}}
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
                    </x-card>
                @endforeach
            </div>
        @endif
    </div>
@endsection
