# DartsArena - Design System & UX Guidelines

> Document de référence pour le design system et les règles UX/UI du projet DartsArena
> Version: 2.0 | Dernière mise à jour: 2026-02-25

---

## Table des Matières

1. [Vue d'ensemble](#vue-densemble)
2. [Design Tokens](#design-tokens)
3. [Composants Réutilisables](#composants-réutilisables)
4. [Patterns UX](#patterns-ux)
5. [Règles d'Usage](#règles-dusage)

---

## Vue d'ensemble

### Philosophy

DartsArena suit un design **sportif moderne premium** inspiré d'ESPN, Sky Sports, et DAZN avec :

- ✅ **Palette énergique** : Red/Gold/Navy pour dynamisme et professionnalisme
- ✅ **Typographie impact** : Inter Tight pour display, Inter pour body
- ✅ **Composants cohérents** : Design system unifié et réutilisable
- ✅ **Responsive mobile-first** : Optimisé pour tous les écrans
- ✅ **Accessibilité** : ARIA, focus states, keyboard navigation

### Principes Clés

1. **Cohérence** : Même apparence partout (tokens, spacing, colors)
2. **Performance** : CSS custom properties, transitions GPU, lazy loading
3. **Clarté** : Hiérarchie visuelle claire, affordances évidentes
4. **Adaptabilité** : Mobile-first, responsive, progressive enhancement

---

## Design Tokens

### 1. Couleurs (OKLCH)

#### Palette de Marque

```css
/* Primary - Red energique (ESPN style) */
--color-primary: oklch(58% 0.24 25);
--color-primary-hover: oklch(48% 0.22 25);
--color-primary-foreground: oklch(100% 0 0);

/* Accent - Gold premium */
--color-accent: oklch(72% 0.14 80);
--color-accent-hover: oklch(62% 0.12 75);
--color-accent-foreground: oklch(18% 0.02 264);

/* Secondary - Navy professionnel */
--color-secondary: oklch(28% 0.04 250);
--color-secondary-foreground: oklch(100% 0 0);
```

#### Couleurs Sémantiques

```css
/* Background & Surfaces */
--color-background: oklch(96% 0.003 264);    /* Gris très clair */
--color-foreground: oklch(18% 0.02 264);     /* Texte sombre */
--color-card: oklch(100% 0 0);               /* Blanc pur */
--color-card-border: oklch(88% 0.01 264);    /* Bordure grise */
--color-muted: oklch(94% 0.005 264);         /* Sections grises */

/* Dark backgrounds (sidebars) */
--color-darker: oklch(18% 0.02 264);
--color-darker-elevated: oklch(22% 0.025 264);

/* Status Colors */
--color-success: oklch(62% 0.18 145);        /* Vert */
--color-warning: oklch(68% 0.15 75);         /* Ambre */
--color-danger: oklch(56% 0.22 25);          /* Rouge */
--color-info: oklch(58% 0.16 240);           /* Bleu */
```

#### Usage

| Couleur | Utilisation |
|---------|-------------|
| `primary` | CTA, liens actifs, accents principaux |
| `accent` | Highlights secondaires, rankings, badges premium |
| `secondary` | Footer, sections sombres, nav items |
| `success` | Winners, mouvements positifs (↑) |
| `danger` | Mouvements négatifs (↓) |
| `muted` | Backgrounds sections, états inactifs |

### 2. Typographie

#### Fonts

```css
--font-display: "Inter Tight", sans-serif;  /* Headings */
--font-sans: "Inter", sans-serif;           /* Body text */
--font-mono: "JetBrains Mono", monospace;   /* Code */
```

#### Échelle

| Classe | Taille | Usage |
|--------|--------|-------|
| `text-xs` | 12px | Labels, badges |
| `text-sm` | 14px | Body small, links |
| `text-base` | 16px | Body standard |
| `text-lg` | 18px | Lead paragraphs |
| `text-xl` | 20px | Subtitles |
| `text-2xl` | 24px | Section headers |
| `text-3xl` | 30px | Page titles |
| `text-4xl` | 36px | Hero scores |
| `text-5xl` | 48px | Hero headlines |

#### Weights

```css
font-normal: 400;    /* Body text */
font-semibold: 600;  /* Emphasized text */
font-bold: 700;      /* Headings */
font-black: 900;     /* Display headings */
```

#### Line Heights

```css
leading-tight: 1.25;    /* Titres compacts */
leading-snug: 1.375;    /* Subtitles */
leading-relaxed: 1.625; /* Paragraphes */
leading-none: 1;        /* Scores/chiffres */
```

### 3. Espacements

#### Padding/Margin System

```css
/* Sections */
py-8 lg:py-12        /* Sections principales */
py-12 lg:py-16       /* Sections SEO/Footer */

/* Cards */
p-6                  /* Card content standard */
px-5 py-4            /* Card headers */
px-4 py-2            /* Buttons */

/* Gaps (Flexbox/Grid) */
gap-2                /* Éléments serrés (badges) */
gap-3                /* Standard (list items) */
gap-4                /* Cards grid */
gap-6                /* Section grid */
gap-8                /* Hero grid */
```

#### Container

```css
--container-padding: clamp(1rem, 2vw, 2rem);
max-width: 1280px;
```

### 4. Bordures & Radius

#### Radius

```css
--radius-sm: 0.125rem;   /* 2px - Micro */
--radius-md: 0.25rem;    /* 4px - Tags */
--radius-base: 0.375rem; /* 6px - STANDARD */
--radius-lg: 0.5rem;     /* 8px - Large */
--radius-xl: 0.625rem;   /* 10px - Hero */
--radius-full: 9999px;   /* Cercles */
```

**⚠️ Standard = 6px (`--radius-base`)** - À utiliser pour 95% des composants

#### Borders

```css
/* Widths */
border: 1px;         /* Standard */
border-2: 2px;       /* Strong */
border-l-3: 3px;     /* Accent bars */
border-l-4: 4px;     /* Strong accent */

/* Colors */
border-border        /* Défaut */
border-card-border   /* Cards */
border-primary       /* Accents */
```

### 5. Ombres

```css
--shadow-xs: 0 1px 2px 0 rgb(0 0 0 / 0.05);
--shadow-sm: 0 1px 3px 0 rgb(0 0 0 / 0.1);
--shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
--shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
--shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1);

/* Glow effects */
--shadow-glow-primary: 0 0 40px -10px oklch(58% 0.24 25 / 0.5);
```

**Usage**: Cards par défaut → `shadow-sm`, hover → `shadow-md`, modals → `shadow-lg`

### 6. Animations

```css
/* Durées */
--duration-fast: 150ms;
--duration-base: 200ms;
--duration-slow: 300ms;

/* Easings */
--ease-in-out: cubic-bezier(0.4, 0, 0.2, 1);
--ease-spring: cubic-bezier(0.16, 1, 0.3, 1);

/* Transitions */
transition-colors: color, background-color 200ms;
transition-all: all 200ms;
transition-transform: transform 300ms;
```

**Animations spéciales** :
- `animate-pulse` : Live indicator
- `animate-spin` : Loading spinner
- `group-hover:scale-[1.02]` : Image zoom

---

## Composants Réutilisables

### 1. Cards

#### Card Standard

```blade
<div class="bg-card rounded-[var(--radius-base)] border border-card-border p-6 shadow-sm">
    <h3 class="font-display text-xl font-bold mb-4">Title</h3>
    <p class="text-muted-foreground">Content</p>
</div>
```

**Usage** : Latest News, Recent Results, conteneurs génériques

#### Card Interactive

```blade
<a href="#" class="group bg-card border border-card-border rounded-[var(--radius-base)]
    overflow-hidden hover:border-primary hover:shadow-md transition-all">
    <div class="aspect-[16/9] bg-muted group-hover:scale-[1.02] transition-transform duration-300">
        <img src="..." alt="..." class="w-full h-full object-cover" />
    </div>
    <div class="p-4">
        <h3 class="font-display font-bold group-hover:text-primary transition-colors">Title</h3>
    </div>
</a>
```

**Usage** : Article cards, player cards, clickable items

#### Card Dark (Sidebar)

```blade
<section class="bg-darker rounded-[var(--radius-base)] overflow-hidden shadow-lg">
    <div class="px-5 py-4 border-b border-primary/30">
        <h3 class="font-display text-xl font-bold text-white">Title</h3>
    </div>
    <div class="p-5 space-y-3">
        <!-- Content avec text-white -->
    </div>
</section>
```

**Usage** : Sidebars (Upcoming Events, Rankings)

### 2. Section Headers

#### Header avec Accent Bar

```blade
<div class="flex items-center gap-3 mb-6 pb-4 border-b border-border">
    <div class="w-1 h-8 bg-primary"></div>
    <h2 class="font-display text-2xl font-bold tracking-tight">{{ __('Title') }}</h2>
</div>
```

**Variations** :
- Accent bar : `bg-primary`, `bg-accent`, `bg-secondary`
- Avec bouton : Ajouter `justify-between` + bouton "View All"

#### Header Coloré (SEO Cards)

```blade
<div class="bg-primary/5 border-b border-card-border px-6 py-4">
    <h3 class="font-display text-lg font-bold text-foreground flex items-center gap-2">
        <span class="text-2xl">🏆</span>
        {{ __('Title') }}
    </h3>
</div>
```

**Backgrounds** : `primary/5`, `accent/5`, `warning/5`, `info/5`, `success/5`, `secondary/5`

### 3. Boutons & Liens

#### Button Primary

```blade
<button class="px-4 py-2 bg-primary text-primary-foreground rounded-[var(--radius-base)]
    text-sm font-semibold hover:bg-primary-hover transition-colors
    disabled:opacity-50 disabled:pointer-events-none">
    {{ __('Click Me') }}
</button>
```

#### Button Secondary

```blade
<button class="px-4 py-2 bg-muted text-foreground rounded-[var(--radius-base)]
    text-sm font-semibold hover:bg-muted/80 transition-colors">
    {{ __('Secondary') }}
</button>
```

#### Link avec Arrow

```blade
<a href="#" class="text-primary font-semibold hover:text-primary-hover
    flex items-center gap-1 group">
    {{ __('View All') }}
    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform"
        fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
    </svg>
</a>
```

### 4. Badges & Tags

#### Category Badge

```blade
<span class="inline-flex px-2 py-1 text-xs font-bold bg-white/90 backdrop-blur-sm
    rounded-[var(--radius-base)] text-primary">
    {{ __('Results') }}
</span>
```

**Colors par catégorie** :
- `results` → `text-primary`
- `interview` → `text-warning`
- `analysis` → `text-info`
- `news` → `text-secondary`

#### Status Badge

```blade
<span class="inline-flex px-2 py-1 bg-success/10 text-success text-xs font-semibold
    rounded-[var(--radius-base)]">
    {{ __('Finished') }}
</span>
```

#### Bullet Indicator

```blade
<span class="w-1.5 h-1.5 bg-primary rounded-full group-hover:scale-125
    transition-transform flex-shrink-0"></span>
```

### 5. Grids & Layouts

#### Article Grid (3 colonnes)

```blade
<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
    <!-- Article cards -->
</div>
```

#### Main Content Layout (2/3 + 1/3)

```blade
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
        <!-- Main content -->
    </div>
    <aside class="space-y-6 lg:sticky lg:top-24 lg:self-start">
        <!-- Sidebar -->
    </aside>
</div>
```

#### SEO Grid (6 cards)

```blade
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- 6 card boxes -->
</div>
```

### 6. Composants Spécialisés

#### Match Result

```blade
<div class="bg-card border border-card-border rounded-[var(--radius-base)] overflow-hidden">
    <!-- Header -->
    <div class="px-4 py-2 bg-muted/50 border-b border-border flex items-center justify-between">
        <span class="text-sm font-bold truncate">{{ $match->competition->name }}</span>
        <span class="inline-flex px-2 py-1 bg-success/10 text-success text-xs font-semibold rounded-[var(--radius-base)]">
            {{ __('Finished') }}
        </span>
    </div>

    <!-- Match Result -->
    <div class="p-4">
        <div class="flex items-center justify-between gap-4">
            <!-- Winner -->
            <div class="flex-1">
                <p class="font-display font-bold">{{ $player1->name }}</p>
                <p class="text-xs text-success font-semibold">{{ __('Winner') }}</p>
            </div>

            <!-- Score -->
            <div class="flex items-center gap-2">
                <span class="font-display text-4xl font-bold text-primary">7</span>
                <span class="text-xl text-muted-foreground">-</span>
                <span class="font-display text-3xl font-bold text-muted-foreground">3</span>
            </div>

            <!-- Loser -->
            <div class="flex-1 text-right">
                <p class="font-display font-bold text-muted-foreground">{{ $player2->name }}</p>
                <p class="text-xs text-muted-foreground font-semibold">{{ __('Runner-up') }}</p>
            </div>
        </div>
    </div>
</div>
```

#### Upcoming Event

```blade
<div class="flex gap-3 pb-3 border-b border-white/10 last:border-0 hover:bg-white/5
    -mx-2 px-3 py-2 rounded-[var(--radius-base)] transition-colors">
    <!-- Date Box -->
    <div class="flex-shrink-0 text-center bg-primary rounded-[var(--radius-base)] p-2 min-w-[48px]">
        <div class="text-xs font-bold text-white uppercase">{{ $event->start_date->format('M') }}</div>
        <div class="text-xl font-display font-black text-white">{{ $event->start_date->format('d') }}</div>
    </div>

    <!-- Details -->
    <div class="flex-1 min-w-0">
        <h4 class="font-display font-bold text-sm text-white line-clamp-2">{{ $event->title }}</h4>
        <p class="text-xs text-white/85">{{ $event->venue }}</p>
    </div>
</div>
```

#### Ranking Row

```blade
<a href="{{ route('players.show', $player->slug) }}"
    class="flex items-center gap-3 py-2 px-3 hover:bg-white/5 border-l-2
    border-transparent hover:border-accent transition-all group -mx-3 rounded-[var(--radius-base)]">

    <!-- Position Badge -->
    <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center
        bg-accent/20 rounded-[var(--radius-base)] font-display text-sm font-bold text-accent">
        {{ $ranking->position }}
    </div>

    <!-- Player Info -->
    <div class="flex-1 min-w-0">
        <p class="font-display font-bold text-sm text-white group-hover:text-accent transition-colors truncate">
            {{ $player->full_name }}
        </p>
        <p class="text-xs text-white/80 font-semibold uppercase">{{ $player->nationality }}</p>
    </div>

    <!-- Movement Indicator -->
    @if($ranking->movement === 'up')
        <svg class="w-4 h-4 text-success" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" />
        </svg>
    @endif
</a>
```

---

## Patterns UX

### 1. Navigation

#### Desktop Navigation

```blade
<a href="#" class="px-4 py-2.5 text-sm font-semibold rounded-[var(--radius-md)]
    transition-all focus-visible:ring-4 focus-visible:ring-primary/50
    {{ $active ? 'bg-primary text-primary-foreground' : 'hover:bg-muted' }}">
    {{ __('Link') }}
</a>
```

#### Mobile Navigation

```blade
<a href="#" class="px-4 py-3 text-base font-semibold rounded-[var(--radius-base)]
    transition-colors
    {{ $active ? 'bg-primary/10 text-primary border border-primary/30' : 'hover:bg-muted' }}">
    {{ __('Link') }}
</a>
```

### 2. Filter Tabs

```blade
<div class="flex flex-wrap gap-2 mb-4" role="tablist">
    <button @click="filter = 'all'"
        :class="filter === 'all' ? 'bg-primary text-primary-foreground' : 'bg-muted hover:bg-muted/80'"
        class="px-4 py-2 rounded-[var(--radius-base)] text-sm font-semibold
        transition-colors disabled:opacity-50"
        role="tab">
        {{ __('All') }}
    </button>
</div>
```

### 3. Loading States

```blade
<div x-show="isLoading" class="flex items-center gap-2 text-sm text-muted-foreground">
    <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
    </svg>
    <span>{{ __('Loading...') }}</span>
</div>
```

### 4. Hover States

#### Card Hover

```
Border: transparent → primary
Shadow: sm → md
Image: scale(1) → scale(1.02)
Text: foreground → primary
Duration: 200-300ms
```

#### Link Hover

```
Color: primary → primary-hover
Gap: gap-1 → gap-3 (arrow drift)
Transform: translateX(0) → translateX(4px)
```

### 5. Responsive Breakpoints

```
Mobile first:
  sm: 640px   - Tablets
  md: 768px   - Medium tablets
  lg: 1024px  - Desktop
  xl: 1280px  - Large desktop

Patterns:
  grid-cols-1 md:grid-cols-2 lg:grid-cols-3
  py-8 lg:py-12
  text-2xl lg:text-3xl
  hidden md:block
```

---

## Règles d'Usage

### 1. Hiérarchie des Couleurs

**Priority Order** :
1. `primary` pour CTAs et actions principales
2. `accent` pour highlights secondaires
3. `muted` pour backgrounds neutres
4. Status colors (`success`, `danger`) pour feedback

**Ne jamais** :
- ❌ Utiliser `primary` ET `accent` côte à côte
- ❌ Plus de 3 couleurs dans un même composant
- ❌ Texte coloré sans contraste suffisant (min 4.5:1)

### 2. Espacement Cohérent

**Règle du 4px** : Tous les espacements sont multiples de 4px

```
0.5 = 2px
1 = 4px
2 = 8px
3 = 12px
4 = 16px
6 = 24px
8 = 32px
```

**Padding Cards** : Toujours `p-6` (24px) pour cohérence

### 3. Typographie

**Headers** :
- Toujours `font-display` + `font-bold` minimum
- `tracking-tight` pour text-2xl et plus
- `leading-tight` pour économiser l'espace vertical

**Body** :
- `font-sans` + `font-normal`
- `leading-relaxed` pour lisibilité
- `text-base` (16px) minimum pour contenu principal

### 4. Interactions

**Tous les éléments cliquables doivent avoir** :
- ✅ Hover state (color, shadow, ou transform)
- ✅ Focus ring (`ring-4 ring-primary/50`)
- ✅ Transition (`transition-colors` minimum)
- ✅ Cursor pointer (automatique sur liens/buttons)

**Durées** :
- 150ms : Micro-interactions (hover sur texte)
- 200ms : Standard (color changes)
- 300ms+ : Animations visibles (scale, slide)

### 5. Responsive

**Mobile First** :
- Toujours designer pour mobile d'abord
- Ajouter breakpoints `lg:` pour desktop
- Touch targets minimum 44x44px
- Padding mobile augmenté (`px-4` → `lg:px-6`)

**Grid Patterns** :
```blade
<!-- Standard 3-col grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6">

<!-- Main + Sidebar -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2"><!-- Main --></div>
    <aside><!-- Sidebar --></aside>
</div>
```

### 6. Accessibilité

**ARIA obligatoire pour** :
- Navigation (`role="navigation"`)
- Tabs (`role="tablist"`, `role="tab"`, `aria-selected`)
- Dropdowns (`aria-expanded`, `aria-hidden`)
- Icons décoratifs (`aria-hidden="true"`)

**Focus Management** :
- Focus visible sur tous les interactifs
- Focus trap dans modals/menus
- Skip links pour navigation clavier

### 7. Performance

**Images** :
- Lazy loading par défaut (`loading="lazy"`)
- Placeholder fallback (SVG ou gradient)
- `aspect-[16/9]` pour éviter layout shift

**Transitions** :
- GPU-accelerated properties (transform, opacity)
- Éviter `transition: all` sauf nécessaire
- `will-change` seulement si problème perfs

---

## Checklist de Validation

Avant de committer un nouveau composant :

- [ ] Utilise les design tokens (pas de valeurs hardcodées)
- [ ] Radius = `--radius-base` (6px) par défaut
- [ ] Padding cards = `p-6`
- [ ] Hover + focus states présents
- [ ] Transitions définies (200ms par défaut)
- [ ] Responsive (mobile-first)
- [ ] ARIA pour accessibilité
- [ ] Cohérent avec composants existants
- [ ] Testé sur mobile et desktop

---

## Ressources

- **Fichiers sources** :
  - `dartsarena/resources/css/app.css` - Design system complet
  - `dartsarena/resources/views/layouts/app.blade.php` - Layout principal
  - `dartsarena/resources/views/home.blade.php` - Référence composants

- **Inspirations** :
  - ESPN.com - Navigation, hero sections
  - SkyBet - Sidebar rankings, live scores
  - DAZN - Card designs, typography

---

**Dernière révision** : 2026-02-25 par Claude Sonnet 4.5
