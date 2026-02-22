# STORY-007: Pages de Match (Resultats, Stats, Score)

## User Story
En tant qu'utilisateur, je veux consulter les details d'un match afin de voir le score, les statistiques detaillees et le deroulement de la rencontre.

## Story Points: 5

## Acceptance Criteria
- [ ] Page match (/fr/pdc/world-championship/2025/humphries-vs-littler) avec layout complet
- [ ] Header match : joueur 1 vs joueur 2, photos, drapeaux, score final en grand
- [ ] Detail du score par set/leg
- [ ] Tableau stats comparatif : moyenne, checkout %, 180s, highest checkout
- [ ] Statut du match (A venir / En cours / Termine) avec badge visuel
- [ ] Information contextuelle : competition, round, date, lieu
- [ ] Section Head-to-Head (historique des confrontations entre les 2 joueurs)
- [ ] Liens vers les fiches des 2 joueurs
- [ ] Lien vers la competition/saison parente
- [ ] Breadcrumbs complets (Accueil > PDC > World Championship > 2025 > Match)
- [ ] Meta tags SEO (SportsEvent Schema.org)
- [ ] Page responsive avec layout adapte mobile

## Technical Notes
- Models: Match, Player (pivot match_player), MatchStat, Season, Competition
- Routes: matches.show
- Components: match-card.blade.php (reutilisable), stat-comparison.blade.php
- SEO: Schema.org SportsEvent, title "{player1} vs {player2} - {competition} | DartsArena"
- Slug match genere automatiquement : "{player1-slug}-vs-{player2-slug}"

## Sprint: 2
## Priority: Must
## Status: pending
