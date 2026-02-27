{{-- TAB CONTENT: FORTUNE --}}
<div x-show="activeTab === 'fortune'" x-transition role="tabpanel">
    <div class="holo-card rounded-xl p-8">
        <h2 class="font-gaming text-2xl text-white mb-8 uppercase tracking-wider flex items-center gap-3">
            <span class="text-3xl">💰</span>
            {{ __('Prize Money & Gains') }}
        </h2>

        {{-- Total Career Titles as proxy --}}
        @if($player->career_titles > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-gradient-to-br from-amber-900/30 to-transparent p-6 rounded-xl border-2 border-amber-500/30 text-center">
                    <div class="text-xs text-amber-300 uppercase tracking-widest font-mono mb-3">{{ __('Titres de Carrière') }}</div>
                    <div class="font-gaming text-6xl text-amber-400 mb-2">{{ $player->career_titles }}</div>
                    <div class="text-sm text-slate-400">{{ __('Tournois remportés') }}</div>
                </div>

                @if($player->career_9darters > 0)
                <div class="bg-gradient-to-br from-purple-900/30 to-transparent p-6 rounded-xl border-2 border-purple-500/30 text-center">
                    <div class="text-xs text-purple-300 uppercase tracking-widest font-mono mb-3">{{ __('Perfections') }}</div>
                    <div class="font-gaming text-6xl text-purple-400 mb-2">{{ $player->career_9darters }}</div>
                    <div class="text-sm text-slate-400">9-Darters</div>
                </div>
                @endif
            </div>
        @endif

        {{-- Honest message about financial data --}}
        <div class="p-6 bg-slate-900/50 rounded-xl border border-white/10 text-center">
            <div class="text-4xl mb-4 opacity-60">📊</div>
            <p class="text-slate-400 font-mono text-sm leading-relaxed max-w-lg mx-auto">
                {{ __('Les données financières détaillées (prize money par tournoi, sponsors, fortune nette) nécessitent un accès aux APIs officielles PDC et seront disponibles prochainement.') }}
            </p>
            <div class="mt-6">
                <a href="https://www.pdc.tv/player-rankings" target="_blank" rel="noopener"
                   class="inline-flex items-center gap-2 text-sm text-primary hover:text-primary/80 font-mono underline underline-offset-4 transition-colors">
                    {{ __('Classements officiels PDC') }}
                    <span>↗</span>
                </a>
            </div>
        </div>
    </div>
</div>
