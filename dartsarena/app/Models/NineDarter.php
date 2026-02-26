<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NineDarter extends Model
{
    protected $table = 'nine_darters';
    protected $fillable = [
        'player_id',
        'competition_id',
        'darts_match_id',
        'order_number',
        'video_url',
        'thumbnail_url',
        'on_tv',
        'achieved_at',
    ];

    protected $casts = [
        'on_tv' => 'boolean',
        'achieved_at' => 'datetime',
    ];

    // Relations
    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    public function match()
    {
        return $this->belongsTo(DartsMatch::class, 'darts_match_id');
    }

    // Scopes
    public function scopeOnTv($query)
    {
        return $query->where('on_tv', true);
    }

    // Methods
    public function getYouTubeEmbedUrl()
    {
        if (!$this->video_url) {
            return null;
        }

        // YouTube support
        if (preg_match('/youtube\.com\/watch\?v=([^&]+)/', $this->video_url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        if (preg_match('/youtu\.be\/([^?]+)/', $this->video_url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        // Vimeo support
        if (preg_match('/vimeo\.com\/(\d+)/', $this->video_url, $matches)) {
            return 'https://player.vimeo.com/video/' . $matches[1];
        }

        return $this->video_url;
    }

    public function getVideoThumbnailUrl()
    {
        if ($this->thumbnail_url) {
            return $this->thumbnail_url;
        }

        // Auto-generate YouTube thumbnail
        if (preg_match('/youtube\.com\/watch\?v=([^&]+)/', $this->video_url, $matches)) {
            return 'https://img.youtube.com/vi/' . $matches[1] . '/hqdefault.jpg';
        }

        if (preg_match('/youtu\.be\/([^?]+)/', $this->video_url, $matches)) {
            return 'https://img.youtube.com/vi/' . $matches[1] . '/hqdefault.jpg';
        }

        return null;
    }
}
