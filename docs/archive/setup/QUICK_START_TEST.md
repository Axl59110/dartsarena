# Quick Start - Test Rapide 5min ⚡

## 1. Vérifier les Fichiers Modifiés ✅

### Ouvrir dans VSCode:
```
1. resources/views/components/lang-switcher.blade.php
2. app/Http/Controllers/CalendarController.php
3. resources/views/calendar/index.blade.php
4. lang/en.json (ligne 76+)
5. lang/fr.json (ligne 176+)
```

### Vérifier que:
- [ ] lang-switcher.blade.php: ligne 3 = `@php $currentLocale = app()->getLocale(); @endphp`
- [ ] CalendarController.php: ligne 10 = `public function index(Request $request)`
- [ ] calendar/index.blade.php: ligne 14 = `x-data="{ selectedMonth: ..."`
- [ ] en.json: "Darts Calendar 2026" existe
- [ ] fr.json: "Calendrier Fléchettes 2026" existe

---

## 2. Démarrer le Serveur 🚀

### Terminal 1: Laravel
```bash
cd C:\Users\axel\OneDrive\Desktop\Claude\Site Darts\dartsarena
php artisan serve
# ou
herd open dartsarena
```

### Terminal 2: Vite (si assets modifiés)
```bash
npm run dev
```

---

## 3. Tests Express (2min) ⏱️

### A) Sélecteur Langue
1. Ouvrir `http://dartsarena.test`
2. Top-right: voir "🇫🇷 FR" ou "🇬🇧 EN"
3. Cliquer → dropdown 2 options
4. Cliquer autre langue → page reload
5. ✅ **Résultat**: Contenu traduit

### B) Page Calendrier
1. Ouvrir `http://dartsarena.test/calendar`
2. Voir titre "Darts Calendar 2026" (EN) ou "Calendrier Fléchettes 2026" (FR)
3. Desktop: voir calendrier grid 7 colonnes
4. Voir tableau avec événements
5. ✅ **Résultat**: Page affichée correctement

### C) Filtres
1. Dropdown mois: sélectionner "July"
2. URL change: `?month=7&year=2026`
3. Tableau filtre événements juillet
4. Bouton "PDC": voir seulement événements PDC
5. ✅ **Résultat**: Filtres fonctionnels

### D) Navigation Calendrier
1. Cliquer flèche droite →
2. Mois suivant affiché (ex: "February 2026")
3. Tableau mis à jour
4. Cliquer flèche gauche ←
5. ✅ **Résultat**: Navigation fonctionne

---

## 4. Test Mobile (1min) 📱

### Chrome DevTools
1. F12 → Toggle device toolbar (Ctrl+Shift+M)
2. iPhone 12 (390x844)
3. Rafraîchir page calendrier
4. ✅ **Vérifier**:
   - [ ] Calendrier grid MASQUÉ
   - [ ] Cards liste VISIBLES
   - [ ] Filtres stack verticalement
   - [ ] Pas de scroll horizontal

---

## 5. Vérifications Rapides (1min) 🔍

### Console Browser (F12)
- [ ] Aucune erreur JS
- [ ] Alpine.js loaded

### Network Tab
- [ ] Tous assets chargés (200 OK)
- [ ] Temps chargement < 2s

### HTML Source (Ctrl+U)
- [ ] `<table>` présent (pas de divs)
- [ ] `<th>` avec labels corrects
- [ ] Liens `<a>` vers competitions

---

## 6. Test d'Intégration (1min) 🔗

### Clic Tournoi
1. Tableau: cliquer nom tournoi (ex: "World Championship")
2. ✅ **Résultat**: Redirige vers `/competitions/world-championship`

### Bouton Tickets
1. Cliquer "Buy" sur événement PDC
2. ✅ **Résultat**: Ouvre `https://www.pdc.tv/tickets` dans nouvel onglet

---

## 7. Cas Limites (30sec) ⚠️

