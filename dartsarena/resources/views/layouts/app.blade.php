<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'DartsArena - ' . __('Professional Darts News & Stats'))</title>
    <meta name="description" content="@yield('meta_description', __('DartsArena - The ultimate destination for professional darts: breaking news, player stats, rankings, fixtures and expert analysis.'))">

    @yield('seo_head')

    <!-- Hreflang Tags -->
    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        <link rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" />
    @endforeach
    <link rel="alternate" hreflang="x-default" href="{{ LaravelLocalization::getLocalizedURL(config('app.fallback_locale'), null, [], true) }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="min-h-screen flex flex-col">
    <!-- Top Bar -->
    <div class="bg-secondary text-secondary-foreground">
        <div class="container">
            <div class="flex items-center justify-between h-12 text-sm">
                <div class="flex items-center gap-8">
                    <span class="hidden md:inline font-medium">{{ now()->format('l, F j, Y') }}</span>
                    <span class="hidden lg:inline text-secondary-foreground/80">{{ __('Professional Darts Coverage') }}</span>
                </div>
                <div class="flex items-center gap-6">
                    <x-lang-switcher />
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header class="sticky top-0 z-50 bg-background border-b border-border">
        <div class="container">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="relative">
                        <span class="relative text-4xl transform group-hover:scale-110 transition-transform duration-200" role="img" aria-label="{{ __('DartsArena logo - dart target') }}">🎯</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-display text-2xl lg:text-3xl font-bold tracking-tighter">
                            Darts<span class="text-primary">Arena</span>
                        </span>
                        <span class="hidden sm:block text-[10px] text-muted-foreground uppercase tracking-widest font-semibold -mt-0.5">Professional Coverage</span>
                    </div>
                </a>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center gap-2">
                    <a href="{{ route('home') }}"
                       class="px-4 py-2.5 text-sm font-semibold rounded-[var(--radius-md)] transition-all duration-200 focus-visible:ring-4 focus-visible:ring-primary/50 focus-visible:ring-offset-2 focus-visible:outline-none {{ request()->routeIs('home') ? 'bg-primary text-primary-foreground focus-visible:bg-primary-hover' : 'hover:bg-muted hover:text-foreground focus-visible:bg-muted' }}">
                        {{ __('Home') }}
                    </a>
                    <a href="{{ route('articles.index') }}"
                       class="px-4 py-2.5 text-sm font-semibold rounded-[var(--radius-md)] transition-all duration-200 focus-visible:ring-4 focus-visible:ring-primary/50 focus-visible:ring-offset-2 focus-visible:outline-none {{ request()->routeIs('articles.*') ? 'bg-primary text-primary-foreground focus-visible:bg-primary-hover' : 'hover:bg-muted hover:text-foreground focus-visible:bg-muted' }}">
                        {{ __('News') }}
                    </a>
                    <a href="{{ route('players.index') }}"
                       class="px-4 py-2.5 text-sm font-semibold rounded-[var(--radius-md)] transition-all duration-200 focus-visible:ring-4 focus-visible:ring-primary/50 focus-visible:ring-offset-2 focus-visible:outline-none {{ request()->routeIs('players.*') ? 'bg-primary text-primary-foreground focus-visible:bg-primary-hover' : 'hover:bg-muted hover:text-foreground focus-visible:bg-muted' }}">
                        {{ __('Players') }}
                    </a>
                    <a href="{{ route('rankings.index') }}"
                       class="px-4 py-2.5 text-sm font-semibold rounded-[var(--radius-md)] transition-all duration-200 focus-visible:ring-4 focus-visible:ring-primary/50 focus-visible:ring-offset-2 focus-visible:outline-none {{ request()->routeIs('rankings.*') ? 'bg-primary text-primary-foreground focus-visible:bg-primary-hover' : 'hover:bg-muted hover:text-foreground focus-visible:bg-muted' }}">
                        {{ __('Rankings') }}
                    </a>
                    <a href="{{ route('competitions.index') }}"
                       class="px-4 py-2.5 text-sm font-semibold rounded-[var(--radius-md)] transition-all duration-200 focus-visible:ring-4 focus-visible:ring-primary/50 focus-visible:ring-offset-2 focus-visible:outline-none {{ request()->routeIs('competitions.*') ? 'bg-primary text-primary-foreground focus-visible:bg-primary-hover' : 'hover:bg-muted hover:text-foreground focus-visible:bg-muted' }}">
                        {{ __('Competitions') }}
                    </a>
                    <a href="{{ route('calendar.index') }}"
                       class="px-4 py-2.5 text-sm font-semibold rounded-[var(--radius-md)] transition-all duration-200 focus-visible:ring-4 focus-visible:ring-primary/50 focus-visible:ring-offset-2 focus-visible:outline-none {{ request()->routeIs('calendar.*') ? 'bg-primary text-primary-foreground focus-visible:bg-primary-hover' : 'hover:bg-muted hover:text-foreground focus-visible:bg-muted' }}">
                        {{ __('Fixtures') }}
                    </a>
                    <a href="{{ route('guides.index') }}"
                       class="px-4 py-2.5 text-sm font-semibold rounded-[var(--radius-md)] transition-all duration-200 focus-visible:ring-4 focus-visible:ring-primary/50 focus-visible:ring-offset-2 focus-visible:outline-none {{ request()->routeIs('guides.*') ? 'bg-primary text-primary-foreground focus-visible:bg-primary-hover' : 'hover:bg-muted hover:text-foreground focus-visible:bg-muted' }}">
                        {{ __('Guides') }}
                    </a>
                </nav>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn"
                        class="lg:hidden inline-flex items-center justify-center p-2.5 rounded-[var(--radius-md)] hover:bg-muted transition-colors focus-visible:ring-4 focus-visible:ring-primary/50 focus-visible:outline-none"
                        aria-label="{{ __('Toggle menu') }}"
                        aria-expanded="false"
                        aria-controls="mobile-menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div id="mobile-menu"
             class="hidden lg:hidden border-t border-border/50 bg-background/95 backdrop-blur-xl"
             aria-hidden="true">
            <nav class="container py-4 flex flex-col gap-1">
                <a href="{{ route('home') }}"
                   class="px-4 py-3 text-base font-semibold rounded-lg transition-all duration-200 {{ request()->routeIs('home') ? 'bg-primary/10 text-primary border border-primary/30' : 'hover:bg-muted hover:text-foreground border border-transparent' }}">
                    {{ __('Home') }}
                </a>
                <a href="{{ route('articles.index') }}"
                   class="px-4 py-3 text-base font-semibold rounded-lg transition-all duration-200 {{ request()->routeIs('articles.*') ? 'bg-primary/10 text-primary border border-primary/30' : 'hover:bg-muted hover:text-foreground border border-transparent' }}">
                    {{ __('News') }}
                </a>
                <a href="{{ route('players.index') }}"
                   class="px-4 py-3 text-base font-semibold rounded-lg transition-all duration-200 {{ request()->routeIs('players.*') ? 'bg-primary/10 text-primary border border-primary/30' : 'hover:bg-muted hover:text-foreground border border-transparent' }}">
                    {{ __('Players') }}
                </a>
                <a href="{{ route('rankings.index') }}"
                   class="px-4 py-3 text-base font-semibold rounded-lg transition-all duration-200 {{ request()->routeIs('rankings.*') ? 'bg-primary/10 text-primary border border-primary/30' : 'hover:bg-muted hover:text-foreground border border-transparent' }}">
                    {{ __('Rankings') }}
                </a>
                <a href="{{ route('competitions.index') }}"
                   class="px-4 py-3 text-base font-semibold rounded-lg transition-all duration-200 {{ request()->routeIs('competitions.*') ? 'bg-primary/10 text-primary border border-primary/30' : 'hover:bg-muted hover:text-foreground border border-transparent' }}">
                    {{ __('Competitions') }}
                </a>
                <a href="{{ route('calendar.index') }}"
                   class="px-4 py-3 text-base font-semibold rounded-lg transition-all duration-200 {{ request()->routeIs('calendar.*') ? 'bg-primary/10 text-primary border border-primary/30' : 'hover:bg-muted hover:text-foreground border border-transparent' }}">
                    {{ __('Fixtures') }}
                </a>
                <a href="{{ route('guides.index') }}"
                   class="px-4 py-3 text-base font-semibold rounded-lg transition-all duration-200 {{ request()->routeIs('guides.*') ? 'bg-primary/10 text-primary border border-primary/30' : 'hover:bg-muted hover:text-foreground border border-transparent' }}">
                    {{ __('Guides') }}
                </a>
            </nav>
        </div>
    </header>

    <!-- Breadcrumbs -->
    @hasSection('breadcrumbs')
        <div class="bg-muted/30 border-b border-border/50">
            <div class="container">
                @yield('breadcrumbs')
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-secondary text-secondary-foreground mt-auto">
        <div class="container py-12 lg:py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-12">
                <!-- About -->
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-3xl">🎯</span>
                        <span class="font-display text-xl font-bold">
                            Darts<span class="text-primary">Arena</span>
                        </span>
                    </div>
                    <p class="text-sm text-secondary-foreground/80 leading-relaxed mb-6">
                        {{ __('Your premier destination for professional darts news, statistics, and coverage of the PDC circuit.') }}
                    </p>
                    <x-lang-switcher />
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="font-display font-bold text-sm uppercase tracking-wider mb-4">{{ __('Quick Links') }}</h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('articles.index') }}" class="text-secondary-foreground/80 hover:text-secondary-foreground transition-colors">{{ __('Latest News') }}</a></li>
                        <li><a href="{{ route('players.index') }}" class="text-secondary-foreground/80 hover:text-secondary-foreground transition-colors">{{ __('Players') }}</a></li>
                        <li><a href="{{ route('rankings.index') }}" class="text-secondary-foreground/80 hover:text-secondary-foreground transition-colors">{{ __('Rankings') }}</a></li>
                        <li><a href="{{ route('calendar.index') }}" class="text-secondary-foreground/80 hover:text-secondary-foreground transition-colors">{{ __('Fixtures') }}</a></li>
                    </ul>
                </div>

                <!-- Resources -->
                <div>
                    <h3 class="font-display font-bold text-sm uppercase tracking-wider mb-4">{{ __('Resources') }}</h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('guides.index') }}" class="text-secondary-foreground/80 hover:text-secondary-foreground transition-colors">{{ __('Guides') }}</a></li>
                        <li><a href="{{ route('competitions.index') }}" class="text-secondary-foreground/80 hover:text-secondary-foreground transition-colors">{{ __('Competitions') }}</a></li>
                        <li><a href="#" class="text-secondary-foreground/80 hover:text-secondary-foreground transition-colors">{{ __('About Us') }}</a></li>
                        <li><a href="#" class="text-secondary-foreground/80 hover:text-secondary-foreground transition-colors">{{ __('Contact') }}</a></li>
                    </ul>
                </div>

                <!-- Social -->
                <div>
                    <h3 class="font-display font-bold text-sm uppercase tracking-wider mb-4">{{ __('Connect') }}</h3>
                    <div class="flex gap-3 mb-6">
                        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg bg-secondary-foreground/10 hover:bg-primary hover:text-primary-foreground transition-all duration-200" aria-label="Twitter">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg bg-secondary-foreground/10 hover:bg-primary hover:text-primary-foreground transition-all duration-200" aria-label="Facebook">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg bg-secondary-foreground/10 hover:bg-primary hover:text-primary-foreground transition-all duration-200" aria-label="YouTube">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                    </div>
                    <p class="text-xs text-secondary-foreground/60">
                        &copy; {{ date('Y') }} DartsArena. {{ __('All rights reserved.') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-border/20">
            <div class="container py-4">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-secondary-foreground/60">
                    <div class="flex gap-6">
                        <a href="#" class="hover:text-secondary-foreground transition-colors">{{ __('Privacy Policy') }}</a>
                        <a href="#" class="hover:text-secondary-foreground transition-colors">{{ __('Terms of Service') }}</a>
                        <a href="#" class="hover:text-secondary-foreground transition-colors">{{ __('Cookie Policy') }}</a>
                    </div>
                    <div>
                        {{ __('Made with') }} ❤️ {{ __('for darts fans worldwide') }}
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');

            if (menuBtn && mobileMenu) {
                menuBtn.addEventListener('click', function() {
                    const isExpanded = menuBtn.getAttribute('aria-expanded') === 'true';

                    // Toggle ARIA states
                    menuBtn.setAttribute('aria-expanded', !isExpanded);
                    mobileMenu.setAttribute('aria-hidden', isExpanded);
                    mobileMenu.classList.toggle('hidden');

                    // Focus trap - focus first link when opening
                    if (!isExpanded) {
                        const firstLink = mobileMenu.querySelector('a');
                        if (firstLink) {
                            setTimeout(() => firstLink.focus(), 100);
                        }
                    }
                });

                // Close with Escape key
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && !mobileMenu.classList.contains('hidden')) {
                        menuBtn.setAttribute('aria-expanded', 'false');
                        mobileMenu.setAttribute('aria-hidden', 'true');
                        mobileMenu.classList.add('hidden');
                        menuBtn.focus();
                    }
                });

                // Close when clicking outside
                document.addEventListener('click', function(e) {
                    if (!mobileMenu.classList.contains('hidden') &&
                        !mobileMenu.contains(e.target) &&
                        !menuBtn.contains(e.target)) {
                        menuBtn.setAttribute('aria-expanded', 'false');
                        mobileMenu.setAttribute('aria-hidden', 'true');
                        mobileMenu.classList.add('hidden');
                    }
                });
            }
        });
    </script>

    <style>
        .breadcrumbs {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 0;
            font-size: 0.875rem;
            color: var(--color-muted-foreground);
        }

        .breadcrumbs a {
            color: var(--color-primary);
            transition: color 0.2s;
        }

        .breadcrumbs a:hover {
            color: var(--color-primary-hover);
        }

        .breadcrumbs .separator {
            opacity: 0.5;
        }
    </style>
</body>
</html>
