# 🎯 DartsArena

[![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=flat&logo=laravel)](https://laravel.com)
[![TailwindCSS](https://img.shields.io/badge/TailwindCSS-v4-38B2AC?style=flat&logo=tailwind-css)](https://tailwindcss.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

**Site de news et statistiques fléchettes professionnel** - Multilingue FR/EN

## ✨ Features

### 📰 Système d'Articles/News
- **8 articles réalistes** : Résultats, interviews, analyses du circuit PDC
- **Pagination** : 12 articles par page
- **Filtres par catégorie** : Résultats, News, Interviews, Analyses
- **Articles similaires** : Recommandations automatiques

### 👥 Joueurs & Statistiques
- **20 joueurs top PDC** avec données complètes :
  - Biographies FR/EN
  - Statistiques : Titres, 9-darters, Meilleures moyennes
  - Palmares détaillé
  - Fiches individuelles complètes

### 📊 Classements Dynamiques
- **Top 20 PDC** avec prize money réaliste
- **Évolutions** : Flèches ↑ ↓ pour suivre les mouvements
- **Filtrable** par fédération (PDC, WDF, BDO)
- Distribution prize money exponentielle réaliste

### 📅 Calendrier Complet 2026
- **11 événements majeurs** :
  - World Championship, Premier League, UK Open
  - World Matchplay, Grand Slam, Players Championship Finals
  - European Championship, World Grand Prix, etc.
- Dates, lieux, liens billetterie

### 📖 Guides & Ressources
- **4 guides complets** :
  - Les Règles des Fléchettes
  - Formats PDC : Sets vs Legs
  - Comprendre les Statistiques
  - Calendrier des Grandes Compétitions

### 🌍 Multilingue
- **Français & Anglais** complet
- Traduction automatique des contenus
- URLs localisées : `/fr/news`, `/en/news`

### 🎨 Design
- **Dark Theme** moderne et professionnel
- **TailwindCSS v4** avec design system cohérent
- **Responsive** : Mobile, tablette, desktop
- **Navigation** : 7 sections complètes
- **Breadcrumbs** pour une meilleure UX

## 🛠️ Stack Technique

- **Backend** : Laravel 11
- **Frontend** : Blade Templates + TailwindCSS v4
- **Base de données** : SQLite (dev) / PostgreSQL (production ready)
- **i18n** :
  - mcamara/laravel-localization
  - spatie/laravel-translatable
- **Slugs** : spatie/laravel-sluggable
- **Serveur** : Laravel Herd (dev) / Compatible tous serveurs

## 📊 Données Incluses

- ✅ **3 fédérations** : PDC, WDF, BDO
- ✅ **8 compétitions** majeures
- ✅ **7 saisons** (2026)
- ✅ **20 joueurs** : Humphries, Littler, MVG, Smith, Wright, Cross, Price, etc.
- ✅ **20 classements** avec prize money et évolutions
- ✅ **11 événements** calendrier pour toute l'année 2026
- ✅ **8 articles** de news
- ✅ **4 guides** complets

## 🚀 Installation

### Prérequis
- PHP 8.2+
- Composer
- Node.js & npm
- SQLite ou PostgreSQL

### Étapes

```bash
# 1. Cloner le projet
git clone https://github.com/Axl59110/dartsarena.git
cd dartsarena

# 2. Installer les dépendances PHP
composer install

# 3. Installer les dépendances Node
npm install

# 4. Copier le fichier d'environnement
cp .env.example .env

# 5. Générer la clé d'application
php artisan key:generate

# 6. Créer la base de données SQLite
touch database/database.sqlite

# 7. Exécuter les migrations et seeders
php artisan migrate --seed

# 8. Compiler les assets (optionnel)
npm run build

# 9. Démarrer le serveur
php artisan serve
```

Le site sera accessible sur `http://localhost:8000`

## 📂 Structure

```
dartsarena/
├── app/
│   ├── Http/Controllers/     # ArticleController, PlayerController, etc.
│   └── Models/               # Article, Player, Competition, etc.
├── database/
│   ├── migrations/           # Schéma de la base de données
│   └── seeders/              # Données de démonstration
├── resources/
│   ├── views/
│   │   ├── articles/         # Vues articles/news
│   │   ├── players/          # Fiches joueurs
│   │   ├── rankings/         # Classements
│   │   ├── calendar/         # Calendrier
│   │   └── guides/           # Guides
│   └── lang/                 # Traductions FR/EN
└── routes/
    └── web.php               # Routes de l'application
```

## 🌐 Pages Disponibles

### Navigation Principale
- **`/`** - Page d'accueil
- **`/news`** - Actualités avec filtres
- **`/competitions`** - Liste des compétitions
- **`/players`** - Joueurs top PDC
- **`/rankings`** - Classements avec évolutions
- **`/calendar`** - Calendrier des événements
- **`/guides`** - Guides et ressources

### URLs Multilingues
- `/fr/news` - Version française
- `/en/news` - Version anglaise
- Sélecteur de langue dans le header

## 🔧 Configuration

### Base de données
Modifier `.env` pour PostgreSQL :
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=dartsarena
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Langues supportées
Config dans `config/laravellocalization.php` :
```php
'supportedLocales' => [
    'fr' => ['name' => 'Français', 'script' => 'Latn', 'native' => 'Français'],
    'en' => ['name' => 'English', 'script' => 'Latn', 'native' => 'English'],
]
```

## 📸 Aperçu

- **Design dark theme** professionnel
- **Cartes d'articles** avec badges catégories
- **Fiches joueurs** détaillées avec stats
- **Classements** avec évolutions visuelles
- **Calendrier** événements à venir/passés

## 🎯 Fonctionnalités à Venir

- [ ] Système de recherche globale
- [ ] Matchs récents par joueur
- [ ] Head-to-head entre joueurs
- [ ] Live scores (simulés ou API)
- [ ] Système de tags pour articles
- [ ] Newsletter subscription
- [ ] Commentaires sur articles
- [ ] API REST publique
- [ ] Application mobile (PWA)

## 📝 Documentation

### 📚 Documentation BMAD Method (Principale)

**Toute la documentation du projet est organisée selon la BMAD Method v6 :**

- **[docs/CHANGELOG.md](docs/CHANGELOG.md)** - 📜 Historique complet des modifications
- **[docs/LEARNINGS.md](docs/LEARNINGS.md)** - 🎓 Best practices & patterns à suivre
- **[docs/sprint-status.yaml](docs/sprint-status.yaml)** - 📊 État d'avancement des sprints
- **[docs/bmm-workflow-status.yaml](docs/bmm-workflow-status.yaml)** - 🔄 Statut workflow BMAD
- **[docs/stories/](docs/stories/)** - 📋 User stories détaillées (STORY-001 à STORY-014)

### 📂 Archives Documentation (Historique)

Documentation détaillée archivée par thème :

- **[docs/archive/ux/](docs/archive/ux/)** - Corrections UX/UI, analyses, validations (10 docs)
- **[docs/archive/calendar/](docs/archive/calendar/)** - Refonte calendrier, guides tests (4 docs)
- **[docs/archive/setup/](docs/archive/setup/)** - Setup POC, vérifications, structure (5 docs)
- **[docs/archive/corrections/](docs/archive/corrections/)** - Historique corrections (2 docs)
- **[docs/archive/analysis/](docs/archive/analysis/)** - Analyses techniques (2 docs)
- **[docs/archive/testing/](docs/archive/testing/)** - Scripts et guides tests

### 🚀 Quick Start

1. **Pour développer :** Lire [docs/LEARNINGS.md](docs/LEARNINGS.md) pour les best practices
2. **Pour comprendre l'état :** Consulter [docs/sprint-status.yaml](docs/sprint-status.yaml)
3. **Pour l'historique :** Parcourir [docs/CHANGELOG.md](docs/CHANGELOG.md)
4. **Pour une feature :** Lire la story correspondante dans [docs/stories/](docs/stories/)

## 🤝 Contribution

Les contributions sont les bienvenues ! N'hésitez pas à :
1. Fork le projet
2. Créer une branche (`git checkout -b feature/amazing-feature`)
3. Commit vos changements (`git commit -m 'Add amazing feature'`)
4. Push vers la branche (`git push origin feature/amazing-feature`)
5. Ouvrir une Pull Request

## 📄 License

Ce projet est sous licence MIT. Voir le fichier [LICENSE](LICENSE) pour plus de détails.

## 👏 Remerciements

- **Laravel** pour le framework backend
- **TailwindCSS** pour le design system
- **Spatie** pour les packages Laravel
- **PDC** & **WDF** pour l'inspiration

## 📧 Contact

Axel - [@Axl59110](https://github.com/Axl59110)

Lien du projet : [https://github.com/Axl59110/dartsarena](https://github.com/Axl59110/dartsarena)

---

⭐ Si ce projet vous plaît, n'hésitez pas à lui donner une étoile !

**Made with ❤️ and 🎯**
