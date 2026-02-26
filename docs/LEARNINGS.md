# 📚 Learnings & Best Practices - DartsArena

Guide de référence consolidé pour éviter les régressions et maintenir la qualité.

---

## 🎨 UX/UI Best Practices

### Patterns à Suivre

#### Featured Article (ESPN/BBC Pattern)
```blade
<!-- ✅ CORRECT: 2/3 image + 1/3 contenu -->
<div class="grid lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
        <img src="{{ $article->image }}" alt="..." />
    </div>
    <div class="lg:col-span-1">
        <badge>{{ $article->category }}</badge>
        <h2>{{ $article->title }}</h2>
        <p>{{ $article->excerpt }}</p>
        <a href="...">Read More</a>
    </div>
</div>

<!-- ❌ ÉVITER: Full width image sans structure -->
<img src="..." class="w-full" />
<h2>Title</h2>
```

#### Player Cards (FlashScore Pattern)
```blade
<!-- ✅ CORRECT: Photo + Stats Grid + Ranking Badge -->
<div class="relative">
    <div class="absolute top-2 right-2">
        <span class="ranking-badge">#{{ $ranking }}</span>
    </div>

    <img src="{{ $player->photo_url ?? '' }}"
         onerror="this.outerHTML='<div class=\'initials-fallback\'>{{ initials }}</div>'" />

    <h3>{{ $player->name }}</h3>

    <div class="stats-grid grid-cols-3">
        <div>Avg: {{ $player->avg }}</div>
        <div>Win%: {{ $player->win_rate }}</div>
        <div>Matches: {{ $player->matches }}</div>
    </div>
</div>

<!-- ❌ ÉVITER: Emojis comme icônes professionnelles -->
<div>
    🎯 {{ $player->avg }}
    🏆 {{ $player->win_rate }}
</div>
```

### Hiérarchie Visuelle

#### Line-Height Optimal
```css
/* ✅ CORRECT: Line-height serré pour titres */
.title {
    line-height: 1.1; /* ou leading-tight */
}

.subtitle {
    line-height: 1.2; /* ou leading-snug */
}

.body-text {
    line-height: 1.6; /* ou leading-relaxed */
}

/* ❌ ÉVITER: Line-height identique partout */
* {
    line-height: 1.5; /* Tue la hiérarchie */
}
```

#### Contrastes & Accessibilité
```css
/* ✅ CORRECT: WCAG AA (4.5:1) minimum, AAA (7:1) préféré */
.text-primary {
    color: hsl(222.2 47.4% 11.2%); /* #0f172a sur blanc = 15:1 ✓ */
}

.text-muted {
    color: hsl(215.4 16.3% 46.9%); /* #64748b sur blanc = 4.6:1 ✓ */
}

/* ❌ ÉVITER: Contrastes faibles */
.text-gray-400 {
    color: #9ca3af; /* 2.8:1 sur blanc ✗ WCAG fail */
}
```

### Espacement Cohérent

```css
/* ✅ CORRECT: Scale cohérente (Tailwind) */
.card {
    padding: 1.5rem;      /* p-6 */
    gap: 0.75rem;         /* gap-3 */
    border-radius: 0.5rem; /* rounded-lg */
}

.section {
    margin-bottom: 3rem;  /* mb-12 */
}

/* ❌ ÉVITER: Valeurs arbitraires incohérentes */
.card {
    padding: 17px;
    gap: 13px;
    border-radius: 7px;
}
```

### Images & Fallbacks

#### Fallback Élégant
```blade
<!-- ✅ CORRECT: Fallback avec initiales ou gradient -->
@if($player->photo_url)
    <img src="{{ $player->photo_url }}"
         onerror="this.outerHTML='<div class=\'bg-gradient-to-br from-primary/10 to-primary/30 flex items-center justify-center h-full\'><span class=\'text-4xl font-bold\'>{{ $initials }}</span></div>'" />
@else
    <div class="initials-fallback">{{ $initials }}</div>
@endif

<!-- ❌ ÉVITER: Image cassée visible -->
<img src="{{ $player->photo_url }}" alt="Player" />
```

---

## 🐛 Bugs Courants & Solutions

### TypeError htmlspecialchars()

#### ❌ Problème
```php
// PlayerController.php
return view('players.index', [
    'players' => $players
]);

// players/index.blade.php
<img src="{{ $player->photo_url }}" /> <!-- TypeError si null -->
```

