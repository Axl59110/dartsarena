# Guide des Composants Blade - DartsArena

> Documentation complète des composants réutilisables basés sur le design system
> Version: 1.0 | Dernière mise à jour: 2026-02-25

---

## Table des Matières

1. [Vue d'ensemble](#vue-densemble)
2. [Cards](#cards)
3. [Headers](#headers)
4. [Buttons & Links](#buttons--links)
5. [Badges](#badges)
6. [Grids & Layouts](#grids--layouts)
7. [Composants Spécialisés](#composants-spécialisés)
8. [UI Elements](#ui-elements)

---

## Vue d'ensemble

Tous les composants suivent strictement le design system documenté dans `UX_DESIGN_SYSTEM.md` avec:

- Design tokens (pas de valeurs hardcodées)
- Radius standard: `--radius-base` (6px)
- Padding cards: `p-6`
- Hover + focus states
- Transitions: 200ms par défaut
- Responsive mobile-first
- ARIA pour accessibilité

---

## Cards

### 1. `<x-card>`

Card standard avec variants.

**Props:**
- `variant`: `default|interactive|dark`
- `padding`: Override (défaut: `p-6`)
- `shadow`: Shadow variant (défaut: `shadow-sm`)

**Exemples:**

```blade
{{-- Card standard --}}
<x-card>
    <h3 class="font-display text-xl font-bold mb-4">Title</h3>
    <p class="text-muted-foreground">Content</p>
</x-card>

{{-- Card interactive --}}
<x-card variant="interactive">
    Interactive card avec hover effects
</x-card>

{{-- Card dark pour sidebar --}}
<x-card variant="dark">
    Dark sidebar card
</x-card>
```

---

### 2. `<x-card-interactive>`

Card cliquable avec image, titre, et hover effects.

**Props:**
- `href`: URL du lien
- `image`: URL de l'image
- `imageAlt`: Texte alternatif
- `title`: Titre de la card

**Slots:**
- `category`: Badge de catégorie
- `meta`: Métadonnées (date, auteur)
- Default slot: Contenu/excerpt

**Exemple:**

```blade
<x-card-interactive
    href="{{ route('articles.show', $article) }}"
    image="{{ $article->image_url }}"
    imageAlt="{{ $article->title }}"
    title="{{ $article->title }}">

    <x-slot:category>
        <x-badge-category category="results">
            {{ __('Results') }}
        </x-badge-category>
    </x-slot:category>

    <x-slot:meta>
        <span class="text-sm text-muted-foreground">
            {{ $article->published_at->format('M d, Y') }}
        </span>
    </x-slot:meta>

    {{ $article->excerpt }}
</x-card-interactive>
```

---

### 3. `<x-card-dark>`

Card avec fond sombre pour sidebars.

**Props:**
- `title`: Titre du header
- `headerClass`: Classes additionnelles pour le header

**Exemple:**

```blade
<x-card-dark title="{{ __('Upcoming Events') }}">
    <div class="space-y-3">
        <x-upcoming-event ... />
        <x-upcoming-event ... />
    </div>
</x-card-dark>
```

---

## Headers

### 4. `<x-section-header>`

Header de section avec accent bar.

**Props:**
- `title`: Titre de la section
- `accentColor`: Couleur de l'accent bar (`primary|accent|secondary`)
- `withBorder`: Afficher bordure inférieure (défaut: `true`)
- `spacing`: Espacement inférieur (défaut: `mb-6`)

**Slots:**
- `actions`: Boutons/liens d'action

**Exemples:**

```blade
{{-- Header simple --}}
<x-section-header title="{{ __('Latest News') }}" />

{{-- Header avec actions --}}
<x-section-header title="{{ __('Results') }}">
    <x-slot:actions>
        <x-link-arrow href="{{ route('results.index') }}">
            {{ __('View All') }}
        </x-link-arrow>
    </x-slot:actions>
</x-section-header>

{{-- Accent color custom --}}
<x-section-header
    title="{{ __('Rankings') }}"
    accentColor="accent"
/>
```

---

### 5. `<x-section-header-colored>`

Header avec fond coloré et emoji.

**Props:**
- `title`: Titre du header
- `emoji`: Emoji icon (optionnel)
- `bgColor`: Couleur de fond (`primary|accent|warning|info|success|secondary`)

**Exemple:**

```blade
<x-section-header-colored
    title="{{ __('Top Tournaments') }}"
    emoji="🏆"
    bgColor="primary"
/>
```

---

## Buttons & Links

### 6. `<x-button>`

Bouton avec variants et tailles.

**Props:**
- `variant`: `primary|secondary|outline|ghost`
- `size`: `sm|md|lg`
- `type`: `button|submit|reset`
- `disabled`: État désactivé

**Exemples:**

```blade
{{-- Primary button --}}
<x-button variant="primary" type="submit">
    {{ __('Submit') }}
</x-button>

{{-- Secondary button small --}}
<x-button variant="secondary" size="sm">
    {{ __('Cancel') }}
</x-button>

{{-- Outline button --}}
<x-button variant="outline">
    {{ __('Learn More') }}
</x-button>
```

---

### 7. `<x-link-arrow>`

Lien avec flèche animée.

**Props:**
- `href`: URL du lien
- `size`: Taille du texte (`sm|base|lg`)
- `color`: Classe de couleur (défaut: `text-primary`)

**Exemple:**

```blade
<x-link-arrow href="{{ route('articles.index') }}">
    {{ __('View All Articles') }}
</x-link-arrow>

<x-link-arrow href="#" size="sm">
    {{ __('Read more') }}
</x-link-arrow>
```

---

## Badges

### 8. `<x-badge>`

Badge générique avec variants.

**Props:**
- `variant`: `primary|secondary|accent|muted`
- `size`: `sm|md|lg`

**Exemple:**

```blade
<x-badge variant="primary">{{ __('New') }}</x-badge>
<x-badge variant="accent" size="lg">{{ __('Premium') }}</x-badge>
```

---

### 9. `<x-badge-status>`

Badge pour indicateurs de statut.

**Props:**
- `status`: `success|warning|danger|info|finished|live|upcoming`
- `size`: `sm|md|lg`

**Exemple:**

```blade
<x-badge-status status="live">{{ __('Live') }}</x-badge-status>
<x-badge-status status="finished">{{ __('Finished') }}</x-badge-status>
<x-badge-status status="success">{{ __('Winner') }}</x-badge-status>
```

---

### 10. `<x-badge-category>`

Badge pour catégories d'articles.

**Props:**
- `category`: `results|interview|analysis|news|tournament`
- `position`: `default|overlay`

**Exemple:**

```blade
<x-badge-category category="results">
    {{ __('Results') }}
</x-badge-category>

<x-badge-category category="interview" position="overlay">
    {{ __('Interview') }}
</x-badge-category>
```

---

## Grids & Layouts

### 11. `<x-grid-articles>`

Grid 3 colonnes responsive pour articles.

**Props:**
- `gap`: Espacement (défaut: `gap-4`)
- `cols`: Breakpoints colonnes (défaut: `md:grid-cols-2 lg:grid-cols-3`)

**Exemple:**

```blade
<x-grid-articles>
    @foreach($articles as $article)
        <x-card-interactive ... />
    @endforeach
</x-grid-articles>
```

---

### 12. `<x-grid-seo>`

Grid 6 cards pour sections SEO.

**Props:**
- `gap`: Espacement (défaut: `gap-6`)

**Exemple:**

```blade
<x-grid-seo>
    <x-card>
        <x-section-header-colored title="..." emoji="🏆" />
        <div class="p-6">Content</div>
    </x-card>
    {{-- 5 more cards --}}
</x-grid-seo>
```

---

### 13. `<x-layout-main-sidebar>`

Layout 2/3 main content + 1/3 sticky sidebar.

**Props:**
- `gap`: Espacement (défaut: `gap-6`)
- `stickyTop`: Offset sticky (défaut: `top-24`)

**Slots:**
- `main`: Contenu principal (2/3)
- `sidebar`: Sidebar sticky (1/3)

**Exemple:**

```blade
<x-layout-main-sidebar>
    <x-slot:main>
        {{-- Main content --}}
    </x-slot:main>

    <x-slot:sidebar>
        {{-- Sticky sidebar --}}
        <x-card-dark title="Rankings">...</x-card-dark>
        <x-card-dark title="Events">...</x-card-dark>
    </x-slot:sidebar>
</x-layout-main-sidebar>
```

---

## Composants Spécialisés

### 14. `<x-match-result>`

Affichage de résultat de match avec score.

**Props:**
- `competition`: Nom de la compétition
- `status`: Statut (`finished|live|upcoming`)
- `player1Name`: Nom joueur 1
- `player2Name`: Nom joueur 2
- `player1Score`: Score joueur 1
- `player2Score`: Score joueur 2
- `player1Subtitle`: Sous-titre joueur 1 (ex: "Winner")
- `player2Subtitle`: Sous-titre joueur 2 (ex: "Runner-up")
- `date`: Date du match (optionnel)
- `href`: URL du lien (optionnel)

**Exemple:**

```blade
<x-match-result
    competition="PDC World Championship"
    status="finished"
    player1Name="Luke Humphries"
    player2Name="Luke Littler"
    :player1Score="7"
    :player2Score="4"
    player1Subtitle="{{ __('Winner') }}"
    player2Subtitle="{{ __('Runner-up') }}"
    date="2024-01-03"
    href="{{ route('matches.show', $match) }}"
/>
```

---

### 15. `<x-upcoming-event>`

Affichage d'événement à venir avec date box.

**Props:**
- `title`: Titre de l'événement
- `venue`: Lieu/localisation
- `date`: Date (Carbon instance)
- `day`: Numéro du jour (ex: "15")
- `month`: Mois abrégé (ex: "Mar")
- `href`: URL du lien (optionnel)

**Exemple:**

```blade
<x-upcoming-event
    title="PDC World Championship"
    venue="Alexandra Palace, London"
    day="{{ $event->start_date->format('d') }}"
    month="{{ $event->start_date->format('M') }}"
    href="{{ route('events.show', $event) }}"
/>
```

---

### 16. `<x-ranking-row>`

Ligne de classement avec indicateur de mouvement.

**Props:**
- `position`: Position dans le classement
- `playerName`: Nom du joueur
- `playerNationality`: Code nationalité (optionnel)
- `movement`: Direction (`up|down|same|null`)
- `href`: URL du lien (optionnel)
- `avatar`: URL avatar (optionnel)

**Exemple:**

```blade
<x-ranking-row
    :position="1"
    playerName="Luke Humphries"
    playerNationality="ENG"
    movement="up"
    href="{{ route('players.show', $player) }}"
/>

<x-ranking-row
    :position="2"
    playerName="Michael van Gerwen"
    playerNationality="NED"
    movement="down"
/>
```

---

## UI Elements

### 17. `<x-filter-tabs>`

Tabs de navigation pour filtrage.

**Props:**
- `tabs`: Array de tabs `['value' => 'Label']`
- `active`: Tab actif (optionnel si Alpine.js)
- `xModel`: Nom du modèle Alpine.js (défaut: `activeTab`)

**Exemples:**

```blade
{{-- Tabs statiques --}}
<x-filter-tabs
    :tabs="['all' => 'All', 'results' => 'Results', 'news' => 'News']"
    active="all"
/>

{{-- Avec Alpine.js --}}
<div x-data="{ filter: 'all' }">
    <x-filter-tabs
        :tabs="['all' => 'All', 'pdc' => 'PDC', 'wdf' => 'WDF']"
        xModel="filter"
    />

    <div x-show="filter === 'all'">All content</div>
    <div x-show="filter === 'pdc'">PDC content</div>
</div>
```

---

### 18. `<x-loading-spinner>`

Indicateur de chargement animé.

**Props:**
- `size`: Taille (`sm|md|lg`)
- `text`: Texte de chargement (optionnel)
- `inline`: Affichage inline (défaut: `false`)

**Exemples:**

```blade
{{-- Spinner simple --}}
<x-loading-spinner />

{{-- Avec texte --}}
<x-loading-spinner size="lg" text="{{ __('Loading...') }}" />

{{-- Inline spinner --}}
<x-loading-spinner size="sm" :inline="true" />

{{-- Avec Alpine.js --}}
<div x-show="isLoading">
    <x-loading-spinner text="{{ __('Loading articles...') }}" />
</div>
```

---

### 19. `<x-bullet-indicator>`

Bullet point animé.

**Props:**
- `color`: Couleur (`primary|accent|success|warning|danger|secondary|white`)
- `size`: Taille (`sm|md|lg`)
- `animate`: Animation au hover (défaut: `true`)

**Exemple:**

```blade
{{-- Bullet simple --}}
<x-bullet-indicator color="primary" />

{{-- Dans un lien --}}
<a href="#" class="group flex items-center gap-2">
    <x-bullet-indicator />
    <span>Link text</span>
</a>
```

---

## Exemples d'Usage Complets

### Page Article avec Sidebar

```blade
<x-layout-main-sidebar>
    <x-slot:main>
        <x-section-header title="{{ __('Latest News') }}">
            <x-slot:actions>
                <x-link-arrow href="{{ route('articles.index') }}">
                    {{ __('View All') }}
                </x-link-arrow>
            </x-slot:actions>
        </x-section-header>

        <x-grid-articles>
            @foreach($articles as $article)
                <x-card-interactive
                    href="{{ route('articles.show', $article) }}"
                    image="{{ $article->image_url }}"
                    imageAlt="{{ $article->title }}"
                    title="{{ $article->title }}">

                    <x-slot:category>
                        <x-badge-category :category="$article->category">
                            {{ __($article->category) }}
                        </x-badge-category>
                    </x-slot:category>

                    <x-slot:meta>
                        <span class="text-sm text-muted-foreground">
                            {{ $article->published_at->format('M d, Y') }}
                        </span>
                    </x-slot:meta>

                    {{ $article->excerpt }}
                </x-card-interactive>
            @endforeach
        </x-grid-articles>
    </x-slot:main>

    <x-slot:sidebar>
        <x-card-dark title="{{ __('Upcoming Events') }}">
            <div class="space-y-3">
                @foreach($upcomingEvents as $event)
                    <x-upcoming-event
                        title="{{ $event->title }}"
                        venue="{{ $event->venue }}"
                        day="{{ $event->start_date->format('d') }}"
                        month="{{ $event->start_date->format('M') }}"
                        href="{{ route('events.show', $event) }}"
                    />
                @endforeach
            </div>
        </x-card-dark>

        <x-card-dark title="{{ __('Rankings') }}">
            <div class="space-y-2">
                @foreach($rankings as $ranking)
                    <x-ranking-row
                        :position="$ranking->position"
                        :playerName="$ranking->player->full_name"
                        :playerNationality="$ranking->player->nationality"
                        :movement="$ranking->movement"
                        :href="route('players.show', $ranking->player)"
                    />
                @endforeach
            </div>
        </x-card-dark>
    </x-slot:sidebar>
</x-layout-main-sidebar>
```

---

## Bonnes Pratiques

### 1. Utilisation des Props

Toujours typer les props dans les composants:

```blade
@props([
    'variant' => 'default',  // Avec valeur par défaut
    'title' => '',           // Required (vide par défaut)
    'isActive' => false,     // Boolean
])
```

### 2. Slots Nommés

Utiliser des slots nommés pour la flexibilité:

```blade
<x-card>
    <x-slot:header>Header content</x-slot:header>
    <x-slot:footer>Footer content</x-slot:footer>
    Default slot content
</x-card>
```

### 3. Classes Conditionnelles

Utiliser `match()` pour les variants:

```blade
@php
$classes = match($variant) {
    'dark' => 'bg-darker text-white',
    'interactive' => 'hover:border-primary',
    default => 'bg-card',
};
@endphp
```

### 4. Accessibilité

Toujours inclure:
- ARIA labels pour les icônes (`aria-hidden="true"`)
- Textes alternatifs pour les images
- Focus states (`focus-visible:ring-4`)
- Roles sémantiques (`role="tablist"`, etc.)

### 5. Performance

- Lazy loading pour images: `loading="lazy"`
- Transitions GPU: `transform`, `opacity`
- Éviter `transition: all` (utiliser `transition-colors`, etc.)

---

## Checklist Nouveau Composant

Avant de créer un nouveau composant:

- [ ] Vérifie qu'il n'existe pas déjà
- [ ] Utilise les design tokens (pas de valeurs hardcodées)
- [ ] Radius = `--radius-base` (6px) par défaut
- [ ] Padding cards = `p-6`
- [ ] Hover + focus states présents
- [ ] Transitions définies (200ms par défaut)
- [ ] Responsive (mobile-first)
- [ ] ARIA pour accessibilité
- [ ] PHPDoc avec exemples
- [ ] Testé sur mobile et desktop

---

## Ressources

- **Design System**: `dartsarena/docs/UX_DESIGN_SYSTEM.md`
- **CSS Tokens**: `dartsarena/resources/css/app.css`
- **Layout Principal**: `dartsarena/resources/views/layouts/app.blade.php`
- **Composants**: `dartsarena/resources/views/components/`

---

**Dernière révision**: 2026-02-25 par Claude Sonnet 4.5
