@extends('layouts.app')

@section('title', __('Calendrier') . ' - DartsArena')

@section('content')
    <section class="hero">
        <div class="container hero-content">
            <h1 class="animate-in">{{ __('Calendrier') }}</h1>
            <p class="animate-in" style="animation-delay: 0.1s;">{{ __('Tous les événements et dates des compétitions de fléchettes.') }}</p>
        </div>
    </section>

    <div class="container">
        <!-- Upcoming Events -->
        <h2 class="section-title">
            <span class="icon">🔜</span>
            {{ __('Événements à venir') }}
        </h2>

        @if($upcomingEvents->count() > 0)
            <div class="events-grid upcoming-section">
                @foreach($upcomingEvents as $index => $event)
                    <div class="event-card upcoming animate-in" style="animation-delay: {{ $index * 0.05 }}s;">
                        <div class="event-header">
                            <div class="event-badges">
                                <span class="event-badge upcoming-badge">{{ __('À venir') }}</span>
                                @if($event->competition)
                                    <span class="federation-tag">{{ $event->competition->federation->name }}</span>
                                @endif
                            </div>
                            @if($event->ticket_url)
                                <a href="{{ $event->ticket_url }}" target="_blank" class="ticket-button">
                                    <span class="ticket-icon">🎟️</span>
                                    <span class="ticket-text">{{ __('Billets') }}</span>
                                </a>
                            @endif
                        </div>

                        <h3 class="event-title">{{ $event->title }}</h3>

                        <div class="event-details">
                            <div class="event-detail">
                                <span class="detail-icon">📍</span>
                                <span class="detail-text">{{ $event->venue }}</span>
                            </div>
                            <div class="event-detail">
                                <span class="detail-icon">📅</span>
                                <span class="detail-text">
                                    {{ $event->start_date->format('d/m/Y') }} - {{ $event->end_date->format('d/m/Y') }}
                                </span>
                            </div>
                            <div class="event-detail">
                                <span class="detail-icon">⏳</span>
                                <span class="detail-text countdown">
                                    {{ __('Dans') }} {{ $event->start_date->diffForHumans() }}
                                </span>
                            </div>
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
            <h2 class="section-title" style="margin-top: 4rem;">
                <span class="icon">✅</span>
                {{ __('Événements passés') }}
            </h2>

            <div class="events-grid past-section">
                @foreach($pastEvents as $index => $event)
                    <div class="event-card past animate-in" style="animation-delay: {{ $index * 0.04 }}s;">
                        <div class="event-header">
                            <span class="event-badge finished-badge">{{ __('Terminé') }}</span>
                        </div>

                        <h3 class="event-title">{{ $event->title }}</h3>

                        <div class="event-details">
                            <div class="event-detail">
                                <span class="detail-icon">📍</span>
                                <span class="detail-text">{{ $event->venue }}</span>
                            </div>
                            <div class="event-detail">
                                <span class="detail-icon">📅</span>
                                <span class="detail-text">
                                    {{ $event->start_date->format('d/m/Y') }} - {{ $event->end_date->format('d/m/Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <style>
        .events-grid {
            display: grid;
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .event-card {
            background: var(--da-card);
            border: 1px solid var(--da-border);
            border-radius: 1rem;
            padding: 2rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .event-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--da-gradient-1);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .event-card.upcoming::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 40%;
            height: 100%;
            background: radial-gradient(circle at center, rgba(225, 29, 72, 0.08), transparent 70%);
            pointer-events: none;
        }

        .event-card:hover {
            transform: translateY(-4px);
            border-color: var(--da-primary);
            box-shadow: 0 15px 50px rgba(225, 29, 72, 0.2);
        }

        .event-card:hover::before {
            transform: scaleX(1);
        }

        .event-card.past {
            opacity: 0.75;
        }

        .event-card.past:hover {
            opacity: 1;
        }

        .event-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .event-badges {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .event-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .upcoming-badge {
            background: linear-gradient(135deg, rgba(251, 191, 36, 0.2), rgba(251, 191, 36, 0.1));
            color: var(--da-accent);
            border: 1px solid rgba(251, 191, 36, 0.4);
        }

        .finished-badge {
            background: rgba(74, 222, 128, 0.15);
            color: #4ADE80;
            border: 1px solid rgba(74, 222, 128, 0.3);
        }

        .federation-tag {
            padding: 0.4rem 0.85rem;
            background: rgba(225, 29, 72, 0.1);
            border: 1px solid rgba(225, 29, 72, 0.3);
            border-radius: 0.5rem;
            font-size: 0.7rem;
            font-weight: 600;
            color: var(--da-primary);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .ticket-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: var(--da-gradient-1);
            color: white;
            border-radius: 0.75rem;
            font-weight: 700;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(225, 29, 72, 0.3);
        }

        .ticket-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(225, 29, 72, 0.5);
        }

        .ticket-icon {
            font-size: 1.15rem;
        }

        .event-title {
            font-family: 'Bebas Neue', cursive;
            font-size: 1.75rem;
            letter-spacing: 0.05em;
            margin-bottom: 1.25rem;
            line-height: 1.2;
            color: white;
        }

        .event-details {
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
        }

        .event-detail {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .detail-icon {
            font-size: 1.25rem;
            width: 28px;
            flex-shrink: 0;
        }

        .detail-text {
            color: var(--da-text-muted);
            font-size: 0.95rem;
            font-weight: 500;
        }

        .detail-text.countdown {
            color: var(--da-accent);
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .event-card {
                padding: 1.5rem;
            }

            .event-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .ticket-button {
                width: 100%;
                justify-content: center;
            }

            .event-title {
                font-size: 1.5rem;
            }
        }
    </style>
@endsection
