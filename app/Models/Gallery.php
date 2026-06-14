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
}
