# 🎯 Composants Blade DartsArena - Guide de Démarrage

> Système complet de 19 composants réutilisables basés sur le design system
> Date: 2026-02-25

---

## 🚀 Démarrage Rapide

### 1. Voir la Démo Interactive

```bash
php artisan serve
```

Puis ouvrir: **http://localhost:8000/components-demo**

### 2. Utiliser un Composant

```blade
{{-- Simple card --}}
<x-card>
    <h3 class="font-display text-xl font-bold">Titre</h3>
    <p class="text-muted-foreground">Contenu</p>
</x-card>

{{-- Article avec image --}}
<x-card-interactive
    href="{{ route('articles.show', $article) }}"
    image="{{ $article->image_url }}"
    imageAlt="{{ $article->title }}"
    title="{{ $article->title }}">
    {{ $article->excerpt }}
</x-card-interactive>
```

---

## 📦 Composants Disponibles (19)

### 🎴 Cards (3)
- `<x-card>` - Conteneur standard
- `<x-card-interactive>` - Card cliquable avec image
- `<x-card-dark>` - Card sombre pour sidebar

### 📋 Headers (2)
- `<x-section-header>` - Titre avec accent bar
- `<x-section-header-colored>` - Titre avec fond coloré + emoji

### 🔘 Buttons & Links (2)
- `<x-button>` - Bouton (primary, secondary, outline, ghost)
- `<x-link-arrow>` - Lien avec flèche animée

### 🏷️ Badges (4)
- `<x-badge>` - Badge générique
- `<x-badge-status>` - Badge de statut (live, finished, success)
- `<x-badge-category>` - Badge de catégorie d'article
- `<x-bullet-indicator>` - Bullet point animé

### 📐 Layouts (3)
- `<x-grid-articles>` - Grid 3 colonnes
- `<x-grid-seo>` - Grid 6 cards SEO
- `<x-layout-main-sidebar>` - Layout main + sidebar sticky

### 🎯 Composants Spécialisés (3)
- `<x-match-result>` - Résultat de match avec score
- `<x-upcoming-event>` - Événement à venir
- `<x-ranking-row>` - Ligne de classement

### 🎨 UI Elements (2)
- `<x-filter-tabs>` - Tabs de filtres
- `<x-loading-spinner>` - Spinner de chargement

---

## 📚 Documentation

### Guide Rapide
📄 **COMPONENTS_QUICK_REFERENCE.md** - Référence rapide avec exemples

### Guide Complet
📄 **docs/COMPONENTS_GUIDE.md** - Documentation exhaustive de tous les composants

### Architecture
📄 **docs/COMPONENTS_ARCHITECTURE.md** - Patterns techniques et organisation

### Design System
📄 **docs/UX_DESIGN_SYSTEM.md** - Tokens, couleurs, espacements

### Index Visuel
📄 **COMPONENTS_INDEX.md** - Vue d'ensemble ASCII des composants

---

## 🎨 Exemple Complet: Page Article

```blade
<x-layout-main-sidebar>
    {{-- Main Content (2/3) --}}
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

    {{-- Sidebar (1/3) --}}
    <x-slot:sidebar>
        {{-- Rankings --}}
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

        {{-- Upcoming Events --}}
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
    </x-slot:sidebar>
</x-layout-main-sidebar>
```

---

## ✨ Caractéristiques

### Design System
- ✅ 100% conformité au design system
- ✅ Design tokens (couleurs OKLCH, espacements, radius)
- ✅ Pas de valeurs hardcodées

### Responsive
- ✅ Mobile-first design
- ✅ Breakpoints: sm (640px), md (768px), lg (1024px), xl (1280px)
- ✅ Grids adaptatives

### Accessibilité
- ✅ ARIA attributes sur tous les composants
- ✅ Focus states (ring-4)
- ✅ Keyboard navigation
- ✅ Screen reader friendly

### Performance
- ✅ Images lazy loading
- ✅ GPU-accelerated transitions
- ✅ CSS custom properties
- ✅ Pas de JavaScript requis (sauf Alpine.js optionnel)

### Developer Experience
- ✅ PHPDoc complet avec exemples
- ✅ Props avec valeurs par défaut
- ✅ Slots nommés pour flexibilité
- ✅ API cohérente

---

## 🔧 Props Communes

### Variants
```blade
variant="primary|secondary|outline|ghost"
```

### Sizes
```blade
size="sm|md|lg"
```

### Colors
```blade
color="primary|accent|secondary|success|warning|danger"
accentColor="primary|accent|secondary"
bgColor="primary|accent|info|success|warning|secondary"
```

