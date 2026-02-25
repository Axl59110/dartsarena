<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Player extends Model
{
    use HasTranslations, HasSlug;

    protected $fillable = ['first_name', 'last_name', 'nickname', 'slug', 'nationality', 'country_code', 'date_of_birth', 'photo_url', 'bio', 'career_titles', 'career_9darters', 'career_highest_average'];
    public $translatable = ['nickname', 'bio'];
    protected $casts = ['date_of_birth' => 'date'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom(['first_name', 'last_name'])->saveSlugsTo('slug');
    }

    public function rankings() { return $this->hasMany(PlayerRanking::class); }
    public function matchesAsPlayer1() { return $this->hasMany(DartsMatch::class, 'player1_id'); }
    public function matchesAsPlayer2() { return $this->hasMany(DartsMatch::class, 'player2_id'); }

    public function getFullNameAttribute() { return $this->first_name . ' ' . $this->last_name; }
    public function getRouteKeyName() { return 'slug'; }

    public function latestRanking($federationId = null)
    {
        $query = $this->rankings()->orderByDesc('recorded_at');
        if ($federationId) $query->where('federation_id', $federationId);
        return $query->first();
    }
}
