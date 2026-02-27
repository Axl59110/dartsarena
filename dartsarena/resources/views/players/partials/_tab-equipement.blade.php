{{-- TAB CONTENT: ÉQUIPEMENT — Trading Card Premium --}}
<div x-show="activeTab === 'equipement'" x-transition role="tabpanel">

<style>
/* ---- ÉQUIPEMENT ---- */
.eq-panel {
    background: #0d1424;
    border: 1px solid #1e293b;
    border-radius: 14px;
    padding: 24px;
    position: relative;
    overflow: hidden;
}
.eq-panel::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, #22d3ee, #0ea5e9, #6366f1);
}
.eq-label {
    font-family: 'JetBrains Mono', monospace;
    font-size: 9px;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: #475569;
    margin-bottom: 18px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.eq-label::after {
    content: '';
    flex: 1;
    height: 1px;
    background: linear-gradient(90deg, #1e293b, transparent);
}

/* Grille setup actuel */
.eq-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 16px;
}
.eq-card {
    background: #080e1a;
    border: 1px solid #1e293b;
    border-radius: 12px;
    overflow: hidden;
    transition: border-color 0.2s, transform 0.15s;
}
.eq-card:hover {
    border-color: rgba(34,211,238,0.25);
    transform: translateY(-2px);
}

/* Photo produit */
.eq-photo {
    background: #04080f;
    padding: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    aspect-ratio: 4/3;
    position: relative;
    overflow: hidden;
}
.eq-photo::after {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 50% 50%, rgba(34,211,238,0.05), transparent 70%);
}
.eq-photo img {
    max-height: 140px;
    max-width: 100%;
    object-fit: contain;
    position: relative;
    z-index: 1;
}
.eq-photo-placeholder {
    font-size: 3rem;
    opacity: 0.1;
}

/* Badge type */
.eq-type-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 3px 10px;
    border-radius: 9999px;
    font-family: 'JetBrains Mono', monospace;
    font-size: 9px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
}

