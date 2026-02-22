# STORY-008: Page Matchs du Jour

## User Story
En tant qu'utilisateur, je veux voir tous les matchs du jour afin de savoir quelles rencontres suivre aujourd'hui.

## Story Points: 3

## Acceptance Criteria
- [ ] Page matchs du jour (/fr/matchs-du-jour) avec liste des matchs
- [ ] Matchs groupes par competition
- [ ] Chaque match affiche : heure, joueur 1 vs joueur 2, competition, round
- [ ] Badge statut : "A venir", "En cours", "Termine" avec couleurs distinctes
- [ ] Scores affiches pour les matchs termines
- [ ] Liens vers la page detail de chaque match
- [ ] Si aucun match aujourd'hui : afficher les prochains matchs a venir
- [ ] Tri chronologique (prochain match en premier)
- [ ] Auto-refresh leger ou indication "derniere mise a jour"
- [ ] Page responsive

## Technical Notes
- Models: Match, Player, Competition, Season
- Routes: matches.today
- Components: match-card.blade.php (reutilisation), match-status-badge.blade.php
- Query: Match::whereDate('scheduled_at', today())->with('players', 'season.competition')

## Sprint: 2
## Priority: Should
## Status: pending
