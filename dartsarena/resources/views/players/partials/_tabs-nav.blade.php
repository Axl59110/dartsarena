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
