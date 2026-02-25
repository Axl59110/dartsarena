<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Guide extends Model
{
    use HasTranslations, HasSlug;

    protected $fillable = ['title', 'slug', 'content', 'excerpt', 'featured_image', 'category', 'sort_order', 'is_published'];
    public $translatable = ['title', 'content', 'excerpt'];
    protected $casts = ['is_published' => 'boolean'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom(function($model) {
            return $model->getTranslation('title', 'fr') ?: $model->getTranslation('title', 'en');
        })->saveSlugsTo('slug');
    }

    public function tags() { return $this->morphToMany(Tag::class, 'taggable'); }
    public function getRouteKeyName() { return 'slug'; }
}
