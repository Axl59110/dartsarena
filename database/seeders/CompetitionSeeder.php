<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Competition;
use App\Models\Federation;

class CompetitionSeeder extends Seeder
{
    public function run(): void
    {
        $pdc = Federation::where("slug", "pdc")->first();
        $wdf = Federation::where("slug", "wdf")->first();
        $bdo = Federation::where("slug", "bdo")->first();

        $competitions = [
            [
                "federation_id" => $pdc->id,
                "name" => [
                    "fr" => "Championnat du Monde PDC",
                    "en" => "PDC World Championship",
                ],
                "slug" => "pdc-world-championship",
                "description" => [
                    "fr" => "Le plus prestigieux tournoi de fléchettes au monde, organisé chaque année à Alexandra Palace à Londres.",
                    "en" => "The most prestigious darts tournament in the world, held annually at Alexandra Palace in London.",
                ],
                "format" => "sets",
                "prize_money" => "2500000",
                "sort_order" => 1,
            ],
            [
                "federation_id" => $pdc->id,
                "name" => [
                    "fr" => "Premier League Darts",
                    "en" => "Premier League Darts",
                ],
                "slug" => "premier-league-darts",
                "description" => [
                    "fr" => "La ligue élite de fléchettes réunissant les meilleurs joueurs du monde dans un format de ligue itinérant.",
                    "en" => "The elite darts league featuring the world's best players in a touring league format.",
                ],
                "format" => "legs",
                "prize_money" => "1000000",
                "sort_order" => 2,
            ],
            [
                "federation_id" => $pdc->id,
                "name" => [
                    "fr" => "World Matchplay",
                    "en" => "World Matchplay",
                ],
                "slug" => "world-matchplay",
                "description" => [
                    "fr" => "Tournoi majeur de la PDC disputé au Winter Gardens de Blackpool, l'un des événements les plus emblématiques.",
                    "en" => "A major PDC tournament held at the Winter Gardens in Blackpool, one of the most iconic events.",
                ],
                "format" => "legs",
                "prize_money" => "800000",
                "sort_order" => 3,
            ],
            [
                "federation_id" => $pdc->id,
                "name" => [
                    "fr" => "World Grand Prix",
                    "en" => "World Grand Prix",
                ],
                "slug" => "world-grand-prix",
                "description" => [
                    "fr" => "Tournoi unique avec le format double-in, organisé à Dublin chaque année en octobre.",
                    "en" => "A unique tournament with the double-in format, held in Dublin every year in October.",
                ],
                "format" => "sets",
                "prize_money" => "600000",
                "sort_order" => 4,
            ],
            [
                "federation_id" => $pdc->id,
                "name" => [
                    "fr" => "Players Championship Finals",
                    "en" => "Players Championship Finals",
                ],
                "slug" => "players-championship-finals",
                "description" => [
                    "fr" => "Les finales du Players Championship, réunissant les meilleurs joueurs du circuit ProTour.",
                    "en" => "The Players Championship Finals, bringing together the top players from the ProTour circuit.",
                ],
                "format" => "legs",
                "prize_money" => "500000",
                "sort_order" => 5,
            ],
            [
                "federation_id" => $pdc->id,
                "name" => [
                    "fr" => "Grand Slam of Darts",
                    "en" => "Grand Slam of Darts",
                ],
                "slug" => "grand-slam-of-darts",
                "description" => [
                    "fr" => "Tournoi invitationnel combinant les meilleurs joueurs de différentes organisations de fléchettes.",
                    "en" => "An invitational tournament combining the best players from different darts organisations.",
                ],
                "format" => "legs",
                "prize_money" => "650000",
                "sort_order" => 6,
            ],
            [
                "federation_id" => $wdf->id,
                "name" => [
                    "fr" => "Championnat du Monde WDF",
                    "en" => "WDF World Championship",
                ],
                "slug" => "wdf-world-championship",
                "description" => [
                    "fr" => "Le championnat du monde organisé par la World Darts Federation, historiquement disputé à Lakeside.",
                    "en" => "The world championship organised by the World Darts Federation, historically held at Lakeside.",
                ],
                "format" => "sets",
                "prize_money" => "150000",
                "sort_order" => 1,
            ],
            [
                "federation_id" => $bdo->id,
                "name" => [
                    "fr" => "Championnat du Monde BDO (Legacy)",
                    "en" => "BDO World Championship (Legacy)",
                ],
                "slug" => "bdo-world-championship",
                "description" => [
                    "fr" => "L'ancien championnat du monde BDO, l'un des tournois les plus historiques du sport des fléchettes.",
                    "en" => "The former BDO World Championship, one of the most historic tournaments in the sport of darts.",
                ],
                "format" => "sets",
                "prize_money" => "0",
                "sort_order" => 1,
            ],
        ];

        foreach ($competitions as $competition) {
            Competition::create($competition);
        }
    }
}
