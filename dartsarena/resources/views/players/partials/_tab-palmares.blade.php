{{-- TAB CONTENT: PALMARÈS V2 — Compteur + Graphique + Timeline --}}
<div x-show="activeTab === 'palmares'" x-transition role="tabpanel">

<style>
/* ---- PALMARÈS V2 ---- */
.tp-counter-num {
    font-family: 'Inter Tight Variable', 'Inter Tight', sans-serif;
    font-weight: 900;
    font-size: clamp(4rem, 10vw, 6.5rem);
    color: #f59e0b;
    line-height: 1;
    letter-spacing: -0.04em;
    opacity: 0;
    transition: opacity 0.3s ease;
}
.tp-counter-num.visible { opacity: 1; }

.tp-badge-strip {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 20px;
}
.tp-mini-badge {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #1e293b;
    border: 1px solid #334155;
    border-radius: 6px;
    padding: 8px 14px;
}
.tp-mini-badge-num {
    font-family: 'Inter Tight Variable', 'Inter Tight', sans-serif;
    font-weight: 900;
    font-size: 1.15rem;
    line-height: 1;
}
.tp-mini-badge-lbl {
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.6rem;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: #64748b;
}

/* Timeline light */
.tp-timeline {
    position: relative;
    padding-left: 28px;
}
.tp-timeline::before {
    content: '';
    position: absolute;
    left: 7px; top: 6px; bottom: 6px;
    width: 2px;
    background: linear-gradient(to bottom, #ef4444, #e2e8f0 70%, transparent);
}
.tp-tl-item { position: relative; margin-bottom: 10px; }
.tp-tl-item:last-child { margin-bottom: 0; }
.tp-tl-dot {
    position: absolute;
    left: -24px; top: 50%;
    transform: translateY(-50%);
    width: 16px; height: 16px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 7px; color: white;
    border: 2px solid #f1f5f9;
}
.tp-tl-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 12px 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    transition: box-shadow 0.15s;
}
.tp-tl-card:hover { box-shadow: 0 3px 10px rgba(0,0,0,0.08); }
.tp-tl-title {
    font-family: 'Inter Tight Variable', 'Inter Tight', sans-serif;
    font-weight: 700;
    font-size: 0.88rem;
    color: #0f172a;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.tp-tl-sub {
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.62rem;
    color: #94a3b8;
    margin-top: 2px;
}
.tp-tl-year {
    font-family: 'Inter Tight Variable', 'Inter Tight', sans-serif;
    font-weight: 900;
    font-size: 1rem;
    color: #f59e0b;
    flex-shrink: 0;
}
.tp-coming {
    background: #f8fafc;
    border: 1px dashed #e2e8f0;
    border-radius: 8px;
    padding: 18px 22px;
    display: flex;
    align-items: center;
    gap: 14px;
    margin-top: 16px;
}
</style>

@php
    $titles  = $player->career_titles ?? 0;
    $nine    = $player->career_9darters ?? 0;
    $bestAvg = $player->career_highest_average ?? 0;
    $hasSeasons = count($chartSeasons ?? []) > 0;
    $seasonsJson = json_encode($chartSeasons ?? []);
    $wrJson = json_encode(array_values($chartWinRates ?? []));
@endphp