#### ✅ Solution
```php
// Option 1: Accesseur Model
class Player extends Model {
    protected $appends = ['photo_url_safe'];

    public function getPhotoUrlSafeAttribute() {
        return $this->photo_url ?? '';
    }
}

// Option 2: Vue Blade
<img src="{{ $player->photo_url ?? '' }}" />

// Option 3: htmlspecialchars manuel
{{ htmlspecialchars($player->photo_url ?? '', ENT_QUOTES) }}
```

### BadMethodCallException Pagination

#### ❌ Problème
```php
// Controller
$players = Player::paginate(12);

// Blade
{{ $players->links() }} <!-- ✓ OK -->
Page {{ $players->currentPage() }} <!-- ✗ BadMethodCallException -->
```

#### ✅ Solution
```php
// Utiliser les méthodes correctes de LengthAwarePaginator
{{ $players->currentPage() }}  <!-- ✓ Méthode valide -->
{{ $players->lastPage() }}     <!-- ✓ Total pages -->
{{ $players->total() }}        <!-- ✓ Total items -->
{{ $players->perPage() }}      <!-- ✓ Items par page -->
```

### ParseError: JSON-LD avec @if dans Blade

#### ❌ Problème
```blade
{{-- Blade syntax error: @if dans JSON créent des virgules finales invalides --}}
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Person",
    "name": "{{ $player->full_name }}",
    @if($player->photo_url)
    "image": "{{ asset($player->photo_url) }}",
    @endif
    @if($player->date_of_birth)
    "birthDate": "{{ $player->date_of_birth->format('Y-m-d') }}",
    @endif
    "description": "..."
}
</script>
{{-- ParseError: "unexpected end of file, expecting elseif or else or endif" --}}
```

#### ✅ Solution
```blade
{{-- Construire JSON en @php puis encoder proprement --}}
@php
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'Person',
        'name' => $player->full_name,
        'alternateName' => $player->nickname,
        'nationality' => $player->nationality,
        'description' => strip_tags($player->bio ?? 'Professional darts player'),
        'jobTitle' => 'Professional Darts Player',
        'award' => $player->career_titles . ' career titles'
    ];

    if ($player->photo_url) {
        $schema['image'] = asset($player->photo_url);
    }

    if ($player->date_of_birth) {
        $schema['birthDate'] = $player->date_of_birth->format('Y-m-d');
    }
@endphp
<script type="application/ld+json">
{!! json_encode($schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) !!}
</script>
{{-- ✓ JSON valide, pas de virgules finales, @if bien fermés --}}
```

**Pourquoi ça corrige:**
- Évite les `@if` non fermés dans le contexte JSON
- Pas de virgules finales conditionnelles (JSON invalide)
- `json_encode()` génère JSON toujours valide
- `JSON_UNESCAPED_SLASHES` pour URLs propres
- `JSON_PRETTY_PRINT` pour readabilité (optionnel)

---

## 🌐 i18n Best Practices

### Clés de Traduction

#### ✅ Structure Recommandée
```json
{
    "Darts Calendar 2026": "Calendrier Fléchettes 2026",
    "All months": "Tous les mois",
    "Mon": "Lun",
    "Buy Tickets": "Acheter des Billets",
    "No events found": "Aucun événement trouvé"
}
```

#### ❌ À Éviter
```json
{
    "calendar_title": "Calendrier",  // Perd contexte
    "btn_buy": "Acheter",            // Trop court
    "lundi": "Lun"                   // Pas la source EN
}
```

### Usage dans Blade

```blade
<!-- ✅ CORRECT: Fonction __() -->
<h1>{{ __('Darts Calendar 2026') }}</h1>

<!-- ✅ CORRECT: Directive @lang -->
@lang('Buy Tickets')

<!-- ❌ ÉVITER: Hardcodé -->
<h1>Darts Calendar 2026</h1>
```

---

## 📊 Performance Best Practices

### Pagination Optimale

```php
// ✅ CORRECT: Limite raisonnable pour UX
$players = Player::orderBy('ranking')
    ->paginate(12); // Cards lisibles, scroll minimal

// ❌ ÉVITER: Trop d'items = scroll infini
$players = Player::paginate(50); // Mauvaise UX mobile
```

### Requêtes N+1

```php
// ✅ CORRECT: Eager loading
$competitions = Competition::with(['federation', 'participants'])
    ->get();

// ❌ ÉVITER: N+1 queries
$competitions = Competition::all();
foreach ($competitions as $comp) {
    echo $comp->federation->name; // Query à chaque itération
}
```

---

