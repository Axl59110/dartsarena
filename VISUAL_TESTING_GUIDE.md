# Guide de Tests Visuels - Améliorations Calendrier

## Avant de commencer

1. Ouvrir le site en local: `http://dartsarena.test`
2. Ouvrir Chrome DevTools (F12)
3. Tester en Desktop (1920x1080) ET Mobile (375x667)

---

## Test 1: Sélecteur de Langue 🌐

### Desktop
1. Aller sur n'importe quelle page
2. Regarder en haut à droite (top bar)
3. **Vérifier**: Le bouton affiche "🇫🇷 FR" ou "🇬🇧 EN" (petit emoji)
4. Cliquer sur le bouton
5. **Vérifier**: Dropdown compact (140px de large)
6. **Vérifier**: 2 options visibles avec flags + noms
7. **Vérifier**: Langue active a checkmark ✓ verte
8. Cliquer sur l'autre langue
9. **Vérifier**: Page reload, contenu traduit

### Mobile
1. Menu hamburger > top bar visible
2. Même comportement que desktop

### Checklist Sélecteur
- [ ] Emojis flags petits (text-base)
- [ ] Dropdown compact et lisible
- [ ] Contraste correct (texte visible)
- [ ] Changement de langue fonctionne
- [ ] Checkmark visible sur langue active

---

## Test 2: Page Calendrier - Desktop 🖥️

### Navigation
1. Aller sur `/calendar`
2. **Vérifier**: Titre "Darts Calendar 2026"
3. **Vérifier**: Sous-titre "All PDC, WDF & BDO tournaments"

### Filtres
1. **Dropdown mois**:
   - [ ] Tous les mois (Jan-Dec) présents
   - [ ] Mois actuel sélectionné par défaut
2. **Boutons fédération**:
   - [ ] 4 boutons: All, PDC, WDF, BDO
   - [ ] Bouton actif a bg-primary
   - [ ] Hover states corrects

### Calendrier Visuel
1. **Grid 7 colonnes**:
   - [ ] Headers: Mon, Tue, Wed, Thu, Fri, Sat, Sun
   - [ ] Dates du mois affichées correctement
   - [ ] Premier jour aligné correctement
2. **Événements**:
   - [ ] Dots colorés sur dates avec événements
   - [ ] PDC = couleur primary
   - [ ] WDF = couleur accent
   - [ ] Jour actuel = bordure primary
3. **Navigation**:
   - [ ] Flèche gauche: mois précédent
   - [ ] Flèche droite: mois suivant
   - [ ] Titre mis à jour (ex: "February 2026")
4. **Hover**:
   - [ ] Cases deviennent bg-muted/50
   - [ ] Tooltip avec noms événements

### Tableau SEO
1. **Headers**:
   - [ ] 6 colonnes: Date, Tournament, Federation, Venue, Status, Tickets
   - [ ] Texte bold et visible
2. **Lignes événements**:
   - [ ] Dates formatées (dd MMM YYYY)
   - [ ] Noms tournois = liens cliquables
   - [ ] Badges fédération colorés
   - [ ] Venue avec emoji 📍
   - [ ] Status badge coloré (Upcoming/Live/Finished)
   - [ ] Bouton tickets (si disponible)
3. **Hover**:
   - [ ] Ligne devient bg-muted/30
4. **Empty state**:
   - [ ] Filtrer sur mois sans événements
   - [ ] Message "No events found" avec emoji 📅

### Interactions Filtres
1. **Sélectionner mois "July"**:
   - [ ] URL change: `?month=7&year=2026`
   - [ ] Calendrier affiche juillet
   - [ ] Tableau filtre événements juillet
2. **Cliquer "PDC"**:
   - [ ] Bouton devient primary
   - [ ] Tableau affiche uniquement événements PDC
   - [ ] URL: `?month=7&federation=pdc&year=2026`
3. **Cliquer "All"**:
   - [ ] Tous événements réaffichés

---

## Test 3: Page Calendrier - Mobile 📱

### Chrome DevTools
1. Toggle device toolbar (Ctrl+Shift+M)
2. Sélectionner iPhone 12 (390x844)

### Layout Mobile
1. **Calendrier**:
   - [ ] Grid 7 colonnes MASQUÉ (hidden lg:block)
   - [ ] Seulement navigation mois visible (optionnel)
2. **Filtres**:
   - [ ] Dropdown mois stack verticalement
   - [ ] Boutons fédération wrap correctement
