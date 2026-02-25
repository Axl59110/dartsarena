@extends('layouts.app')

@section('title', __('Fédérations de Fléchettes') . ' - DartsArena')

@section('breadcrumbs')
    <div class="breadcrumbs py-3">
        <a href="{{ route('home') }}">{{ __('Accueil') }}</a>
        <span class="text-muted-foreground mx-2">/</span>
        <span class="text-foreground">{{ __('Fédérations') }}</span>
    </div>
@endsection

@section('content')
    {{-- Hero Section --}}
    <section class="bg-gradient-to-b from-muted/30 to-background">
        <div class="container py-12 lg:py-16">
            <h1 class="font-display text-4xl lg:text-5xl font-bold text-foreground mb-4">
                {{ __('Fédérations') }}
            </h1>
            <p class="text-lg text-muted-foreground max-w-3xl">
                {{ __('Les principales organisations régissant le sport des fléchettes dans le monde.') }}
            </p>
        </div>
    </section>

    <div class="container py-8 lg:py-12">
        {{-- Federations Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($federations as $federation)
                <a href="{{ route('federations.show', $federation->slug) }}"
                   class="group bg-card border border-card-border rounded-[var(--radius-base)] shadow-sm hover:shadow-lg hover:border-primary hover:-translate-y-1 transition-all duration-200 p-6">

                    <h2 class="font-display text-2xl font-bold text-foreground group-hover:text-primary transition-colors mb-3">
                        {{ $federation->name }}
                    </h2>

                    <p class="text-muted-foreground mb-4 line-clamp-3">
                        {{ $federation->description }}
                    </p>

                    @if($federation->website_url)
                        <x-link-arrow href="{{ route('federations.show', $federation->slug) }}" size="sm">
                            {{ __('Voir les compétitions') }}
                        </x-link-arrow>
                    @endif
                </a>
            @endforeach
        </div>
    </div>
@endsection
