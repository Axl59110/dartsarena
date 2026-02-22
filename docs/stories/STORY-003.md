# STORY-003: Seeders avec Donnees Initiales

## User Story
En tant que developpeur, je veux pre-remplir la base de donnees avec les federations, competitions principales et les top 50 joueurs afin de pouvoir tester le site avec des donnees realistes.

## Story Points: 3

## Acceptance Criteria
- [ ] Seeder Federation : PDC, WDF (ex-BDO) avec noms FR/EN, logos, URLs
- [ ] Seeder Competition : au minimum World Championship, Premier League, World Matchplay, ProTour, Grand Slam, Players Championship, UK Open, European Championship
- [ ] Seeder Season : saisons 2024 et 2025 pour chaque competition
- [ ] Seeder Player : top 50 joueurs PDC (nom, nationalite, date de naissance, nickname, stats de carriere)
- [ ] Seeder CalendarEvent : evenements 2025-2026 avec dates et lieux
- [ ] Seeder Match : au minimum 20 matchs recents avec scores et stats de base
- [ ] Donnees disponibles en FR et EN
- [ ] Commande artisan db:seed fonctionnelle pour reset complet

## Technical Notes
- Models: Federation, Competition, Season, Player, CalendarEvent, Match
- Routes: Aucune
- Components: Aucun
- Sources de donnees pour seeders : mastercaller.com, pdc.tv, Wikipedia pour les bios joueurs

## Sprint: 1
## Priority: Must
## Status: pending