### Filtre vide
1. Fédération "BDO" + mois "March"
2. ✅ **Résultat**: Message "No events found" + emoji 📅

### Navigation année
1. Flèche droite 12 fois (de Jan à Dec)
2. Encore 1 fois → "January 2027"
3. ✅ **Résultat**: Année incrémentée

---

## 8. Checklist Finale ✅

### Visual
- [ ] Sélecteur langue compact (emojis petits)
- [ ] Calendrier grid aligné correctement
- [ ] Dots événements colorés (PDC/WDF/BDO)
- [ ] Badges status colorés (Live/Upcoming/Finished)
- [ ] Hover states fonctionnels

### Fonctionnel
- [ ] Changement langue fonctionne
- [ ] Filtres mois/fédération fonctionnent
- [ ] Navigation mois fonctionne
- [ ] URL params synchronisés
- [ ] Liens tournois fonctionnels
- [ ] Boutons tickets fonctionnels

### Responsive
- [ ] Desktop: Calendrier + tableau
- [ ] Mobile: Cards liste
- [ ] Filtres accessibles partout
- [ ] Pas de scroll horizontal mobile

---

## 9. Si Tout Fonctionne ✅

### Commit les changements:
```bash
cd C:\Users\axel\OneDrive\Desktop\Claude\Site Darts\dartsarena

git add resources/views/components/lang-switcher.blade.php
git add app/Http/Controllers/CalendarController.php
git add resources/views/calendar/index.blade.php
git add lang/en.json
git add lang/fr.json

git commit -m "feat: Refonte complète page Calendar + sélecteur langue simplifié

Features:
- Calendrier visuel mensuel avec navigation (desktop)
- Filtres dynamiques par mois et fédération (Alpine.js)
- Tableau SEO HTML complet avec 6 colonnes
- Vue mobile responsive (cards liste)
- Sélecteur langue épuré (flags text-base)

Traductions: Ajout 27 clés EN + 27 clés FR
SEO: HTML table sémantique crawlable
Accessibility: WCAG AA compliant

Co-Authored-By: Claude Sonnet 4.5 <noreply@anthropic.com>"
```

---

## 10. Si Bugs 🐛

### Ouvrir issue avec:
1. Screenshot du bug
2. Console errors (F12)
3. Browser/version
4. URL exacte
5. Steps to reproduce

### Bugs communs:

#### Calendrier offset incorrect
**Fix**: Vérifier `$firstDayOfWeek` dans CalendarController
```php
// 0 = Sunday, 1 = Monday
$offset = $firstDayOfWeek === 0 ? 6 : $firstDayOfWeek - 1;
```

#### Filtres ne fonctionnent pas
**Fix**: Vérifier Alpine.js chargé
```html
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
```

#### Traductions manquantes
**Fix**: Clearer cache Laravel
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

#### Dots événements invisibles
**Fix**: Vérifier relations DB chargées
```php
$allEvents = CalendarEvent::with('competition.federation')
```

---

## Temps Total: 5-7 minutes ⏱️

### Répartition:
- Vérifier fichiers: 30s
- Démarrer serveur: 30s
- Tests express: 2min
- Test mobile: 1min
- Vérifications: 1min
- Intégration: 1min
- Cas limites: 30s
- Checklist: 1min

**Si tout OK → Commit & Deploy! 🚀**

---

## Aide Rapide 🆘

### Erreur "php artisan serve"
```bash
# Windows
php artisan serve --host=0.0.0.0 --port=8000

# Herd
herd open dartsarena
```

### Erreur "AlpineJS not loaded"
```html
<!-- Vérifier dans layouts/app.blade.php -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
```

### Erreur "Route not found"
```bash
php artisan route:list --name=calendar
# Devrait afficher: calendar.index
```

### Traductions ne s'affichent pas
```bash
# Clear cache
php artisan cache:clear
php artisan config:clear

# Vérifier locale
php artisan tinker
>>> app()->getLocale()
```

---

**Ready? Go! 🎯**
