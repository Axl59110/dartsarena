# DartsArena - POC Setup Instructions

## Prérequis
- Laravel Herd installé et configuré
- PHP 8.2+
- Composer
- Node.js et npm

## Installation

### 1. Installer les dépendances PHP
```bash
composer install
```

### 2. Installer les dépendances Node
```bash
npm install
```

### 3. Configurer l'environnement
Le fichier `.env` est déjà configuré avec SQLite.

### 4. Générer la clé d'application (si nécessaire)
```bash
php artisan key:generate
```

### 5. Exécuter les migrations et seeders
```bash
php artisan migrate:fresh --seed
```

Cette commande va :
- Créer toutes les tables dans la base de données SQLite
- Peupler la base avec des données de test :
  - 3 fédérations (PDC, WDF, BDO)
  - 8 compétitions majeures
  - 5 joueurs vedettes (Luke Humphries, Luke Littler, MVG, etc.)
  - Classements PDC
  - Événements du calendrier

### 6. Compiler les assets (optionnel pour le POC)
```bash
npm run build
```

Ou en mode développement avec hot reload :
```bash
npm run dev
```

### 7. Démarrer le serveur avec Herd
Avec Laravel Herd, le site devrait être automatiquement accessible à :
- `http://site-darts.test`

Ou utiliser le serveur artisan :
```bash
php artisan serve
```

Le site sera accessible à `http://localhost:8000`

## Pages disponibles

### Pages fonctionnelles
- ✅ **Accueil** : `/` (FR) ou `/en/` (EN)
- ✅ **Fédérations** : `/fr/federations` ou `/en/federations`
- ✅ **Compétitions** : `/fr/competitions` ou `/en/competitions`
- ✅ **Joueurs** : `/fr/players` ou `/en/players`
- ✅ **Classements** : `/fr/rankings` ou `/en/rankings`
- ✅ **Calendrier** : `/fr/calendar` ou `/en/calendar`
- ✅ **Guides** : `/fr/guides` ou `/en/guides`

### Multilingue
Le site est entièrement multilingue (FR/EN). Utilisez le sélecteur de langue en haut à droite pour basculer entre les langues.

## Données de test

Le POC inclut :
- **3 fédérations** : PDC, WDF, BDO (legacy)
- **8 compétitions** : World Championship, Premier League, World Matchplay, Grand Slam, Players Championship Finals, World Cup, UK Open, Masters
- **7 saisons** : Saisons 2026 pour les principales compétitions
- **5 joueurs** :
  - Luke Humphries (Champion du Monde 2024)
  - Luke Littler (Prodige)
  - Michael van Gerwen (Légende)
  - Michael Smith (Champion 2023)
  - Peter Wright (Snakebite)
- **Classements PDC** : Top 5 avec prize money et évolution
- **2 événements** : World Championship 2026, Premier League 2026
- **4 guides** :
  - Les Règles des Fléchettes : Guide Complet pour Débutants
  - Comprendre les Formats PDC : Sets vs Legs
  - Statistiques des Fléchettes : Comprendre les Moyennes
  - Calendrier des Grandes Compétitions PDC

## Prochaines étapes

Pour continuer le développement selon BMAD Method :
1. Stories 6-9 (Sprint 2) : Matchs, scraping
2. Stories 10-14 (Sprint 3) : Contenu, SEO

## Troubleshooting

### Erreur "No application encryption key"
```bash
php artisan key:generate
```

### Erreur de base de données
Vérifier que le fichier `database/database.sqlite` existe. Si non :
```bash
touch database/database.sqlite
php artisan migrate:fresh --seed
```

### Les traductions ne fonctionnent pas
Vider le cache :
```bash
php artisan cache:clear
php artisan config:clear
```

## Stack technique
- **Backend** : Laravel 11
- **Frontend** : Blade Templates + TailwindCSS v4
- **Base de données** : SQLite (dev) / PostgreSQL (prod prévu)
- **i18n** : mcamara/laravel-localization + spatie/laravel-translatable
- **Serveur** : Laravel Herd
