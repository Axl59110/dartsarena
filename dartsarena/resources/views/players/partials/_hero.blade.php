{{-- HERO — Trading Card Premium V2 --}}

@php
$flags = [
    'GB'=>'🇬🇧','EN'=>'🏴󠁧󠁢󠁥󠁮󠁧󠁿','SC'=>'🏴󠁧󠁢󠁳󠁣󠁴󠁿','WA'=>'🏴󠁧󠁢󠁷󠁬󠁳󠁿',
    'NL'=>'🇳🇱','AU'=>'🇦🇺','BE'=>'🇧🇪','DE'=>'🇩🇪','IE'=>'🇮🇪',
    'US'=>'🇺🇸','CA'=>'🇨🇦','NZ'=>'🇳🇿','ZA'=>'🇿🇦','AT'=>'🇦🇹',
];
$flag = $flags[strtoupper($player->country_code ?? '')] ?? '🌍';

$accentColors = [
    'EN'=>['from'=>'#b91c1c','to'=>'#991b1b'],
    'GB'=>['from'=>'#1d4ed8','to'=>'#1e3a8a'],
    'NL'=>['from'=>'#c2410c','to'=>'#9a3412'],
    'AU'=>['from'=>'#15803d','to'=>'#14532d'],
    'BE'=>['from'=>'#b45309','to'=>'#92400e'],
    'DE'=>['from'=>'#1d4ed8','to'=>'#1e3a8a'],
];
$accent = $accentColors[strtoupper($player->country_code ?? '')] ?? ['from'=>'#ef4444','to'=>'#b91c1c'];
$serialNumber = 'DA-' . str_pad($player->id * 7 % 9999, 4, '0', STR_PAD_LEFT);
@endphp

