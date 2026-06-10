<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'description', 'content', 
        'event_date', 'time', 'location', 'cover_image', 
        'registration_url', 'status', 'is_published', 'published_at'
    ];

    protected $casts = [
        'event_date' => 'date',
        'published_at' => 'datetime',
        'is_published' => 'boolean',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function issues()
    {
        return $this->belongsToMany(Issue::class, 'issue_event');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('status', 'upcoming');
    }
}
