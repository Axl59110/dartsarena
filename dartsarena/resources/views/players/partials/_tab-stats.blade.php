{{-- TAB CONTENT: STATS V2 — Texte narratif + 4 graphiques --}}
<div x-show="activeTab === 'stats'" x-transition role="tabpanel">

<style>
/* ---- STATS V2 ---- */
.ts-narrative {
    font-family: 'Inter Variable', 'Inter', -apple-system, sans-serif;
    font-size: 1rem;
    color: #334155;
    line-height: 1.85;
    margin: 0;
}
.ts-narrative strong { color: #0f172a; font-weight: 700; }
.ts-stat-red {
    font-family: 'Inter Tight Variable', 'Inter Tight', sans-serif;
    font-weight: 900;
    color: #ef4444;
}
.ts-stat-gold {
    font-family: 'Inter Tight Variable', 'Inter Tight', sans-serif;
    font-weight: 900;
    color: #f59e0b;
}

/* Scoreboard 4 colonnes */
.ts-score-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
}
@media (max-width: 600px) {
    .ts-score-grid { grid-template-columns: repeat(2, 1fr); }
}
.ts-score-cell {
    padding: 24px 12px;
    text-align: center;
    border-right: 1px solid #1e293b;
}
.ts-score-cell:last-child { border-right: none; }
@media (max-width: 600px) {
    .ts-score-cell:nth-child(2) { border-right: none; }
    .ts-score-cell:nth-child(3) { border-top: 1px solid #1e293b; }
}
.ts-score-num {
    font-family: 'Inter Tight Variable', 'Inter Tight', sans-serif;
    font-weight: 900;
    font-size: clamp(1.8rem, 4vw, 2.8rem);
    line-height: 1;
    letter-spacing: -0.03em;
    margin-bottom: 6px;
}
.ts-score-lbl {
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.6rem;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    color: #475569;
}

/* Records */
.ts-record-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #1e293b;
}
.ts-record-item:last-child { border-bottom: none; }
.ts-record-key {
    display: flex;
    align-items: center;
    gap: 10px;
    font-family: 'Inter Variable', 'Inter', -apple-system, sans-serif;
    font-size: 0.85rem;
    color: #64748b;
}
.ts-record-icon {
    width: 32px; height: 32px;
    background: #1e293b;
    border-radius: 6px;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.85rem;
    flex-shrink: 0;
}
.ts-record-val {
    font-family: 'Inter Tight Variable', 'Inter Tight', sans-serif;
    font-weight: 900;
    font-size: 1.4rem;
    letter-spacing: -0.02em;
}
</style>

@php
    $total   = $careerStats['total_matches'] ?? 0;
    $wins    = $careerStats['wins'] ?? 0;
    $losses  = $careerStats['losses'] ?? 0;
    $wr      = $careerStats['win_rate'] ?? 0;
    $avg     = $careerStats['avg_average'] ?? 0;
    $co      = $careerStats['avg_checkout'] ?? 0;
    $t180s   = $careerStats['total_180s'] ?? 0;
    $titles  = $player->career_titles ?? 0;
    $nine    = $player->career_9darters ?? 0;
    $bestAvg = $player->career_highest_average ?? 0;
    $nineTv  = isset($nineDarters) ? $nineDarters->where('on_tv', true)->count() : 0;

    $hasSeasons  = count($chartSeasons ?? []) > 1;
    $seasonsJson = json_encode($chartSeasons ?? []);
    $avgJson     = json_encode(array_values($chartAverages ?? []));
    $wrJson      = json_encode(array_values($chartWinRates ?? []));
    $d180Json    = json_encode(array_values($chart180s ?? []));
    $avgMean     = ($total > 0 && count($chartAverages ?? []) > 0)
                    ? round(array_sum($chartAverages) / count($chartAverages), 2)
                    : 0;
    $nineRaw  = $nine;
    $titlesRaw = $titles;
@endphp

