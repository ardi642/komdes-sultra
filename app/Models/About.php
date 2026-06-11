<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
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
}
