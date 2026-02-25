# Quick Reference - Composants Blade DartsArena

> Guide de référence rapide pour choisir le bon composant
> Version: 1.0 | Dernière mise à jour: 2026-02-25

---

## Comment Utiliser Ce Guide?

1. **Identifiez votre besoin** dans la colonne "Quand l'utiliser?"
2. **Trouvez le composant** correspondant
3. **Copiez l'exemple** de code
4. **Personnalisez** avec vos données

---

## 🎴 Cards - Conteneurs de Contenu

| Composant | Quand l'utiliser? | Code Minimal |
|-----------|-------------------|--------------|
| `<x-card>` | Conteneur générique simple | `<x-card>Content</x-card>` |
| `<x-card variant="interactive">` | Card cliquable sans image | `<x-card variant="interactive">Content</x-card>` |
| `<x-card variant="dark">` | Sidebar sombre | `<x-card variant="dark">Content</x-card>` |
| `<x-card-interactive>` | Article avec image | `<x-card-interactive href="#" image="..." title="...">Excerpt</x-card-interactive>` |
| `<x-card-dark>` | Sidebar avec header | `<x-card-dark title="Rankings">Content</x-card-dark>` |

**Conseil**: Utilisez `<x-card>` pour 90% des cas, `<x-card-interactive>` pour articles/joueurs.

---

## 📋 Headers - Titres de Sections

| Composant | Quand l'utiliser? | Code Minimal |
|-----------|-------------------|--------------|
| `<x-section-header>` | Titre de section standard | `<x-section-header title="Latest News" />` |
| `<x-section-header>` + actions | Titre avec "View All" | `<x-section-header title="..."><x-slot:actions>...</x-slot:actions></x-section-header>` |
| `<x-section-header-colored>` | Header SEO avec emoji | `<x-section-header-colored title="..." emoji="🏆" bgColor="primary" />` |

**Conseil**: `section-header` pour sections principales, `section-header-colored` pour cards SEO.

---

## 🔘 Buttons & Links - Actions

| Composant | Quand l'utiliser? | Code Minimal |
|-----------|-------------------|--------------|
| `<x-button>` | Formulaire, CTA principal | `<x-button variant="primary">Submit</x-button>` |
| `<x-button variant="secondary">` | Action secondaire | `<x-button variant="secondary">Cancel</x-button>` |
| `<x-button variant="outline">` | Action outline | `<x-button variant="outline">Learn More</x-button>` |
| `<x-link-arrow>` | "View All", "Read more" | `<x-link-arrow href="#">View All</x-link-arrow>` |

**Conseil**: `primary` pour 1 CTA max par section, `link-arrow` pour navigation.

---

## 🏷️ Badges - Indicateurs Visuels

| Composant | Quand l'utiliser? | Code Minimal |
|-----------|-------------------|--------------|
| `<x-badge>` | Label générique | `<x-badge variant="primary">New</x-badge>` |
| `<x-badge-status status="live">` | Statut match (Live, Finished) | `<x-badge-status status="live">Live</x-badge-status>` |
| `<x-badge-status status="success">` | Winner, Success | `<x-badge-status status="success">Winner</x-badge-status>` |
| `<x-badge-category>` | Catégorie article | `<x-badge-category category="results">Results</x-badge-category>` |
| `<x-bullet-indicator>` | Bullet dans liste | `<x-bullet-indicator color="primary" />` |

**Conseil**: `badge-status` pour états, `badge-category` pour types d'articles.

---

## 📐 Layouts - Structures de Page

| Composant | Quand l'utiliser? | Code Minimal |
|-----------|-------------------|--------------|
| `<x-grid-articles>` | Liste d'articles (3 col) | `<x-grid-articles>...</x-grid-articles>` |
| `<x-grid-seo>` | Section SEO (6 cards) | `<x-grid-seo>...</x-grid-seo>` |
| `<x-layout-main-sidebar>` | Page avec sidebar sticky | `<x-layout-main-sidebar><x-slot:main>...</x-slot:main><x-slot:sidebar>...</x-slot:sidebar></x-layout-main-sidebar>` |

**Conseil**: `layout-main-sidebar` pour pages détaillées, `grid-articles` pour listes.

---

## 🎯 Composants Spécialisés - Métier

