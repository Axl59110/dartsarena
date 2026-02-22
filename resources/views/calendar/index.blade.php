@extends('layouts.app')

@section('title', __('Calendrier') . ' - DartsArena')

@section('content')
    <section class="hero">
        <div class="container">
            <h1>📅 {{ __('Calendrier') }}</h1>
            <p>{{ __('Tous les événements et dates des compétitions de fléchettes.') }}</p>
        </div>
    </section>

    <div class="container">
        <!-- Upcoming Events -->
        <h2 class="section-title">
            <span class="icon">🔜</span>
            {{ __('Événements à venir') }}
        </h2>

        @if($upcomingEvents->count() > 0)
            <div style="display: grid; gap: 1rem; margin-bottom: 3rem;">
                @foreach($upcomingEvents as $event)
                    <div class="card">
                        <div style="display: flex; justify-content: space-between; align-items: start; gap: 2rem;">
                            <div style="flex: 1;">
                                <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
                                    <span class="badge badge-upcoming">{{ __('À venir') }}</span>
                                    @if($event->competition)
                                        <span style="font-size: 0.75rem; color: var(--da-text-muted);">
                                            {{ $event->competition->federation->name }}
                                        </span>
                                    @endif
                                </div>
                                <h3 style="font-weight: 700; font-size: 1.25rem; margin-bottom: 0.5rem;">
                                    {{ $event->title }}
                                </h3>
                                <div style="color: var(--da-text-muted); font-size: 0.875rem; display: flex; flex-direction: column; gap: 0.25rem;">
                                    <div>📍 {{ $event->venue }}</div>
                                    <div>📅 {{ $event->start_date->format('d/m/Y') }} - {{ $event->end_date->format('d/m/Y') }}</div>
                                </div>
                            </div>
                            @if($event->ticket_url)
                                <a href="{{ $event->ticket_url }}" target="_blank"
                                   style="padding: 0.75rem 1.5rem; background: var(--da-primary); color: white; border-radius: 0.5rem; font-weight: 600; white-space: nowrap;">
                                    🎟️ {{ __('Billets') }}
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="card" style="text-align: center; margin-bottom: 3rem;">
                <p style="color: var(--da-text-muted);">
                    {{ __('Aucun événement à venir pour le moment.') }}
                </p>
            </div>
        @endif

        <!-- Past Events -->
        @if($pastEvents->count() > 0)
            <h2 class="section-title">
                <span class="icon">✅</span>
                {{ __('Événements passés') }}
            </h2>

            <div style="display: grid; gap: 1rem;">
                @foreach($pastEvents as $event)
                    <div class="card">
                        <div style="display: flex; justify-content: space-between; align-items: start;">
                            <div style="flex: 1;">
                                <div style="margin-bottom: 0.5rem;">
                                    <span class="badge badge-finished">{{ __('Terminé') }}</span>
                                </div>
                                <h3 style="font-weight: 700; margin-bottom: 0.5rem;">
                                    {{ $event->title }}
                                </h3>
                                <div style="color: var(--da-text-muted); font-size: 0.875rem;">
                                    📍 {{ $event->venue }} • 📅 {{ $event->start_date->format('d/m/Y') }} - {{ $event->end_date->format('d/m/Y') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
