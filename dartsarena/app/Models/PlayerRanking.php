<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerRanking extends Model
{
    protected $fillable = ['player_id', 'federation_id', 'ranking_type', 'position', 'prize_money', 'previous_position', 'recorded_at'];
    protected $casts = ['recorded_at' => 'date', 'prize_money' => 'decimal:2'];

    public function player() { return $this->belongsTo(Player::class); }
    public function federation() { return $this->belongsTo(Federation::class); }

    public function getMovementAttribute()
    {
        if (!$this->previous_position) return 0;
        return $this->previous_position - $this->position;
    }
}
