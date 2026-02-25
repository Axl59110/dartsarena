@extends('layouts.app')

@section('title', $federation->name . ' - DartsArena')

@section('breadcrumbs')
    <div class="breadcrumbs py-3">
        <a href="{{ route('home') }}">{{ __('Accueil') }}</a>
        <span class="text-muted-foreground mx-2">/</span>
        <a href="{{ route('federations.index') }}">{{ __('Fédérations') }}</a>
        <span class="text-muted-foreground mx-2">/</span>
        <span class="text-foreground">{{ $federation->name }}</span>
    </div>
@endsection

@section('content')
    {{-- Federation Hero --}}
    <section class="bg-gradient-to-b from-muted/30 to-background">
        <div class="container py-12 lg:py-16">
            <h1 class="font-display text-4xl lg:text-5xl font-bold text-foreground mb-4">
                {{ $federation->name }}
            </h1>
            <p class="text-lg text-muted-foreground max-w-3xl">
                {{ $federation->description }}
            </p>
        </div>
    </section>

    <div class="container py-8 lg:py-12">
        {{-- Competitions Section --}}
        <x-section-header title="{{ __('Compétitions') }}" spacing="mb-6" />

        @if($competitions->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($competitions as $competition)
                    <a href="{{ route('competitions.show', $competition->slug) }}"
                       class="group bg-card border border-card-border rounded-[var(--radius-base)] shadow-sm hover:shadow-lg hover:border-primary hover:-translate-y-1 transition-all duration-200 p-6">

                        <h3 class="font-display text-xl font-bold text-foreground group-hover:text-primary transition-colors mb-3">
                            {{ $competition->name }}
                        </h3>

                        <p class="text-sm text-muted-foreground mb-4 line-clamp-2">
                            {{ $competition->description }}
                        </p>

                        @if($competition->prize_money)
                            <div class="flex items-center gap-2 text-accent font-semibold">
                                <span>💰</span>
                                <span>${{ number_format($competition->prize_money) }}</span>
                            </div>
                        @endif
                    </a>
                @endforeach
            </div>
        @else
            <x-card class="p-12 text-center">
                <p class="text-muted-foreground">
                    {{ __('Aucune compétition disponible pour cette fédération.') }}
                </p>
            </x-card>
        @endif

        {{-- Back Button --}}
        <div class="text-center mt-12">
            <a href="{{ route('federations.index') }}"
               class="inline-flex items-center gap-3 px-6 py-3 bg-card text-foreground border-2 border-primary rounded-[var(--radius-base)] font-semibold hover:bg-primary hover:text-primary-foreground transition-all hover:-translate-y-0.5 shadow-sm">
                <span class="text-xl">←</span>
                {{ __('Retour aux fédérations') }}
            </a>
        </div>
    </div>
@endsection
