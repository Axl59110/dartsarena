<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CalendarEvent;
use App\Models\Competition;
use Carbon\Carbon;

class CalendarEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $competitions = Competition::all();

        if ($competitions->count() === 0) {
            return;
        }

        $events = [
            // January 2026
            [
                'slug' => 'pdc-world-championship',
                'title' => ['fr' => 'Championnat du Monde PDC 2026', 'en' => 'PDC World Championship 2026'],
                'start_date' => Carbon::create(2025, 12, 15),
                'end_date' => Carbon::create(2026, 1, 3),
                'venue' => 'Alexandra Palace, London',
                'ticket_url' => 'https://www.pdc.tv/tickets',
            ],
            [
                'slug' => 'masters',
                'title' => ['fr' => 'The Masters 2026', 'en' => 'The Masters 2026'],
                'start_date' => Carbon::create(2026, 1, 31),
                'end_date' => Carbon::create(2026, 2, 2),
                'venue' => 'Milton Keynes',
                'ticket_url' => 'https://www.pdc.tv/tickets',
            ],

            // February-May 2026
            [
                'slug' => 'premier-league-darts',
                'title' => ['fr' => 'Premier League Darts 2026', 'en' => 'Premier League Darts 2026'],
                'start_date' => Carbon::create(2026, 2, 6),
                'end_date' => Carbon::create(2026, 5, 28),
                'venue' => 'Various UK & Europe',
                'ticket_url' => 'https://www.pdc.tv/tickets',
            ],

            // March 2026
            [
                'slug' => 'uk-open',
                'title' => ['fr' => 'UK Open 2026', 'en' => 'UK Open 2026'],
                'start_date' => Carbon::create(2026, 3, 6),
                'end_date' => Carbon::create(2026, 3, 8),
                'venue' => 'Butlins, Minehead',
                'ticket_url' => 'https://www.pdc.tv/tickets',
            ],

            // April 2026
            [
                'slug' => 'wdf-world-championship',
                'title' => ['fr' => 'Championnat du Monde WDF 2026', 'en' => 'WDF World Championship 2026'],
                'start_date' => Carbon::create(2026, 4, 4),
                'end_date' => Carbon::create(2026, 4, 12),
                'venue' => 'Lakeside, Frimley Green',
                'ticket_url' => null,
            ],

            // June 2026
            [
                'slug' => 'european-championship',
                'title' => ['fr' => 'Championnat d\'Europe 2026', 'en' => 'European Championship 2026'],
                'start_date' => Carbon::create(2026, 10, 24),
                'end_date' => Carbon::create(2026, 10, 27),
                'venue' => 'Westfalenhalle, Dortmund',
                'ticket_url' => 'https://www.pdc.tv/tickets',
            ],

            // July 2026
            [
                'slug' => 'world-matchplay',
                'title' => ['fr' => 'World Matchplay 2026', 'en' => 'World Matchplay 2026'],
                'start_date' => Carbon::create(2026, 7, 18),
                'end_date' => Carbon::create(2026, 7, 26),
                'venue' => 'Winter Gardens, Blackpool',
                'ticket_url' => 'https://www.pdc.tv/tickets',
            ],

            // September 2026
            [
                'slug' => 'world-cup-of-darts',
                'title' => ['fr' => 'Coupe du Monde de Fléchettes 2026', 'en' => 'World Cup of Darts 2026'],
                'start_date' => Carbon::create(2026, 9, 18),
                'end_date' => Carbon::create(2026, 9, 20),
                'venue' => 'Frankfurt',
                'ticket_url' => 'https://www.pdc.tv/tickets',
            ],

            // October 2026
            [
                'slug' => 'world-grand-prix',
                'title' => ['fr' => 'World Grand Prix 2026', 'en' => 'World Grand Prix 2026'],
                'start_date' => Carbon::create(2026, 10, 5),
                'end_date' => Carbon::create(2026, 10, 11),
                'venue' => 'Citywest Hotel, Dublin',
                'ticket_url' => 'https://www.pdc.tv/tickets',
            ],

            // November 2026
            [
                'slug' => 'grand-slam-of-darts',
                'title' => ['fr' => 'Grand Slam of Darts 2026', 'en' => 'Grand Slam of Darts 2026'],
                'start_date' => Carbon::create(2026, 11, 7),
                'end_date' => Carbon::create(2026, 11, 15),
                'venue' => 'Aldersley Leisure Village, Wolverhampton',
                'ticket_url' => 'https://www.pdc.tv/tickets',
            ],
            [
                'slug' => 'players-championship-finals',
                'title' => ['fr' => 'Players Championship Finals 2026', 'en' => 'Players Championship Finals 2026'],
                'start_date' => Carbon::create(2026, 11, 21),
                'end_date' => Carbon::create(2026, 11, 23),
                'venue' => 'Butlins, Minehead',
                'ticket_url' => 'https://www.pdc.tv/tickets',
            ],
        ];

        foreach ($events as $eventData) {
            $competition = Competition::where('slug', $eventData['slug'])->first();

            if ($competition) {
                CalendarEvent::create([
                    'competition_id' => $competition->id,
                    'title' => $eventData['title'],
                    'start_date' => $eventData['start_date'],
                    'end_date' => $eventData['end_date'],
                    'venue' => $eventData['venue'],
                    'ticket_url' => $eventData['ticket_url'],
                ]);
            }
        }
    }
}