<div class="tc-hero">
    <div class="tc-hero-inner">

        {{-- ===== GAUCHE : LA CARTE ===== --}}
        <div class="tc-card-wrapper">
            <div class="tc-card" id="tcCard">

                <div class="tc-holo-overlay" id="tcHolo"></div>

                {{-- Header carte --}}
                <div class="tc-card-header" style="background:linear-gradient(135deg, {{ $accent['from'] }}, {{ $accent['to'] }});">
                    <span class="tc-series-label">DARTSARENA ELITE</span>
                    <span class="tc-serial">{{ $serialNumber }}</span>
                </div>

                {{-- Photo --}}
                <div class="tc-photo-zone">
                    @if($player->photo_url)
                        <img src="{{ $player->photo_url }}" alt="{{ $player->full_name }}" class="tc-photo">
                    @else
                        <div class="tc-photo-placeholder">
                            {{ strtoupper(substr($player->first_name,0,1)) }}{{ strtoupper(substr($player->last_name,0,1)) }}
                        </div>
                    @endif
                    <div class="tc-photo-gradient"></div>
                    @if($latestRanking)
                    <div class="tc-rank-badge">
                        <span class="tc-rank-num">{{ $latestRanking->position }}</span>
                        <span class="tc-rank-org">{{ $latestRanking->federation->abbreviation ?? 'PDC' }}</span>
                    </div>
                    @endif
                </div>

                {{-- Identité --}}
                <div class="tc-identity">
                    <div class="tc-country-line">
                        <span class="tc-flag">{{ $flag }}</span>
                        <span class="tc-nationality">{{ strtoupper($player->nationality ?? '') }}</span>
                        @if($player->date_of_birth)
                        <span class="tc-dot">·</span>
                        <span class="tc-age">{{ $player->date_of_birth->format('Y') }}</span>
                        @endif
                    </div>
                    <h1 class="tc-name">{{ strtoupper($player->full_name) }}</h1>
                    @if($player->nickname)
                    <div class="tc-nickname">"{{ $player->nickname }}"</div>
                    @endif
                </div>

                <div class="tc-divider"></div>

                {{-- Stats bas de carte --}}
                <div class="tc-stats-row">
                    <div class="tc-stat">
                        <div class="tc-stat-value">{{ $player->career_highest_average > 0 ? number_format($player->career_highest_average, 2) : '—' }}</div>
                        <div class="tc-stat-label">BEST AVG</div>
                    </div>
                    <div class="tc-stat-sep"></div>
                    <div class="tc-stat">
                        <div class="tc-stat-value">{{ $player->career_titles }}</div>
                        <div class="tc-stat-label">TITRES</div>
                    </div>
                    <div class="tc-stat-sep"></div>
                    <div class="tc-stat">
                        <div class="tc-stat-value" style="color:#f59e0b;">{{ $player->career_9darters }}</div>
                        <div class="tc-stat-label">9-DARTERS</div>
                    </div>
                </div>

            </div>
        </div>

        {{-- ===== DROITE : DASHBOARD ===== --}}
        <div class="tc-dashboard">

            {{-- Header --}}
            <div class="tc-dash-header">
                <div class="tc-dash-eyebrow">Fiche Joueur · DartsArena</div>
                <h2 class="tc-dash-name">{{ $player->full_name }}</h2>
                @if($player->nickname)
                <div class="tc-dash-nick">"{{ $player->nickname }}"</div>
                @endif
            </div>

            {{-- Bio courte --}}
            @if($player->bio)
            <p class="tc-dash-bio">{{ Str::limit($player->bio, 180) }}</p>
            @endif

            {{-- Stats + Highlights en une grille compacte --}}
            <div class="tc-stats-dashboard">

                {{-- Ligne 1 : 4 KPI compacts côte à côte --}}
                <div class="tc-kpi-row">
                    <div class="tc-kpi tc-kpi--green">
                        <div class="tc-kpi-top">
                            <span class="tc-kpi-val">{{ $careerStats['win_rate'] ?? 0 }}<span class="tc-kpi-unit">%</span></span>
                            <span class="tc-kpi-label">Win Rate</span>
                        </div>
                        <div class="tc-kpi-bar"><div class="tc-kpi-bar-fill" style="width:{{ $careerStats['win_rate'] ?? 0 }}%; background:#10b981;"></div></div>
                    </div>
                    <div class="tc-kpi tc-kpi--blue">
                        <div class="tc-kpi-top">
                            <span class="tc-kpi-val">{{ $careerStats['total_matches'] ?? 0 }}</span>
                            <span class="tc-kpi-label">Matchs</span>
                        </div>
                        <div class="tc-kpi-sub">
                            <span style="color:#4ade80;">{{ $careerStats['wins'] ?? 0 }}V</span>
                            <span style="color:#475569;"> — </span>
                            <span style="color:#f87171;">{{ $careerStats['losses'] ?? 0 }}D</span>
                        </div>
                    </div>
                    <div class="tc-kpi tc-kpi--cyan">
                        <div class="tc-kpi-top">
                            <span class="tc-kpi-val">{{ $careerStats['avg_average'] > 0 ? $careerStats['avg_average'] : '—' }}</span>
                            <span class="tc-kpi-label">Avg Carrière</span>
                        </div>
                        @if($player->career_highest_average > 0)
                        <div class="tc-kpi-sub">Best: <span style="color:#fbbf24;">{{ $player->career_highest_average }}</span></div>
                        @endif
                    </div>
                    <div class="tc-kpi tc-kpi--amber">
                        <div class="tc-kpi-top">
                            <span class="tc-kpi-val">{{ $careerStats['total_180s'] ?? 0 }}</span>
                            <span class="tc-kpi-label">Total 180s</span>
                        </div>
                        <div class="tc-kpi-sub">CO% {{ $careerStats['avg_checkout'] ?? 0 }}%</div>
                    </div>
                </div>

                {{-- Ligne 2 : highlights horizontaux --}}
                <div class="tc-hl-row">
                    @if($player->career_9darters > 0)
                    <div class="tc-hl-chip tc-hl-chip--red">
                        <span class="tc-hl-chip-val">{{ $player->career_9darters }}</span>
                        <span class="tc-hl-chip-sep"></span>
                        <span class="tc-hl-chip-text">9-Darter{{ $player->career_9darters > 1 ? 's' : '' }}</span>
                    </div>
                    @endif
                    @if($player->career_titles > 0)
                    <div class="tc-hl-chip tc-hl-chip--gold">
                        <span class="tc-hl-chip-val">{{ $player->career_titles }}</span>
                        <span class="tc-hl-chip-sep"></span>
                        <span class="tc-hl-chip-text">Titre{{ $player->career_titles > 1 ? 's' : '' }}</span>
                    </div>
                    @endif
                    @if($latestRanking)
                    <div class="tc-hl-chip tc-hl-chip--slate">
                        <span class="tc-hl-chip-val">#{{ $latestRanking->position }}</span>
                        <span class="tc-hl-chip-sep"></span>
                        <span class="tc-hl-chip-text">{{ $latestRanking->federation->name ?? 'PDC' }} World Rankings</span>
                    </div>
                    @endif
                </div>

            </div>

        </div>

    </div>
