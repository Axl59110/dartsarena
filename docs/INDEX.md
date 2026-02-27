# 📚 Index Documentation - DartsArena

Guide de navigation complet de la documentation projet.

---

## 🎯 Navigation Rapide

### Je veux...

| Besoin | Fichier | Description |
|--------|---------|-------------|
| **Voir l'historique complet** | [CHANGELOG.md](CHANGELOG.md) | Toutes les modifications chronologiques |
| **Apprendre les best practices** | [LEARNINGS.md](LEARNINGS.md) | Patterns, anti-patterns, conventions |
| **Connaître l'état du projet** | [sprint-status.yaml](sprint-status.yaml) | Progression sprints & stories |
| **Travailler sur une feature** | [stories/STORY-*.md](stories/) | User stories détaillées |
| **Comprendre le workflow** | [bmm-workflow-status.yaml](bmm-workflow-status.yaml) | Statut BMAD Method |

---

## 📋 Documentation Active

### Fichiers Principaux

#### [CHANGELOG.md](CHANGELOG.md)
**Historique complet des modifications**
- Modifications par date (2026-02-25, 2026-02-23, 2026-02-22)
- Features majeures (Calendar, UX/UI, i18n)
- Bugs corrigés avec commits
- Métriques de progression
- Liens vers archives

**Quand l'utiliser :** Pour retrouver quand et comment une feature a été implémentée

---

#### [LEARNINGS.md](LEARNINGS.md)
**Guide des best practices**
- Patterns UX/UI (ESPN, BBC, FlashScore)
- Bugs courants & solutions (TypeError, Pagination)
- i18n best practices
- Performance tips (N+1 queries, pagination)
- Composants réutilisables
- SEO & Accessibilité
- Testing checklist

**Quand l'utiliser :** Avant de coder pour éviter les erreurs courantes et respecter les patterns

---

#### [sprint-status.yaml](sprint-status.yaml)
**État d'avancement des sprints**

**Contenu :**
```yaml
Sprint 1 (19 pts): in-progress
  - STORY-001: completed (3 pts) ✅
  - STORY-004: in-progress 25% (5 pts) 🔄
  - STORY-005: in-progress 40% (3 pts) 🔄

Sprint 2 (21 pts): in-progress
  - STORY-006: in-progress 50% (5 pts) 🔄

Sprint 3 (19 pts): not-started
```

**Métriques :**
- Stories complétées: 1/14
- Stories en cours: 3/14
- Progression globale: 5%

**Quand l'utiliser :** Pour savoir quelle story attaquer ensuite

---

#### [bmm-workflow-status.yaml](bmm-workflow-status.yaml)
**Statut workflow BMAD Method**

**Phases :**
1. **Analysis** : Product Brief ✅
2. **Planning** : Tech Spec ✅
3. **Solutioning** : Architecture (optional)
4. **Execution** : Sprint Planning → Dev Stories 🔄

**Quand l'utiliser :** Pour comprendre où on en est dans le workflow global

---

### User Stories

#### [stories/STORY-001.md](stories/STORY-001.md)
**Setup Laravel + TailwindCSS + Architecture de base + i18n**
- Status: ✅ **Completed**
- Points: 3
- Sprint: 1

---

#### [stories/STORY-004.md](stories/STORY-004.md)
**Pages Federation + Competition (Silos SEO)**
- Status: 🔄 **In Progress (25%)**
- Points: 5
- Sprint: 1
- **Travail accompli:**
  - ✅ Page Competitions UX/UI (score 9/10)
  - ✅ Composant competition-card.blade.php
- **Reste à faire:**
  - Pages show federation/competition/season
  - Breadcrumbs SEO
  - URLs traduisibles

**Documentation associée:**
- [archive/ux/CORRECTIONS_UX_FINALES.md](archive/ux/CORRECTIONS_UX_FINALES.md)
- [archive/ux/UX_ANALYSIS.md](archive/ux/UX_ANALYSIS.md)

---

