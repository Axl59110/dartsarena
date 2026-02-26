<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Player;
use App\Models\NineDarter;
use App\Models\Competition;

class NineDarterSeeder extends Seeder
{
    public function run(): void
    {
        // Find Luke Littler
        $lukeLittler = Player::where('first_name', 'Luke')
            ->where('last_name', 'Littler')
            ->first();

        if (!$lukeLittler) {
            $this->command->warn('Luke Littler not found. Skipping nine-darters seeding.');
            return;
        }

        // Find competitions
        $worldChampionship = Competition::where('slug', 'world-championship')->first();
        $premierLeague = Competition::where('slug', 'premier-league')->first();

        // Nine-Darter #1: vs Nathan Aspinall - World Championship 2024
        NineDarter::create([
            'player_id' => $lukeLittler->id,
            'competition_id' => $worldChampionship?->id,
            'darts_match_id' => null, // Match not seeded
            'order_number' => 1,
            'video_url' => 'https://www.youtube.com/watch?v=example1', // Replace with real URL
            'on_tv' => true,
            'achieved_at' => '2024-01-02',
        ]);

        // Nine-Darter #2: Premier League 2024 - Week 3
        NineDarter::create([
            'player_id' => $lukeLittler->id,
            'competition_id' => $premierLeague?->id,
            'darts_match_id' => null,
            'order_number' => 2,
            'video_url' => 'https://www.youtube.com/watch?v=example2',
            'on_tv' => true,
            'achieved_at' => '2024-02-15',
        ]);

        // Nine-Darter #3: Premier League 2024 - Week 7
        NineDarter::create([
            'player_id' => $lukeLittler->id,
            'competition_id' => $premierLeague?->id,
            'darts_match_id' => null,
            'order_number' => 3,
            'video_url' => 'https://www.youtube.com/watch?v=example3',
            'on_tv' => true,
            'achieved_at' => '2024-03-14',
        ]);

        // Nine-Darter #4: Players Championship 2024
        NineDarter::create([
            'player_id' => $lukeLittler->id,
            'competition_id' => null, // Players Championship not seeded
            'darts_match_id' => null,
            'order_number' => 4,
            'video_url' => 'https://www.youtube.com/watch?v=example4',
            'on_tv' => false,
            'achieved_at' => '2024-04-20',
        ]);

        // Nine-Darter #5: World Matchplay 2024
        NineDarter::create([
            'player_id' => $lukeLittler->id,
            'competition_id' => null, // World Matchplay not seeded
            'darts_match_id' => null,
            'order_number' => 5,
            'video_url' => 'https://www.youtube.com/watch?v=example5',
            'on_tv' => true,
            'achieved_at' => '2024-07-16',
        ]);

        // Nine-Darter #6: Grand Slam 2024
        NineDarter::create([
            'player_id' => $lukeLittler->id,
            'competition_id' => null, // Grand Slam not seeded
            'darts_match_id' => null,
            'order_number' => 6,
            'video_url' => 'https://www.youtube.com/watch?v=example6',
            'on_tv' => true,
            'achieved_at' => '2024-11-10',
        ]);

        // Nine-Darter #7: Players Championship Finals 2024
        NineDarter::create([
            'player_id' => $lukeLittler->id,
            'competition_id' => null,
            'darts_match_id' => null,
            'order_number' => 7,
            'video_url' => 'https://www.youtube.com/watch?v=example7',
            'on_tv' => false,
            'achieved_at' => '2024-11-24',
        ]);

        // Nine-Darter #8: World Championship 2025
        NineDarter::create([
            'player_id' => $lukeLittler->id,
            'competition_id' => $worldChampionship?->id,
            'darts_match_id' => null,
            'order_number' => 8,
            'video_url' => 'https://www.youtube.com/watch?v=example8',
            'on_tv' => true,
            'achieved_at' => '2025-01-03',
        ]);

        $this->command->info('✓ Created 8 nine-darters for Luke Littler');
    }
}
