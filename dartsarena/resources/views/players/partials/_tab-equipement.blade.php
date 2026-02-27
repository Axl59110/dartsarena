{{-- TAB CONTENT: ÉQUIPEMENT --}}
<div x-show="activeTab === 'equipement'" x-transition role="tabpanel">
    @if($currentEquipments->count() > 0 || $previousEquipments->count() > 0)

        {{-- Setup actuel --}}
        @if($currentEquipments->count() > 0)
        <div style="margin-bottom:32px;">
            <h2 style="font-family:'Archivo Black',sans-serif; font-size:1.2rem; color:#f1f5f9;
                       text-transform:uppercase; letter-spacing:0.06em; margin:0 0 20px;
                       display:flex; align-items:center; gap:10px;">
                ⚙️ {{ __('Setup Actuel') }}
            </h2>
            <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(240px,1fr)); gap:16px;">
                @foreach($currentEquipments as $equipment)
                <div class="pg-card" style="overflow:hidden;">
                    @if($equipment->photo_url)
                    <div style="background:#0f172a; padding:24px; display:flex; align-items:center; justify-content:center; aspect-ratio:1;">
                        <img src="{{ $equipment->photo_url }}" alt="{{ $equipment->brand }}"
                             loading="lazy" style="max-height:140px; max-width:100%; object-fit:contain;">
                    </div>
                    @endif
                    <div style="padding:16px;">
                        <div style="margin-bottom:10px;">
                            <span style="display:inline-block; padding:3px 10px;
                                         background:rgba(239,68,68,0.15); color:#ef4444;
                                         font-family:'JetBrains Mono',monospace; font-size:10px;
                                         font-weight:700; text-transform:uppercase; letter-spacing:0.06em;
                                         border-radius:9999px;">
                                {{ __($equipment->equipment_type) }}
                            </span>
                        </div>
                        <div style="font-family:'Archivo Black',sans-serif; font-size:1rem; color:#f1f5f9; margin-bottom:4px;">
                            {{ $equipment->brand }}
                        </div>
                        <div style="color:#94a3b8; font-size:0.9rem; margin-bottom:8px;">
                            {{ $equipment->model }}
                        </div>
                        @if($equipment->description)
                        <p style="font-size:12px; color:#64748b; margin:0 0 12px; line-height:1.5;
                                  display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">
                            {{ $equipment->description }}
                        </p>
                        @endif
                        @if($equipment->affiliate_link)
                        <a href="{{ $equipment->affiliate_link }}" target="_blank" rel="noopener noreferrer nofollow sponsored"
                           style="display:block; text-align:center; padding:10px; background:#ef4444;
                                  color:white; font-family:'Archivo Black',sans-serif; font-size:12px;
                                  text-transform:uppercase; letter-spacing:0.05em; border-radius:8px;
                                  text-decoration:none; transition:background 0.15s;"
                           onmouseover="this.style.background='#dc2626'" onmouseout="this.style.background='#ef4444'">
                            {{ __('Acheter') }} →
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
        <div>
            <h2 style="font-family:'Archivo Black',sans-serif; font-size:1rem; color:#64748b;
                       text-transform:uppercase; letter-spacing:0.06em; margin:0 0 16px;
                       display:flex; align-items:center; gap:10px;">
                📦 {{ __('Équipements Précédents') }}
            </h2>
            <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(180px,1fr)); gap:12px; opacity:0.65;">
                @foreach($previousEquipments as $equipment)
                <div class="pg-card" style="padding:14px;">
                    @if($equipment->photo_url)
                    <div style="background:#0f172a; border-radius:6px; padding:12px; margin-bottom:10px;
                                display:flex; align-items:center; justify-content:center; aspect-ratio:1;">
                        <img src="{{ $equipment->photo_url }}" alt="{{ $equipment->brand }}"
                             loading="lazy" style="max-height:80px; object-fit:contain;">
                    </div>
                    @endif
                    <div style="font-family:'Archivo Black',sans-serif; font-size:0.85rem; color:#f1f5f9; margin-bottom:3px;">
                        {{ $equipment->brand }}
                    </div>
                    <div style="font-family:'JetBrains Mono',monospace; font-size:11px; color:#64748b; margin-bottom:4px;">
                        {{ $equipment->model }}
                    </div>
                    @if($equipment->period)
                    <div style="font-family:'JetBrains Mono',monospace; font-size:10px; color:#475569; font-style:italic;">
                        {{ $equipment->period }}
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif

    @else
        <div class="pg-card" style="padding:48px; text-align:center;">
            <div style="font-size:3rem; opacity:0.15; margin-bottom:12px;">⚙️</div>
            <h2 style="font-family:'Archivo Black',sans-serif; font-size:1.2rem; color:#f1f5f9; margin:0 0 8px;">
                {{ __('Aucun Équipement Référencé') }}
            </h2>
            <p style="color:#475569; font-style:italic; margin:0;">
                {{ __("Les informations sur l'équipement de ce joueur seront bientôt disponibles.") }}
            </p>
        </div>
    @endif
</div>
