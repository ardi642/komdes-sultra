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

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                      ->orWhere('content', 'like', '%' . $search . '%')
                      ->orWhere('location', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['year'] ?? false, function ($query, $year) {
            return $query->whereYear('event_date', $year);
        });

        $query->when($filters['month'] ?? false, function ($query, $month) {
            return $query->whereMonth('event_date', $month);
        });

        $query->when($filters['tags'] ?? false, function ($query, $tags) {
            return $query->whereHas('tags', function($query) use ($tags) {
                $query->whereIn('slug', is_array($tags) ? $tags : [$tags]);
            });
        });
    }
}
