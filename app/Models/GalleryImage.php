<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    protected $fillable = [
        'gallery_id',
        'image_path',
        'order_column',
    ];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($image) {
            app(\App\Services\ImageService::class)->delete($image->image_path);
        });
    }
}
