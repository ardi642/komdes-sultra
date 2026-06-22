<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSetting extends Model
{
    protected $fillable = [
        'site_name',
        'site_name_segments',
        'logo',
        'favicon',
        'phone',
        'email',
        'website',
        'address',
        'map_embed',
    ];

    protected $casts = [
        'site_name_segments' => 'array',
    ];
}
