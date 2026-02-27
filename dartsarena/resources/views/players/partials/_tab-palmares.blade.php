{{-- TAB CONTENT: PALMARÈS — Trading Card Premium --}}
<div x-show="activeTab === 'palmares'" x-transition role="tabpanel">

<style>
/* ---- PALMARÈS ---- */
.tp-section-label {
    font-family: 'JetBrains Mono', monospace;
    font-size: 9px;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: #475569;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.tp-section-label::after {
    content: '';
    flex: 1;
    height: 1px;
    background: linear-gradient(90deg, #1e293b, transparent);
}

/* Compteur de trophées — pièce maîtresse */
.tp-trophy-counter {
    background: linear-gradient(135deg, #0d1424, #111827);
    border: 1px solid #1e293b;
    border-radius: 16px;
    padding: 40px 24px;
    text-align: center;
    position: relative;
    overflow: hidden;
}
.tp-trophy-counter::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, transparent, #f59e0b, #fcd34d, #f59e0b, transparent);
}
/* Halo doré derrière le chiffre */
.tp-trophy-counter::after {
    content: '';
    position: absolute;
    top: 50%; left: 50%;
    transform: translate(-50%, -50%);
    width: 200px;
    height: 200px;
    background: radial-gradient(circle, rgba(245,158,11,0.08) 0%, transparent 70%);
    pointer-events: none;
}

.tp-counter-sup {
    font-family: 'JetBrains Mono', monospace;
    font-size: 9px;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: #475569;
    margin-bottom: 12px;
}
.tp-counter-num {
    font-family: 'Archivo Black', sans-serif;
    font-size: clamp(4rem, 10vw, 6rem);
    color: #f59e0b;
    line-height: 1;
    position: relative;
    z-index: 1;
    /* animation compteur au chargement */
    opacity: 0;
    transition: opacity 0.3s ease;
}
.tp-counter-num.visible { opacity: 1; }
.tp-counter-label {
    font-family: 'JetBrains Mono', monospace;
    font-size: 11px;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: #64748b;
    margin-top: 10px;
}

/* Grille de badges de carrière */
.tp-badge-row {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));
    gap: 10px;
    margin-top: 24px;
}
.tp-badge {
    background: #080e1a;
    border: 1px solid #1e293b;
    border-radius: 10px;
    padding: 12px 8px;
    text-align: center;
}
.tp-badge-icon { font-size: 1.4rem; display: block; margin-bottom: 5px; }
.tp-badge-val {
    font-family: 'Archivo Black', sans-serif;
    font-size: 1.3rem;
    line-height: 1;
    margin-bottom: 3px;
}
.tp-badge-lbl {
    font-family: 'JetBrains Mono', monospace;
    font-size: 8px;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: #334155;
}