/* Info produit */
.eq-info {
    padding: 16px;
}
.eq-brand {
    font-family: 'Archivo Black', sans-serif;
    font-size: 1rem;
    color: #f1f5f9;
    margin-bottom: 2px;
}
.eq-model {
    font-family: 'JetBrains Mono', monospace;
    font-size: 12px;
    color: #64748b;
    margin-bottom: 10px;
}
.eq-desc {
    font-size: 11px;
    color: #475569;
    line-height: 1.5;
    margin-bottom: 12px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.eq-buy-btn {
    display: block;
    text-align: center;
    padding: 10px;
    background: linear-gradient(135deg, #22d3ee, #0ea5e9);
    color: #0f172a;
    font-family: 'Archivo Black', sans-serif;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    border-radius: 8px;
    text-decoration: none;
    transition: opacity 0.15s;
}
.eq-buy-btn:hover { opacity: 0.85; }

/* Équipements précédents */
.eq-prev-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 10px;
}
.eq-prev-card {
    background: #080e1a;
    border: 1px solid #1e293b;
    border-radius: 10px;
    padding: 14px;
    opacity: 0.6;
    transition: opacity 0.15s;
}
.eq-prev-card:hover { opacity: 0.9; }
</style>

@php
    /* Couleurs par type d'équipement */
    $typeColors = [
        'barrel'  => ['bg' => 'rgba(245,158,11,0.15)',  'color' => '#f59e0b',  'icon' => '🎯'],
        'flight'  => ['bg' => 'rgba(34,211,238,0.15)',  'color' => '#22d3ee',  'icon' => '✈️'],
        'shaft'   => ['bg' => 'rgba(167,139,250,0.15)', 'color' => '#a78bfa',  'icon' => '⚙️'],
        'tip'     => ['bg' => 'rgba(16,185,129,0.15)',  'color' => '#10b981',  'icon' => '📌'],
        'board'   => ['bg' => 'rgba(239,68,68,0.15)',   'color' => '#ef4444',  'icon' => '🎯'],
        'default' => ['bg' => 'rgba(148,163,184,0.1)',  'color' => '#94a3b8',  'icon' => '⚙️'],
    ];
    $getTypeStyle = function($type) use ($typeColors) {
        $key = strtolower($type ?? 'default');
        return $typeColors[$key] ?? $typeColors['default'];
    };
@endphp

@if($currentEquipments->count() > 0 || $previousEquipments->count() > 0)

<div style="display:flex; flex-direction:column; gap:16px;">

    {{-- Setup actuel --}}
    @if($currentEquipments->count() > 0)
    <div class="eq-panel">
        <div class="eq-label">Setup Actuel</div>
        <div class="eq-grid">
            @foreach($currentEquipments as $equipment)
            @php $ts = $getTypeStyle($equipment->equipment_type); @endphp
            <div class="eq-card">

                {{-- Photo --}}
                <div class="eq-photo">
                    @if($equipment->photo_url)
                        <img src="{{ $equipment->photo_url }}"
                             alt="{{ $equipment->brand }} {{ $equipment->model }}"
                             loading="lazy">
                    @else
                        <div class="eq-photo-placeholder">{{ $ts['icon'] }}</div>
                    @endif
                </div>

                {{-- Infos --}}
                <div class="eq-info">
                    <div style="margin-bottom:10px;">
                        <span class="eq-type-badge"
                              style="background:{{ $ts['bg'] }}; color:{{ $ts['color'] }};">
                            {{ $ts['icon'] }} {{ __($equipment->equipment_type) }}
                        </span>
                    </div>
                    <div class="eq-brand">{{ $equipment->brand }}</div>
                    <div class="eq-model">{{ $equipment->model }}</div>
                    @if($equipment->description)
                        <div class="eq-desc">{{ $equipment->description }}</div>
                    @endif
                    @if($equipment->affiliate_link)
                        <a href="{{ $equipment->affiliate_link }}"
                           target="_blank" rel="noopener noreferrer nofollow sponsored"
                           class="eq-buy-btn">
                            Acheter →
                        </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Équipements précédents --}}
    @if($previousEquipments->count() > 0)
    <div class="eq-panel" style="--before-bg: linear-gradient(90deg, #334155, #475569, #334155);">
        <style>.eq-panel.eq-prev-panel::before { background: linear-gradient(90deg, #334155, #475569); }</style>
        <div class="eq-label">Équipements Précédents</div>
        <div class="eq-prev-grid">
            @foreach($previousEquipments as $equipment)
            @php $ts = $getTypeStyle($equipment->equipment_type); @endphp
            <div class="eq-prev-card">
                @if($equipment->photo_url)
                <div style="background:#04080f; border-radius:6px; padding:12px; margin-bottom:10px;
                            display:flex; align-items:center; justify-content:center; aspect-ratio:1;">
                    <img src="{{ $equipment->photo_url }}"
                         alt="{{ $equipment->brand }}"
                         loading="lazy"
                         style="max-height:60px; object-fit:contain;">
                </div>
                @endif
                <div style="margin-bottom:6px;">
                    <span class="eq-type-badge"
                          style="background:{{ $ts['bg'] }}; color:{{ $ts['color'] }}; font-size:8px;">
                        {{ $ts['icon'] }} {{ __($equipment->equipment_type) }}
                    </span>
                </div>
                <div style="font-family:'Archivo Black',sans-serif; font-size:0.82rem;
                            color:#94a3b8; margin-bottom:2px;">
                    {{ $equipment->brand }}
                </div>
                <div style="font-family:'JetBrains Mono',monospace; font-size:10px; color:#475569; margin-bottom:4px;">
                    {{ $equipment->model }}
                </div>
                @if($equipment->period)
                <div style="font-family:'JetBrains Mono',monospace; font-size:9px; color:#334155;">
                    {{ $equipment->period }}
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @endif

</div>

@else

<div class="eq-panel" style="text-align:center; padding:56px 24px;">
    <div style="font-size:3rem; opacity:0.1; margin-bottom:16px;">⚙️</div>
    <div style="font-family:'Archivo Black',sans-serif; font-size:1rem; color:#334155; margin-bottom:8px;">
        Aucun Équipement Référencé
    </div>
    <div style="font-family:'JetBrains Mono',monospace; font-size:11px; color:#1e293b; line-height:1.6;">
        Les informations sur l'équipement de ce joueur<br>seront disponibles prochainement.
    </div>
</div>

@endif

</div>
