<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guide;

class GuideSeeder extends Seeder
{
    public function run(): void
    {
        $guides = [
            [
                'title' => [
                    'fr' => 'Les Règles des Fléchettes : Guide Complet pour Débutants',
                    'en' => 'Darts Rules: Complete Guide for Beginners',
                ],
                'excerpt' => [
                    'fr' => 'Découvrez les règles essentielles du jeu de fléchettes, du 501 au Cricket, pour bien débuter.',
                    'en' => 'Discover the essential rules of darts, from 501 to Cricket, to get started right.',
                ],
                'content' => [
                    'fr' => '<h2>Le jeu 501 - La base des fléchettes</h2><p>Le 501 est le format le plus populaire en fléchettes professionnelles. Chaque joueur commence avec 501 points et doit atteindre exactement zéro en finissant sur une double.</p><h3>Règles principales :</h3><ul><li>Chaque joueur lance 3 fléchettes par tour</li><li>Les points sont soustraits du total</li><li>Il faut finir exactement sur zéro avec une double</li><li>Si vous dépassez zéro, le tour est annulé (bust)</li></ul><h2>Les zones du dartboard</h2><p>Une cible de fléchettes standard comporte plusieurs zones :</p><ul><li><strong>Simple :</strong> Valeur faciale du segment (1-20)</li><li><strong>Double (anneau extérieur) :</strong> Double de la valeur</li><li><strong>Triple (anneau intérieur) :</strong> Triple de la valeur</li><li><strong>Bull (centre) :</strong> 25 points (simple) ou 50 points (double bull)</li></ul><h2>Comment finir une partie</h2><p>Pour gagner, vous devez atteindre exactement zéro avec une fléchette sur une double. Par exemple, s\'il vous reste 32 points, vous devez viser le double 16.</p>',
                    'en' => '<h2>The 501 Game - Darts Basics</h2><p>501 is the most popular format in professional darts. Each player starts with 501 points and must reach exactly zero by finishing on a double.</p><h3>Main rules:</h3><ul><li>Each player throws 3 darts per turn</li><li>Points are subtracted from the total</li><li>You must finish exactly on zero with a double</li><li>If you go below zero, the turn is void (bust)</li></ul><h2>Dartboard zones</h2><p>A standard dartboard has several zones:</p><ul><li><strong>Single:</strong> Face value of the segment (1-20)</li><li><strong>Double (outer ring):</strong> Double the value</li><li><strong>Triple (inner ring):</strong> Triple the value</li><li><strong>Bull (center):</strong> 25 points (single) or 50 points (double bull)</li></ul><h2>How to finish a game</h2><p>To win, you must reach exactly zero with a dart on a double. For example, if you have 32 points left, you must hit double 16.</p>',
                ],
                'category' => 'rules',
                'sort_order' => 1,
                'is_published' => true,
            ],
            [
                'title' => [
                    'fr' => 'Comprendre les Formats PDC : Sets vs Legs',
                    'en' => 'Understanding PDC Formats: Sets vs Legs',
                ],
                'excerpt' => [
                    'fr' => 'Quelle est la différence entre un format en sets et en legs ? On vous explique tout.',
                    'en' => 'What\'s the difference between sets and legs format? We explain everything.',
                ],
                'content' => [
                    'fr' => '<h2>Format Legs</h2><p>Dans un format "legs", les joueurs s\'affrontent directement sur un certain nombre de manches (legs). Le premier à atteindre le nombre requis de legs gagne le match.</p><p><strong>Exemple :</strong> Best of 11 legs = Premier à 6 legs gagne</p><h3>Compétitions en format legs :</h3><ul><li>Premier League Darts</li><li>World Matchplay</li><li>UK Open (premiers tours)</li></ul><h2>Format Sets</h2><p>Dans un format "sets", chaque set est composé de plusieurs legs (généralement 3 ou 5). Le premier joueur à gagner la majorité des legs remporte le set. Ensuite, le premier à gagner le nombre requis de sets gagne le match.</p><p><strong>Exemple :</strong> Best of 7 sets (first to 4), chaque set est best of 5 legs (first to 3)</p><h3>Compétitions en format sets :</h3><ul><li>World Championship (Ally Pally)</li><li>World Grand Prix</li><li>Grand Slam of Darts</li></ul><h2>Quelle est la différence ?</h2><p>Le format sets est généralement considéré comme plus stratégique et mental. Un joueur peut perdre un set mais revenir dans le match. Le format legs est plus direct et rapide.</p>',
                    'en' => '<h2>Legs Format</h2><p>In a "legs" format, players compete directly over a certain number of legs. The first to reach the required number of legs wins the match.</p><p><strong>Example:</strong> Best of 11 legs = First to 6 legs wins</p><h3>Competitions in legs format:</h3><ul><li>Premier League Darts</li><li>World Matchplay</li><li>UK Open (early rounds)</li></ul><h2>Sets Format</h2><p>In a "sets" format, each set consists of several legs (usually 3 or 5). The first player to win the majority of legs wins the set. Then, the first to win the required number of sets wins the match.</p><p><strong>Example:</strong> Best of 7 sets (first to 4), each set is best of 5 legs (first to 3)</p><h3>Competitions in sets format:</h3><ul><li>World Championship (Ally Pally)</li><li>World Grand Prix</li><li>Grand Slam of Darts</li></ul><h2>What\'s the difference?</h2><p>The sets format is generally considered more strategic and mental. A player can lose a set but come back in the match. The legs format is more direct and fast-paced.</p>',
                ],
                'category' => 'rules',
                'sort_order' => 2,
                'is_published' => true,
            ],
            [
                'title' => [
                    'fr' => 'Statistiques des Fléchettes : Comprendre les Moyennes',
                    'en' => 'Darts Statistics: Understanding Averages',
                ],
                'excerpt' => [
                    'fr' => 'Moyenne à 3 fléchettes, checkout %, 180s... Décryptage des statistiques clés.',
                    'en' => 'Three-dart average, checkout %, 180s... Decoding the key statistics.',
                ],
                'content' => [
                    'fr' => '<h2>La moyenne à 3 fléchettes (3-dart average)</h2><p>C\'est la statistique la plus importante en fléchettes. Elle représente la moyenne de points marqués par visite (3 fléchettes).</p><h3>Niveaux de référence :</h3><ul><li><strong>90-95 :</strong> Niveau amateur avancé</li><li><strong>95-100 :</strong> Niveau professionnel PDC Tour Card</li><li><strong>100-105 :</strong> Top 32 mondial</li><li><strong>105-110 :</strong> Top 16 mondial</li><li><strong>110+ :</strong> Elite mondiale (MVG, Littler, Humphries)</li></ul><h2>Le pourcentage de checkout</h2><p>Indique le taux de réussite sur les tentatives de finish. Un bon joueur pro a un checkout % autour de 40-45%.</p><h2>Les 180s</h2><p>Un 180 est le score maximum sur une visite (3 fléchettes) : Triple 20 × 3. C\'est l\'indicateur de puissance et de précision d\'un joueur.</p><h2>Les 9-darters</h2><p>Un 9-darter est un leg parfait terminé en seulement 9 fléchettes (3 visites). C\'est extrêmement rare : seulement quelques dizaines ont été réalisés en match officiel PDC.</p>',
                    'en' => '<h2>The three-dart average</h2><p>This is the most important statistic in darts. It represents the average points scored per visit (3 darts).</p><h3>Reference levels:</h3><ul><li><strong>90-95:</strong> Advanced amateur level</li><li><strong>95-100:</strong> PDC Tour Card professional level</li><li><strong>100-105:</strong> World top 32</li><li><strong>105-110:</strong> World top 16</li><li><strong>110+:</strong> World elite (MVG, Littler, Humphries)</li></ul><h2>Checkout percentage</h2><p>Indicates the success rate on finish attempts. A good pro player has a checkout % around 40-45%.</p><h2>The 180s</h2><p>A 180 is the maximum score on a visit (3 darts): Triple 20 × 3. It\'s an indicator of a player\'s power and precision.</p><h2>The 9-darters</h2><p>A 9-darter is a perfect leg finished in only 9 darts (3 visits). It\'s extremely rare: only a few dozen have been achieved in official PDC matches.</p>',
                ],
                'category' => 'stats',
                'sort_order' => 3,
                'is_published' => true,
            ],
            [
                'title' => [
                    'fr' => 'Calendrier des Grandes Compétitions PDC',
                    'en' => 'PDC Major Competitions Calendar',
                ],
                'excerpt' => [
                    'fr' => 'Découvrez le calendrier annuel des tournois majeurs de la PDC.',
                    'en' => 'Discover the annual calendar of PDC major tournaments.',
                ],
                'content' => [
                    'fr' => '<h2>Le calendrier PDC</h2><p>La saison PDC s\'étend toute l\'année avec des tournois majeurs répartis stratégiquement :</p><h3>Janvier - World Championship</h3><p>Le plus prestigieux tournoi, à Alexandra Palace (Ally Pally) à Londres. Format sets, prize money £2.5M+.</p><h3>Février-Mai - Premier League</h3><p>Ligue itinérante avec les 8 meilleurs joueurs du monde. Format legs, prize money £1M.</p><h3>Juillet - World Matchplay</h3><p>À Blackpool, l\'un des tournois les plus iconiques. Format legs, prize money £800K.</p><h3>Octobre - World Grand Prix</h3><p>À Dublin, format unique double-in/double-out. Prize money £600K.</p><h3>Novembre - Grand Slam of Darts</h3><p>Réunit PDC et WDF. À Wolverhampton. Prize money £650K.</p><h3>Novembre - Players Championship Finals</h3><p>Top 64 du classement Players Championship. Prize money £500K.</p>',
                    'en' => '<h2>The PDC Calendar</h2><p>The PDC season runs year-round with major tournaments strategically distributed:</p><h3>January - World Championship</h3><p>The most prestigious tournament, at Alexandra Palace (Ally Pally) in London. Sets format, prize money £2.5M+.</p><h3>February-May - Premier League</h3><p>Touring league with the world\'s top 8 players. Legs format, prize money £1M.</p><h3>July - World Matchplay</h3><p>In Blackpool, one of the most iconic tournaments. Legs format, prize money £800K.</p><h3>October - World Grand Prix</h3><p>In Dublin, unique double-in/double-out format. Prize money £600K.</p><h3>November - Grand Slam of Darts</h3><p>Brings together PDC and WDF. In Wolverhampton. Prize money £650K.</p><h3>November - Players Championship Finals</h3><p>Top 64 from Players Championship ranking. Prize money £500K.</p>',
                ],
                'category' => 'competitions',
                'sort_order' => 4,
                'is_published' => true,
            ],
        ];

        foreach ($guides as $guide) {
            // Générer le slug automatiquement si non fourni
            if (!isset($guide['slug'])) {
                $title = is_array($guide['title']) ? ($guide['title']['fr'] ?? $guide['title']['en']) : $guide['title'];
                $guide['slug'] = \Illuminate\Support\Str::slug($title);
            }
            Guide::create($guide);
        }
    }
}
