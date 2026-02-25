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

        // Get all events for the year
        $allEvents = CalendarEvent::with('competition.federation')
            ->whereYear('start_date', $currentYear)
            ->orderBy('start_date')
            ->get();

        // Filter by month if requested
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
                       strtolower($event->competition->federation->slug) === strtolower($federation);
            });
        }

        // Calendar data for current month
        $calendarDate = Carbon::create($currentYear, $currentMonth, 1);
        $daysInMonth = $calendarDate->daysInMonth;
        $firstDayOfWeek = $calendarDate->dayOfWeek; // 0 = Sunday

        // Get events grouped by day for calendar
        $eventsByDay = $allEvents
            ->filter(function($event) use ($currentYear, $currentMonth) {
                return $event->start_date->year == $currentYear &&
                       $event->start_date->month == $currentMonth;
            })
            ->groupBy(function($event) {
                return $event->start_date->day;
            });

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