#### [stories/STORY-005.md](stories/STORY-005.md)
**Fiches Joueurs**
- Status: 🔄 **In Progress (40%)**
- Points: 3
- Sprint: 1
- **Travail accompli:**
  - ✅ Page Players index UX/UI (score 9/10)
  - ✅ Composant player-card.blade.php
  - ✅ Photos avec fallback initiales
  - ✅ Fixes bugs (TypeError, Pagination)
- **Reste à faire:**
  - Page show joueur avec tabs
  - Stats complètes, palmares
  - Schema.org Person

**Documentation associée:**
- [archive/ux/CORRECTIONS_UX_FINALES.md](archive/ux/CORRECTIONS_UX_FINALES.md)
- [archive/ux/BEFORE_AFTER_COMPARISON.md](archive/ux/BEFORE_AFTER_COMPARISON.md)

---

#### [stories/STORY-006.md](stories/STORY-006.md)
**Page Classement Filtrable + Page Calendrier**
- Status: 🔄 **In Progress (50%)**
- Points: 5
- Sprint: 2
- **Travail accompli:**
  - ✅ Page Calendar complète (visuel, filtres, SEO)
  - ✅ 54 traductions FR/EN
  - ✅ Alpine.js filtres dynamiques
- **Reste à faire:**
  - Page Classement filtrable
  - Tableau ranking complet

**Documentation associée:**
- [archive/calendar/CALENDAR_IMPROVEMENTS.md](archive/calendar/CALENDAR_IMPROVEMENTS.md)
- [archive/calendar/SUMMARY_IMPROVEMENTS.md](archive/calendar/SUMMARY_IMPROVEMENTS.md)

---

#### [stories/STORY-002.md](stories/STORY-002.md) à [STORY-014.md](stories/STORY-014.md)
**Stories restantes**
- Status: ⏸️ **Not Started**
- Voir [sprint-status.yaml](sprint-status.yaml) pour détails

---

## 📂 Archives Documentation

Documentation détaillée organisée par thème dans `archive/`

### [archive/ux/](archive/ux/) - UX/UI (10 fichiers)

| Fichier | Lignes | Description |
|---------|--------|-------------|
| [INDEX_DOCUMENTATION.md](archive/ux/INDEX_DOCUMENTATION.md) | 355 | Navigation UX docs |
| [MISSION_ACCOMPLIE.md](archive/ux/MISSION_ACCOMPLIE.md) | 376 | Synthèse corrections UX |
| [CORRECTIONS_UX_FINALES.md](archive/ux/CORRECTIONS_UX_FINALES.md) | 425 | Détails techniques corrections |
| [UX_ANALYSIS.md](archive/ux/UX_ANALYSIS.md) | 427 | Analyse violations UX |
| [VALIDATION_UX.md](archive/ux/VALIDATION_UX.md) | 365 | Guide validation |
| [SCREENSHOTS_GUIDE.md](archive/ux/SCREENSHOTS_GUIDE.md) | 355 | Guide captures avant/après |
| [README_UX.md](archive/ux/README_UX.md) | 190 | Corrections homepage |
| [README_CORRECTIONS_UX.md](archive/ux/README_CORRECTIONS_UX.md) | 336 | Récap corrections |
| [REFONTE_UX_COMPLETE.md](archive/ux/REFONTE_UX_COMPLETE.md) | 505 | Refonte complète |
| [BEFORE_AFTER_COMPARISON.md](archive/ux/BEFORE_AFTER_COMPARISON.md) | 488 | Comparaisons visuelles |

**Total :** 3,822 lignes

**Quand consulter :**
- Comprendre les corrections UX appliquées
- Voir les patterns ESPN/BBC/FlashScore utilisés
- Valider les changements visuels
- Éviter les régressions UX

---

### [archive/calendar/](archive/calendar/) - Calendrier (4 fichiers)

