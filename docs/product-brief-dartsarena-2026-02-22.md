# Product Brief: DartsArena

**Date:** 2026-02-22
**Auteur:** Axel
**Version:** 1.0
**Type de projet:** web-app
**Niveau projet:** 1

---

## Resume Executif

DartsArena est un site web multilingue (FR/EN) dedie aux flechettes, concu pour remplacer un site WordPress existant. L'objectif est de creer un hub centralise, automatise et optimise SEO, organise en silos par federation et competition (PDC, WDF, ProTour, World Matchplay, Premier League, etc.). Le site propose des classements, calendriers, pages de match avec statistiques et scores live, fiches joueurs, guides et betting tips.

---

## Enonce du Probleme

### Le Probleme

Les fans de flechettes francophones et anglophones n'ont pas de site unique offrant toutes les informations essentielles : resultats, calendrier, classements, regles, billetterie. L'information est dispersee sur plusieurs sites (pdc.tv, mastercaller.com) principalement anglophones et peu optimises pour le SEO.

### Pourquoi Maintenant ?

- Le marche francophone des flechettes est en pleine croissance (Luke Littler effect)
- Les sites existants sont vieillissants ou peu adaptes au mobile
- L'ancien site WordPress necessite une refonte complete pour scaler
- L'automatisation des donnees (scraping) permet de maintenir un site a jour sans effort editorial massif

### Impact si Non Resolu

Les fans continuent de naviguer entre 5-6 sites pour obtenir l'information complete, l'audience francophone reste mal desservie, et le site WordPress existant perd en competitivite SEO.

---

## Public Cible

### Utilisateurs Principaux

- **Fans de flechettes** (18-55 ans) cherchant resultats, classements et calendrier
- **Parieurs sportifs** cherchant des stats et tips pour leurs paris
- **Nouveaux fans** decouvrant le sport et cherchant des guides/regles

### Utilisateurs Secondaires

- **Joueurs amateurs** cherchant des informations sur le materiel et les techniques
- **Journalistes sportifs** cherchant des donnees et statistiques

### Besoins Utilisateurs

1. Suivre les competitions en temps reel (scores, resultats)
2. Consulter les classements et statistiques des joueurs
3. Connaitre les dates et lieux des evenements (+ billetterie)
4. Comprendre les regles et le format des competitions
5. Obtenir des pronostics et analyses pour les paris

---

## Apercu de la Solution

### Solution Proposee

Un site web Laravel optimise SEO, organise en silos semantiques par federation et competition, avec scraping automatise des donnees depuis des sources publiques (mastercaller.com, sites officiels PDC/WDF). Le contenu existant WordPress (news et guides) est migre et enrichi.

### Features Cles

1. **Silos SEO par federation/competition** : Pages federations, competitions, classements, calendrier, fiches joueurs — architecture URL semantique, Schema.org, sitemaps dynamiques
2. **Pages de match** : Resultats, statistiques detaillees, scores (live quand possible), head-to-head, betting tips par match
3. **Contenu editorial automatise** : Migration des articles WordPress, guides enrichis, betting tips, homepage dashboard avec matchs du jour

### Proposition de Valeur

Le seul site multilingue FR/EN qui centralise TOUTE l'information darts (resultats, stats, calendrier, guides, paris) dans une experience moderne et optimisee SEO.

---

## Objectifs Business

### Objectifs

- Depasser le trafic organique de l'ancien site WordPress en 6 mois
- Atteindre 500+ pages indexees dans Google en 3 mois
- Devenir la reference francophone pour l'information darts

### Metriques de Succes

- Pages indexees > 500 en 3 mois
- Trafic organique > ancien site en 6 mois
- Taux de rebond < 60%
- Temps de chargement < 2 secondes
- Position moyenne Google < 20 sur les mots-cles cibles

### Valeur Business

- Monetisation via publicite (display ads)
- Revenus affiliation paris sportifs (betting tips)
- Autorite de domaine croissante grace au contenu automatise

---

## Perimetre

### Dans le Perimetre

- Architecture silos SEO (federations, competitions, saisons)
- Fiches joueurs avec stats et palmares
- Pages de match (resultats, stats, scores)
- Classements filtrables par federation
- Calendrier des evenements
- Migration contenu WordPress (articles + guides)
- Systeme de scraping automatise
- Multilingue FR/EN
- Betting tips par match/competition
- Homepage dashboard
- SEO complet (Schema.org, sitemaps, meta tags, hreflang)

### Hors Perimetre

- Systeme d'authentification/comptes utilisateurs
- Commentaires ou forum communautaire
- Application mobile native
- Streaming video live
- E-commerce/boutique
- Systeme de notification push

### Considerations Futures

- API publique pour les donnees
- Application mobile (PWA)
- Predictions ML pour les paris
- Systeme d'abonnement premium
- Integration reseaux sociaux automatisee

---

## Parties Prenantes

- **Axel** : Product Owner, developpeur principal
- **Utilisateurs** : Fans de flechettes FR et EN

---

## Contraintes et Hypotheses

### Contraintes

- **Pas d'API officielle** : Les donnees doivent etre scrapees depuis des sources publiques
- **Multilingue obligatoire** : FR et EN des le lancement
- **Migration WordPress** : Les articles et guides existants doivent etre migres
- **Maximum d'automatisation** : Le contenu doit se mettre a jour automatiquement
- **Budget limite** : Projet personnel, infrastructure economique

### Hypotheses

- Les sources de scraping (mastercaller.com, PDC) resteront accessibles
- Le volume de donnees est gerable avec SQLite en dev et PostgreSQL en prod
- Les donnees scrapees sont suffisamment completes pour alimenter les fiches joueurs et stats
- Le framework Laravel avec Blade est suffisant (pas besoin de SPA)

---

## Criteres de Succes

- [ ] Au moins 3 silos de competitions (PDC, Premier League, World Championship)
- [ ] Fiches pour le top 50 joueurs
- [ ] Calendrier des competitions a jour
- [ ] Articles WordPress migres et accessibles
- [ ] Scores et resultats des matchs disponibles
- [ ] Site indexable et performant (< 2s de chargement)
- [ ] Multilingue FR/EN fonctionnel
- [ ] Scraping automatise operationnel

---

## Timeline et Jalons

### Lancement Cible

MVP fonctionnel en 3 sprints (environ 3-4 semaines)

### Jalons Cles

1. **Sprint 1** : Fondations (architecture, modeles, seeders, silos, joueurs)
2. **Sprint 2** : Core (matchs, classements, calendrier, scraping)
3. **Sprint 3** : Contenu (migration WP, news, guides, betting, SEO, homepage)

---

## Risques et Mitigation

| Risque | Impact | Probabilite | Mitigation |
|--------|--------|-------------|------------|
| Sites sources changent leur structure | Haut | Moyen | Scraping modulaire, monitoring des changements, sources multiples |
| Volume de donnees trop important pour SQLite | Moyen | Faible | Migration PostgreSQL prevue pour la prod |
| Contenu WordPress incompatible | Faible | Faible | Script de migration avec nettoyage HTML |
| Blocage scraping (rate limiting, CAPTCHA) | Haut | Moyen | Rotation user-agents, cache agressif, intervalles respectueux |
| Performance SEO insuffisante | Moyen | Faible | Audit SEO regulier, Schema.org, Core Web Vitals |

---

## Prochaines Etapes

1. Specification Technique - `/bmad:tech-spec`
2. Sprint Planning - `/bmad:sprint-planning`
3. Developpement Story 1 - `/bmad:dev-story STORY-001`

---

**Ce document a ete cree avec la methode BMAD v6 - Phase 1 (Analyse)**