| Composant | Quand l'utiliser? | Code Minimal |
|-----------|-------------------|--------------|
| `<x-match-result>` | Afficher résultat de match | `<x-match-result player1Name="..." player2Name="..." :player1Score="7" :player2Score="4" />` |
| `<x-upcoming-event>` | Événement dans sidebar | `<x-upcoming-event title="..." venue="..." day="15" month="Dec" />` |
| `<x-ranking-row>` | Ligne de classement | `<x-ranking-row :position="1" playerName="..." movement="up" />` |

**Conseil**: Ces composants encapsulent la logique métier (calcul winner, formatage date).

---

## 🎨 UI Elements - Interface

| Composant | Quand l'utiliser? | Code Minimal |
|-----------|-------------------|--------------|
| `<x-filter-tabs>` | Filtrer contenu par catégorie | `<x-filter-tabs :tabs="['all' => 'All', ...]" active="all" />` |
| `<x-loading-spinner>` | Chargement AJAX | `<x-loading-spinner text="Loading..." />` |

**Conseil**: `filter-tabs` supporte Alpine.js pour interactivité.

---

## 🎯 Guide de Décision Rapide

### "Je veux afficher..."

#### Des articles/news
```blade
<x-grid-articles>
    <x-card-interactive
        href="{{ route('articles.show', $article) }}"
        image="{{ $article->image_url }}"
        title="{{ $article->title }}">
        {{ $article->excerpt }}
    </x-card-interactive>
</x-grid-articles>
```

#### Un résultat de match
```blade
<x-match-result
    competition="PDC World Championship"
    status="finished"
    player1Name="Luke Humphries"
    player2Name="Luke Littler"
    :player1Score="7"
    :player2Score="4"
/>
```

#### Un classement de joueurs
```blade
<x-card-dark title="Rankings">
    <x-ranking-row :position="1" playerName="..." movement="up" />
    <x-ranking-row :position="2" playerName="..." movement="down" />
</x-card-dark>
```

#### Des événements à venir
```blade
<x-card-dark title="Upcoming Events">
    <x-upcoming-event
        title="PDC World Championship"
        venue="Alexandra Palace"
        day="15"
        month="Dec"
    />
</x-card-dark>
```

#### Une page avec sidebar
```blade
<x-layout-main-sidebar>
    <x-slot:main>
        <!-- Contenu principal -->
    </x-slot:main>

    <x-slot:sidebar>
        <!-- Sidebar sticky -->
    </x-slot:sidebar>
</x-layout-main-sidebar>
```

#### Une section avec titre et "View All"
```blade
<x-section-header title="Latest News">
    <x-slot:actions>
        <x-link-arrow href="{{ route('news.index') }}">
            View All
        </x-link-arrow>
    </x-slot:actions>
</x-section-header>
```

---

## 🎨 Variants de Couleurs

### Accent Colors (Headers)
- `accentColor="primary"` → Rouge énergique
- `accentColor="accent"` → Or premium
- `accentColor="secondary"` → Bleu marine

### Button Variants
- `variant="primary"` → CTA principal (rouge)
- `variant="secondary"` → Action secondaire (gris)
- `variant="outline"` → Border primary
- `variant="ghost"` → Transparent

### Badge Status
- `status="live"` → Rouge avec pulse
- `status="finished"` → Vert
- `status="upcoming"` → Ambre
- `status="success"` → Vert
- `status="warning"` → Ambre
- `status="danger"` → Rouge

### Badge Category (Articles)
- `category="results"` → Rouge (primary)
- `category="interview"` → Ambre (warning)
- `category="analysis"` → Bleu (info)
- `category="news"` → Navy (secondary)
- `category="tournament"` → Or (accent)

---

## 📏 Sizes

### Buttons
- `size="sm"` → Petit (px-3 py-1.5)
- `size="md"` → Moyen (px-4 py-2) **[défaut]**
- `size="lg"` → Grand (px-6 py-3)

### Badges
- `size="sm"` → Petit (10px)
- `size="md"` → Moyen (12px) **[défaut]**
- `size="lg"` → Grand (14px)

### Links
- `size="sm"` → text-sm
- `size="base"` → text-base **[défaut]**
- `size="lg"` → text-lg

---

## 🔧 Props Communes

