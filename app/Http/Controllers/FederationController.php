<?php

namespace App\Http\Controllers;

use App\Models\Federation;
use Illuminate\Http\Request;

class FederationController extends Controller
{
    public function index()
    {
        $federations = Federation::orderBy('name')->get();

        return view('federations.index', compact('federations'));
    }

    public function show(Federation $federation)
    {
        $competitions = $federation->competitions()->orderBy('sort_order')->get();

        return view('federations.show', compact('federation', 'competitions'));
    }
}
