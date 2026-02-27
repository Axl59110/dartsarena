{{-- TAB CONTENT: PROFIL V2 — Bio + Sidebar --}}
<div x-show="activeTab === 'profil'" x-transition role="tabpanel">

@php
    $flagMap = [
        'England'          => '🏴󠁧󠁢󠁥󠁮󠁧󠁿',
        'Netherlands'      => '🇳🇱',
        'Scotland'         => '🏴󠁧󠁢󠁳󠁣󠁴󠁿',
        'Wales'            => '🏴󠁧󠁢󠁷󠁬󠁳󠁿',
        'Germany'          => '🇩🇪',
        'Belgium'          => '🇧🇪',
        'Australia'        => '🇦🇺',
        'Northern Ireland' => '🇬🇧',
        'Ireland'          => '🇮🇪',
        'Austria'          => '🇦🇹',
        'New Zealand'      => '🇳🇿',
        'Canada'           => '🇨🇦',
        'USA'              => '🇺🇸',
        'Sweden'           => '🇸🇪',
        'Denmark'          => '🇩🇰',
        'Czech Republic'   => '🇨🇿',
    ];
    $flag = $flagMap[$player->nationality ?? ''] ?? '🏳️';

    /* Fléchettes actives depuis player_equipments */
    $barrel = isset($currentEquipments)
        ? $currentEquipments->firstWhere('equipment_type', 'barrel')
          ?? $currentEquipments->firstWhere('equipment_type', 'Barrel')
        : null;
@endphp

<style>
/* ---- PROFIL V2 ---- */
@media (min-width: 1024px) {
    .prof-layout { display: grid; grid-template-columns: 1fr 300px; gap: 24px; align-items: start; }
}
@media (max-width: 1023px) {
    .prof-layout { display: flex; flex-direction: column; gap: 16px; }
}

/* Bio */
.prof-bio {
    font-family: 'Inter Variable', 'Inter', -apple-system, sans-serif;
    font-size: 1rem;
    color: #334155;
    line-height: 1.9;
    white-space: pre-line;
    margin: 0;
    padding-left: 20px;
    border-left: 3px solid #ef4444;
}
.prof-bio-wrap {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 28px 32px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.06);
}
.prof-bio-empty {
    font-family: 'Inter Variable', 'Inter', -apple-system, sans-serif;
    font-size: 0.9rem;
    color: #94a3b8;
    font-style: italic;
}

/* Sidebar dark cards */
.prof-sidebar-card {
    background: #0f172a;
    border: 1px solid #1e293b;
    border-radius: 8px;
    padding: 20px;
    position: relative;
    overflow: hidden;
}
.prof-sidebar-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 2px;
    background: linear-gradient(90deg, #ef4444, #f59e0b);
}

/* Rang joueur */
.prof-rank-num {
    font-family: 'Inter Tight Variable', 'Inter Tight', -apple-system, sans-serif;
    font-weight: 900;
    font-size: clamp(2.8rem, 6vw, 4rem);
    color: #ef4444;
    line-height: 1;
    letter-spacing: -0.04em;
}

/* Ligne info sidebar */
.prof-info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 9px 0;
    border-bottom: 1px solid #0f1f33;
    gap: 8px;
}
.prof-info-row:last-child { border-bottom: none; }
.prof-info-key {
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.62rem;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: #475569;
    flex-shrink: 0;
}
.prof-info-val {
    font-family: 'Inter Tight Variable', 'Inter Tight', -apple-system, sans-serif;
    font-weight: 600;
    font-size: 0.82rem;
    color: #f1f5f9;
    text-align: right;
}

