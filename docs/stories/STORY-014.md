# STORY-014: Homepage Dashboard

## User Story
En tant qu'utilisateur, je veux voir sur la page d'accueil les matchs du jour, les dernieres actualites et les competitions en cours afin d'avoir un apercu rapide de l'actualite des flechettes.

## Story Points: 3

## Acceptance Criteria
- [ ] Section "Matchs du jour" en haut de page (priorite visuelle)
- [ ] Affichage des matchs avec scores live/resultats si disponibles
- [ ] Si aucun match aujourd'hui : "Prochains matchs" avec les prochains a venir
- [ ] Section "Competitions en cours" avec badges et liens
- [ ] Section "Dernieres actualites" avec les 6 derniers articles (image + titre + extrait)
- [ ] Section "Classement rapide" : top 10 du classement PDC
- [ ] Section "Prochain evenement" avec compte a rebours ou date
- [ ] Liens rapides vers : calendrier, classements, guides
- [ ] Design moderne et engageant (hero section ou dashboard style)
- [ ] Page responsive (layout different mobile vs desktop)
- [ ] Meta tags SEO homepage
- [ ] Temps de chargement < 2s (queries optimisees, eager loading)

## Technical Notes
- Models: Match, Article, Competition, PlayerRanking, CalendarEvent
- Routes: home
- Components: match-card.blade.php, article-card.blade.php, ranking-widget.blade.php, competition-badge.blade.php
- Controller: HomeController avec queries optimisees (eager loading, cache)
- SEO: title "DartsArena - Actualites, Resultats et Statistiques Flechettes"

## Sprint: 3
## Priority: Must
## Status: pending
