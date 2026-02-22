<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Season;
use App\Models\Competition;

class SeasonSeeder extends Seeder
{
    public function run(): void
    {
        $seasons = [
            [
                "competition_slug" => "pdc-world-championship",
                "year" => 2026,
                "start_date" => "2025-12-15",
                "end_date" => "2026-01-03",
                "status" => "finished",
                "venue" => "Alexandra Palace",
                "location" => "London, UK",
            ],
            [
                "competition_slug" => "premier-league-darts",
                "year" => 2026,
                "start_date" => "2026-02-05",
                "end_date" => "2026-05-28",
                "status" => "in_progress",
                "venue" => "Various",
                "location" => "UK",
            ],
            [
                "competition_slug" => "world-matchplay",
                "year" => 2026,
                "start_date" => "2026-07-18",
                "end_date" => "2026-07-26",
                "status" => "upcoming",
                "venue" => "Winter Gardens",
                "location" => "Blackpool, UK",
            ],
            [
                "competition_slug" => "world-grand-prix",
                "year" => 2026,
                "start_date" => "2026-10-05",
                "end_date" => "2026-10-11",
                "status" => "upcoming",
                "venue" => "Citywest Hotel",
                "location" => "Dublin, Ireland",
            ],
            [
                "competition_slug" => "players-championship-finals",
                "year" => 2026,
                "start_date" => "2026-11-21",
                "end_date" => "2026-11-23",
                "status" => "upcoming",
                "venue" => "Butlin's",
                "location" => "Minehead, UK",
            ],
            [
                "competition_slug" => "grand-slam-of-darts",
                "year" => 2026,
                "start_date" => "2026-11-07",
                "end_date" => "2026-11-15",
                "status" => "upcoming",
                "venue" => "Aldersley Leisure Village",
                "location" => "Wolverhampton, UK",
            ],
            [
                "competition_slug" => "wdf-world-championship",
                "year" => 2026,
                "start_date" => "2026-04-04",
                "end_date" => "2026-04-12",
                "status" => "upcoming",
                "venue" => "Lakeside",
                "location" => "Frimley Green, UK",
            ],
        ];

        foreach ($seasons as $seasonData) {
            $competition = Competition::where("slug", $seasonData["competition_slug"])->first();

            Season::create([
                "competition_id" => $competition->id,
                "year" => $seasonData["year"],
                "start_date" => $seasonData["start_date"],
                "end_date" => $seasonData["end_date"],
                "status" => $seasonData["status"],
                "venue" => $seasonData["venue"],
                "location" => $seasonData["location"],
            ]);
        }
    }
}
