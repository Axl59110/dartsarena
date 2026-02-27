{{-- TAB CONTENT: MATCHS V2 — Fond #f1f5f9 + dark cards --}}
<div x-show="activeTab === 'matchs'" x-transition role="tabpanel">

<style>
/* ---- MATCHS V2 ---- */

/* Prochain match */
.tm-next-card {
    background: #0f172a;
    border: 1px solid #1e293b;
    border-radius: 10px;
    padding: 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    flex-wrap: wrap;
    position: relative;
    overflow: hidden;
}
.tm-next-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 2px;
    background: linear-gradient(90deg, #ef4444, #f59e0b);
}
.tm-next-vs {
    font-family: 'Inter Tight Variable', 'Inter Tight', sans-serif;
    font-weight: 900;
    font-size: 1.15rem;
    color: #f1f5f9;
    line-height: 1.2;
}
.tm-next-meta {
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.65rem;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin-top: 6px;
}
.tm-countdown-badge {
    background: linear-gradient(90deg, #ef4444, #f59e0b);
    color: #0f172a;
    font-family: 'Inter Tight Variable', 'Inter Tight', sans-serif;
    font-weight: 900;
    font-size: 0.8rem;
    padding: 8px 20px;
    border-radius: 9999px;
    white-space: nowrap;
    flex-shrink: 0;
    letter-spacing: 0.04em;
}

/* Streak W/L */
.tm-streak-square {
    width: 32px;
    height: 32px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Inter Tight Variable', 'Inter Tight', sans-serif;
    font-weight: 900;
    font-size: 0.75rem;
    color: white;
    flex-shrink: 0;
}
.tm-streak-square.w { background: #16a34a; }
.tm-streak-square.l { background: #ef4444; }

/* Carte match light */
.tm-match-row {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-left: 3px solid transparent;
    border-radius: 8px;
    padding: 14px 18px;
    display: flex;
    align-items: center;
    gap: 14px;
    transition: box-shadow 0.15s, border-color 0.15s;
    flex-wrap: wrap;
    text-decoration: none;
}
.tm-match-row.win  { border-left-color: #16a34a; }
.tm-match-row.loss { border-left-color: #ef4444; }
.tm-match-row.clickable:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    border-color: #cbd5e1;
}
.tm-match-row.clickable.win:hover  { border-left-color: #16a34a; }
.tm-match-row.clickable.loss:hover { border-left-color: #ef4444; }

.tm-wl-badge {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Inter Tight Variable', 'Inter Tight', sans-serif;
    font-weight: 900;
    font-size: 0.9rem;
    color: white;
    flex-shrink: 0;
}
.tm-wl-badge.win  { background: #16a34a; }
.tm-wl-badge.loss { background: #ef4444; }

.tm-match-body { flex: 1; min-width: 0; }
.tm-match-opp {
    font-family: 'Inter Tight Variable', 'Inter Tight', sans-serif;
    font-weight: 700;
    font-size: 0.9rem;
    color: #0f172a;
    margin-bottom: 3px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.tm-match-details {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.6rem;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: #94a3b8;
}
.tm-match-avg {
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.65rem;
    color: #f59e0b;
    font-weight: 700;
}

.tm-score-block {
    text-align: right;
    flex-shrink: 0;
}
.tm-score-num {
    font-family: 'Inter Tight Variable', 'Inter Tight', sans-serif;
    font-weight: 900;
    font-size: 1.3rem;
    line-height: 1;
    color: #0f172a;
}
.tm-score-num .sep { color: #cbd5e1; font-weight: 400; margin: 0 3px; }
.tm-score-type {
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.58rem;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    margin-top: 2px;
}

/* Lien article */
.tm-article-arrow {
    color: #ef4444;
    font-size: 0.8rem;
    flex-shrink: 0;
    font-weight: 700;
}
</style>

@php
    $matchCount     = $recentMatches ? $recentMatches->count() : 0;
    $upcomingCount  = isset($upcomingMatches) ? $upcomingMatches->count() : 0;
    $wins = $losses = 0;
    $streak = [];

    if ($matchCount > 0) {
        foreach ($recentMatches as $m) {
            $won = $m->winner_id === $player->id;
            if ($won) $wins++; else $losses++;
            $streak[] = $won ? 'w' : 'l';
        }
        $winRate = round($wins / $matchCount * 100, 1);
    } else {
        $winRate = 0;
    }
@endphp

<div style="display: flex; flex-direction: column; gap: 20px;">

    {{-- 1. PROCHAIN MATCH --}}
    @if($upcomingCount > 0)
    <div class="pg-dark-card" style="padding: 24px;">
        <div class="pg-section-title">Prochain Match</div>

        @foreach($upcomingMatches->take(1) as $next)
        @php
            $isP1next   = $next->player1_id === $player->id;
            $nextOpp    = $isP1next ? $next->player2 : $next->player1;
            $daysToGo   = $next->scheduled_at ? now()->diffInDays($next->scheduled_at, false) : null;
        @endphp
        <div class="tm-next-card">
            <div>
                <div style="font-family:'JetBrains Mono',monospace; font-size:0.6rem;
                            text-transform:uppercase; letter-spacing:0.14em; color:#94a3b8; margin-bottom:8px;">
                    vs
                </div>
                <div class="tm-next-vs">{{ $nextOpp?->full_name ?? '—' }}</div>
                <div class="tm-next-meta">
                    @if($next->scheduled_at)
                        {{ $next->scheduled_at->format('d/m/Y') }}
                        @if($next->scheduled_at->format('H:i') !== '00:00')
                            · {{ $next->scheduled_at->format('H:i') }}
                        @endif
                    @endif
                    @if($next->season?->competition)
                        · {{ Str::limit($next->season->competition->name, 32) }}
                    @endif
                </div>
            </div>
            @if($daysToGo !== null && $daysToGo >= 0)
            <div class="tm-countdown-badge">
                @if($daysToGo === 0)
                    Aujourd'hui
                @elseif($daysToGo === 1)
                    Demain
                @else
                    J-{{ $daysToGo }}
                @endif
            </div>
            @endif
        </div>
        @endforeach

        {{-- Matchs suivants si plusieurs --}}
        @if($upcomingCount > 1)
        <div style="margin-top: 12px; display: flex; flex-direction: column; gap: 6px;">
            @foreach($upcomingMatches->skip(1) as $next)
            @php
                $isP1next = $next->player1_id === $player->id;
                $nextOpp  = $isP1next ? $next->player2 : $next->player1;
            @endphp
            <div style="background:#080e1a; border:1px solid #1e293b; border-radius:6px;
                        padding:10px 14px; display:flex; align-items:center;
                        justify-content:space-between; gap:12px;">
                <div>
                    <span style="font-family:'Inter Tight Variable','Inter Tight',sans-serif;
                                 font-weight:600; font-size:0.82rem; color:#f1f5f9;">
                        vs {{ $nextOpp?->full_name ?? '—' }}
                    </span>
                </div>
                <span style="font-family:'JetBrains Mono',monospace; font-size:0.6rem;
                             color:#94a3b8; white-space:nowrap;">
                    {{ $next->scheduled_at?->format('d/m/Y') ?? '—' }}
                </span>
            </div>
            @endforeach
        </div>
        @endif
    </div>
    @endif

    {{-- 2. FORME W/L --}}
    @if($matchCount > 0)
    <div class="pg-dark-card" style="padding: 24px;">
        <div class="pg-section-title">Forme Récente · {{ $matchCount }} matchs</div>

        {{-- Scoreboard 4 cases --}}
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; margin-bottom: 20px;">
            <div style="background:#080e1a; border:1px solid #1e293b; border-radius:8px;
                        padding:14px 8px; text-align:center;">
                <div class="pg-impact-num" style="font-size:1.8rem; color:#94a3b8;">{{ $matchCount }}</div>
                <div class="pg-mono-label" style="margin-top:4px; font-size:0.58rem;">Matchs</div>
            </div>
            <div style="background:#080e1a; border:1px solid #1e293b; border-radius:8px;
                        padding:14px 8px; text-align:center;">
                <div class="pg-impact-num" style="font-size:1.8rem; color:#16a34a;">{{ $wins }}</div>
                <div class="pg-mono-label" style="margin-top:4px; font-size:0.58rem;">Victoires</div>
            </div>
            <div style="background:#080e1a; border:1px solid #1e293b; border-radius:8px;
                        padding:14px 8px; text-align:center;">
                <div class="pg-impact-num" style="font-size:1.8rem; color:#ef4444;">{{ $losses }}</div>
                <div class="pg-mono-label" style="margin-top:4px; font-size:0.58rem;">Défaites</div>
            </div>
            <div style="background:#080e1a; border:1px solid rgba(245,158,11,0.2); border-radius:8px;
                        padding:14px 8px; text-align:center;">
                <div class="pg-impact-num" style="font-size:1.8rem; color:#f59e0b;">{{ $winRate }}%</div>
                <div class="pg-mono-label" style="margin-top:4px; font-size:0.58rem;">Win Rate</div>
            </div>
        </div>

        {{-- Barre W/L visuelle --}}
        <div>
            <div class="pg-mono-label" style="color:#94a3b8; margin-bottom:10px; font-size:0.58rem;">
                Résultats récents (du plus ancien au plus récent) →
            </div>
            <div style="display:flex; gap:4px; flex-wrap:wrap;">
                @foreach(array_slice(array_reverse($streak), 0, 15) as $r)
                <div class="tm-streak-square {{ $r }}" title="{{ $r === 'w' ? 'Victoire' : 'Défaite' }}">
                    {{ strtoupper($r) }}
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- 3. LISTE DES MATCHS --}}
    <div class="pg-light-card" style="padding: 24px;">
        <div class="pg-section-title">Historique des Matchs</div>

        <div style="display: flex; flex-direction: column; gap: 8px;">
            @foreach($recentMatches as $match)
            @php
                $isPlayer1   = $match->player1_id === $player->id;
                $opponent    = $isPlayer1 ? $match->player2 : $match->player1;
                $playerScore = $match->best_of_sets
                    ? ($isPlayer1 ? $match->player1_score_sets : $match->player2_score_sets)
                    : ($isPlayer1 ? $match->player1_score_legs : $match->player2_score_legs);
                $oppScore    = $match->best_of_sets
                    ? ($isPlayer1 ? $match->player2_score_sets : $match->player1_score_sets)
                    : ($isPlayer1 ? $match->player2_score_legs : $match->player1_score_legs);
                $playerAvg   = $isPlayer1 ? $match->player1_average : $match->player2_average;
                $won         = $match->winner_id === $player->id;
                $hasArticle  = !empty($match->article_slug);
            @endphp

            @if($hasArticle)
            <a href="{{ route('articles.show', $match->article_slug) }}"
               class="tm-match-row {{ $won ? 'win' : 'loss' }} clickable">
            @else
            <div class="tm-match-row {{ $won ? 'win' : 'loss' }}">
            @endif

                <div class="tm-wl-badge {{ $won ? 'win' : 'loss' }}">
                    {{ $won ? 'V' : 'D' }}
                </div>

                <div class="tm-match-body">
                    <div class="tm-match-opp">
                        vs {{ $opponent?->full_name ?? '—' }}
                    </div>
                    <div class="tm-match-details">
                        @if($match->scheduled_at)
                        <span>{{ $match->scheduled_at->format('d/m/Y') }}</span>
                        @endif
                        @if($match->season?->competition)
                        <span>{{ Str::limit($match->season->competition->name, 30) }}</span>
                        @endif
                        @if($playerAvg)
                        <span class="tm-match-avg">AVG {{ number_format($playerAvg, 2) }}</span>
                        @endif
                    </div>
                </div>

                <div class="tm-score-block">
                    <div class="tm-score-num">
                        {{ $playerScore ?? '—' }}<span class="sep">–</span>{{ $oppScore ?? '—' }}
                    </div>
                    <div class="tm-score-type">{{ $match->best_of_sets ? 'Sets' : 'Legs' }}</div>
                </div>

                @if($hasArticle)
                <div class="tm-article-arrow">→</div>
                @endif

            @if($hasArticle)
            </a>
            @else
            </div>
            @endif

            @endforeach
        </div>
    </div>

    @else

    {{-- Aucun match --}}
    <div class="pg-dark-card" style="padding: 56px 24px; text-align: center;">
        <div style="font-size: 2.5rem; opacity: 0.12; margin-bottom: 16px;">⚔️</div>
        <div style="font-family:'Inter Tight Variable','Inter Tight',sans-serif;
                    font-weight:700; font-size:0.95rem; color:#f1f5f9; margin-bottom:8px;">
            Aucun Match Disponible
        </div>
        <div class="pg-body-text" style="font-size:0.82rem; color:#94a3b8;">
            Les matchs de ce joueur apparaîtront ici dès l'intégration des données.
        </div>
    </div>

    @endif

</div>

</div>
