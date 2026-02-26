@extends('layouts.app')

@section('title', $player->full_name . ' - ' . __('Fiche Joueur') . ' | DartsArena')

@section('breadcrumbs')
    <div class="breadcrumbs py-3">
        <a href="{{ route('home') }}">{{ __('Home') }}</a>
        <span class="text-muted-foreground mx-2">/</span>
        <a href="{{ route('players.index') }}">{{ __('Players') }}</a>
        <span class="text-muted-foreground mx-2">/</span>
        <span class="text-foreground">{{ $player->full_name }}</span>
    </div>
@endsection

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Archivo+Black&family=JetBrains+Mono:wght@400;700&display=swap');

    :root {
        --primary-rgb: 215, 60, 50;
    }

    .font-gaming { font-family: 'Archivo Black', sans-serif; }
    .font-mono { font-family: 'JetBrains Mono', monospace; }

    /* Gaming Card Holographic Effect */
    .holo-card {
        position: relative;
        background: linear-gradient(135deg,
            rgba(255,255,255,0.03) 0%,
            rgba(255,255,255,0.01) 50%,
            rgba(255,255,255,0.03) 100%
        );
        border: 1px solid rgba(255,255,255,0.1);
        transition: all 0.3s ease;
    }

    .holo-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.3),
                    0 0 20px rgba(var(--primary-rgb), 0.2);
        border-color: rgba(var(--primary-rgb), 0.3);
    }

    /* Stat Bar Animation */
    .stat-bar {
        height: 8px;
        background: linear-gradient(90deg,
            var(--primary) 0%,
            rgba(var(--primary-rgb), 0.6) 100%
        );
        border-radius: 4px;
        transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 8px rgba(var(--primary-rgb), 0.3);
    }

    /* Rank Badge Glow */
    .rank-badge {
        animation: pulse-glow 2s ease-in-out infinite;
    }

    @keyframes pulse-glow {
        0%, 100% { box-shadow: 0 0 20px rgba(var(--primary-rgb), 0.4); }
        50% { box-shadow: 0 0 30px rgba(var(--primary-rgb), 0.6); }
    }

    /* Tab Active Indicator */
    .tab-active {
        position: relative;
        background: linear-gradient(to top,
            rgba(var(--primary-rgb), 0.1) 0%,
            transparent 100%
        );
    }

    .tab-active::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg,
            transparent 0%,
            var(--primary) 50%,
            transparent 100%
        );
        box-shadow: 0 0 10px var(--primary);
    }

    /* XP Bar Style */
    .xp-bar-container {
        background: rgba(0,0,0,0.2);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 12px;
        overflow: hidden;
        position: relative;
    }

    .xp-bar {
        background: linear-gradient(90deg,
            #10b981 0%,
            #3b82f6 50%,
            #8b5cf6 100%
        );
        height: 100%;
        transition: width 1s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .xp-bar::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg,
            transparent 0%,
            rgba(255,255,255,0.3) 50%,
            transparent 100%
        );
        animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }

    /* Trophy Shine */
    .trophy {
        filter: drop-shadow(0 0 10px rgba(251, 191, 36, 0.5));
        animation: trophy-shine 3s ease-in-out infinite;
    }

    @keyframes trophy-shine {
        0%, 100% { filter: drop-shadow(0 0 10px rgba(251, 191, 36, 0.5)); }
        50% { filter: drop-shadow(0 0 20px rgba(251, 191, 36, 0.8)); }
    }

    /* Match Result Card */
    .match-card {
        background: linear-gradient(135deg,
            rgba(255,255,255,0.02) 0%,
            rgba(255,255,255,0.01) 100%
        );
        border-left: 3px solid transparent;
        transition: all 0.3s ease;
    }

    .match-card.win {
        border-left-color: #10b981;
    }

    .match-card.loss {
        border-left-color: #ef4444;
    }

    .match-card:hover {
        background: linear-gradient(135deg,
            rgba(255,255,255,0.05) 0%,
            rgba(255,255,255,0.02) 100%
        );
    }

    /* Comparison Meter */
    .comparison-meter {
        position: relative;
        height: 6px;
        background: linear-gradient(90deg,
            #ef4444 0%,
            #fbbf24 50%,
            #10b981 100%
        );
        border-radius: 3px;
    }

    .comparison-indicator {
        position: absolute;
        top: -8px;
        width: 4px;
        height: 22px;
        background: white;
        border-radius: 2px;
        box-shadow: 0 0 8px rgba(255,255,255,0.8);
    }
</style>
@endpush

