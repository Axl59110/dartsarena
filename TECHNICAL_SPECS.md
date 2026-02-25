# Spécifications Techniques - Calendrier DartsArena

## Architecture Backend

### Model: CalendarEvent

**Fichier**: `app/Models/CalendarEvent.php`

```php
class CalendarEvent extends Model
{
    use HasTranslations;

    protected $fillable = [
        'competition_id',
        'season_id',
        'title',
        'start_date',
        'end_date',
        'venue',
        'location',
        'ticket_url',
        'tv_channel'
    ];

    public $translatable = ['title'];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    // Relations
    public function competition() {
        return $this->belongsTo(Competition::class);
    }

    public function season() {
        return $this->belongsTo(Season::class);
    }
}
```

### Migration: calendar_events

**Fichier**: `database/migrations/2026_02_22_192341_create_calendar_events_table.php`

```php
Schema::create('calendar_events', function (Blueprint $table) {
    $table->id();
    $table->foreignId('competition_id')->nullable()->constrained()->nullOnDelete();
    $table->foreignId('season_id')->nullable()->constrained()->nullOnDelete();
    $table->json('title');                  // Translatable FR/EN
    $table->date('start_date');            // Index
    $table->date('end_date')->nullable();
    $table->string('venue')->nullable();
    $table->string('location')->nullable();
    $table->string('ticket_url')->nullable();
    $table->string('tv_channel')->nullable();
    $table->timestamps();
    $table->index('start_date');
});
```

### Controller: CalendarController

**Fichier**: `app/Http/Controllers/CalendarController.php`

#### Méthode index()

```php
public function index(Request $request)
{
    $currentYear = $request->get('year', now()->year);
    $currentMonth = $request->get('month', now()->month);

    // Get all events for the year
    $allEvents = CalendarEvent::with('competition.federation')
        ->whereYear('start_date', $currentYear)
        ->orderBy('start_date')
        ->get();

    // Filter by month if requested
    $filteredEvents = $allEvents;
    if ($request->has('month') && $request->get('month') !== 'all') {
        $filteredEvents = $allEvents->filter(function($event) use ($currentMonth) {
            return $event->start_date->month == $currentMonth
                || $event->end_date->month == $currentMonth;
        });
    }

    // Filter by federation if requested
    if ($request->has('federation') && $request->get('federation') !== 'all') {
        $federation = $request->get('federation');
        $filteredEvents = $filteredEvents->filter(function($event) use ($federation) {
            return $event->competition
                && strtolower($event->competition->federation->slug) === strtolower($federation);
        });
    }

    // Calendar data for current month
    $calendarDate = Carbon::create($currentYear, $currentMonth, 1);
    $daysInMonth = $calendarDate->daysInMonth;
    $firstDayOfWeek = $calendarDate->dayOfWeek; // 0 = Sunday

    // Get events grouped by day for calendar
    $eventsByDay = $allEvents
        ->filter(function($event) use ($currentYear, $currentMonth) {
            return $event->start_date->year == $currentYear
                && $event->start_date->month == $currentMonth;
        })
        ->groupBy(function($event) {
            return $event->start_date->day;
        });

    return view('calendar.index', compact(
        'allEvents',
        'filteredEvents',
        'currentYear',
        'currentMonth',
        'calendarDate',
        'daysInMonth',
        'firstDayOfWeek',
        'eventsByDay'
    ));
}
```

#### Query Params Supportés

| Param | Type | Default | Description |
|-------|------|---------|-------------|
| `year` | int | now()->year | Année calendrier (ex: 2026) |
| `month` | int\|string | now()->month | Mois (1-12 ou 'all') |
| `federation` | string | 'all' | Slug fédération (pdc/wdf/bdo) |

**Exemples d'URLs**:
```
/calendar
/calendar?month=5
/calendar?month=7&federation=pdc
/calendar?year=2026&month=3&federation=wdf
```

---

## Architecture Frontend

### Vue Principale

**Fichier**: `resources/views/calendar/index.blade.php`

#### Structure HTML

