{{-- TAB CONTENT: MATCHS — Trading Card Premium --}}
<div x-show="activeTab === 'matchs'" x-transition role="tabpanel">

<style>
/* ---- MATCHS ---- */
.tm-panel {
    background: #0d1424;
    border: 1px solid #1e293b;
    border-radius: 14px;
    padding: 24px;
    position: relative;
    overflow: hidden;
}
.tm-panel::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, #ef4444, #f59e0b, #8b5cf6, #22d3ee);
}
.tm-label {
    font-family: 'JetBrains Mono', monospace;
    font-size: 9px;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: #475569;
    margin-bottom: 18px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.tm-label::after {
    content: '';
    flex: 1;
    height: 1px;
    background: linear-gradient(90deg, #1e293b, transparent);
}

/* Scoreboard forme */
.tm-form-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 10px;
    margin-bottom: 20px;
}
.tm-form-cell {
    background: #080e1a;
    border: 1px solid #1e293b;
    border-radius: 10px;
    padding: 16px 8px;
    text-align: center;
}
.tm-form-num {
    font-family: 'Archivo Black', sans-serif;
    font-size: 1.8rem;
    line-height: 1;
    margin-bottom: 4px;
}
.tm-form-lbl {
    font-family: 'JetBrains Mono', monospace;
    font-size: 8px;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: #334155;
}

/* Barre de forme W/L */
.tm-streak {
    display: flex;
    gap: 4px;
    flex-wrap: wrap;
    margin-bottom: 6px;
}
.tm-streak-dot {
    width: 28px;
    height: 28px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Archivo Black', sans-serif;
    font-size: 10px;
    color: white;
    flex-shrink: 0;
}
.tm-streak-dot.w { background: #10b981; }
.tm-streak-dot.l { background: #ef4444; }
.tm-streak-dot.d { background: #334155; }

/* Carte match */
.tm-match-card {
    background: #080e1a;
    border: 1px solid #1e293b;
    border-left: 3px solid transparent;
    border-radius: 10px;
    padding: 16px;
    display: flex;
    align-items: center;
    gap: 14px;
    transition: border-color 0.15s;
    flex-wrap: wrap;
}
.tm-match-card.win  { border-left-color: #10b981; }
.tm-match-card.loss { border-left-color: #ef4444; }
.tm-match-card:hover { border-color: rgba(255,255,255,0.1); }
.tm-match-card.win:hover  { border-left-color: #10b981; }
.tm-match-card.loss:hover { border-left-color: #ef4444; }

.tm-badge {
    width: 44px;
    height: 44px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Archivo Black', sans-serif;
    font-size: 1.1rem;
    color: white;
    flex-shrink: 0;
}
.tm-badge.win  { background: linear-gradient(135deg, #10b981, #059669); }
.tm-badge.loss { background: linear-gradient(135deg, #ef4444, #dc2626); }

.tm-match-info { flex: 1; min-width: 160px; }
.tm-match-vs {
    font-family: 'Archivo Black', sans-serif;
    font-size: 0.95rem;
    color: #f1f5f9;
    margin-bottom: 4px;
}
.tm-match-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    font-family: 'JetBrains Mono', monospace;
    font-size: 10px;
    color: #475569;
}
.tm-match-stat {
    display: flex;
    align-items: center;
    gap: 4px;
}

.tm-score {
    text-align: right;
    flex-shrink: 0;
}
.tm-score-main {
    font-family: 'Archivo Black', sans-serif;
    font-size: 1.5rem;
    line-height: 1;
}
.tm-score-sub {
    font-family: 'JetBrains Mono', monospace;
    font-size: 9px;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    margin-top: 2px;
}

/* Graphique */
.tm-chart-wrap {
    background: #080e1a;
    border: 1px solid #1e293b;
    border-radius: 10px;
    padding: 20px;
    height: 200px;
    position: relative;
}
</style>

@php
    $matchCount = $recentMatches ? $recentMatches->count() : 0;
    $wins   = 0;
    $losses = 0;
    $streak = [];
    $avgData = [];
    $labelData = [];

    if ($matchCount > 0) {
        foreach ($recentMatches as $m) {
            $won = $m->winner_id === $player->id;
            if ($won) $wins++; else $losses++;
            $streak[] = $won ? 'w' : 'l';

            $isP1 = $m->player1_id === $player->id;
            $avg  = $isP1 ? $m->player1_average : $m->player2_average;
            if ($avg) {
                $avgData[]   = round($avg, 2);
                $labelData[] = $m->scheduled_at?->format('d/m') ?? '—';
            }
        }
        $winRate = $matchCount > 0 ? round($wins / $matchCount * 100, 1) : 0;
    } else {
        $winRate = 0;
    }
    $avgDataJson   = json_encode($avgData);
    $labelDataJson = json_encode($labelData);
@endphp

@if($matchCount > 0)

<div style="display:flex; flex-direction:column; gap:16px;">

    {{-- Scoreboard forme --}}
    <div class="tm-panel">
        <div class="tm-label">Forme Récente · {{ $matchCount }} matchs</div>

        <div class="tm-form-grid">
            <div class="tm-form-cell">
                <div class="tm-form-num" style="color:#94a3b8;">{{ $matchCount }}</div>
                <div class="tm-form-lbl">Matchs</div>
            </div>
            <div class="tm-form-cell">
                <div class="tm-form-num" style="color:#10b981;">{{ $wins }}</div>
                <div class="tm-form-lbl">Victoires</div>
            </div>
            <div class="tm-form-cell">
                <div class="tm-form-num" style="color:#ef4444;">{{ $losses }}</div>
                <div class="tm-form-lbl">Défaites</div>
            </div>
            <div class="tm-form-cell" style="border-color:rgba(16,185,129,0.2);">
                <div class="tm-form-num" style="color:#10b981;">{{ $winRate }}%</div>
                <div class="tm-form-lbl">Win Rate</div>
            </div>
        </div>

        {{-- Barre W/L visuelle --}}
        <div style="margin-bottom:8px;">
            <div style="font-family:'JetBrains Mono',monospace; font-size:9px;
                        text-transform:uppercase; letter-spacing:0.12em; color:#334155; margin-bottom:8px;">
                Résultats récents →
            </div>
            <div class="tm-streak">
                @foreach(array_slice(array_reverse($streak), 0, 10) as $r)
                    <div class="tm-streak-dot {{ $r }}">{{ strtoupper($r) }}</div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Graphique évolution moyenne --}}
    @if(count($avgData) > 1)
    <div class="tm-panel">
        <div class="tm-label">Évolution Moyenne</div>
        <div class="tm-chart-wrap">
            <canvas id="tmAvgChart"></canvas>
        </div>
    </div>
    @endif

    {{-- Liste des matchs --}}
    <div class="tm-panel">
        <div class="tm-label">Liste des Matchs</div>
        <div style="display:flex; flex-direction:column; gap:8px;">
            @foreach($recentMatches as $match)
            @php
                $isPlayer1   = $match->player1_id === $player->id;
                $opponent    = $isPlayer1 ? $match->player2 : $match->player1;
                $playerScore = $match->best_of_sets
                    ? ($isPlayer1 ? $match->player1_score_sets  : $match->player2_score_sets)
                    : ($isPlayer1 ? $match->player1_score_legs  : $match->player2_score_legs);
                $oppScore    = $match->best_of_sets
                    ? ($isPlayer1 ? $match->player2_score_sets  : $match->player1_score_sets)
                    : ($isPlayer1 ? $match->player2_score_legs  : $match->player1_score_legs);
                $playerAvg   = $isPlayer1 ? $match->player1_average : $match->player2_average;
                $won         = $match->winner_id === $player->id;
            @endphp
            <div class="tm-match-card {{ $won ? 'win' : 'loss' }}">

                <div class="tm-badge {{ $won ? 'win' : 'loss' }}">
                    {{ $won ? 'W' : 'L' }}
                </div>

                <div class="tm-match-info">
                    <div class="tm-match-vs">
                        vs {{ $opponent?->full_name ?? '—' }}
                    </div>
                    <div class="tm-match-meta">
                        @if($match->scheduled_at)
                        <span class="tm-match-stat">
                            <span style="opacity:0.5;">📅</span>
                            {{ $match->scheduled_at->format('d/m/Y') }}
                        </span>
                        @endif
                        @if($match->season?->competition)
                        <span class="tm-match-stat">
                            <span style="opacity:0.5;">🏆</span>
                            {{ Str::limit($match->season->competition->name, 28) }}
                        </span>
                        @endif
                        @if($playerAvg)
                        <span class="tm-match-stat" style="color:#22d3ee;">
                            <span>AVG</span>
                            <span style="font-weight:700;">{{ number_format($playerAvg, 2) }}</span>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="tm-score">
                    <div class="tm-score-main"
                         style="color:{{ $won ? '#10b981' : '#f1f5f9' }};">
                        {{ $playerScore }}<span style="color:#334155; margin:0 3px;">–</span>{{ $oppScore }}
                    </div>
                    <div class="tm-score-sub">
                        {{ $match->best_of_sets ? 'Sets' : 'Legs' }}
                    </div>
                </div>

            </div>
            @endforeach
        </div>
    </div>

</div>

@push('scripts')
@if(count($avgData) > 1)
<script>
(function() {
    const ctx = document.getElementById('tmAvgChart');
    if (!ctx) return;
    const labels = {!! $labelDataJson !!};
    const data   = {!! $avgDataJson !!};
    const avg    = data.reduce((a, b) => a + b, 0) / data.length;

    const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 200);
    gradient.addColorStop(0, 'rgba(34,211,238,0.3)');
    gradient.addColorStop(1, 'rgba(34,211,238,0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels,
            datasets: [
                {
                    label: 'Moyenne',
                    data,
                    borderColor: '#22d3ee',
                    backgroundColor: gradient,
                    borderWidth: 2,
                    pointBackgroundColor: '#22d3ee',
                    pointRadius: 4,
                    tension: 0.35,
                    fill: true,
                },
                {
                    label: 'Moy. carrière',
                    data: Array(labels.length).fill(Math.round(avg * 100) / 100),
                    borderColor: 'rgba(245,158,11,0.5)',
                    borderWidth: 1,
                    borderDash: [5, 5],
                    pointRadius: 0,
                    fill: false,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#0d1424',
                    borderColor: '#1e293b',
                    borderWidth: 1,
                    titleColor: '#94a3b8',
                    bodyColor: '#22d3ee',
                    callbacks: {
                        label: ctx => ' ' + ctx.parsed.y.toFixed(2)
                    }
                }
            },
            scales: {
                x: {
                    grid: { color: 'rgba(30,41,59,0.6)' },
                    ticks: { color: '#475569', font: { family: "'JetBrains Mono'", size: 10 } }
                },
                y: {
                    grid: { color: 'rgba(30,41,59,0.6)' },
                    ticks: { color: '#475569', font: { family: "'JetBrains Mono'", size: 10 } },
                    min: Math.max(0, Math.min(...data) - 5),
                }
            }
        }
    });
})();
</script>
@endif
@endpush

@else

{{-- Aucun match --}}
<div class="tm-panel" style="text-align:center; padding:56px 24px;">
    <div style="font-size:3rem; opacity:0.1; margin-bottom:16px;">⚔️</div>
    <div style="font-family:'Archivo Black',sans-serif; font-size:1rem; color:#334155; margin-bottom:8px;">
        Aucun Match Disponible
    </div>
    <div style="font-family:'JetBrains Mono',monospace; font-size:11px; color:#1e293b; line-height:1.6;">
        Les matchs de ce joueur apparaîtront ici<br>dès l'intégration des données.
    </div>
</div>

@endif

</div>
