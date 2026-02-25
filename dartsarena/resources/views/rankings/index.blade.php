@extends('layouts.app')

@section('title', __('Classements') . ' - DartsArena')

@section('breadcrumbs')
    <div class="breadcrumbs py-3">
        <a href="{{ route('home') }}">{{ __('Accueil') }}</a>
        <span class="text-muted-foreground mx-2">/</span>
        <span class="text-foreground">{{ __('Classements') }}</span>
    </div>
@endsection

@section('content')
    {{-- Hero Section --}}
    <section class="bg-gradient-to-b from-muted/30 to-background">
        <div class="container py-12 lg:py-16">
            <h1 class="font-display text-4xl lg:text-5xl font-bold text-foreground mb-4">
                {{ __('Classements') }}
            </h1>
            <p class="text-lg text-muted-foreground max-w-3xl">
                {{ __('Les classements officiels des joueurs par fédération.') }}
            </p>
        </div>
    </section>

    <div class="container py-8 lg:py-12">
        {{-- Federation Filter --}}
        <x-card class="p-6 mb-8">
            <form method="GET" action="{{ route('rankings.index') }}">
                <label class="block text-sm font-semibold text-muted-foreground uppercase tracking-wide mb-3">
                    {{ __('Fédération') }}
                </label>
                <select name="federation" onchange="this.form.submit()" class="w-full max-w-md px-4 py-3 bg-background border border-border rounded-[var(--radius-base)] text-foreground font-semibold focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all cursor-pointer hover:border-primary">
                    @foreach($federations as $fed)
                        <option value="{{ $fed->slug }}" {{ $federation->slug === $fed->slug ? 'selected' : '' }}>
                            {{ $fed->name }}
                        </option>
                    @endforeach
                </select>
            </form>
        </x-card>

        {{-- Rankings Table --}}
        @if($rankings->count() > 0)
            <x-card class="overflow-hidden p-0">
                {{-- Table Header --}}
                <div class="hidden md:grid grid-cols-12 gap-4 px-6 py-4 bg-muted/50 border-b border-border text-xs font-bold text-muted-foreground uppercase tracking-wide">
                    <div class="col-span-1">#</div>
                    <div class="col-span-6">{{ __('Joueur') }}</div>
                    <div class="col-span-3 text-right">{{ __('Prize Money') }}</div>
                    <div class="col-span-2 text-center">{{ __('Évolution') }}</div>
                </div>

                {{-- Table Body --}}
                <div class="divide-y divide-border">
                    @foreach($rankings as $ranking)
                        <a href="{{ route('players.show', $ranking->player->slug) }}"
                           class="grid grid-cols-1 md:grid-cols-12 gap-4 px-6 py-4 hover:bg-muted/50 transition-colors group relative">
                            {{-- Hover Border Indicator --}}
                            <div class="absolute left-0 top-0 bottom-0 w-1 bg-primary transform scale-y-0 group-hover:scale-y-100 transition-transform"></div>

                            {{-- Rank --}}
                            <div class="col-span-1 flex items-center">
                                <div class="font-display text-2xl font-bold
                                    @if($ranking->position === 1) text-yellow-500
                                    @elseif($ranking->position === 2) text-gray-400
                                    @elseif($ranking->position === 3) text-orange-600
                                    @else text-primary
                                    @endif">
                                    {{ $ranking->position }}
                                </div>
                            </div>

                            {{-- Player Info --}}
                            <div class="col-span-6 flex items-center gap-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-muted to-border rounded-full flex items-center justify-center flex-shrink-0 border-2 border-border group-hover:border-primary transition-colors group-hover:scale-110 transition-transform">
                                    <span class="text-xl">🎯</span>
                                </div>
                                <div class="min-w-0">
                                    <div class="font-display text-lg font-bold text-foreground group-hover:text-primary transition-colors truncate">
                                        {{ $ranking->player->full_name }}
                                    </div>
                                    <div class="text-sm text-muted-foreground flex items-center gap-1">
                                        <span>🌍</span>
                                        {{ $ranking->player->nationality }}
                                    </div>
                                </div>
                            </div>

                            {{-- Prize Money --}}
                            <div class="col-span-3 flex items-center justify-start md:justify-end">
                                <span class="text-accent font-bold text-lg">
                                    ${{ number_format($ranking->prize_money) }}
                                </span>
                            </div>

                            {{-- Evolution Badge --}}
                            <div class="col-span-2 flex items-center justify-start md:justify-center">
                                @if($ranking->previous_position && $ranking->previous_position > $ranking->position)
                                    <div class="flex items-center gap-1 px-3 py-1 bg-success/10 text-success rounded-[var(--radius-base)] font-bold text-sm">
                                        <span class="text-lg">↑</span>
                                        <span>{{ $ranking->previous_position - $ranking->position }}</span>
                                    </div>
                                @elseif($ranking->previous_position && $ranking->previous_position < $ranking->position)
                                    <div class="flex items-center gap-1 px-3 py-1 bg-danger/10 text-danger rounded-[var(--radius-base)] font-bold text-sm">
                                        <span class="text-lg">↓</span>
                                        <span>{{ $ranking->position - $ranking->previous_position }}</span>
                                    </div>
                                @else
                                    <div class="text-muted-foreground font-semibold">—</div>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </x-card>
        @else
            <x-card class="p-12 text-center">
                <p class="text-muted-foreground">
                    {{ __('Aucun classement disponible.') }}
                </p>
            </x-card>
        @endif
    </div>
@endsection
