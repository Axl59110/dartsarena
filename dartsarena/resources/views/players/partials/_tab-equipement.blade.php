{{-- TAB CONTENT: ÉQUIPEMENT V2 — Fond #f1f5f9 + dark/light cards --}}
<div x-show="activeTab === 'equipement'" x-transition role="tabpanel">

<style>
/* ---- ÉQUIPEMENT V2 ---- */

/* Grille setup actuel */
.eq-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 16px;
}

/* Carte équipement */
.eq-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    overflow: hidden;
    transition: box-shadow 0.2s, transform 0.15s;
}
.eq-card:hover {
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    transform: translateY(-2px);
}

/* Photo produit */
.eq-photo {
    background: #0f172a;
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
    background: radial-gradient(circle at 50% 50%, rgba(245,158,11,0.06), transparent 65%);
}
.eq-photo img {
    max-height: 140px;
    max-width: 100%;
    object-fit: contain;
    position: relative;
    z-index: 1;
}
.eq-photo-placeholder {
    font-size: 2.8rem;
    opacity: 0.12;
}

/* Badge type */
.eq-type-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 3px 10px;
    border-radius: 9999px;
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.58rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
}

/* Info produit */
.eq-info { padding: 16px; }
.eq-brand {
    font-family: 'Inter Tight Variable', 'Inter Tight', sans-serif;
    font-weight: 700;
    font-size: 1rem;
    color: #0f172a;
    margin-bottom: 2px;
}
.eq-model {
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.7rem;
    color: #64748b;
    margin-bottom: 10px;
}
.eq-desc {
    font-family: 'Inter Variable', 'Inter', sans-serif;
    font-size: 0.78rem;
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
    background: linear-gradient(90deg, #ef4444, #f59e0b);
    color: white;
    font-family: 'Inter Tight Variable', 'Inter Tight', sans-serif;
    font-weight: 700;
    font-size: 0.78rem;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    border-radius: 8px;
    text-decoration: none;
    transition: opacity 0.15s;
}
.eq-buy-btn:hover { opacity: 0.88; }

/* Grille précédents */
.eq-prev-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 10px;
}
.eq-prev-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 14px;
    opacity: 0.65;
    transition: opacity 0.15s;
}
.eq-prev-card:hover { opacity: 0.95; }
</style>

@php
    $typeColors = [
        'barrel'  => ['bg' => 'rgba(245,158,11,0.12)',  'color' => '#d97706',  'icon' => '🎯'],
        'flight'  => ['bg' => 'rgba(239,68,68,0.12)',   'color' => '#dc2626',  'icon' => '✈️'],
        'shaft'   => ['bg' => 'rgba(100,116,139,0.12)', 'color' => '#475569',  'icon' => '⚙️'],
        'tip'     => ['bg' => 'rgba(245,158,11,0.12)',  'color' => '#f59e0b',  'icon' => '📌'],
        'board'   => ['bg' => 'rgba(239,68,68,0.12)',   'color' => '#ef4444',  'icon' => '🎯'],
        'default' => ['bg' => 'rgba(148,163,184,0.1)',  'color' => '#64748b',  'icon' => '⚙️'],
    ];
    $getTypeStyle = function($type) use ($typeColors) {
        $key = strtolower($type ?? 'default');
        return $typeColors[$key] ?? $typeColors['default'];
    };
@endphp

@if($currentEquipments->count() > 0 || $previousEquipments->count() > 0)

<div style="display: flex; flex-direction: column; gap: 20px;">

    {{-- Setup actuel --}}
    @if($currentEquipments->count() > 0)
    <div class="pg-light-card" style="padding: 24px;">
        <div class="pg-section-title">Setup Actuel</div>
        <div class="eq-grid">
            @foreach($currentEquipments as $equipment)
            @php $ts = $getTypeStyle($equipment->equipment_type); @endphp
            <div class="eq-card">

                <div class="eq-photo">
                    @if($equipment->photo_url)
                        <img src="{{ $equipment->photo_url }}"
                             alt="{{ $equipment->brand }} {{ $equipment->model }}"
                             loading="lazy">
                    @else
                        <div class="eq-photo-placeholder">{{ $ts['icon'] }}</div>
                    @endif
                </div>

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
    <div class="pg-light-card" style="padding: 24px;">
        <div class="pg-section-title">Équipements Précédents</div>
        <div class="eq-prev-grid">
            @foreach($previousEquipments as $equipment)
            @php $ts = $getTypeStyle($equipment->equipment_type); @endphp
            <div class="eq-prev-card">
                @if($equipment->photo_url)
                <div style="background:#f8fafc; border-radius:6px; padding:12px; margin-bottom:10px;
                            display:flex; align-items:center; justify-content:center; aspect-ratio:1;">
                    <img src="{{ $equipment->photo_url }}"
                         alt="{{ $equipment->brand }}"
                         loading="lazy"
                         style="max-height:60px; object-fit:contain;">
                </div>
                @endif
                <div style="margin-bottom:6px;">
                    <span class="eq-type-badge"
                          style="background:{{ $ts['bg'] }}; color:{{ $ts['color'] }}; font-size:0.55rem;">
                        {{ $ts['icon'] }} {{ __($equipment->equipment_type) }}
                    </span>
                </div>
                <div style="font-family:'Inter Tight Variable','Inter Tight',sans-serif;
                            font-weight:700; font-size:0.82rem; color:#334155; margin-bottom:2px;">
                    {{ $equipment->brand }}
                </div>
                <div style="font-family:'JetBrains Mono',monospace; font-size:0.62rem;
                            color:#94a3b8; margin-bottom:4px;">
                    {{ $equipment->model }}
                </div>
                @if($equipment->period)
                <div style="font-family:'JetBrains Mono',monospace; font-size:0.58rem; color:#cbd5e1;">
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

<div class="pg-dark-card" style="text-align:center; padding:56px 24px;">
    <div style="font-size:2.5rem; opacity:0.12; margin-bottom:16px;">⚙️</div>
    <div style="font-family:'Inter Tight Variable','Inter Tight',sans-serif;
                font-weight:700; font-size:0.95rem; color:#94a3b8; margin-bottom:8px;">
        Aucun Équipement Référencé
    </div>
    <div class="pg-body-text" style="font-size:0.82rem; color:#64748b; line-height:1.6;">
        Les informations sur l'équipement de ce joueur<br>seront disponibles prochainement.
    </div>
</div>

@endif

</div>
