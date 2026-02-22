<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Federation extends Model
{
    use HasTranslations, HasSlug;

    protected $fillable = ['name', 'slug', 'description', 'logo_url', 'website_url'];
    public $translatable = ['name', 'description'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom(function($model) {
            return $model->getTranslation('name', 'en');
        })->saveSlugsTo('slug');
    }

    public function competitions() { return $this->hasMany(Competition::class); }
    public function playerRankings() { return $this->hasMany(PlayerRanking::class); }
}
