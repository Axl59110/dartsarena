# STORY-013: SEO Complet (Sitemap, Schema.org, Meta Tags, Hreflang)

## User Story
En tant que proprietaire du site, je veux que toutes les pages soient optimisees pour le referencement afin de maximiser le trafic organique depuis Google.

## Story Points: 5

## Acceptance Criteria
- [ ] Sitemap XML dynamique (/sitemap.xml) listant toutes les pages
- [ ] Sitemaps segmentes par type : sitemap-federations.xml, sitemap-players.xml, sitemap-matches.xml, sitemap-articles.xml
- [ ] Schema.org SportsOrganization sur les pages federation
- [ ] Schema.org SportsEvent sur les pages match
- [ ] Schema.org Person sur les fiches joueurs
- [ ] Schema.org Article sur les pages news
- [ ] Schema.org BreadcrumbList sur toutes les pages
- [ ] Balises hreflang sur toutes les pages (x-default, fr, en)
- [ ] Meta title et meta description uniques et optimises par page
- [ ] Open Graph tags (og:title, og:description, og:image, og:type)
- [ ] Twitter Card tags
- [ ] Canonical URLs correctes
- [ ] Robots.txt optimise
- [ ] Service MetaTagGenerator pour generer automatiquement les meta tags
- [ ] Service SchemaGenerator pour generer le JSON-LD
- [ ] Composant seo-head.blade.php inclus dans le layout

## Technical Notes
- Models: Tous (lecture seule pour SEO)
- Routes: sitemap.xml, sitemap-{type}.xml, robots.txt
- Components: seo-head.blade.php, seo-schema.blade.php, breadcrumb.blade.php
- Services: Seo/MetaTagGenerator.php, Seo/SchemaGenerator.php
- Packages: artesaos/seotools, spatie/laravel-sitemap
- Templates meta title : "{page} | DartsArena - {tagline}"

## Sprint: 3
## Priority: Must
## Status: pending
