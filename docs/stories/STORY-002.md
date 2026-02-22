# STORY-002: Modeles & Migrations

## User Story
En tant que developpeur, je veux creer les modeles Eloquent et les migrations pour les entites principales (Federation, Competition, Season, Player, Match) afin de structurer la base de donnees du projet.

## Story Points: 5

## Acceptance Criteria
- [ ] Migration et modele Federation (name json, slug, description, logo_url, website_url)
- [ ] Migration et modele Competition (federation_id, name json, slug, description json, format, prize_money)
- [ ] Migration et modele Season (competition_id, year, start_date, end_date, status, venue, location)
- [ ] Migration et modele Player (first_name, last_name, nickname json, slug, nationality, date_of_birth, photo_url, bio json, career_titles, career_9darters)
- [ ] Migration et modele Match (season_id, round, scheduled_at, status, venue, best_of_legs)
- [ ] Table pivot match_player (match_id, player_id, position, score_sets, score_legs, average, checkout_pct, 180s, highest_checkout, is_winner)
- [ ] Migration et modele PlayerRanking (player_id, federation_id, ranking_type, position, prize_money, recorded_at)
- [ ] Migration et modele CalendarEvent (competition_id, season_id, title json, start_date, end_date, venue, location, ticket_url, tv_channel)
- [ ] Migration et modele MatchStat (donnees stats additionnelles)
- [ ] Migration et modele BettingTip (match_id, title json, prediction, odds, analysis json, confidence, bookmaker, is_published)
- [ ] Migration et modele Article (title json, slug, content json, excerpt json, featured_image, published_at, wp_original_id, category)
- [ ] Migration et modele Guide (title json, slug, content json, excerpt json, featured_image, category, order)
- [ ] Migration et modele Tag + taggables (polymorphique)
- [ ] Toutes les relations Eloquent definies (hasMany, belongsTo, belongsToMany, morphMany)
- [ ] Indexes DB sur les colonnes de recherche (slug, federation_id, season_id, scheduled_at)
- [ ] Trait HasTranslations sur tous les modeles avec champs json

## Technical Notes
- Models: Federation, Competition, Season, Match, Player, PlayerRanking, CalendarEvent, MatchStat, BettingTip, Article, Guide, Tag
- Routes: Aucune route a ce stade
- Components: Aucun
- Attention: Utiliser le trait HasTranslations de spatie sur chaque modele ayant des champs (json)

## Sprint: 1
## Priority: Must
## Status: pending