## 🎨 Composants Réutilisables

### Naming Convention

```
✅ CORRECT:
components/
├── featured-article.blade.php    <!-- Descriptif -->
├── player-card.blade.php         <!-- Spécifique -->
├── competition-card.blade.php    <!-- Cohérent -->
└── guide-card.blade.php          <!-- Pattern clair -->

❌ ÉVITER:
components/
├── article.blade.php             <!-- Trop générique -->
├── card1.blade.php               <!-- Non descriptif -->
├── PlayerCard.blade.php          <!-- PascalCase (pas convention Blade) -->
└── comp_card.blade.php           <!-- Underscore (préférer tiret) -->
```

### Props Typées

```blade
{{-- ✅ CORRECT: Props claires avec @props --}}
@props(['article', 'featured' => false])

<article class="{{ $featured ? 'col-span-2' : 'col-span-1' }}">
    <!-- ... -->
</article>

{{-- ❌ ÉVITER: Props non documentées --}}
<article>
    {{ $article->title ?? 'No title' }}
</article>
```

---

## 🔍 SEO Best Practices

### HTML Sémantique

```html
<!-- ✅ CORRECT: Table sémantique crawlable -->
<table>
    <thead>
        <tr>
            <th>Tournament</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($events as $event)
        <tr>
            <td>
                <a href="{{ route('competitions.show', $event) }}">
                    {{ $event->name }}
                </a>
            </td>
            <td>{{ $event->start_date->format('d M Y') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- ❌ ÉVITER: Divs non sémantiques -->
<div class="table">
    <div class="row">
        <div>{{ $event->name }}</div>
    </div>
</div>
```

### URLs Partageables

```php
// ✅ CORRECT: Query params explicites
route('calendar.index', [
    'month' => 5,
    'federation' => 'pdc',
    'year' => 2026
]);
// → /calendar?month=5&federation=pdc&year=2026

// ❌ ÉVITER: États non partageables
// JavaScript uniquement sans sync URL
```

---

## 🎯 Alpine.js Patterns

### Data Binding Clean

```html
<!-- ✅ CORRECT: State local clair -->
<div x-data="{
    selectedMonth: '{{ request('month', 'all') }}',
    selectedFederation: '{{ request('federation', 'all') }}',

    applyFilters() {
        const params = new URLSearchParams();
        if (this.selectedMonth !== 'all') params.set('month', this.selectedMonth);
        if (this.selectedFederation !== 'all') params.set('federation', this.selectedFederation);
        window.location.search = params.toString();
    }
}">
    <select x-model="selectedMonth" @change="applyFilters()">
        <!-- ... -->
    </select>
</div>

<!-- ❌ ÉVITER: State global implicite -->
<div x-data="globalState()">
    <select x-model="month">
```

---

## 📱 Responsive Design

### Mobile-First Breakpoints

```html
<!-- ✅ CORRECT: Mobile first, progressive enhancement -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
    <!-- Cards -->
</div>

<div class="block lg:hidden">
    <!-- Vue mobile -->
</div>

<div class="hidden lg:block">
    <!-- Vue desktop -->
</div>

<!-- ❌ ÉVITER: Desktop first -->
<div class="grid-cols-3 md:grid-cols-1">
    <!-- Backwards -->
</div>
```

### Touch Targets

```css
/* ✅ CORRECT: Min 44x44px touch targets (WCAG) */
.button {
    min-height: 44px;
    min-width: 44px;
    padding: 0.75rem 1.5rem;
}

/* ❌ ÉVITER: Touch targets trop petits */
.icon-button {
    width: 24px;
    height: 24px;
}
```

---

## 🧪 Testing Checklist

### Avant Chaque Commit

- [ ] **Fonctionnel:** Toutes les features testées manuellement
- [ ] **Responsive:** Mobile (375px) + Tablet (768px) + Desktop (1440px)
- [ ] **i18n:** FR et EN testés
- [ ] **Accessibilité:** Navigation clavier OK
- [ ] **Performance:** Pas de N+1 queries
- [ ] **Erreurs:** Aucune erreur console browser
- [ ] **Laravel:** `php artisan test` passe (si tests écrits)

### Outils Recommandés

```bash
# Lighthouse audit
lighthouse https://site-darts.test --view

# Accessibility check (WAVE browser extension)
# Ou: pa11y https://site-darts.test

# Performance profiling
php artisan debugbar:publish
```

---

## 🚫 Anti-Patterns à Éviter

### Emojis Comme Icônes Professionnelles

