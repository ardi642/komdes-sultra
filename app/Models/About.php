<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\ImageService;

class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'hero_description',
        'profil_singkat',
        'mengapa_komdes',
        'tujuan_quote',
        'tujuan_list',
        'intensi_list',
        'sikap_list',
    ];

    protected $casts = [
        'tujuan_list' => 'array',
        'intensi_list' => 'array',
        'sikap_list' => 'array',
    ];

    protected static function booted()
    {
        static::updating(function ($about) {
            $imageService = new ImageService();
            if ($about->isDirty('profil_singkat')) {
                $imageService->cleanRemovedImagesFromHtml($about->getOriginal('profil_singkat'), $about->profil_singkat);
            }
            if ($about->isDirty('mengapa_komdes')) {
                $imageService->cleanRemovedImagesFromHtml($about->getOriginal('mengapa_komdes'), $about->mengapa_komdes);
            }
        });
    }
}
