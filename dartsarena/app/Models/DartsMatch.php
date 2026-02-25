<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DartsMatch extends Model
{
    protected $fillable = ['season_id', 'slug', 'round', 'scheduled_at', 'status', 'venue', 'best_of_legs', 'best_of_sets', 'player1_id', 'player2_id', 'player1_score_sets', 'player2_score_sets', 'player1_score_legs', 'player2_score_legs', 'winner_id', 'player1_average', 'player2_average', 'player1_checkout_pct', 'player2_checkout_pct', 'player1_180s', 'player2_180s', 'player1_highest_checkout', 'player2_highest_checkout'];
    protected $casts = ['scheduled_at' => 'datetime'];

    public function season() { return $this->belongsTo(Season::class); }
    public function player1() { return $this->belongsTo(Player::class, 'player1_id'); }
    public function player2() { return $this->belongsTo(Player::class, 'player2_id'); }
    public function winner() { return $this->belongsTo(Player::class, 'winner_id'); }
    public function stats() { return $this->hasMany(MatchStat::class, 'darts_match_id'); }
    public function bettingTips() { return $this->hasMany(BettingTip::class, 'darts_match_id'); }

    public function getScoreAttribute()
    {
        if ($this->best_of_sets) return $this->player1_score_sets . '-' . $this->player2_score_sets;
        return $this->player1_score_legs . '-' . $this->player2_score_legs;
    }

    public function getRouteKeyName() { return 'slug'; }
}
