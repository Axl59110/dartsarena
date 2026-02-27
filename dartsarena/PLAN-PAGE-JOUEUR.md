# 📋 PLAN COMPLET PAGE JOUEUR - Design Gamifié avec Vraies Données

## 🎯 OBJECTIF
Créer une page joueur moderne, visuelle et gamifiée en utilisant UNIQUEMENT des données réelles disponibles via API/scraping.

---

## 📊 SOURCES DE DONNÉES DISPONIBLES

### APIs Professionnelles
1. **iDarts** (https://www.idarts.nl/)
   - 27,000+ joueurs, 420,000+ matchs, 1,000+ compétitions
   - Stats complètes PDC/WDF/BDO
   - Head-to-head, historiques

2. **Sportradar** (https://developer.sportradar.com/darts/)
   - 26 endpoints API
   - Profils joueurs, rankings, stats saisonnières
   - Résultats temps réel, probabilités

3. **Statorium** (https://statorium.com/darts-api)
   - Couverture PDC complète
   - Chaque lancer, chaque jeu

4. **Darts Orakel** (https://dartsorakel.com)
   - Moyennes 2026
   - Head-to-head
   - Form rankings (FDI)
   - Prédictions

5. **Darts24.com** (https://www.darts24.com/)
   - Scores throw-by-throw
   - Set/leg results
   - Averages, checkout %, 180s
   - H2H stats

---

## 🎮 ONGLET 1 : PROFIL

### Données Disponibles (API)
- **Identité** : Nom, surnom, nationalité, date de naissance, âge
- **Photo** : URL photo officielle
- **Biographie** : Texte descriptif
- **Infos physiques** : Taille, poids, main dominante
- **Carrière** : Professionnel depuis (année)
- **Réseaux sociaux** : Twitter, Instagram, Facebook
- **Classement actuel** : Position PDC/WDF/BDO

### Blocs à Créer

#### 1. CARTE IDENTITÉ (Hero Mini)
```
┌─────────────────────────────┐
│  [Photo]    Luke Littler    │
│             "The Nuke"       │
│             🇬🇧 England • 19 ans │
│                              │
│  #2 PDC | Pro depuis 2023    │
└─────────────────────────────┘
```
**Gamification** : Badge rang animé, drapeau pays

#### 2. BIOGRAPHIE
```
┌─────────────────────────────┐
│  📖 Biographie              │
│                              │
│  [Texte de la bio...]        │
└─────────────────────────────┘
```
**Simple** : Texte clean, pas de fioriture

#### 3. FICHE TECHNIQUE
```
┌─────────────────────────────┐
│  🎯 Fiche Technique         │
│                              │
│  Taille        : 1.78m       │
│  Poids         : 75kg        │
│  Main          : Droitier    │
│  Professionnel : 2023        │
└─────────────────────────────┘
```
**Gamification** : Icônes pour chaque info

#### 4. RÉSEAUX SOCIAUX
```
┌─────────────────────────────┐
│  [🐦] [📸] [👍]             │
└─────────────────────────────┘
```
**Simple** : Boutons avec liens

### ❌ SUPPRIMER
- Barre XP (impossible à alimenter)
- "Niveau joueur" calculé (données fantaisistes)
- Attributs RPG (Précision 92, etc.) - données inventées

---

## 📊 ONGLET 2 : STATS

### Données Disponibles (API)
**Carrière complète** :
- Total matchs joués
- Victoires / Défaites
- Win rate (%)
- Moyenne générale (average)
- Checkout % moyen
- Total 180s en carrière
- Meilleure moyenne (career high)
- Total 9-darters

**Par saison** (Sportradar) :
- Stats saisonnières
- Évolution par année

**Par tournoi** (iDarts) :
- Performance par compétition

### Blocs à Créer

#### 1. VUE D'ENSEMBLE CARRIÈRE
```
┌────────────────────────────────────────┐
│  📊 Statistiques Carrière              │
│                                         │
│  ┌──────┐  ┌──────┐  ┌──────┐  ┌──────┐│
│  │ 145  │  │ 89   │  │ 56   │  │ 61.4%││
│  │Matchs│  │ Wins │  │Losses│  │ W/R  ││
│  └──────┘  └──────┘  └──────┘  └──────┘│
└────────────────────────────────────────┘
```
**Gamification** : Cartes colorées (vert=wins, rouge=losses)

#### 2. MOYENNES & FINITION
```
┌────────────────────────────────────────┐
│  🎯 Performance                        │
│                                         │
│  Moyenne générale    : 96.8            │
│  ━━━━━━━━━━━━━━━━━━━━━━ 96.8%         │
│                                         │
│  Checkout %          : 42.3%           │
│  ━━━━━━━━━━━━━━━━ 42.3%               │
│                                         │
│  Total 180s          : 234             │
│  Meilleure moyenne   : 113.42          │
└────────────────────────────────────────┘
```
**Gamification** : Barres de progression **basées sur vraies valeurs** (pas de fake 0-100)

#### 3. RECORDS PERSONNELS
```
┌────────────────────────────────────────┐
│  🏆 Records Personnels                 │
│                                         │
│  🎯 Meilleure moyenne    : 113.42      │
│  🔥 Total 9-Darters      : 6           │
│  🏅 Titres remportés     : 12          │
└────────────────────────────────────────┘
```
**Simple** : Liste avec icônes

#### 4. GRAPHIQUE ÉVOLUTION MOYENNE (Chart.js)
```
┌────────────────────────────────────────┐
│  📈 Évolution Moyenne par Saison       │
│                                         │
│  [Graphique ligne: 2023→2024→2025]    │
│   92.5 → 95.8 → 96.8                   │
└────────────────────────────────────────┘
```
**Gamification** : Graph

ique Chart.js avec vraies données API

#### 5. GRAPHIQUE 180s PAR SAISON
```
┌────────────────────────────────────────┐
│  🔥 180s par Saison                    │
│                                         │
│  [Graphique barres: 2023→2024→2025]   │
│   45 → 89 → 100                        │
└────────────────────────────────────────┘
```
**Gamification** : Graphique barres animé

### ❌ SUPPRIMER
- Attributs RPG (Précision, Régularité, Finition, Expérience) - **INVENTÉS**
- Niveau joueur + barre XP - **IMPOSSIBLE À ALIMENTER**
- Forme récente avec barres aléatoires - **FAKE DATA**

---

## 💰 ONGLET 3 : FORTUNE

### ⚠️ PROBLÈME MAJEUR
**Les APIs de darts NE FOURNISSENT PAS de données financières** :
- Pas de prize money par joueur
- Pas de sponsors
- Pas de fortune nette
- Pas de revenus mensuels

### 🔍 Données Réellement Scrapables
- **PDC.tv** : Prize money par tournoi (montant total, pas par joueur)
- **Darts-nerd.com** : Section Fortune existe avec estimations

### Solutions

#### OPTION A : Scraper darts-nerd.com
Copier leur structure si données disponibles

#### OPTION B : SUPPRIMER L'ONGLET
Rediriger vers l'onglet Palmarès avec prize money par tournoi gagné

#### OPTION C : Afficher Prize Money par Tournoi Gagné
```
┌────────────────────────────────────────┐
│  💰 Prize Money                        │
│                                         │
│  🏆 World Championship 2024            │
│      Prize: £500,000                   │
│                                         │
│  🏆 Premier League 2024                │
│      Prize: £275,000                   │
│                                         │
│  💵 Total estimé: £1.2M                │
└────────────────────────────────────────┘
```

### ❌ SUPPRIMER COMPLÈTEMENT
- Évolution annuelle £850K, £720K, etc. - **INVENTÉ**
- Sponsors (Target, Xbox, BetMGM, Sky) - **INVENTÉ**
- Sources de revenus 65%/25%/10% - **INVENTÉ**
- Valeur nette £3-5M - **INVENTÉ**
- Répartition mensuelle/hebdo/quotidien - **INVENTÉ**

**RECOMMANDATION** : **SUPPRIMER CET ONGLET** ou le remplacer par "Palmarès & Prize Money"

---

## 🏆 ONGLET 4 : PALMARÈS

### Données Disponibles (API)
- **Titres remportés** : Nombre total (player.career_titles)
- **Tournois gagnés** : Liste avec année, compétition, prize money
- **Finales perdues** : Runner-up
- **Historique complet** : iDarts API

### Blocs à Créer

#### 1. TOTAL TITRES
```
┌────────────────────────────────────────┐
│  🏆 Palmarès                           │
│                                         │
│        ┌──────────┐                    │
│        │    12    │                    │
│        │  TITRES  │                    │
│        └──────────┘                    │
└────────────────────────────────────────┘
```
**Gamification** : Gros chiffre doré animé

#### 2. CHRONOLOGIE DES VICTOIRES
```
┌────────────────────────────────────────┐
│  📅 Chronologie                        │
│                                         │
│  🥇 2024 World Championship            │
│      £500,000 • Ally Pally             │
│                                         │
│  🥈 2024 Premier League                │
│      £275,000 • PDC                    │
│                                         │
│  🥉 2023 UK Open                       │
│      £110,000 • Minehead               │
└────────────────────────────────────────┘
```
**Gamification** : Timeline avec médailles, couleurs par rang

#### 3. GRAPHIQUE TITRES PAR ANNÉE
```
┌────────────────────────────────────────┐
│  📈 Évolution Palmarès                 │
│                                         │
│  [Graphique barres empilées]           │
│  2023: 2 titres                        │
│  2024: 7 titres                        │
│  2025: 3 titres                        │
└────────────────────────────────────────┘
```
**Gamification** : Chart.js avec vraies données

### ❌ SUPPRIMER
- Placeholder "Trophy Timeline" avec données fake
- "Le détail complet... sera bientôt disponible" - **INUTILE**

---

## ⚔️ ONGLET 5 : MATCHS

### Données Disponibles (API)
**Par match (Darts24, iDarts, Sportradar)** :
- Date, round, compétition
- Adversaire
- Score (sets/legs)
- Résultat (W/L)
- Average du joueur
- Average adversaire
- 180s (joueur + adversaire)
- Checkout % (joueur + adversaire)
- Highest checkout

### Blocs à Créer

#### 1. LISTE MATCHS RÉCENTS
```
┌────────────────────────────────────────┐
│  ⚔️ Matchs Récents                     │
│                                         │
│  ✅ W  vs Humphries    7-5             │
│     📊 Avg 98.2 | 180s: 4 | CO%: 45%  │
│     📅 26/02/2026 • Premier League     │
│                                         │
│  ❌ L  vs van Gerwen   3-7             │
│     📊 Avg 94.1 | 180s: 2 | CO%: 38%  │
│     📅 19/02/2026 • Premier League     │
└────────────────────────────────────────┘
```
**Gamification** :
- Badge W/L coloré (vert/rouge)
- Stats compactes et claires
- Icônes pour chaque stat

#### 2. GRAPHIQUE FORME (10 DERNIERS MATCHS)
```
┌────────────────────────────────────────┐
│  📊 Forme Récente                      │
│                                         │
│  W L W W W L W W W L                   │
│  ████░████████░                         │
│                                         │
│  Victoires: 7/10 (70%)                 │
└────────────────────────────────────────┘
```
**Gamification** : Barres W/L visuelles, pourcentage

#### 3. GRAPHIQUE MOYENNE PAR MATCH (Chart.js)
```
┌────────────────────────────────────────┐
│  📈 Évolution Moyenne (10 matchs)      │
│                                         │
│  [Graphique ligne: 94→96→98→95...]    │
│  Avec ligne horizontale: Moy. carrière │
└────────────────────────────────────────┘
```
**Gamification** : Graph temps réel

### ❌ SUPPRIMER
- Match cards avec données manquantes
- Affichage si aucun match (vide accepté)

---

## 🎯 ONGLET 6 : 9-DARTERS

### Données Disponibles (API/DB)
- **Liste 9-darters** : table `nine_darters`
- Date, compétition, adversaire
- Ordre (#1, #2, #3...)
- Diffusé TV (oui/non)
- URL vidéo (YouTube/Vimeo)
- Thumbnail auto-généré

### Blocs à Créer

#### 1. COMPTEUR TOTAL
```
┌────────────────────────────────────────┐
│  🎯 9-Darters Parfaits                 │
│                                         │
│        ┌──────────┐                    │
│        │     6    │                    │
│        │ PERFECT  │                    │
│        └──────────┘                    │
└────────────────────────────────────────┘
```
**Gamification** : Badge doré animé

#### 2. GALERIE VIDÉOS
```
┌────────────────────────────────────────┐
│  [Thumbnail #1]   [Thumbnail #2]       │
│   📺 TV              Premier League    │
│   vs Humphries       26/02/2024        │
│   [▶️ PLAY]          [▶️ PLAY]         │
└────────────────────────────────────────┘
```
**Gamification** :
- Thumbnails cliquables
- Badge TV si diffusé
- Modale vidéo YouTube/Vimeo

#### 3. CHRONOLOGIE
```
┌────────────────────────────────────────┐
│  #1 • World Championship 2023          │
│      vs Anderson | 📺 TV               │
│                                         │
│  #2 • Premier League 2024              │
│      vs Wright                         │
│                                         │
│  #3 • UK Open 2024                     │
│      vs Price | 📺 TV                  │
└────────────────────────────────────────┘
```
**Gamification** : Timeline avec numéros, badges TV

### ❌ SUPPRIMER
- Message "Aucun 9-darter" si vide (garder simple)

---

## ⚙️ ONGLET 7 : ÉQUIPEMENT

### Données Disponibles (DB)
- **Table `player_equipments`** :
  - Type (Barrel, Flight, Shaft, etc.)
  - Marque
  - Modèle
  - Photo
  - Description
  - Période d'utilisation
  - Actuel (oui/non)
  - Lien affilié

### Blocs à Créer

#### 1. SETUP ACTUEL
```
┌────────────────────────────────────────┐
│  ⚙️ Setup Actuel                       │
│                                         │
│  ┌─────────┐  ┌─────────┐  ┌─────────┐│
│  │ [Photo] │  │ [Photo] │  │ [Photo] ││
│  │ BARREL  │  │ FLIGHT  │  │ SHAFT   ││
│  │         │  │         │  │         ││
│  │ Target  │  │ Harrows │  │ Cosmo   ││
│  │ Gen 3   │  │ Prime   │  │ Fit     ││
│  │         │  │         │  │         ││
│  │[Acheter]│  │[Acheter]│  │[Acheter]││
│  └─────────┘  └─────────┘  └─────────┘│
└────────────────────────────────────────┘
```
**Gamification** :
- Photos produits
- Badges type équipement
- Boutons affiliés

#### 2. ÉQUIPEMENTS PRÉCÉDENTS
```
┌────────────────────────────────────────┐
│  📦 Équipements Précédents             │
│                                         │
│  Unicorn Maestro • 2021-2023           │
│  Winmau Navigator • 2019-2021          │
└────────────────────────────────────────┘
```
**Simple** : Liste compacte avec périodes

### ❌ SUPPRIMER
- Placeholder si vide (acceptable)
- Description longue (garder compact)

---

## 🎨 DESIGN SYSTEM SIMPLIFIÉ

### Couleurs
```css
--background-dark: #0f172a;    /* Fond principal */
--card-dark: #1e293b;          /* Cartes */
--border: #334155;             /* Bordures */
--text-primary: #f1f5f9;       /* Texte principal */
--text-secondary: #94a3b8;     /* Texte secondaire */
--primary: #ef4444;            /* Rouge PDC */
--success: #10b981;            /* Vert (wins) */
--danger: #ef4444;             /* Rouge (losses) */
--warning: #f59e0b;            /* Orange */
```

### Composants Réutilisables

#### Carte Standard
```css
.stat-card {
  background: var(--card-dark);
  border: 1px solid var(--border);
  border-radius: 12px;
  padding: 1.5rem;
  color: var(--text-primary);
}
```

#### Badge W/L
```css
.badge-win { background: #10b981; color: white; }
.badge-loss { background: #ef4444; color: white; }
```

#### Barre de Progression
```css
.progress-bar {
  height: 8px;
  background: var(--border);
  border-radius: 4px;
  overflow: hidden;
}
.progress-fill {
  height: 100%;
  background: linear-gradient(90deg, var(--primary), var(--warning));
  transition: width 0.6s ease;
}
```

---

## 📦 LIBRAIRIES NÉCESSAIRES

### Chart.js (Graphiques)
```html
<script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
```

**Utilisation** :
- Évolution moyenne par saison (ligne)
- 180s par saison (barres)
- Titres par année (barres empilées)
- Moyenne par match (ligne)

### Alpine.js (Déjà installé)
Navigation entre onglets

---

## ✅ RÉSUMÉ DES SUPPRESSIONS

### À SUPPRIMER COMPLÈTEMENT
1. ❌ Barre XP / Niveau joueur (données impossibles)
2. ❌ Attributs RPG (Précision 92, Régularité 88...) - **INVENTÉ**
3. ❌ Onglet Fortune complet (ou refonte totale)
4. ❌ Évolution fortune annuelle - **INVENTÉ**
5. ❌ Liste sponsors - **INVENTÉ**
6. ❌ Sources revenus % - **INVENTÉ**
7. ❌ Valeur nette estimée - **INVENTÉ**
8. ❌ Forme récente (barres aléatoires) - remplacer par vraies données W/L

### À GARDER ET AMÉLIORER
1. ✅ Hero section (OK mais simplifier)
2. ✅ Profil (ajouter fiche technique)
3. ✅ Stats (ajouter graphiques Chart.js)
4. ✅ Palmarès (ajouter timeline + graphiques)
5. ✅ Matchs (améliorer avec stats détaillées)
6. ✅ 9-Darters (OK)
7. ✅ Équipement (OK)

---

## 🚀 PROCHAINES ÉTAPES

1. **Valider ce plan** avec l'utilisateur
2. **Créer les vrais graphiques** Chart.js
3. **Nettoyer le CSS** (supprimer mode dark complexe)
4. **Simplifier les partials** (supprimer données fake)
5. **Implémenter les vrais blocs** un par un
6. **Tester avec vraies données API**

---

**Sources** :
- [iDarts](https://www.idarts.nl/)
- [Sportradar Darts API](https://developer.sportradar.com/darts/)
- [Statorium](https://statorium.com/darts-api)
- [Darts Orakel](https://dartsorakel.com)
- [Darts24](https://www.darts24.com/)
- [The Darts Database](https://www.dartsdatabase.co.uk/)
- [Flashscore Darts](https://www.flashscore.com/darts/)
