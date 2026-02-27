{{-- TAB CONTENT: STATS --}}
<div x-show="activeTab === 'stats'" x-transition role="tabpanel">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Main Stats Column --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Performance Overview --}}
            <div class="holo-card rounded-xl p-8">
                <h2 class="font-gaming text-2xl text-white mb-8 uppercase tracking-wider flex items-center gap-3">
                    <span class="text-3xl">📊</span>
                    {{ __('Performance Overview') }}
                </h2>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                    <div class="text-center p-6 bg-slate-900/50 rounded-xl border border-white/5">
                        <div class="font-gaming text-5xl text-white mb-2">{{ $careerStats['total_matches'] ?? 0 }}</div>
                        <div class="text-xs text-slate-500 uppercase tracking-widest font-mono">{{ __('Matchs') }}</div>
                    </div>

                    <div class="text-center p-6 bg-green-900/20 rounded-xl border border-green-500/20">
                        <div class="font-gaming text-5xl text-green-400 mb-2">{{ $careerStats['wins'] ?? 0 }}</div>
                        <div class="text-xs text-slate-500 uppercase tracking-widest font-mono">{{ __('Victoires') }}</div>
                    </div>

                    <div class="text-center p-6 bg-red-900/20 rounded-xl border border-red-500/20">
                        <div class="font-gaming text-5xl text-red-400 mb-2">{{ $careerStats['losses'] ?? 0 }}</div>
                        <div class="text-xs text-slate-500 uppercase tracking-widest font-mono">{{ __('Défaites') }}</div>
                    </div>

                    <div class="text-center p-6 bg-blue-900/20 rounded-xl border border-blue-500/20">
                        <div class="font-gaming text-5xl text-blue-400 mb-2">{{ $careerStats['win_rate'] ?? 0 }}%</div>
                        <div class="text-xs text-slate-500 uppercase tracking-widest font-mono">{{ __('Win Rate') }}</div>
                    </div>
                </div>

                {{-- Advanced Stats Table --}}
                <div class="space-y-3">
                    <div class="flex justify-between items-center py-4 border-b border-white/10">
                        <span class="text-slate-400 font-mono uppercase text-sm tracking-wider">{{ __('Moyenne (Average)') }}</span>
                        <span class="font-gaming text-3xl text-white">{{ $careerStats['avg_average'] ?? '-' }}</span>
                    </div>

                    <div class="flex justify-between items-center py-4 border-b border-white/10">
                        <span class="text-slate-400 font-mono uppercase text-sm tracking-wider">{{ __('Checkout %') }}</span>
                        <span class="font-gaming text-3xl text-green-400">{{ $careerStats['avg_checkout'] ?? 0 }}%</span>
                    </div>

                    <div class="flex justify-between items-center py-4 border-b border-white/10">
                        <span class="text-slate-400 font-mono uppercase text-sm tracking-wider">{{ __('Total 180s') }}</span>
                        <span class="font-gaming text-3xl text-yellow-400">{{ $careerStats['total_180s'] ?? 0 }}</span>
                    </div>

                    @if($player->career_9darters > 0)
                    <div class="flex justify-between items-center py-4 border-b border-white/10">
                        <span class="text-slate-400 font-mono uppercase text-sm tracking-wider">{{ __('9-Darters en Carrière') }}</span>
                        <span class="font-gaming text-3xl text-primary">{{ $player->career_9darters }}</span>
                    </div>
                    @endif

                    @if($player->career_highest_average)
                    <div class="flex justify-between items-center py-4">
                        <span class="text-slate-400 font-mono uppercase text-sm tracking-wider">{{ __('Meilleure Moyenne') }}</span>
                        <span class="font-gaming text-3xl text-purple-400">{{ $player->career_highest_average }}</span>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Chart: Évolution Moyenne par Saison --}}
            @if(count($chartSeasons) > 1)
            <div class="holo-card rounded-xl p-8">
                <h2 class="font-gaming text-xl text-white mb-6 uppercase tracking-wider flex items-center gap-3">
                    <span class="text-2xl">📈</span>
                    {{ __('Évolution Moyenne par Saison') }}
                </h2>
                <div class="relative" style="height: 220px;">
                    <canvas id="chartAverage-{{ $player->id }}"></canvas>
                </div>
            </div>
            @endif

            {{-- Chart: 180s par Saison --}}
            @if(count($chartSeasons) > 1)
            <div class="holo-card rounded-xl p-8">
                <h2 class="font-gaming text-xl text-white mb-6 uppercase tracking-wider flex items-center gap-3">
                    <span class="text-2xl">🔥</span>
                    {{ __('180s par Saison') }}
                </h2>
                <div class="relative" style="height: 220px;">
                    <canvas id="chart180s-{{ $player->id }}"></canvas>
                </div>
            </div>
            @endif

        </div>

        {{-- Records Column --}}
        <div class="space-y-6">
            {{-- Career Highlights --}}
            <div class="holo-card rounded-xl p-6">
                <h3 class="font-gaming text-lg text-white mb-6 uppercase tracking-wider">{{ __('Records Personnels') }}</h3>
                <div class="space-y-4">
                    <div class="bg-gradient-to-r from-amber-900/30 to-transparent p-4 rounded-lg border-l-4 border-amber-500">
                        <div class="text-xs text-amber-300 uppercase tracking-widest font-mono mb-1">{{ __('Meilleure Moyenne') }}</div>
                        <div class="font-gaming text-3xl text-amber-400">{{ $player->career_highest_average ?? '-' }}</div>
                    </div>

                    <div class="bg-gradient-to-r from-purple-900/30 to-transparent p-4 rounded-lg border-l-4 border-purple-500">
                        <div class="text-xs text-purple-300 uppercase tracking-widest font-mono mb-1">{{ __('Total 9-Darters') }}</div>
                        <div class="font-gaming text-3xl text-purple-400">{{ $player->career_9darters }}</div>
                    </div>

                    <div class="bg-gradient-to-r from-blue-900/30 to-transparent p-4 rounded-lg border-l-4 border-blue-500">
                        <div class="text-xs text-blue-300 uppercase tracking-widest font-mono mb-1">{{ __('Titres Remportés') }}</div>
                        <div class="font-gaming text-3xl text-blue-400">{{ $player->career_titles }}</div>
                    </div>
                </div>
            </div>

            {{-- Saisons disponibles --}}
            @if(count($chartSeasons) > 0)
            <div class="holo-card rounded-xl p-6">
                <h3 class="font-gaming text-lg text-white mb-4 uppercase tracking-wider">{{ __('Par Saison') }}</h3>
                <div class="space-y-2">
                    @foreach(array_reverse($chartSeasons) as $idx => $season)
                    @php
                        $ridx = count($chartSeasons) - 1 - $idx;
                        $avg = $chartAverages[$ridx] ?? 0;
                        $s180 = $chart180s[$ridx] ?? 0;
                    @endphp
                    <div class="flex items-center justify-between py-2 border-b border-white/5 last:border-0">
                        <span class="font-gaming text-lg text-slate-300">{{ $season }}</span>
                        <div class="flex gap-4 text-sm font-mono">
                            @if($avg)
                                <span class="text-cyan-400">{{ $avg }}</span>
                            @endif
                            @if($s180)
                                <span class="text-yellow-400">{{ $s180 }}×180</span>
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

