# STORY-012: Betting Tips par Match/Competition

## User Story
En tant que parieur, je veux consulter des pronostics et analyses pour les matchs de flechettes afin d'eclairer mes decisions de paris.

## Story Points: 3

## Acceptance Criteria
- [ ] Page index pronostics (/fr/pronostics) avec liste des tips recents
- [ ] Chaque tip affiche : match concerne, prediction, cotes, niveau de confiance
- [ ] Lien vers la page match associee
- [ ] Affichage du tip sur la page match correspondante (section "Pronostics")
- [ ] Niveau de confiance visuel (barres ou etoiles)
- [ ] Indication du bookmaker et lien affilie (si applicable)
- [ ] Filtre par competition
- [ ] Section resultats : tips passes avec resultat (gagne/perdu)
- [ ] Meta tags SEO
- [ ] Page responsive

## Technical Notes
- Models: BettingTip, Match, Player, Competition
- Routes: betting.index, betting.show (via match slug)
- Components: betting-tip-card.blade.php, confidence-meter.blade.php
- Note: Les tips peuvent etre saisis manuellement ou generes semi-automatiquement

## Sprint: 3
## Priority: Should
## Status: pending
