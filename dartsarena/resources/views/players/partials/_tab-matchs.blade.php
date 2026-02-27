{{-- TAB CONTENT: MATCHS --}}
<div x-show="activeTab === 'matchs'" x-transition role="tabpanel">
    <div class="pg-card" style="padding:32px;">
        <h2 style="font-family:'Archivo Black',sans-serif; font-size:1.2rem; color:#f1f5f9;
                   text-transform:uppercase; letter-spacing:0.06em; margin:0 0 24px;
                   display:flex; align-items:center; gap:10px;">
            ⚔️ {{ __('Matchs Récents') }}
        </h2>

        @if($recentMatches && $recentMatches->count() > 0)
            <div style="display:flex; flex-direction:column; gap:10px;">
                @foreach($recentMatches as $match)
                @php
                    $isPlayer1 = $match->player1_id === $player->id;
                    $opponent  = $isPlayer1 ? $match->player2 : $match->player1;
                    if ($isPlayer1) {
                        $playerScore   = $match->best_of_sets ? $match->player1_score_sets : $match->player1_score_legs;
                        $opponentScore = $match->best_of_sets ? $match->player2_score_sets : $match->player2_score_legs;
                        $playerAvg     = $match->player1_average;
                    } else {
                        $playerScore   = $match->best_of_sets ? $match->player2_score_sets : $match->player2_score_legs;
                        $opponentScore = $match->best_of_sets ? $match->player1_score_sets : $match->player1_score_legs;
                        $playerAvg     = $match->player2_average;
                    }
                    $won = $match->winner_id === $player->id;
                @endphp

                <div class="match-row {{ $won ? 'win' : 'loss' }}"
                     style="display:flex; align-items:center; gap:14px; flex-wrap:wrap;">

                    {{-- Badge W/L --}}
                    <div class="result-badge {{ $won ? 'win' : 'loss' }}">
                        {{ $won ? 'W' : 'L' }}
                    </div>

                    {{-- Infos match --}}
                    <div style="flex:1; min-width:160px;">
                        <div style="display:flex; align-items:center; gap:8px; margin-bottom:4px;">
                            <span style="font-family:'JetBrains Mono',monospace; font-size:11px; color:#64748b;">
                                {{ $match->scheduled_at?->format('d/m/Y') ?? '—' }}
                            </span>
                            @if($match->season?->competition)
                                <span style="color:#334155;">•</span>
                                <span style="font-family:'JetBrains Mono',monospace; font-size:11px; color:#94a3b8;">
                                    {{ $match->season->competition->name }}
                                </span>
                            @endif
                        </div>
                        <div style="font-family:'Archivo Black',sans-serif; font-size:1rem; color:#f1f5f9; margin-bottom:4px;">
                            vs {{ $opponent?->full_name ?? '—' }}
                        </div>
                        <div style="display:flex; gap:14px; font-family:'JetBrains Mono',monospace; font-size:11px; color:#64748b;">
                            @if($playerAvg)
                                <span>AVG: <span style="color:#22d3ee; font-weight:700;">{{ number_format($playerAvg,2) }}</span></span>
                            @endif
                        </div>
                    </div>

                    {{-- Score --}}
                    <div style="text-align:right; min-width:80px;">
                        <div style="font-family:'Archivo Black',sans-serif; font-size:1.75rem;
                                    color:{{ $won ? '#10b981' : '#f1f5f9' }}; line-height:1;">
                            {{ $playerScore }}<span style="color:#334155; margin:0 4px;">—</span>{{ $opponentScore }}
                        </div>
                        <div style="font-family:'JetBrains Mono',monospace; font-size:10px; color:#64748b;
                                    text-transform:uppercase; letter-spacing:0.05em; margin-top:2px;">
                            {{ $match->best_of_sets ? __('Sets') : __('Legs') }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div style="text-align:center; padding:48px 0;">
                <div style="font-size:3rem; opacity:0.15; margin-bottom:12px;">⚔️</div>
                <p style="color:#475569; font-style:italic; font-size:1rem; margin:0;">
                    {{ __('Aucun match récent disponible.') }}
                </p>
            </div>
        @endif
    </div>
</div>
