# Specification Technique: DartsArena

**Date:** 2026-02-22
**Auteur:** Axel
**Version:** 1.0
**Type de projet:** web-app
**Niveau projet:** 1
**Statut:** Draft

---

## Vue d'Ensemble

Cette specification technique fournit le cadre technique pour DartsArena, un site web multilingue de news et donnees sur les flechettes, automatise et optimise SEO.

**Documents associes :**
- Product Brief: `docs/product-brief-dartsarena-2026-02-22.md`

---

## Probleme & Solution

### Enonce du Probleme

Les fans de flechettes n'ont pas de hub unique multilingue centralisant resultats, classements, calendrier, guides et betting tips. L'information est fragmentee sur plusieurs sites anglophones.

### Solution Proposee

Site Laravel SEO-first organise en silos semantiques par federation/competition, avec scraping automatise des donnees, migration du contenu WordPress existant, et interface moderne TailwindCSS.

---

## Exigences

### Ce Qui Doit Etre Construit

1. **Architecture silos SEO**
   - Pages federation (PDC, WDF) comme hubs parents
   - Pages competition (World Championship, Premier League, ProTour...) comme enfants
   - URLs semantiques : `/fr/pdc/world-championship-2025/`
   - Breadcrumbs automatiques
   - Schema.org (SportsEvent, Person, SportsOrganization)
   - Sitemaps dynamiques par silo

2. **Systeme de donnees**
   - Modeles Laravel pour federations, competitions, saisons, matchs, joueurs
   - Scraping automatise (jobs Laravel schedulés)
   - Import/seeding des donnees initiales
   - Cache des donnees scrapees

3. **Pages de contenu dynamique**
   - Fiches joueurs (bio, stats, palmares, matchs recents)
   - Pages de match (score, stats detaillees, H2H)
   - Classements filtrables
   - Calendrier des evenements
   - Matchs du jour (dashboard live)

4. **Contenu editorial**
   - Migration articles WordPress
   - Pages guides
   - Betting tips par match/competition
   - Homepage dashboard

5. **Multilingue**
   - FR/EN avec routes prefixees `/fr/`, `/en/`
   - Champs traduisibles (spatie/laravel-translatable)
   - Hreflang automatiques

### Ce Que Cela N'Inclut PAS

- Authentification utilisateur / comptes
- Commentaires ou forum
- Application mobile native
- Streaming video
- E-commerce
- Notifications push

---

## Approche Technique

### Stack Technologique

| Composant | Technologie | Justification |
|-----------|-------------|---------------|
| Backend | Laravel 11 | Framework PHP robuste, Eloquent ORM, queues, scheduling |
| Frontend | TailwindCSS v4 + Blade | Utility-first CSS, templates server-side rapides |
| Base de donnees | SQLite (dev) / PostgreSQL (prod) | Leger en dev, performant en prod |
| Scraping | Guzzle + Symfony DomCrawler | Standard PHP, fiable, bien documente |
| Multilingue | spatie/laravel-translatable + mcamara/laravel-localization | Packages matures, bien maintenus |
| SEO | artesaos/seotools + spatie/laravel-sitemap | Meta tags, Schema.org, sitemaps |
| Dev server | Laravel Herd | Zero config PHP dev environment |
| Production | Railway ou VPS | Serveur persistent pour queues et cron |

### Apercu de l'Architecture

```
Utilisateur → Laravel Router (i18n prefix)
                ↓
            Controller → Service Layer
                ↓              ↓
            Blade Views    Scraping Jobs (Queue)
                ↓              ↓
          TailwindCSS      Data Sources
                           (mastercaller.com, PDC...)
                               ↓
                          Eloquent Models
                               ↓
                          SQLite/PostgreSQL
```

**Structure du projet :**

