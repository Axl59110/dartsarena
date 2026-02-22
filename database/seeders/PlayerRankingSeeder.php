<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PlayerRanking;
use App\Models\Player;
use App\Models\Federation;

class PlayerRankingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pdc = Federation::where('slug', 'pdc')->first();
        $players = Player::orderBy('id')->get();

        if ($players->count() === 0 || !$pdc) {
            return;
        }

        // Create rankings for all players (simulate realistic prize money distribution)
        $basePrizeMoney = 2500000;

        foreach ($players as $index => $player) {
            $position = $index + 1;

            // Calculate realistic prize money (exponential decay)
            $prizeMoney = $basePrizeMoney * pow(0.88, $index);

            // Calculate previous position (some movement up/down)
            $movement = rand(-3, 3);
            $previousPosition = max(1, min($players->count(), $position + $movement));

            PlayerRanking::create([
                'player_id' => $player->id,
                'federation_id' => $pdc->id,
                'ranking_type' => 'order_of_merit',
                'position' => $position,
                'prize_money' => round($prizeMoney, 2),
                'previous_position' => $previousPosition,
                'recorded_at' => now()->subDays(1),
            ]);
        }
    }
}
