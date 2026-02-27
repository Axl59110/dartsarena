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
## Status: in-progress

---

## 📚 Documentation Associée

### Archives UX
- [CORRECTIONS_UX_FINALES.md](../archive/ux/CORRECTIONS_UX_FINALES.md) - Corrections détaillées page Competitions
- [UX_ANALYSIS.md](../archive/ux/UX_ANALYSIS.md) - Analyse violations UX initiales
- [MISSION_ACCOMPLIE.md](../archive/ux/MISSION_ACCOMPLIE.md) - Synthèse globale corrections

### Guides
- [LEARNINGS.md](../LEARNINGS.md) - Best practices à suivre
- [CHANGELOG.md](../CHANGELOG.md#2026-02-25) - Historique complet

---

## ✅ Travail Accompli (Partiel)

### Page Competitions - UX/UI ✓
- ✅ **Images/logos compétitions** avec fallback badge élégant
- ✅ **Devise corrigée:** £ (British Pound) au lieu de $
- ✅ **Participants count** ajouté
- ✅ **Stats grid complètes** (Prize / Participants / Date)
- ✅ **Composant réutilisable** `components/competition-card.blade.php`
- ✅ **Score UX:** 5/10 → 9/10 (+80%)

**Fichiers modifiés:**
- `resources/views/competitions/index.blade.php`
- `resources/views/components/competition-card.blade.php`

### Reste à Faire
- [ ] Page show federation (/fr/pdc)
- [ ] Page show competition (/fr/pdc/world-championship)
- [ ] Page season (/fr/pdc/world-championship/2025)
- [ ] Breadcrumbs SEO
- [ ] URLs semantiques traduisibles
- [ ] Meta tags SEO automatiques
- [ ] Navigation sidebar competitions

**Progression estimée:** 25% (UX done, fonctionnel reste)
