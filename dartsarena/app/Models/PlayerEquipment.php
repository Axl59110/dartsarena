<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class PlayerEquipment extends Model
{
    use HasTranslations;

    protected $table = 'player_equipments';
    protected $fillable = [
        'player_id',
        'equipment_type',
        'brand',
        'model',
        'description',
        'photo_url',
        'affiliate_link',
        'is_current',
        'started_at',
        'ended_at',
    ];

    public $translatable = ['description'];

    protected $casts = [
        'is_current' => 'boolean',
        'started_at' => 'date',
        'ended_at' => 'date',
    ];

    // Relations
    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    // Scopes
    public function scopeCurrent($query)
    {
        return $query->where('is_current', true);
    }

    public function scopePrevious($query)
    {
        return $query->where('is_current', false);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('equipment_type', $type);
    }

    // Accessors
    public function getFullNameAttribute()
    {
        return trim($this->brand . ' ' . $this->model);
    }

    public function getPeriodAttribute()
    {
        if (!$this->started_at) {
            return null;
        }

        $start = $this->started_at->format('Y');
        $end = $this->ended_at ? $this->ended_at->format('Y') : __('Présent');

        return "{$start} - {$end}";
    }
}
