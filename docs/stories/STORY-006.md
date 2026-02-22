# STORY-006: Page Classement Filtrable + Page Calendrier

## User Story
En tant qu'utilisateur, je veux consulter les classements par federation et le calendrier des evenements afin de suivre la hierarchie des joueurs et planifier mes visionnages.

## Story Points: 5

## Acceptance Criteria
- [ ] Page classement (/fr/classements) avec selection de federation (PDC, WDF)
- [ ] Page classement federation (/fr/classements/pdc) avec tableau complet
- [ ] Tableau classement : position, joueur (lien fiche), nationalite, prize money, variation (+/-)
- [ ] Tri par colonne (position, nom, prize money)
- [ ] Pagination (50 joueurs par page)
- [ ] Page calendrier (/fr/calendrier) avec vue liste
- [ ] Filtres calendrier : par federation, par mois, evenements passes/a venir
- [ ] Chaque evenement affiche : date, competition, lieu, lien billetterie si disponible
- [ ] Liens vers les pages competition depuis le calendrier
- [ ] Meta tags SEO sur les deux pages
- [ ] Tables responsives sur mobile (scroll horizontal ou cards)

## Technical Notes
- Models: PlayerRanking, CalendarEvent, Federation, Competition
- Routes: rankings.index, rankings.show, calendar.index
- Components: ranking-table.blade.php, calendar-event.blade.php
- SEO: title "Classement {federation} | DartsArena", "Calendrier Flechettes | DartsArena"

## Sprint: 2
## Priority: Must
## Status: pending
