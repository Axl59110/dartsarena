{{-- TAB CONTENT: PROFIL --}}
<div x-show="activeTab === 'profil'" x-transition role="tabpanel">
    <div style="display:grid; grid-template-columns:1fr; gap:24px;">
        <style>@media(min-width:1024px){ .profil-grid { grid-template-columns:1fr 340px !important; } }</style>
        <div class="profil-grid" style="display:grid; grid-template-columns:1fr; gap:24px;">

            {{-- Bio --}}
            <div class="pg-card" style="padding:32px;">
                <h2 style="font-family:'Archivo Black',sans-serif; font-size:1.2rem; color:#f1f5f9;
                           text-transform:uppercase; letter-spacing:0.06em; margin:0 0 20px;
                           display:flex; align-items:center; gap:10px;">
                    📖 {{ __('Biographie') }}
                </h2>
                @if($player->bio)
                    <p style="color:#94a3b8; line-height:1.8; font-size:1rem; white-space:pre-line; margin:0;">
                        {{ $player->bio }}
                    </p>
                @else
                    <p style="color:#475569; font-style:italic; margin:0;">
                        {{ __('Aucune biographie disponible pour le moment.') }}
                    </p>
                @endif
            </div>

            {{-- Infos --}}
            <div style="display:flex; flex-direction:column; gap:16px;">
                <div class="pg-card" style="padding:24px;">
                    <h3 style="font-family:'Archivo Black',sans-serif; font-size:13px; color:#64748b;
                               text-transform:uppercase; letter-spacing:0.06em; margin:0 0 20px;">
                        {{ __('Informations') }}
                    </h3>
                    <dl style="display:flex; flex-direction:column; gap:14px; margin:0;">
                        <div>
                            <dt style="font-size:10px; color:#64748b; text-transform:uppercase; letter-spacing:0.08em;
                                       font-family:'JetBrains Mono',monospace; margin-bottom:3px;">
                                {{ __('Nom Complet') }}
                            </dt>
                            <dd style="color:#f1f5f9; font-weight:700; font-size:1rem; margin:0;">
                                {{ $player->full_name }}
                            </dd>
                        </div>

                        @if($player->nickname)
                        <div>
                            <dt style="font-size:10px; color:#64748b; text-transform:uppercase; letter-spacing:0.08em;
                                       font-family:'JetBrains Mono',monospace; margin-bottom:3px;">
                                {{ __('Surnom') }}
                            </dt>
                            <dd style="color:#ef4444; font-weight:700; font-size:1rem; font-style:italic; margin:0;">
                                "{{ $player->nickname }}"
                            </dd>
                        </div>
                        @endif

                        <div>
                            <dt style="font-size:10px; color:#64748b; text-transform:uppercase; letter-spacing:0.08em;
                                       font-family:'JetBrains Mono',monospace; margin-bottom:3px;">
                                {{ __('Nationalité') }}
                            </dt>
                            <dd style="color:#f1f5f9; font-weight:600; margin:0;">{{ $player->nationality }}</dd>
                        </div>

                        @if($player->date_of_birth)
                        <div>
                            <dt style="font-size:10px; color:#64748b; text-transform:uppercase; letter-spacing:0.08em;
                                       font-family:'JetBrains Mono',monospace; margin-bottom:3px;">
                                {{ __('Date de Naissance') }}
                            </dt>
                            <dd style="color:#f1f5f9; font-weight:600; margin:0;">
                                {{ $player->date_of_birth->format('d/m/Y') }}
                                <span style="color:#64748b; font-size:0.85rem;">
                                    ({{ $player->date_of_birth->age }} {{ __('ans') }})
                                </span>
                            </dd>
                        </div>
                        @endif

                        @if($player->height_cm)
                        <div>
                            <dt style="font-size:10px; color:#64748b; text-transform:uppercase; letter-spacing:0.08em;
                                       font-family:'JetBrains Mono',monospace; margin-bottom:3px;">
                                {{ __('Taille') }}
                            </dt>
                            <dd style="color:#f1f5f9; font-weight:600; margin:0;">{{ $player->height_cm }} cm</dd>
                        </div>
                        @endif

                        @if($player->handedness)
                        <div>
                            <dt style="font-size:10px; color:#64748b; text-transform:uppercase; letter-spacing:0.08em;
                                       font-family:'JetBrains Mono',monospace; margin-bottom:3px;">
                                {{ __('Main') }}
                            </dt>
                            <dd style="color:#f1f5f9; font-weight:600; margin:0;">{{ __($player->handedness) }}</dd>
                        </div>
                        @endif

                        @if($latestRanking)
                        <div style="padding-top:14px; border-top:1px solid #334155;">
                            <dt style="font-size:10px; color:#64748b; text-transform:uppercase; letter-spacing:0.08em;
                                       font-family:'JetBrains Mono',monospace; margin-bottom:6px;">
                                {{ __('Classement Actuel') }}
                            </dt>
                            <dd style="margin:0;">
                                <span style="font-family:'Archivo Black',sans-serif; font-size:2.5rem; color:#ef4444; line-height:1;">
                                    #{{ $latestRanking->position }}
                                </span>
                                <span style="display:block; font-size:12px; color:#64748b; margin-top:2px;">
                                    {{ $latestRanking->federation->name ?? 'PDC' }}
                                </span>
                            </dd>
                        </div>
                        @endif
                    </dl>
                </div>

                {{-- Réseaux sociaux --}}
                @if($player->social_twitter || $player->social_instagram || $player->social_facebook)
                <div class="pg-card" style="padding:20px;">
                    <h3 style="font-family:'Archivo Black',sans-serif; font-size:13px; color:#64748b;
                               text-transform:uppercase; letter-spacing:0.06em; margin:0 0 14px;">
                        {{ __('Réseaux Sociaux') }}
                    </h3>
                    <div style="display:flex; gap:10px;">
                        @if($player->social_twitter)
                        <a href="{{ $player->social_twitter }}" target="_blank" rel="noopener"
                           style="flex:1; background:#0f172a; padding:10px; border-radius:8px; text-align:center;
                                  text-decoration:none; border:1px solid #334155; transition:background 0.15s;"
                           onmouseover="this.style.background='#1d4ed8'" onmouseout="this.style.background='#0f172a'">
                            🐦
                        </a>
                        @endif
                        @if($player->social_instagram)
                        <a href="{{ $player->social_instagram }}" target="_blank" rel="noopener"
                           style="flex:1; background:#0f172a; padding:10px; border-radius:8px; text-align:center;
                                  text-decoration:none; border:1px solid #334155; transition:background 0.15s;"
                           onmouseover="this.style.background='#9d174d'" onmouseout="this.style.background='#0f172a'">
                            📸
                        </a>
                        @endif
                        @if($player->social_facebook)
                        <a href="{{ $player->social_facebook }}" target="_blank" rel="noopener"
                           style="flex:1; background:#0f172a; padding:10px; border-radius:8px; text-align:center;
                                  text-decoration:none; border:1px solid #334155; transition:background 0.15s;"
                           onmouseover="this.style.background='#1e3a8a'" onmouseout="this.style.background='#0f172a'">
                            👍
                        </a>
                        @endif
                    </div>
                </div>
                @endif
            </div>

        </div>
    </div>
</div>