```
app/
├── Console/Commands/
│   ├── ImportWordPress.php
│   ├── ScrapeDaily.php
│   └── UpdateRankings.php
├── Http/Controllers/
│   ├── HomeController.php
│   ├── FederationController.php
│   ├── CompetitionController.php
│   ├── MatchController.php
│   ├── PlayerController.php
│   ├── RankingController.php
│   ├── CalendarController.php
│   ├── ArticleController.php
│   ├── GuideController.php
│   └── BettingTipController.php
├── Models/
│   ├── Federation.php
│   ├── Competition.php
│   ├── Season.php
│   ├── Match.php
│   ├── Player.php
│   ├── PlayerRanking.php
│   ├── MatchStat.php
│   ├── Standing.php
│   ├── CalendarEvent.php
│   ├── Article.php
│   ├── Guide.php
│   ├── BettingTip.php
│   └── Tag.php
├── Services/
│   ├── Scraping/
│   │   ├── ScraperInterface.php
│   │   ├── MasterCallerScraper.php
│   │   └── PdcScraper.php
│   └── Seo/
│       ├── MetaTagGenerator.php
│       ├── SchemaGenerator.php
│       └── BreadcrumbGenerator.php
└── Jobs/
    ├── ScrapeMatchResults.php
    ├── ScrapeCalendar.php
    ├── ScrapeRankings.php
    └── ScrapePlayerStats.php

resources/views/
├── layouts/
│   ├── app.blade.php
│   └── partials/
│       ├── header.blade.php
│       ├── footer.blade.php
│       ├── seo-head.blade.php
│       └── breadcrumbs.blade.php
├── home.blade.php
├── federations/
│   ├── index.blade.php
│   └── show.blade.php
├── competitions/
│   ├── index.blade.php
│   └── show.blade.php
├── matches/
│   ├── show.blade.php
│   └── today.blade.php
├── players/
│   ├── index.blade.php
│   └── show.blade.php
├── rankings/
│   └── index.blade.php
├── calendar/
│   └── index.blade.php
├── articles/
│   ├── index.blade.php
│   └── show.blade.php
├── guides/
│   ├── index.blade.php
│   └── show.blade.php
├── betting/
│   ├── index.blade.php
│   └── show.blade.php
└── components/
    ├── match-card.blade.php
    ├── player-card.blade.php
    ├── stat-table.blade.php
    ├── ranking-table.blade.php
    ├── calendar-event.blade.php
    ├── breadcrumb.blade.php
    ├── lang-switcher.blade.php
    └── seo-schema.blade.php
```

### Modele de Donnees

```
┌──────────────┐      ┌──────────────────┐      ┌──────────────┐
│ federations  │      │  competitions     │      │   seasons    │
├──────────────┤      ├──────────────────┤      ├──────────────┤
│ id           │──┐   │ id               │──┐   │ id           │
│ name (json)  │  └──>│ federation_id    │  └──>│ competition_id│
│ slug         │      │ name (json)      │      │ year         │
│ description  │      │ slug             │      │ start_date   │
│ logo_url     │      │ description (json)│      │ end_date     │
│ website_url  │      │ format           │      │ status       │
│ created_at   │      │ prize_money      │      │ venue        │
│ updated_at   │      │ created_at       │      │ location     │
└──────────────┘      │ updated_at       │      │ created_at   │
                      └──────────────────┘      │ updated_at   │
                                                └──────┬───────┘
                                                       │
          ┌────────────────────────────────────────────┘
          │
          ▼
┌──────────────────┐      ┌──────────────────┐
│    matches       │      │    players       │
├──────────────────┤      ├──────────────────┤
│ id               │      │ id               │
│ season_id        │      │ first_name       │
│ round            │      │ last_name        │
│ scheduled_at     │      │ nickname (json)  │
│ status           │      │ slug             │
│ venue            │      │ nationality      │
│ best_of_legs     │      │ date_of_birth    │
│ created_at       │      │ photo_url        │
│ updated_at       │      │ bio (json)       │
└────────┬─────────┘      │ career_titles    │
         │                │ career_9darters  │
         │                │ created_at       │
         ▼                │ updated_at       │
┌──────────────────┐      └────────┬─────────┘
│  match_player    │               │
│  (pivot)         │               │
├──────────────────┤               │
│ match_id     ────┤               │
│ player_id    ────┼───────────────┘
│ position (home/  │
│   away)          │
│ score_sets       │
│ score_legs       │
│ average          │
│ checkout_pct     │
│ 180s             │
│ highest_checkout │
│ is_winner        │
└──────────────────┘

┌──────────────────┐      ┌──────────────────┐
│ player_rankings  │      │ calendar_events  │
├──────────────────┤      ├──────────────────┤
│ id               │      │ id               │
│ player_id        │      │ competition_id   │
│ federation_id    │      │ season_id        │
│ ranking_type     │      │ title (json)     │
│ position         │      │ start_date       │
│ prize_money      │      │ end_date         │
│ recorded_at      │      │ venue            │
│ created_at       │      │ location         │
│ updated_at       │      │ ticket_url       │
└──────────────────┘      │ tv_channel       │
                          │ created_at       │
┌──────────────────┐      │ updated_at       │
│  betting_tips    │      └──────────────────┘
├──────────────────┤
│ id               │      ┌──────────────────┐
│ match_id         │      │   articles       │
│ title (json)     │      ├──────────────────┤
│ prediction       │      │ id               │
│ odds_player1     │      │ title (json)     │
│ odds_player2     │      │ slug             │
│ analysis (json)  │      │ content (json)   │
│ confidence       │      │ excerpt (json)   │
│ bookmaker        │      │ featured_image   │
│ is_published     │      │ published_at     │
│ created_at       │      │ wp_original_id   │
│ updated_at       │      │ category         │
└──────────────────┘      │ created_at       │
                          │ updated_at       │
┌──────────────────┐      └──────────────────┘
│    guides        │
├──────────────────┤      ┌──────────────────┐
│ id               │      │     tags         │
│ title (json)     │      ├──────────────────┤
│ slug             │      │ id               │
│ content (json)   │      │ name (json)      │
│ excerpt (json)   │      │ slug             │
│ featured_image   │      │ type             │
│ category         │      │ created_at       │
│ order            │      │ updated_at       │
│ created_at       │      └──────────────────┘
│ updated_at       │
└──────────────────┘      ┌──────────────────┐
                          │   taggables      │
                          │   (polymorphic)  │
                          ├──────────────────┤
                          │ tag_id           │
                          │ taggable_id      │
                          │ taggable_type    │
                          └──────────────────┘
```

