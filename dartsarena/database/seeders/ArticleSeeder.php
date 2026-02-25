<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use Carbon\Carbon;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'title' => [
                    'fr' => 'Luke Littler remporte le Masters 2026 à seulement 19 ans',
                    'en' => 'Luke Littler wins the 2026 Masters at just 19 years old',
                ],
                'slug' => 'luke-littler-masters-2026',
                'excerpt' => [
                    'fr' => 'Le prodige anglais continue son ascension fulgurante en remportant le Masters, devenant le plus jeune vainqueur de l\'histoire du tournoi.',
                    'en' => 'The English prodigy continues his meteoric rise by winning the Masters, becoming the youngest winner in the tournament\'s history.',
                ],
                'content' => [
                    'fr' => '<p>Luke Littler a écrit une nouvelle page de l\'histoire des fléchettes dimanche soir en remportant le Masters 2026 à Milton Keynes. À seulement 19 ans, "The Nuke" devient le plus jeune vainqueur de ce prestigieux tournoi.</p><p>En finale, Littler a dominé Michael van Gerwen 11-7 dans un match spectaculaire où il a affiché une moyenne de 108.3 et réussi 8 maximums de 180. Cette victoire lui rapporte £100,000 et confirme son statut de futur numéro 1 mondial.</p><p>"C\'est un rêve devenu réalité", a déclaré Littler après sa victoire. "Battre MVG en finale d\'un major, c\'est quelque chose d\'extraordinaire. Je suis juste concentré sur mon jeu et ça paie."</p><p>Cette victoire marque son 3ème titre majeur de la saison 2026, après ses succès à la UK Open et au Grand Slam of Darts. Les bookmakers le placent désormais comme grand favori pour le World Championship 2027.</p>',
                    'en' => '<p>Luke Littler wrote a new page in darts history on Sunday evening by winning the 2026 Masters in Milton Keynes. At just 19 years old, "The Nuke" becomes the youngest winner of this prestigious tournament.</p><p>In the final, Littler dominated Michael van Gerwen 11-7 in a spectacular match where he averaged 108.3 and hit 8 maximum 180s. This victory earns him £100,000 and confirms his status as the future world number one.</p><p>"It\'s a dream come true," Littler said after his victory. "Beating MVG in the final of a major is something extraordinary. I\'m just focused on my game and it\'s paying off."</p><p>This victory marks his 3rd major title of the 2026 season, after his successes at the UK Open and Grand Slam of Darts. Bookmakers now place him as the heavy favorite for the 2027 World Championship.</p>',
                ],
                'featured_image' => '/images/news/littler-masters-2026.jpg',
                'category' => 'results',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(2),
                'created_at' => Carbon::now()->subDays(2),
            ],
            [
                'title' => [
                    'fr' => 'Luke Humphries conserve son titre de Champion du Monde PDC',
                    'en' => 'Luke Humphries retains his PDC World Championship title',
                ],
                'slug' => 'humphries-world-champion-2026',
                'excerpt' => [
                    'fr' => 'Cool Hand Luke a défendu avec succès sa couronne mondiale en battant Michael Smith 7-4 en finale à Alexandra Palace.',
                    'en' => 'Cool Hand Luke successfully defended his world crown by beating Michael Smith 7-4 in the final at Alexandra Palace.',
                ],
                'content' => [
                    'fr' => '<p>Luke Humphries a confirmé sa domination sur le circuit PDC en conservant son titre de Champion du Monde lors d\'une finale mémorable à Alexandra Palace le 3 janvier 2026.</p><p>Face à Michael Smith, champion 2023, Humphries a montré toute l\'étendue de son talent avec une moyenne de 101.7 et un checkout percentage exceptionnel de 48%. Le match a été serré jusqu\'à 4-4, avant que Cool Hand Luke ne remporte les trois derniers sets.</p><p>"C\'est encore plus beau que la première fois", a confié un Humphries ému aux larmes. "Défendre un titre mondial, c\'est ce qu\'il y a de plus difficile dans notre sport. Je suis fier d\'avoir réussi."</p><p>Cette victoire lui rapporte £500,000 et le conforte à la première place du classement mondial PDC. Il devient seulement le 6ème joueur de l\'histoire à conserver son titre mondial.</p>',
                    'en' => '<p>Luke Humphries confirmed his dominance on the PDC circuit by retaining his World Championship title in a memorable final at Alexandra Palace on January 3, 2026.</p><p>Against Michael Smith, 2023 champion, Humphries showed the full extent of his talent with an average of 101.7 and an exceptional checkout percentage of 48%. The match was tight until 4-4, before Cool Hand Luke won the last three sets.</p><p>"It\'s even more beautiful than the first time," said an emotional Humphries in tears. "Defending a world title is the hardest thing in our sport. I\'m proud to have succeeded."</p><p>This victory earns him £500,000 and strengthens his position at number one in the PDC world rankings. He becomes only the 6th player in history to retain his world title.</p>',
                ],
                'featured_image' => '/images/news/humphries-world-2026.jpg',
                'category' => 'results',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(49),
                'created_at' => Carbon::now()->subDays(49),
            ],
            [
                'title' => [
                    'fr' => 'Premier League 2026 : Le format change avec des playoffs',
                    'en' => 'Premier League 2026: Format changes with playoffs',
                ],
                'slug' => 'premier-league-2026-format',
                'excerpt' => [
                    'fr' => 'La PDC annonce un nouveau format pour la Premier League 2026 avec une phase de playoffs inédite.',
                    'en' => 'PDC announces new format for Premier League 2026 with unprecedented playoff phase.',
                ],
                'content' => [
                    'fr' => '<p>La PDC a dévoilé cette semaine les changements majeurs apportés au format de la Premier League Darts 2026. Pour la première fois, le tournoi se déroulera en deux phases : une phase régulière suivie de playoffs.</p><p>Les 8 joueurs invités s\'affronteront pendant 16 soirées à travers le Royaume-Uni et l\'Europe. Les 4 premiers se qualifieront ensuite pour les playoffs qui se dérouleront sur une soirée à Londres.</p><p>Barry Hearn, président de la PDC, explique : "Nous voulions rendre la compétition encore plus excitante. Les playoffs garantissent que chaque match de la phase régulière compte, et que tout peut se jouer en une soirée."</p><p>Le prize money total passe à £1,000,000, avec £275,000 pour le vainqueur. Les joueurs confirmés incluent Luke Humphries, Luke Littler, Michael van Gerwen et Michael Smith.</p>',
                    'en' => '<p>PDC unveiled this week the major changes to the 2026 Premier League Darts format. For the first time, the tournament will take place in two phases: a regular phase followed by playoffs.</p><p>The 8 invited players will compete over 16 nights across the UK and Europe. The top 4 will then qualify for the playoffs which will take place over one night in London.</p><p>Barry Hearn, PDC chairman, explains: "We wanted to make the competition even more exciting. The playoffs ensure that every match in the regular phase counts, and that everything can be decided in one night."</p><p>The total prize money increases to £1,000,000, with £275,000 for the winner. Confirmed players include Luke Humphries, Luke Littler, Michael van Gerwen and Michael Smith.</p>',
                ],
                'featured_image' => '/images/news/premier-league-2026.jpg',
                'category' => 'news',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(15),
                'created_at' => Carbon::now()->subDays(15),
            ],
            [
                'title' => [
                    'fr' => 'Gerwyn Price annonce son retour après blessure',
                    'en' => 'Gerwyn Price announces comeback after injury',
                ],
                'slug' => 'gerwyn-price-comeback-2026',
                'excerpt' => [
                    'fr' => 'The Iceman fait son grand retour sur le circuit PDC après 4 mois d\'absence pour soigner une blessure à l\'épaule.',
                    'en' => 'The Iceman makes his big comeback on the PDC circuit after 4 months absence to treat a shoulder injury.',
                ],
                'content' => [
                    'fr' => '<p>Bonne nouvelle pour les fans de Gerwyn Price : l\'ancien Champion du Monde fait son retour cette semaine lors des Players Championship à Wigan. Absent depuis novembre en raison d\'une blessure à l\'épaule, The Iceman a confirmé qu\'il était enfin remis à 100%.</p><p>"Ces quatre mois ont été difficiles, mais j\'ai profité de cette pause pour me remettre complètement et travailler sur mon jeu", a déclaré Price. "Je reviens avec la faim de gagner et l\'envie de retrouver le top 4 mondial."</p><p>Price, actuellement 8ème mondial, vise un retour en force avec comme objectifs le World Matchplay en juillet et bien sûr le World Championship en décembre. À 39 ans, le Gallois estime avoir encore 3-4 bonnes années au plus haut niveau.</p>',
                    'en' => '<p>Good news for Gerwyn Price fans: the former World Champion makes his comeback this week at the Players Championship in Wigan. Absent since November due to a shoulder injury, The Iceman confirmed he was finally 100% fit.</p><p>"These four months have been difficult, but I took advantage of this break to fully recover and work on my game," said Price. "I\'m coming back hungry to win and eager to get back to the world top 4."</p><p>Price, currently world number 8, is aiming for a strong comeback with his sights set on the World Matchplay in July and of course the World Championship in December. At 39, the Welshman believes he still has 3-4 good years at the highest level.</p>',
                ],
                'featured_image' => '/images/news/price-comeback.jpg',
                'category' => 'news',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(7),
                'created_at' => Carbon::now()->subDays(7),
            ],
            [
                'title' => [
                    'fr' => 'Record : 4 nine-darters en une soirée de Premier League',
                    'en' => 'Record: 4 nine-darters in one Premier League night',
                ],
                'slug' => 'record-nine-darters-premier-league',
                'excerpt' => [
                    'fr' => 'Soirée historique jeudi à Manchester avec pas moins de 4 legs parfaits réalisés en une seule soirée.',
                    'en' => 'Historic evening Thursday in Manchester with no less than 4 perfect legs achieved in one night.',
                ],
                'content' => [
                    'fr' => '<p>La soirée de Premier League de jeudi à Manchester restera dans les annales. Pour la première fois dans l\'histoire du tournoi, 4 nine-darters ont été réalisés lors d\'une même soirée, battant l\'ancien record de 2.</p><p>Luke Littler a ouvert le bal avec un 9-darter contre Nathan Aspinall, suivi par Michael van Gerwen face à Rob Cross. En fin de soirée, Jonny Clayton et Luke Humphries ont également réussi l\'exploit.</p><p>L\'Arena de Manchester était en délire, chaque nine-darter étant récompensé par un bonus de £10,000. Au total, £40,000 ont été distribués en primes nine-darters lors de cette soirée exceptionnelle.</p><p>Michael van Gerwen : "C\'était magique. L\'ambiance était tellement électrique que ça nous a tous poussés à jouer notre meilleur darts. Une soirée qu\'on n\'oubliera jamais."</p>',
                    'en' => '<p>Thursday\'s Premier League night in Manchester will go down in history. For the first time in tournament history, 4 nine-darters were achieved in one evening, beating the old record of 2.</p><p>Luke Littler opened the scoring with a 9-darter against Nathan Aspinall, followed by Michael van Gerwen against Rob Cross. Late in the evening, Jonny Clayton and Luke Humphries also achieved the feat.</p><p>The Manchester Arena was in delirium, each nine-darter being rewarded with a bonus of £10,000. In total, £40,000 were distributed in nine-darter bonuses during this exceptional evening.</p><p>Michael van Gerwen: "It was magical. The atmosphere was so electric that it pushed us all to play our best darts. An evening we\'ll never forget."</p>',
                ],
                'featured_image' => '/images/news/nine-darters-record.jpg',
                'category' => 'results',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(5),
                'created_at' => Carbon::now()->subDays(5),
            ],
            [
                'title' => [
                    'fr' => 'Michael van Gerwen vise un 4ème titre mondial',
                    'en' => 'Michael van Gerwen targets 4th world title',
                ],
                'slug' => 'mvg-fourth-title-ambition',
                'excerpt' => [
                    'fr' => 'À 37 ans, Mighty Mike affirme être au meilleur de sa forme et vise un 4ème sacre mondial en décembre.',
                    'en' => 'At 37, Mighty Mike claims to be in the best shape of his life and is targeting a 4th world title in December.',
                ],
                'content' => [
                    'fr' => '<p>Michael van Gerwen n\'a pas dit son dernier mot. Lors d\'une interview exclusive, le Néerlandais de 37 ans a clairement affiché ses ambitions pour le World Championship 2026 : remporter un 4ème titre mondial et égaler le record de Phil Taylor (16 titres étant hors de portée, il vise le record moderne).</p><p>"Je me sens mieux que jamais", affirme MVG. "Ma moyenne est revenue au-dessus de 100, mon checkout percentage est à 42%, et mentalement je suis affûté. Le titre mondial 2026 est mon objectif numéro 1."</p><p>Triple champion du monde (2014, 2017, 2019), van Gerwen n\'a plus gagné de major depuis 2 ans. Mais sa forme récente est encourageante avec des demi-finales au Masters et à la UK Open.</p><p>"Les jeunes comme Littler et Humphries sont exceptionnels, mais j\'ai l\'expérience. À Ally Pally, l\'expérience compte énormément", conclut-il avec détermination.</p>',
                    'en' => '<p>Michael van Gerwen hasn\'t said his last word. In an exclusive interview, the 37-year-old Dutchman clearly stated his ambitions for the 2026 World Championship: winning a 4th world title and matching the modern record (16 titles being out of reach, he aims for the modern record).</p><p>"I feel better than ever," says MVG. "My average is back above 100, my checkout percentage is at 42%, and mentally I\'m sharp. The 2026 world title is my number 1 goal."</p><p>Three-time world champion (2014, 2017, 2019), van Gerwen hasn\'t won a major in 2 years. But his recent form is encouraging with semi-finals at the Masters and UK Open.</p><p>"The youngsters like Littler and Humphries are exceptional, but I have experience. At Ally Pally, experience counts enormously," he concludes with determination.</p>',
                ],
                'featured_image' => '/images/news/mvg-ambition.jpg',
                'category' => 'interview',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(10),
                'created_at' => Carbon::now()->subDays(10),
            ],
            [
                'title' => [
                    'fr' => 'Beau Greaves domine le circuit féminin WDF',
                    'en' => 'Beau Greaves dominates WDF women\'s circuit',
                ],
                'slug' => 'beau-greaves-wdf-dominance',
                'excerpt' => [
                    'fr' => 'La jeune Anglaise enchaîne les victoires et vise désormais une place sur le PDC Tour.',
                    'en' => 'The young Englishwoman strings together victories and now aims for a place on the PDC Tour.',
                ],
                'content' => [
                    'fr' => '<p>À seulement 20 ans, Beau Greaves est en train de révolutionner les fléchettes féminines. Avec 12 victoires consécutives sur le circuit WDF, dont le titre mondial féminin en janvier, l\'Anglaise affiche des statistiques dignes du circuit masculin.</p><p>Sa moyenne de 96.7 lors de la finale mondiale a impressionné toute la communauté. "Beau joue à un niveau que nous n\'avions jamais vu chez les femmes", commente Fallon Sherrock, pionnière des fléchettes féminines.</p><p>Greaves ne cache pas ses ambitions : "Mon objectif est d\'obtenir une Tour Card PDC et de concourir avec les hommes au plus haut niveau. Je sais que j\'en ai le niveau."</p><p>La PDC a récemment annoncé qu\'à partir de 2027, deux places sur la Q-School seraient réservées aux meilleures joueuses du circuit féminin. Beau Greaves est la grande favorite pour obtenir l\'une de ces précieuses cartes.</p>',
                    'en' => '<p>At just 20 years old, Beau Greaves is revolutionizing women\'s darts. With 12 consecutive victories on the WDF circuit, including the women\'s world title in January, the Englishwoman displays statistics worthy of the men\'s circuit.</p><p>Her average of 96.7 in the world final impressed the entire community. "Beau plays at a level we\'ve never seen in women\'s darts," comments Fallon Sherrock, women\'s darts pioneer.</p><p>Greaves doesn\'t hide her ambitions: "My goal is to get a PDC Tour Card and compete with the men at the highest level. I know I have the level."</p><p>PDC recently announced that from 2027, two places at Q-School would be reserved for the best players on the women\'s circuit. Beau Greaves is the hot favorite to get one of these precious cards.</p>',
                ],
                'featured_image' => '/images/news/beau-greaves.jpg',
                'category' => 'news',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(20),
                'created_at' => Carbon::now()->subDays(20),
            ],
            [
                'title' => [
                    'fr' => 'Le World Matchplay 2026 affiche déjà complet',
                    'en' => 'World Matchplay 2026 already sold out',
                ],
                'slug' => 'world-matchplay-2026-sold-out',
                'excerpt' => [
                    'fr' => 'Les billets pour le tournoi de Blackpool se sont vendus en moins de 2 heures, un record.',
                    'en' => 'Tickets for the Blackpool tournament sold out in less than 2 hours, a record.',
                ],
                'content' => [
                    'fr' => '<p>L\'engouement pour les fléchettes ne faiblit pas. Les billets pour le World Matchplay 2026, qui se déroulera du 18 au 26 juillet aux Winter Gardens de Blackpool, se sont écoulés en 1h47 ce matin, battant le précédent record de 3 heures.</p><p>Avec une capacité de 3,200 places par session, c\'est plus de 28,000 billets qui ont été vendus en un temps record. La PDC enregistre une demande croissante avec 150,000 personnes en file d\'attente virtuelle au moment de l\'ouverture.</p><p>Matt Porter, directeur de la PDC : "C\'est extraordinaire. Le World Matchplay est l\'un de nos tournois les plus iconiques, et cette demande montre l\'incroyable popularité des fléchettes en ce moment."</p><p>Pour ceux qui n\'ont pas eu de billets, la PDC propose une liste d\'attente et annonce la diffusion intégrale sur Sky Sports et DAZN.</p>',
                    'en' => '<p>The enthusiasm for darts is not waning. Tickets for the 2026 World Matchplay, which will take place from July 18 to 26 at the Winter Gardens in Blackpool, sold out in 1h47 this morning, beating the previous record of 3 hours.</p><p>With a capacity of 3,200 seats per session, more than 28,000 tickets were sold in record time. PDC recorded increasing demand with 150,000 people in the virtual queue at opening time.</p><p>Matt Porter, PDC director: "It\'s extraordinary. The World Matchplay is one of our most iconic tournaments, and this demand shows the incredible popularity of darts right now."</p><p>For those who didn\'t get tickets, PDC offers a waiting list and announces full broadcast on Sky Sports and DAZN.</p>',
                ],
                'featured_image' => '/images/news/matchplay-sold-out.jpg',
                'category' => 'news',
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(25),
                'created_at' => Carbon::now()->subDays(25),
            ],
        ];

        foreach ($articles as $article) {
            // Si slug n'est pas fourni, il sera généré automatiquement
            // Sinon on le garde tel quel
            Article::create($article);
        }
    }
}
