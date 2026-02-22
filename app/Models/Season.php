<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    protected $fillable = ['competition_id', 'year', 'start_date', 'end_date', 'status', 'venue', 'location', 'winner_id'];
    protected $casts = ['start_date' => 'date', 'end_date' => 'date'];

    public function competition() { return $this->belongsTo(Competition::class); }
    public function matches() { return $this->hasMany(DartsMatch::class)->orderBy('scheduled_at'); }
    public function winner() { return $this->belongsTo(Player::class, 'winner_id'); }
    public function calendarEvents() { return $this->hasMany(CalendarEvent::class); }
}
