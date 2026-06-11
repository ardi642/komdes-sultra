<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'date',
        'description',
        'video_url',
        'thumbnail',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function images()
    {
        return $this->hasMany(GalleryImage::class);
    }
}