```html
<div x-data="{ ... }">
    <!-- Header -->
    <h1>Darts Calendar 2026</h1>

    <!-- Filtres -->
    <div class="filters">
        <select x-model="selectedMonth" @change="applyFilters">...</select>
        <button @click="selectedFederation = 'pdc'; applyFilters()">PDC</button>
    </div>

    <!-- Calendrier Desktop (lg+) -->
    <section class="hidden lg:block">
        <div class="grid grid-cols-7">
            <!-- Headers -->
            <div>Mon</div><div>Tue</div>...

            <!-- Dates -->
            @for($day = 1; $day <= $daysInMonth; $day++)
                <div>
                    <div>{{ $day }}</div>
                    @if($dayEvents->count() > 0)
                        <!-- Dots colorés -->
                        <span class="dot"></span>
                    @endif
                </div>
            @endfor
        </div>
    </section>

    <!-- Tableau SEO -->
    <section>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Tournament</th>
                    <th>Federation</th>
                    <th>Venue</th>
                    <th>Status</th>
                    <th>Tickets</th>
                </tr>
            </thead>
            <tbody>
                @foreach($filteredEvents as $event)
                    <tr>
                        <td>{{ $event->start_date->format('d M Y') }}</td>
                        <td><a href="{{ route('competitions.show', $event->competition) }}">...</a></td>
                        <td>{{ $event->competition->federation->name }}</td>
                        <td>{{ $event->venue }}</td>
                        <td><!-- Badge Live/Upcoming/Finished --></td>
                        <td><a href="{{ $event->ticket_url }}">Buy</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <!-- Cards Mobile (lg:hidden) -->
    <section class="lg:hidden">
        @foreach($filteredEvents as $event)
            <div class="card">...</div>
        @endforeach
    </section>
</div>
```

#### Alpine.js State Management

```javascript
x-data="{
    // State
    selectedMonth: '{{ request('month', 'all') }}',
    selectedFederation: '{{ request('federation', 'all') }}',
    currentMonth: {{ $currentMonth }},
    currentYear: {{ $currentYear }},

    // Methods
    applyFilters() {
        const params = new URLSearchParams();
        if (this.selectedMonth !== 'all') params.set('month', this.selectedMonth);
        if (this.selectedFederation !== 'all') params.set('federation', this.selectedFederation);
        params.set('year', this.currentYear);
        window.location.search = params.toString();
    },

    previousMonth() {
        if (this.currentMonth === 1) {
            this.currentMonth = 12;
            this.currentYear--;
        } else {
            this.currentMonth--;
        }
        this.applyFilters();
    },

    nextMonth() {
        if (this.currentMonth === 12) {
            this.currentMonth = 1;
            this.currentYear++;
        } else {
            this.currentMonth++;
        }
        this.applyFilters();
    }
}"
```

### Composant Sélecteur Langue

**Fichier**: `resources/views/components/lang-switcher.blade.php`

```blade
@php
    $currentLocale = app()->getLocale();
@endphp

<div x-data="{ open: false }" class="relative">
    <button @click="open = !open" type="button">
        @if($currentLocale === 'fr')
            <span class="text-base">🇫🇷 FR</span>
        @else
            <span class="text-base">🇬🇧 EN</span>
        @endif
        <svg :class="open ? 'rotate-180' : ''">...</svg>
    </button>

    <div x-show="open" @click.away="open = false" x-transition>
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                @if($localeCode === 'fr')
                    <span class="text-base">🇫🇷</span>
                    <span>Français</span>
                @else
                    <span class="text-base">🇬🇧</span>
                    <span>English</span>
                @endif
                @if(app()->getLocale() === $localeCode)
                    <svg>✓</svg>
                @endif
            </a>
        @endforeach
    </div>
</div>
```

---

## TailwindCSS Classes

### Variables CSS Utilisées

```css
/* Design System */
--radius-base: 0.5rem;
--radius-lg: 1rem;

/* Colors */
--primary: hsl(...)
--primary-foreground: hsl(...)
--card: hsl(...)
--border: hsl(...)
--muted: hsl(...)
--muted-foreground: hsl(...)
--accent: hsl(...)
--foreground: hsl(...)
```

### Classes Custom

#### Calendrier Grid
```html
<div class="grid grid-cols-7 gap-2">
    <div class="aspect-square border rounded-[var(--radius-base)] p-2">
        <!-- Cellule calendrier -->
    </div>
</div>
```

#### Badges Status
```html
<!-- Live -->
<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-500/10 text-green-700 dark:text-green-400">
    Live
</span>

<!-- Upcoming -->
<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-primary/10 text-primary">
    Upcoming
</span>

<!-- Finished -->
<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-muted text-muted-foreground">
    Finished
</span>
```

#### Dots Événements
```html
<span class="w-2 h-2 rounded-full"
      style="background-color: hsl(var(--primary))"></span>
```

---

## Logique Calendrier

