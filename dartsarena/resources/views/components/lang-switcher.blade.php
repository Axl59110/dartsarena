@php
    $currentLocale = app()->getLocale();
@endphp

<div x-data="{ open: false }" class="relative">
    <button @click="open = !open"
            type="button"
            class="flex items-center gap-2 px-3 py-2 rounded-[var(--radius-base)] bg-card border border-border hover:bg-muted transition-colors text-sm font-semibold text-foreground"
            aria-label="Change language">
        @if($currentLocale === 'fr')
            <span class="text-sm font-bold">FR</span>
        @else
            <span class="text-sm font-bold">EN</span>
        @endif
        <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    {{-- Dropdown - z-[100] pour passer au-dessus du header sticky (z-50) --}}
    <div x-show="open"
         @click.away="open = false"
         x-transition
         class="absolute left-0 mt-2 w-40 bg-card border border-border rounded-[var(--radius-base)] shadow-lg overflow-hidden z-[100]"
         style="display: none;">
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
               class="flex items-center gap-3 px-4 py-2.5 hover:bg-muted transition-colors text-sm font-medium
                      {{ app()->getLocale() === $localeCode ? 'bg-primary/5 text-primary font-semibold' : 'text-foreground' }}">
                <span class="text-sm font-bold">
                    @if($localeCode === 'fr')
                        FR
                    @else
                        EN
                    @endif
                </span>
                <span>
                    @if($localeCode === 'fr')
                        Français
                    @else
                        English
                    @endif
                </span>
                @if(app()->getLocale() === $localeCode)
                    <svg class="w-4 h-4 ml-auto text-primary" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                @endif
            </a>
        @endforeach
    </div>
</div>
