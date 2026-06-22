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
        'footer_description',
        'facebook_url',
        'instagram_url',
        'twitter_url',
        'tiktok_url',
        'youtube_url',
        'linkedin_url',
    ];

    protected $casts = [
        'site_name_segments' => 'array',
    ];
}
