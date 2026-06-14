<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\HasEditorImages;

class Post extends Model
{
    use HasFactory, HasEditorImages;

    protected $fillable = [
        'type', 'title', 'slug', 'content', 'cover_image', 
        'published_at', 'author_id', 'category_id', 'views', 'is_published'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
    ];

    protected static function booted()
    {
        // Trait HasEditorImages handles the image sync on save and delete.
    }

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

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                      ->orWhere('content', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['category'] ?? false, function ($query, $category) {
            $query->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        });

        $query->when($filters['year'] ?? false, function ($query, $year) {
            $query->whereYear('published_at', $year);
        });

        $query->when($filters['month'] ?? false, function ($query, $month) {
            $query->whereMonth('published_at', $month);
        });

        $query->when($filters['tags'] ?? false, function ($query, $tags) {
            if (is_array($tags)) {
                $query->whereHas('tags', function ($query) use ($tags) {
                    $query->whereIn('slug', $tags);
                });
            }
        });
    }
}
