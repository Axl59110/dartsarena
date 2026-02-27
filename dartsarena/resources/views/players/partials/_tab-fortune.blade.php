{{-- TAB CONTENT: FORTUNE --}}
<div x-show="activeTab === 'fortune'" x-transition role="tabpanel">
    <div class="pg-card" style="padding:32px;">
        <h2 style="font-family:'Archivo Black',sans-serif; font-size:1.2rem; color:#f1f5f9;
                   text-transform:uppercase; letter-spacing:0.06em; margin:0 0 28px;
                   display:flex; align-items:center; gap:10px;">
            💰 {{ __('Prize Money & Gains') }}
        </h2>

        @if($player->career_titles > 0 || $player->career_9darters > 0)
        <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(180px,1fr)); gap:16px; margin-bottom:28px;">
            @if($player->career_titles > 0)
            <div style="background:rgba(245,158,11,0.08); border:1px solid rgba(245,158,11,0.25);
                        border-radius:10px; padding:24px; text-align:center;">
                <div style="font-family:'JetBrains Mono',monospace; font-size:10px; color:#fbbf24;
                            text-transform:uppercase; letter-spacing:0.08em; margin-bottom:8px;">
                    {{ __('Titres de Carrière') }}
                </div>
                <div style="font-family:'Archivo Black',sans-serif; font-size:3rem; color:#f59e0b; line-height:1; margin-bottom:6px;">
                    {{ $player->career_titles }}
                </div>
                <div style="font-family:'JetBrains Mono',monospace; font-size:11px; color:#64748b;">
                    {{ __('Tournois remportés') }}
                </div>
            </div>
            @endif

            @if($player->career_9darters > 0)
            <div style="background:rgba(167,139,250,0.08); border:1px solid rgba(167,139,250,0.25);
                        border-radius:10px; padding:24px; text-align:center;">
                <div style="font-family:'JetBrains Mono',monospace; font-size:10px; color:#c4b5fd;
                            text-transform:uppercase; letter-spacing:0.08em; margin-bottom:8px;">
                    {{ __('Perfections') }}
                </div>
                <div style="font-family:'Archivo Black',sans-serif; font-size:3rem; color:#a78bfa; line-height:1; margin-bottom:6px;">
                    {{ $player->career_9darters }}
                </div>
                <div style="font-family:'JetBrains Mono',monospace; font-size:11px; color:#64748b;">
                    9-Darters
                </div>
            </div>
            @endif
        </div>
        @endif

        <div style="background:#0f172a; border-radius:10px; padding:24px; text-align:center; border:1px solid #1e293b;">
            <div style="font-size:2rem; margin-bottom:12px; opacity:0.4;">📊</div>
            <p style="font-family:'JetBrains Mono',monospace; font-size:12px; color:#64748b;
                      line-height:1.7; margin:0 auto; max-width:480px;">
                {{ __('Les données financières détaillées (prize money par tournoi, sponsors, fortune nette) nécessitent un accès aux APIs officielles PDC et seront disponibles prochainement.') }}
            </p>
            <div style="margin-top:18px;">
                <a href="https://www.pdc.tv/player-rankings" target="_blank" rel="noopener"
                   style="font-family:'JetBrains Mono',monospace; font-size:12px; color:#ef4444;
                          text-decoration:underline; text-underline-offset:3px;">
                    {{ __('Classements officiels PDC') }} ↗
                </a>
            </div>
        </div>
    </div>
</div>
