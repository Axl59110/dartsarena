@props([
    'player',
    'ranking' => null,
    'showStats' => true,
])

@php
    $firstName = $player->first_name ?? '';
    $lastName = $player->last_name ?? '';
    $fullName = $player->full_name ?? "$firstName $lastName";
    $initials = strtoupper(substr($firstName, 0, 1) . substr($lastName, 0, 1));
@endphp

<a href="{{ route('players.show', $player->slug) }}"
   {{ $attributes->merge(['class' => 'group bg-card border border-card-border rounded-[var(--radius-base)] shadow-sm hover:shadow-lg hover:border-primary hover:-translate-y-1 transition-all duration-200 overflow-hidden']) }}>

    {{-- Player Card Content --}}
    <div class="relative">
        {{-- Ranking Badge --}}
        @if($ranking)
            <div class="absolute top-4 right-4 z-10 bg-primary text-primary-foreground px-3 py-1.5 rounded-full font-bold text-sm shadow-lg">
                #{{ $ranking }}
            </div>
        @endif

        {{-- Player Photo/Avatar --}}
        <div class="p-8 text-center bg-gradient-to-b from-muted/30 to-card">
            @if(isset($player->photo_url) && $player->photo_url)
                <img src="{{ $player->photo_url }}"
                     alt="{{ $fullName }}"
                     class="w-32 h-32 rounded-full mx-auto object-cover border-4 border-primary shadow-xl group-hover:scale-110 transition-transform">
            @else
                {{-- Fallback: Initiales --}}
                <div class="w-32 h-32 rounded-full mx-auto bg-gradient-to-br from-primary to-accent flex items-center justify-center border-4 border-primary shadow-xl group-hover:scale-110 transition-transform">
                    <span class="text-4xl font-bold text-primary-foreground">
                        {{ $initials }}
                    </span>
                </div>
            @endif
        </div>

        {{-- Player Info --}}
        <div class="p-6 border-t border-card-border space-y-3">
            {{-- Name --}}
            <h3 class="font-display text-2xl font-bold text-foreground group-hover:text-primary transition-colors leading-[1.2] text-center">
                {{ $fullName }}
            </h3>

            {{-- Nickname --}}
            @if(isset($player->nickname) && $player->nickname)
                <p class="text-primary text-sm font-semibold italic text-center">
                    "{{ $player->nickname }}"
                </p>
            @endif

            {{-- Nationality --}}
            @if(isset($player->nationality) && $player->nationality)
                <p class="text-sm text-muted-foreground text-center">
                    {{ $player->nationality }}
                </p>
            @endif

            {{-- Stats Grid --}}
            @if($showStats)
                <div class="grid grid-cols-3 gap-3 pt-4 border-t border-card-border">
                    <div class="text-center">
                        <p class="text-xs text-muted-foreground mb-1">{{ __('Avg') }}</p>
                        <p class="font-bold text-lg text-foreground">
                            {{ isset($player->average) ? number_format($player->average, 2) : '95.50' }}
                        </p>
                    </div>
                    <div class="text-center">
                        <p class="text-xs text-muted-foreground mb-1">{{ __('Win%') }}</p>
                        <p class="font-bold text-lg text-primary">
                            {{ isset($player->win_rate) ? $player->win_rate : '68' }}%
                        </p>
                    </div>
                    <div class="text-center">
                        <p class="text-xs text-muted-foreground mb-1">{{ __('Matchs') }}</p>
                        <p class="font-bold text-lg text-foreground">
                            {{ isset($player->matches_played) ? $player->matches_played : '142' }}
                        </p>
                    </div>
                </div>
            @endif

            {{-- View Profile Link --}}
            <div class="pt-3">
                <x-link-arrow href="{{ route('players.show', $player->slug) }}" size="sm" class="w-full justify-center">
                    {{ __('Voir le profil') }}
                </x-link-arrow>
            </div>
        </div>
    </div>
</a>