**Note :** Les champs `(json)` utilisent `spatie/laravel-translatable` pour stocker les traductions FR/EN.

### Routes

```php
// Routes avec prefix i18n /{locale}/
Route::prefix('{locale}')->middleware('locale')->group(function () {

    // Homepage
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Federations (silo parent)
    Route::get('/federations', [FederationController::class, 'index'])->name('federations.index');
    Route::get('/{federation:slug}', [FederationController::class, 'show'])->name('federations.show');

    // Competitions (silo enfant)
    Route::get('/{federation:slug}/{competition:slug}', [CompetitionController::class, 'show'])->name('competitions.show');
    Route::get('/{federation:slug}/{competition:slug}/{season:year}', [CompetitionController::class, 'season'])->name('competitions.season');

    // Matchs
    Route::get('/matchs-du-jour', [MatchController::class, 'today'])->name('matches.today');
    Route::get('/{federation:slug}/{competition:slug}/{season:year}/{match:slug}', [MatchController::class, 'show'])->name('matches.show');

    // Joueurs
    Route::get('/joueurs', [PlayerController::class, 'index'])->name('players.index');
    Route::get('/joueurs/{player:slug}', [PlayerController::class, 'show'])->name('players.show');

    // Classements
    Route::get('/classements', [RankingController::class, 'index'])->name('rankings.index');
    Route::get('/classements/{federation:slug}', [RankingController::class, 'show'])->name('rankings.show');

    // Calendrier
    Route::get('/calendrier', [CalendarController::class, 'index'])->name('calendar.index');

    // Articles (news)
    Route::get('/actualites', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/actualites/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');

    // Guides
    Route::get('/guides', [GuideController::class, 'index'])->name('guides.index');
    Route::get('/guides/{guide:slug}', [GuideController::class, 'show'])->name('guides.show');

    // Betting Tips
    Route::get('/pronostics', [BettingTipController::class, 'index'])->name('betting.index');
    Route::get('/pronostics/{match:slug}', [BettingTipController::class, 'show'])->name('betting.show');

});

// Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index']);
Route::get('/sitemap-{type}.xml', [SitemapController::class, 'show']);
```

---

## Plan d'Implementation

### Stories

| # | Story | Points | Sprint |
|---|-------|--------|--------|
| STORY-001 | Setup Laravel + TailwindCSS + architecture de base + i18n | 3 | 1 |
| STORY-002 | Modeles & migrations (Federation, Competition, Season, Player, Match) | 5 | 1 |
| STORY-003 | Seeders avec donnees initiales (PDC, top competitions, top 50 joueurs) | 3 | 1 |
| STORY-004 | Pages federation + competition (silos SEO) avec breadcrumbs | 5 | 1 |
| STORY-005 | Fiches joueurs (bio, stats, palmares) | 3 | 1 |
| STORY-006 | Page classement filtrable + page calendrier | 5 | 2 |
| STORY-007 | Pages de match (resultats, stats, score) | 5 | 2 |
| STORY-008 | Page matchs du jour (liste live) | 3 | 2 |
| STORY-009 | Service de scraping (MasterCaller) + jobs schedules | 8 | 2 |
| STORY-010 | Migration WordPress (articles + guides) | 5 | 3 |
| STORY-011 | Pages news + guides avec templates | 3 | 3 |
| STORY-012 | Betting tips par match/competition | 3 | 3 |
| STORY-013 | SEO complet (sitemap, schema.org, meta tags, hreflang) | 5 | 3 |
| STORY-014 | Homepage dashboard (matchs du jour, news, competitions en cours) | 3 | 3 |

