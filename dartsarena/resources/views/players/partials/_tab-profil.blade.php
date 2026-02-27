{{-- TAB CONTENT: PROFIL — Trading Card Premium --}}
<div x-show="activeTab === 'profil'" x-transition role="tabpanel">

<style>
/* ---- PROFIL ---- */
.pp-panel {
    background: #0d1424;
    border: 1px solid #1e293b;
    border-radius: 14px;
    padding: 28px;
    position: relative;
    overflow: hidden;
}
.pp-panel::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, #ef4444, #f59e0b, #8b5cf6, #22d3ee);
}
.pp-label {
    font-family: 'JetBrains Mono', monospace;
    font-size: 9px;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: #475569;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.pp-label::after {
    content: '';
    flex: 1;
    height: 1px;
    background: linear-gradient(90deg, #1e293b, transparent);
}

/* Bio */
.pp-bio-text {
    font-size: 0.95rem;
    color: #94a3b8;
    line-height: 1.85;
    white-space: pre-line;
    margin: 0;
    border-left: 3px solid #ef4444;
    padding-left: 18px;
}

/* Fiche technique */
.pp-tech-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
    gap: 10px;
    margin-top: 4px;
}
.pp-tech-item {
    background: #080e1a;
    border: 1px solid #1e293b;
    border-radius: 10px;
    padding: 14px 12px;
    display: flex;
    align-items: center;
    gap: 12px;
}
.pp-tech-icon {
    width: 36px;
    height: 36px;
    background: linear-gradient(135deg, #1e293b, #0d1424);
    border: 1px solid #334155;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    flex-shrink: 0;
}
.pp-tech-label {
    font-family: 'JetBrains Mono', monospace;
    font-size: 9px;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: #475569;
    margin-bottom: 3px;
}
.pp-tech-val {
    font-family: 'Archivo Black', sans-serif;
    font-size: 0.95rem;
    color: #f1f5f9;
    line-height: 1;
}

/* Classement hero card */
.pp-ranking-card {
    background: linear-gradient(135deg, rgba(239,68,68,0.1), rgba(239,68,68,0.04));
    border: 1px solid rgba(239,68,68,0.3);
    border-radius: 12px;
    padding: 20px 24px;
    display: flex;
    align-items: center;
    gap: 20px;
}
.pp-ranking-num {
    font-family: 'Archivo Black', sans-serif;
    font-size: clamp(2.5rem, 5vw, 3.5rem);
    color: #ef4444;
    line-height: 1;
}

/* Réseaux sociaux */
.pp-social-btn {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 16px;
    background: #080e1a;
    border: 1px solid #1e293b;
    border-radius: 10px;
    text-decoration: none;
    transition: border-color 0.15s, background 0.15s;
    flex: 1;
}
.pp-social-btn:hover {
    border-color: #334155;
    background: #111827;
}
.pp-social-icon {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    flex-shrink: 0;
}
.pp-social-name {
    font-family: 'Archivo Black', sans-serif;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: #f1f5f9;
}
.pp-social-handle {
    font-family: 'JetBrains Mono', monospace;
    font-size: 9px;
    color: #475569;
    margin-top: 1px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 100px;
}
</style>

@php
    /* Drapeaux pays */
    $flagMap = [
        'England'       => '🏴󠁧󠁢󠁥󠁮󠁧󠁿',
        'Netherlands'   => '🇳🇱',
        'Scotland'      => '🏴󠁧󠁢󠁳󠁣󠁴󠁿',
        'Wales'         => '🏴󠁧󠁢󠁷󠁬󠁳󠁿',
        'Germany'       => '🇩🇪',
        'Belgium'       => '🇧🇪',
        'Australia'     => '🇦🇺',
        'Northern Ireland' => '🇬🇧',
        'Ireland'       => '🇮🇪',
        'Austria'       => '🇦🇹',
        'New Zealand'   => '🇳🇿',
        'Canada'        => '🇨🇦',
        'USA'           => '🇺🇸',
        'Sweden'        => '🇸🇪',
        'Denmark'       => '🇩🇰',
        'Czech Republic'=> '🇨🇿',
    ];
    $flag = $flagMap[$player->nationality ?? ''] ?? '🏳️';
@endphp

<style>@media(min-width:1024px){ .pp-layout { grid-template-columns:1fr 320px !important; } }</style>
<div class="pp-layout" style="display:grid; grid-template-columns:1fr; gap:20px; align-items:start;">

    {{-- COLONNE GAUCHE : Bio + Fiche technique --}}
    <div style="display:flex; flex-direction:column; gap:16px;">

        {{-- Biographie --}}
        <div class="pp-panel">
            <div class="pp-label">Biographie</div>
            @if($player->bio)
                <p class="pp-bio-text">{{ $player->bio }}</p>
            @else
                <p style="font-family:'JetBrains Mono',monospace; font-size:12px; color:#334155;
                           font-style:italic; margin:0; text-align:center; padding:20px 0;">
                    Aucune biographie disponible pour le moment.
                </p>
            @endif
        </div>

        {{-- Fiche technique --}}
        <div class="pp-panel">
            <div class="pp-label">Fiche Technique</div>
            <div class="pp-tech-grid">

                <div class="pp-tech-item">
                    <div class="pp-tech-icon">{{ $flag }}</div>
                    <div>
                        <div class="pp-tech-label">Nationalité</div>
                        <div class="pp-tech-val">{{ $player->nationality ?? '—' }}</div>
                    </div>
                </div>

                @if($player->date_of_birth)
                <div class="pp-tech-item">
                    <div class="pp-tech-icon">🎂</div>
                    <div>
                        <div class="pp-tech-label">Âge</div>
                        <div class="pp-tech-val">{{ $player->date_of_birth->age }} ans</div>
                    </div>
                </div>
                @endif

                @if($player->nickname)
                <div class="pp-tech-item">
                    <div class="pp-tech-icon">🎙️</div>
                    <div>
                        <div class="pp-tech-label">Surnom</div>
                        <div class="pp-tech-val" style="color:#ef4444; font-size:0.82rem;">
                            "{{ $player->nickname }}"
                        </div>
                    </div>
                </div>
                @endif

                @if($player->height_cm)
                <div class="pp-tech-item">
                    <div class="pp-tech-icon">📏</div>
                    <div>
                        <div class="pp-tech-label">Taille</div>
                        <div class="pp-tech-val">{{ $player->height_cm }} cm</div>
                    </div>
                </div>
                @endif

                @if($player->handedness)
                <div class="pp-tech-item">
                    <div class="pp-tech-icon">🖐️</div>
                    <div>
                        <div class="pp-tech-label">Main</div>
                        <div class="pp-tech-val">
                            @if(strtolower($player->handedness) === 'right' || strtolower($player->handedness) === 'droitier')
                                Droitier
                            @elseif(strtolower($player->handedness) === 'left' || strtolower($player->handedness) === 'gaucher')
                                Gaucher
                            @else
                                {{ $player->handedness }}
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                @if($player->career_titles > 0)
                <div class="pp-tech-item">
                    <div class="pp-tech-icon">🏆</div>
                    <div>
                        <div class="pp-tech-label">Titres</div>
                        <div class="pp-tech-val" style="color:#f59e0b;">{{ $player->career_titles }}</div>
                    </div>
                </div>
                @endif

                @if($player->career_9darters > 0)
                <div class="pp-tech-item">
                    <div class="pp-tech-icon">⚡</div>
                    <div>
                        <div class="pp-tech-label">9-Darters</div>
                        <div class="pp-tech-val" style="color:#a78bfa;">{{ $player->career_9darters }}</div>
                    </div>
                </div>
                @endif

                @if($player->career_highest_average > 0)
                <div class="pp-tech-item">
                    <div class="pp-tech-icon">🎯</div>
                    <div>
                        <div class="pp-tech-label">Best Avg</div>
                        <div class="pp-tech-val" style="color:#22d3ee; font-size:0.85rem;">
                            {{ $player->career_highest_average }}
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </div>

    </div>

    {{-- COLONNE DROITE : Classement + Identité + Réseaux --}}
    <div style="display:flex; flex-direction:column; gap:16px;">

        {{-- Classement --}}
        @if($latestRanking ?? false)
        <div class="pp-ranking-card">
            <div>
                <div style="font-family:'JetBrains Mono',monospace; font-size:9px;
                            text-transform:uppercase; letter-spacing:0.15em; color:#7f1d1d; margin-bottom:6px;">
                    Classement Mondial
                </div>
                <div style="display:flex; align-items:baseline; gap:4px;">
                    <span style="font-family:'JetBrains Mono',monospace; font-size:1.3rem; color:#ef4444;">#</span>
                    <span class="pp-ranking-num">{{ $latestRanking->position }}</span>
                </div>
                <div style="font-family:'JetBrains Mono',monospace; font-size:10px; color:#64748b; margin-top:4px;">
                    {{ $latestRanking->federation->name ?? 'PDC' }}
                </div>
            </div>
            <div style="margin-left:auto; text-align:right;">
                <div style="font-size:2.5rem; opacity:0.6;">🏅</div>
            </div>
        </div>
        @endif

        {{-- Carte identité --}}
        <div class="pp-panel">
            <div class="pp-label">Identité</div>
            <dl style="display:flex; flex-direction:column; gap:0; margin:0;">

                <div style="display:flex; justify-content:space-between; align-items:center;
                            padding:10px 0; border-bottom:1px solid #111827;">
                    <dt style="font-family:'JetBrains Mono',monospace; font-size:9px;
                               text-transform:uppercase; letter-spacing:0.1em; color:#475569;">
                        Nom Complet
                    </dt>
                    <dd style="font-family:'Archivo Black',sans-serif; font-size:12px;
                               color:#f1f5f9; margin:0; text-align:right; max-width:160px;">
                        {{ $player->full_name }}
                    </dd>
                </div>

                @if($player->nickname)
                <div style="display:flex; justify-content:space-between; align-items:center;
                            padding:10px 0; border-bottom:1px solid #111827;">
                    <dt style="font-family:'JetBrains Mono',monospace; font-size:9px;
                               text-transform:uppercase; letter-spacing:0.1em; color:#475569;">
                        Surnom
                    </dt>
                    <dd style="font-family:'Archivo Black',sans-serif; font-size:12px;
                               color:#ef4444; margin:0; font-style:italic;">
                        "{{ $player->nickname }}"
                    </dd>
                </div>
                @endif

                @if($player->date_of_birth)
                <div style="display:flex; justify-content:space-between; align-items:center;
                            padding:10px 0; border-bottom:1px solid #111827;">
                    <dt style="font-family:'JetBrains Mono',monospace; font-size:9px;
                               text-transform:uppercase; letter-spacing:0.1em; color:#475569;">
                        Naissance
                    </dt>
                    <dd style="font-family:'JetBrains Mono',monospace; font-size:11px;
                               color:#94a3b8; margin:0;">
                        {{ $player->date_of_birth->format('d/m/Y') }}
                    </dd>
                </div>
                @endif

                <div style="display:flex; justify-content:space-between; align-items:center;
                            padding:10px 0;">
                    <dt style="font-family:'JetBrains Mono',monospace; font-size:9px;
                               text-transform:uppercase; letter-spacing:0.1em; color:#475569;">
                        Pays
                    </dt>
                    <dd style="font-family:'JetBrains Mono',monospace; font-size:11px;
                               color:#94a3b8; margin:0; display:flex; align-items:center; gap:6px;">
                        {{ $flag }} {{ $player->nationality }}
                    </dd>
                </div>

            </dl>
        </div>

        {{-- Réseaux sociaux --}}
        @if($player->social_twitter || $player->social_instagram || $player->social_facebook)
        <div class="pp-panel">
            <div class="pp-label">Réseaux Sociaux</div>
            <div style="display:flex; flex-direction:column; gap:8px;">

                @if($player->social_twitter)
                <a href="{{ $player->social_twitter }}" target="_blank" rel="noopener" class="pp-social-btn">
                    <div class="pp-social-icon" style="background:rgba(29,161,242,0.15);">𝕏</div>
                    <div>
                        <div class="pp-social-name">Twitter / X</div>
                        <div class="pp-social-handle">{{ parse_url($player->social_twitter, PHP_URL_PATH) }}</div>
                    </div>
                    <span style="margin-left:auto; font-family:'JetBrains Mono',monospace;
                                 font-size:10px; color:#334155;">↗</span>
                </a>
                @endif

                @if($player->social_instagram)
                <a href="{{ $player->social_instagram }}" target="_blank" rel="noopener" class="pp-social-btn">
                    <div class="pp-social-icon" style="background:rgba(225,48,108,0.15);">📸</div>
                    <div>
                        <div class="pp-social-name">Instagram</div>
                        <div class="pp-social-handle">{{ parse_url($player->social_instagram, PHP_URL_PATH) }}</div>
                    </div>
                    <span style="margin-left:auto; font-family:'JetBrains Mono',monospace;
                                 font-size:10px; color:#334155;">↗</span>
                </a>
                @endif

                @if($player->social_facebook)
                <a href="{{ $player->social_facebook }}" target="_blank" rel="noopener" class="pp-social-btn">
                    <div class="pp-social-icon" style="background:rgba(24,119,242,0.15);">👍</div>
                    <div>
                        <div class="pp-social-name">Facebook</div>
                        <div class="pp-social-handle">{{ parse_url($player->social_facebook, PHP_URL_PATH) }}</div>
                    </div>
                    <span style="margin-left:auto; font-family:'JetBrains Mono',monospace;
                                 font-size:10px; color:#334155;">↗</span>
                </a>
                @endif

            </div>
        </div>
        @endif

    </div>

</div>

</div>