```blade
{{-- ❌ ÉVITER: Emojis sur site pro --}}
<div>
    🎯 Average: {{ $player->avg }}
    🏆 Trophy: PDC
    📅 Date: 15 Jan
</div>

{{-- ✅ UTILISER: SVG icons ou badges --}}
<div>
    <svg class="icon">...</svg>
    Average: {{ $player->avg }}
</div>

<badge variant="primary">PDC</badge>
```

### Devise Hardcodée

```blade
{{-- ❌ ÉVITER: $ pour fléchettes britanniques --}}
Prize: ${{ number_format($prize) }}

{{-- ✅ CORRECT: £ pour darts UK --}}
Prize: £{{ number_format($prize) }}
```

### Line-Height Uniforme

```css
/* ❌ ÉVITER: Même line-height partout */
* {
    line-height: 1.5;
}

/* ✅ CORRECT: Hiérarchie claire */
h1 { line-height: 1.1; }
h2 { line-height: 1.2; }
p { line-height: 1.6; }
```

---

## 📐 Design Tokens (Tailwind v4)

### Couleurs Projet

```css
/* Variables CSS custom (Tailwind v4) */
:root {
    --color-primary: 222.2 47.4% 11.2%;      /* Bleu foncé */
    --color-primary-foreground: 210 40% 98%; /* Blanc cassé */
    --color-accent: 217.2 91.2% 59.8%;       /* Bleu vif */
    --color-muted: 210 40% 96.1%;            /* Gris très clair */
    --color-muted-foreground: 215.4 16.3% 46.9%; /* Gris moyen */
}
```

### Border Radius

```css
/* ✅ Cohérence radius */
--radius-sm: 0.25rem;  /* rounded-sm */
--radius: 0.5rem;      /* rounded-lg (défaut cards) */
--radius-md: 0.375rem; /* rounded-md */
--radius-full: 9999px; /* rounded-full (badges) */
```

---

## 🔗 Ressources & Références

### Patterns Inspirés
- **ESPN.com** - Featured articles hero
- **BBC Sport** - Layout articles
- **FlashScore** - Player cards avec stats
- **PDC.tv** - Calendrier tournois
- **Medium** - Cards guides verticales

### Documentation Technique
- [Laravel 11 Docs](https://laravel.com/docs/11.x)
- [TailwindCSS v4](https://tailwindcss.com)
- [Alpine.js](https://alpinejs.dev)
- [WCAG 2.1 Guidelines](https://www.w3.org/WAI/WCAG21/quickref/)

### Outils Qualité
- **Lighthouse** - Performance & SEO
- **WAVE** - Accessibilité
- **Laravel Debugbar** - Queries N+1
- **Browser DevTools** - Responsive testing

---

## 📝 Template Commit Messages

### Feature
```
feat: Add player photos with elegant initials fallback

- Create initials-fallback component with gradient
- Add photo_url_safe accessor to Player model
- Fix TypeError on null photo_url
- Improve UX with ranking badge

Related: STORY-005
Score UX: 4/10 → 9/10

Co-Authored-By: Claude Sonnet 4.5 <noreply@anthropic.com>
```

### Bug Fix
```
fix: Resolve TypeError htmlspecialchars on Players page

PlayerController was passing nullable photo_url to view causing
TypeError when rendering. Added null coalescing operator.

Before: htmlspecialchars($player->photo_url)
After: htmlspecialchars($player->photo_url ?? '', ENT_QUOTES)

Fixes: #032c7c4
```

### Refactor
```
refactor: Extract player card to reusable Blade component

- Create components/player-card.blade.php
- Props: player, ranking, showStats
- Consistent across all player listings
- DRY principle respected

No functional changes.
```

---

## 🎯 Prochaines Améliorations

### Court Terme
- [ ] Ajouter Schema.org Event markup (SEO)
- [ ] Tests Pest/PHPUnit pour controllers
- [ ] Dark mode optimisé
- [ ] PWA manifest

### Moyen Terme
- [ ] API REST pour calendrier
- [ ] Export iCal (.ics)
- [ ] Notifications push favoris
- [ ] Filtres avancés (prize, venue)

### Long Terme
- [ ] Widget calendrier embeddable
- [ ] Sync Google Calendar
- [ ] Machine Learning prédictions
- [ ] App mobile (React Native)

---

**Dernière mise à jour:** 2026-02-26
**Maintenu par:** BMAD Method v6
**Source:** Consolidation 24 fichiers docs (7900 lignes)
