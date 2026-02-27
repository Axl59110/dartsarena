{{-- HERO SECTION --}}
<div class="player-hero">
    <div style="max-width:1280px; margin:0 auto; padding:48px 16px;">
        <div style="display:grid; grid-template-columns:1fr; gap:32px; align-items:start;">

            {{-- Layout desktop: carte gauche + dashboard droit --}}
            <style>
                @media (min-width: 1024px) {
                    .hero-grid { grid-template-columns: 340px 1fr !important; }
                }
            </style>
            <div class="hero-grid" style="display:grid; grid-template-columns:1fr; gap:32px; align-items:start;">

                {{-- GAUCHE : Carte joueur --}}
                <div class="player-card-left" style="padding:32px 24px; text-align:center;">

                    {{-- Photo --}}
                    <div style="position:relative; display:inline-block; margin-bottom:24px;">
                        <div class="player-photo-ring">
                            @if($player->photo_url)
                                <img src="{{ $player->photo_url }}" alt="{{ $player->full_name }}" loading="eager">
                            @else
                                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:#0f172a;">
                                    <span style="font-family:'Archivo Black',sans-serif; font-size:3rem; color:#ef4444;">
                                        {{ strtoupper(substr($player->first_name,0,1)) }}{{ strtoupper(substr($player->last_name,0,1)) }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        {{-- Badge rang --}}
                        @if($latestRanking)
                        <div class="rank-badge rank-badge-glow"
                             style="position:absolute; bottom:-12px; left:50%; transform:translateX(-50%);">
                            <span style="font-family:'Archivo Black',sans-serif; font-size:1.1rem; color:#fff;">
                                #{{ $latestRanking->position }}
                            </span>
                        </div>
                        @endif
                    </div>

                    {{-- Nom --}}
                    <h1 style="font-family:'Archivo Black',sans-serif; font-size:1.75rem; color:#f1f5f9;
                               line-height:1.1; margin:0 0 8px; margin-top:8px;">
                        {{ $player->full_name }}
                    </h1>

                    @if($player->nickname)
                    <p style="color:#ef4444; font-size:1.1rem; font-style:italic; margin:0 0 16px;">
                        "{{ $player->nickname }}"
                    </p>
                    @endif

                    {{-- Pays + âge --}}
                    <div style="display:flex; align-items:center; justify-content:center; gap:10px;
                                color:#94a3b8; margin-bottom:24px; flex-wrap:wrap;">
                        @if($player->country_code)
                            @php
                                $flags = ['GB'=>'🇬🇧','EN'=>'🏴󠁧󠁢󠁥󠁮󠁧󠁿','NL'=>'🇳🇱','AU'=>'🇦🇺','BE'=>'🇧🇪','DE'=>'🇩🇪','IE'=>'🇮🇪','US'=>'🇺🇸','WA'=>'🏴󠁧󠁢󠁷󠁬󠁳󠁿'];
                                $flagEmoji = $flags[strtoupper($player->country_code)] ?? '🌍';
                            @endphp
                            <span style="font-size:1.5rem;">{{ $flagEmoji }}</span>
                            <span style="font-size:0.9rem; font-weight:600;">{{ $player->nationality }}</span>
                        @endif
                        @if($player->date_of_birth)
                            <span style="color:#475569;">•</span>
                            <span style="font-size:0.9rem;">{{ $player->date_of_birth->age }} {{ __('ans') }}</span>
                        @endif
                    </div>

                    {{-- Stats rapides --}}
                    <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:12px;
                                padding-top:20px; border-top:1px solid #334155;">
                        <div style="text-align:center;">
                            <div style="font-family:'Archivo Black',sans-serif; font-size:1.75rem; color:#f59e0b; line-height:1;">
                                {{ $player->career_titles }}
                            </div>
                            <div style="font-size:10px; color:#64748b; text-transform:uppercase;
                                        letter-spacing:0.05em; margin-top:4px; font-family:'JetBrains Mono',monospace;">
                                {{ __('Titres') }}
                            </div>
                        </div>
                        <div style="text-align:center;">
                            <div style="font-family:'Archivo Black',sans-serif; font-size:1.75rem; color:#a78bfa; line-height:1;">
                                {{ $player->career_9darters }}
                            </div>
                            <div style="font-size:10px; color:#64748b; text-transform:uppercase;
                                        letter-spacing:0.05em; margin-top:4px; font-family:'JetBrains Mono',monospace;">
                                9-Darters
                            </div>
                        </div>
                        <div style="text-align:center;">
                            <div style="font-family:'Archivo Black',sans-serif; font-size:1.6rem; color:#60a5fa; line-height:1;">
                                {{ $player->career_highest_average > 0 ? number_format($player->career_highest_average, 2) : '—' }}
                            </div>
                            <div style="font-size:10px; color:#64748b; text-transform:uppercase;
                                        letter-spacing:0.05em; margin-top:4px; font-family:'JetBrains Mono',monospace;">
                                Best Avg
                            </div>
                        </div>
                    </div>
                </div>

                {{-- DROITE : Dashboard stats --}}
                <div style="display:flex; flex-direction:column; gap:16px;">

                    {{-- 4 KPI cards --}}
                    <div style="display:grid; grid-template-columns:repeat(2,1fr); gap:12px;">
                        <style>@media(min-width:640px){ .kpi-grid { grid-template-columns:repeat(4,1fr) !important; } }</style>

                        <div class="kpi-grid" style="display:grid; grid-template-columns:repeat(2,1fr); gap:12px; grid-column:1/-1;">
                            <div class="kpi-card">
                                <div class="kpi-label">Win Rate</div>
                                <div class="kpi-value pg-text-green">{{ $careerStats['win_rate'] ?? 0 }}%</div>
                                <div class="pg-bar-track">
                                    <div class="pg-bar-fill" style="width:{{ $careerStats['win_rate'] ?? 0 }}%; background:#10b981;"></div>
                                </div>
                            </div>

                            <div class="kpi-card">
                                <div class="kpi-label">{{ __('Matchs') }}</div>
                                <div class="kpi-value pg-text-primary">{{ $careerStats['total_matches'] ?? 0 }}</div>
                                <div style="font-family:'JetBrains Mono',monospace; font-size:12px; color:#64748b;">
                                    <span style="color:#10b981;">{{ $careerStats['wins'] ?? 0 }}W</span>
                                    <span style="color:#475569; margin:0 4px;">—</span>
                                    <span style="color:#ef4444;">{{ $careerStats['losses'] ?? 0 }}L</span>
                                </div>
                            </div>

                            <div class="kpi-card">
                                <div class="kpi-label">Average</div>
                                <div class="kpi-value pg-text-cyan">{{ $careerStats['avg_average'] ?? '—' }}</div>
                                <div style="font-family:'JetBrains Mono',monospace; font-size:11px; color:#64748b;">
                                    {{ __('Carrière') }}
                                </div>
                            </div>

                            <div class="kpi-card">
                                <div class="kpi-label">Total 180s</div>
                                <div class="kpi-value pg-text-yellow">{{ $careerStats['total_180s'] ?? 0 }}</div>
                                <div style="font-family:'JetBrains Mono',monospace; font-size:11px; color:#64748b;">
                                    CO% {{ $careerStats['avg_checkout'] ?? 0 }}%
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Records personnels --}}
                    <div class="pg-card" style="padding:20px 24px;">
                        <div style="font-family:'Archivo Black',sans-serif; font-size:14px; color:#94a3b8;
                                    text-transform:uppercase; letter-spacing:0.06em; margin-bottom:16px;">
                            {{ __('Records Personnels') }}
                        </div>
                        <div>
                            @if($player->career_highest_average)
                            <div class="stat-row">
                                <span class="stat-label">{{ __('Meilleure Moyenne') }}</span>
                                <span class="stat-value pg-text-amber">{{ $player->career_highest_average }}</span>
                            </div>
                            @endif
                            @if($player->career_9darters > 0)
                            <div class="stat-row">
                                <span class="stat-label">9-Darters</span>
                                <span class="stat-value pg-text-purple">{{ $player->career_9darters }}</span>
                            </div>
                            @endif
                            @if($player->career_titles > 0)
                            <div class="stat-row">
                                <span class="stat-label">{{ __('Titres') }}</span>
                                <span class="stat-value pg-text-blue">{{ $player->career_titles }}</span>
                            </div>
                            @endif
                            @if($latestRanking)
                            <div class="stat-row">
                                <span class="stat-label">{{ __('Classement') }} {{ $latestRanking->federation->name ?? 'PDC' }}</span>
                                <span class="stat-value pg-text-red">#{{ $latestRanking->position }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>{{-- /hero-grid --}}
        </div>
    </div>
</div>
