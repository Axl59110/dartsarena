{{-- TABS NAVIGATION --}}
<div class="pg-tabs-wrapper" role="tablist">
    <button @click="activeTab = 'profil'" :class="activeTab === 'profil' ? 'pg-tab active' : 'pg-tab'" role="tab">
        {{ __('Profil') }}
    </button>
    <button @click="activeTab = 'stats'" :class="activeTab === 'stats' ? 'pg-tab active' : 'pg-tab'" role="tab">
        Stats
    </button>
    <button @click="activeTab = 'fortune'" :class="activeTab === 'fortune' ? 'pg-tab active' : 'pg-tab'" role="tab">
        💰 {{ __('Fortune') }}
    </button>
    <button @click="activeTab = 'palmares'" :class="activeTab === 'palmares' ? 'pg-tab active' : 'pg-tab'" role="tab">
        🏆 {{ __('Palmarès') }}
    </button>
    <button @click="activeTab = 'matchs'" :class="activeTab === 'matchs' ? 'pg-tab active' : 'pg-tab'" role="tab">
        {{ __('Matchs') }}
    </button>
    <button @click="activeTab = 'nine-darters'" :class="activeTab === 'nine-darters' ? 'pg-tab active' : 'pg-tab'"
            role="tab" style="position:relative;">
        🎯 9-Darters
        @if($nineDarters->count() > 0)
            <span style="margin-left:6px; display:inline-flex; align-items:center; justify-content:center;
                         width:18px; height:18px; background:#ef4444; color:white; border-radius:50%;
                         font-size:10px; font-weight:700;">
                {{ $nineDarters->count() }}
            </span>
        @endif
    </button>
    <button @click="activeTab = 'equipement'" :class="activeTab === 'equipement' ? 'pg-tab active' : 'pg-tab'" role="tab">
        ⚙️ Setup
    </button>
</div>
