<?php

namespace App\Http\Controllers;

use App\Models\CalendarEvent;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        $upcomingEvents = CalendarEvent::with('competition.federation')
            ->where('end_date', '>=', now())
            ->orderBy('start_date')
            ->get();

        $pastEvents = CalendarEvent::with('competition.federation')
            ->where('end_date', '<', now())
            ->orderBy('start_date', 'desc')
            ->limit(10)
            ->get();

        return view('calendar.index', compact('upcomingEvents', 'pastEvents'));
    }
}
