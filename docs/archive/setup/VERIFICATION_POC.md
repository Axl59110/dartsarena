# ✅ Checklist de Vérification du POC DartsArena

## 🔧 Avant de commencer

```bash
# 1. Installer les dépendances
composer install
npm install

# 2. Générer la clé (si nécessaire)
php artisan key:generate

# 3. Recréer la base de données avec toutes les données
php artisan migrate:fresh --seed

# 4. Démarrer le serveur
php artisan serve
# ou utiliser Herd (http://site-darts.test)
```

## 📋 Pages à Tester

### ✅ Page d'Accueil
- [ ] Accéder à `http://localhost:8000` ou `http://site-darts.test`
- [ ] Vérifier que la page affiche le titre "Bienvenue sur DartsArena"
- [ ] Vérifier les 6 cartes cliquables (Compétitions, Classements, Calendrier, Matchs du jour, Joueurs, Guides)
- [ ] Cliquer sur "Compétitions" → doit rediriger vers `/fr/competitions`
- [ ] Cliquer sur le sélecteur de langue (EN/FR) → doit changer la langue

### ✅ Fédérations
- [ ] Accéder à `/fr/federations`
- [ ] Vérifier que 3 fédérations s'affichent : PDC, WDF, BDO
- [ ] Cliquer sur "Professional Darts Corporation (PDC)"
- [ ] Vérifier que la page de détail affiche les compétitions PDC (8 compétitions)
- [ ] Vérifier les informations : nom, description, prize money

### ✅ Compétitions
- [ ] Accéder à `/fr/competitions`
- [ ] Vérifier que 8 compétitions s'affichent
- [ ] Vérifier que chaque carte affiche : nom, description, fédération, prize money
- [ ] Cliquer sur "Championnat du Monde PDC"
- [ ] Vérifier la page de détail : infos, format, saisons
- [ ] Vérifier qu'au moins 1 saison s'affiche (2026)

### ✅ Joueurs
- [ ] Accéder à `/fr/players`
- [ ] Vérifier que 5 joueurs s'affichent :
  - Luke Humphries
  - Luke Littler
  - Michael van Gerwen
  - Michael Smith
  - Peter Wright
- [ ] Cliquer sur "Luke Littler"
- [ ] Vérifier la page de détail :
  - [ ] Nom complet et surnom "The Nuke"
  - [ ] Nationalité : England
  - [ ] Date de naissance et âge
  - [ ] Biographie en français
  - [ ] Classement actuel (position)
  - [ ] Statistiques : Titres (8), 9-Darters (5), Meilleure Moyenne (112.35)

### ✅ Classements
- [ ] Accéder à `/fr/rankings`
- [ ] Vérifier que le tableau affiche 5 joueurs classés
- [ ] Vérifier les colonnes : #, Joueur, Prize Money, Évolution
- [ ] Vérifier que le classement affiche :
  - Position 1-5
  - Noms des joueurs cliquables
  - Prize money formaté (ex: $2,250,000)
  - Flèches d'évolution (↑ vert, ↓ rouge, — gris)
- [ ] Changer la fédération dans le filtre → devrait recharger la page
- [ ] Cliquer sur un nom de joueur → doit rediriger vers la fiche du joueur

### ✅ Calendrier
- [ ] Accéder à `/fr/calendar`
- [ ] Vérifier la section "Événements à venir"
- [ ] Vérifier que 2 événements s'affichent :
  - World Championship 2026 (15/12/2025 - 03/01/2026) à Alexandra Palace
  - Premier League 2026 (06/02/2026 - 28/05/2026) à Various UK & Europe
- [ ] Vérifier que chaque événement affiche :
  - Badge "À venir" (orange)
  - Titre de l'événement
  - Lieu (📍)
  - Dates (📅)
  - Bouton "Billets" (si URL disponible)

### ✅ Guides
- [ ] Accéder à `/fr/guides`
- [ ] Vérifier que 4 guides s'affichent dans 3 catégories :
  - **📜 Règles** :
    - Les Règles des Fléchettes : Guide Complet pour Débutants
    - Comprendre les Formats PDC : Sets vs Legs
  - **📊 Statistiques** :
    - Statistiques des Fléchettes : Comprendre les Moyennes
  - **🏆 Compétitions** :
    - Calendrier des Grandes Compétitions PDC
