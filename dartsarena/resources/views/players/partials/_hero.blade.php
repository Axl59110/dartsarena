{{-- HERO SECTION - Gaming Card Style --}}
<section class="relative bg-gradient-to-b from-slate-900 via-slate-800 to-background overflow-hidden">
    {{-- Animated Background Pattern --}}
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(255,255,255,.03) 35px, rgba(255,255,255,.03) 70px);"></div>
    </div>

    <div class="container relative z-10 py-12 lg:py-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            {{-- LEFT: Player Card --}}
            <div class="lg:col-span-4">
                <div class="holo-card rounded-2xl p-8 text-center">
                    {{-- Photo with Holographic Border --}}
                    <div class="relative inline-block mb-6">
                        @if($player->photo_url)
                            <div class="relative w-48 h-48 mx-auto">
                                <div class="absolute inset-0 bg-gradient-to-br from-primary/30 via-purple-500/30 to-pink-500/30 rounded-full animate-spin-slow"></div>
                                <img
                                    src="{{ $player->photo_url }}"
                                    alt="{{ $player->full_name }}"
                                    loading="lazy"
                                    class="relative w-full h-full rounded-full object-cover border-4 border-background shadow-2xl"
                                />
                            </div>
                        @else
                            <div class="w-48 h-48 mx-auto bg-gradient-to-br from-primary/20 to-primary/10 rounded-full flex items-center justify-center border-4 border-background shadow-2xl">
                                <span class="font-gaming text-6xl text-primary">
                                    {{ strtoupper(substr($player->first_name, 0, 1)) }}{{ strtoupper(substr($player->last_name, 0, 1)) }}
                                </span>
                            </div>
                        @endif

                        {{-- Rank Badge --}}
                        @if($latestRanking)
                            <div class="rank-badge absolute -bottom-3 left-1/2 -translate-x-1/2 px-6 py-3 bg-gradient-to-r from-amber-500 to-orange-500 rounded-full border-4 border-background">
                                <span class="font-gaming text-2xl text-white">#{{ $latestRanking->position }}</span>
                            </div>
                        @endif
                    </div>

                    {{-- Player Name --}}
                    <h1 class="font-gaming text-3xl xl:text-4xl text-white mb-2 tracking-tight leading-tight">
                        {{ $player->full_name }}
                    </h1>

                    @if($player->nickname)
                        <p class="text-primary text-xl font-bold italic mb-4 tracking-wide">
                            "{{ $player->nickname }}"
                        </p>
                    @endif

                    {{-- Country & Age --}}
                    <div class="flex items-center justify-center gap-3 mb-6 text-slate-300">
                        @if($player->country_code)
                            <span class="text-3xl">{{ \Illuminate\Support\Str::upper($player->country_code) === 'GB' ? '🇬🇧' : '🌍' }}</span>
                            <span class="font-medium">{{ $player->nationality }}</span>
                        @endif

                        @if($player->date_of_birth)
                            <span class="text-slate-500">•</span>
                            <span>{{ $player->date_of_birth->age }} {{ __('ans') }}</span>
                        @endif
                    </div>

                    {{-- Quick Stats Row --}}
                    <div class="grid grid-cols-3 gap-4 pt-6 border-t border-white/10">
                        <div class="text-center">
                            <div class="font-gaming text-3xl text-amber-400 mb-1">{{ $player->career_titles }}</div>
                            <div class="text-xs text-slate-400 uppercase tracking-wider">{{ __('Titres') }}</div>
                        </div>
                        <div class="text-center">
                            <div class="font-gaming text-3xl text-purple-400 mb-1">{{ $player->career_9darters }}</div>
                            <div class="text-xs text-slate-400 uppercase tracking-wider">9-Darters</div>
                        </div>
                        <div class="text-center">
                            <div class="font-gaming text-3xl text-blue-400 mb-1">{{ number_format($player->career_highest_average, 2) }}</div>
                            <div class="text-xs text-slate-400 uppercase tracking-wider">{{ __('Best Avg') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT: Stats Dashboard --}}
            <div class="lg:col-span-8 space-y-6">
                {{-- Performance Metrics Grid --}}
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="holo-card rounded-xl p-5">
                        <div class="text-xs text-slate-400 uppercase tracking-widest mb-2 font-mono">{{ __('Win Rate') }}</div>
                        <div class="font-gaming text-4xl text-green-400 mb-2">{{ $careerStats['win_rate'] ?? 0 }}%</div>
                        <div class="xp-bar-container h-2">
                            <div class="xp-bar" style="width: {{ $careerStats['win_rate'] ?? 0 }}%"></div>
                        </div>
                    </div>

                    <div class="holo-card rounded-xl p-5">
                        <div class="text-xs text-slate-400 uppercase tracking-widest mb-2 font-mono">{{ __('Matchs') }}</div>
                        <div class="font-gaming text-4xl text-white mb-2">{{ $careerStats['total_matches'] ?? 0 }}</div>
                        <div class="text-sm text-slate-400 font-mono">
                            <span class="text-green-400">{{ $careerStats['wins'] ?? 0 }}W</span>
                            <span class="text-slate-600 mx-1">-</span>
                            <span class="text-red-400">{{ $careerStats['losses'] ?? 0 }}L</span>
                        </div>
                    </div>

                    <div class="holo-card rounded-xl p-5">
                        <div class="text-xs text-slate-400 uppercase tracking-widest mb-2 font-mono">{{ __('Average') }}</div>
                        <div class="font-gaming text-4xl text-cyan-400 mb-2">{{ $careerStats['avg_average'] ?? '-' }}</div>
                        <div class="comparison-meter">
                            <div class="comparison-indicator" style="left: 70%"></div>
                        </div>
                    </div>

                    <div class="holo-card rounded-xl p-5">
                        <div class="text-xs text-slate-400 uppercase tracking-widest mb-2 font-mono">{{ __('Total 180s') }}</div>
                        <div class="font-gaming text-4xl text-yellow-400 mb-2">{{ $careerStats['total_180s'] ?? 0 }}</div>
                        <div class="text-sm text-slate-400 font-mono">
                            {{ __('Checkout') }} {{ $careerStats['avg_checkout'] ?? 0 }}%
                        </div>
                    </div>
                </div>

                {{-- Advanced Stats Bars --}}
                <div class="holo-card rounded-xl p-6">
                    <h3 class="font-gaming text-lg text-white mb-6 uppercase tracking-wider">{{ __('Attributs du Joueur') }}</h3>

                    <div class="space-y-5">
                        {{-- Precision --}}
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm text-slate-300 font-mono uppercase tracking-wider">{{ __('Précision') }}</span>
                                <span class="font-gaming text-lg text-primary">{{ min(99, ($careerStats['avg_average'] ?? 0)) }}</span>
                            </div>
                            <div class="h-3 bg-slate-900 rounded-full overflow-hidden">
                                <div class="stat-bar" style="width: {{ min(99, ($careerStats['avg_average'] ?? 0)) }}%"></div>
                            </div>
                        </div>

                        {{-- Consistency --}}
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm text-slate-300 font-mono uppercase tracking-wider">{{ __('Régularité') }}</span>
                                <span class="font-gaming text-lg text-blue-400">{{ $careerStats['win_rate'] ?? 0 }}</span>
                            </div>
                            <div class="h-3 bg-slate-900 rounded-full overflow-hidden">
                                <div class="stat-bar" style="width: {{ $careerStats['win_rate'] ?? 0 }}%; background: linear-gradient(90deg, #3b82f6 0%, #60a5fa 100%);"></div>
                            </div>
                        </div>

                        {{-- Finishing --}}
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm text-slate-300 font-mono uppercase tracking-wider">{{ __('Finition') }}</span>
                                <span class="font-gaming text-lg text-green-400">{{ $careerStats['avg_checkout'] ?? 0 }}</span>
                            </div>
                            <div class="h-3 bg-slate-900 rounded-full overflow-hidden">
                                <div class="stat-bar" style="width: {{ $careerStats['avg_checkout'] ?? 0 }}%; background: linear-gradient(90deg, #10b981 0%, #34d399 100%);"></div>
                            </div>
                        </div>

                        {{-- Experience (based on matches played) --}}
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm text-slate-300 font-mono uppercase tracking-wider">{{ __('Expérience') }}</span>
                                <span class="font-gaming text-lg text-purple-400">{{ min(99, floor(($careerStats['total_matches'] ?? 0) / 10)) }}</span>
                            </div>
                            <div class="h-3 bg-slate-900 rounded-full overflow-hidden">
                                <div class="stat-bar" style="width: {{ min(99, floor(($careerStats['total_matches'] ?? 0) / 10)) }}%; background: linear-gradient(90deg, #8b5cf6 0%, #a78bfa 100%);"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
