<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class CalendarEvent extends Model
{
    use HasTranslations;

    protected $fillable = ['competition_id', 'season_id', 'title', 'start_date', 'end_date', 'venue', 'location', 'ticket_url', 'tv_channel'];
    public $translatable = ['title'];
    protected $casts = ['start_date' => 'date', 'end_date' => 'date'];

    public function competition() { return $this->belongsTo(Competition::class); }
    public function season() { return $this->belongsTo(Season::class); }
}
