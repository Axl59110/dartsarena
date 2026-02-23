@extends('layouts.app')

@section('title', $competition->name . ' - DartsArena')

@section('breadcrumbs')
    <div class="breadcrumbs py-3">
        <a href="{{ route('home') }}">{{ __('Accueil') }}</a>
        <span class="text-muted-foreground mx-2">/</span>
        <a href="{{ route('competitions.index') }}">{{ __('Compétitions') }}</a>
        <span class="text-muted-foreground mx-2">/</span>
        <span class="text-foreground">{{ $competition->name }}</span>
    </div>
@endsection

@section('content')
    <!-- Competition Hero -->
    <section class="bg-gradient-to-b from-muted/30 to-background">
        <div class="container py-12 lg:py-16">
            <div class="flex flex-col lg:flex-row items-center lg:items-start gap-8">
                <!-- Trophy Icon -->
                <div class="relative flex-shrink-0">
                    <div class="w-32 h-32 lg:w-40 lg:h-40 flex items-center justify-center">
                        <span class="text-8xl lg:text-9xl">🏆</span>
                    </div>
                </div>

                <!-- Info -->
                <div class="flex-1 text-center lg:text-left">
                    <h1 class="font-display text-4xl lg:text-5xl font-bold text-foreground mb-4">
                        {{ $competition->name }}
                    </h1>
                    <p class="text-lg text-muted-foreground leading-relaxed max-w-3xl">
                        {{ $competition->description }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <div class="container py-8 lg:py-12">
        <div class="max-w-5xl mx-auto">
            <!-- Info Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
                <!-- General Info -->
                <div class="bg-card rounded-xl border border-card-border p-6 hover:shadow-lg hover:border-border-strong transition-all">
                    <h3 class="font-display text-2xl font-bold text-foreground mb-6 flex items-center gap-3">
                        <span>📋</span>
                        {{ __('Informations') }}
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-background rounded-lg">
                            <span class="text-sm text-muted-foreground font-semibold uppercase tracking-wide">{{ __('Fédération') }}</span>
                            <a href="{{ route('federations.show', $competition->federation->slug) }}"
                               class="text-primary font-bold hover:text-primary-hover transition-colors">
                                {{ $competition->federation->name }}
                            </a>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-background rounded-lg">
                            <span class="text-sm text-muted-foreground font-semibold uppercase tracking-wide">{{ __('Format') }}</span>
                            <span class="inline-flex items-center px-3 py-1 bg-primary/10 text-primary border border-primary/30 rounded text-xs font-bold uppercase">
                                {{ ucfirst($competition->format) }}
                            </span>
                        </div>
                        @if($competition->prize_money)
                            <div class="flex items-center justify-between p-4 bg-background rounded-lg">
                                <span class="text-sm text-muted-foreground font-semibold uppercase tracking-wide">{{ __('Prize Money') }}</span>
                                <span class="font-display text-2xl font-bold text-accent">
                                    ${{ number_format($competition->prize_money) }}
                                </span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Seasons -->
                <div class="bg-card rounded-xl border border-card-border p-6 hover:shadow-lg hover:border-border-strong transition-all">
                    <h3 class="font-display text-2xl font-bold text-foreground mb-6 flex items-center gap-3">
                        <span>📅</span>
                        {{ __('Saisons') }}
                    </h3>
                    @if($competition->seasons->count() > 0)
                        <div class="space-y-3">
                            @foreach($competition->seasons as $season)
                                <div class="p-4 bg-background rounded-lg border-l-4 border-primary hover:bg-muted/50 transition-colors">
                                    <div class="font-display text-xl font-bold text-foreground mb-1">
                                        {{ $season->year }}
                                    </div>
                                    <div class="text-sm text-muted-foreground">
                                        {{ $season->start_date?->format('d/m/Y') }} - {{ $season->end_date?->format('d/m/Y') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted-foreground italic">
                            {{ __('Aucune saison disponible.') }}
                        </p>
                    @endif
                </div>
            </div>

            <!-- Back Button -->
            <div class="text-center">
                <a href="{{ route('competitions.index') }}" class="inline-flex items-center gap-3 px-6 py-3 bg-card text-foreground border border-border rounded-lg font-semibold hover:bg-muted hover:border-primary transition-all hover:-translate-y-0.5 shadow-sm">
                    <span class="text-xl">←</span>
                    {{ __('Retour aux compétitions') }}
                </a>
            </div>
        </div>
    </div>
@endsection
