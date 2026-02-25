<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Player;

class PlayerSeederLarge extends Seeder
{
    public function run(): void
    {
        $players = $this->getPlayers();

        foreach ($players as $player) {
            // Generate slug from first_name and last_name
            $slug = \Illuminate\Support\Str::slug($player['first_name'] . ' ' . $player['last_name']);
            $player['slug'] = $slug;

            Player::create($player);
        }
    }

    private function getPlayers(): array
    {
        return [
            // Top 10
            [
                'first_name' => 'Luke',
                'last_name' => 'Humphries',
                'nickname' => ['fr' => 'Cool Hand', 'en' => 'Cool Hand'],
                'nationality' => 'England',
                'country_code' => 'ENG',
                'date_of_birth' => '2005-02-11',
                'photo_url' => '/images/players/humphries.jpg',
                'bio' => [
                    'fr' => 'Champion du monde PDC 2024 et 2026, Luke Humphries domine actuellement le circuit mondial avec un jeu ultra-solide et un mental d\'acier.',
                    'en' => 'PDC World Champion 2024 and 2026, Luke Humphries currently dominates the world circuit with ultra-solid play and nerves of steel.',
                ],
                'career_titles' => 18,
                'career_9darters' => 4,
                'career_highest_average' => 110.52,
            ],
            [
                'first_name' => 'Luke',
                'last_name' => 'Littler',
                'nickname' => ['fr' => 'The Nuke', 'en' => 'The Nuke'],
                'nationality' => 'England',
                'country_code' => 'ENG',
                'date_of_birth' => '2007-01-21',
                'photo_url' => '/images/players/littler.jpg',
                'bio' => [
                    'fr' => 'Phénomène des fléchettes, Luke Littler a révolutionné le sport à seulement 17 ans en 2024. Sa puissance et sa précision en font le futur n°1 mondial.',
                    'en' => 'Darts phenomenon, Luke Littler revolutionized the sport at just 17 in 2024. His power and precision make him the future world number one.',
                ],
                'career_titles' => 12,
                'career_9darters' => 6,
                'career_highest_average' => 113.42,
            ],
            [
                'first_name' => 'Michael',
                'last_name' => 'van Gerwen',
                'nickname' => ['fr' => 'Mighty Mike', 'en' => 'Mighty Mike'],
                'nationality' => 'Netherlands',
                'country_code' => 'NED',
                'date_of_birth' => '1989-04-25',
                'photo_url' => '/images/players/mvg.jpg',
                'bio' => [
                    'fr' => 'Légende vivante du darts, triple champion du monde (2014, 2017, 2019) et détenteur de plus de 180 titres majeurs. Reste une menace constante.',
                    'en' => 'Living darts legend, three-time world champion (2014, 2017, 2019) and holder of over 180 major titles. Remains a constant threat.',
                ],
                'career_titles' => 185,
                'career_9darters' => 12,
                'career_highest_average' => 123.40,
            ],
            [
                'first_name' => 'Michael',
                'last_name' => 'Smith',
                'nickname' => ['fr' => 'Bully Boy', 'en' => 'Bully Boy'],
                'nationality' => 'England',
                'country_code' => 'ENG',
                'date_of_birth' => '1990-09-18',
                'photo_url' => '/images/players/smith.jpg',
                'bio' => [
                    'fr' => 'Champion du monde PDC 2023, Michael Smith a enfin décroché son premier titre mondial après plusieurs finales. Compétiteur redoutable.',
                    'en' => 'PDC World Champion 2023, Michael Smith finally won his first world title after several finals. Formidable competitor.',
                ],
                'career_titles' => 25,
                'career_9darters' => 5,
                'career_highest_average' => 115.20,
            ],
            [
                'first_name' => 'Peter',
                'last_name' => 'Wright',
                'nickname' => ['fr' => 'Snakebite', 'en' => 'Snakebite'],
                'nationality' => 'Scotland',
                'country_code' => 'SCO',
                'date_of_birth' => '1970-03-10',
                'photo_url' => '/images/players/wright.jpg',
                'bio' => [
                    'fr' => 'Double champion du monde (2020, 2022), célèbre pour ses coiffures et tenues extravagantes. Joueur spectaculaire et imprévisible.',
                    'en' => 'Two-time world champion (2020, 2022), famous for his extravagant hairstyles and outfits. Spectacular and unpredictable player.',
                ],
                'career_titles' => 45,
                'career_9darters' => 8,
                'career_highest_average' => 118.66,
            ],
            [
                'first_name' => 'Rob',
                'last_name' => 'Cross',
                'nickname' => ['fr' => 'Voltage', 'en' => 'Voltage'],
                'nationality' => 'England',
                'country_code' => 'ENG',
                'date_of_birth' => '1990-09-21',
                'photo_url' => '/images/players/cross.jpg',
                'bio' => [
                    'fr' => 'Champion du monde surprise en 2018, Cross est un électricien devenu star du darts. Connu pour sa régularité et son sang-froid.',
                    'en' => 'Surprise world champion in 2018, Cross is an electrician turned darts star. Known for consistency and composure.',
                ],
                'career_titles' => 21,
                'career_9darters' => 3,
                'career_highest_average' => 109.34,
            ],
            [
                'first_name' => 'Nathan',
                'last_name' => 'Aspinall',
                'nickname' => ['fr' => 'The Asp', 'en' => 'The Asp'],
                'nationality' => 'England',
                'country_code' => 'ENG',
                'date_of_birth' => '1991-07-15',
                'photo_url' => '/images/players/aspinall.jpg',
                'bio' => [
                    'fr' => 'Vainqueur de l\'UK Open 2019 et 2022, Aspinall est connu pour sa combativité et ses retours spectaculaires dans les matchs.',
                    'en' => 'UK Open winner 2019 and 2022, Aspinall is known for his fighting spirit and spectacular comebacks in matches.',
                ],
                'career_titles' => 16,
                'career_9darters' => 2,
                'career_highest_average' => 108.77,
            ],
            [
                'first_name' => 'Jonny',
                'last_name' => 'Clayton',
                'nickname' => ['fr' => 'The Ferret', 'en' => 'The Ferret'],
                'nationality' => 'Wales',
                'country_code' => 'WAL',
                'date_of_birth' => '1974-10-04',
                'photo_url' => '/images/players/clayton.jpg',
                'bio' => [
                    'fr' => 'Champion de Premier League 2021, Clayton est un des meilleurs finisseurs du circuit avec un checkout percentage exceptionnel.',
                    'en' => 'Premier League champion 2021, Clayton is one of the best finishers on the circuit with exceptional checkout percentage.',
                ],
                'career_titles' => 19,
                'career_9darters' => 4,
                'career_highest_average' => 110.15,
            ],
            [
                'first_name' => 'Gerwyn',
                'last_name' => 'Price',
                'nickname' => ['fr' => 'The Iceman', 'en' => 'The Iceman'],
                'nationality' => 'Wales',
                'country_code' => 'WAL',
                'date_of_birth' => '1985-03-07',
                'photo_url' => '/images/players/price.jpg',
                'bio' => [
                    'fr' => 'Champion du monde 2021, ancien rugbyman professionnel. Connu pour son intensité et ses célébrations passionnées.',
                    'en' => 'World champion 2021, former professional rugby player. Known for his intensity and passionate celebrations.',
                ],
                'career_titles' => 28,
                'career_9darters' => 6,
                'career_highest_average' => 116.20,
            ],
            [
                'first_name' => 'Dimitri',
                'last_name' => 'Van den Bergh',
                'nickname' => ['fr' => 'The Dreammaker', 'en' => 'The Dreammaker'],
                'nationality' => 'Belgium',
                'country_code' => 'BEL',
                'date_of_birth' => '1993-11-08',
                'photo_url' => '/images/players/vandenbergh.jpg',
                'bio' => [
                    'fr' => 'Champion du World Matchplay 2020, le Belge est connu pour son jeu spectaculaire et ses émotions à fleur de peau.',
                    'en' => 'World Matchplay champion 2020, the Belgian is known for his spectacular play and emotional displays.',
                ],
                'career_titles' => 11,
                'career_9darters' => 2,
                'career_highest_average' => 109.82,
            ],

            // Top 11-20
            [
                'first_name' => 'James',
                'last_name' => 'Wade',
                'nickname' => ['fr' => 'The Machine', 'en' => 'The Machine'],
                'nationality' => 'England',
                'country_code' => 'ENG',
                'date_of_birth' => '1983-04-06',
                'photo_url' => '/images/players/wade.jpg',
                'bio' => [
                    'fr' => 'Vétéran du circuit, Wade a remporté 11 majeurs dont le World Matchplay. Réputé pour sa régularité robotique.',
                    'en' => 'Circuit veteran, Wade has won 11 majors including the World Matchplay. Renowned for his robotic consistency.',
                ],
                'career_titles' => 48,
                'career_9darters' => 3,
                'career_highest_average' => 107.50,
            ],
            [
                'first_name' => 'Danny',
                'last_name' => 'Noppert',
                'nickname' => ['fr' => 'Noppie', 'en' => 'Noppie'],
                'nationality' => 'Netherlands',
                'country_code' => 'NED',
                'date_of_birth' => '1990-12-31',
                'photo_url' => '/images/players/noppert.jpg',
                'bio' => [
                    'fr' => 'Finaliste du World Championship 2022, Noppert est un joueur puissant avec une excellente maîtrise des finitions.',
                    'en' => 'World Championship finalist 2022, Noppert is a powerful player with excellent finishing skills.',
                ],
                'career_titles' => 8,
                'career_9darters' => 2,
                'career_highest_average' => 105.33,
            ],
            [
                'first_name' => 'Damon',
                'last_name' => 'Heta',
                'nickname' => ['fr' => 'The Heat', 'en' => 'The Heat'],
                'nationality' => 'Australia',
                'country_code' => 'AUS',
                'date_of_birth' => '1987-08-07',
                'photo_url' => '/images/players/heta.jpg',
                'bio' => [
                    'fr' => 'Australien explosif, Heta est capable de produire des moyennes phénoménales et de battre n\'importe qui sur son meilleur jour.',
                    'en' => 'Explosive Australian, Heta is capable of producing phenomenal averages and beating anyone on his day.',
                ],
                'career_titles' => 6,
                'career_9darters' => 3,
                'career_highest_average' => 111.25,
            ],
            [
                'first_name' => 'Josh',
                'last_name' => 'Rock',
                'nickname' => ['fr' => 'Rocky', 'en' => 'Rocky'],
                'nationality' => 'Northern Ireland',
                'country_code' => 'NIR',
                'date_of_birth' => '2001-12-14',
                'photo_url' => '/images/players/rock.jpg',
                'bio' => [
                    'fr' => 'Jeune prodige nord-irlandais, Rock affiche régulièrement des moyennes supérieures à 105. L\'avenir du darts britannique.',
                    'en' => 'Young Northern Irish prodigy, Rock regularly displays averages above 105. The future of British darts.',
                ],
                'career_titles' => 4,
                'career_9darters' => 2,
                'career_highest_average' => 112.03,
            ],
            [
                'first_name' => 'Dave',
                'last_name' => 'Chisnall',
                'nickname' => ['fr' => 'Chizzy', 'en' => 'Chizzy'],
                'nationality' => 'England',
                'country_code' => 'ENG',
                'date_of_birth' => '1980-05-07',
                'photo_url' => '/images/players/chisnall.jpg',
                'bio' => [
                    'fr' => 'Joueur très régulier du top 20 depuis plus de 10 ans, finaliste du World Grand Prix 2020. Finisseur exceptionnel.',
                    'en' => 'Very consistent top 20 player for over 10 years, World Grand Prix finalist 2020. Exceptional finisher.',
                ],
                'career_titles' => 14,
                'career_9darters' => 5,
                'career_highest_average' => 109.21,
            ],
            [
                'first_name' => 'Gabriel',
                'last_name' => 'Clemens',
                'nickname' => ['fr' => 'The German Giant', 'en' => 'The German Giant'],
                'nationality' => 'Germany',
                'country_code' => 'GER',
                'date_of_birth' => '1983-07-04',
                'photo_url' => '/images/players/clemens.jpg',
                'bio' => [
                    'fr' => 'Meilleur joueur allemand de l\'histoire, demi-finaliste du World Championship 2023. Leader du darts en Allemagne.',
                    'en' => 'Best German player in history, World Championship semi-finalist 2023. Leader of darts in Germany.',
                ],
                'career_titles' => 7,
                'career_9darters' => 1,
                'career_highest_average' => 104.88,
            ],
            [
                'first_name' => 'Chris',
                'last_name' => 'Dobey',
                'nickname' => ['fr' => 'Hollywood', 'en' => 'Hollywood'],
                'nationality' => 'England',
                'country_code' => 'ENG',
                'date_of_birth' => '1990-06-22',
                'photo_url' => '/images/players/dobey.jpg',
                'bio' => [
                    'fr' => 'Finaliste du World Championship 2024, Dobey a explosé au plus haut niveau avec un jeu spectaculaire.',
                    'en' => 'World Championship finalist 2024, Dobey broke through to the highest level with spectacular play.',
                ],
                'career_titles' => 5,
                'career_9darters' => 1,
                'career_highest_average' => 106.42,
            ],
            [
                'first_name' => 'Stephen',
                'last_name' => 'Bunting',
                'nickname' => ['fr' => 'The Bullet', 'en' => 'The Bullet'],
                'nationality' => 'England',
                'country_code' => 'ENG',
                'date_of_birth' => '1985-04-09',
                'photo_url' => '/images/players/bunting.jpg',
                'bio' => [
                    'fr' => 'Champion du Masters 2024, ancien champion du monde BDO. Retour au sommet après des années difficiles.',
                    'en' => 'Masters champion 2024, former BDO world champion. Return to the top after difficult years.',
                ],
                'career_titles' => 9,
                'career_9darters' => 2,
                'career_highest_average' => 107.83,
            ],
            [
                'first_name' => 'Joe',
                'last_name' => 'Cullen',
                'nickname' => ['fr' => 'The Rockstar', 'en' => 'The Rockstar'],
                'nationality' => 'England',
                'country_code' => 'ENG',
                'date_of_birth' => '1989-04-01',
                'photo_url' => '/images/players/cullen.jpg',
                'bio' => [
                    'fr' => 'Vainqueur du Masters 2022, Cullen combine puissance et style. Connu pour ses célébrations rock\'n\'roll.',
                    'en' => 'Masters winner 2022, Cullen combines power and style. Known for his rock\'n\'roll celebrations.',
                ],
                'career_titles' => 11,
                'career_9darters' => 3,
                'career_highest_average' => 108.55,
            ],
            [
                'first_name' => 'Ryan',
                'last_name' => 'Searle',
                'nickname' => ['fr' => 'Heavy Metal', 'en' => 'Heavy Metal'],
                'nationality' => 'England',
                'country_code' => 'ENG',
                'date_of_birth' => '1987-08-04',
                'photo_url' => '/images/players/searle.jpg',
                'bio' => [
                    'fr' => 'Joueur en progression constante, Searle s\'est imposé dans le top 20 avec un jeu solide et régulier.',
                    'en' => 'Constantly improving player, Searle has established himself in the top 20 with solid and consistent play.',
                ],
                'career_titles' => 4,
                'career_9darters' => 1,
                'career_highest_average' => 105.12,
            ],
        ];
    }
}
