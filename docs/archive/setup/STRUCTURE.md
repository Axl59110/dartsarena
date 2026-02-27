# Structure du Projet

Ce dépôt contient le projet DartsArena avec une organisation claire entre l'application et la documentation.

## Organisation

```
.
├── dartsarena/          # Application Laravel complète
│   ├── app/             # Models, Controllers, etc.
│   ├── public/          # Point d'entrée web
│   ├── resources/       # Views, assets
│   ├── routes/          # Routes Laravel
│   ├── database/        # Migrations, seeders
│   ├── tests/           # Tests unitaires
│   ├── .env             # Configuration Laravel
│   └── composer.json    # Dépendances PHP
│
├── .claude/             # Configuration Claude Code
├── bmad/                # Workflow BMAD Method
├── docs/                # Documentation technique
│
├── README.md            # Documentation principale
└── *.md                 # Fichiers de documentation
```

## Développement

### Démarrer l'application

```bash
cd dartsarena
php artisan serve
```

### Accéder à l'application

- **URL locale** : http://localhost:8000
- **Herd** : http://site-darts.test

### Structure Laravel

L'application suit la structure standard Laravel 10+ :
- **Backend** : Laravel 10 + SQLite
- **Frontend** : Blade + TailwindCSS v4
- **Assets** : Vite pour le bundling

## Documentation

- `README.md` - Vue d'ensemble du projet
- `docs/` - Documentation technique détaillée
- `POC_SETUP.md` - Guide de configuration initiale
- `ANALYSE_MULTI_AGENTS.md` - Analyse UX multi-agents
- `README_UX.md` - Corrections UX appliquées

## Workflows BMAD

Les workflows de développement BMAD Method sont disponibles dans le dossier `bmad/`.
