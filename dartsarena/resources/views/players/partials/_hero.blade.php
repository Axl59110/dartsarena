{{-- HERO — Trading Card Premium --}}

@php
$flags = [
    'GB'=>'🇬🇧','EN'=>'🏴󠁧󠁢󠁥󠁮󠁧󠁿','SC'=>'🏴󠁧󠁢󠁳󠁣󠁴󠁿','WA'=>'🏴󠁧󠁢󠁷󠁬󠁳󠁿',
    'NL'=>'🇳🇱','AU'=>'🇦🇺','BE'=>'🇧🇪','DE'=>'🇩🇪','IE'=>'🇮🇪',
    'US'=>'🇺🇸','CA'=>'🇨🇦','NZ'=>'🇳🇿','ZA'=>'🇿🇦','AT'=>'🇦🇹',
];
$flag = $flags[strtoupper($player->country_code ?? '')] ?? '🌍';

// Couleur thématique par pays
$accentColors = [
    'EN'=>['from'=>'#b91c1c','to'=>'#991b1b','text'=>'#fca5a5'],
    'GB'=>['from'=>'#1d4ed8','to'=>'#1e3a8a','text'=>'#93c5fd'],
    'NL'=>['from'=>'#c2410c','to'=>'#9a3412','text'=>'#fdba74'],
    'AU'=>['from'=>'#15803d','to'=>'#14532d','text'=>'#86efac'],
    'BE'=>['from'=>'#b45309','to'=>'#92400e','text'=>'#fcd34d'],
    'DE'=>['from'=>'#1d4ed8','to'=>'#1e3a8a','text'=>'#93c5fd'],
];
$accent = $accentColors[strtoupper($player->country_code ?? '')] ?? ['from'=>'#7c3aed','to'=>'#4c1d95','text'=>'#c4b5fd'];

// Numéro de série fictif mais cohérent (basé sur l'ID du joueur)
$serialNumber = 'DA-' . str_pad($player->id * 7 % 9999, 4, '0', STR_PAD_LEFT);
@endphp

