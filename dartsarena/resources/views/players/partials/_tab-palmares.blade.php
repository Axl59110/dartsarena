{{-- TAB CONTENT: PALMARES --}}
<div x-show="activeTab === 'palmares'" x-transition role="tabpanel">
    <div class="holo-card rounded-xl p-8">
        <h2 class="font-gaming text-2xl text-white mb-8 uppercase tracking-wider flex items-center gap-3">
            <span class="trophy text-4xl">🏆</span>
            {{ __('Palmarès & Trophées') }}
        </h2>

        @if($player->career_titles > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                {{-- Total Titles Card --}}
                <div class="col-span-full bg-gradient-to-br from-amber-900/30 to-transparent p-8 rounded-xl border-4 border-amber-500/50 text-center">
                    <div class="trophy text-6xl mb-4">🏆</div>
                    <div class="font-gaming text-7xl text-amber-400 mb-3">{{ $player->career_titles }}</div>
                    <div class="text-xl text-slate-300 uppercase tracking-widest font-mono">{{ __('Titres Remportés en Carrière') }}</div>
                </div>
            </div>

            {{-- Placeholder: Trophy Timeline --}}
            <div class="space-y-4">
                <h3 class="font-gaming text-xl text-white mb-6 uppercase tracking-wider">{{ __('Chronologie des Victoires') }}</h3>

                {{-- Sample trophies (to be replaced with real data) --}}
                <div class="flex gap-4 items-center p-4 bg-slate-900/50 rounded-lg border border-white/10 hover:border-primary/50 transition-colors">
                    <div class="text-4xl">🥇</div>
                    <div class="flex-1">
                        <div class="font-bold text-white text-lg">{{ __('World Championship') }}</div>
                        <div class="text-sm text-slate-400">{{ __('Ally Pally, London') }}</div>
                    </div>
                    <div class="text-right">
                        <div class="font-gaming text-primary text-xl">2024</div>
                        <div class="text-xs text-slate-500 font-mono">£500,000</div>
                    </div>
                </div>

                <div class="flex gap-4 items-center p-4 bg-slate-900/50 rounded-lg border border-white/10 hover:border-primary/50 transition-colors">
                    <div class="text-4xl">🥈</div>
                    <div class="flex-1">
                        <div class="font-bold text-white text-lg">{{ __('Premier League') }}</div>
                        <div class="text-sm text-slate-400">{{ __('PDC Circuit') }}</div>
                    </div>
                    <div class="text-right">
                        <div class="font-gaming text-primary text-xl">2024</div>
                        <div class="text-xs text-slate-500 font-mono">£275,000</div>
                    </div>
                </div>

                <div class="text-center py-8">
                    <div class="text-slate-500 italic font-mono text-sm">
                        {{ __('Le détail complet des titres par compétition sera bientôt disponible.') }}
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-6xl mb-4 opacity-20">🏆</div>
                <p class="text-slate-500 italic text-lg">{{ __('Aucun titre remporté pour le moment.') }}</p>
            </div>
        @endif
    </div>
</div>
