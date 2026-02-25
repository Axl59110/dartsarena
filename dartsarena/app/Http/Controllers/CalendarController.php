<?php

namespace App\Http\Controllers;

use App\Models\CalendarEvent;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function index(Request $request)
    {
        $currentYear = $request->get('year', now()->year);
        $currentMonth = $request->get('month', now()->month);

        // Get all events (with future-proofing for multiple years)
        $allEvents = CalendarEvent::with('competition.federation')
            ->where(function($query) use ($currentYear) {
                $query->whereYear('start_date', $currentYear)
                      ->orWhereYear('end_date', $currentYear);
            })
            ->orderBy('start_date')
            ->get();

        // Filter by month if requested (for table display)
        $filteredEvents = $allEvents;
        if ($request->has('month') && $request->get('month') !== 'all') {
            $filteredEvents = $allEvents->filter(function($event) use ($currentMonth) {
                return $event->start_date->month == $currentMonth || $event->end_date->month == $currentMonth;
            });
        }

        // Filter by federation if requested
        if ($request->has('federation') && $request->get('federation') !== 'all') {
            $federation = $request->get('federation');
            $filteredEvents = $filteredEvents->filter(function($event) use ($federation) {
                return $event->competition &&
                       $event->competition->federation &&
                       strtolower($event->competition->federation->slug) === strtolower($federation);
            });
        }

        // Calendar data for current month (visual calendar)
        $calendarDate = Carbon::create($currentYear, $currentMonth, 1);
        $daysInMonth = $calendarDate->daysInMonth;
        $firstDayOfWeek = $calendarDate->dayOfWeek; // 0 = Sunday

        // Get events grouped by day for visual calendar (only for displayed month)
        $eventsByDay = collect();
        foreach($allEvents as $event) {
            // Check if event overlaps with current month
            $eventStart = $event->start_date;
            $eventEnd = $event->end_date;
            $monthStart = Carbon::create($currentYear, $currentMonth, 1);
            $monthEnd = $monthStart->copy()->endOfMonth();

            // If event overlaps this month, add it to relevant days
            if ($eventStart <= $monthEnd && $eventEnd >= $monthStart) {
                // Determine which day(s) to show the event on
                if ($eventStart->year == $currentYear && $eventStart->month == $currentMonth) {
                    // Event starts this month - show on start day
                    $day = $eventStart->day;
                    if (!$eventsByDay->has($day)) {
                        $eventsByDay[$day] = collect();
                    }
                    $eventsByDay[$day]->push($event);
                } elseif ($eventEnd->year == $currentYear && $eventEnd->month == $currentMonth) {
                    // Event ends this month but started earlier - show on day 1
                    if (!$eventsByDay->has(1)) {
                        $eventsByDay[1] = collect();
                    }
                    $eventsByDay[1]->push($event);
                } else {
                    // Event spans entire month - show on day 1
                    if (!$eventsByDay->has(1)) {
                        $eventsByDay[1] = collect();
                    }
                    $eventsByDay[1]->push($event);
                }
            }
        }

        return view('calendar.index', compact(
            'allEvents',
            'filteredEvents',
            'currentYear',
            'currentMonth',
            'calendarDate',
            'daysInMonth',
            'firstDayOfWeek',
            'eventsByDay'
        ));
    }
}