/* Bouton réseau social */
.prof-social-link {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 14px;
    background: #080e1a;
    border: 1px solid #1e293b;
    border-radius: 6px;
    text-decoration: none;
    transition: border-color 0.15s;
    margin-bottom: 6px;
}
.prof-social-link:last-child { margin-bottom: 0; }
.prof-social-link:hover { border-color: #334155; }
.prof-social-icon {
    width: 28px; height: 28px;
    border-radius: 6px;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.85rem;
    flex-shrink: 0;
}
.prof-social-name {
    font-family: 'Inter Tight Variable', 'Inter Tight', -apple-system, sans-serif;
    font-weight: 600;
    font-size: 0.78rem;
    color: #f1f5f9;
    flex: 1;
}
.prof-social-handle {
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.6rem;
    color: #475569;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 90px;
}
</style>

<div class="prof-layout">

    {{-- COLONNE PRINCIPALE : Biographie --}}
    <div>
        <div class="prof-bio-wrap">
            <div class="pg-section-title" style="margin-bottom:20px;">Biographie</div>

            @if($player->bio)
                <p class="prof-bio">{{ $player->bio }}</p>
            @else
                <div style="padding: 32px 0; text-align: center;">
                    <p class="prof-bio-empty">
                        Aucune biographie disponible pour {{ $player->full_name }} pour le moment.
                    </p>
                </div>
            @endif
        </div>
    </div>

    {{-- SIDEBAR : 4 dark cards --}}
    <div style="display: flex; flex-direction: column; gap: 12px;">

        {{-- 1. Classement (si disponible) --}}
        @if($latestRanking ?? false)
        <div class="prof-sidebar-card">
            <div class="pg-section-title">Classement</div>
            <div style="display: flex; align-items: baseline; gap: 6px; margin-bottom: 4px;">
                <span style="font-family:'JetBrains Mono',monospace; font-size:1.1rem; color:#ef4444;">#</span>
                <span class="prof-rank-num">{{ $latestRanking->position }}</span>
            </div>
            <div style="font-family:'JetBrains Mono',monospace; font-size:0.65rem;
                        text-transform:uppercase; letter-spacing:0.1em; color:#475569;">
                {{ $latestRanking->federation->name ?? 'PDC' }} World Rankings
            </div>
        </div>
        @endif

        {{-- 2. Identité officielle --}}
        <div class="prof-sidebar-card">
            <div class="pg-section-title">Identité</div>
            <div>
                @if($player->nationality)
                <div class="prof-info-row">
                    <span class="prof-info-key">Nationalité</span>
                    <span class="prof-info-val">{{ $flag }} {{ $player->nationality }}</span>
                </div>
                @endif

                @if($player->date_of_birth)
                <div class="prof-info-row">
                    <span class="prof-info-key">Naissance</span>
                    <span class="prof-info-val">{{ $player->date_of_birth->format('d/m/Y') }}</span>
                </div>
                <div class="prof-info-row">
                    <span class="prof-info-key">Âge</span>
                    <span class="prof-info-val" style="color:#f59e0b;">{{ $player->date_of_birth->age }} ans</span>
                </div>
                @endif

                @if($player->nickname)
                <div class="prof-info-row">
                    <span class="prof-info-key">Surnom</span>
                    <span class="prof-info-val" style="color:#ef4444; font-style:italic;">
                        "{{ $player->nickname }}"
                    </span>
                </div>
                @endif

                @if($latestRanking ?? false)
                <div class="prof-info-row">
                    <span class="prof-info-key">Fédération</span>
                    <span class="prof-info-val">{{ $latestRanking->federation->name ?? 'PDC' }}</span>
                </div>
                @endif
            </div>
        </div>

        {{-- 3. Style de jeu --}}
        @if($player->handedness || $player->walk_on_song || $barrel)
        <div class="prof-sidebar-card">
            <div class="pg-section-title">Style de Jeu</div>
            <div>
                @if($player->handedness)
                <div class="prof-info-row">
                    <span class="prof-info-key">Main</span>
                    <span class="prof-info-val">
                        @if(in_array(strtolower($player->handedness), ['right','droitier']))
                            Droitier
                        @elseif(in_array(strtolower($player->handedness), ['left','gaucher']))
                            Gaucher
                        @else
                            {{ $player->handedness }}
                        @endif
                    </span>
                </div>
                @endif

                @if($barrel)
                <div class="prof-info-row">
                    <span class="prof-info-key">Fléchettes</span>
                    <span class="prof-info-val" style="font-size:0.75rem;">
                        {{ $barrel->brand }} {{ $barrel->model }}
                    </span>
                </div>
                @endif

                @if($player->walk_on_song ?? false)
                <div class="prof-info-row">
                    <span class="prof-info-key">Walk-on</span>
                    <span class="prof-info-val" style="font-size:0.75rem; color:#f59e0b;">
                        🎵 {{ $player->walk_on_song }}
                    </span>
                </div>
                @endif
            </div>
        </div>
        @endif

        {{-- 4. Réseaux sociaux --}}
        @if($player->social_twitter || $player->social_instagram || $player->social_facebook)
        <div class="prof-sidebar-card">
            <div class="pg-section-title">Réseaux Sociaux</div>

            @if($player->social_twitter)
            <a href="{{ $player->social_twitter }}" target="_blank" rel="noopener"
               class="prof-social-link">
                <div class="prof-social-icon" style="background:rgba(29,161,242,0.12); color:#1da1f2;">𝕏</div>
                <span class="prof-social-name">Twitter / X</span>
                <span class="prof-social-handle">
                    {{ ltrim(parse_url($player->social_twitter, PHP_URL_PATH), '/') }}
                </span>
            </a>
            @endif

            @if($player->social_instagram)
            <a href="{{ $player->social_instagram }}" target="_blank" rel="noopener"
               class="prof-social-link">
                <div class="prof-social-icon" style="background:rgba(225,48,108,0.12);">📸</div>
                <span class="prof-social-name">Instagram</span>
                <span class="prof-social-handle">
                    {{ ltrim(parse_url($player->social_instagram, PHP_URL_PATH), '/') }}
                </span>
            </a>
            @endif

            @if($player->social_facebook)
            <a href="{{ $player->social_facebook }}" target="_blank" rel="noopener"
               class="prof-social-link">
                <div class="prof-social-icon" style="background:rgba(24,119,242,0.12);">👍</div>
                <span class="prof-social-name">Facebook</span>
                <span class="prof-social-handle">
                    {{ ltrim(parse_url($player->social_facebook, PHP_URL_PATH), '/') }}
                </span>
            </a>
            @endif
        </div>
        @endif

    </div>{{-- /sidebar --}}
</div>

</div>
