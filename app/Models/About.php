<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\ImageService;

use App\Traits\HasEditorImages;

class About extends Model
{
    use HasFactory, HasEditorImages;

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

    public function getEditorContentAttributeNames()
    {
        return ['profil_singkat', 'mengapa_komdes'];
    }

    protected static function booted()
    {
        // Trait HasEditorImages handles the image sync on save.
    }
}
