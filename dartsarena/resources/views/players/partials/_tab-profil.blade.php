{{-- TAB CONTENT: PROFIL --}}
<div x-show="activeTab === 'profil'" x-transition role="tabpanel">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Bio Card --}}
        <div class="lg:col-span-2">
            <div class="holo-card rounded-xl p-8">
                <h2 class="font-gaming text-2xl text-white mb-6 uppercase tracking-wider flex items-center gap-3">
                    <span class="text-3xl">📖</span>
                    {{ __('Biographie') }}
                </h2>
                @if($player->bio)
                    <p class="text-lg leading-relaxed text-slate-300 whitespace-pre-line">{{ $player->bio }}</p>
                @else
                    <p class="text-slate-500 italic">{{ __('Aucune biographie disponible pour le moment.') }}</p>
                @endif
            </div>
        </div>

        {{-- Info Card --}}
        <div class="space-y-6">
            <div class="holo-card rounded-xl p-6">
                <h3 class="font-gaming text-lg text-white mb-6 uppercase tracking-wider">{{ __('Informations') }}</h3>
                <dl class="space-y-4">
                    <div>
                        <dt class="text-xs text-slate-500 font-mono uppercase tracking-widest mb-1">{{ __('Nom Complet') }}</dt>
                        <dd class="text-white font-bold text-lg">{{ $player->full_name }}</dd>
                    </div>

                    @if($player->nickname)
                    <div>
                        <dt class="text-xs text-slate-500 font-mono uppercase tracking-widest mb-1">{{ __('Surnom') }}</dt>
                        <dd class="text-primary font-bold text-lg italic">"{{ $player->nickname }}"</dd>
                    </div>
                    @endif

                    <div>
                        <dt class="text-xs text-slate-500 font-mono uppercase tracking-widest mb-1">{{ __('Nationalité') }}</dt>
                        <dd class="text-white font-semibold">{{ $player->nationality }}</dd>
                    </div>

                    @if($player->date_of_birth)
                    <div>
                        <dt class="text-xs text-slate-500 font-mono uppercase tracking-widest mb-1">{{ __('Date de Naissance') }}</dt>
                        <dd class="text-white font-semibold">{{ $player->date_of_birth->format('d/m/Y') }} ({{ $player->date_of_birth->age }} {{ __('ans') }})</dd>
                    </div>
                    @endif

                    @if($player->height_cm)
                    <div>
                        <dt class="text-xs text-slate-500 font-mono uppercase tracking-widest mb-1">{{ __('Taille') }}</dt>
                        <dd class="text-white font-semibold">{{ $player->height_cm }} cm</dd>
                    </div>
                    @endif

                    @if($player->handedness)
                    <div>
                        <dt class="text-xs text-slate-500 font-mono uppercase tracking-widest mb-1">{{ __('Main') }}</dt>
                        <dd class="text-white font-semibold">{{ __($player->handedness) }}</dd>
                    </div>
                    @endif

                    @if($latestRanking)
                    <div class="pt-4 border-t border-white/10">
                        <dt class="text-xs text-slate-500 font-mono uppercase tracking-widest mb-2">{{ __('Classement Actuel') }}</dt>
                        <dd class="font-gaming text-4xl text-primary">#{{ $latestRanking->position }}</dd>
                        <div class="text-sm text-slate-400 mt-1">{{ $latestRanking->federation->name ?? 'PDC' }}</div>
                    </div>
                    @endif
                </dl>
            </div>

            {{-- Social Media --}}
            @if($player->social_twitter || $player->social_instagram || $player->social_facebook)
            <div class="holo-card rounded-xl p-6">
                <h3 class="font-gaming text-lg text-white mb-4 uppercase tracking-wider">{{ __('Réseaux Sociaux') }}</h3>
                <div class="flex gap-3">
                    @if($player->social_twitter)
                        <a href="{{ $player->social_twitter }}" target="_blank" rel="noopener" class="flex-1 bg-slate-800 hover:bg-blue-600 p-3 rounded-lg transition-colors text-center">
                            <span class="text-2xl">🐦</span>
                        </a>
                    @endif
                    @if($player->social_instagram)
                        <a href="{{ $player->social_instagram }}" target="_blank" rel="noopener" class="flex-1 bg-slate-800 hover:bg-pink-600 p-3 rounded-lg transition-colors text-center">
                            <span class="text-2xl">📸</span>
                        </a>
                    @endif
                    @if($player->social_facebook)
                        <a href="{{ $player->social_facebook }}" target="_blank" rel="noopener" class="flex-1 bg-slate-800 hover:bg-blue-800 p-3 rounded-lg transition-colors text-center">
                            <span class="text-2xl">👍</span>
                        </a>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
