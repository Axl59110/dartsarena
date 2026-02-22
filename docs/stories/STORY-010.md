# STORY-010: Migration WordPress (Articles + Guides)

## User Story
En tant que proprietaire du site, je veux migrer mes articles et guides WordPress existants afin de conserver mon contenu et mon historique SEO.

## Story Points: 5

## Acceptance Criteria
- [ ] Commande artisan `php artisan wp:import` qui prend un export WordPress (XML ou JSON)
- [ ] Import des articles WordPress → modele Article
- [ ] Import des guides WordPress → modele Guide
- [ ] Nettoyage HTML du contenu WordPress (shortcodes, classes inutiles, liens internes)
- [ ] Conservation des images (telechargement et stockage local via medialibrary)
- [ ] Mapping des categories WordPress → tags DartsArena
- [ ] Conservation du champ wp_original_id pour tracabilite
- [ ] Gestion des dates de publication originales
- [ ] Contenu importe en langue originale (FR ou EN), champ traduction vide pour l'autre langue
- [ ] Rapport d'import : nombre d'articles/guides importes, erreurs eventuelles
- [ ] Redirections 301 des anciennes URLs WordPress (optionnel mais recommande)

## Technical Notes
- Models: Article, Guide, Tag
- Routes: Aucune (commande artisan)
- Components: Aucun
- Commands: Console/Commands/ImportWordPress.php
- Format d'entree : export WordPress WXR (XML) standard
- Attention: Tester avec un echantillon de 10 articles avant import complet

## Sprint: 3
## Priority: Must
## Status: pending