@if(count($chartSeasons) > 1)
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
(function() {
    const seasons = @json($chartSeasons);
    const averages = @json($chartAverages);
    const data180s = @json($chart180s);

    const chartDefaults = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false },
            tooltip: {
                backgroundColor: '#1e293b',
                borderColor: '#334155',
                borderWidth: 1,
                titleColor: '#f1f5f9',
                bodyColor: '#94a3b8',
                padding: 12,
            }
        },
        scales: {
            x: {
                grid: { color: 'rgba(255,255,255,0.05)' },
                ticks: { color: '#64748b', font: { family: 'monospace' } }
            },
            y: {
                grid: { color: 'rgba(255,255,255,0.05)' },
                ticks: { color: '#64748b', font: { family: 'monospace' } }
            }
        }
    };

    // Chart Moyenne
    const ctxAvg = document.getElementById('chartAverage-{{ $player->id }}');
    if (ctxAvg) {
        new Chart(ctxAvg, {
            type: 'line',
            data: {
                labels: seasons,
                datasets: [{
                    data: averages,
                    borderColor: '#06b6d4',
                    backgroundColor: 'rgba(6,182,212,0.1)',
                    borderWidth: 2,
                    pointBackgroundColor: '#06b6d4',
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    fill: true,
                    tension: 0.3,
                }]
            },
            options: {
                ...chartDefaults,
                scales: {
                    ...chartDefaults.scales,
                    y: {
                        ...chartDefaults.scales.y,
                        suggestedMin: Math.max(0, Math.min(...averages.filter(v => v > 0)) - 5),
                        suggestedMax: Math.max(...averages) + 5,
                    }
                }
            }
        });
    }

    // Chart 180s
    const ctx180 = document.getElementById('chart180s-{{ $player->id }}');
    if (ctx180) {
        new Chart(ctx180, {
            type: 'bar',
            data: {
                labels: seasons,
                datasets: [{
                    data: data180s,
                    backgroundColor: 'rgba(245,158,11,0.7)',
                    borderColor: '#f59e0b',
                    borderWidth: 1,
                    borderRadius: 6,
                    hoverBackgroundColor: 'rgba(245,158,11,0.9)',
                }]
            },
            options: {
                ...chartDefaults,
                scales: {
                    ...chartDefaults.scales,
                    y: {
                        ...chartDefaults.scales.y,
                        beginAtZero: true,
                        ticks: {
                            ...chartDefaults.scales.y.ticks,
                            stepSize: 1,
                        }
                    }
                }
            }
        });
    }
})();
</script>
@endpush
@endif
