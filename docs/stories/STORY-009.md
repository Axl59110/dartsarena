# STORY-009: Service de Scraping + Jobs Schedules

## User Story
En tant que proprietaire du site, je veux que les donnees (resultats, classements, calendrier) se mettent a jour automatiquement afin de ne pas avoir a saisir manuellement les informations.

## Story Points: 8

## Acceptance Criteria
- [ ] Interface ScraperInterface definissant le contrat (scrape, parse, store)
- [ ] MasterCallerScraper : scraping des resultats de matchs depuis mastercaller.com
- [ ] MasterCallerScraper : scraping du calendrier des evenements
- [ ] MasterCallerScraper : scraping des statistiques de matchs
- [ ] PdcScraper : scraping des classements (Order of Merit)
- [ ] PdcScraper : scraping des informations joueurs
- [ ] Job ScrapeMatchResults : execution quotidienne pour les resultats
- [ ] Job ScrapeCalendar : execution hebdomadaire pour le calendrier
- [ ] Job ScrapeRankings : execution hebdomadaire pour les classements
- [ ] Job ScrapePlayerStats : execution mensuelle pour les stats joueurs
- [ ] Scheduling Laravel configure (Kernel.php ou routes/console.php)
- [ ] Gestion des erreurs : retry 3x, logging, notification en cas d'echec
- [ ] Rate limiting : delai de 2s entre chaque requete, rotation user-agent
- [ ] Cache des pages scrapees pour eviter les requetes inutiles
- [ ] Commande artisan `php artisan scrape:all` pour execution manuelle
- [ ] Commande artisan `php artisan scrape:results`, `scrape:rankings`, etc.
- [ ] Logs detailles de chaque session de scraping

## Technical Notes
- Models: Tous les modeles sont concernes (Match, Player, PlayerRanking, CalendarEvent)
- Routes: Aucune (backend only)
- Components: Aucun
- Services: Services/Scraping/ScraperInterface.php, MasterCallerScraper.php, PdcScraper.php
- Jobs: Jobs/ScrapeMatchResults.php, ScrapeCalendar.php, ScrapeRankings.php, ScrapePlayerStats.php
- Packages: guzzlehttp/guzzle, symfony/dom-crawler
- Risque: Les structures HTML des sites sources peuvent changer — prevoir des tests unitaires sur le parsing

## Sprint: 2
## Priority: Must
## Status: pending
