<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HeroSlider extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_path',
        'title',
        'subtitle',
        'btn1_text',
        'btn1_url',
        'btn2_text',
        'btn2_url',
        'is_active',
        'order_number',
    ];
}
