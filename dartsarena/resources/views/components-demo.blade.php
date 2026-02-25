@extends('layouts.app')

@section('title', 'Composants Demo - DartsArena')

@section('content')
<div class="py-8 lg:py-12">
    <div class="max-w-7xl mx-auto px-[var(--container-padding)]">

        {{-- Page Header --}}
        <div class="mb-12">
            <h1 class="font-display text-4xl lg:text-5xl font-black tracking-tight mb-4">
                Design System - Composants
            </h1>
            <p class="text-lg text-muted-foreground">
                Démonstration de tous les composants réutilisables basés sur le design system.
            </p>
        </div>

        {{-- Navigation --}}
        <x-filter-tabs
            :tabs="[
                'cards' => 'Cards',
                'headers' => 'Headers',
                'buttons' => 'Buttons & Links',
                'badges' => 'Badges',
                'layouts' => 'Layouts',
                'specialized' => 'Spécialisés',
                'ui' => 'UI Elements'
            ]"
            active="cards"
            class="mb-12"
        />

        <div class="space-y-16">

            {{-- ========== CARDS ========== --}}
            <section id="cards">
                <x-section-header title="Cards" accentColor="primary" class="mb-8" />

                <div class="space-y-8">
                    {{-- Card Standard --}}
                    <div>
                        <h3 class="font-display text-xl font-bold mb-4">Card Standard</h3>
                        <div class="grid md:grid-cols-3 gap-4">
                            <x-card>
                                <h4 class="font-display text-lg font-bold mb-2">Default Card</h4>
                                <p class="text-sm text-muted-foreground">Card avec variant default, padding p-6, shadow-sm.</p>
                            </x-card>

                            <x-card variant="interactive">
                                <h4 class="font-display text-lg font-bold mb-2">Interactive Card</h4>
                                <p class="text-sm text-muted-foreground">Hover pour voir les effets: border primary + shadow-md.</p>
                            </x-card>

                            <x-card variant="dark">
                                <h4 class="font-display text-lg font-bold mb-2">Dark Card</h4>
                                <p class="text-sm text-white/80">Card sombre pour sidebars avec texte blanc.</p>
                            </x-card>
                        </div>
                    </div>

                    {{-- Card Interactive avec image --}}
                    <div>
                        <h3 class="font-display text-xl font-bold mb-4">Card Interactive avec Image</h3>
                        <div class="grid md:grid-cols-3 gap-4">
                            <x-card-interactive
                                href="#"
                                image="https://placehold.co/600x400/dc2626/ffffff?text=Darts"
                                imageAlt="Exemple article"
                                title="Luke Humphries remporte le championnat">

                                <x-slot:category>
                                    <x-badge-category category="results">Results</x-badge-category>
                                </x-slot:category>

                                <x-slot:meta>
                                    <span class="text-sm text-muted-foreground">Jan 15, 2024</span>
                                </x-slot:meta>

                                Une victoire écrasante pour le champion du monde en titre qui s'impose 7-4.
                            </x-card-interactive>

                            <x-card-interactive
                                href="#"
                                image="https://placehold.co/600x400/eab308/ffffff?text=Interview"
                                imageAlt="Interview"
                                title="Michael van Gerwen: 'Je reviens plus fort'">

                                <x-slot:category>
                                    <x-badge-category category="interview">Interview</x-badge-category>
                                </x-slot:category>

                                <x-slot:meta>
                                    <span class="text-sm text-muted-foreground">Jan 14, 2024</span>
                                </x-slot:meta>

                                Le champion néerlandais partage ses ambitions pour la saison.
                            </x-card-interactive>

                            <x-card-interactive
                                href="#"
                                image="https://placehold.co/600x400/3b82f6/ffffff?text=Analysis"
                                imageAlt="Analyse"
                                title="Statistiques: Les meilleurs finishes de 2024">

                                <x-slot:category>
                                    <x-badge-category category="analysis">Analysis</x-badge-category>
                                </x-slot:category>

                                <x-slot:meta>
                                    <span class="text-sm text-muted-foreground">Jan 13, 2024</span>
                                </x-slot:meta>

                                Découvrez les statistiques les plus impressionnantes de l'année.
                            </x-card-interactive>
                        </div>
                    </div>

                    {{-- Card Dark pour sidebar --}}
                    <div>
                        <h3 class="font-display text-xl font-bold mb-4">Card Dark (Sidebar)</h3>
                        <div class="max-w-md">
                            <x-card-dark title="Upcoming Events">
                                <div class="space-y-3">
                                    <p class="text-white/80 text-sm">Card spécialement conçue pour les sidebars sombres avec header et contenu.</p>
                                </div>
                            </x-card-dark>
                        </div>
                    </div>
                </div>
            </section>

            {{-- ========== HEADERS ========== --}}
            <section id="headers">
                <x-section-header title="Headers" accentColor="accent" class="mb-8" />

                <div class="space-y-8">
                    {{-- Section Headers --}}
                    <div>
                        <h3 class="font-display text-xl font-bold mb-4">Section Header avec Accent Bar</h3>
                        <div class="space-y-4">
                            <x-section-header title="Latest News" />
                            <x-section-header title="Rankings" accentColor="accent" />
                            <x-section-header title="Results" accentColor="secondary" />

                            <x-section-header title="With Actions">
                                <x-slot:actions>
                                    <x-link-arrow href="#">View All</x-link-arrow>
                                </x-slot:actions>
                            </x-section-header>
                        </div>
                    </div>

                    {{-- Colored Headers --}}
                    <div>
                        <h3 class="font-display text-xl font-bold mb-4">Section Header Colored</h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <x-card>
                                <x-section-header-colored title="Top Tournaments" emoji="🏆" bgColor="primary" />
                                <div class="p-6">Content here</div>
                            </x-card>

                            <x-card>
                                <x-section-header-colored title="Live Scores" emoji="⚡" bgColor="accent" />
                                <div class="p-6">Content here</div>
                            </x-card>

                            <x-card>
                                <x-section-header-colored title="Player Stats" emoji="📊" bgColor="info" />
                                <div class="p-6">Content here</div>
                            </x-card>

                            <x-card>
                                <x-section-header-colored title="Top Players" emoji="🎯" bgColor="success" />
                                <div class="p-6">Content here</div>
                            </x-card>
                        </div>
                    </div>
                </div>
            </section>

            {{-- ========== BUTTONS & LINKS ========== --}}
            <section id="buttons">
                <x-section-header title="Buttons & Links" accentColor="primary" class="mb-8" />

                <div class="space-y-8">
                    {{-- Buttons --}}
                    <div>
                        <h3 class="font-display text-xl font-bold mb-4">Buttons</h3>
                        <div class="flex flex-wrap gap-3">
                            <x-button variant="primary">Primary</x-button>
                            <x-button variant="secondary">Secondary</x-button>
                            <x-button variant="outline">Outline</x-button>
                            <x-button variant="ghost">Ghost</x-button>
                        </div>

                        <div class="mt-4 flex flex-wrap gap-3">
                            <x-button variant="primary" size="sm">Small</x-button>
                            <x-button variant="primary" size="md">Medium</x-button>
                            <x-button variant="primary" size="lg">Large</x-button>
                        </div>

                        <div class="mt-4 flex flex-wrap gap-3">
                            <x-button variant="primary" :disabled="true">Disabled</x-button>
                            <x-button variant="secondary" :disabled="true">Disabled</x-button>
                        </div>
                    </div>

                    {{-- Links with Arrow --}}
                    <div>
                        <h3 class="font-display text-xl font-bold mb-4">Links avec Arrow</h3>
                        <div class="space-y-2">
                            <div><x-link-arrow href="#">View All Articles</x-link-arrow></div>
                            <div><x-link-arrow href="#" size="sm">Read more</x-link-arrow></div>
                            <div><x-link-arrow href="#" size="lg">See full rankings</x-link-arrow></div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- ========== BADGES ========== --}}
            <section id="badges">
                <x-section-header title="Badges" accentColor="accent" class="mb-8" />

                <div class="space-y-8">
                    {{-- Badge Standard --}}
                    <div>
                        <h3 class="font-display text-xl font-bold mb-4">Badge Standard</h3>
                        <div class="flex flex-wrap gap-2">
                            <x-badge variant="primary">Primary</x-badge>
                            <x-badge variant="secondary">Secondary</x-badge>
                            <x-badge variant="accent">Accent</x-badge>
                            <x-badge variant="muted">Muted</x-badge>
                        </div>

                        <div class="mt-3 flex flex-wrap gap-2">
                            <x-badge variant="primary" size="sm">Small</x-badge>
                            <x-badge variant="primary" size="md">Medium</x-badge>
                            <x-badge variant="primary" size="lg">Large</x-badge>
                        </div>
                    </div>

                    {{-- Badge Status --}}
                    <div>
                        <h3 class="font-display text-xl font-bold mb-4">Badge Status</h3>
                        <div class="flex flex-wrap gap-2">
                            <x-badge-status status="success">Success</x-badge-status>
                            <x-badge-status status="warning">Warning</x-badge-status>
                            <x-badge-status status="danger">Danger</x-badge-status>
                            <x-badge-status status="info">Info</x-badge-status>
                            <x-badge-status status="live">Live</x-badge-status>
                            <x-badge-status status="finished">Finished</x-badge-status>
                        </div>
                    </div>

                    {{-- Badge Category --}}
                    <div>
                        <h3 class="font-display text-xl font-bold mb-4">Badge Category</h3>
                        <div class="flex flex-wrap gap-2">
                            <x-badge-category category="results">Results</x-badge-category>
                            <x-badge-category category="interview">Interview</x-badge-category>
                            <x-badge-category category="analysis">Analysis</x-badge-category>
                            <x-badge-category category="news">News</x-badge-category>
                            <x-badge-category category="tournament">Tournament</x-badge-category>
                        </div>
                    </div>

                    {{-- Bullet Indicator --}}
                    <div>
                        <h3 class="font-display text-xl font-bold mb-4">Bullet Indicator</h3>
                        <div class="space-y-2">
                            <a href="#" class="group flex items-center gap-2 hover:text-primary transition-colors">
                                <x-bullet-indicator color="primary" />
                                <span>Link with bullet indicator</span>
                            </a>
                            <a href="#" class="group flex items-center gap-2 hover:text-accent transition-colors">
                                <x-bullet-indicator color="accent" />
                                <span>Link with accent bullet</span>
                            </a>
                            <a href="#" class="group flex items-center gap-2 hover:text-success transition-colors">
                                <x-bullet-indicator color="success" size="lg" />
                                <span>Link with large success bullet</span>
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            {{-- ========== SPECIALIZED COMPONENTS ========== --}}
            <section id="specialized">
                <x-section-header title="Composants Spécialisés" accentColor="secondary" class="mb-8" />

                <div class="space-y-8">
                    {{-- Match Result --}}
                    <div>
                        <h3 class="font-display text-xl font-bold mb-4">Match Result</h3>
                        <div class="max-w-2xl">
                            <x-match-result
                                competition="PDC World Championship - Final"
                                status="finished"
                                player1Name="Luke Humphries"
                                player2Name="Luke Littler"
                                :player1Score="7"
                                :player2Score="4"
                                player1Subtitle="Winner"
                                player2Subtitle="Runner-up"
                                date="Jan 3, 2024"
                            />
                        </div>
                    </div>

                    {{-- Upcoming Events --}}
                    <div>
                        <h3 class="font-display text-xl font-bold mb-4">Upcoming Event</h3>
                        <div class="max-w-md">
                            <x-card-dark title="Upcoming Events">
                                <div class="space-y-3">
                                    <x-upcoming-event
                                        title="PDC World Championship"
                                        venue="Alexandra Palace, London"
                                        day="15"
                                        month="Dec"
                                    />
                                    <x-upcoming-event
                                        title="Grand Slam of Darts"
                                        venue="Wolverhampton"
                                        day="22"
                                        month="Nov"
                                    />
                                    <x-upcoming-event
                                        title="European Championship"
                                        venue="Dortmund, Germany"
                                        day="28"
                                        month="Oct"
                                    />
                                </div>
                            </x-card-dark>
                        </div>
                    </div>

                    {{-- Rankings --}}
                    <div>
                        <h3 class="font-display text-xl font-bold mb-4">Ranking Row</h3>
                        <div class="max-w-md">
                            <x-card-dark title="Top 10 Rankings">
                                <div class="space-y-2">
                                    <x-ranking-row
                                        :position="1"
                                        playerName="Luke Humphries"
                                        playerNationality="ENG"
                                        movement="up"
                                    />
                                    <x-ranking-row
                                        :position="2"
                                        playerName="Michael van Gerwen"
                                        playerNationality="NED"
                                        movement="down"
                                    />
                                    <x-ranking-row
                                        :position="3"
                                        playerName="Luke Littler"
                                        playerNationality="ENG"
                                        movement="same"
                                    />
                                    <x-ranking-row
                                        :position="4"
                                        playerName="Peter Wright"
                                        playerNationality="SCO"
                                        movement="up"
                                    />
                                    <x-ranking-row
                                        :position="5"
                                        playerName="Gerwyn Price"
                                        playerNationality="WAL"
                                    />
                                </div>
                            </x-card-dark>
                        </div>
                    </div>
                </div>
            </section>

            {{-- ========== UI ELEMENTS ========== --}}
            <section id="ui">
                <x-section-header title="UI Elements" accentColor="primary" class="mb-8" />

                <div class="space-y-8">
                    {{-- Filter Tabs --}}
                    <div>
                        <h3 class="font-display text-xl font-bold mb-4">Filter Tabs</h3>
                        <x-filter-tabs
                            :tabs="['all' => 'All', 'pdc' => 'PDC', 'wdf' => 'WDF', 'bdo' => 'BDO']"
                            active="all"
                        />
                    </div>

                    {{-- Loading Spinner --}}
                    <div>
                        <h3 class="font-display text-xl font-bold mb-4">Loading Spinner</h3>
                        <div class="space-y-4">
                            <div>
                                <x-loading-spinner />
                            </div>
                            <div>
                                <x-loading-spinner text="Loading articles..." />
                            </div>
                            <div>
                                <x-loading-spinner size="lg" text="Loading tournaments..." />
                            </div>
                            <div>
                                <x-loading-spinner size="sm" text="Loading..." :inline="true" />
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- ========== LAYOUTS ========== --}}
            <section id="layouts">
                <x-section-header title="Layouts" accentColor="accent" class="mb-8" />

                <div class="space-y-8">
                    {{-- Article Grid --}}
                    <div>
                        <h3 class="font-display text-xl font-bold mb-4">Grid Articles (3 colonnes)</h3>
                        <x-grid-articles>
                            <x-card><div class="h-32 flex items-center justify-center text-muted-foreground">Article 1</div></x-card>
                            <x-card><div class="h-32 flex items-center justify-center text-muted-foreground">Article 2</div></x-card>
                            <x-card><div class="h-32 flex items-center justify-center text-muted-foreground">Article 3</div></x-card>
                        </x-grid-articles>
                    </div>

                    {{-- SEO Grid --}}
                    <div>
                        <h3 class="font-display text-xl font-bold mb-4">Grid SEO (6 cards)</h3>
                        <x-grid-seo>
                            <x-card><div class="h-32 flex items-center justify-center text-muted-foreground">SEO 1</div></x-card>
                            <x-card><div class="h-32 flex items-center justify-center text-muted-foreground">SEO 2</div></x-card>
                            <x-card><div class="h-32 flex items-center justify-center text-muted-foreground">SEO 3</div></x-card>
                            <x-card><div class="h-32 flex items-center justify-center text-muted-foreground">SEO 4</div></x-card>
                            <x-card><div class="h-32 flex items-center justify-center text-muted-foreground">SEO 5</div></x-card>
                            <x-card><div class="h-32 flex items-center justify-center text-muted-foreground">SEO 6</div></x-card>
                        </x-grid-seo>
                    </div>

                    {{-- Main + Sidebar Layout --}}
                    <div>
                        <h3 class="font-display text-xl font-bold mb-4">Layout Main + Sidebar (2/3 + 1/3)</h3>
                        <x-layout-main-sidebar>
                            <x-slot:main>
                                <x-card>
                                    <div class="h-64 flex items-center justify-center text-muted-foreground">
                                        Main Content (2/3 width)
                                    </div>
                                </x-card>
                            </x-slot:main>

                            <x-slot:sidebar>
                                <x-card-dark title="Sidebar">
                                    <div class="h-48 flex items-center justify-center text-white/60">
                                        Sticky Sidebar (1/3 width)
                                    </div>
                                </x-card-dark>
                            </x-slot:sidebar>
                        </x-layout-main-sidebar>
                    </div>
                </div>
            </section>

        </div>

        {{-- Footer Info --}}
        <div class="mt-16 p-6 bg-muted rounded-[var(--radius-base)]">
            <h3 class="font-display text-xl font-bold mb-4">Documentation</h3>
            <ul class="space-y-2 text-sm text-muted-foreground">
                <li><x-bullet-indicator color="primary" /> <strong>Design System:</strong> <code>dartsarena/docs/UX_DESIGN_SYSTEM.md</code></li>
                <li><x-bullet-indicator color="accent" /> <strong>Components Guide:</strong> <code>dartsarena/docs/COMPONENTS_GUIDE.md</code></li>
                <li><x-bullet-indicator color="secondary" /> <strong>Components README:</strong> <code>dartsarena/resources/views/components/README.md</code></li>
            </ul>
        </div>

    </div>
</div>
@endsection