<div style="display: flex; flex-direction: column; gap: 20px;">

    {{-- 1. TEXTE NARRATIF --}}
    @php
        $r = fn($v) => '<span class="ts-stat-red">'.$v.'</span>';
        $g = fn($v) => '<span class="ts-stat-gold">'.$v.'</span>';
        $pl = $player->full_name;
        $nick = $player->nickname ? ' (« '.$player->nickname.' »)' : '';
        $prenom = explode(' ', $pl)[0];
        $nat = $player->nationality ? ' de nationalité <strong>'.$player->nationality.'</strong>' : '';
        $natOrig = $player->nationality ? ' originaire de <strong>'.$player->nationality.'</strong>' : '';
        $nineSfx  = $nine > 1 ? 's' : '';
        $tvSfx    = $nineTv > 1 ? 's' : '';

        if ($total > 0) {
            $narrative  = '<strong>'.$pl.'</strong>'.$nick;
            $narrative .= ' a disputé '.$r($total).' match'.($total>1?'s':'');
            $narrative .= ' en carrière professionnelle, pour '.$r($wins).' victoire'.($wins>1?'s':'');
            $narrative .= ' et '.$r($losses).' défaite'.($losses>1?'s':'');
            $narrative .= ' — soit un taux de victoire de '.$r($wr.'%').'.';
            if ($t180s > 0) {
                $narrative .= ' Il totalise '.$g($t180s).' 180'.($t180s>1?'s':'').' au cours de sa carrière professionnelle.';
            }
            if ($nine > 0) {
                $narrative .= ' Sa précision légendaire lui a permis d\'inscrire '.$g($nine).' nine-darter'.$nineSfx.' parfait'.$nineSfx;
                if ($nineTv > 0) {
                    $narrative .= ', dont '.$g($nineTv).' diffusé'.$tvSfx.' en direct à la télévision';
                }
                $narrative .= '.';
            }
            if ($titles > 0) {
                $narrative .= ' Avec '.$g($titles).' titre'.($titles>1?'s':'').' remporté'.($titles>1?'s':'');
                if ($bestAvg > 0) {
                    $narrative .= ' et une meilleure moyenne enregistrée de '.$g($bestAvg);
                }
                $narrative .= ', '.$prenom.' s\'impose comme l\'un des joueurs les plus performants de sa génération.';
            }
        } elseif ($titles > 0 || $nine > 0) {
            $narrative  = '<strong>'.$pl.'</strong>'.$nick;
            $narrative .= ' est un joueur professionnel'.$nat.'.';
            if ($titles > 0) {
                $narrative .= ' Son palmarès compte '.$g($titles).' titre'.($titles>1?'s':'').' en carrière.';
            }
            if ($nine > 0) {
                $narrative .= ' Il a réalisé '.$g($nine).' nine-darter'.$nineSfx.' parfait'.$nineSfx;
                if ($nineTv > 0) {
                    $narrative .= ', dont '.$g($nineTv).' télévisé'.$tvSfx;
                }
                $narrative .= '.';
            }
            $narrative .= ' Les statistiques détaillées de matchs seront disponibles dès l\'intégration des données de compétition.';
        } else {
            $narrative  = '<strong>'.$pl.'</strong>';
            $narrative .= ' est un joueur professionnel de fléchettes'.$natOrig.'.';
            $narrative .= ' Les statistiques de carrière seront disponibles prochainement via l\'intégration des données officielles PDC.';
        }
    @endphp
    <div class="pg-light-card" style="padding: 28px 32px;">
        <div class="pg-section-title">Résumé de Carrière</div>
        <p class="ts-narrative">{!! $narrative !!}</p>
    </div>

    {{-- 2. SCOREBOARD CARRIÈRE --}}
    @if($total > 0)
    <div class="pg-dark-card">
        <div style="padding: 20px 20px 0;">
            <div class="pg-section-title">Bilan Carrière</div>
        </div>
        <div class="ts-score-grid">
            <div class="ts-score-cell">
                <div class="ts-score-num" style="color:#94a3b8;">{{ $total }}</div>
                <div class="ts-score-lbl">Matchs</div>
            </div>
            <div class="ts-score-cell">
                <div class="ts-score-num" style="color:#ef4444;">{{ $wins }}</div>
                <div class="ts-score-lbl">Victoires</div>
            </div>
            <div class="ts-score-cell">
                <div class="ts-score-num" style="color:#475569;">{{ $losses }}</div>
                <div class="ts-score-lbl">Défaites</div>
            </div>
            <div class="ts-score-cell">
                <div class="ts-score-num" style="color:#f59e0b;">{{ $wr }}%</div>
                <div class="ts-score-lbl">Win Rate</div>
            </div>
        </div>
    </div>
    @endif

    {{-- 3 + 4 + 5. GRAPHIQUES (seulement si données saisonnières disponibles) --}}
    @if($hasSeasons)

    {{-- Courbe Moyenne — pleine largeur --}}
    <div class="pg-dark-card" style="padding: 24px;">
        <div class="pg-section-title">Évolution Moyenne par Saison</div>
        <div style="height: 240px; position: relative;">
            <canvas id="tsAvgChart"></canvas>
        </div>
    </div>

    {{-- Courbe Win Rate — pleine largeur --}}
    <div class="pg-dark-card" style="padding: 24px;">
        <div class="pg-section-title">Évolution Win Rate par Saison</div>
        <div style="height: 220px; position: relative;">
            <canvas id="tsWrChart"></canvas>
        </div>
    </div>

    {{-- 180s (barres) + Radar — côte à côte --}}
    <div class="pg-grid-2">
        <div class="pg-dark-card" style="padding: 24px;">
            <div class="pg-section-title">180s par Saison</div>
            <div style="height: 220px; position: relative;">
                <canvas id="ts180Chart"></canvas>
            </div>
        </div>
        <div class="pg-dark-card" style="padding: 24px;">
            <div class="pg-section-title">Profil de Performance</div>
            <div style="height: 220px; position: relative;">
                <canvas id="tsRadarChart"></canvas>
            </div>
        </div>
    </div>

    @endif

    {{-- 6. RECORDS PERSONNELS --}}
    @if($bestAvg > 0 || $co > 0 || $t180s > 0 || $nine > 0)
    <div class="pg-dark-card" style="padding: 20px 24px;">
        <div class="pg-section-title">Records Personnels</div>
        @if($bestAvg > 0)
        <div class="ts-record-item">
            <div class="ts-record-key">
                <div class="ts-record-icon">🎯</div>
                Meilleure moyenne en carrière
            </div>
            <div class="ts-record-val" style="color:#ef4444;">{{ $bestAvg }}</div>
        </div>
        @endif
        @if($co > 0)
        <div class="ts-record-item">
            <div class="ts-record-key">
                <div class="ts-record-icon">✅</div>
                Checkout moyen carrière
            </div>
            <div class="ts-record-val" style="color:#f59e0b;">{{ $co }}%</div>
        </div>
        @endif
        @if($t180s > 0)
        <div class="ts-record-item">
            <div class="ts-record-key">
                <div class="ts-record-icon">🔥</div>
                Total 180s en carrière
            </div>
            <div class="ts-record-val" style="color:#f59e0b;">{{ $t180s }}</div>
        </div>
        @endif
        @if($nine > 0)
        <div class="ts-record-item">
            <div class="ts-record-key">
                <div class="ts-record-icon">⚡</div>
                Nine-Darters parfaits
            </div>
            <div class="ts-record-val" style="color:#f59e0b;">{{ $nine }}</div>
        </div>
        @endif
    </div>
    @endif

