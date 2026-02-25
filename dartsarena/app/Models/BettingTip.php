<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class BettingTip extends Model
{
    use HasTranslations;

    protected $fillable = ['darts_match_id', 'title', 'prediction', 'odds_player1', 'odds_player2', 'analysis', 'confidence', 'bookmaker', 'is_published', 'result'];
    public $translatable = ['title', 'analysis'];
    protected $casts = ['is_published' => 'boolean'];

    public function match() { return $this->belongsTo(DartsMatch::class, 'darts_match_id'); }
}