</div>

<style>
/* ============================================
   HERO — TRADING CARD PREMIUM V2
   ============================================ */

.tc-hero {
    background: #080e1a;
    overflow: hidden;
    position: relative;
    border-bottom: 1px solid #1e293b;
}

.tc-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse 80% 50% at 15% 50%, rgba(239,68,68,0.05) 0%, transparent 60%),
        radial-gradient(ellipse 60% 80% at 85% 30%, rgba(245,158,11,0.04) 0%, transparent 60%);
    pointer-events: none;
}

.tc-hero-inner {
    max-width: 1280px;
    margin: 0 auto;
    padding: 48px 24px 56px;
    display: grid;
    grid-template-columns: 1fr;
    gap: 40px;
    align-items: center;
}

@media (min-width: 900px) {
    .tc-hero-inner { grid-template-columns: 300px 1fr; gap: 56px; }
}
@media (min-width: 1100px) {
    .tc-hero-inner { grid-template-columns: 340px 1fr; }
}

/* ---- CARTE ---- */
.tc-card-wrapper {
    perspective: 1000px;
    display: flex;
    justify-content: center;
}

.tc-card {
    width: 100%;
    max-width: 300px;
    border-radius: 16px;
    overflow: hidden;
    position: relative;
    background: linear-gradient(145deg, #1a2540 0%, #0f1829 40%, #1a2540 100%);
    border: 1px solid rgba(255,255,255,0.1);
    box-shadow: 0 24px 48px rgba(0,0,0,0.6), 0 4px 12px rgba(0,0,0,0.4);
    transition: transform 0.1s ease, box-shadow 0.1s ease;
    transform-style: preserve-3d;
}

.tc-holo-overlay {
    position: absolute;
    inset: 0;
    border-radius: 16px;
    opacity: 0;
    transition: opacity 0.3s ease;
    pointer-events: none;
    z-index: 10;
    background: conic-gradient(
        from 0deg at var(--mx, 50%) var(--my, 50%),
        rgba(255,0,100,0.07), rgba(255,200,0,0.07),
        rgba(0,255,150,0.07), rgba(0,150,255,0.07),
        rgba(200,0,255,0.07), rgba(255,0,100,0.07)
    );
    mix-blend-mode: screen;
}
.tc-card:hover .tc-holo-overlay { opacity: 1; }

.tc-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 16px;
}
.tc-series-label {
    font-family: 'JetBrains Mono', monospace;
    font-size: 9px;
    font-weight: 700;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: rgba(255,255,255,0.9);
}
.tc-serial {
    font-family: 'JetBrains Mono', monospace;
    font-size: 9px;
    color: rgba(255,255,255,0.55);
    letter-spacing: 0.1em;
}