| Fichier | Lignes | Description |
|---------|--------|-------------|
| [CALENDAR_IMPROVEMENTS.md](archive/calendar/CALENDAR_IMPROVEMENTS.md) | 160 | Détails techniques calendar |
| [VISUAL_TESTING_GUIDE.md](archive/calendar/VISUAL_TESTING_GUIDE.md) | 261 | Guide tests visuels |
| [README_CALENDAR_REFONTE.md](archive/calendar/README_CALENDAR_REFONTE.md) | 392 | Refonte complète |
| [SUMMARY_IMPROVEMENTS.md](archive/calendar/SUMMARY_IMPROVEMENTS.md) | 422 | Résumé améliorations |

**Total :** 1,235 lignes

**Quand consulter :**
- Comprendre l'implémentation du calendrier
- Voir les filtres Alpine.js
- Valider le SEO HTML table
- Tester la page Calendar

---

### [archive/setup/](archive/setup/) - Setup & Config (5 fichiers)

| Fichier | Lignes | Description |
|---------|--------|-------------|
| [POC_SETUP.md](archive/setup/POC_SETUP.md) | 130 | Instructions setup POC |
| [VERIFICATION_POC.md](archive/setup/VERIFICATION_POC.md) | 217 | Checklist vérification |
| [QUICK_START_TEST.md](archive/setup/QUICK_START_TEST.md) | 275 | Tests rapides |
| [SITE_NEWS_READY.md](archive/setup/SITE_NEWS_READY.md) | 227 | Site ready |
| [STRUCTURE.md](archive/setup/STRUCTURE.md) | 58 | Structure projet |

**Total :** 907 lignes

**Quand consulter :**
- Setup initial du projet
- Vérifier l'installation
- Comprendre la structure

---

### [archive/corrections/](archive/corrections/) - Corrections (2 fichiers)

| Fichier | Lignes | Description |
|---------|--------|-------------|
| [CORRECTIONS_APPLIQUEES.md](archive/corrections/CORRECTIONS_APPLIQUEES.md) | 367 | Historique corrections |
| [CORRECTIONS_FINALES.md](archive/corrections/CORRECTIONS_FINALES.md) | 235 | Corrections finales |

**Total :** 602 lignes

---

### [archive/analysis/](archive/analysis/) - Analyses (2 fichiers)

| Fichier | Lignes | Description |
|---------|--------|-------------|
| [ANALYSE_MULTI_AGENTS.md](archive/analysis/ANALYSE_MULTI_AGENTS.md) | 404 | Analyse multi-agents |
| [TECHNICAL_SPECS.md](archive/analysis/TECHNICAL_SPECS.md) | 750 | Specs techniques complètes |

**Total :** 1,154 lignes

---

### [archive/testing/](archive/testing/) - Tests

- [test_site.py](archive/testing/test_site.py) - Script Python de test

---

## 📊 Statistiques Documentation

### Volumétrie
- **Documentation active :** 4 fichiers principaux
- **User stories :** 14 fichiers
- **Archives :** 24 fichiers documentés
- **Total lignes :** ~7,900 lignes archivées

### Par Thème
| Thème | Fichiers | Lignes |
|-------|----------|--------|
| UX/UI | 10 | 3,822 |
| Calendar | 4 | 1,235 |
| Analysis | 2 | 1,154 |
| Setup | 5 | 907 |
| Corrections | 2 | 602 |
| Testing | 1 | - |
| **Total** | **24** | **~7,720** |

---

## 🔍 Recherche Rapide

### Par Mot-Clé

