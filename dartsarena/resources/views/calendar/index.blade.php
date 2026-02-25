@extends('layouts.app')

@section('title', __('Darts Calendar 2026') . ' - DartsArena')

@section('breadcrumbs')
    <div class="breadcrumbs py-3">
        <a href="{{ route('home') }}">{{ __('Home') }}</a>
        <span class="text-muted-foreground mx-2">/</span>
        <span class="text-foreground">{{ __('Calendar') }}</span>
    </div>
@endsection

@section('content')
<div class="bg-muted py-8 lg:py-12"
     x-data="{
         selectedMonth: '{{ request('month', 'all') }}',
         selectedFederation: '{{ request('federation', 'all') }}',
         currentMonth: {{ $currentMonth }},
         currentYear: {{ $currentYear }},
         applyFilters() {
             const params = new URLSearchParams();
             params.set('month', this.currentMonth);
             params.set('year', this.currentYear);
             if (this.selectedFederation !== 'all') params.set('federation', this.selectedFederation);
             window.location.search = params.toString();
         },
         previousMonth() {
             if (this.currentMonth === 1) {
                 this.currentMonth = 12;
                 this.currentYear--;
             } else {
                 this.currentMonth--;
             }
             this.applyFilters();
         },
         nextMonth() {
             if (this.currentMonth === 12) {
                 this.currentMonth = 1;
                 this.currentYear++;
             } else {
                 this.currentMonth++;
             }
             this.applyFilters();
         }
     }">

    <div class="container">
        {{-- Header --}}
        <div class="mb-8">
            <h1 class="font-display text-4xl lg:text-5xl font-bold text-foreground mb-3">
                {{ __('Darts Calendar') }} {{ $currentYear }}
            </h1>
            <p class="text-lg text-muted-foreground">
                {{ __('All PDC, WDF & BDO tournaments and events') }}
            </p>
        </div>

        {{-- Filtres --}}
        <div class="flex gap-3 mb-8 flex-wrap items-center">
            {{-- Mois --}}
            <select x-model="selectedMonth"
                    @change="applyFilters"
                    class="px-4 py-2.5 rounded-[var(--radius-base)] border border-border bg-card text-foreground font-medium text-sm hover:bg-muted transition-colors focus:ring-2 focus:ring-primary focus:outline-none">
                <option value="all">{{ __('All months') }}</option>
                @foreach(range(1, 12) as $month)
                    <option value="{{ $month }}" {{ $currentMonth == $month && request('month') !== 'all' ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }}
                    </option>
                @endforeach
            </select>

            {{-- Fédération --}}
            <div class="flex gap-2">
                <button @click="selectedFederation = 'all'; applyFilters()"
                        :class="selectedFederation === 'all' ? 'bg-primary text-primary-foreground' : 'bg-card border border-border text-foreground hover:bg-muted'"
                        class="px-4 py-2.5 rounded-[var(--radius-base)] font-semibold text-sm transition-colors">
                    {{ __('All') }}
                </button>
                <button @click="selectedFederation = 'pdc'; applyFilters()"
                        :class="selectedFederation === 'pdc' ? 'bg-primary text-primary-foreground' : 'bg-card border border-border text-foreground hover:bg-muted'"
                        class="px-4 py-2.5 rounded-[var(--radius-base)] font-semibold text-sm transition-colors">
                    PDC
                </button>
                <button @click="selectedFederation = 'wdf'; applyFilters()"
                        :class="selectedFederation === 'wdf' ? 'bg-primary text-primary-foreground' : 'bg-card border border-border text-foreground hover:bg-muted'"
                        class="px-4 py-2.5 rounded-[var(--radius-base)] font-semibold text-sm transition-colors">
                    WDF
                </button>
                <button @click="selectedFederation = 'bdo'; applyFilters()"
                        :class="selectedFederation === 'bdo' ? 'bg-primary text-primary-foreground' : 'bg-card border border-border text-foreground hover:bg-muted'"
                        class="px-4 py-2.5 rounded-[var(--radius-base)] font-semibold text-sm transition-colors">
                    BDO
                </button>
            </div>
        </div>

        {{-- Vue Calendrier (Desktop) --}}
        <section class="hidden lg:block mb-12">
            <div class="bg-card rounded-[var(--radius-lg)] border border-border p-6 shadow-sm">
                {{-- Header mois --}}
                <div class="flex items-center justify-between mb-6">
                    <button @click="previousMonth"
                            class="p-2 hover:bg-muted rounded-[var(--radius-base)] transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <h2 class="font-display font-bold text-2xl">
                        {{ $calendarDate->translatedFormat('F Y') }}
                    </h2>
                    <button @click="nextMonth"
                            class="p-2 hover:bg-muted rounded-[var(--radius-base)] transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>

                {{-- Grid calendrier 7 cols --}}
                <div class="grid grid-cols-7 gap-2">
                    {{-- Headers jours --}}
                    @foreach(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $day)
                        <div class="text-center font-bold text-sm p-2 text-muted-foreground">
                            {{ __($day) }}
                        </div>
                    @endforeach

                    {{-- Empty cells for offset (0=Sunday, 1=Monday) --}}
                    @php
                        $offset = $firstDayOfWeek === 0 ? 6 : $firstDayOfWeek - 1;
                    @endphp
                    @for($i = 0; $i < $offset; $i++)
                        <div class="aspect-square border border-border/50 rounded-[var(--radius-base)] p-2 bg-muted/30"></div>
                    @endfor

                    {{-- Dates + events --}}
                    @for($day = 1; $day <= $daysInMonth; $day++)
                        @php
                            $dayEvents = $eventsByDay->get($day, collect());
                            $isToday = $calendarDate->copy()->day($day)->isToday();
                        @endphp
                        <div class="aspect-square border rounded-[var(--radius-base)] p-2 hover:bg-muted/50 cursor-pointer transition-colors {{ $isToday ? 'border-primary bg-primary/5' : 'border-border' }}"
                             title="{{ $dayEvents->pluck('title')->join(', ') }}">
                            <div class="text-sm font-semibold {{ $isToday ? 'text-primary' : 'text-foreground' }}">
                                {{ $day }}
                            </div>
                            {{-- Dots pour events --}}
                            @if($dayEvents->count() > 0)
                                <div class="flex gap-1 mt-1 flex-wrap">
                                    @foreach($dayEvents->take(3) as $event)
                                        <span class="w-2 h-2 rounded-full"
                                              style="background-color: {{ $event->competition?->federation?->slug === 'pdc' ? 'hsl(var(--primary))' : ($event->competition?->federation?->slug === 'wdf' ? 'hsl(var(--accent))' : 'hsl(var(--muted-foreground))') }}"
                                              title="{{ $event->title }}"></span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endfor
                </div>
            </div>
        </section>

        {{-- Tableau SEO (HTML table) --}}
        <section class="bg-card rounded-[var(--radius-lg)] border border-border overflow-hidden shadow-sm">
            <div class="p-6 border-b border-border">
                <h2 class="font-display text-2xl font-bold">
                    {{ __('Tournaments Schedule') }}
                </h2>
                <p class="text-sm text-muted-foreground mt-1">
                    {{ $filteredEvents->count() }} {{ __('events found') }}
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-muted/50 border-b border-border">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-bold text-foreground">{{ __('Date') }}</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-foreground">{{ __('Tournament') }}</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-foreground">{{ __('Federation') }}</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-foreground">{{ __('Venue') }}</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-foreground">{{ __('Status') }}</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-foreground">{{ __('Tickets') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border">
                        @forelse($filteredEvents as $event)
                            <tr class="hover:bg-muted/30 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-foreground">
                                        {{ $event->start_date->format('d M Y') }}
                                    </div>
                                    @if($event->start_date->format('Y-m-d') !== $event->end_date->format('Y-m-d'))
                                        <div class="text-xs text-muted-foreground">
                                            {{ __('to') }} {{ $event->end_date->format('d M Y') }}
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($event->competition)
                                        <a href="{{ route('competitions.show', $event->competition->slug) }}"
                                           class="font-bold text-foreground hover:text-primary transition-colors">
                                            {{ $event->title }}
                                        </a>
                                    @else
                                        <span class="font-bold text-foreground">{{ $event->title }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($event->competition?->federation)
                                        <x-badge-category category="tournament">
                                            {{ $event->competition->federation->name }}
                                        </x-badge-category>
                                    @else
                                        <span class="text-sm text-muted-foreground">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-muted-foreground flex items-center gap-2">
                                        <span>📍</span>
                                        <span>{{ $event->venue }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($event->end_date < now())
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-muted text-muted-foreground">
                                            {{ __('Finished') }}
                                        </span>
                                    @elseif($event->start_date <= now() && $event->end_date >= now())
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-500/10 text-green-700 dark:text-green-400">
                                            {{ __('Live') }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-primary/10 text-primary">
                                            {{ __('Upcoming') }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($event->ticket_url)
                                        <a href="{{ $event->ticket_url }}"
                                           target="_blank"
                                           rel="noopener"
                                           class="inline-flex items-center gap-2 px-3 py-1.5 bg-primary text-primary-foreground rounded-[var(--radius-base)] text-xs font-bold hover:bg-primary-hover transition-colors">
                                            <span>🎟️</span>
                                            <span>{{ __('Buy') }}</span>
                                        </a>
                                    @else
                                        <span class="text-xs text-muted-foreground">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="text-muted-foreground">
                                        <div class="text-4xl mb-3">📅</div>
                                        <p class="font-semibold">{{ __('No events found') }}</p>
                                        <p class="text-sm mt-1">{{ __('Try changing your filters') }}</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        {{-- Mobile Liste Cards (masqué sur desktop) --}}
        <section class="lg:hidden mt-8 space-y-4">
            @forelse($filteredEvents as $event)
                <div class="bg-card rounded-[var(--radius-lg)] border border-border p-5 shadow-sm">
                    <div class="flex items-start justify-between mb-3">
                        <div>
                            @if($event->competition)
                                <a href="{{ route('competitions.show', $event->competition->slug) }}"
                                   class="font-display text-lg font-bold text-foreground hover:text-primary">
                                    {{ $event->title }}
                                </a>
                            @else
                                <h3 class="font-display text-lg font-bold text-foreground">{{ $event->title }}</h3>
                            @endif
                        </div>
                        @if($event->end_date < now())
                            <span class="px-2 py-1 rounded-full text-xs font-semibold bg-muted text-muted-foreground">
                                {{ __('Finished') }}
                            </span>
                        @elseif($event->start_date <= now() && $event->end_date >= now())
                            <span class="px-2 py-1 rounded-full text-xs font-semibold bg-green-500/10 text-green-700">
                                {{ __('Live') }}
                            </span>
                        @else
                            <span class="px-2 py-1 rounded-full text-xs font-semibold bg-primary/10 text-primary">
                                {{ __('Upcoming') }}
                            </span>
                        @endif
                    </div>

                    <div class="space-y-2 text-sm">
                        <div class="flex items-center gap-2 text-muted-foreground">
                            <span>📅</span>
                            <span>{{ $event->start_date->format('d M Y') }} - {{ $event->end_date->format('d M Y') }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-muted-foreground">
                            <span>📍</span>
                            <span>{{ $event->venue }}</span>
                        </div>
                        @if($event->competition?->federation)
                            <div class="flex items-center gap-2">
                                <x-badge-category category="tournament">
                                    {{ $event->competition->federation->name }}
                                </x-badge-category>
                            </div>
                        @endif
                    </div>

                    @if($event->ticket_url)
                        <a href="{{ $event->ticket_url }}"
                           target="_blank"
                           rel="noopener"
                           class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-primary-foreground rounded-[var(--radius-base)] text-sm font-bold hover:bg-primary-hover transition-colors mt-4">
                            <span>🎟️</span>
                            <span>{{ __('Buy Tickets') }}</span>
                        </a>
                    @endif
                </div>
            @empty
                <div class="bg-card rounded-[var(--radius-lg)] border border-border p-12 text-center">
                    <div class="text-muted-foreground">
                        <div class="text-4xl mb-3">📅</div>
                        <p class="font-semibold">{{ __('No events found') }}</p>
                        <p class="text-sm mt-1">{{ __('Try changing your filters') }}</p>
                    </div>
                </div>
            @endforelse
        </section>
    </div>
</div>
@endsection
