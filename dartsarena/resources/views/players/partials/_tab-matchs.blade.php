{{-- TAB CONTENT: MATCHS --}}
<div x-show="activeTab === 'matchs'" x-transition role="tabpanel">
    <div class="holo-card rounded-xl p-8">
        <h2 class="font-gaming text-2xl text-white mb-8 uppercase tracking-wider flex items-center gap-3">
            <span class="text-3xl">⚔️</span>
            {{ __('Matchs Récents') }}
        </h2>

        @if($recentMatches && $recentMatches->count() > 0)
            <div class="space-y-3">
                @foreach($recentMatches as $match)
                    @php
                        $isPlayer1 = $match->player1_id === $player->id;
                        $opponent = $isPlayer1 ? $match->player2 : $match->player1;

                        if ($isPlayer1) {
                            $playerScore = $match->best_of_sets ? $match->player1_score_sets : $match->player1_score_legs;
                            $opponentScore = $match->best_of_sets ? $match->player2_score_sets : $match->player2_score_legs;
                            $playerAvg = $match->player1_average;
                            $opponent180s = $match->player2_180s;
                        } else {
                            $playerScore = $match->best_of_sets ? $match->player2_score_sets : $match->player2_score_legs;
                            $opponentScore = $match->best_of_sets ? $match->player1_score_sets : $match->player1_score_legs;
                            $playerAvg = $match->player2_average;
                            $opponent180s = $match->player1_180s;
                        }

                        $won = $match->winner_id === $player->id;
                    @endphp

                    <div class="match-card {{ $won ? 'win' : 'loss' }} p-5 rounded-xl hover:scale-[1.02] transition-all">
                        <div class="flex flex-col md:flex-row md:items-center gap-4">
                            <div class="flex items-center gap-4 flex-1">
                                {{-- Result Badge --}}
                                <div class="w-16 h-16 rounded-xl {{ $won ? 'bg-green-600' : 'bg-red-600' }} flex items-center justify-center flex-shrink-0">
                                    <span class="font-gaming text-2xl text-white">{{ $won ? 'W' : 'L' }}</span>
                                </div>

                                {{-- Match Info --}}
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="text-xs text-slate-500 font-mono">
                                            {{ $match->scheduled_at ? $match->scheduled_at->format('d/m/Y') : '-' }}
                                        </span>
                                        @if($match->season && $match->season->competition)
                                            <span class="text-slate-600">•</span>
                                            <span class="text-xs text-slate-400 font-mono">
                                                {{ $match->season->competition->name }}
                                            </span>
                                        @endif
                                    </div>

                                    <div class="font-bold text-lg text-white mb-1">
                                        {{ __('vs') }} {{ $opponent->full_name }}
                                    </div>

                                    {{-- Match Stats --}}
                                    <div class="flex gap-4 text-xs text-slate-400 font-mono">
                                        @if($playerAvg)
                                            <span>{{ __('AVG') }}: <span class="text-cyan-400 font-bold">{{ number_format($playerAvg, 2) }}</span></span>
                                        @endif
                                        @if($opponent180s)
                                            <span>180s: <span class="text-yellow-400 font-bold">{{ $opponent180s }}</span></span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Score --}}
                            <div class="text-center md:text-right md:w-32">
                                <div class="font-gaming text-4xl {{ $won ? 'text-green-400' : 'text-white' }} mb-1">
                                    {{ $playerScore }}<span class="text-slate-600 mx-1">-</span>{{ $opponentScore }}
                                </div>
                                <div class="text-xs text-slate-500 uppercase tracking-wider font-mono">
                                    {{ $match->best_of_sets ? __('Sets') : __('Legs') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-6xl mb-4 opacity-20">⚔️</div>
                <p class="text-slate-500 italic text-lg">{{ __('Aucun match récent disponible.') }}</p>
            </div>
        @endif
    </div>
</div>
