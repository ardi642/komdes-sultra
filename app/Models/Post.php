<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'title', 'slug', 'content', 'cover_image', 
        'published_at', 'author_id', 'category_id', 'views', 'is_published'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function issues()
    {
        return $this->belongsToMany(Issue::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // Scopes
    public function scopeBerita($query)
    {
        return $query->where('type', 'berita');
    }

    public function scopeArtikel($query)
    {
        return $query->where('type', 'artikel');
    }

    public function scopeRiset($query)
    {
        return $query->where('type', 'riset');
    }

    public function scopeSiaranPers($query)
    {
        return $query->where('type', 'siaran_pers');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)->whereNotNull('published_at')->where('published_at', '<=', now());
    }
}
