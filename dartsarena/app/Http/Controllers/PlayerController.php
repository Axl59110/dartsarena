<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\DartsMatch;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index()
    {
        $players = Player::orderBy('last_name')->paginate(12);

        return view('players.index', compact('players'));
    }

    public function show(Player $player)
    {
        // Load latest ranking with federation
        $latestRanking = $player->rankings()
            ->with('federation')
            ->orderByDesc('recorded_at')
            ->first();

        // Load recent matches (last 10) with opponents and season/competition
        $recentMatches = DartsMatch::where(function($query) use ($player) {
                $query->where('player1_id', $player->id)
                      ->orWhere('player2_id', $player->id);
            })
            ->with(['player1', 'player2', 'season.competition', 'winner'])
            ->whereNotNull('winner_id') // Only completed matches
            ->orderByDesc('scheduled_at')
            ->limit(10)
            ->get();

        // Calculate career stats from all matches
        $allMatches = DartsMatch::where(function($query) use ($player) {
                $query->where('player1_id', $player->id)
                      ->orWhere('player2_id', $player->id);
            })
            ->whereNotNull('winner_id')
            ->get();

        $totalMatches = $allMatches->count();
        $wins = $allMatches->where('winner_id', $player->id)->count();
        $winRate = $totalMatches > 0 ? round(($wins / $totalMatches) * 100, 1) : 0;

        // Calculate average stats
        $avgAverage = 0;
        $avgCheckout = 0;
        $total180s = 0;

        foreach ($allMatches as $match) {
            if ($match->player1_id === $player->id) {
                $avgAverage += $match->player1_average ?? 0;
                $avgCheckout += $match->player1_checkout_pct ?? 0;
                $total180s += $match->player1_180s ?? 0;
            } else {
                $avgAverage += $match->player2_average ?? 0;
                $avgCheckout += $match->player2_checkout_pct ?? 0;
                $total180s += $match->player2_180s ?? 0;
            }
        }

        $careerStats = [
            'total_matches' => $totalMatches,
            'wins' => $wins,
            'losses' => $totalMatches - $wins,
            'win_rate' => $winRate,
            'avg_average' => $totalMatches > 0 ? round($avgAverage / $totalMatches, 2) : 0,
            'avg_checkout' => $totalMatches > 0 ? round($avgCheckout / $totalMatches, 1) : 0,
            'total_180s' => $total180s,
        ];

        // Build stats grouped by season year for charts
        $seasonStats = [];
        foreach ($allMatches as $match) {
            $year = $match->scheduled_at?->year ?? 'Unknown';
            if (!isset($seasonStats[$year])) {
                $seasonStats[$year] = ['matches' => 0, 'wins' => 0, 'avg_sum' => 0, 'avg_count' => 0, 'total_180s' => 0];
            }
            $seasonStats[$year]['matches']++;
            if ($match->winner_id === $player->id) {
                $seasonStats[$year]['wins']++;
            }
            $isP1 = $match->player1_id === $player->id;
            $avg = $isP1 ? $match->player1_average : $match->player2_average;
            $s180 = $isP1 ? $match->player1_180s : $match->player2_180s;
            if ($avg) {
                $seasonStats[$year]['avg_sum'] += $avg;
                $seasonStats[$year]['avg_count']++;
            }
            $seasonStats[$year]['total_180s'] += $s180 ?? 0;
        }
        ksort($seasonStats);
        // Flatten for chart consumption
        $chartSeasons = array_keys($seasonStats);
        $chartAverages = array_map(fn($s) => $s['avg_count'] > 0 ? round($s['avg_sum'] / $s['avg_count'], 2) : 0, $seasonStats);
        $chart180s = array_map(fn($s) => $s['total_180s'], $seasonStats);

        // Load equipment and nine darters data
        $currentEquipments = $player->equipments()->current()->get();
        $previousEquipments = $player->equipments()->previous()->get();
        $nineDarters = $player->nineDarters()
            ->with(['competition', 'match.player1', 'match.player2'])
            ->orderBy('order_number')
            ->get();

        return view('players.show', compact(
            'player',
            'latestRanking',
            'recentMatches',
            'careerStats',
            'currentEquipments',
            'previousEquipments',
            'nineDarters',
            'chartSeasons',
            'chartAverages',
            'chart180s'
        ));
    }
}
