<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'name',
        'logo',
        'description',
        'address',
        'email',
        'phone',
        'website',
        'instagram',
        'facebook',
        'twitter',
        'tiktok',
        'youtube',
        'linkedin',
        'order_number',
        'is_active',
    ];
}
