{{-- TAB CONTENT: STATS — Trading Card Premium --}}
<div x-show="activeTab === 'stats'" x-transition role="tabpanel">

<style>
/* ---- STATS TAB ---- */
.ts-section-label {
    font-family: 'JetBrains Mono', monospace;
    font-size: 9px;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: #475569;
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.ts-section-label::after {
    content: '';
    flex: 1;
    height: 1px;
    background: linear-gradient(90deg, #1e293b, transparent);
}

/* Panneau principal "dos de carte" */
.ts-panel {
    background: #0d1424;
    border: 1px solid #1e293b;
    border-radius: 14px;
    overflow: hidden;
    position: relative;
}
.ts-panel::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, #ef4444, #f59e0b, #8b5cf6, #22d3ee);
}
.ts-panel-body { padding: 24px 24px 20px; }

/* Compteurs W/L/Total */
.ts-scoreboard {
    display: grid;
    grid-template-columns: 1fr 1px 1fr 1px 1fr 1px 1fr;
    gap: 0;
    background: #080e1a;
    border-radius: 10px;
    overflow: hidden;
    border: 1px solid #1e293b;
    margin-bottom: 24px;
}
.ts-score-sep {
    background: #1e293b;
    width: 1px;
    align-self: stretch;
}
.ts-score-cell {
    padding: 18px 8px;
    text-align: center;
}
.ts-score-val {
    font-family: 'Archivo Black', sans-serif;
    font-size: 2rem;
    line-height: 1;
    margin-bottom: 5px;
}
.ts-score-lbl {
    font-family: 'JetBrains Mono', monospace;
    font-size: 9px;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: #475569;
}

/* Métriques clés avec barres */
.ts-metric {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 14px 0;
    border-bottom: 1px solid #111827;
}
.ts-metric:last-child { border-bottom: none; }

.ts-metric-left {
    width: 130px;
    flex-shrink: 0;
}
.ts-metric-name {
    font-family: 'JetBrains Mono', monospace;
    font-size: 10px;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: #475569;
    margin-bottom: 3px;
}
.ts-metric-val {
    font-family: 'Archivo Black', sans-serif;
    font-size: 1.5rem;
    line-height: 1;
}
.ts-metric-bar-wrap {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 4px;
}
.ts-metric-bar-track {
    height: 4px;
    background: #1e293b;
    border-radius: 2px;
    overflow: hidden;
}
.ts-metric-bar-fill {
    height: 100%;
    border-radius: 2px;
    transition: width 1.2s cubic-bezier(0.4,0,0.2,1);
}
.ts-metric-context {
    font-family: 'JetBrains Mono', monospace;
    font-size: 9px;
    color: #334155;
    text-align: right;
}

/* Record cards — style "back of card attribute" */
.ts-record-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
    gap: 8px;
}
.ts-record {
    background: #080e1a;
    border: 1px solid #1e293b;
    border-radius: 10px;
    padding: 14px;
    text-align: center;
    position: relative;
    overflow: hidden;
}
.ts-record::after {
    content: '';
    position: absolute;
    bottom: 0; left: 20%; right: 20%;
    height: 1px;
    background: var(--rc, #334155);
    opacity: 0.5;
}
.ts-record-icon {
    font-size: 1.2rem;
    margin-bottom: 6px;
    display: block;
}
.ts-record-val {
    font-family: 'Archivo Black', sans-serif;
    font-size: 1.6rem;
    line-height: 1;
    margin-bottom: 4px;
}
.ts-record-lbl {
    font-family: 'JetBrains Mono', monospace;
    font-size: 8px;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: #475569;
}

/* Panneau graphique */
.ts-chart-panel {
    background: #0d1424;
    border: 1px solid #1e293b;
    border-radius: 14px;
    padding: 22px 22px 16px;
}
.ts-chart-title {
    font-family: 'Archivo Black', sans-serif;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: #64748b;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.ts-chart-tag {
    background: #111827;
    border: 1px solid #1e293b;
    border-radius: 4px;
    padding: 2px 8px;
    font-size: 9px;
    color: #334155;
}
</style>

<div style="display:grid; grid-template-columns:1fr; gap:20px;">
<style>@media(min-width:1024px){ .ts-layout { grid-template-columns: 1fr 280px !important; } }</style>
<div class="ts-layout" style="display:grid; grid-template-columns:1fr; gap:20px; align-items:start;">

    {{-- COLONNE PRINCIPALE --}}
    <div style="display:flex; flex-direction:column; gap:20px;">

        {{-- Panneau scores --}}
        <div class="ts-panel">
            <div class="ts-panel-body">
                <div class="ts-section-label">Bilan Carrière</div>
                <div class="ts-scoreboard">
                    <div class="ts-score-cell">
                        <div class="ts-score-val" style="color:#f1f5f9;">{{ $careerStats['total_matches'] ?? 0 }}</div>
                        <div class="ts-score-lbl">Matchs</div>
                    </div>
                    <div class="ts-score-sep"></div>
                    <div class="ts-score-cell">
                        <div class="ts-score-val" style="color:#10b981;">{{ $careerStats['wins'] ?? 0 }}</div>
                        <div class="ts-score-lbl">Victoires</div>
                    </div>
                    <div class="ts-score-sep"></div>
                    <div class="ts-score-cell">
                        <div class="ts-score-val" style="color:#ef4444;">{{ $careerStats['losses'] ?? 0 }}</div>
                        <div class="ts-score-lbl">Défaites</div>
                    </div>
                    <div class="ts-score-sep"></div>
                    <div class="ts-score-cell">
                        <div class="ts-score-val" style="color:#60a5fa;">{{ $careerStats['win_rate'] ?? 0 }}<span style="font-size:1rem;color:#334155;">%</span></div>
                        <div class="ts-score-lbl">Win Rate</div>
                    </div>
                </div>

                {{-- Métriques avec barres contextuelles --}}
                <div class="ts-section-label">Métriques de Performance</div>
                <div>
                    @php
                        // Barres contextualisées : les tops pros sont ~100+ avg, ~42% CO, beaucoup de 180s
                        $avgVal     = $careerStats['avg_average'] ?? 0;
                        $avgPct     = $avgVal > 0 ? min(100, round(($avgVal / 110) * 100)) : 0;
                        $coPct      = $careerStats['avg_checkout'] ?? 0;
                        $s180       = $careerStats['total_180s'] ?? 0;
                        $s180Pct    = min(100, round(($s180 / 500) * 100));
                        $highAvg    = $player->career_highest_average ?? 0;
                        $highAvgPct = $highAvg > 0 ? min(100, round(($highAvg / 120) * 100)) : 0;
                    @endphp

                    @if($avgVal > 0)
                    <div class="ts-metric">
                        <div class="ts-metric-left">
                            <div class="ts-metric-name">Average carrière</div>
                            <div class="ts-metric-val" style="color:#22d3ee;">{{ $avgVal }}</div>
                        </div>
                        <div class="ts-metric-bar-wrap">
                            <div class="ts-metric-bar-track">
                                <div class="ts-metric-bar-fill" style="width:{{ $avgPct }}%; background:linear-gradient(90deg,#0891b2,#22d3ee);"></div>
                            </div>
                            <div class="ts-metric-context">Top pro ~105+</div>
                        </div>
                    </div>
                    @endif

                    @if($coPct > 0)
                    <div class="ts-metric">
                        <div class="ts-metric-left">
                            <div class="ts-metric-name">Checkout %</div>
                            <div class="ts-metric-val" style="color:#10b981;">{{ $coPct }}%</div>
                        </div>
                        <div class="ts-metric-bar-wrap">
                            <div class="ts-metric-bar-track">
                                <div class="ts-metric-bar-fill" style="width:{{ min(100,$coPct * 2) }}%; background:linear-gradient(90deg,#059669,#10b981);"></div>
                            </div>
                            <div class="ts-metric-context">Elite ~40-45%</div>
                        </div>
                    </div>
                    @endif

                    @if($s180 > 0)
                    <div class="ts-metric">
                        <div class="ts-metric-left">
                            <div class="ts-metric-name">Total 180s</div>
                            <div class="ts-metric-val" style="color:#facc15;">{{ $s180 }}</div>
                        </div>
                        <div class="ts-metric-bar-wrap">
                            <div class="ts-metric-bar-track">
                                <div class="ts-metric-bar-fill" style="width:{{ $s180Pct }}%; background:linear-gradient(90deg,#b45309,#facc15);"></div>
                            </div>
                            <div class="ts-metric-context">Référence 500</div>
                        </div>
                    </div>
                    @endif

                    @if($highAvg > 0)
                    <div class="ts-metric">
                        <div class="ts-metric-left">
                            <div class="ts-metric-name">Meilleure moyenne</div>
                            <div class="ts-metric-val" style="color:#a78bfa;">{{ $highAvg }}</div>
                        </div>
                        <div class="ts-metric-bar-wrap">
                            <div class="ts-metric-bar-track">
                                <div class="ts-metric-bar-fill" style="width:{{ $highAvgPct }}%; background:linear-gradient(90deg,#7c3aed,#a78bfa);"></div>
                            </div>
                            <div class="ts-metric-context">Record mondial ~125+</div>
                        </div>
                    </div>
                    @endif

                    @if($player->career_9darters > 0)
                    <div class="ts-metric">
                        <div class="ts-metric-left">
                            <div class="ts-metric-name">9-Darters parfaits</div>
                            <div class="ts-metric-val" style="color:#ef4444;">{{ $player->career_9darters }}</div>
                        </div>
                        <div class="ts-metric-bar-wrap">
                            <div class="ts-metric-bar-track">
                                <div class="ts-metric-bar-fill" style="width:{{ min(100, $player->career_9darters * 10) }}%; background:linear-gradient(90deg,#b91c1c,#ef4444);"></div>
                            </div>
                            <div class="ts-metric-context">Extrêmement rare</div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Graphiques Chart.js --}}
        @if(count($chartSeasons) > 1)
        <div style="display:grid; grid-template-columns:1fr; gap:16px;">
            <style>@media(min-width:640px){ .ts-charts-grid { grid-template-columns:1fr 1fr !important; } }</style>
            <div class="ts-charts-grid" style="display:grid; grid-template-columns:1fr; gap:16px;">

                <div class="ts-chart-panel">
                    <div class="ts-chart-title">
                        Évolution Moyenne
                        <span class="ts-chart-tag">PAR SAISON</span>
                    </div>
                    <div style="position:relative; height:180px;">
                        <canvas id="chartAverage-{{ $player->id }}"></canvas>
                    </div>
                </div>

                <div class="ts-chart-panel">
                    <div class="ts-chart-title">
                        180s par Saison
                        <span class="ts-chart-tag">TOTAL</span>
                    </div>
                    <div style="position:relative; height:180px;">
                        <canvas id="chart180s-{{ $player->id }}"></canvas>
                    </div>
                </div>

            </div>
        </div>
        @endif

    </div>

    {{-- COLONNE RECORDS --}}
    <div style="display:flex; flex-direction:column; gap:16px;">

        <div class="ts-panel">
            <div class="ts-panel-body">
                <div class="ts-section-label">Records Personnels</div>
                <div class="ts-record-grid">
                    @if($player->career_highest_average)
                    <div class="ts-record" style="--rc:#f59e0b;">
                        <span class="ts-record-icon">🎯</span>
                        <div class="ts-record-val" style="color:#f59e0b;">{{ $player->career_highest_average }}</div>
                        <div class="ts-record-lbl">Best Avg</div>
                    </div>
                    @endif
                    <div class="ts-record" style="--rc:#10b981;">
                        <span class="ts-record-icon">🏆</span>
                        <div class="ts-record-val" style="color:#10b981;">{{ $player->career_titles }}</div>
                        <div class="ts-record-lbl">Titres</div>
                    </div>
                    <div class="ts-record" style="--rc:#a78bfa;">
                        <span class="ts-record-icon">⚡</span>
                        <div class="ts-record-val" style="color:#a78bfa;">{{ $player->career_9darters }}</div>
                        <div class="ts-record-lbl">9-Darters</div>
                    </div>
                    @if($careerStats['total_180s'] ?? 0)
                    <div class="ts-record" style="--rc:#facc15;">
                        <span class="ts-record-icon">🔥</span>
                        <div class="ts-record-val" style="color:#facc15;">{{ $careerStats['total_180s'] }}</div>
                        <div class="ts-record-lbl">180s</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Table par saison --}}
        @if(count($chartSeasons) > 0)
        <div class="ts-panel">
            <div class="ts-panel-body">
                <div class="ts-section-label">Détail par Saison</div>
                @foreach(array_reverse($chartSeasons, true) as $idx => $season)
                @php $avg = $chartAverages[$idx] ?? 0; $s180 = $chart180s[$idx] ?? 0; @endphp
                <div style="display:flex; justify-content:space-between; align-items:center;
                            padding:9px 0; border-bottom:1px solid #111827;">
                    <span style="font-family:'Archivo Black',sans-serif; font-size:1rem; color:#64748b;">{{ $season }}</span>
                    <div style="display:flex; align-items:center; gap:14px;">
                        @if($avg)
                        <span style="font-family:'JetBrains Mono',monospace; font-size:11px; color:#22d3ee;">
                            {{ $avg }}
                        </span>
                        @endif
                        @if($s180)
                        <span style="font-family:'JetBrains Mono',monospace; font-size:11px; color:#facc15;">
                            {{ $s180 }}×180
                        </span>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>