<div class="tc-hero">
    <div class="tc-hero-inner">

        {{-- ===== GAUCHE : LA CARTE ===== --}}
        <div class="tc-card-wrapper">
            <div class="tc-card" id="tcCard">

                {{-- Reflet holographique (suit le curseur via JS) --}}
                <div class="tc-holo-overlay" id="tcHolo"></div>

                {{-- Header de carte --}}
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

                    {{-- Overlay dégradé bas --}}
                    <div class="tc-photo-gradient"></div>

                    {{-- Badge rang dans la photo --}}
                    @if($latestRanking)
                    <div class="tc-rank-badge">
                        <span class="tc-rank-hash">#</span>{{ $latestRanking->position }}
                        <span class="tc-rank-org">{{ $latestRanking->federation->name ?? 'PDC' }}</span>
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

                {{-- Ligne séparatrice holographique --}}
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
                        <div class="tc-stat-value" style="color:#a78bfa;">{{ $player->career_9darters }}</div>
                        <div class="tc-stat-label">9-DARTERS</div>
                    </div>
                </div>

            </div>{{-- /tc-card --}}
        </div>

        {{-- ===== DROITE : DASHBOARD ===== --}}
        <div class="tc-dashboard">

            {{-- Titre + sous-titre --}}
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

            {{-- Grille de stats principale --}}
            <div class="tc-kpi-grid">
                <div class="tc-kpi {{ ($careerStats['win_rate'] ?? 0) >= 60 ? 'tc-kpi--green' : '' }}">
                    <div class="tc-kpi-val">{{ $careerStats['win_rate'] ?? 0 }}<span class="tc-kpi-unit">%</span></div>
                    <div class="tc-kpi-label">Win Rate</div>
                    <div class="tc-kpi-bar">
                        <div class="tc-kpi-bar-fill" style="width:{{ $careerStats['win_rate'] ?? 0 }}%; background:#10b981;"></div>
                    </div>
                </div>
                <div class="tc-kpi">
                    <div class="tc-kpi-val">{{ $careerStats['total_matches'] ?? 0 }}</div>
                    <div class="tc-kpi-label">Matchs</div>
                    <div class="tc-kpi-sub">
                        <span style="color:#10b981;">{{ $careerStats['wins'] ?? 0 }}V</span>
                        <span style="color:#475569;"> — </span>
                        <span style="color:#ef4444;">{{ $careerStats['losses'] ?? 0 }}D</span>
                    </div>
                </div>
                <div class="tc-kpi tc-kpi--cyan">
                    <div class="tc-kpi-val">{{ $careerStats['avg_average'] > 0 ? $careerStats['avg_average'] : '—' }}</div>
                    <div class="tc-kpi-label">Avg Carrière</div>
                    @if($player->career_highest_average > 0)
                    <div class="tc-kpi-sub">Best: <span style="color:#f59e0b;">{{ $player->career_highest_average }}</span></div>
                    @endif
                </div>
                <div class="tc-kpi tc-kpi--amber">
                    <div class="tc-kpi-val">{{ $careerStats['total_180s'] ?? 0 }}</div>
                    <div class="tc-kpi-label">Total 180s</div>
                    <div class="tc-kpi-sub">CO% {{ $careerStats['avg_checkout'] ?? 0 }}%</div>
                </div>
            </div>

            {{-- Ligne d'accroche premium --}}
            <div class="tc-highlights">
                @if($player->career_9darters > 0)
                <div class="tc-highlight tc-highlight--purple">
                    <span class="tc-hl-icon">🎯</span>
                    <span class="tc-hl-val">{{ $player->career_9darters }}</span>
                    <span class="tc-hl-text">{{ $player->career_9darters > 1 ? '9-Darters Parfaits' : '9-Darter Parfait' }}</span>
                </div>
                @endif
                @if($player->career_titles > 0)
                <div class="tc-highlight tc-highlight--gold">
                    <span class="tc-hl-icon">🏆</span>
                    <span class="tc-hl-val">{{ $player->career_titles }}</span>
                    <span class="tc-hl-text">{{ $player->career_titles > 1 ? 'Titres Remportés' : 'Titre Remporté' }}</span>
                </div>
                @endif
                @if($latestRanking)
                <div class="tc-highlight tc-highlight--red">
                    <span class="tc-hl-icon">📊</span>
                    <span class="tc-hl-val">#{{ $latestRanking->position }}</span>
                    <span class="tc-hl-text">{{ $latestRanking->federation->name ?? 'PDC' }} World Rankings</span>
                </div>
                @endif
            </div>

        </div>

    </div>
</div>

{{-- Styles spécifiques au hero Trading Card --}}
<style>
/* ============================================
   HERO — TRADING CARD PREMIUM
   ============================================ */

.tc-hero {
    background: #080e1a;
    overflow: hidden;
    position: relative;
    border-bottom: 1px solid #1e293b;
}

/* Fond subtil — texture métal brossé */
.tc-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse 80% 50% at 15% 50%, rgba(99,102,241,0.06) 0%, transparent 60%),
        radial-gradient(ellipse 60% 80% at 85% 30%, rgba(245,158,11,0.05) 0%, transparent 60%);
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
    .tc-hero-inner { grid-template-columns: 320px 1fr; gap: 56px; }
}
@media (min-width: 1100px) {
    .tc-hero-inner { grid-template-columns: 360px 1fr; }
}

/* ---- LA CARTE ---- */
.tc-card-wrapper {
    perspective: 1000px;
    display: flex;
    justify-content: center;
}

.tc-card {
    width: 100%;
    max-width: 320px;
    border-radius: 18px;
    overflow: hidden;
    position: relative;
    background: linear-gradient(145deg, #1a2540 0%, #0f1829 40%, #1a2540 100%);
    border: 1px solid rgba(255,255,255,0.12);
    box-shadow:
        0 0 0 1px rgba(255,255,255,0.04),
        0 24px 48px rgba(0,0,0,0.6),
        0 4px 12px rgba(0,0,0,0.4);
    transition: transform 0.1s ease, box-shadow 0.1s ease;
    transform-style: preserve-3d;
}

/* Reflet holographique — mis à jour par JS au survol */
.tc-holo-overlay {
    position: absolute;
    inset: 0;
    border-radius: 18px;
    opacity: 0;
    transition: opacity 0.3s ease;
    pointer-events: none;
    z-index: 10;
    background: conic-gradient(
        from 0deg at var(--mx, 50%) var(--my, 50%),
        rgba(255,0,100,0.08),
        rgba(255,200,0,0.08),
        rgba(0,255,150,0.08),
        rgba(0,150,255,0.08),
        rgba(200,0,255,0.08),
        rgba(255,0,100,0.08)
    );
    mix-blend-mode: screen;
}

.tc-card:hover .tc-holo-overlay { opacity: 1; }

/* Header de carte */
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
    color: rgba(255,255,255,0.85);
}

