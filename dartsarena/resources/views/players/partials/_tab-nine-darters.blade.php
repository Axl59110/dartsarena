{{-- TAB CONTENT: NINE DARTERS V2 — Fond #f1f5f9 + dark cards --}}
<div x-show="activeTab === 'nine-darters'" x-transition role="tabpanel">

<style>
/* ---- NINE DARTERS V2 ---- */

/* Grille galerie */
.nd-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 16px;
}

/* Carte nine-darter light */
.nd-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    overflow: hidden;
    cursor: pointer;
    transition: box-shadow 0.2s, transform 0.15s;
    position: relative;
}
.nd-card:hover {
    box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}
.nd-card.no-video {
    cursor: default;
}
.nd-card.no-video:hover {
    transform: none;
    box-shadow: none;
}

/* Thumbnail */
.nd-thumb {
    position: relative;
    aspect-ratio: 16/9;
    background: #0f172a;
    overflow: hidden;
}
.nd-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s;
}
.nd-card:hover .nd-thumb img { transform: scale(1.04); }
.nd-thumb-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: radial-gradient(circle at 50% 50%, rgba(239,68,68,0.08), transparent 70%);
}

/* Overlay play */
.nd-play-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.35);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s;
}
.nd-card:hover .nd-play-overlay { background: rgba(0,0,0,0.5); }
.nd-play-btn {
    width: 54px;
    height: 54px;
    background: linear-gradient(135deg, #ef4444, #f59e0b);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 0 28px rgba(239,68,68,0.4);
    transition: transform 0.2s, box-shadow 0.2s;
}
.nd-card:hover .nd-play-btn {
    transform: scale(1.1);
    box-shadow: 0 0 40px rgba(239,68,68,0.6);
}

/* Badges thumbnail */
.nd-badge-num {
    position: absolute;
    top: 10px; left: 10px;
    background: linear-gradient(90deg, #ef4444, #f59e0b);
    border-radius: 6px;
    padding: 4px 12px;
    font-family: 'Inter Tight Variable', 'Inter Tight', sans-serif;
    font-weight: 900;
    color: white;
    font-size: 0.82rem;
}
.nd-badge-tv {
    position: absolute;
    top: 10px; right: 10px;
    background: rgba(239,68,68,0.9);
    border-radius: 9999px;
    padding: 3px 10px;
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.58rem;
    color: white;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    backdrop-filter: blur(4px);
}

/* Info bas de carte */
.nd-card-info {
    padding: 14px 16px;
}
.nd-card-comp {
    font-family: 'Inter Tight Variable', 'Inter Tight', sans-serif;
    font-weight: 700;
    font-size: 0.88rem;
    color: #0f172a;
    margin-bottom: 4px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.nd-card-vs {
    font-family: 'Inter Variable', 'Inter', sans-serif;
    font-size: 0.78rem;
    color: #64748b;
    margin-bottom: 8px;
}
.nd-card-foot {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.6rem;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: #94a3b8;
}

/* Timeline chronologique */
.nd-tl {
    position: relative;
    padding-left: 28px;
}
.nd-tl::before {
    content: '';
    position: absolute;
    left: 7px; top: 6px; bottom: 6px;
    width: 2px;
    background: linear-gradient(to bottom, #ef4444, #e2e8f0 70%, transparent);
}
.nd-tl-item { position: relative; margin-bottom: 10px; }
.nd-tl-item:last-child { margin-bottom: 0; }
.nd-tl-dot {
    position: absolute;
    left: -24px; top: 50%;
    transform: translateY(-50%);
    width: 16px; height: 16px;
    border-radius: 50%;
    background: linear-gradient(135deg, #ef4444, #f59e0b);
    border: 2px solid #f1f5f9;
    display: flex; align-items: center; justify-content: center;
    font-family: 'Inter Tight Variable', 'Inter Tight', sans-serif;
    font-weight: 900;
    font-size: 6px;
    color: white;
}
.nd-tl-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 12px 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    transition: box-shadow 0.15s;
}
.nd-tl-card:hover { box-shadow: 0 2px 8px rgba(0,0,0,0.06); }
.nd-tl-title {
    font-family: 'Inter Tight Variable', 'Inter Tight', sans-serif;
    font-weight: 700;
    font-size: 0.85rem;
    color: #0f172a;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.nd-tl-sub {
    font-family: 'JetBrains Mono', monospace;
    font-size: 0.6rem;
    color: #94a3b8;
    margin-top: 2px;
}
.nd-tl-year {
    font-family: 'Inter Tight Variable', 'Inter Tight', sans-serif;
    font-weight: 900;
    font-size: 1rem;
    color: #f59e0b;
    flex-shrink: 0;
}
</style>

@php
    $ndCount  = $nineDarters->count();
    $onTv     = $nineDarters->where('on_tv', true)->count();
    $withVid  = $nineDarters->filter(fn($n) => $n->getYouTubeEmbedUrl())->count();
@endphp

@if($ndCount > 0)

<div style="display: flex; flex-direction: column; gap: 20px;">

    {{-- 1. COMPTEUR HERO --}}
    <div class="pg-dark-card" style="padding: 36px 24px; text-align: center;">
        <div class="pg-mono-label" style="color:#4b5563; margin-bottom:10px; letter-spacing:0.18em;">
            PERFECTION · DARTSARENA
        </div>
        <div class="pg-impact-num" style="font-size: clamp(4rem,10vw,6rem); color:#f59e0b;">
            {{ $ndCount }}
        </div>
        <div style="font-family:'Inter Variable','Inter',sans-serif; font-size:0.85rem;
                    color:#475569; margin-top:8px; text-transform:uppercase; letter-spacing:0.1em;">
            9-Darters Légendaires
        </div>

        {{-- Mini badges --}}
        <div style="display:flex; justify-content:center; gap:20px; margin-top:24px; flex-wrap:wrap;">
            @if($onTv > 0)
            <div style="text-align:center;">
                <div class="pg-impact-num" style="font-size:1.5rem; color:#ef4444;">{{ $onTv }}</div>
                <div class="pg-mono-label" style="font-size:0.58rem; color:#334155; margin-top:3px;">
                    En Direct TV
                </div>
            </div>
            @endif
            @if($withVid > 0)
            <div style="text-align:center;">
                <div class="pg-impact-num" style="font-size:1.5rem; color:#f59e0b;">{{ $withVid }}</div>
                <div class="pg-mono-label" style="font-size:0.58rem; color:#334155; margin-top:3px;">
                    Vidéos Dispo
                </div>
            </div>
            @endif
        </div>
    </div>

    {{-- 2. GALERIE --}}
    <div class="pg-light-card" style="padding: 24px;">
        <div class="pg-section-title">Galerie</div>
        <div class="nd-grid">
            @foreach($nineDarters as $nd)
            @php $embedUrl = $nd->getYouTubeEmbedUrl(); @endphp
            <div class="nd-card {{ $embedUrl ? '' : 'no-video' }}"
                 @if($embedUrl)
                 @click="videoModal.open('{{ $embedUrl }}', '9-Darter #{{ $nd->order_number }} — {{ $nd->competition->name ?? '' }}')"
                 @endif>

                {{-- Thumbnail --}}
                <div class="nd-thumb">
                    @if($nd->getVideoThumbnailUrl())
                        <img src="{{ $nd->getVideoThumbnailUrl() }}"
                             alt="9-Darter #{{ $nd->order_number }}"
                             loading="lazy">
                    @else
                        <div class="nd-thumb-placeholder">
                            <span style="font-size:3rem; opacity:0.15;">⚡</span>
                        </div>
                    @endif

                    @if($embedUrl)
                    <div class="nd-play-overlay">
                        <div class="nd-play-btn">
                            <svg width="22" height="22" fill="white" viewBox="0 0 20 20" style="margin-left:3px;">
                                <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                            </svg>
                        </div>
                    </div>
                    @endif

                    <div class="nd-badge-num">#{{ $nd->order_number }}</div>
                    @if($nd->on_tv)
                    <div class="nd-badge-tv">📺 TV</div>
                    @endif
                </div>

                {{-- Infos --}}
                <div class="nd-card-info">
                    <div class="nd-card-comp">{{ $nd->competition->name ?? 'Compétition' }}</div>
                    @if($nd->match)
                    <div class="nd-card-vs">
                        vs {{ $nd->match->player1_id === $player->id
                            ? $nd->match->player2->full_name
                            : $nd->match->player1->full_name }}
                    </div>
                    @endif
                    <div class="nd-card-foot">
                        <span>{{ $nd->achieved_at?->format('d/m/Y') ?? '—' }}</span>
                        @if($embedUrl)
                        <span style="color:#ef4444; font-weight:700;">Voir ▶</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- 3. TIMELINE --}}
    @if($ndCount > 1)
    <div class="pg-light-card" style="padding: 24px 28px;">
        <div class="pg-section-title">Chronologie</div>
        <div class="nd-tl">
            @foreach($nineDarters->sortBy('achieved_at') as $nd)
            <div class="nd-tl-item">
                <div class="nd-tl-dot">{{ $nd->order_number }}</div>
                <div class="nd-tl-card">
                    <div style="flex:1; min-width:0;">
                        <div class="nd-tl-title">{{ $nd->competition->name ?? 'Compétition' }}</div>
                        <div class="nd-tl-sub">
                            @if($nd->match)
                                vs {{ $nd->match->player1_id === $player->id
                                    ? $nd->match->player2->full_name
                                    : $nd->match->player1->full_name }}
                            @endif
                        </div>
                    </div>
                    <div style="display:flex; align-items:center; gap:8px; flex-shrink:0;">
                        @if($nd->on_tv)
                        <span style="background:#ef4444; border-radius:9999px; padding:2px 8px;
                                     font-family:'JetBrains Mono',monospace; font-size:0.55rem;
                                     color:white; text-transform:uppercase; letter-spacing:0.06em;">
                            TV
                        </span>
                        @endif
                        <span class="nd-tl-year">{{ $nd->achieved_at?->format('Y') ?? '—' }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

</div>

@else

<div class="pg-dark-card" style="text-align:center; padding:56px 24px;">
    <div style="font-size:2.5rem; opacity:0.12; margin-bottom:16px;">⚡</div>
    <div style="font-family:'Inter Tight Variable','Inter Tight',sans-serif;
                font-weight:700; font-size:0.95rem; color:#334155; margin-bottom:8px;">
        Aucun 9-Darter Enregistré
    </div>
    <div class="pg-body-text" style="font-size:0.82rem; color:#475569; line-height:1.6;">
        Les 9-darters parfaits de ce joueur<br>seront affichés ici dès leur enregistrement.
    </div>
</div>

@endif

</div>