.tc-photo-zone {
    position: relative;
    aspect-ratio: 3/4;
    overflow: hidden;
    background: #ffffff;
}
.tc-photo {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center top;
    display: block;
}
.tc-photo-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Archivo Black', sans-serif;
    font-size: 5rem;
    color: #475569;
    background: linear-gradient(135deg, #0f172a, #1e293b);
}
.tc-photo-gradient {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 60%;
    background: linear-gradient(to top, #0f1829 0%, rgba(15,24,41,0.7) 50%, transparent 100%);
}

.tc-rank-badge {
    position: absolute;
    top: 12px; right: 12px;
    background: rgba(0,0,0,0.75);
    border: 1px solid rgba(245,158,11,0.5);
    border-radius: 8px;
    padding: 6px 10px;
    text-align: center;
    backdrop-filter: blur(4px);
    max-width: 72px;
}
.tc-rank-hash {
    font-family: 'JetBrains Mono', monospace;
    font-size: 9px;
    color: #f59e0b;
    line-height: 1;
    display: block;
    margin-bottom: 1px;
}
.tc-rank-num {
    font-family: 'Archivo Black', sans-serif;
    font-size: 1.6rem;
    color: #f59e0b;
    display: block;
    line-height: 1;
}
.tc-rank-org {
    display: block;
    font-family: 'JetBrains Mono', monospace;
    font-size: 11px;
    font-weight: 700;
    color: rgba(245,158,11,0.85);
    letter-spacing: 0.1em;
    margin-top: 3px;
    line-height: 1;
}

.tc-identity {
    padding: 12px 16px 4px;
}
.tc-country-line {
    display: flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 5px;
}
.tc-flag { font-size: 0.9rem; }
.tc-nationality {
    font-family: 'JetBrains Mono', monospace;
    font-size: 10px;
    letter-spacing: 0.12em;
    color: #94a3b8;
}
.tc-dot { color: #475569; }
.tc-age {
    font-family: 'JetBrains Mono', monospace;
    font-size: 10px;
    color: #94a3b8;
}
.tc-name {
    font-family: 'Archivo Black', sans-serif;
    font-size: 1.2rem;
    color: #f1f5f9;
    letter-spacing: 0.01em;
    line-height: 1.1;
    margin: 0 0 4px;
}
.tc-nickname {
    font-family: 'JetBrains Mono', monospace;
    font-size: 11px;
    color: #ef4444;
    font-style: italic;
}

.tc-divider {
    height: 1px;
    margin: 10px 16px;
    background: linear-gradient(90deg,
        transparent 0%,
        rgba(245,158,11,0.4) 30%,
        rgba(239,68,68,0.4) 70%,
        transparent 100%
    );
}

.tc-stats-row {
    display: flex;
    align-items: center;
    padding: 8px 16px 14px;
}
.tc-stat { flex: 1; text-align: center; }
.tc-stat-value {
    font-family: 'Archivo Black', sans-serif;
    font-size: 1.05rem;
    color: #f59e0b;
    line-height: 1;
    margin-bottom: 3px;
}
.tc-stat-label {
    font-family: 'JetBrains Mono', monospace;
    font-size: 8px;
    color: #94a3b8;
    letter-spacing: 0.1em;
    text-transform: uppercase;
}
.tc-stat-sep {
    width: 1px;
    height: 28px;
    background: rgba(255,255,255,0.08);
    flex-shrink: 0;
}

/* ---- DASHBOARD ---- */
.tc-dashboard {
    display: flex;
    flex-direction: column;
    gap: 24px;
}

.tc-dash-eyebrow {
    font-family: 'JetBrains Mono', monospace;
    font-size: 10px;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: #94a3b8;
    margin-bottom: 6px;
}
.tc-dash-name {
    font-family: 'Archivo Black', sans-serif;
    font-size: clamp(1.75rem, 3vw, 2.75rem);
    color: #f1f5f9;
    line-height: 1.0;
    margin: 0 0 6px;
    letter-spacing: -0.01em;
}
.tc-dash-nick {
    font-family: 'JetBrains Mono', monospace;
    font-size: 14px;
    color: #ef4444;
    font-style: italic;
}
.tc-dash-bio {
    font-size: 0.88rem;
    line-height: 1.65;
    color: #94a3b8;
    margin: 0;
    border-left: 2px solid #ef4444;
    padding-left: 14px;
}

/* Stats dashboard */
.tc-stats-dashboard {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

/* Ligne KPI — 4 cases horizontales compactes */
.tc-kpi-row {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 8px;
}
@media (max-width: 640px) {
    .tc-kpi-row { grid-template-columns: repeat(2, 1fr); }
}

.tc-kpi {
    background: #0d1829;
    border: 1px solid #1e293b;
    border-top: 2px solid #1e293b;
    border-radius: 8px;
    padding: 12px 14px 10px;
    transition: border-color 0.15s;
}
.tc-kpi:hover { border-color: #334155; }

.tc-kpi--green { border-top-color: #10b981; }
.tc-kpi--blue  { border-top-color: #3b82f6; }
.tc-kpi--cyan  { border-top-color: #22d3ee; }
.tc-kpi--amber { border-top-color: #f59e0b; }

.tc-kpi-top {
    display: flex;
    align-items: baseline;
    justify-content: space-between;
    gap: 6px;
    margin-bottom: 6px;
}
.tc-kpi-val {
    font-family: 'Archivo Black', sans-serif;
    font-size: 1.5rem;
    color: #ffffff;
    line-height: 1;
}
.tc-kpi-unit {
    font-size: 0.9rem;
    color: #94a3b8;
}
.tc-kpi-label {
    font-family: 'JetBrains Mono', monospace;
    font-size: 9px;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: #94a3b8;
    text-align: right;
    white-space: nowrap;
}
.tc-kpi-sub {
    font-family: 'JetBrains Mono', monospace;
    font-size: 10px;
    color: #94a3b8;
}
.tc-kpi-bar {
    height: 2px;
    background: #1e293b;
    border-radius: 2px;
    overflow: hidden;
    margin-top: 6px;
}
.tc-kpi-bar-fill {
    height: 100%;
    border-radius: 2px;
    transition: width 1s cubic-bezier(0.4,0,0.2,1);
}

/* Highlights en chips horizontaux */
.tc-hl-row {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.tc-hl-chip {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 16px;
    border-radius: 8px;
    border: 1px solid transparent;
    flex: 1;
    min-width: 0;
}
.tc-hl-chip--red   { background: rgba(239,68,68,0.08);   border-color: rgba(239,68,68,0.25); }
.tc-hl-chip--gold  { background: rgba(245,158,11,0.08);  border-color: rgba(245,158,11,0.25); }
.tc-hl-chip--slate { background: rgba(100,116,139,0.08); border-color: rgba(100,116,139,0.2); }

.tc-hl-chip-val {
    font-family: 'Archivo Black', sans-serif;
    font-size: 1.3rem;
    color: #ffffff;
    line-height: 1;
    flex-shrink: 0;
}
.tc-hl-chip--red   .tc-hl-chip-val { color: #f87171; }
.tc-hl-chip--gold  .tc-hl-chip-val { color: #fbbf24; }
.tc-hl-chip--slate .tc-hl-chip-val { color: #94a3b8; }

.tc-hl-chip-sep {
    width: 1px;
    height: 20px;
    background: rgba(255,255,255,0.08);
    flex-shrink: 0;
}
.tc-hl-chip-text {
    font-family: 'Inter Tight Variable', 'Inter Tight', sans-serif;
    font-weight: 600;
    font-size: 0.82rem;
    color: #e2e8f0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>

{{-- JS : effet 3D tilt + hologramme au survol --}}
<script>
(function() {
    const card = document.getElementById('tcCard');
    const holo = document.getElementById('tcHolo');
    if (!card) return;

    card.addEventListener('mousemove', function(e) {
        const r  = card.getBoundingClientRect();
        const x  = e.clientX - r.left;
        const y  = e.clientY - r.top;
        const cx = r.width  / 2;
        const cy = r.height / 2;
        const rx = ((y - cy) / cy) * -8;
        const ry = ((x - cx) / cx) *  8;
        const mx = (x / r.width  * 100).toFixed(1);
        const my = (y / r.height * 100).toFixed(1);

        card.style.transform = `rotateX(${rx}deg) rotateY(${ry}deg) scale3d(1.02,1.02,1.02)`;
        holo.style.setProperty('--mx', mx + '%');
        holo.style.setProperty('--my', my + '%');
        card.style.boxShadow = `
            ${ry * -2}px ${rx * 2}px 40px rgba(0,0,0,0.5),
            0 0 20px rgba(239,68,68,0.1),
            inset 0 0 20px rgba(255,255,255,0.02)
        `;
    });

    card.addEventListener('mouseleave', function() {
        card.style.transform = 'rotateX(0deg) rotateY(0deg) scale3d(1,1,1)';
        card.style.boxShadow = '';
    });
})();
</script>
