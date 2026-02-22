# STORY-001: Setup Laravel + TailwindCSS + Architecture de base + i18n

## User Story
En tant que developpeur, je veux initialiser le projet Laravel avec TailwindCSS v4 et le systeme multilingue afin de disposer d'une base solide pour le developpement.

## Story Points: 3

## Acceptance Criteria
- [ ] Projet Laravel 11 initialise avec Herd
- [ ] TailwindCSS v4 installe et configure
- [ ] Layout principal (app.blade.php) avec header, footer, navigation
- [ ] spatie/laravel-translatable installe et configure
- [ ] mcamara/laravel-localization installe avec routes /fr/ et /en/
- [ ] Middleware de locale fonctionnel
- [ ] Component lang-switcher (toggle FR/EN) dans le header
- [ ] Page d'accueil placeholder accessible en /fr/ et /en/
- [ ] .env configure pour SQLite

## Technical Notes
- Models: Aucun modele metier a ce stade
- Routes: Route home avec prefix locale, middleware locale
- Components: layouts/app.blade.php, components/lang-switcher.blade.php
- Packages: spatie/laravel-translatable, mcamara/laravel-localization, tailwindcss v4
- Config: config/translatable.php, config/laravellocalization.php

## Sprint: 1
## Priority: Must
## Status: pending
