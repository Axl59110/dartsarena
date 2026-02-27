{{-- TAB CONTENT: STATS --}}
<div x-show="activeTab === 'stats'" x-transition role="tabpanel">
    <div style="display:grid; grid-template-columns:1fr; gap:24px;">
        <style>@media(min-width:1024px){ .stats-grid { grid-template-columns:1fr 300px !important; } }</style>
        <div class="stats-grid" style="display:grid; grid-template-columns:1fr; gap:24px;">

            {{-- Colonne principale --}}
            <div style="display:flex; flex-direction:column; gap:20px;">

                {{-- Vue d'ensemble --}}
                <div class="pg-card" style="padding:32px;">
                    <h2 style="font-family:'Archivo Black',sans-serif; font-size:1.2rem; color:#f1f5f9;
                               text-transform:uppercase; letter-spacing:0.06em; margin:0 0 24px;
                               display:flex; align-items:center; gap:10px;">
                        📊 {{ __('Statistiques Carrière') }}
                    </h2>

                    {{-- 4 compteurs --}}
                    <div style="display:grid; grid-template-columns:repeat(2,1fr); gap:12px; margin-bottom:24px;">
                        <style>@media(min-width:640px){ .stats-kpis { grid-template-columns:repeat(4,1fr) !important; } }</style>
                        <div class="stats-kpis" style="display:grid; grid-template-columns:repeat(2,1fr); gap:12px; grid-column:1/-1;">
                            <div style="text-align:center; padding:20px 12px; background:#0f172a; border-radius:10px; border:1px solid #1e293b;">
                                <div style="font-family:'Archivo Black',sans-serif; font-size:2.5rem; color:#f1f5f9; line-height:1;">
                                    {{ $careerStats['total_matches'] ?? 0 }}
                                </div>
                                <div style="font-family:'JetBrains Mono',monospace; font-size:10px; color:#64748b;
                                            text-transform:uppercase; letter-spacing:0.06em; margin-top:6px;">
                                    {{ __('Matchs') }}
                                </div>
                            </div>
                            <div style="text-align:center; padding:20px 12px; background:#052e16; border-radius:10px; border:1px solid #14532d;">
                                <div style="font-family:'Archivo Black',sans-serif; font-size:2.5rem; color:#10b981; line-height:1;">
                                    {{ $careerStats['wins'] ?? 0 }}
                                </div>
                                <div style="font-family:'JetBrains Mono',monospace; font-size:10px; color:#64748b;
                                            text-transform:uppercase; letter-spacing:0.06em; margin-top:6px;">
                                    {{ __('Victoires') }}
                                </div>
                            </div>
                            <div style="text-align:center; padding:20px 12px; background:#450a0a; border-radius:10px; border:1px solid #7f1d1d;">
                                <div style="font-family:'Archivo Black',sans-serif; font-size:2.5rem; color:#ef4444; line-height:1;">
                                    {{ $careerStats['losses'] ?? 0 }}
                                </div>
                                <div style="font-family:'JetBrains Mono',monospace; font-size:10px; color:#64748b;
                                            text-transform:uppercase; letter-spacing:0.06em; margin-top:6px;">
                                    {{ __('Défaites') }}
                                </div>
                            </div>
                            <div style="text-align:center; padding:20px 12px; background:#1e3a5f; border-radius:10px; border:1px solid #1e40af;">
                                <div style="font-family:'Archivo Black',sans-serif; font-size:2.5rem; color:#60a5fa; line-height:1;">
                                    {{ $careerStats['win_rate'] ?? 0 }}%
                                </div>
                                <div style="font-family:'JetBrains Mono',monospace; font-size:10px; color:#64748b;
                                            text-transform:uppercase; letter-spacing:0.06em; margin-top:6px;">
                                    Win Rate
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Table stats --}}
                    <div>
                        <div class="stat-row">
                            <span class="stat-label">{{ __('Moyenne (Average)') }}</span>
                            <span style="font-family:'Archivo Black',sans-serif; font-size:1.75rem; color:#f1f5f9;">
                                {{ $careerStats['avg_average'] ?? '—' }}
                            </span>
                        </div>
                        <div class="stat-row">
                            <span class="stat-label">{{ __('Checkout %') }}</span>
                            <span style="font-family:'Archivo Black',sans-serif; font-size:1.75rem; color:#10b981;">
                                {{ $careerStats['avg_checkout'] ?? 0 }}%
                            </span>
                        </div>
                        <div class="stat-row">
                            <span class="stat-label">{{ __('Total 180s') }}</span>
                            <span style="font-family:'Archivo Black',sans-serif; font-size:1.75rem; color:#facc15;">
                                {{ $careerStats['total_180s'] ?? 0 }}
                            </span>
                        </div>
                        @if($player->career_9darters > 0)
                        <div class="stat-row">
                            <span class="stat-label">{{ __('9-Darters') }}</span>
                            <span style="font-family:'Archivo Black',sans-serif; font-size:1.75rem; color:#ef4444;">
                                {{ $player->career_9darters }}
                            </span>
                        </div>
                        @endif
                        @if($player->career_highest_average)
                        <div class="stat-row">
                            <span class="stat-label">{{ __('Meilleure Moyenne') }}</span>
                            <span style="font-family:'Archivo Black',sans-serif; font-size:1.75rem; color:#a78bfa;">
                                {{ $player->career_highest_average }}
                            </span>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Chart: Évolution Moyenne --}}
                @if(count($chartSeasons) > 1)
                <div class="pg-card" style="padding:28px;">
                    <h2 style="font-family:'Archivo Black',sans-serif; font-size:1rem; color:#f1f5f9;
                               text-transform:uppercase; letter-spacing:0.06em; margin:0 0 20px;
                               display:flex; align-items:center; gap:10px;">
                        📈 {{ __('Évolution Moyenne par Saison') }}
                    </h2>
                    <div style="position:relative; height:200px;">
                        <canvas id="chartAverage-{{ $player->id }}"></canvas>
                    </div>
                </div>
                @endif

                {{-- Chart: 180s --}}
                @if(count($chartSeasons) > 1)
                <div class="pg-card" style="padding:28px;">
                    <h2 style="font-family:'Archivo Black',sans-serif; font-size:1rem; color:#f1f5f9;
                               text-transform:uppercase; letter-spacing:0.06em; margin:0 0 20px;
                               display:flex; align-items:center; gap:10px;">
                        🔥 {{ __('180s par Saison') }}
                    </h2>
                    <div style="position:relative; height:200px;">
                        <canvas id="chart180s-{{ $player->id }}"></canvas>
                    </div>
                </div>
                @endif

            </div>{{-- /colonne principale --}}

            {{-- Colonne records --}}
            <div style="display:flex; flex-direction:column; gap:16px;">
                <div class="pg-card" style="padding:24px;">
                    <h3 style="font-family:'Archivo Black',sans-serif; font-size:13px; color:#64748b;
                               text-transform:uppercase; letter-spacing:0.06em; margin:0 0 16px;">
                        {{ __('Records Personnels') }}
                    </h3>
                    <div style="display:flex; flex-direction:column; gap:10px;">
                        <div class="record-card" style="background:rgba(245,158,11,0.08); border-left-color:#f59e0b;">
                            <div class="record-label" style="color:#fbbf24;">{{ __('Meilleure Moyenne') }}</div>
                            <div class="record-value" style="color:#f59e0b;">{{ $player->career_highest_average ?? '—' }}</div>
                        </div>
                        <div class="record-card" style="background:rgba(167,139,250,0.08); border-left-color:#a78bfa;">
                            <div class="record-label" style="color:#c4b5fd;">{{ __('Total 9-Darters') }}</div>
                            <div class="record-value" style="color:#a78bfa;">{{ $player->career_9darters }}</div>
                        </div>
                        <div class="record-card" style="background:rgba(96,165,250,0.08); border-left-color:#60a5fa;">
                            <div class="record-label" style="color:#93c5fd;">{{ __('Titres Remportés') }}</div>
                            <div class="record-value" style="color:#60a5fa;">{{ $player->career_titles }}</div>
                        </div>
                    </div>
                </div>

                {{-- Table par saison (si données) --}}
                @if(count($chartSeasons) > 0)
                <div class="pg-card" style="padding:24px;">
                    <h3 style="font-family:'Archivo Black',sans-serif; font-size:13px; color:#64748b;
                               text-transform:uppercase; letter-spacing:0.06em; margin:0 0 14px;">
                        {{ __('Par Saison') }}
                    </h3>
                    <div>
                        @foreach(array_reverse($chartSeasons, true) as $idx => $season)
                        @php
                            $avg = $chartAverages[$idx] ?? 0;
                            $s180 = $chart180s[$idx] ?? 0;
                        @endphp
                        <div style="display:flex; justify-content:space-between; align-items:center;
                                    padding:10px 0; border-bottom:1px solid #1e293b;">
                            <span style="font-family:'Archivo Black',sans-serif; font-size:1rem; color:#94a3b8;">
                                {{ $season }}
                            </span>
                            <div style="display:flex; gap:12px; font-family:'JetBrains Mono',monospace; font-size:12px;">
                                @if($avg)
                                    <span style="color:#22d3ee;">{{ $avg }}</span>
                                @endif
                                @if($s180)
                                    <span style="color:#facc15;">{{ $s180 }}×🎯</span>
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
    const seasons   = @json($chartSeasons);
    const averages  = @json($chartAverages);
    const data180s  = @json($chart180s);

    const baseScales = {
        x: { grid: { color:'rgba(255,255,255,0.05)' }, ticks: { color:'#64748b', font:{ family:'JetBrains Mono, monospace', size:11 } } },
        y: { grid: { color:'rgba(255,255,255,0.05)' }, ticks: { color:'#64748b', font:{ family:'JetBrains Mono, monospace', size:11 } } }
    };

    const basePlugins = {
        legend: { display:false },
        tooltip: { backgroundColor:'#1e293b', borderColor:'#334155', borderWidth:1,
                   titleColor:'#f1f5f9', bodyColor:'#94a3b8', padding:10 }
    };

    const ctxAvg = document.getElementById('chartAverage-{{ $player->id }}');
    if (ctxAvg) {
        new Chart(ctxAvg, {
            type: 'line',
            data: { labels: seasons, datasets: [{
                data: averages,
                borderColor: '#22d3ee', backgroundColor: 'rgba(34,211,238,0.08)',
                borderWidth: 2, pointBackgroundColor: '#22d3ee',
                pointRadius: 5, pointHoverRadius: 7, fill: true, tension: 0.3,
            }]},
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: basePlugins,
                scales: { ...baseScales, y: { ...baseScales.y,
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
                backgroundColor: 'rgba(245,158,11,0.7)', borderColor: '#f59e0b',
                borderWidth: 1, borderRadius: 6, hoverBackgroundColor: 'rgba(245,158,11,0.9)',
            }]},
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: basePlugins,
                scales: { ...baseScales, y: { ...baseScales.y, beginAtZero: true } }
            }
        });
    }
})();
</script>
@endpush
@endif
