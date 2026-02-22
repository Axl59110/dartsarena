<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed federations, competitions, seasons and players
        $this->call([
            FederationSeeder::class,
            CompetitionSeeder::class,
            SeasonSeeder::class,
            PlayerSeederLarge::class,  // Version avec beaucoup plus de joueurs
            PlayerRankingSeeder::class,
            CalendarEventSeeder::class,
            GuideSeeder::class,
            ArticleSeeder::class,
        ]);

        // Test user for development
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
