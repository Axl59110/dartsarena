<?php

namespace App\Http\Controllers;

use App\Models\Federation;
use App\Models\PlayerRanking;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    public function index(Request $request)
    {
        $federationSlug = $request->get('federation', 'pdc');
        $rankingType = $request->get('type', 'order_of_merit');

        $federation = Federation::where('slug', $federationSlug)->firstOrFail();

        $rankings = PlayerRanking::with('player')
            ->where('federation_id', $federation->id)
            ->where('ranking_type', $rankingType)
            ->orderBy('position')
            ->get();

        $federations = Federation::all();

        return view('rankings.index', compact('rankings', 'federations', 'federation', 'rankingType'));
    }
}
