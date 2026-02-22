<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatchStat extends Model
{
    protected $fillable = ['darts_match_id', 'stat_type', 'player_position', 'value'];

    public function match() { return $this->belongsTo(DartsMatch::class, 'darts_match_id'); }
}
