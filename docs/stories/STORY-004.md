# STORY-004: Pages Federation + Competition (Silos SEO)

## User Story
En tant qu'utilisateur, je veux naviguer par federation et competition afin de trouver facilement les informations sur les tournois qui m'interessent.

## Story Points: 5

## Acceptance Criteria
- [ ] Page index federations (/fr/federations) listant PDC, WDF avec logos et descriptions
- [ ] Page show federation (/fr/pdc) affichant les competitions de cette federation
- [ ] Page show competition (/fr/pdc/world-championship) affichant info, saisons, resultats
- [ ] Page season (/fr/pdc/world-championship/2025) affichant le tableau, les matchs, le vainqueur
- [ ] Breadcrumbs SEO sur chaque page (Accueil > PDC > World Championship > 2025)
- [ ] URLs semantiques avec slugs traduisibles
- [ ] Composant breadcrumb reutilisable
- [ ] Liens internes entre silos (federation → competitions → saisons)
- [ ] Meta tags SEO (title, description) automatiques par page
- [ ] Pages responsive (mobile + desktop)
- [ ] Navigation sidebar ou menu pour les competitions d'une federation

## Technical Notes
- Models: Federation, Competition, Season
- Routes: federations.index, federations.show, competitions.show, competitions.season
- Components: breadcrumb.blade.php, federation-card.blade.php, competition-card.blade.php
- SEO: title template "{competition} - {federation} | DartsArena", breadcrumbs Schema.org

## Sprint: 1
## Priority: Must
## Status: pending
