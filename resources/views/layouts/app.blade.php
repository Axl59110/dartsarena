<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'DartsArena - ' . __('Actualités, Résultats et Statistiques Fléchettes'))</title>
    <meta name="description" content="@yield('meta_description', __('DartsArena - Votre hub complet pour les fléchettes : résultats, classements, calendrier, statistiques et guides.'))">

    @yield('seo_head')

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
            body { font-family: 'Inter', system-ui, sans-serif; background: #0f172a; color: #e2e8f0; line-height: 1.6; }
            a { color: inherit; text-decoration: none; }
            .container { max-width: 1280px; margin: 0 auto; padding: 0 1rem; }
        </style>
    @endif

    <style>
        :root {
            --da-primary: #dc2626;
            --da-primary-dark: #991b1b;
            --da-dark: #0f172a;
            --da-darker: #020617;
            --da-card: #1e293b;
            --da-card-hover: #334155;
            --da-text: #e2e8f0;
            --da-text-muted: #94a3b8;
            --da-border: #334155;
            --da-accent: #f59e0b;
        }
        body { font-family: 'Inter', system-ui, sans-serif; background: var(--da-dark); color: var(--da-text); }
        .container { max-width: 1280px; margin: 0 auto; padding: 0 1rem; }

        /* Header */
        .site-header { background: var(--da-darker); border-bottom: 2px solid var(--da-primary); position: sticky; top: 0; z-index: 50; }
        .header-inner { display: flex; align-items: center; justify-content: space-between; padding: 0.75rem 0; }
        .logo { font-size: 1.5rem; font-weight: 800; color: white; display: flex; align-items: center; gap: 0.5rem; }
        .logo span.red { color: var(--da-primary); }

        /* Navigation */
        .main-nav { display: flex; gap: 0.25rem; }
        .main-nav a { padding: 0.5rem 1rem; border-radius: 0.5rem; font-size: 0.875rem; font-weight: 500; color: var(--da-text-muted); transition: all 0.2s; }
        .main-nav a:hover, .main-nav a.active { background: var(--da-card); color: white; }

        /* Lang Switcher */
        .lang-switcher { display: flex; gap: 0.25rem; background: var(--da-card); border-radius: 0.5rem; padding: 0.15rem; }
        .lang-switcher a { padding: 0.35rem 0.75rem; border-radius: 0.375rem; font-size: 0.75rem; font-weight: 600; color: var(--da-text-muted); transition: all 0.2s; text-transform: uppercase; }
        .lang-switcher a.active { background: var(--da-primary); color: white; }
        .lang-switcher a:hover:not(.active) { color: white; }

        /* Footer */
        .site-footer { background: var(--da-darker); border-top: 1px solid var(--da-border); padding: 2rem 0; margin-top: 3rem; }
        .footer-inner { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; }
        .footer-text { color: var(--da-text-muted); font-size: 0.875rem; }

        /* Cards */
        .card { background: var(--da-card); border: 1px solid var(--da-border); border-radius: 0.75rem; padding: 1.5rem; transition: all 0.2s; }
        .card:hover { border-color: var(--da-primary); background: var(--da-card-hover); }

        /* Badges */
        .badge { display: inline-flex; align-items: center; padding: 0.2rem 0.6rem; border-radius: 9999px; font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; }
        .badge-live { background: #dc262633; color: #ef4444; border: 1px solid #dc262666; }
        .badge-upcoming { background: #f59e0b33; color: #fbbf24; border: 1px solid #f59e0b66; }
        .badge-finished { background: #22c55e33; color: #4ade80; border: 1px solid #22c55e66; }

        /* Breadcrumbs */
        .breadcrumbs { display: flex; align-items: center; gap: 0.5rem; font-size: 0.8rem; color: var(--da-text-muted); padding: 1rem 0; }
        .breadcrumbs a { color: var(--da-primary); }
        .breadcrumbs a:hover { text-decoration: underline; }
        .breadcrumbs .separator { opacity: 0.5; }

        /* Hero */
        .hero { background: linear-gradient(135deg, var(--da-darker) 0%, #1e1b4b 50%, var(--da-primary-dark) 100%); padding: 3rem 0; margin-bottom: 2rem; border-bottom: 2px solid var(--da-primary); }
        .hero h1 { font-size: 2.5rem; font-weight: 800; margin-bottom: 0.5rem; }
        .hero p { color: var(--da-text-muted); font-size: 1.1rem; }

        /* Section */
        .section-title { font-size: 1.25rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem; }
        .section-title .icon { color: var(--da-primary); }

        /* Grid */
        .grid-2 { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1rem; }
        .grid-3 { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem; }

        /* Mobile */
        .mobile-menu-btn { display: none; background: none; border: none; color: white; font-size: 1.5rem; cursor: pointer; }
        @media (max-width: 768px) {
            .main-nav { display: none; flex-direction: column; position: absolute; top: 100%; left: 0; right: 0; background: var(--da-darker); padding: 1rem; border-bottom: 2px solid var(--da-primary); }
            .main-nav.open { display: flex; }
            .mobile-menu-btn { display: block; }
            .hero h1 { font-size: 1.75rem; }
            .header-inner { flex-wrap: wrap; }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="site-header">
        <div class="container">
            <div class="header-inner">
                <a href="{{ route('home') }}" class="logo">
                    🎯 Darts<span class="red">Arena</span>
                </a>

                <button class="mobile-menu-btn" onclick="document.querySelector('.main-nav').classList.toggle('open')">
                    ☰
                </button>

                <nav class="main-nav">
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                        {{ __('Accueil') }}
                    </a>
                    <a href="{{ route('articles.index') }}" class="{{ request()->routeIs('articles.*') ? 'active' : '' }}">
                        {{ __('News') }}
                    </a>
                    <a href="{{ route('competitions.index') }}" class="{{ request()->routeIs('competitions.*') ? 'active' : '' }}">
                        {{ __('Compétitions') }}
                    </a>
                    <a href="{{ route('players.index') }}" class="{{ request()->routeIs('players.*') ? 'active' : '' }}">
                        {{ __('Joueurs') }}
                    </a>
                    <a href="{{ route('rankings.index') }}" class="{{ request()->routeIs('rankings.*') ? 'active' : '' }}">
                        {{ __('Classements') }}
                    </a>
                    <a href="{{ route('calendar.index') }}" class="{{ request()->routeIs('calendar.*') ? 'active' : '' }}">
                        {{ __('Calendrier') }}
                    </a>
                    <a href="{{ route('guides.index') }}" class="{{ request()->routeIs('guides.*') ? 'active' : '' }}">
                        {{ __('Guides') }}
                    </a>
                </nav>

                <x-lang-switcher />
            </div>
        </div>
    </header>

    <!-- Breadcrumbs -->
    @hasSection('breadcrumbs')
        <div class="container">
            @yield('breadcrumbs')
        </div>
    @endif

    <!-- Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-inner">
                <div class="footer-text">
                    &copy; {{ date('Y') }} DartsArena. {{ __('Tous droits réservés.') }}
                </div>
                <x-lang-switcher />
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.querySelector('.mobile-menu-btn');
            if (btn) {
                btn.addEventListener('click', function() {
                    document.querySelector('.main-nav').classList.toggle('open');
                });
            }
        });
    </script>
</body>
</html>