</div>

@if($hasSeasons)
@push('scripts')
<script>
(function() {
    const seasons  = {!! $seasonsJson !!};
    const avgs     = {!! $avgJson !!};
    const winRates = {!! $wrJson !!};
    const d180s    = {!! $d180Json !!};

    const gridClr = 'rgba(30,41,59,0.8)';
    const tickClr = '#475569';
    const tickFont = { family: "'JetBrains Mono'", size: 10 };
    const tooltipBase = {
        backgroundColor: '#0d1424',
        borderColor: '#1e293b',
        borderWidth: 1,
        titleColor: '#64748b',
        bodyFont: { family: "'Inter Tight Variable','Inter Tight',sans-serif", weight: '700', size: 13 },
        padding: 10,
    };

    function grad(ctx, topColor, botColor) {
        const g = ctx.createLinearGradient(0, 0, 0, ctx.canvas.offsetHeight || 240);
        g.addColorStop(0, topColor);
        g.addColorStop(1, botColor);
        return g;
    }

    /* Courbe Moyenne */
    const avgEl = document.getElementById('tsAvgChart');
    if (avgEl) {
        const g = grad(avgEl.getContext('2d'), 'rgba(239,68,68,0.28)', 'rgba(239,68,68,0)');
        new Chart(avgEl, {
            type: 'line',
            data: { labels: seasons, datasets: [{ data: avgs, borderColor: '#ef4444', backgroundColor: g, borderWidth: 2.5, pointBackgroundColor: '#ef4444', pointRadius: 5, tension: 0.35, fill: true }] },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { display: false }, tooltip: { ...tooltipBase, callbacks: { label: c => ' ' + c.parsed.y.toFixed(2) } } },
                scales: {
                    x: { grid: { color: gridClr }, ticks: { color: tickClr, font: tickFont } },
                    y: { grid: { color: gridClr }, ticks: { color: tickClr, font: tickFont }, min: avgs.filter(v=>v>0).length ? Math.max(0, Math.min(...avgs.filter(v=>v>0)) - 5) : 0 }
                }
            }
        });
    }

    /* Courbe Win Rate */
    const wrEl = document.getElementById('tsWrChart');
    if (wrEl) {
        const g = grad(wrEl.getContext('2d'), 'rgba(245,158,11,0.22)', 'rgba(245,158,11,0)');
        new Chart(wrEl, {
            type: 'line',
            data: { labels: seasons, datasets: [{ data: winRates, borderColor: '#f59e0b', backgroundColor: g, borderWidth: 2.5, pointBackgroundColor: '#f59e0b', pointRadius: 5, tension: 0.35, fill: true }] },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { display: false }, tooltip: { ...tooltipBase, callbacks: { label: c => ' ' + c.parsed.y.toFixed(1) + '%' } } },
                scales: {
                    x: { grid: { color: gridClr }, ticks: { color: tickClr, font: tickFont } },
                    y: { grid: { color: gridClr }, ticks: { color: tickClr, font: tickFont, callback: v => v + '%' }, min: 0, max: 100 }
                }
            }
        });
    }

    /* Barres 180s */
    const d180El = document.getElementById('ts180Chart');
    if (d180El) {
        new Chart(d180El, {
            type: 'bar',
            data: { labels: seasons, datasets: [{ data: d180s, backgroundColor: 'rgba(245,158,11,0.7)', borderColor: '#f59e0b', borderWidth: 1, borderRadius: 4 }] },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { display: false }, tooltip: { ...tooltipBase } },
                scales: {
                    x: { grid: { color: gridClr }, ticks: { color: tickClr, font: tickFont } },
                    y: { grid: { color: gridClr }, ticks: { color: tickClr, font: tickFont }, beginAtZero: true }
                }
            }
        });
    }

    /* Radar */
    const radarEl = document.getElementById('tsRadarChart');
    if (radarEl) {
        const avgMean  = avgs.filter(v=>v>0).length ? avgs.filter(v=>v>0).reduce((a,b)=>a+b,0)/avgs.filter(v=>v>0).length : 0;
        const wrMean   = winRates.filter(v=>v>0).length ? winRates.filter(v=>v>0).reduce((a,b)=>a+b,0)/winRates.filter(v=>v>0).length : 0;
        const d180Mean = d180s.filter(v=>v>0).length ? d180s.filter(v=>v>0).reduce((a,b)=>a+b,0)/d180s.filter(v=>v>0).length : 0;
        const avgNorm    = Math.min(100, Math.round(avgMean / 1.15));
        const wrNorm     = Math.min(100, Math.round(wrMean));
        const d180Norm   = Math.min(100, Math.round(d180Mean / 2));
        const nineNorm   = Math.min(100, {{ $nineRaw }} * 12);
        const titlesNorm = Math.min(100, {{ $titlesRaw }} * 5);

        new Chart(radarEl, {
            type: 'radar',
            data: {
                labels: ['Moyenne', 'Win Rate', '180s/saison', '9-Darters', 'Titres'],
                datasets: [{ data: [avgNorm, wrNorm, d180Norm, nineNorm, titlesNorm], borderColor: '#ef4444', backgroundColor: 'rgba(239,68,68,0.12)', borderWidth: 2, pointBackgroundColor: '#ef4444', pointRadius: 4 }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { display: false }, tooltip: { ...tooltipBase } },
                scales: { r: { min: 0, max: 100, grid: { color: 'rgba(30,41,59,0.9)' }, angleLines: { color: 'rgba(30,41,59,0.9)' }, ticks: { display: false }, pointLabels: { color: '#64748b', font: { family: "'JetBrains Mono'", size: 10 } } } }
            }
        });
    }
})();
</script>
@endpush
@endif

</div>