### Calcul Offset Premier Jour

```php
// $firstDayOfWeek: 0 = Sunday, 1 = Monday, ..., 6 = Saturday
// On veut Monday = colonne 1

$offset = $firstDayOfWeek === 0 ? 6 : $firstDayOfWeek - 1;

// Exemples:
// Sunday (0) → offset 6 (6 cellules vides)
// Monday (1) → offset 0 (0 cellule vide)
// Tuesday (2) → offset 1 (1 cellule vide)
```

### Blade Loop Dates

```blade
{{-- Empty cells for offset --}}
@for($i = 0; $i < $offset; $i++)
    <div class="aspect-square border bg-muted/30"></div>
@endfor

{{-- Dates --}}
@for($day = 1; $day <= $daysInMonth; $day++)
    @php
        $dayEvents = $eventsByDay->get($day, collect());
        $isToday = $calendarDate->copy()->day($day)->isToday();
    @endphp
    <div class="{{ $isToday ? 'border-primary bg-primary/5' : 'border-border' }}">
        <div>{{ $day }}</div>
        @if($dayEvents->count() > 0)
            @foreach($dayEvents->take(3) as $event)
                <span class="w-2 h-2 rounded-full"
                      style="background-color: {{ getFederationColor($event) }}"></span>
            @endforeach
        @endif
    </div>
@endfor
```

### Détermination Couleur Fédération

```php
// Inline dans la vue
style="background-color: {{
    $event->competition?->federation?->slug === 'pdc'
        ? 'hsl(var(--primary))'
        : ($event->competition?->federation?->slug === 'wdf'
            ? 'hsl(var(--accent))'
            : 'hsl(var(--muted-foreground))')
}}"
```

---

## Traductions (i18n)

### Package: Laravel Localization

```php
// config/app.php
'locale' => 'en',
'fallback_locale' => 'en',
'locales' => ['en', 'fr'],
```

### Fichiers JSON

**lang/en.json**:
```json
{
    "Darts Calendar 2026": "Darts Calendar 2026",
    "All PDC, WDF & BDO tournaments and events": "All PDC, WDF & BDO tournaments and events",
    "Mon": "Mon",
    "Tue": "Tue",
    ...
}
```

**lang/fr.json**:
```json
{
    "Darts Calendar 2026": "Calendrier Fléchettes 2026",
    "All PDC, WDF & BDO tournaments and events": "Tous les tournois et événements PDC, WDF & BDO",
    "Mon": "Lun",
    "Tue": "Mar",
    ...
}
```

### Usage dans Blade

```blade
{{ __('Darts Calendar') }}
{{ __('All months') }}
{{ __('Buy Tickets') }}
```

---

## Performance Optimisations

### Database Queries

#### Eager Loading
```php
CalendarEvent::with('competition.federation')
    ->whereYear('start_date', $currentYear)
    ->orderBy('start_date')
    ->get();
```

#### Indexes
```php
// Migration
$table->index('start_date');  // Pour whereYear() et orderBy()
```

### Frontend

#### Alpine.js (13KB gzip)
```html
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
```

#### CSS Grid (pas de JS)
```html
<div class="grid grid-cols-7 gap-2">
    <!-- Pure CSS, performant -->
</div>
```

---

## SEO Implementation

### HTML Sémantique

```html
<table>
    <thead>
        <tr>
            <th scope="col">Date</th>
            <th scope="col">Tournament</th>
            ...
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>15 Jan 2026</td>
            <td><a href="/competitions/world-championship">PDC World Championship</a></td>
            ...
        </tr>
    </tbody>
</table>
```

### Structured Data (Schema.org)

**À ajouter dans la vue**:
```blade
@section('seo_head')
    @foreach($filteredEvents->take(10) as $event)
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "SportsEvent",
            "name": "{{ $event->title }}",
            "startDate": "{{ $event->start_date->toIso8601String() }}",
            "endDate": "{{ $event->end_date->toIso8601String() }}",
            "location": {
                "@type": "Place",
                "name": "{{ $event->venue }}",
                "address": "{{ $event->location }}"
            },
            "organizer": {
                "@type": "Organization",
                "name": "{{ $event->competition->federation->name }}"
            },
            @if($event->ticket_url)
            "offers": {
                "@type": "Offer",
                "url": "{{ $event->ticket_url }}",
                "availability": "https://schema.org/InStock"
            }
            @endif
        }
        </script>
    @endforeach
@endsection
```

### Hreflang Tags

