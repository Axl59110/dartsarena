{{-- TAB CONTENT: NINE DARTERS --}}
<div x-show="activeTab === 'nine-darters'" x-transition role="tabpanel">
    @if($nineDarters->count() > 0)
        <div class="holo-card rounded-xl p-8">
            <h2 class="font-gaming text-2xl text-white mb-8 uppercase tracking-wider flex items-center gap-3">
                <span class="text-3xl">🎯</span>
                {{ __('9-Darters Parfaits') }}
                <span class="ml-auto font-gaming text-4xl text-primary">{{ $nineDarters->count() }}</span>
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($nineDarters as $nineDarter)
                    <div class="holo-card rounded-xl overflow-hidden group cursor-pointer"
                         @click="videoModal.open('{{ $nineDarter->getYouTubeEmbedUrl() }}', '9-Darter #{{ $nineDarter->order_number }}')">
                        {{-- Thumbnail --}}
                        <div class="relative aspect-video bg-slate-900 overflow-hidden">
                            @if($nineDarter->getVideoThumbnailUrl())
                                <img
                                    src="{{ $nineDarter->getVideoThumbnailUrl() }}"
                                    alt="9-Darter #{{ $nineDarter->order_number }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                                />
                            @endif

                            {{-- Play Button Overlay --}}
                            <div class="absolute inset-0 bg-black/50 flex items-center justify-center group-hover:bg-black/30 transition-colors">
                                <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <svg class="w-8 h-8 text-white ml-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                    </svg>
                                </div>
                            </div>

                            {{-- Order Badge --}}
                            <div class="absolute top-3 left-3 px-4 py-2 bg-gradient-to-r from-amber-500 to-orange-500 rounded-lg">
                                <span class="font-gaming text-white text-lg">#{{ $nineDarter->order_number }}</span>
                            </div>

                            @if($nineDarter->on_tv)
                                <div class="absolute top-3 right-3 px-3 py-1 bg-red-600 rounded-full text-white text-xs font-bold uppercase tracking-wider">
                                    📺 TV
                                </div>
                            @endif
                        </div>

                        {{-- Info --}}
                        <div class="p-4">
                            <div class="font-bold text-white mb-2">
                                {{ $nineDarter->competition->name ?? __('Compétition') }}
                            </div>

                            @if($nineDarter->match)
                                <div class="text-sm text-slate-400 mb-3">
                                    {{ __('vs') }}
                                    {{ $nineDarter->match->player1_id === $player->id ? $nineDarter->match->player2->full_name : $nineDarter->match->player1->full_name }}
                                </div>
                            @endif

                            <div class="flex items-center justify-between text-xs text-slate-500 font-mono">
                                <span>{{ $nineDarter->achieved_at ? $nineDarter->achieved_at->format('d/m/Y') : '-' }}</span>
                                <span class="text-primary font-bold uppercase">{{ __('Voir vidéo') }} →</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="holo-card rounded-xl p-12 text-center">
            <div class="text-6xl mb-4 opacity-20">🎯</div>
            <h2 class="font-gaming text-2xl text-white mb-3">
                {{ __('Aucun 9-Darter Enregistré') }}
            </h2>
            <p class="text-slate-500 italic">
                {{ __('Les 9-darters parfaits de ce joueur seront affichés ici.') }}
            </p>
        </div>
    @endif
</div>