### Tous les composants acceptent:
- `class="..."` → Classes additionnelles (merge avec classes du composant)
- `id="..."` → ID HTML
- `style="..."` → Styles inline (éviter si possible)

### Composants cliquables acceptent:
- `href="#"` → URL de destination
- `target="_blank"` → Ouvrir dans nouvel onglet

### Composants avec slots acceptent:
- `<x-slot:nomSlot>` → Contenu nommé
- `{{ $slot }}` → Contenu par défaut

---

## 💡 Tips & Tricks

### Combiner les composants

**Card interactive avec multiple badges**:
```blade
<x-card-interactive href="#" image="..." title="...">
    <x-slot:category>
        <div class="flex gap-2">
            <x-badge-category category="results">Results</x-badge-category>
            <x-badge-status status="live">Live</x-badge-status>
        </div>
    </x-slot:category>
    Content
</x-card-interactive>
```

**Section header avec multiple actions**:
```blade
<x-section-header title="News">
    <x-slot:actions>
        <x-filter-tabs :tabs="..." />
        <x-link-arrow href="#">View All</x-link-arrow>
    </x-slot:actions>
</x-section-header>
```

**Card dark avec loading**:
```blade
<x-card-dark title="Rankings">
    <div x-data="{ loading: true }" x-init="setTimeout(() => loading = false, 1000)">
        <div x-show="loading">
            <x-loading-spinner text="Loading rankings..." />
        </div>
        <div x-show="!loading">
            <x-ranking-row ... />
        </div>
    </div>
</x-card-dark>
```

---

## 🚨 Erreurs Communes à Éviter

### ❌ Ne pas faire:
```blade
<!-- Valeurs hardcodées -->
<div class="rounded-lg p-8 bg-red-600">

<!-- Variants incorrects -->
<x-button variant="danger"> <!-- danger n'existe pas -->

<!-- Props manquants -->
<x-card-interactive title="..."> <!-- Manque href et image -->

<!-- Slots mal nommés -->
<x-card-interactive>
    <x-slot:actions> <!-- Ce slot n'existe pas -->
</x-card-interactive>
```

### ✅ Faire:
```blade
<!-- Utiliser les composants -->
<x-card>Content with proper design tokens</x-card>

<!-- Variants corrects -->
<x-button variant="secondary">

<!-- Props complets -->
<x-card-interactive href="#" image="..." imageAlt="..." title="...">

<!-- Slots corrects -->
<x-card-interactive>
    <x-slot:category>Badge</x-slot:category>
    <x-slot:meta>Date</x-slot:meta>
</x-card-interactive>
```

---

## 📚 Ressources

### Documentation Complète
- **Guide détaillé**: `docs/COMPONENTS_GUIDE.md` (exemples exhaustifs)
- **Architecture**: `docs/COMPONENTS_ARCHITECTURE.md` (patterns techniques)
- **Design System**: `docs/UX_DESIGN_SYSTEM.md` (tokens, couleurs)

### Démo Interactive
- **Page de démo**: `resources/views/components-demo.blade.php`
- **URL**: `http://localhost:8000/components-demo`

### Code Source
- **Composants**: `resources/views/components/*.blade.php`
- **Chaque composant** contient PHPDoc avec exemples

---

## 🔍 Recherche Rapide

| Je cherche... | Utilise... |
|---------------|------------|
| Conteneur blanc | `<x-card>` |
| Conteneur sombre | `<x-card-dark>` |
| Article avec image | `<x-card-interactive>` |
| Titre de section | `<x-section-header>` |
| Bouton principal | `<x-button variant="primary">` |
| Lien "View All" | `<x-link-arrow>` |
| Badge "Live" | `<x-badge-status status="live">` |
| Catégorie article | `<x-badge-category category="...">` |
| Grid 3 colonnes | `<x-grid-articles>` |
| Page avec sidebar | `<x-layout-main-sidebar>` |
| Résultat match | `<x-match-result>` |
| Événement à venir | `<x-upcoming-event>` |
| Ligne classement | `<x-ranking-row>` |
| Tabs de filtres | `<x-filter-tabs>` |
| Loading | `<x-loading-spinner>` |
| Bullet point | `<x-bullet-indicator>` |

---

**Dernière révision**: 2026-02-25 par Claude Sonnet 4.5
