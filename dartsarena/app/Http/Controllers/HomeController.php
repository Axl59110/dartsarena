<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\CalendarEvent;
use App\Models\PlayerRanking;
use App\Models\Player;
use App\Models\Competition;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // Featured Article (dernier article publié)
        $featuredArticle = Article::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->first();

        // Latest News (5 derniers articles sauf le featured)
        $latestNews = Article::where('is_published', true)
            ->where('id', '!=', $featuredArticle?->id)
            ->orderBy('published_at', 'desc')
            ->limit(6)
            ->get();

        // Upcoming Matches/Events (5 prochains événements)
        $upcomingEvents = CalendarEvent::where('start_date', '>=', Carbon::now())
            ->orderBy('start_date', 'asc')
            ->limit(5)
            ->with('competition.federation')
            ->get();

        // Recent Results (3 derniers événements terminés)
        $recentResults = CalendarEvent::where('end_date', '<', Carbon::now())
            ->orderBy('end_date', 'desc')
            ->limit(3)
            ->with('competition.federation')
            ->get();

        // Top 10 Rankings (classement PDC)
        $topRankings = PlayerRanking::with(['player', 'federation'])
            ->whereHas('federation', function ($query) {
                $query->where('slug', 'pdc');
            })
            ->orderBy('position', 'asc')
            ->limit(10)
            ->get();

        // Featured Players (4 meilleurs joueurs avec stats)
        $featuredPlayers = Player::whereIn('id', function ($query) {
            $query->select('player_id')
                ->from('player_rankings')
                ->whereHas('federation', function ($q) {
                    $q->where('slug', 'pdc');
                })
                ->orderBy('position', 'asc')
                ->limit(4);
        })
        ->get();

        // Major Competitions (compétitions majeures)
        $majorCompetitions = Competition::whereIn('slug', [
            'world-championship',
            'premier-league',
            'world-matchplay',
            'grand-slam-of-darts'
        ])
        ->with('federation')
        ->get();

        // Quick Stats
        $stats = [
            'total_players' => Player::count(),
            'total_events' => CalendarEvent::count(),
            'total_competitions' => Competition::count(),
            'total_articles' => Article::where('is_published', true)->count(),
        ];

        return view('home', compact(
            'featuredArticle',
            'latestNews',
            'upcomingEvents',
            'recentResults',
            'topRankings',
            'featuredPlayers',
            'majorCompetitions',
            'stats'
        ));
    }
}