3. **Tableau**:
   - [ ] Table MASQUÉE (lg:hidden removed from table)
   - [ ] Scroll horizontal si nécessaire
4. **Cards Liste**:
   - [ ] Visible uniquement mobile (lg:hidden)
   - [ ] Une card par événement
   - [ ] Infos: titre, dates, venue, fédération, status
   - [ ] Bouton tickets si disponible

### Checklist Mobile
- [ ] Pas de scroll horizontal (sauf table)
- [ ] Cards empilées verticalement
- [ ] Boutons touch-friendly (min 44x44px)
- [ ] Filtres accessibles
- [ ] Navigation mois fonctionne

---

## Test 4: Liens et Navigation

### Clic sur Tournoi
1. Desktop: Cliquer nom tournoi dans tableau
2. **Vérifier**: Redirige vers `/competitions/{slug}`
3. Mobile: Cliquer nom dans card
4. **Vérifier**: Même redirection

### Bouton Tickets
1. Cliquer "Buy" sur événement avec tickets
2. **Vérifier**: Ouvre `https://www.pdc.tv/tickets` dans nouvel onglet
3. **Vérifier**: `rel="noopener"` présent (sécurité)

### Fil d'Ariane
1. **Vérifier**: Breadcrumbs "Home / Calendar"
2. Cliquer "Home"
3. **Vérifier**: Retour à homepage

---

## Test 5: Performance et SEO

### Lighthouse (Chrome DevTools)
1. Onglet Lighthouse
2. Desktop mode
3. Run audit
4. **Vérifier scores**:
   - [ ] Performance: >85
   - [ ] Accessibility: >95
   - [ ] Best Practices: >90
   - [ ] SEO: >95

### HTML Sémantique
1. View Page Source (Ctrl+U)
2. **Vérifier**:
   - [ ] `<table>` présent (pas de divs)
   - [ ] `<thead>` et `<tbody>` corrects
   - [ ] `<th>` avec bons labels
   - [ ] Liens `<a>` vers competitions

### Meta Tags
1. View Page Source
2. **Vérifier**:
   - [ ] `<title>` = "Darts Calendar 2026 - DartsArena"
   - [ ] `<meta name="description">` présent
   - [ ] Hreflang tags pour FR/EN

---

## Test 6: Cas Limites

### Aucun événement
1. Filtrer fédération "BDO" + mois "June"
2. **Vérifier**: Empty state élégant
3. **Vérifier**: Message "Try changing your filters"

### Mois sans événements
1. Naviguer vers mois sans données
2. **Vérifier**: Calendrier vide mais correct
3. **Vérifier**: Tableau vide avec message

### Événement multi-jours
1. Trouver "Premier League Darts" (Feb-May)
2. **Vérifier**: Date affiche start + end
3. **Vérifier**: Dots sur toutes les dates concernées

### Événement Live
1. Modifier un event pour dates actuelles (en DB)
2. **Vérifier**: Badge "Live" vert
3. **Vérifier**: Highlight dans calendrier

---

## Bugs Fréquents à Vérifier

### Sélecteur Langue
- [ ] Dropdown ferme au clic dehors
- [ ] Langue persiste après reload
- [ ] Traductions correctes

### Calendrier
- [ ] Offset premier jour correct (ex: si mois commence jeudi)
- [ ] Nombre de jours correct (28-31)
- [ ] Navigation ne casse pas avec année change
- [ ] Dots événements affichés correctement

### Filtres
- [ ] URL params synchronisés
- [ ] Boutons états (active/inactive) corrects
- [ ] Filtres cumulables (mois + fédération)

### Responsive
- [ ] Pas de débordement horizontal
- [ ] Texte lisible (min 14px)
- [ ] Touch targets suffisants

---

## Résultat Attendu

### Desktop
- ✅ Calendrier visuel moderne
- ✅ Filtres fonctionnels et clairs
- ✅ Tableau SEO complet
- ✅ Navigation fluide

### Mobile
- ✅ Cards compactes
- ✅ Filtres accessibles
- ✅ Scroll vertical uniquement
- ✅ Informations essentielles visibles

---

## Prochaine Étape

Si tous les tests passent ✅, vous pouvez:
1. Commit les changements
2. Déployer en staging
3. Tester en production

Si bugs 🐛:
1. Noter les issues dans ce fichier
2. Créer tickets GitHub
3. Me fournir screenshots

---

**Bonne chance! 🎯**
