# Composants Blade - DartsArena

## Index des Composants

Tous les composants suivent le design system documenté dans `docs/UX_DESIGN_SYSTEM.md`.

### Cards (3 composants)
- `<x-card>` - Card standard avec variants (default, interactive, dark)
- `<x-card-interactive>` - Card cliquable avec image et hover effects
- `<x-card-dark>` - Card avec fond sombre pour sidebars

### Headers (2 composants)
- `<x-section-header>` - Header avec accent bar
- `<x-section-header-colored>` - Header avec fond coloré et emoji

### Buttons & Links (2 composants)
- `<x-button>` - Bouton avec variants (primary, secondary, outline, ghost)
- `<x-link-arrow>` - Lien avec flèche animée

### Badges (3 composants)
- `<x-badge>` - Badge générique avec variants
- `<x-badge-status>` - Badge de statut (success, warning, danger, live, finished)
- `<x-badge-category>` - Badge de catégorie d'article

### Layouts (3 composants)
- `<x-grid-articles>` - Grid 3 colonnes responsive pour articles
- `<x-grid-seo>` - Grid 6 cards pour sections SEO
- `<x-layout-main-sidebar>` - Layout 2/3 main content + 1/3 sticky sidebar

### Composants Spécialisés (3 composants)
- `<x-match-result>` - Affichage de résultat de match avec score
- `<x-upcoming-event>` - Événement à venir avec date box
- `<x-ranking-row>` - Ligne de classement avec indicateur de mouvement

### UI Elements (3 composants)
- `<x-filter-tabs>` - Tabs de filtres avec support Alpine.js
- `<x-loading-spinner>` - Spinner de chargement animé
- `<x-bullet-indicator>` - Bullet point animé

---

## Total: 19 Composants

Documentation complète disponible dans `docs/COMPONENTS_GUIDE.md`

## Usage Rapide

```blade
{{-- Card avec contenu --}}
<x-card>
    <h3>Title</h3>
    <p>Content</p>
</x-card>

{{-- Article interactif --}}
<x-card-interactive
    href="/article"
    image="/image.jpg"
    imageAlt="Alt text"
    title="Article Title">
    Article excerpt...
</x-card-interactive>

{{-- Layout main + sidebar --}}
<x-layout-main-sidebar>
    <x-slot:main>Main content</x-slot:main>
    <x-slot:sidebar>Sidebar content</x-slot:sidebar>
</x-layout-main-sidebar>

{{-- Match result --}}
<x-match-result
    competition="PDC World Championship"
    status="finished"
    player1Name="Player 1"
    player2Name="Player 2"
    :player1Score="7"
    :player2Score="4"
/>
```

## Design Tokens Utilisés

- Radius: `--radius-base` (6px)
- Padding: `p-6` pour cards
- Colors: `primary`, `accent`, `secondary`, `success`, `warning`, `danger`
- Transitions: 200ms par défaut
- Shadows: `shadow-sm` pour cards, `shadow-md` pour hover

## Bonnes Pratiques

1. Utiliser les design tokens (pas de valeurs hardcodées)
2. Toujours inclure hover + focus states
3. Responsive mobile-first
4. ARIA pour accessibilité
5. Lazy loading pour images
6. Transitions GPU-accelerated (transform, opacity)

---

Pour la documentation complète avec tous les exemples, voir `docs/COMPONENTS_GUIDE.md`