### Status
```blade
status="live|finished|upcoming|success|warning|danger|info"
```

---

## 🎯 Guide de Sélection Rapide

| Je veux... | J'utilise... |
|------------|--------------|
| Un conteneur blanc | `<x-card>` |
| Un article avec image | `<x-card-interactive>` |
| Une sidebar sombre | `<x-card-dark>` |
| Un titre de section | `<x-section-header>` |
| Un bouton principal | `<x-button variant="primary">` |
| Un lien "View All" | `<x-link-arrow>` |
| Un badge "Live" | `<x-badge-status status="live">` |
| Une grille d'articles | `<x-grid-articles>` |
| Une page avec sidebar | `<x-layout-main-sidebar>` |
| Un résultat de match | `<x-match-result>` |

---

## 📊 Statistiques

```
Total composants:        19
Total lignes de code:    ~1027 lignes
Moyenne par composant:   54 lignes
Documentation:           5 fichiers (52K)
Design system:           100% compliance
```

---

## 🛠️ Développement

### Structure des Fichiers
```
dartsarena/
├── resources/views/
│   ├── components/              # 19 composants .blade.php
│   │   └── README.md           # Index des composants
│   └── components-demo.blade.php # Page de démo
├── docs/
│   ├── COMPONENTS_GUIDE.md
│   ├── COMPONENTS_ARCHITECTURE.md
│   ├── COMPONENTS_QUICK_REFERENCE.md
│   └── UX_DESIGN_SYSTEM.md
├── COMPONENTS_INDEX.md          # Vue ASCII
├── COMPONENTS_SUMMARY.md        # Résumé projet
└── COMPOSANTS_README.md         # Ce fichier
```

### Ajouter un Nouveau Composant

1. **Créer le fichier**
   ```
   resources/views/components/mon-composant.blade.php
   ```

2. **Structure minimale**
   ```blade
   {{-- PHPDoc comments avec exemples --}}
   @props(['variant' => 'default'])

   @php
   $classes = match($variant) {
       default => 'base-classes',
   };
   @endphp

   <div {{ $attributes->merge(['class' => $classes]) }}>
       {{ $slot }}
   </div>
   ```

3. **Documenter**
   - Ajouter dans `COMPONENTS_GUIDE.md`
   - Mettre à jour `components/README.md`
   - Ajouter exemple dans `components-demo.blade.php`

---

## 🎓 Bonnes Pratiques

### À Faire ✅
- Utiliser les design tokens (pas de valeurs hardcodées)
- Toujours inclure hover + focus states
- Props avec valeurs par défaut
- PHPDoc avec exemples
- ARIA attributes pour accessibilité
- Responsive mobile-first

### À Éviter ❌
- Valeurs CSS hardcodées
- Plus de 8 props par composant
- Logique métier complexe dans les composants
- `transition: all` (utiliser `transition-colors`, etc.)
- Oublier les focus states

---

## 🚀 Prochaines Étapes

### 1. Tester la Démo
```bash
php artisan serve
# Ouvrir: http://localhost:8000/components-demo
```

### 2. Remplacer le HTML Existant
Identifier les vues avec code répétitif et remplacer par les composants:
- `resources/views/home.blade.php`
- `resources/views/articles/*.blade.php`
- `resources/views/players/*.blade.php`

### 3. Créer des Composants Additionnels (Roadmap)
- [ ] Modal
- [ ] Dropdown
- [ ] Alert/Notification
- [ ] Pagination
- [ ] Breadcrumb
- [ ] Table responsive
- [ ] Form inputs

---

## 📞 Support

### Documentation
- 📖 Guide complet: `docs/COMPONENTS_GUIDE.md`
- 📖 Référence rapide: `COMPONENTS_QUICK_REFERENCE.md`
- 📖 Architecture: `docs/COMPONENTS_ARCHITECTURE.md`

### Démo
- 🎨 Page démo: http://localhost:8000/components-demo
- 💻 Code démo: `resources/views/components-demo.blade.php`

### Design System
- 🎨 Tokens: `docs/UX_DESIGN_SYSTEM.md`
- 💻 CSS: `resources/css/app.css`

---

## 🎉 Conclusion

Le système de composants DartsArena est maintenant **prêt pour la production** avec:

✅ 19 composants réutilisables
✅ 100% conformité design system
✅ Documentation exhaustive (52K)
✅ Page de démonstration interactive
✅ Architecture extensible
✅ Best practices Laravel Blade

**Bon développement!** 🚀

---

**Version**: 1.0
**Date**: 2026-02-25
**Développé par**: Claude Sonnet 4.5
**Basé sur**: Design System UX_DESIGN_SYSTEM.md v2.0
