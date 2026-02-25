<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    public function index()
    {
        $competitions = Competition::with('federation')
            ->orderBy('sort_order')
            ->get();

        return view('competitions.index', compact('competitions'));
    }

    public function show(Competition $competition)
    {
        $competition->load('federation', 'seasons');

        return view('competitions.show', compact('competition'));
    }
}