```blade
<!-- Automatique via LaravelLocalization -->
@foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
    <link rel="alternate"
          hreflang="{{ $localeCode }}"
          href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" />
@endforeach
<link rel="alternate"
      hreflang="x-default"
      href="{{ LaravelLocalization::getLocalizedURL(config('app.fallback_locale'), null, [], true) }}" />
```

---

## Accessibility (a11y)

### ARIA Labels

```html
<button aria-label="Change language">🇫🇷 FR</button>
<button aria-label="Previous month">←</button>
<button aria-label="Next month">→</button>
```

### Focus States

```css
.focus\:ring-2:focus {
    ring: 2px solid hsl(var(--primary));
    ring-offset: 2px;
    outline: none;
}
```

### Keyboard Navigation

- Tab: Navigation entre éléments focusables
- Enter/Space: Activation boutons
- Escape: Fermeture dropdown langue

---

## Browser Support

### Minimum Requirements

| Feature | Browser | Version |
|---------|---------|---------|
| CSS Grid | Chrome | 57+ |
| CSS Grid | Firefox | 52+ |
| CSS Grid | Safari | 10.1+ |
| CSS Grid | Edge | 16+ |
| Alpine.js | All modern | ES6+ |

### Polyfills

Aucun polyfill nécessaire pour navigateurs modernes (2020+).

---

## Testing Checklist

### Unit Tests (à créer)

```php
// tests/Feature/CalendarControllerTest.php

public function test_calendar_index_returns_view()
{
    $response = $this->get('/calendar');
    $response->assertStatus(200);
    $response->assertViewIs('calendar.index');
}

public function test_calendar_filters_by_month()
{
    $response = $this->get('/calendar?month=5');
    $response->assertStatus(200);
    $response->assertViewHas('currentMonth', 5);
}

public function test_calendar_filters_by_federation()
{
    $response = $this->get('/calendar?federation=pdc');
    $response->assertStatus(200);
    // Assert filteredEvents only contain PDC
}
```

### Browser Tests (Laravel Dusk)

```php
// tests/Browser/CalendarTest.php

public function test_user_can_navigate_months()
{
    $this->browse(function (Browser $browser) {
        $browser->visit('/calendar')
                ->click('button[aria-label="Next month"]')
                ->waitForText('February 2026')
                ->assertSee('February 2026');
    });
}

public function test_user_can_filter_by_federation()
{
    $this->browse(function (Browser $browser) {
        $browser->visit('/calendar')
                ->click('button:contains("PDC")')
                ->waitForReload()
                ->assertQueryStringHas('federation', 'pdc');
    });
}
```

---

## Deployment Checklist

### Pre-deploy

- [ ] Run tests: `php artisan test`
- [ ] Clear caches: `php artisan cache:clear`
- [ ] Optimize: `php artisan optimize`
- [ ] Migrate DB: `php artisan migrate --force`
- [ ] Seed events: `php artisan db:seed --class=CalendarEventSeeder`

### Post-deploy

- [ ] Test calendrier visuel
- [ ] Test filtres
- [ ] Test sélecteur langue
- [ ] Test responsive mobile
- [ ] Lighthouse audit (>90 tous scores)
- [ ] Check SEO meta tags
- [ ] Vérifier traductions FR/EN

---

## Maintenance

### Ajout d'un événement

```php
CalendarEvent::create([
    'competition_id' => $competition->id,
    'title' => [
        'en' => 'UK Open 2026',
        'fr' => 'UK Open 2026'
    ],
    'start_date' => Carbon::create(2026, 3, 6),
    'end_date' => Carbon::create(2026, 3, 8),
    'venue' => 'Butlins, Minehead',
    'ticket_url' => 'https://pdc.tv/tickets'
]);
```

### Modification d'une traduction

```json
// lang/en.json
{
    "New Key": "New Translation"
}

// lang/fr.json
{
    "New Key": "Nouvelle Traduction"
}
```

Puis: `php artisan cache:clear`

---

## Support & Contact

### Issues GitHub
https://github.com/dartsarena/site/issues

### Documentation
- Laravel: https://laravel.com/docs
- Alpine.js: https://alpinejs.dev/
- TailwindCSS: https://tailwindcss.com/

### Credits
- Design inspirations: PDC.tv, Darts-Nerd
- Components: Shadcn UI
- Icons: Heroicons

---

**Version**: 1.0.0
**Last Updated**: 2026-02-25
**Maintainer**: Claude Sonnet 4.5
