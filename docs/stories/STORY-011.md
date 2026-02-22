# STORY-011: Pages News + Guides avec Templates

## User Story
En tant qu'utilisateur, je veux lire les actualites et les guides sur les flechettes afin de me tenir informe et d'apprendre les regles et techniques.

## Story Points: 3

## Acceptance Criteria
- [ ] Page index actualites (/fr/actualites) avec liste paginee d'articles
- [ ] Chaque article affiche : image, titre, extrait, date, categorie
- [ ] Page show article (/fr/actualites/{slug}) avec contenu complet
- [ ] Layout article : image featured, titre, date, auteur, contenu, tags
- [ ] Page index guides (/fr/guides) avec liste ordonnee par categorie
- [ ] Page show guide (/fr/guides/{slug}) avec contenu complet
- [ ] Navigation entre guides (precedent/suivant)
- [ ] Sidebar avec articles/guides recents ou lies
- [ ] Meta tags SEO (Article Schema.org pour les news)
- [ ] Partage social (meta og:image, og:title, og:description)
- [ ] Pages responsives

## Technical Notes
- Models: Article, Guide, Tag
- Routes: articles.index, articles.show, guides.index, guides.show
- Components: article-card.blade.php, guide-card.blade.php, sidebar.blade.php
- SEO: Schema.org Article, title "{article_title} | DartsArena"

## Sprint: 3
## Priority: Must
## Status: pending