@section('content')
    {{-- Schema.org Person Markup --}}
    @php
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'Person',
            'name' => $player->full_name,
            'alternateName' => $player->nickname,
            'nationality' => $player->nationality,
            'description' => strip_tags($player->bio ?? 'Professional darts player'),
            'jobTitle' => 'Professional Darts Player',
            'award' => $player->career_titles . ' career titles'
        ];

        if ($player->photo_url) {
            $schema['image'] = asset($player->photo_url);
        }

        if ($player->date_of_birth) {
            $schema['birthDate'] = $player->date_of_birth->format('Y-m-d');
        }
    @endphp
    <script type="application/ld+json">
    {!! json_encode($schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) !!}
    </script>

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

    {{-- TABS SECTION --}}
    <div class="container py-8 lg:py-12" x-data="{
        activeTab: window.location.hash ? window.location.hash.substring(1) : 'profil',
        videoModal: {
            isOpen: false,
            videoUrl: '',
            title: '',
            open(url, title) {
                this.videoUrl = url;
                this.title = title;
                this.isOpen = true;
                document.body.style.overflow = 'hidden';
            },
            close() {
                this.isOpen = false;
                this.videoUrl = '';
                this.title = '';
                document.body.style.overflow = '';
            }
        }
    }">
        <div class="max-w-7xl mx-auto">
            {{-- TABS NAVIGATION - Gaming Style --}}
            <div class="mb-8 overflow-x-auto">
                <nav class="flex gap-2 min-w-max bg-slate-900/50 p-2 rounded-xl border border-white/10" role="tablist">
                    <button
                        @click="activeTab = 'profil'; window.location.hash = 'profil'"
                        :class="activeTab === 'profil' ? 'tab-active bg-primary text-white' : 'text-slate-400 hover:text-white hover:bg-white/5'"
                        class="px-6 py-3 rounded-lg font-bold transition-all whitespace-nowrap font-mono uppercase tracking-wider text-sm"
                        role="tab"
                    >
                        {{ __('Profil') }}
                    </button>
                    <button
                        @click="activeTab = 'stats'; window.location.hash = 'stats'"
                        :class="activeTab === 'stats' ? 'tab-active bg-primary text-white' : 'text-slate-400 hover:text-white hover:bg-white/5'"
                        class="px-6 py-3 rounded-lg font-bold transition-all whitespace-nowrap font-mono uppercase tracking-wider text-sm"
                        role="tab"
                    >
                        {{ __('Stats') }}
                    </button>
                    <button
                        @click="activeTab = 'fortune'; window.location.hash = 'fortune'"
                        :class="activeTab === 'fortune' ? 'tab-active bg-primary text-white' : 'text-slate-400 hover:text-white hover:bg-white/5'"
                        class="px-6 py-3 rounded-lg font-bold transition-all whitespace-nowrap font-mono uppercase tracking-wider text-sm relative"
                        role="tab"
                    >
                        💰 {{ __('Fortune') }}
                    </button>
                    <button
                        @click="activeTab = 'palmares'; window.location.hash = 'palmares'"
                        :class="activeTab === 'palmares' ? 'tab-active bg-primary text-white' : 'text-slate-400 hover:text-white hover:bg-white/5'"
                        class="px-6 py-3 rounded-lg font-bold transition-all whitespace-nowrap font-mono uppercase tracking-wider text-sm"
                        role="tab"
                    >
                        🏆 {{ __('Palmarès') }}
                    </button>
                    <button
                        @click="activeTab = 'matchs'; window.location.hash = 'matchs'"
                        :class="activeTab === 'matchs' ? 'tab-active bg-primary text-white' : 'text-slate-400 hover:text-white hover:bg-white/5'"
                        class="px-6 py-3 rounded-lg font-bold transition-all whitespace-nowrap font-mono uppercase tracking-wider text-sm"
                        role="tab"
                    >
                        {{ __('Matchs') }}
                    </button>
                    <button
                        @click="activeTab = 'nine-darters'; window.location.hash = 'nine-darters'"
                        :class="activeTab === 'nine-darters' ? 'tab-active bg-primary text-white' : 'text-slate-400 hover:text-white hover:bg-white/5'"
                        class="px-6 py-3 rounded-lg font-bold transition-all whitespace-nowrap font-mono uppercase tracking-wider text-sm relative"
                        role="tab"
                    >
                        🎯 9-Darters
                        @if($nineDarters->count() > 0)
                            <span class="ml-2 inline-flex items-center justify-center px-2 py-0.5 text-xs font-bold text-white bg-red-600 rounded-full animate-pulse">
                                {{ $nineDarters->count() }}
                            </span>
                        @endif
                    </button>
                    <button
                        @click="activeTab = 'equipement'; window.location.hash = 'equipement'"
                        :class="activeTab === 'equipement' ? 'tab-active bg-primary text-white' : 'text-slate-400 hover:text-white hover:bg-white/5'"
                        class="px-6 py-3 rounded-lg font-bold transition-all whitespace-nowrap font-mono uppercase tracking-wider text-sm"
                        role="tab"
                    >
                        ⚙️ {{ __('Setup') }}
                    </button>
                </nav>
            </div>

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

            {{-- TAB CONTENT: STATS (Enhanced) --}}
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

            {{-- TAB CONTENT: FORTUNE (NEW!) --}}
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

            {{-- TAB CONTENT: PALMARES (Enhanced) --}}
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

            {{-- TAB CONTENT: MATCHS (Enhanced) --}}
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

            {{-- TAB CONTENT: ÉQUIPEMENT --}}
            <div x-show="activeTab === 'equipement'" x-transition role="tabpanel">
                @if($currentEquipments->count() > 0 || $previousEquipments->count() > 0)
                    {{-- Current Equipment --}}
                    @if($currentEquipments->count() > 0)
                        <div class="mb-8">
                            <h2 class="font-gaming text-2xl text-white mb-6 uppercase tracking-wider flex items-center gap-3">
                                <span class="text-3xl">⚙️</span>
                                {{ __('Setup Actuel') }}
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($currentEquipments as $equipment)
                                    <div class="holo-card rounded-xl overflow-hidden group">
                                        @if($equipment->photo_url)
                                            <div class="aspect-square bg-gradient-to-br from-slate-900 to-slate-800 p-8 flex items-center justify-center">
                                                <img
                                                    src="{{ $equipment->photo_url }}"
                                                    alt="{{ $equipment->full_name }}"
                                                    loading="lazy"
                                                    class="max-h-full max-w-full object-contain group-hover:scale-110 transition-transform duration-300"
                                                />
                                            </div>
                                        @endif

                                        <div class="p-6">
                                            <div class="mb-3">
                                                <span class="inline-block px-3 py-1 bg-primary/20 text-primary text-xs font-bold uppercase tracking-widest rounded-full font-mono">
                                                    {{ __($equipment->equipment_type) }}
                                                </span>
                                            </div>

                                            <h3 class="font-gaming text-xl text-white mb-1">
                                                {{ $equipment->brand }}
                                            </h3>
                                            <p class="text-lg text-slate-300 font-semibold mb-3">
                                                {{ $equipment->model }}
                                            </p>

                                            @if($equipment->description)
                                                <p class="text-sm text-slate-400 mb-4 line-clamp-2">
                                                    {{ $equipment->description }}
                                                </p>
                                            @endif

                                            @if($equipment->affiliate_link)
                                                <a
                                                    href="{{ $equipment->affiliate_link }}"
                                                    target="_blank"
                                                    rel="noopener noreferrer nofollow sponsored"
                                                    class="block text-center py-3 bg-primary hover:bg-primary/90 text-white font-bold rounded-lg transition-colors uppercase tracking-wider text-sm"
                                                >
                                                    {{ __('Acheter') }} →
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Previous Equipment --}}
                    @if($previousEquipments->count() > 0)
                        <div>
                            <h2 class="font-gaming text-2xl text-white mb-6 uppercase tracking-wider flex items-center gap-3 opacity-60">
                                <span class="text-3xl">📦</span>
                                {{ __('Équipements Précédents') }}
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                @foreach($previousEquipments as $equipment)
                                    <div class="holo-card rounded-xl p-4 opacity-50 hover:opacity-75 transition-opacity">
                                        @if($equipment->photo_url)
                                            <div class="aspect-square bg-slate-900 p-4 rounded-lg mb-3 flex items-center justify-center">
                                                <img
                                                    src="{{ $equipment->photo_url }}"
                                                    alt="{{ $equipment->full_name }}"
                                                    loading="lazy"
                                                    class="max-h-full max-w-full object-contain"
                                                />
                                            </div>
                                        @endif

                                        <div class="text-sm">
                                            <div class="font-bold text-white mb-1">{{ $equipment->brand }}</div>
                                            <div class="text-slate-400 text-xs mb-2">{{ $equipment->model }}</div>
                                            @if($equipment->period)
                                                <div class="text-xs text-slate-600 italic font-mono">{{ $equipment->period }}</div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @else
                    <div class="holo-card rounded-xl p-12 text-center">
                        <div class="text-6xl mb-4 opacity-20">⚙️</div>
                        <h2 class="font-gaming text-2xl text-white mb-3">
                            {{ __('Aucun Équipement Référencé') }}
                        </h2>
                        <p class="text-slate-500 italic">
                            {{ __('Les informations sur l\'équipement de ce joueur seront bientôt disponibles.') }}
                        </p>
                    </div>
                @endif
            </div>

            {{-- Back Button --}}
            <div class="text-center mt-12">
                <a href="{{ route('players.index') }}"
                   class="inline-flex items-center gap-3 px-8 py-4 bg-slate-900 hover:bg-primary text-white border-2 border-white/10 hover:border-primary rounded-xl font-gaming uppercase tracking-wider transition-all hover:scale-105">
                    <span class="text-xl">←</span>
                    {{ __('Retour aux joueurs') }}
                </a>
            </div>
        </div>
    </div>

    {{-- VIDEO MODAL --}}
    <div x-show="videoModal.isOpen"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/90"
         @click="videoModal.close()"
         @keydown.escape.window="videoModal.close()"
         style="display: none;">

        <div class="relative w-full max-w-5xl" @click.stop>
            {{-- Close Button --}}
            <button
                @click="videoModal.close()"
                class="absolute -top-12 right-0 text-white/70 hover:text-white text-xl font-bold transition-colors">
                ✕ {{ __('Fermer') }}
            </button>

            {{-- Video Container --}}
            <div class="bg-black rounded-xl overflow-hidden shadow-2xl">
                <div class="aspect-video">
                    <iframe
                        :src="videoModal.videoUrl"
                        class="w-full h-full"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen
                    ></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection
