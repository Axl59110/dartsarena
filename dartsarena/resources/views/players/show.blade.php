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

{{-- Gaming Styles --}}
@include('players.partials._styles')

@section('content')
<div class="player-page">

    {{-- Schema.org --}}
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
        if ($player->photo_url) $schema['image'] = asset($player->photo_url);
        if ($player->date_of_birth) $schema['birthDate'] = $player->date_of_birth->format('Y-m-d');
    @endphp
    <script type="application/ld+json">
    {!! json_encode($schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) !!}
    </script>

    {{-- HERO --}}
    @include('players.partials._hero', [
        'player' => $player,
        'latestRanking' => $latestRanking
    ])

    {{-- TABS --}}
    <div style="max-width:1280px; margin:0 auto; padding:32px 16px;"
         x-data="{
             activeTab: 'profil',
             videoModal: {
                 isOpen: false, videoUrl: '', title: '',
                 open(url, title) { this.videoUrl=url; this.title=title; this.isOpen=true; },
                 close() { this.isOpen=false; this.videoUrl=''; this.title=''; }
             }
         }">

        @include('players.partials._tabs-nav')

        <div style="margin-top:24px;">

            @include('players.partials._tab-profil', ['player' => $player, 'latestRanking' => $latestRanking])

            @include('players.partials._tab-stats', [
                'player' => $player,
                'careerStats' => $careerStats,
                'chartSeasons' => $chartSeasons,
                'chartAverages' => $chartAverages,
                'chart180s' => $chart180s,
            ])

            @include('players.partials._tab-palmares', ['player' => $player, 'latestRanking' => $latestRanking])

            @include('players.partials._tab-matchs', ['player' => $player, 'recentMatches' => $recentMatches])

            @include('players.partials._tab-nine-darters', ['player' => $player, 'nineDarters' => $nineDarters])

            @include('players.partials._tab-equipement', [
                'currentEquipments' => $currentEquipments,
                'previousEquipments' => $previousEquipments
            ])

            <div style="text-align:center; margin-top:48px;">
                <a href="{{ route('players.index') }}"
                   style="display:inline-flex; align-items:center; gap:10px; padding:14px 32px;
                          background:#1e293b; color:#f1f5f9; border:1px solid #334155;
                          border-radius:10px; font-family:'Archivo Black',sans-serif;
                          font-size:14px; text-transform:uppercase; letter-spacing:0.05em;
                          text-decoration:none; transition:background 0.15s, border-color 0.15s;"
                   onmouseover="this.style.background='#ef4444';this.style.borderColor='#ef4444';"
                   onmouseout="this.style.background='#1e293b';this.style.borderColor='#334155';">
                    ← {{ __('Retour aux joueurs') }}
                </a>
            </div>
        </div>
    </div>

    @include('players.partials._video-modal')
</div>
@endsection
