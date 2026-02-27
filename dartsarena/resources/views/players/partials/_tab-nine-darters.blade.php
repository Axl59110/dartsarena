{{-- TAB CONTENT: NINE DARTERS --}}
<div x-show="activeTab === 'nine-darters'" x-transition role="tabpanel">
    @if($nineDarters->count() > 0)
        <div class="pg-card" style="padding:32px;">
            <h2 style="font-family:'Archivo Black',sans-serif; font-size:1.2rem; color:#f1f5f9;
                       text-transform:uppercase; letter-spacing:0.06em; margin:0 0 24px;
                       display:flex; align-items:center; justify-content:space-between;">
                <span style="display:flex; align-items:center; gap:10px;">
                    🎯 {{ __('9-Darters Parfaits') }}
                </span>
                <span style="font-family:'Archivo Black',sans-serif; font-size:2rem; color:#ef4444;">
                    {{ $nineDarters->count() }}
                </span>
            </h2>

            <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(280px,1fr)); gap:20px;">
                @foreach($nineDarters as $nineDarter)
                <div class="nine-darter-card"
                     @if($nineDarter->getYouTubeEmbedUrl())
                     style="cursor:pointer;"
                     @click="videoModal.open('{{ $nineDarter->getYouTubeEmbedUrl() }}', '9-Darter #{{ $nineDarter->order_number }}')"
                     @endif>

                    {{-- Thumbnail --}}
                    <div style="position:relative; aspect-ratio:16/9; background:#0f172a; overflow:hidden;">
                        @if($nineDarter->getVideoThumbnailUrl())
                            <img src="{{ $nineDarter->getVideoThumbnailUrl() }}"
                                 alt="9-Darter #{{ $nineDarter->order_number }}"
                                 style="width:100%; height:100%; object-fit:cover;"
                                 loading="lazy">
                        @else
                            <div style="width:100%; height:100%; display:flex; align-items:center;
                                        justify-content:center; font-size:3rem; opacity:0.2;">🎯</div>
                        @endif

                        {{-- Overlay play --}}
                        @if($nineDarter->getYouTubeEmbedUrl())
                        <div style="position:absolute; inset:0; background:rgba(0,0,0,0.45);
                                    display:flex; align-items:center; justify-content:center;">
                            <div style="width:52px; height:52px; background:#ef4444; border-radius:50%;
                                        display:flex; align-items:center; justify-content:center;">
                                <svg width="22" height="22" fill="white" viewBox="0 0 20 20" style="margin-left:3px;">
                                    <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                </svg>
                            </div>
                        </div>
                        @endif

                        {{-- Badge numéro --}}
                        <div style="position:absolute; top:10px; left:10px;
                                    background:linear-gradient(90deg,#f59e0b,#ea580c);
                                    border-radius:6px; padding:4px 12px;">
                            <span style="font-family:'Archivo Black',sans-serif; color:white; font-size:0.9rem;">
                                #{{ $nineDarter->order_number }}
                            </span>
                        </div>

                        @if($nineDarter->on_tv)
                        <div style="position:absolute; top:10px; right:10px;
                                    background:#ef4444; border-radius:9999px;
                                    padding:3px 10px; font-size:11px; color:white; font-weight:700;">
                            📺 TV
                        </div>
                        @endif
                    </div>

                    {{-- Infos --}}
                    <div style="padding:14px 16px;">
                        <div style="font-family:'Archivo Black',sans-serif; font-size:0.95rem; color:#f1f5f9; margin-bottom:6px;">
                            {{ $nineDarter->competition->name ?? __('Compétition') }}
                        </div>
                        @if($nineDarter->match)
                        <div style="font-family:'JetBrains Mono',monospace; font-size:12px; color:#94a3b8; margin-bottom:8px;">
                            vs {{ $nineDarter->match->player1_id === $player->id
                                ? $nineDarter->match->player2->full_name
                                : $nineDarter->match->player1->full_name }}
                        </div>
                        @endif
                        <div style="display:flex; justify-content:space-between; align-items:center;
                                    font-family:'JetBrains Mono',monospace; font-size:11px; color:#64748b;">
                            <span>{{ $nineDarter->achieved_at?->format('d/m/Y') ?? '—' }}</span>
                            @if($nineDarter->getYouTubeEmbedUrl())
                            <span style="color:#ef4444; font-weight:700; font-size:11px;">{{ __('Voir') }} →</span>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="pg-card" style="padding:48px; text-align:center;">
            <div style="font-size:3rem; opacity:0.15; margin-bottom:12px;">🎯</div>
            <h2 style="font-family:'Archivo Black',sans-serif; font-size:1.2rem; color:#f1f5f9; margin:0 0 8px;">
                {{ __('Aucun 9-Darter Enregistré') }}
            </h2>
            <p style="color:#475569; font-style:italic; margin:0;">
                {{ __('Les 9-darters parfaits de ce joueur seront affichés ici.') }}
            </p>
        </div>
    @endif
</div>