**UX/UI :**
- Patterns → [LEARNINGS.md](LEARNINGS.md#ux-ui-best-practices)
- Corrections → [archive/ux/CORRECTIONS_UX_FINALES.md](archive/ux/CORRECTIONS_UX_FINALES.md)
- Validation → [archive/ux/VALIDATION_UX.md](archive/ux/VALIDATION_UX.md)

**Bugs :**
- TypeError → [LEARNINGS.md](LEARNINGS.md#bugs-courants--solutions)
- Pagination → [LEARNINGS.md](LEARNINGS.md#badmethodcallexception-pagination)

**Features :**
- Calendar → [archive/calendar/](archive/calendar/)
- Players → [stories/STORY-005.md](stories/STORY-005.md)
- Competitions → [stories/STORY-004.md](stories/STORY-004.md)

**Setup :**
- Installation → [archive/setup/POC_SETUP.md](archive/setup/POC_SETUP.md)
- Vérification → [archive/setup/VERIFICATION_POC.md](archive/setup/VERIFICATION_POC.md)

---

## 🚀 Workflows Recommandés

### Workflow 1 : Nouveau Développeur
**Objectif :** Comprendre le projet rapidement
```
1. README.md (5 min) - Vue d'ensemble
2. docs/sprint-status.yaml (3 min) - État actuel
3. docs/LEARNINGS.md (15 min) - Best practices
4. archive/setup/POC_SETUP.md (10 min) - Setup
Total: 33 minutes
```

---

### Workflow 2 : Développer une Feature
**Objectif :** Implémenter une story proprement
```
1. docs/sprint-status.yaml (2 min) - Choisir story
2. docs/stories/STORY-XXX.md (5 min) - Lire requirements
3. docs/LEARNINGS.md (10 min) - Patterns à suivre
4. Développement (variable)
5. docs/LEARNINGS.md#testing (5 min) - Checklist tests
6. Mise à jour story + CHANGELOG (5 min)
```

---

### Workflow 3 : Débugger un Problème
**Objectif :** Résoudre un bug efficacement
```
1. docs/LEARNINGS.md#bugs-courants (5 min) - Chercher solution
2. docs/CHANGELOG.md (3 min) - Vérifier si déjà rencontré
3. archive/ux/ ou archive/corrections/ (10 min) - Contexte
4. Fix + documentation (variable)
```

---

### Workflow 4 : Review Historique
**Objectif :** Comprendre l'évolution du projet
```
1. docs/CHANGELOG.md (10 min) - Chronologie
2. docs/sprint-status.yaml (3 min) - Progression
3. archive/ par thème (20 min) - Détails
Total: 33 minutes
```

---

## 🎯 Best Practices Documentation

### Avant de Créer un Nouveau Doc

**Vérifier si existe déjà :**
1. Chercher dans [CHANGELOG.md](CHANGELOG.md)
2. Explorer [archive/](archive/) par thème
3. Lire [LEARNINGS.md](LEARNINGS.md)

**Si nouveau doc nécessaire :**
1. Ajouter entrée dans [CHANGELOG.md](CHANGELOG.md)
2. Lier depuis story concernée
3. Archiver si doc de session (archive/)
4. Mettre à jour cet INDEX.md

---

### Maintenir la Documentation

**Quand modifier :**
- ✅ **CHANGELOG.md** : À chaque feature/bug/refactor
- ✅ **LEARNINGS.md** : Nouveau pattern ou erreur courante découverte
- ✅ **sprint-status.yaml** : Changement status story
- ✅ **stories/STORY-XXX.md** : Progression ou completion

**Quand archiver :**
- Documentation de session terminée
- Fichiers temporaires devenus obsolètes
- Docs remplacés par versions consolidées

---

## 📞 Support

### Je ne trouve pas une information

1. **Chercher dans CHANGELOG.md** par date ou mot-clé
2. **Explorer archive/** par thème pertinent
3. **Lire LEARNINGS.md** pour patterns/conventions
4. **Vérifier stories/** pour context feature

### Contribuer à la Documentation

1. Lire [LEARNINGS.md](LEARNINGS.md) pour les conventions
2. Mettre à jour [CHANGELOG.md](CHANGELOG.md) avec changements
3. Archiver docs de session dans `archive/`
4. Mettre à jour cet INDEX.md si structure change

---

**Dernière mise à jour :** 2026-02-26
**Maintenu par :** BMAD Method v6
**Projet :** DartsArena - Site Fléchettes Professionnel
