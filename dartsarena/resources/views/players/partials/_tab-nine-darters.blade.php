{{-- TAB CONTENT: NINE DARTERS — Trading Card Premium --}}
<div x-show="activeTab === 'nine-darters'" x-transition role="tabpanel">

<style>
/* ---- NINE DARTERS ---- */
.nd-panel {
    background: #0d1424;
    border: 1px solid #1e293b;
    border-radius: 14px;
    padding: 24px;
    position: relative;
    overflow: hidden;
}
.nd-panel::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, #a78bfa, #8b5cf6, #7c3aed);
}
.nd-label {
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
.nd-label::after {
    content: '';
    flex: 1;
    height: 1px;
    background: linear-gradient(90deg, #1e293b, transparent);
}

/* Compteur hero */
.nd-counter {
    background: linear-gradient(135deg, rgba(167,139,250,0.1), rgba(124,58,237,0.05));
    border: 1px solid rgba(167,139,250,0.2);
    border-radius: 12px;
    padding: 32px 24px;
    text-align: center;
    position: relative;
    overflow: hidden;
    margin-bottom: 20px;
}
.nd-counter::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 2px;
    background: linear-gradient(90deg, transparent, #a78bfa, #8b5cf6, transparent);
}
.nd-counter-num {
    font-family: 'Archivo Black', sans-serif;
    font-size: clamp(3.5rem, 8vw, 5rem);
    color: #a78bfa;
    line-height: 1;
    position: relative;
    z-index: 1;
}
.nd-counter-sub {
    font-family: 'JetBrains Mono', monospace;
    font-size: 10px;
    text-transform: uppercase;
    letter-spacing: 0.15em;
    color: #64748b;
    margin-top: 8px;
}

/* Grille cartes */
.nd-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 16px;
}

.nd-card {
    background: #080e1a;
    border: 1px solid #1e293b;
    border-radius: 12px;
    overflow: hidden;
    cursor: pointer;
    transition: border-color 0.2s, transform 0.15s;
    position: relative;
}
.nd-card:hover {
    border-color: rgba(167,139,250,0.4);
    transform: translateY(-2px);
}
.nd-card-no-video {
    cursor: default;
}
.nd-card-no-video:hover {
    transform: none;
    border-color: rgba(167,139,250,0.2);
}

/* Thumbnail */
.nd-thumb {
    position: relative;
    aspect-ratio: 16/9;
    background: #04080f;
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
    background: radial-gradient(circle at 50% 50%, rgba(167,139,250,0.06), transparent 70%);
}

/* Overlay play */
.nd-play-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.4);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s;
}
.nd-card:hover .nd-play-overlay { background: rgba(0,0,0,0.55); }
.nd-play-btn {
    width: 56px;
    height: 56px;
    background: linear-gradient(135deg, #a78bfa, #7c3aed);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 0 30px rgba(167,139,250,0.4);
    transition: transform 0.2s, box-shadow 0.2s;
}
.nd-card:hover .nd-play-btn {
    transform: scale(1.1);
    box-shadow: 0 0 40px rgba(167,139,250,0.6);
}

/* Badges sur thumbnail */
.nd-badge-num {
    position: absolute;
    top: 10px;
    left: 10px;
    background: linear-gradient(90deg, #a78bfa, #7c3aed);
    border-radius: 6px;
    padding: 4px 12px;
    font-family: 'Archivo Black', sans-serif;
    color: white;
    font-size: 0.85rem;
}
.nd-badge-tv {
    position: absolute;
    top: 10px;
    right: 10px;
    background: #ef4444;
    border-radius: 9999px;
    padding: 3px 10px;
    font-family: 'JetBrains Mono', monospace;
    font-size: 10px;
    color: white;
    font-weight: 700;
    letter-spacing: 0.05em;
}

/* Infos bas de carte */
.nd-card-info {
    padding: 14px 16px;
}
.nd-card-comp {
    font-family: 'Archivo Black', sans-serif;
    font-size: 0.9rem;
    color: #f1f5f9;
    margin-bottom: 6px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.nd-card-vs {
    font-family: 'JetBrains Mono', monospace;
    font-size: 11px;
    color: #94a3b8;
    margin-bottom: 8px;
}
.nd-card-foot {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-family: 'JetBrains Mono', monospace;
    font-size: 10px;
    color: #475569;
}

/* Timeline */
.nd-timeline {
    position: relative;
    padding-left: 28px;
}
.nd-timeline::before {
    content: '';
    position: absolute;
    left: 7px;
    top: 6px;
    bottom: 6px;
    width: 2px;
    background: linear-gradient(to bottom, #a78bfa, #334155 60%, transparent);
}
.nd-tl-item {
    position: relative;
    margin-bottom: 16px;
}
.nd-tl-item:last-child { margin-bottom: 0; }
.nd-tl-dot {
    position: absolute;
    left: -24px;
    top: 50%;
    transform: translateY(-50%);
    width: 16px;
    height: 16px;
    border-radius: 50%;
    background: #a78bfa;
    border: 2px solid #0d1424;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 7px;
    color: white;
}
.nd-tl-card {
    background: #080e1a;
    border: 1px solid #1e293b;
    border-radius: 10px;
    padding: 12px 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
}
.nd-tl-card:hover { border-color: rgba(167,139,250,0.2); }
</style>

@if($nineDarters->count() > 0)

<div style="display:flex; flex-direction:column; gap:16px;">

    {{-- Compteur --}}
    <div class="nd-panel">
        <div class="nd-counter">
            <div style="font-family:'JetBrains Mono',monospace; font-size:9px; letter-spacing:0.2em;
                        text-transform:uppercase; color:#4c1d95; margin-bottom:10px;">
                Perfections · DARTSARENA
            </div>
            <div class="nd-counter-num">{{ $nineDarters->count() }}</div>
            <div class="nd-counter-sub">9-Darters Légendaires</div>

            {{-- Mini stats --}}
            <div style="display:flex; justify-content:center; gap:24px; margin-top:20px;">
                @php
                    $onTv = $nineDarters->where('on_tv', true)->count();
                    $withVideo = $nineDarters->filter(fn($n) => $n->getYouTubeEmbedUrl())->count();
                @endphp
                @if($onTv > 0)
                <div style="text-align:center;">
                    <div style="font-family:'Archivo Black',sans-serif; font-size:1.3rem; color:#ef4444; line-height:1;">
                        {{ $onTv }}
                    </div>
                    <div style="font-family:'JetBrains Mono',monospace; font-size:8px;
                                text-transform:uppercase; letter-spacing:0.1em; color:#334155; margin-top:3px;">
                        En Direct TV
                    </div>
                </div>
                @endif
                @if($withVideo > 0)
                <div style="text-align:center;">
                    <div style="font-family:'Archivo Black',sans-serif; font-size:1.3rem; color:#a78bfa; line-height:1;">
                        {{ $withVideo }}
                    </div>
                    <div style="font-family:'JetBrains Mono',monospace; font-size:8px;
                                text-transform:uppercase; letter-spacing:0.1em; color:#334155; margin-top:3px;">
                        Vidéos Disponibles
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- Galerie --}}
        <div class="nd-label">Galerie</div>
        <div class="nd-grid">
            @foreach($nineDarters as $nd)
            <div class="nd-card {{ $nd->getYouTubeEmbedUrl() ? '' : 'nd-card-no-video' }}"
                 @if($nd->getYouTubeEmbedUrl())
                 @click="videoModal.open('{{ $nd->getYouTubeEmbedUrl() }}', '9-Darter #{{ $nd->order_number }} — {{ $nd->competition->name ?? '' }}')"
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

                    @if($nd->getYouTubeEmbedUrl())
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
                    <div class="nd-card-comp">
                        {{ $nd->competition->name ?? 'Compétition' }}
                    </div>
                    @if($nd->match)
                    <div class="nd-card-vs">
                        vs {{ $nd->match->player1_id === $player->id
                            ? $nd->match->player2->full_name
                            : $nd->match->player1->full_name }}
                    </div>
                    @endif
                    <div class="nd-card-foot">
                        <span>{{ $nd->achieved_at?->format('d/m/Y') ?? '—' }}</span>
                        @if($nd->getYouTubeEmbedUrl())
                        <span style="color:#a78bfa; font-weight:700;">Voir ▶</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Timeline chronologique --}}
    @if($nineDarters->count() > 1)
    <div class="nd-panel">
        <div class="nd-label">Chronologie</div>
        <div class="nd-timeline">
            @foreach($nineDarters->sortBy('achieved_at') as $nd)
            <div class="nd-tl-item">
                <div class="nd-tl-dot">{{ $nd->order_number }}</div>
                <div class="nd-tl-card">
                    <div style="flex:1; min-width:0;">
                        <div style="font-family:'Archivo Black',sans-serif; font-size:0.88rem;
                                    color:#f1f5f9; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                            {{ $nd->competition->name ?? 'Compétition' }}
                        </div>
                        <div style="font-family:'JetBrains Mono',monospace; font-size:10px; color:#475569; margin-top:3px;">
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
                                     font-family:'JetBrains Mono',monospace; font-size:9px; color:white;">
                            TV
                        </span>
                        @endif
                        <span style="font-family:'Archivo Black',sans-serif; font-size:0.9rem; color:#a78bfa;">
                            {{ $nd->achieved_at?->format('Y') ?? '—' }}
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

</div>

@else

<div class="nd-panel" style="text-align:center; padding:56px 24px;">
    <div style="font-size:3rem; opacity:0.1; margin-bottom:16px;">⚡</div>
    <div style="font-family:'Archivo Black',sans-serif; font-size:1rem; color:#334155; margin-bottom:8px;">
        Aucun 9-Darter Enregistré
    </div>
    <div style="font-family:'JetBrains Mono',monospace; font-size:11px; color:#1e293b; line-height:1.6;">
        Les 9-darters parfaits de ce joueur<br>seront affichés ici dès leur enregistrement.
    </div>
</div>

@endif

</div>
