<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Event;
use App\Models\Issue;

class FrontendController extends Controller
{
    public function index()
    {
        $issues = Issue::where('status', 'active')->take(6)->get();
        $events = Event::where('is_published', true)->orderBy('event_date', 'asc')->take(3)->get();
        
        $berita = Post::where('type', 'berita')->published()->latest('published_at')->take(3)->get();
        $artikel = Post::where('type', 'artikel')->published()->latest('published_at')->take(3)->get();
        $riset = Post::where('type', 'riset')->published()->latest('published_at')->take(3)->get();
        $siaran = Post::where('type', 'siaran_pers')->published()->latest('published_at')->take(4)->get();

        return view('pages.home', compact('issues', 'events', 'berita', 'artikel', 'riset', 'siaran'));
    }

    public function berita()
    {
        $posts = Post::berita()->published()->filter(request(['search', 'category', 'year', 'month', 'tags']))->latest('published_at')->paginate(9)->withQueryString();
        return view('pages.berita', compact('posts'));
    }

    public function artikel()
    {
        $posts = Post::artikel()->published()->filter(request(['search', 'category', 'year', 'month', 'tags']))->latest('published_at')->paginate(9)->withQueryString();
        return view('pages.artikel', compact('posts'));
    }

    public function riset()
    {
        $posts = Post::riset()->published()->filter(request(['search', 'category', 'year', 'month', 'tags']))->latest('published_at')->paginate(9)->withQueryString();
        return view('pages.riset', compact('posts'));
    }

    public function siaranPers()
    {
        $posts = Post::siaranPers()->published()->filter(request(['search', 'category', 'year', 'month', 'tags']))->latest('published_at')->paginate(9)->withQueryString();
        return view('pages.siaran-pers', compact('posts'));
    }

    public function acara()
    {
        $events = Event::where('is_published', true)->orderBy('event_date', 'desc')->paginate(9);
        return view('pages.acara', compact('events'));
    }

    public function isu()
    {
        $issues = Issue::where('status', 'active')->paginate(12);
        return view('pages.isu', compact('issues'));
    }

    public function postDetail(Post $post)
    {
        if (!$post->is_published) {
            abort(404);
        }
        $post->increment('views');
        
        $relatedPosts = Post::where('type', $post->type)
            ->where('id', '!=', $post->id)
            ->published()
            ->latest('published_at')
            ->take(3)
            ->get();
            
        // Map to correct view based on type
        $viewMap = [
            'berita' => 'pages.berita-detail',
            'artikel' => 'pages.artikel-detail',
            'riset' => 'pages.riset-detail',
            'siaran_pers' => 'pages.siaran-pers-detail',
        ];
        
        return view($viewMap[$post->type], compact('post', 'relatedPosts'));
    }

    public function eventDetail(Event $event)
    {
        if (!$event->is_published) {
            abort(404);
        }
        return view('pages.acara-detail', compact('event'));
    }

    public function issueDetail(Issue $issue)
    {
        if ($issue->status !== 'active') {
            abort(404);
        }
        
        $query = $issue->posts()->published();

        // Tipe Konten
        if (request()->filled('type')) {
            $query->where('type', request('type'));
        }

        // Tahun
        if (request()->filled('tahun')) {
            $query->whereYear('published_at', request('tahun'));
        }

        // Pencarian Teks
        if (request()->filled('search')) {
            $search = request('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Tag (Multiple)
        if (request()->filled('tags')) {
            $tags = (array) request('tags');
            $query->whereHas('tags', function ($q) use ($tags) {
                $q->whereIn('slug', $tags);
            });
        }

        $relatedPosts = $query->latest('published_at')->paginate(12)->withQueryString();

        // Dynamic years for this issue's posts
        $availableYears = $issue->posts()->published()
            ->selectRaw('YEAR(published_at) as year')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->pluck('year');

        // Dynamic tags for this issue's posts
        $availableTags = \App\Models\Tag::whereHas('posts', function($q) use ($issue) {
            $q->whereHas('issues', function($q2) use ($issue) {
                $q2->where('issues.id', $issue->id);
            })->published();
        })->get();

        // Type counts for tabs (unfiltered by current type, but filtered by other active filters to be accurate, or just total for the issue)
        // Usually, tabs show the total counts for the issue regardless of current filter.
        $typeCountsRaw = $issue->posts()->published()->selectRaw('type, count(*) as total')->groupBy('type')->pluck('total', 'type')->toArray();
        $typeCounts = [
            'semua' => array_sum($typeCountsRaw),
            'berita' => $typeCountsRaw['berita'] ?? 0,
            'artikel' => $typeCountsRaw['artikel'] ?? 0,
            'riset' => $typeCountsRaw['riset'] ?? 0,
            'siaran_pers' => $typeCountsRaw['siaran_pers'] ?? 0,
            'acara' => $typeCountsRaw['acara'] ?? 0,
        ];

        return view('pages.isu-detail', compact('issue', 'relatedPosts', 'availableYears', 'availableTags', 'typeCounts'));
    }
}