.tc-serial {
    font-family: 'JetBrains Mono', monospace;
    font-size: 9px;
    color: rgba(255,255,255,0.5);
    letter-spacing: 0.1em;
}

/* Zone photo */
.tc-photo-zone {
    position: relative;
    aspect-ratio: 3/4;
    overflow: hidden;
    background: #0a1020;
}

.tc-photo {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: top center;
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
    color: #334155;
    background: linear-gradient(135deg, #0f172a, #1e293b);
}

/* Dégradé sur la photo */
.tc-photo-gradient {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 50%;
    background: linear-gradient(to top, #0f1829 0%, transparent 100%);
}

/* Badge rang sur la photo */
.tc-rank-badge {
    position: absolute;
    top: 12px;
    right: 12px;
    background: linear-gradient(135deg, rgba(0,0,0,0.8), rgba(0,0,0,0.6));
    border: 1px solid rgba(245,158,11,0.5);
    border-radius: 8px;
    padding: 6px 12px;
    text-align: center;
    backdrop-filter: blur(4px);
}

.tc-rank-hash {
    font-family: 'JetBrains Mono', monospace;
    font-size: 10px;
    color: #f59e0b;
}

.tc-rank-badge > :not(.tc-rank-hash):not(.tc-rank-org) {
    font-family: 'Archivo Black', sans-serif;
    font-size: 1.4rem;
    color: #f59e0b;
    display: block;
    line-height: 1;
}

.tc-rank-badge {
    font-family: 'Archivo Black', sans-serif;
    font-size: 1.4rem;
    color: #f59e0b;
    line-height: 1;
}

.tc-rank-org {
    display: block;
    font-family: 'JetBrains Mono', monospace;
    font-size: 9px;
    color: rgba(245,158,11,0.7);
    letter-spacing: 0.08em;
    margin-top: 2px;
}

/* Zone identité */
.tc-identity {
    padding: 14px 16px 4px;
}

.tc-country-line {
    display: flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 6px;
}

.tc-flag { font-size: 1rem; }

.tc-nationality {
    font-family: 'JetBrains Mono', monospace;
    font-size: 10px;
    letter-spacing: 0.12em;
    color: #64748b;
}

.tc-dot { color: #334155; }

.tc-age {
    font-family: 'JetBrains Mono', monospace;
    font-size: 10px;
    color: #475569;
}

.tc-name {
    font-family: 'Archivo Black', sans-serif;
    font-size: 1.35rem;
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
    margin-bottom: 2px;
}

/* Séparateur holographique */
.tc-divider {
    height: 1px;
    margin: 10px 16px;
    background: linear-gradient(90deg,
        transparent 0%,
        rgba(245,158,11,0.3) 20%,
        rgba(139,92,246,0.4) 50%,
        rgba(34,211,238,0.3) 80%,
        transparent 100%
    );
}

/* Ligne de stats bas de carte */
.tc-stats-row {
    display: flex;
    align-items: center;
    padding: 10px 16px 16px;
    gap: 0;
}

.tc-stat {
    flex: 1;
    text-align: center;
}

.tc-stat-value {
    font-family: 'Archivo Black', sans-serif;
    font-size: 1.1rem;
    color: #f59e0b;
    line-height: 1;
    margin-bottom: 3px;
}

.tc-stat-label {
    font-family: 'JetBrains Mono', monospace;
    font-size: 8px;
    color: #475569;
    letter-spacing: 0.1em;
    text-transform: uppercase;
}

.tc-stat-sep {
    width: 1px;
    height: 28px;
    background: rgba(255,255,255,0.06);
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
    color: #475569;
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
    font-size: 0.9rem;
    line-height: 1.65;
    color: #64748b;
    margin: 0;
    border-left: 2px solid #1e293b;
    padding-left: 14px;
}

/* Grille KPI */
.tc-kpi-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
}

@media (min-width: 640px) {
    .tc-kpi-grid { grid-template-columns: repeat(4, 1fr); }
}

.tc-kpi {
    background: #111827;
    border: 1px solid #1e293b;
    border-radius: 10px;
    padding: 14px 12px;
    position: relative;
    overflow: hidden;
    transition: border-color 0.15s;
}

.tc-kpi::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 2px;
    background: #1e293b;
    border-radius: 10px 10px 0 0;
}

.tc-kpi--green::before { background: linear-gradient(90deg, #10b981, #059669); }
.tc-kpi--cyan::before  { background: linear-gradient(90deg, #22d3ee, #0891b2); }
.tc-kpi--amber::before { background: linear-gradient(90deg, #f59e0b, #d97706); }

.tc-kpi:hover { border-color: #334155; }

.tc-kpi-val {
    font-family: 'Archivo Black', sans-serif;
    font-size: 1.65rem;
    color: #f1f5f9;
    line-height: 1;
    margin-bottom: 4px;
}

.tc-kpi-unit {
    font-size: 1rem;
    color: #64748b;
}

.tc-kpi-label {
    font-family: 'JetBrains Mono', monospace;
    font-size: 9px;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: #475569;
    margin-bottom: 8px;
}

.tc-kpi-sub {
    font-family: 'JetBrains Mono', monospace;
    font-size: 10px;
    color: #475569;
}

.tc-kpi-bar {
    height: 3px;
    background: #1e293b;
    border-radius: 2px;
    overflow: hidden;
}

.tc-kpi-bar-fill {
    height: 100%;
    border-radius: 2px;
    transition: width 1s cubic-bezier(0.4,0,0.2,1);
}

/* Highlights */
.tc-highlights {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.tc-highlight {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    border-radius: 10px;
    border: 1px solid transparent;
}

.tc-highlight--purple {
    background: rgba(139,92,246,0.08);
    border-color: rgba(139,92,246,0.2);
}

.tc-highlight--gold {
    background: rgba(245,158,11,0.08);
    border-color: rgba(245,158,11,0.2);
}

.tc-highlight--red {
    background: rgba(239,68,68,0.06);
    border-color: rgba(239,68,68,0.15);
}

.tc-hl-icon { font-size: 1.1rem; flex-shrink: 0; }

.tc-hl-val {
    font-family: 'Archivo Black', sans-serif;
    font-size: 1.4rem;
    color: #f1f5f9;
    line-height: 1;
    flex-shrink: 0;
    min-width: 36px;
}

.tc-hl-text {
    font-family: 'JetBrains Mono', monospace;
    font-size: 11px;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.06em;
}
</style>

{{-- JS : effet 3D tilt + hologramme au survol --}}
<script>
(function() {
    const card  = document.getElementById('tcCard');
    const holo  = document.getElementById('tcHolo');
    if (!card) return;

    card.addEventListener('mousemove', function(e) {
        const r  = card.getBoundingClientRect();
        const x  = e.clientX - r.left;
        const y  = e.clientY - r.top;
        const cx = r.width  / 2;
        const cy = r.height / 2;
        const rx = ((y - cy) / cy) * -8;   // rotation X max ±8deg
        const ry = ((x - cx) / cx) *  8;   // rotation Y max ±8deg
        const mx = (x / r.width  * 100).toFixed(1);
        const my = (y / r.height * 100).toFixed(1);

        card.style.transform = `rotateX(${rx}deg) rotateY(${ry}deg) scale3d(1.02,1.02,1.02)`;
        holo.style.setProperty('--mx', mx + '%');
        holo.style.setProperty('--my', my + '%');
        card.style.boxShadow = `
            ${ry * -2}px ${rx * 2}px 40px rgba(0,0,0,0.5),
            0 0 20px rgba(139,92,246,0.15),
            inset 0 0 20px rgba(255,255,255,0.02)
        `;
    });

    card.addEventListener('mouseleave', function() {
        card.style.transform = 'rotateX(0deg) rotateY(0deg) scale3d(1,1,1)';
        card.style.boxShadow = '';
    });
})();
</script>