### Phases de Developpement

**Sprint 1 — Fondations (19 pts)**
Objectif : Architecture fonctionnelle avec silos SEO, modeles de donnees, et premieres pages navigables.

**Sprint 2 — Core (21 pts)**
Objectif : Fonctionnalites coeur (matchs, classements, calendrier) et scraping operationnel.

**Sprint 3 — Contenu (19 pts)**
Objectif : Migration WordPress, contenu editorial, SEO complet, homepage finale.

---

## Criteres d'Acceptation

Comment on sait que c'est termine :

- [ ] Les 3 silos principaux (PDC, Premier League, World Championship) sont navigables
- [ ] Les fiches des top 50 joueurs sont completes
- [ ] Les resultats et stats de matchs sont affiches
- [ ] Le classement est filtrable par federation
- [ ] Le calendrier affiche les evenements a venir
- [ ] Les articles WordPress sont migres et accessibles
- [ ] Le site est navigable en FR et EN
- [ ] Le scraping automatise fonctionne (cron jobs)
- [ ] Les sitemaps sont generes dynamiquement
- [ ] Schema.org est present sur toutes les pages
- [ ] Le temps de chargement est < 2 secondes
- [ ] Le site est responsive (mobile + desktop)

---

## Exigences Non-Fonctionnelles

### Performance

- Temps de chargement < 2 secondes (Core Web Vitals)
- Cache agressif des pages generees (page cache Laravel)
- Images optimisees (lazy loading, WebP)
- Requetes DB optimisees (eager loading, indexes)

### Securite

- Protection CSRF standard Laravel
- Rate limiting sur les routes publiques
- Validation stricte des entrees
- Headers de securite (CSP, HSTS)

### Autres

- **SEO** : Score Lighthouse > 90
- **Accessibilite** : Semantique HTML5, alt text, navigation clavier
- **Maintenabilite** : Code documente, conventions Laravel, tests unitaires sur les services critiques

---

## Dependances

### Packages Laravel

| Package | Version | Usage |
|---------|---------|-------|
| spatie/laravel-translatable | ^6.0 | Champs multilingues |
| spatie/laravel-sluggable | ^3.0 | Generation automatique de slugs |
| spatie/laravel-sitemap | ^7.0 | Sitemaps XML dynamiques |
| spatie/laravel-medialibrary | ^11.0 | Gestion images joueurs |
| mcamara/laravel-localization | ^2.0 | Routes i18n prefixees |
| artesaos/seotools | ^1.0 | Meta tags et Schema.org |
| guzzlehttp/guzzle | ^7.0 | HTTP client pour scraping |
| symfony/dom-crawler | ^7.0 | Parsing HTML pour scraping |

### Sources de Donnees (Scraping)

| Source | Donnees | Frequence |
|--------|---------|-----------|
| mastercaller.com | Resultats, stats matchs, calendrier | Quotidien |
| pdc.tv | Classements, infos joueurs, calendrier PDC | Hebdomadaire |
| dartsdatabase.co.uk | Historique joueurs, palmares | Mensuel |

---

## Risques & Mitigation

| Risque | Severite | Mitigation |
|--------|----------|------------|
| Structure HTML des sources change | Haute | Scraping modulaire (1 class par source), monitoring, alerts |
| Rate limiting / blocage scraping | Haute | Rotation user-agents, delais entre requetes, cache agressif |
| Volume de donnees | Moyenne | Indexes DB, pagination, lazy loading |
| Performance avec SQLite en prod | Moyenne | Migration PostgreSQL prevue, benchmark avant mise en prod |
| Contenu WordPress mal formate | Faible | Script de nettoyage HTML, revue manuelle des 10 premiers |

---

## Timeline

**Objectif :** MVP fonctionnel en 3 sprints (~3-4 semaines)

**Jalons :**
1. **Semaine 1** : Sprint 1 complete — architecture, modeles, silos navigables
2. **Semaine 2** : Sprint 2 complete — matchs, classements, scraping operationnel
3. **Semaine 3-4** : Sprint 3 complete — contenu migre, SEO, homepage, polish

---

## Approbation

**Revue par :**
- [ ] Axel (Auteur)

---

## Prochaines Etapes

Pour un projet Niveau 1 (14 stories) :
- Executer `/bmad:sprint-planning` pour planifier le sprint
- Puis creer et implementer les stories avec `/bmad:dev-story`

---

**Ce document a ete cree avec la methode BMAD v6 - Phase 2 (Planning)**
