<div class="lang-switcher">
    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
           class="{{ app()->getLocale() === $localeCode ? 'active' : '' }}"
           hreflang="{{ $localeCode }}">
            {{ strtoupper($localeCode) }}
        </a>
    @endforeach
</div>