<div style="display: flex; flex-direction: column; gap: 20px;">

    {{-- 1. COMPTEUR HERO --}}
    <div class="pg-dark-card" style="padding: 40px 24px; text-align: center;">
        <div class="pg-mono-label" style="color:#4b5563; margin-bottom:12px; letter-spacing:0.18em;">
            DARTSARENA · PALMARÈS OFFICIEL
        </div>
        <div class="tp-counter-num" id="tpCounterNum">{{ $titles }}</div>
        <div style="font-family:'Inter Variable','Inter',sans-serif; font-size:0.85rem;
                    color:#475569; margin-top:8px; text-transform:uppercase; letter-spacing:0.08em;">
            Titres Remportés en Carrière
        </div>

        <div class="tp-badge-strip">
            @if($titles > 0)
            <div class="tp-mini-badge">
                <span style="font-size:1.1rem;">🏆</span>
                <div>
                    <div class="tp-mini-badge-num" style="color:#f59e0b;">{{ $titles }}</div>
                    <div class="tp-mini-badge-lbl">Titres</div>
                </div>
            </div>
            @endif
            @if($nine > 0)
            <div class="tp-mini-badge">
                <span style="font-size:1.1rem;">⚡</span>
                <div>
                    <div class="tp-mini-badge-num" style="color:#f59e0b;">{{ $nine }}</div>
                    <div class="tp-mini-badge-lbl">9-Darters</div>
                </div>
            </div>
            @endif
            @if($bestAvg > 0)
            <div class="tp-mini-badge">
                <span style="font-size:1.1rem;">🎯</span>
                <div>
                    <div class="tp-mini-badge-num" style="color:#ef4444; font-size:0.9rem;">{{ $bestAvg }}</div>
                    <div class="tp-mini-badge-lbl">Best Avg</div>
                </div>
            </div>
            @endif
        </div>
    </div>

    {{-- 2. GRAPHIQUE ACTIVITÉ PAR SAISON (pleine largeur) --}}
    @if($hasSeasons)
    <div class="pg-dark-card" style="padding: 24px;">
        <div class="pg-section-title">Activité par Saison (Win Rate)</div>
        <div style="height: 220px; position: relative;">
            <canvas id="tpSeasonChart"></canvas>
        </div>
    </div>
    @endif

    {{-- 3. TIMELINE VICTOIRES --}}
    <div class="pg-light-card" style="padding: 24px 28px;">
        <div class="pg-section-title">Chronologie des Victoires</div>

        @if($titles > 0)
        <div class="tp-timeline">
            @for($i = 0; $i < min($titles, 8); $i++)
            <div class="tp-tl-item">
                <div class="tp-tl-dot" style="background:{{ $i === 0 ? '#ef4444' : '#94a3b8' }};"></div>
                <div class="tp-tl-card">
                    <span style="font-size:1rem; flex-shrink:0;">{{ $i < 2 ? '🥇' : '🏆' }}</span>
                    <div style="flex:1; min-width:0;">
                        <div class="tp-tl-title">PDC Tour Event</div>
                        <div class="tp-tl-sub">Détails disponibles via API PDC</div>
                    </div>
                    <div class="tp-tl-year">—</div>
                </div>
            </div>
            @endfor

            @if($titles > 8)
            <div style="text-align:center; padding:14px 0 4px;">
                <span class="pg-mono-label" style="color:#94a3b8;">
                    + {{ $titles - 8 }} autres titres
                </span>
            </div>
            @endif
        </div>

        <div class="tp-coming">
            <div style="font-size:1.3rem; flex-shrink:0;">📡</div>
            <div>
                <div style="font-family:'Inter Tight Variable','Inter Tight',sans-serif;
                            font-weight:700; font-size:0.82rem; color:#64748b; margin-bottom:3px;">
                    Données détaillées en cours d'intégration
                </div>
                <div style="font-family:'Inter Variable','Inter',sans-serif;
                            font-size:0.78rem; color:#94a3b8; line-height:1.5;">
                    La chronologie complète (tournois, adversaires, prize money) sera
                    alimentée par l'API PDC officielle.
                </div>
            </div>
        </div>

        @else
        <div style="text-align:center; padding:40px 0;">
            <div style="font-size:2.5rem; opacity:0.1; margin-bottom:12px;">🏆</div>
            <div style="font-family:'Inter Tight Variable','Inter Tight',sans-serif;
                        font-weight:700; font-size:0.95rem; color:#94a3b8; margin-bottom:6px;">
                Aucun titre enregistré
            </div>
            <div style="font-family:'Inter Variable','Inter',sans-serif;
                        font-size:0.82rem; color:#cbd5e1; line-height:1.6;">
                Le palmarès sera disponible dès l'intégration des données PDC.
            </div>
        </div>
        @endif
    </div>

</div>

@push('scripts')
<script>
(function() {
    /* Compteur animé */
    const num = document.getElementById('tpCounterNum');
    if (num) {
        const target = parseInt(num.textContent.trim(), 10) || 0;
        num.classList.add('visible');
        if (target > 0) {
            let cur = 0;
            const step = Math.max(30, Math.ceil(800 / target));
            num.textContent = '0';
            const timer = setInterval(() => {
                cur++;
                num.textContent = cur;
                if (cur >= target) clearInterval(timer);
            }, step);
        }
    }

    @if($hasSeasons)
    /* Graphique activité saisons */
    const el = document.getElementById('tpSeasonChart');
    if (el) {
        const seasons  = {!! $seasonsJson !!};
        const winRates = {!! $wrJson !!};
        const gridClr  = 'rgba(30,41,59,0.8)';
        const tickClr  = '#475569';
        const tickFont = { family: "'JetBrains Mono'", size: 10 };
        new Chart(el, {
            type: 'bar',
            data: { labels: seasons, datasets: [{ data: winRates, backgroundColor: 'rgba(245,158,11,0.65)', borderColor: '#f59e0b', borderWidth: 1, borderRadius: 4 }] },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#0d1424', borderColor: '#1e293b', borderWidth: 1, titleColor: '#64748b',
                        bodyFont: { family: "'Inter Tight Variable','Inter Tight',sans-serif", weight: '700', size: 13 }, padding: 10,
                        callbacks: { label: c => ' Win Rate : ' + c.parsed.y + '%' }
                    }
                },
                scales: {
                    x: { grid: { color: gridClr }, ticks: { color: tickClr, font: tickFont } },
                    y: { grid: { color: gridClr }, ticks: { color: tickClr, font: tickFont, callback: v => v + '%' }, min: 0, max: 100 }
                }
            }
        });
    }
    @endif
})();
</script>
@endpush

</div>
