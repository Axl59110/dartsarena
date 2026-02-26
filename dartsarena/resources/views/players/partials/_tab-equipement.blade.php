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
