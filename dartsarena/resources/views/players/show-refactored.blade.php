@extends('layouts.app')

@section('title', $player->full_name . ' - ' . __('Fiche Joueur') . ' | DartsArena')

@section('breadcrumbs')
    <div class="breadcrumbs py-3">
        <a href="{{ route('home') }}">{{ __('Home') }}</a>
        <span class="text-muted-foreground mx-2">/</span>
        <a href="{{ route('players.index') }}">{{ __('Players') }}</a>
        <span class="text-muted-foreground mx-2">/</span>
        <span class="text-foreground">{{ $player->full_name }}</span>
    </div>
@endsection

@push('styles')
    @include('players.partials._styles')
@endpush

@section('content')
    {{-- Schema.org Person Markup --}}
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

    {{-- HERO SECTION --}}
    @include('players.partials._hero', [
        'player' => $player,
        'latestRanking' => $latestRanking,
        'careerStats' => $careerStats
    ])

    {{-- TABS SECTION --}}
    <div class="container py-8 lg:py-12" x-data="{
        activeTab: window.location.hash ? window.location.hash.substring(1) : 'profil',
        videoModal: {
            isOpen: false,
            videoUrl: '',
            title: '',
            open(url, title) {
                this.videoUrl = url;
                this.title = title;
                this.isOpen = true;
                document.body.style.overflow = 'hidden';
            },
            close() {
                this.isOpen = false;
                this.videoUrl = '';
                this.title = '';
                document.body.style.overflow = '';
            }
        }
    }">
        <div class="max-w-7xl mx-auto">
            {{-- TABS NAVIGATION --}}
            @include('players.partials._tabs-nav', ['nineDarters' => $nineDarters])

            {{-- TAB CONTENTS --}}
            @include('players.partials._tab-profil', ['player' => $player, 'latestRanking' => $latestRanking])

            @include('players.partials._tab-stats', ['player' => $player, 'careerStats' => $careerStats])

            @include('players.partials._tab-fortune')

            @include('players.partials._tab-palmares', ['player' => $player])

            @include('players.partials._tab-matchs', ['player' => $player, 'recentMatches' => $recentMatches])

            @include('players.partials._tab-nine-darters', ['player' => $player, 'nineDarters' => $nineDarters])

            @include('players.partials._tab-equipement', [
                'currentEquipments' => $currentEquipments,
                'previousEquipments' => $previousEquipments
            ])

            {{-- Back Button --}}
            <div class="text-center mt-12">
                <a href="{{ route('players.index') }}"
                   class="inline-flex items-center gap-3 px-8 py-4 bg-slate-900 hover:bg-primary text-white border-2 border-white/10 hover:border-primary rounded-xl font-gaming uppercase tracking-wider transition-all hover:scale-105">
                    <span class="text-xl">←</span>
                    {{ __('Retour aux joueurs') }}
                </a>
            </div>
        </div>
    </div>

    {{-- VIDEO MODAL --}}
    @include('players.partials._video-modal')
@endsection
