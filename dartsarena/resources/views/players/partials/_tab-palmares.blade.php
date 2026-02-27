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

            {{-- Placeholder: réel palmarès à venir --}}
            <div class="mt-8 p-6 bg-slate-900/50 rounded-xl border border-white/10 text-center">
                <div class="text-4xl mb-4 opacity-60">📅</div>
                <p class="text-slate-400 font-mono text-sm leading-relaxed max-w-lg mx-auto">
                    {{ __('La chronologie détaillée des victoires par compétition sera disponible prochainement via les APIs officielles.') }}
                </p>
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-6xl mb-4 opacity-20">🏆</div>
                <p class="text-slate-500 italic text-lg">{{ __('Aucun titre remporté pour le moment.') }}</p>
            </div>
        @endif
    </div>
</div>
