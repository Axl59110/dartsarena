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
## Status: in-progress

---

## 📚 Documentation Associée

### Archives Calendar
- [CALENDAR_IMPROVEMENTS.md](../archive/calendar/CALENDAR_IMPROVEMENTS.md) - Détails techniques complets
- [SUMMARY_IMPROVEMENTS.md](../archive/calendar/SUMMARY_IMPROVEMENTS.md) - Résumé améliorations
- [VISUAL_TESTING_GUIDE.md](../archive/calendar/VISUAL_TESTING_GUIDE.md) - Guide tests
- [README_CALENDAR_REFONTE.md](../archive/calendar/README_CALENDAR_REFONTE.md) - Refonte complète

### Guides
- [LEARNINGS.md](../LEARNINGS.md) - Best practices Alpine.js & SEO
- [CHANGELOG.md](../CHANGELOG.md#2026-02-25) - Historique complet

---

## ✅ Travail Accompli (Partiel)

### Page Calendrier - Fonctionnel + UX ✓
- ✅ **Calendrier visuel mensuel** avec navigation (desktop uniquement)
- ✅ **Filtres dynamiques** par mois et fédération (Alpine.js)
- ✅ **Tableau SEO HTML** complet avec 6 colonnes crawlables
- ✅ **Vue mobile responsive** avec cards liste
- ✅ **URLs partageables** avec query params (`?month=5&federation=pdc`)
- ✅ **54 traductions** FR/EN ajoutées
- ✅ **Dots colorés** par fédération sur calendrier
- ✅ **Badges status** (Live/Upcoming/Finished)
- ✅ **Empty state** élégant

**Fichiers modifiés:**
- `app/Http/Controllers/CalendarController.php` - Filtres et données
- `resources/views/calendar/index.blade.php` - Refonte complète
- `lang/en.json` + `lang/fr.json` - 27 clés chacun
- `resources/views/components/lang-switcher.blade.php` - Simplifié

### SEO & Accessibilité
- ✅ **HTML sémantique** table crawlable
- ✅ **WCAG AA compliant** contrastes & navigation
- ✅ **Performance optimale** Alpine.js lightweight

### Reste à Faire - Classement
- [ ] Page classement (/fr/classements)
- [ ] Page classement federation (/fr/classements/pdc)
- [ ] Tableau classement complet
- [ ] Tri par colonne
- [ ] Pagination 50 joueurs
- [ ] Meta tags SEO classement

**Progression estimée:** 50% (Calendar done, Classement reste)
