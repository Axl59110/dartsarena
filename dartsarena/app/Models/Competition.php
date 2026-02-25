<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Competition extends Model
{
    use HasTranslations, HasSlug;

    protected $fillable = ['federation_id', 'name', 'slug', 'description', 'format', 'prize_money', 'sort_order'];
    public $translatable = ['name', 'description'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom(function($model) {
            return $model->getTranslation('name', 'en');
        })->saveSlugsTo('slug');
    }

    public function federation() { return $this->belongsTo(Federation::class); }
    public function seasons() { return $this->hasMany(Season::class)->orderByDesc('year'); }
    public function calendarEvents() { return $this->hasMany(CalendarEvent::class); }

    public function getRouteKeyName() { return 'slug'; }
}
