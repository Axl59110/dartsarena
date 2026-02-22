@extends('layouts.app')

@section('title', __('Classements') . ' - DartsArena')

@section('content')
    <section class="hero">
        <div class="container">
            <h1>📊 {{ __('Classements') }}</h1>
            <p>{{ __('Les classements officiels des joueurs par fédération.') }}</p>
        </div>
    </section>

    <div class="container">
        <!-- Filters -->
        <div class="card" style="margin-bottom: 2rem;">
            <form method="GET" action="{{ route('rankings.index') }}" style="display: flex; gap: 1rem; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 200px;">
                    <label style="display: block; font-size: 0.875rem; color: var(--da-text-muted); margin-bottom: 0.5rem;">
                        {{ __('Fédération') }}
                    </label>
                    <select name="federation" onchange="this.form.submit()"
                            style="width: 100%; padding: 0.5rem; background: var(--da-darker); border: 1px solid var(--da-border); border-radius: 0.5rem; color: white;">
                        @foreach($federations as $fed)
                            <option value="{{ $fed->slug }}" {{ $federation->slug === $fed->slug ? 'selected' : '' }}>
                                {{ $fed->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>

        <!-- Rankings Table -->
        @if($rankings->count() > 0)
            <div class="card">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="border-bottom: 2px solid var(--da-border);">
                            <th style="padding: 1rem; text-align: left; font-weight: 700; color: var(--da-text-muted); font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em;">
                                #
                            </th>
                            <th style="padding: 1rem; text-align: left; font-weight: 700; color: var(--da-text-muted); font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em;">
                                {{ __('Joueur') }}
                            </th>
                            <th style="padding: 1rem; text-align: right; font-weight: 700; color: var(--da-text-muted); font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em;">
                                {{ __('Prize Money') }}
                            </th>
                            <th style="padding: 1rem; text-align: center; font-weight: 700; color: var(--da-text-muted); font-size: 0.875rem; text-transform: uppercase; letter-spacing: 0.05em;">
                                {{ __('Évolution') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rankings as $ranking)
                            <tr style="border-bottom: 1px solid var(--da-border);">
                                <td style="padding: 1rem; font-weight: 700; font-size: 1.25rem; color: var(--da-primary);">
                                    {{ $ranking->position }}
                                </td>
                                <td style="padding: 1rem;">
                                    <a href="{{ route('players.show', $ranking->player->slug) }}"
                                       style="font-weight: 600; color: white;">
                                        {{ $ranking->player->full_name }}
                                    </a>
                                    <div style="color: var(--da-text-muted); font-size: 0.875rem;">
                                        🌍 {{ $ranking->player->nationality }}
                                    </div>
                                </td>
                                <td style="padding: 1rem; text-align: right; color: var(--da-accent); font-weight: 600;">
                                    ${{ number_format($ranking->prize_money) }}
                                </td>
                                <td style="padding: 1rem; text-align: center;">
                                    @if($ranking->previous_position && $ranking->previous_position > $ranking->position)
                                        <span style="color: #22c55e;">↑ {{ $ranking->previous_position - $ranking->position }}</span>
                                    @elseif($ranking->previous_position && $ranking->previous_position < $ranking->position)
                                        <span style="color: #ef4444;">↓ {{ $ranking->position - $ranking->previous_position }}</span>
                                    @else
                                        <span style="color: var(--da-text-muted);">—</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="card" style="text-align: center;">
                <p style="color: var(--da-text-muted);">
                    {{ __('Aucun classement disponible.') }}
                </p>
            </div>
        @endif
    </div>
@endsection
