<div x-data="{ open: false }" class="relative">
    <button @click="open = !open"
            class="flex items-center gap-2 px-3 py-2 rounded-lg bg-muted/50 hover:bg-muted transition-colors border border-border group">
        @php
            $currentLocale = app()->getLocale();
            $flags = ['en' => '🇬🇧', 'fr' => '🇫🇷'];
            $names = ['en' => 'English', 'fr' => 'Français'];
        @endphp
        <span class="text-xl">{{ $flags[$currentLocale] ?? '🌐' }}</span>
        <span class="font-semibold text-sm">{{ $names[$currentLocale] ?? strtoupper($currentLocale) }}</span>
        <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    <!-- Dropdown -->
    <div x-show="open"
         @click.away="open = false"
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="absolute right-0 mt-2 w-48 bg-card border border-border rounded-lg shadow-xl overflow-hidden z-50">
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
               hreflang="{{ $localeCode }}"
               class="flex items-center gap-3 px-4 py-3 hover:bg-muted transition-colors
                      {{ app()->getLocale() === $localeCode ? 'bg-primary/10 border-l-4 border-primary' : '' }}">
                <span class="text-2xl">{{ $flags[$localeCode] ?? '🌐' }}</span>
                <div class="flex-1">
                    <span class="font-semibold text-sm block">{{ $names[$localeCode] ?? strtoupper($localeCode) }}</span>
                    <span class="text-xs text-muted-foreground">{{ $properties['native'] ?? $localeCode }}</span>
                </div>
                @if(app()->getLocale() === $localeCode)
                    <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                @endif
            </a>
        @endforeach
    </div>
</div>