/* Timeline de carrière */
.tp-timeline {
    position: relative;
    padding-left: 28px;
}
.tp-timeline::before {
    content: '';
    position: absolute;
    left: 7px;
    top: 6px;
    bottom: 6px;
    width: 2px;
    background: linear-gradient(to bottom, #f59e0b, #334155 60%, transparent);
}

.tp-tl-item {
    position: relative;
    margin-bottom: 20px;
}
.tp-tl-item:last-child { margin-bottom: 0; }

/* Point sur la timeline */
.tp-tl-dot {
    position: absolute;
    left: -24px;
    top: 50%;
    transform: translateY(-50%);
    width: 16px;
    height: 16px;
    border-radius: 50%;
    border: 2px solid #0d1424;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 8px;
}

.tp-tl-card {
    background: #0d1424;
    border: 1px solid #1e293b;
    border-radius: 10px;
    padding: 14px 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    transition: border-color 0.15s;
}
.tp-tl-card:hover { border-color: rgba(245,158,11,0.3); }

.tp-tl-rank { font-size: 1.3rem; flex-shrink: 0; }
.tp-tl-info { flex: 1; min-width: 0; }
.tp-tl-title {
    font-family: 'Archivo Black', sans-serif;
    font-size: 0.9rem;
    color: #f1f5f9;
    line-height: 1.2;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.tp-tl-sub {
    font-family: 'JetBrains Mono', monospace;
    font-size: 10px;
    color: #475569;
    margin-top: 3px;
}
.tp-tl-right { text-align: right; flex-shrink: 0; }
.tp-tl-year {
    font-family: 'Archivo Black', sans-serif;
    font-size: 1rem;
    color: #f59e0b;
}
.tp-tl-prize {
    font-family: 'JetBrains Mono', monospace;
    font-size: 9px;
    color: #334155;
    margin-top: 2px;
}

/* Placeholder "à venir" stylisé */
.tp-coming-soon {
    background: #080e1a;
    border: 1px dashed #1e293b;
    border-radius: 10px;
    padding: 24px;
    display: flex;
    align-items: center;
    gap: 16px;
}
.tp-cs-icon {
    width: 44px;
    height: 44px;
    background: #111827;
    border: 1px solid #1e293b;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    flex-shrink: 0;
}
.tp-cs-title {
    font-family: 'Archivo Black', sans-serif;
    font-size: 13px;
    color: #334155;
    margin-bottom: 3px;
}
.tp-cs-text {
    font-family: 'JetBrains Mono', monospace;
    font-size: 10px;
    color: #1e293b;
    line-height: 1.5;
}
</style>

@if($player->career_titles > 0 || $player->career_9darters > 0)

<div style="display:grid; grid-template-columns:1fr; gap:20px;">
<style>@media(min-width:1024px){ .tp-layout { grid-template-columns:280px 1fr !important; } }</style>
<div class="tp-layout" style="display:grid; grid-template-columns:1fr; gap:20px; align-items:start;">

    {{-- GAUCHE : compteur + badges --}}
    <div style="display:flex; flex-direction:column; gap:16px;">

        {{-- Grand compteur trophées --}}
        <div class="tp-trophy-counter" id="tpCounter">
            <div class="tp-counter-sup">DARTSARENA ELITE · {{ date('Y') }}</div>
            <div class="tp-counter-num" id="tpNum">{{ $player->career_titles }}</div>
            <div class="tp-counter-label">Titres Remportés en Carrière</div>

            @if($player->career_titles > 0)
            <div class="tp-badge-row">
                <div class="tp-badge">
                    <span class="tp-badge-icon">🏆</span>
                    <div class="tp-badge-val" style="color:#f59e0b;">{{ $player->career_titles }}</div>
                    <div class="tp-badge-lbl">Titres</div>
                </div>
                @if($player->career_9darters > 0)
                <div class="tp-badge">
                    <span class="tp-badge-icon">⚡</span>
                    <div class="tp-badge-val" style="color:#a78bfa;">{{ $player->career_9darters }}</div>
                    <div class="tp-badge-lbl">9-Darters</div>
                </div>
                @endif
                @if($player->career_highest_average > 0)
                <div class="tp-badge">
                    <span class="tp-badge-icon">🎯</span>
                    <div class="tp-badge-val" style="color:#22d3ee; font-size:1rem;">{{ $player->career_highest_average }}</div>
                    <div class="tp-badge-lbl">Best Avg</div>
                </div>
                @endif
            </div>
            @endif
        </div>

        {{-- Carte identité palmarès --}}
        <div style="background:#0d1424; border:1px solid #1e293b; border-radius:14px; padding:20px; position:relative; overflow:hidden;">
            <div style="position:absolute; top:0; left:0; right:0; height:2px;
                        background:linear-gradient(90deg,#f59e0b,#fcd34d,#f59e0b);"></div>
            <div class="tp-section-label">Profil Palmarès</div>
            <dl style="display:flex; flex-direction:column; gap:10px; margin:0;">
                <div style="display:flex; justify-content:space-between; padding:8px 0; border-bottom:1px solid #111827;">
                    <dt style="font-family:'JetBrains Mono',monospace; font-size:10px; color:#475569; text-transform:uppercase; letter-spacing:0.06em;">Joueur</dt>
                    <dd style="font-family:'Archivo Black',sans-serif; font-size:12px; color:#f1f5f9; margin:0;">{{ $player->full_name }}</dd>
                </div>
                @if($player->nationality)
                <div style="display:flex; justify-content:space-between; padding:8px 0; border-bottom:1px solid #111827;">
                    <dt style="font-family:'JetBrains Mono',monospace; font-size:10px; color:#475569; text-transform:uppercase; letter-spacing:0.06em;">Nationalité</dt>
                    <dd style="font-family:'JetBrains Mono',monospace; font-size:11px; color:#94a3b8; margin:0;">{{ $player->nationality }}</dd>
                </div>
                @endif
                @if($latestRanking ?? false)
                <div style="display:flex; justify-content:space-between; padding:8px 0; border-bottom:1px solid #111827;">
                    <dt style="font-family:'JetBrains Mono',monospace; font-size:10px; color:#475569; text-transform:uppercase; letter-spacing:0.06em;">Classement</dt>
                    <dd style="font-family:'Archivo Black',sans-serif; font-size:12px; color:#ef4444; margin:0;">#{{ $latestRanking->position }} {{ $latestRanking->federation->name ?? 'PDC' }}</dd>
                </div>
                @endif
                <div style="display:flex; justify-content:space-between; padding:8px 0;">
                    <dt style="font-family:'JetBrains Mono',monospace; font-size:10px; color:#475569; text-transform:uppercase; letter-spacing:0.06em;">9-Darters</dt>
                    <dd style="font-family:'Archivo Black',sans-serif; font-size:12px; color:#a78bfa; margin:0;">{{ $player->career_9darters }}</dd>
                </div>
            </dl>
        </div>

    </div>

    {{-- DROITE : timeline --}}
    <div>
        <div style="background:#0d1424; border:1px solid #1e293b; border-radius:14px; padding:24px; position:relative; overflow:hidden;">
            <div style="position:absolute; top:0; left:0; right:0; height:3px;
                        background:linear-gradient(90deg, #ef4444, #f59e0b, #8b5cf6, #22d3ee);"></div>

            <div class="tp-section-label">Chronologie des Victoires</div>

            <div class="tp-timeline">

                {{-- Placeholder structuré — remplacé par données API à terme --}}
                @for($i = 0; $i < min($player->career_titles, 5); $i++)
                @php
                    $medals = ['🥇','🥇','🥇','🥈','🥉'];
                    $dotColors = ['#f59e0b','#f59e0b','#f59e0b','#94a3b8','#cd7f32'];
                @endphp
                <div class="tp-tl-item">
                    <div class="tp-tl-dot" style="background:{{ $dotColors[$i] ?? '#334155' }};">
                    </div>
                    <div class="tp-tl-card">
                        <span class="tp-tl-rank">{{ $medals[$i] ?? '🏅' }}</span>
                        <div class="tp-tl-info">
                            <div class="tp-tl-title">PDC Tour Event</div>
                            <div class="tp-tl-sub">Données disponibles via API PDC</div>
                        </div>
                        <div class="tp-tl-right">
                            <div class="tp-tl-year">—</div>
                            <div class="tp-tl-prize">À venir</div>
                        </div>
                    </div>
                </div>
                @endfor

                @if($player->career_titles > 5)
                <div style="text-align:center; padding:12px 0;">
                    <span style="font-family:'JetBrains Mono',monospace; font-size:10px; color:#334155;">
                        + {{ $player->career_titles - 5 }} autres titres
                    </span>
                </div>
                @endif

            </div>

            {{-- Note API --}}
            <div class="tp-coming-soon" style="margin-top:20px;">
                <div class="tp-cs-icon">📡</div>
                <div>
                    <div class="tp-cs-title">Données détaillées en cours d'intégration</div>
                    <div class="tp-cs-text">
                        La chronologie complète (tournois, adversaires, prize money)<br>
                        sera alimentée par l'API PDC officielle.
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
</div>

@else
{{-- Joueur sans titre --}}
<div style="background:#0d1424; border:1px solid #1e293b; border-radius:14px; padding:48px 24px; text-align:center;">
    <div style="font-size:3.5rem; opacity:0.12; margin-bottom:16px;">🏆</div>
    <div style="font-family:'Archivo Black',sans-serif; font-size:1.1rem; color:#334155; margin-bottom:8px;">
        Aucun titre enregistré
    </div>
    <div style="font-family:'JetBrains Mono',monospace; font-size:11px; color:#1e293b; line-height:1.6;">
        Le palmarès de ce joueur sera disponible<br>dès l'intégration des données PDC.
    </div>
</div>
@endif

</div>

<script>
// Animation compteur au chargement de l'onglet
(function() {
    const num = document.getElementById('tpNum');
    if (!num) return;
    const target = parseInt(num.textContent.trim(), 10);
    if (isNaN(target) || target === 0) { num.classList.add('visible'); return; }

    let current = 0;
    const duration = 800;
    const step = Math.ceil(duration / target);
    num.textContent = '0';
    num.classList.add('visible');

    const timer = setInterval(() => {
        current++;
        num.textContent = current;
        if (current >= target) clearInterval(timer);
    }, step);
})();
</script>
