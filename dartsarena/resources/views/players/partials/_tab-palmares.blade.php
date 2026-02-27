{{-- TAB CONTENT: PALMARES --}}
<div x-show="activeTab === 'palmares'" x-transition role="tabpanel">
    <div class="pg-card" style="padding:32px;">
        <h2 style="font-family:'Archivo Black',sans-serif; font-size:1.2rem; color:#f1f5f9;
                   text-transform:uppercase; letter-spacing:0.06em; margin:0 0 28px;
                   display:flex; align-items:center; gap:10px;">
            <span class="trophy-glow">🏆</span> {{ __('Palmarès & Trophées') }}
        </h2>

        @if($player->career_titles > 0)
            <div style="background:rgba(245,158,11,0.08); border:2px solid rgba(245,158,11,0.3);
                        border-radius:12px; padding:32px; text-align:center; margin-bottom:24px;">
                <div class="trophy-glow" style="font-size:3rem; margin-bottom:12px;">🏆</div>
                <div style="font-family:'Archivo Black',sans-serif; font-size:4rem; color:#f59e0b; line-height:1; margin-bottom:10px;">
                    {{ $player->career_titles }}
                </div>
                <div style="font-family:'JetBrains Mono',monospace; font-size:13px; color:#94a3b8;
                            text-transform:uppercase; letter-spacing:0.08em;">
                    {{ __('Titres Remportés en Carrière') }}
                </div>
            </div>

            <div style="background:#0f172a; border-radius:10px; padding:20px; text-align:center; border:1px solid #1e293b;">
                <div style="font-size:1.5rem; margin-bottom:10px; opacity:0.5;">📅</div>
                <p style="font-family:'JetBrains Mono',monospace; font-size:12px; color:#64748b;
                          line-height:1.6; margin:0; max-width:480px; margin:0 auto;">
                    {{ __('La chronologie détaillée des victoires par compétition sera disponible prochainement via les APIs officielles.') }}
                </p>
            </div>
        @else
            <div style="text-align:center; padding:48px 0;">
                <div style="font-size:3rem; opacity:0.15; margin-bottom:12px;">🏆</div>
                <p style="color:#475569; font-style:italic; font-size:1rem; margin:0;">
                    {{ __('Aucun titre remporté pour le moment.') }}
                </p>
            </div>
        @endif
    </div>
</div>
