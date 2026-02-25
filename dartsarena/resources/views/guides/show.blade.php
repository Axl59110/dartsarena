@extends('layouts.app')

@section('title', $guide->title . ' - DartsArena')

@section('breadcrumbs')
    <div class="breadcrumbs py-3">
        <a href="{{ route('home') }}">{{ __('Accueil') }}</a>
        <span class="text-muted-foreground mx-2">/</span>
        <a href="{{ route('guides.index') }}">{{ __('Guides') }}</a>
        <span class="text-muted-foreground mx-2">/</span>
        <span class="text-foreground">{{ Str::limit($guide->title, 50) }}</span>
    </div>
@endsection

@section('content')
    {{-- Guide Hero --}}
    <section class="bg-gradient-to-b from-muted/30 to-background">
        <div class="container py-12 lg:py-16">
            <div class="max-w-4xl">
                <x-badge-category :category="$guide->category" class="mb-6">
                    @if($guide->category === 'rules') {{ __('Règles') }}
                    @elseif($guide->category === 'stats') {{ __('Statistiques') }}
                    @elseif($guide->category === 'competitions') {{ __('Compétitions') }}
                    @else {{ ucfirst($guide->category) }}
                    @endif
                </x-badge-category>

                <h1 class="font-display text-4xl lg:text-5xl font-bold text-foreground mb-6 leading-tight">
                    {{ $guide->title }}
                </h1>

                @if($guide->excerpt)
                    <p class="text-lg text-muted-foreground leading-relaxed">
                        {{ $guide->excerpt }}
                    </p>
                @endif
            </div>
        </div>
    </section>

    <div class="container py-8 lg:py-12">
        <div class="max-w-4xl mx-auto">
            {{-- Guide Content --}}
            <x-card class="p-6 lg:p-8 mb-12 prose prose-invert prose-lg max-w-none">
                <div class="guide-content">
                    {!! $guide->content !!}
                </div>
            </x-card>

            {{-- Back Button --}}
            <div class="text-center">
                <a href="{{ route('guides.index') }}"
                   class="inline-flex items-center gap-3 px-6 py-3 bg-card text-foreground border-2 border-primary rounded-[var(--radius-base)] font-semibold hover:bg-primary hover:text-primary-foreground transition-all hover:-translate-y-0.5 shadow-sm">
                    <span class="text-xl">←</span>
                    {{ __('Retour aux guides') }}
                </a>
            </div>
        </div>
    </div>

    <style>
        /* Guide Content Styling */
        .guide-content h2 {
            font-family: 'Bebas Neue', cursive;
            font-size: 2.25rem;
            letter-spacing: 0.05em;
            margin-top: 2.5rem;
            margin-bottom: 1rem;
            color: white;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid rgba(225, 29, 72, 0.3);
        }

        .guide-content h2:first-child {
            margin-top: 0;
        }

        .guide-content h3 {
            font-family: 'Bebas Neue', cursive;
            font-size: 1.6rem;
            letter-spacing: 0.05em;
            margin-top: 2rem;
            margin-bottom: 0.75rem;
            color: #EF4444;
        }

        .guide-content p {
            margin-bottom: 1rem;
            line-height: 1.8;
            color: #D1D5DB;
        }

        .guide-content ul,
        .guide-content ol {
            margin-left: 2rem;
            margin-bottom: 1.5rem;
        }

        .guide-content li {
            margin-bottom: 0.5rem;
            color: #D1D5DB;
        }

        .guide-content ul li {
            list-style: none;
            position: relative;
            padding-left: 0.5rem;
        }

        .guide-content ul li::before {
            content: '▸';
            position: absolute;
            left: -1.5rem;
            color: #EF4444;
            font-weight: 700;
        }

        .guide-content strong {
            color: #FBBF24;
            font-weight: 700;
        }

        .guide-content a {
            color: #EF4444;
            font-weight: 600;
            text-decoration: underline;
            text-decoration-thickness: 2px;
            text-underline-offset: 2px;
            transition: color 0.2s ease;
        }

        .guide-content a:hover {
            color: #F87171;
        }

        .guide-content code {
            background: #0A0A0A;
            padding: 0.25rem 0.5rem;
            border-radius: 0.375rem;
            font-family: 'Courier New', monospace;
            font-size: 0.9em;
            color: #FBBF24;
        }

        .guide-content pre {
            background: #0A0A0A;
            padding: 1.5rem;
            border-radius: 0.75rem;
            overflow-x: auto;
            margin-bottom: 1.5rem;
            border: 1px solid #262626;
        }

        .guide-content pre code {
            background: none;
            padding: 0;
            color: #D1D5DB;
        }
    </style>
@endsection
