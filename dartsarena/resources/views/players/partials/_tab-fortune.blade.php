{{-- TAB CONTENT: FORTUNE --}}
<div x-show="activeTab === 'fortune'" x-transition role="tabpanel">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Main Earnings Column --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Career Earnings Overview --}}
            <div class="holo-card rounded-xl p-8">
                <h2 class="font-gaming text-2xl text-white mb-8 uppercase tracking-wider flex items-center gap-3">
                    <span class="text-3xl">💰</span>
                    {{ __('Gains de Carrière') }}
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-gradient-to-br from-amber-900/30 to-transparent p-6 rounded-xl border-2 border-amber-500/30">
                        <div class="text-xs text-amber-300 uppercase tracking-widest font-mono mb-3">{{ __('Carrière Totale') }}</div>
                        <div class="font-gaming text-4xl text-amber-400 mb-1">£2.1M</div>
                        <div class="text-sm text-slate-400">{{ __('Prize Money PDC') }}</div>
                    </div>

                    <div class="bg-gradient-to-br from-green-900/30 to-transparent p-6 rounded-xl border-2 border-green-500/30">
                        <div class="text-xs text-green-300 uppercase tracking-widest font-mono mb-3">{{ __('12 Derniers Mois') }}</div>
                        <div class="font-gaming text-4xl text-green-400 mb-1">£1.0M</div>
                        <div class="text-sm text-slate-400">{{ __('Gains 2024-2025') }}</div>
                    </div>

                    <div class="bg-gradient-to-br from-blue-900/30 to-transparent p-6 rounded-xl border-2 border-blue-500/30">
                        <div class="text-xs text-blue-300 uppercase tracking-widest font-mono mb-3">{{ __('Par Match (Moy.)') }}</div>
                        <div class="font-gaming text-4xl text-blue-400 mb-1">£15K</div>
                        <div class="text-sm text-slate-400">{{ __('Estimation') }}</div>
                    </div>
                </div>

                {{-- Earnings Breakdown --}}
                <div class="bg-slate-900/50 rounded-xl p-6 border border-white/5">
                    <h3 class="font-gaming text-lg text-white mb-6 uppercase tracking-wider">{{ __('Répartition Mensuelle') }}</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                        <div>
                            <div class="text-xs text-slate-500 uppercase tracking-widest font-mono mb-2">{{ __('Mensuel') }}</div>
                            <div class="font-gaming text-2xl text-white">£85K</div>
                        </div>
                        <div>
                            <div class="text-xs text-slate-500 uppercase tracking-widest font-mono mb-2">{{ __('Hebdo') }}</div>
                            <div class="font-gaming text-2xl text-white">£19K</div>
                        </div>
                        <div>
                            <div class="text-xs text-slate-500 uppercase tracking-widest font-mono mb-2">{{ __('Quotidien') }}</div>
                            <div class="font-gaming text-2xl text-white">£2.8K</div>
                        </div>
                        <div>
                            <div class="text-xs text-slate-500 uppercase tracking-widest font-mono mb-2">{{ __('Hourly') }}</div>
                            <div class="font-gaming text-2xl text-white">£117</div>
                        </div>
                    </div>
                    <div class="mt-4 text-xs text-slate-500 text-center italic">
                        {{ __('Basé sur les gains PDC des 24 derniers mois') }}
                    </div>
                </div>
            </div>

            {{-- Year-by-Year Earnings --}}
            <div class="holo-card rounded-xl p-8">
                <h3 class="font-gaming text-xl text-white mb-6 uppercase tracking-wider">{{ __('Évolution Annuelle') }}</h3>
                <div class="space-y-4">
                    {{-- 2025 --}}
                    <div class="flex items-center gap-4">
                        <div class="w-20 font-gaming text-lg text-slate-400">2025</div>
                        <div class="flex-1 bg-slate-900 rounded-full h-8 overflow-hidden relative">
                            <div class="absolute inset-0 bg-gradient-to-r from-amber-500 to-orange-500" style="width: 90%"></div>
                            <div class="absolute inset-0 flex items-center px-4">
                                <span class="font-gaming text-white text-sm">£850,000</span>
                            </div>
                        </div>
                        <div class="w-24 text-right text-green-400 font-bold text-sm">+125%</div>
                    </div>

                    {{-- 2024 --}}
                    <div class="flex items-center gap-4">
                        <div class="w-20 font-gaming text-lg text-slate-400">2024</div>
                        <div class="flex-1 bg-slate-900 rounded-full h-8 overflow-hidden relative">
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-cyan-500" style="width: 70%"></div>
                            <div class="absolute inset-0 flex items-center px-4">
                                <span class="font-gaming text-white text-sm">£720,000</span>
                            </div>
                        </div>
                        <div class="w-24 text-right text-green-400 font-bold text-sm">+4165%</div>
                    </div>

                    {{-- 2023 --}}
                    <div class="flex items-center gap-4 opacity-60">
                        <div class="w-20 font-gaming text-lg text-slate-500">2023</div>
                        <div class="flex-1 bg-slate-900 rounded-full h-8 overflow-hidden relative">
                            <div class="absolute inset-0 bg-gradient-to-r from-slate-600 to-slate-500" style="width: 5%"></div>
                            <div class="absolute inset-0 flex items-center px-4">
                                <span class="font-gaming text-slate-400 text-sm">£17,000</span>
                            </div>
                        </div>
                        <div class="w-24 text-right text-slate-500 font-bold text-sm">-</div>
                    </div>
                </div>

                <div class="mt-6 p-4 bg-amber-900/20 rounded-lg border-l-4 border-amber-500">
                    <div class="text-sm text-amber-300 font-mono">
                        💡 {{ __('Croissance explosive depuis 2024 avec la montée en puissance sur le circuit PDC') }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Sponsors & Revenue Streams --}}
        <div class="space-y-6">
            {{-- Top Sponsors --}}
            <div class="holo-card rounded-xl p-6">
                <h3 class="font-gaming text-lg text-white mb-6 uppercase tracking-wider">{{ __('Sponsors Principaux') }}</h3>
                <div class="space-y-3">
                    <div class="flex items-center gap-3 p-3 bg-slate-900/50 rounded-lg border border-white/5">
                        <div class="w-12 h-12 bg-red-600 rounded-lg flex items-center justify-center font-bold text-white">T</div>
                        <div class="flex-1">
                            <div class="font-bold text-white">Target Darts</div>
                            <div class="text-xs text-slate-400">{{ __('Équipementier') }}</div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 p-3 bg-slate-900/50 rounded-lg border border-white/5">
                        <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center font-bold text-white">X</div>
                        <div class="flex-1">
                            <div class="font-bold text-white">Xbox</div>
                            <div class="text-xs text-slate-400">{{ __('Gaming') }}</div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 p-3 bg-slate-900/50 rounded-lg border border-white/5">
                        <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center font-bold text-white">B</div>
                        <div class="flex-1">
                            <div class="font-bold text-white">BetMGM</div>
                            <div class="text-xs text-slate-400">{{ __('Paris sportifs') }}</div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 p-3 bg-slate-900/50 rounded-lg border border-white/5">
                        <div class="w-12 h-12 bg-purple-600 rounded-lg flex items-center justify-center font-bold text-white">S</div>
                        <div class="flex-1">
                            <div class="font-bold text-white">Sky Sports</div>
                            <div class="text-xs text-slate-400">{{ __('Média') }}</div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 p-3 bg-slate-800/50 rounded-lg text-xs text-slate-400 italic border border-white/5">
                    {{ __('Les revenus des sponsorings ne sont pas inclus dans les prize money PDC') }}
                </div>
            </div>

            {{-- Revenue Streams Placeholder --}}
            <div class="holo-card rounded-xl p-6">
                <h3 class="font-gaming text-lg text-white mb-4 uppercase tracking-wider">{{ __('Sources de Revenus') }}</h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-slate-400 text-sm">{{ __('Prize Money') }}</span>
                        <span class="font-bold text-green-400">65%</span>
                    </div>
                    <div class="h-2 bg-slate-900 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-green-500 to-green-400" style="width: 65%"></div>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-slate-400 text-sm">{{ __('Sponsorings') }}</span>
                        <span class="font-bold text-blue-400">25%</span>
                    </div>
                    <div class="h-2 bg-slate-900 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-blue-500 to-blue-400" style="width: 25%"></div>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-slate-400 text-sm">{{ __('Médias & Apparitions') }}</span>
                        <span class="font-bold text-purple-400">10%</span>
                    </div>
                    <div class="h-2 bg-slate-900 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-purple-500 to-purple-400" style="width: 10%"></div>
                    </div>
                </div>

                <div class="mt-4 text-xs text-slate-500 text-center italic">
                    {{ __('Estimation basée sur les données publiques') }}
                </div>
            </div>

            {{-- Net Worth Estimation --}}
            <div class="holo-card rounded-xl p-6 bg-gradient-to-br from-amber-900/20 to-transparent border-2 border-amber-500/30">
                <h3 class="font-gaming text-lg text-amber-400 mb-4 uppercase tracking-wider">{{ __('Valeur Estimée') }}</h3>
                <div class="text-center">
                    <div class="font-gaming text-5xl text-amber-300 mb-2">£3-5M</div>
                    <div class="text-sm text-slate-400">{{ __('Fortune nette estimée (2025)') }}</div>
                </div>
                <div class="mt-4 text-xs text-amber-300/60 text-center italic">
                    {{ __('Inclut les actifs, investissements et revenus futurs') }}
                </div>
            </div>
        </div>
    </div>
</div>