</div>
</div>
</div>

@if(count($chartSeasons) > 1)
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
(function() {
    const seasons  = @json($chartSeasons);
    const averages = @json($chartAverages);
    const data180s = @json($chart180s);

    const tooltip = {
        backgroundColor: '#111827',
        borderColor: '#1e293b',
        borderWidth: 1,
        titleColor: '#f1f5f9',
        bodyColor: '#64748b',
        padding: 10,
        cornerRadius: 8,
    };
    const scales = {
        x: { grid: { color:'rgba(255,255,255,0.04)' }, ticks: { color:'#334155', font:{ family:'JetBrains Mono, monospace', size:10 } } },
        y: { grid: { color:'rgba(255,255,255,0.04)' }, ticks: { color:'#334155', font:{ family:'JetBrains Mono, monospace', size:10 } } }
    };

    const ctxAvg = document.getElementById('chartAverage-{{ $player->id }}');
    if (ctxAvg) {
        new Chart(ctxAvg, {
            type: 'line',
            data: { labels: seasons, datasets: [{
                data: averages,
                borderColor: '#22d3ee',
                backgroundColor: (ctx) => {
                    const g = ctx.chart.ctx.createLinearGradient(0, 0, 0, 180);
                    g.addColorStop(0, 'rgba(34,211,238,0.15)');
                    g.addColorStop(1, 'rgba(34,211,238,0)');
                    return g;
                },
                borderWidth: 2,
                pointBackgroundColor: '#22d3ee',
                pointBorderColor: '#0d1424',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6,
                fill: true,
                tension: 0.4,
            }]},
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { display:false }, tooltip },
                scales: { ...scales, y: { ...scales.y,
                    suggestedMin: Math.max(0, Math.min(...averages.filter(v=>v>0)) - 5),
                    suggestedMax: Math.max(...averages) + 5,
                }}
            }
        });
    }

    const ctx180 = document.getElementById('chart180s-{{ $player->id }}');
    if (ctx180) {
        new Chart(ctx180, {
            type: 'bar',
            data: { labels: seasons, datasets: [{
                data: data180s,
                backgroundColor: (ctx) => {
                    const g = ctx.chart.ctx.createLinearGradient(0, 0, 0, 180);
                    g.addColorStop(0, 'rgba(250,204,21,0.8)');
                    g.addColorStop(1, 'rgba(180,83,9,0.6)');
                    return g;
                },
                borderColor: 'rgba(250,204,21,0.3)',
                borderWidth: 1,
                borderRadius: 5,
                borderSkipped: false,
            }]},
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { display:false }, tooltip },
                scales: { ...scales, y: { ...scales.y, beginAtZero: true } }
            }
        });
    }
})();
</script>
@endpush
@endif
