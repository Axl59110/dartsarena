<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Tag extends Model
{
    use HasTranslations, HasSlug;

    protected $fillable = ['name', 'slug', 'type'];
    public $translatable = ['name'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom(function($model) {
            return $model->getTranslation('name', 'en');
        })->saveSlugsTo('slug');
    }

    public function articles() { return $this->morphedByMany(Article::class, 'taggable'); }
    public function guides() { return $this->morphedByMany(Guide::class, 'taggable'); }
}
