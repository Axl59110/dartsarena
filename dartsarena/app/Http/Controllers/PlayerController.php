<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function index()
    {
        $players = Player::orderBy('last_name')->paginate(12);

        return view('players.index', compact('players'));
    }

    public function show(Player $player)
    {
        $player->load('rankings');
        $latestRanking = $player->rankings()
            ->orderBy('recorded_at', 'desc')
            ->first();

        return view('players.show', compact('player', 'latestRanking'));
    }
}