- [ ] Cliquer sur "Les Règles des Fléchettes : Guide Complet pour Débutants"
- [ ] Vérifier la page de détail :
  - [ ] Badge de catégorie "Règles"
  - [ ] Titre et description
  - [ ] Contenu HTML formaté avec titres, paragraphes, listes
  - [ ] Style cohérent (titres en rouge, listes indentées)
  - [ ] Bouton "Retour aux guides"

### ✅ Navigation
- [ ] Vérifier que la navigation principale contient tous les liens :
  - Accueil
  - Compétitions
  - Joueurs
  - Classements
  - Calendrier
  - Guides
- [ ] Vérifier que le lien actif est surligné
- [ ] Tester le menu mobile (réduire la fenêtre < 768px)
- [ ] Vérifier que le bouton hamburger (☰) apparaît
- [ ] Cliquer sur le bouton → menu doit s'afficher

### ✅ Multilingue
- [ ] Sur n'importe quelle page, cliquer sur "EN" dans le sélecteur de langue
- [ ] Vérifier que l'URL change (ex: `/fr/players` → `/en/players`)
- [ ] Vérifier que le contenu est traduit en anglais :
  - Titres de page
  - Navigation
  - Libellés (Players, Rankings, etc.)
  - Contenu des guides
- [ ] Re-cliquer sur "FR" → tout revient en français

### ✅ Breadcrumbs (Fil d'Ariane)
- [ ] Aller sur une page de détail (ex: `/fr/players/luke-littler`)
- [ ] Vérifier que le breadcrumb s'affiche : Accueil / Joueurs / Luke Littler
- [ ] Cliquer sur "Joueurs" → doit rediriger vers `/fr/players`
- [ ] Cliquer sur "Accueil" → doit rediriger vers `/fr/`

### ✅ Design et Responsivité
- [ ] Vérifier le thème sombre (fond #0f172a)
- [ ] Vérifier la couleur primaire rouge (#dc2626)
- [ ] Vérifier que les cartes ont un effet hover (changement de couleur de bordure)
- [ ] Tester sur mobile (< 768px) :
  - [ ] Navigation se transforme en menu hamburger
  - [ ] Grids passent en colonne unique
  - [ ] Texte reste lisible
- [ ] Vérifier le footer en bas de chaque page

## ✅ Base de Données

```bash
# Vérifier que les tables contiennent des données
php artisan tinker

# Compter les enregistrements
\App\Models\Federation::count();  // Devrait retourner 3
\App\Models\Competition::count(); // Devrait retourner 8
\App\Models\Player::count();      // Devrait retourner 5
\App\Models\PlayerRanking::count(); // Devrait retourner 5
\App\Models\CalendarEvent::count(); // Devrait retourner 2
\App\Models\Season::count();       // Devrait retourner 7
\App\Models\Guide::count();        // Devrait retourner 4

# Tester les traductions
\App\Models\Federation::first()->name; // Devrait retourner le nom en français
app()->setLocale('en');
\App\Models\Federation::first()->name; // Devrait retourner le nom en anglais

exit
```

## 🐛 Problèmes Courants

### Erreur "No application encryption key"
```bash
php artisan key:generate
```

### Base de données vide
```bash
php artisan migrate:fresh --seed
```

### Traductions ne fonctionnent pas
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Erreur 404 sur toutes les pages
- Vérifier que le `.htaccess` existe dans `/public`
- Vérifier que `mod_rewrite` est activé (Apache)
- Avec Herd, vérifier que le site est bien "parké"

### Images/styles ne chargent pas
```bash
npm run build
# ou en mode dev
npm run dev
```

## ✅ Résultat Attendu

Si tout fonctionne :
- ✅ Toutes les pages sont accessibles sans erreur 404 ou 500
- ✅ Les données s'affichent correctement (joueurs, compétitions, etc.)
- ✅ Le multilingue fonctionne (FR/EN)
- ✅ La navigation est fluide
- ✅ Le design est cohérent et responsive
- ✅ Les guides s'affichent avec leur contenu HTML formaté

## 📊 Métriques du POC

- **7 pages fonctionnelles** : Accueil, Fédérations, Compétitions, Joueurs, Classements, Calendrier, Guides
- **5 contrôleurs** créés
- **8 vues Blade** principales
- **7 seeders** avec données de test
- **Multilingue** : FR + EN
- **100% responsive** : Mobile + Desktop

🎯 **Le POC est complet et prêt pour démonstration !**
