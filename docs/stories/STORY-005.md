# STORY-005: Fiches Joueurs

## User Story
En tant qu'utilisateur, je veux consulter les fiches detaillees des joueurs afin de connaitre leur parcours, leurs statistiques et leur palmares.

## Story Points: 3

## Acceptance Criteria
- [ ] Page index joueurs (/fr/joueurs) avec liste paginee, recherche par nom, filtre par nationalite
- [ ] Page show joueur (/fr/joueurs/luke-humphries) avec sections organisees en tabs
- [ ] Tab "Profil" : photo, nom, nickname, nationalite, age, bio
- [ ] Tab "Statistiques" : moyenne, checkout %, 180s, 9-darters en carriere
- [ ] Tab "Palmares" : liste des titres avec competition et annee
- [ ] Tab "Matchs recents" : derniers matchs avec scores et adversaires
- [ ] Classement actuel du joueur affiche en evidence
- [ ] Liens vers les matchs et competitions depuis la fiche joueur
- [ ] Meta tags SEO specifiques joueur (Person Schema.org)
- [ ] Photo du joueur avec lazy loading
- [ ] Page responsive

## Technical Notes
- Models: Player, PlayerRanking, Match (via pivot match_player)
- Routes: players.index, players.show
- Components: player-card.blade.php, stat-table.blade.php, tabs component
- SEO: Schema.org Person, title "{player_name} - Fiche Joueur | DartsArena"

## Sprint: 1
## Priority: Must
## Status: pending
