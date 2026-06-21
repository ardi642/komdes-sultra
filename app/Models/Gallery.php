<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasEditorImages;

class Gallery extends Model
{
    use HasEditorImages;

    protected $fillable = [
        'title',
        'slug',
        'date',
        'description',
        'video_url',
        'thumbnail',
        'user_id',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function getEditorContentAttributeNames()
    {
        return ['description'];
    }

    public function images()
    {
        return $this->hasMany(GalleryImage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($gallery) {
            if ($gallery->thumbnail) {
                try {
                    app(\App\Services\ImageService::class)->delete($gallery->thumbnail);
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::error('Failed to delete gallery thumbnail: ' . $e->getMessage());
                }
            }
        });
    }
}
