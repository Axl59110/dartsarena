<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Player;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $players = [
            [
                'first_name' => 'Luke',
                'last_name' => 'Humphries',
                'nickname' => [
                    'fr' => 'Cool Hand',
                    'en' => 'Cool Hand',
                ],
                'nationality' => 'England',
                'country_code' => 'ENG',
                'date_of_birth' => '2005-02-11',
                'photo_url' => '/images/players/humphries.jpg',
                'bio' => [
                    'fr' => 'Champion du monde PDC 2024, Luke Humphries est l\'un des meilleurs joueurs actuels.',
                    'en' => 'PDC World Champion 2024, Luke Humphries is one of the current top players.',
                ],
                'career_titles' => 15,
                'career_9darters' => 3,
                'career_highest_average' => 110.52,
            ],
            [
                'first_name' => 'Luke',
                'last_name' => 'Littler',
                'nickname' => [
                    'fr' => 'The Nuke',
                    'en' => 'The Nuke',
                ],
                'nationality' => 'England',
                'country_code' => 'ENG',
                'date_of_birth' => '2007-01-21',
                'photo_url' => '/images/players/littler.jpg',
                'bio' => [
                    'fr' => 'Prodige des fléchettes, Luke Littler a révolutionné le sport en 2024 à seulement 17 ans.',
                    'en' => 'Darts prodigy, Luke Littler revolutionized the sport in 2024 at just 17 years old.',
                ],
                'career_titles' => 8,
                'career_9darters' => 5,
                'career_highest_average' => 112.35,
            ],
            [
                'first_name' => 'Michael',
                'last_name' => 'van Gerwen',
                'nickname' => [
                    'fr' => 'Mighty Mike',
                    'en' => 'Mighty Mike',
                ],
                'nationality' => 'Netherlands',
                'country_code' => 'NED',
                'date_of_birth' => '1989-04-25',
                'photo_url' => '/images/players/mvg.jpg',
                'bio' => [
                    'fr' => 'Triple champion du monde et légende vivante des fléchettes.',
                    'en' => 'Three-time world champion and living legend of darts.',
                ],
                'career_titles' => 180,
                'career_9darters' => 11,
                'career_highest_average' => 123.40,
            ],
            [
                'first_name' => 'Michael',
                'last_name' => 'Smith',
                'nickname' => [
                    'fr' => 'Bully Boy',
                    'en' => 'Bully Boy',
                ],
                'nationality' => 'England',
                'country_code' => 'ENG',
                'date_of_birth' => '1990-09-18',
                'photo_url' => '/images/players/smith.jpg',
                'bio' => [
                    'fr' => 'Champion du monde PDC 2023, Michael Smith est un compétiteur redoutable.',
                    'en' => 'PDC World Champion 2023, Michael Smith is a formidable competitor.',
                ],
                'career_titles' => 22,
                'career_9darters' => 4,
                'career_highest_average' => 115.20,
            ],
            [
                'first_name' => 'Peter',
                'last_name' => 'Wright',
                'nickname' => [
                    'fr' => 'Snakebite',
                    'en' => 'Snakebite',
                ],
                'nationality' => 'Scotland',
                'country_code' => 'SCO',
                'date_of_birth' => '1970-03-10',
                'photo_url' => '/images/players/wright.jpg',
                'bio' => [
                    'fr' => 'Double champion du monde connu pour ses coiffures extravagantes et son jeu spectaculaire.',
                    'en' => 'Two-time world champion known for his extravagant hairstyles and spectacular play.',
                ],
                'career_titles' => 42,
                'career_9darters' => 7,
                'career_highest_average' => 118.66,
            ],
        ];

        foreach ($players as $player) {
            Player::create($player);
        }
    }
}
