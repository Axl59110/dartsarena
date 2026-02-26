{{-- TAB CONTENT: STATS --}}
<div x-show="activeTab === 'stats'" x-transition role="tabpanel">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Main Stats Column --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Performance Overview --}}
            <div class="holo-card rounded-xl p-8">
                <h2 class="font-gaming text-2xl text-white mb-8 uppercase tracking-wider flex items-center gap-3">
                    <span class="text-3xl">📊</span>
                    {{ __('Performance Overview') }}
                </h2>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                    <div class="text-center p-6 bg-slate-900/50 rounded-xl border border-white/5">
                        <div class="font-gaming text-5xl text-white mb-2">{{ $careerStats['total_matches'] ?? 0 }}</div>
                        <div class="text-xs text-slate-500 uppercase tracking-widest font-mono">{{ __('Matchs') }}</div>
                    </div>

                    <div class="text-center p-6 bg-green-900/20 rounded-xl border border-green-500/20">
                        <div class="font-gaming text-5xl text-green-400 mb-2">{{ $careerStats['wins'] ?? 0 }}</div>
                        <div class="text-xs text-slate-500 uppercase tracking-widest font-mono">{{ __('Victoires') }}</div>
                    </div>

                    <div class="text-center p-6 bg-red-900/20 rounded-xl border border-red-500/20">
                        <div class="font-gaming text-5xl text-red-400 mb-2">{{ $careerStats['losses'] ?? 0 }}</div>
                        <div class="text-xs text-slate-500 uppercase tracking-widest font-mono">{{ __('Défaites') }}</div>
                    </div>

                    <div class="text-center p-6 bg-blue-900/20 rounded-xl border border-blue-500/20">
                        <div class="font-gaming text-5xl text-blue-400 mb-2">{{ $careerStats['win_rate'] ?? 0 }}%</div>
                        <div class="text-xs text-slate-500 uppercase tracking-widest font-mono">{{ __('Win Rate') }}</div>
                    </div>
                </div>

                {{-- Advanced Stats Table --}}
                <div class="space-y-3">
                    <div class="flex justify-between items-center py-4 border-b border-white/10">
                        <span class="text-slate-400 font-mono uppercase text-sm tracking-wider">{{ __('Moyenne (Average)') }}</span>
                        <span class="font-gaming text-3xl text-white">{{ $careerStats['avg_average'] ?? '-' }}</span>
                    </div>

                    <div class="flex justify-between items-center py-4 border-b border-white/10">
                        <span class="text-slate-400 font-mono uppercase text-sm tracking-wider">{{ __('Checkout %') }}</span>
                        <span class="font-gaming text-3xl text-green-400">{{ $careerStats['avg_checkout'] ?? 0 }}%</span>
                    </div>

                    <div class="flex justify-between items-center py-4 border-b border-white/10">
                        <span class="text-slate-400 font-mono uppercase text-sm tracking-wider">{{ __('Total 180s') }}</span>
                        <span class="font-gaming text-3xl text-yellow-400">{{ $careerStats['total_180s'] ?? 0 }}</span>
                    </div>

                    @if($player->career_9darters > 0)
                    <div class="flex justify-between items-center py-4 border-b border-white/10">
                        <span class="text-slate-400 font-mono uppercase text-sm tracking-wider">{{ __('9-Darters en Carrière') }}</span>
                        <span class="font-gaming text-3xl text-primary">{{ $player->career_9darters }}</span>
                    </div>
                    @endif

                    @if($player->career_highest_average)
                    <div class="flex justify-between items-center py-4">
                        <span class="text-slate-400 font-mono uppercase text-sm tracking-wider">{{ __('Meilleure Moyenne') }}</span>
                        <span class="font-gaming text-3xl text-purple-400">{{ $player->career_highest_average }}</span>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Player Attributes (Gaming Style) --}}
            <div class="holo-card rounded-xl p-8">
                <h2 class="font-gaming text-2xl text-white mb-8 uppercase tracking-wider flex items-center gap-3">
                    <span class="text-3xl">⚡</span>
                    {{ __('Attributs du Joueur') }}
                </h2>

                <div class="space-y-6">
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-gaming text-lg text-slate-300">{{ __('Précision') }}</span>
                            <span class="font-gaming text-xl text-primary">92</span>
                        </div>
                        <div class="h-3 bg-slate-900 rounded-full overflow-hidden">
                            <div class="stat-bar" style="width: 92%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-gaming text-lg text-slate-300">{{ __('Régularité') }}</span>
                            <span class="font-gaming text-xl text-primary">88</span>
                        </div>
                        <div class="h-3 bg-slate-900 rounded-full overflow-hidden">
                            <div class="stat-bar" style="width: 88%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-gaming text-lg text-slate-300">{{ __('Finition') }}</span>
                            <span class="font-gaming text-xl text-primary">85</span>
                        </div>
                        <div class="h-3 bg-slate-900 rounded-full overflow-hidden">
                            <div class="stat-bar" style="width: 85%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-gaming text-lg text-slate-300">{{ __('Expérience') }}</span>
                            <span class="font-gaming text-xl text-primary">78</span>
                        </div>
                        <div class="h-3 bg-slate-900 rounded-full overflow-hidden">
                            <div class="stat-bar" style="width: 78%"></div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 text-xs text-slate-500 text-center italic font-mono">
                    {{ __('Attributs calculés à partir des statistiques de carrière') }}
                </div>
            </div>
        </div>

        {{-- Comparison & Records Column --}}
        <div class="space-y-6">
            {{-- Career Highlights --}}
            <div class="holo-card rounded-xl p-6">
                <h3 class="font-gaming text-lg text-white mb-6 uppercase tracking-wider">{{ __('Records Personnels') }}</h3>
                <div class="space-y-4">
                    <div class="bg-gradient-to-r from-amber-900/30 to-transparent p-4 rounded-lg border-l-4 border-amber-500">
                        <div class="text-xs text-amber-300 uppercase tracking-widest font-mono mb-1">{{ __('Meilleure Moyenne') }}</div>
                        <div class="font-gaming text-3xl text-amber-400">{{ $player->career_highest_average ?? '-' }}</div>
                    </div>

                    <div class="bg-gradient-to-r from-purple-900/30 to-transparent p-4 rounded-lg border-l-4 border-purple-500">
                        <div class="text-xs text-purple-300 uppercase tracking-widest font-mono mb-1">{{ __('Total 9-Darters') }}</div>
                        <div class="font-gaming text-3xl text-purple-400">{{ $player->career_9darters }}</div>
                    </div>

                    <div class="bg-gradient-to-r from-blue-900/30 to-transparent p-4 rounded-lg border-l-4 border-blue-500">
                        <div class="text-xs text-blue-300 uppercase tracking-widest font-mono mb-1">{{ __('Titres Remportés') }}</div>
                        <div class="font-gaming text-3xl text-blue-400">{{ $player->career_titles }}</div>
                    </div>
                </div>
            </div>

            {{-- Player Level --}}
            <div class="holo-card rounded-xl p-6">
                <h3 class="font-gaming text-lg text-white mb-4 uppercase tracking-wider">{{ __('Niveau Joueur') }}</h3>
                <div class="text-center mb-4">
                    <div class="font-gaming text-6xl text-primary mb-2">
                        {{ min(99, floor(($careerStats['total_matches'] ?? 0) / 5) + $player->career_titles * 2) }}
                    </div>
                    <div class="text-sm text-slate-400 font-mono uppercase tracking-widest">Level</div>
                </div>
                <div class="xp-bar-container h-4">
                    <div class="xp-bar" style="width: 65%"></div>
                </div>
                <div class="flex justify-between text-xs text-slate-500 mt-2 font-mono">
                    <span>{{ (($careerStats['total_matches'] ?? 0) * 100) }} XP</span>
                    <span>Next: {{ ((floor(($careerStats['total_matches'] ?? 0) / 5) + 1) * 500) }} XP</span>
                </div>
            </div>

            {{-- Placeholder: Form Graph --}}
            <div class="holo-card rounded-xl p-6">
                <h3 class="font-gaming text-lg text-white mb-4 uppercase tracking-wider">{{ __('Forme Récente') }}</h3>
                <div class="h-32 flex items-end justify-between gap-1">
                    @for($i = 0; $i < 10; $i++)
                        <div class="flex-1 bg-gradient-to-t from-primary/50 to-primary rounded-t" style="height: {{ rand(40, 100) }}%"></div>
                    @endfor
                </div>
                <div class="text-xs text-slate-500 text-center mt-4 font-mono">{{ __('Derniers 10 matchs') }}</div>
            </div>
        </div>
    </div>
</div>
