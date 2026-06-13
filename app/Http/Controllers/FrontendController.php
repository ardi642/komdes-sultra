<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Event;
use App\Models\Issue;
use App\Models\Member;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = \App\Models\HeroSlider::where('is_active', true)->orderBy('order_number')->get();
        $sliderSetting = \App\Models\HeroSliderSetting::first();
        $homepageSetting = \App\Models\HomepageSetting::first();
        $members = \App\Models\Member::where('is_active', true)->orderBy('order_number')->get();
        $issues = Issue::where('status', 'active')->get();
        $events = Event::where('is_published', true)->orderBy('event_date', 'asc')->take(3)->get();
        
        $berita = Post::where('type', 'berita')->published()->latest('published_at')->take(3)->get();
        $artikel = Post::where('type', 'artikel')->published()->latest('published_at')->take(3)->get();
        $riset = Post::where('type', 'riset')->published()->latest('published_at')->take(3)->get();
        $siaran = Post::where('type', 'siaran_pers')->published()->latest('published_at')->take(3)->get();
        
        $galleries = \App\Models\Gallery::with('images')->latest('date')->take(3)->get();

        return view('pages.home', compact('sliders', 'sliderSetting', 'homepageSetting', 'members', 'issues', 'events', 'berita', 'artikel', 'riset', 'siaran', 'galleries'));
    }

    public function tentangKami()
    {
        $members = \App\Models\Member::where('is_active', true)
                                     ->orderBy('order_number')
                                     ->get();
        $about = \App\Models\About::first();
        return view('pages.tentang-kami', compact('members', 'about'));
    }

    public function anggota()
    {
        $members = Member::where('is_active', true)->orderBy('order_number')->get();
        return view('pages.anggota', compact('members'));
    }

    public function kontak()
    {
        $members = Member::where('is_active', true)->orderBy('order_number')->get();
        $contactSetting = \App\Models\ContactSetting::first();
        return view('pages.kontak', compact('members', 'contactSetting'));
    }

    public function kirimPesan(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subjek' => 'nullable|string|max:255',
            'pesan' => 'required|string',
        ]);

        \App\Models\Inbox::create([
            'name' => $validated['nama'],
            'email' => $validated['email'],
            'subject' => $validated['subjek'],
            'message' => $validated['pesan'],
            'is_read' => false,
        ]);

        return redirect()->back()->with('success', 'Laporan/aduan Anda berhasil dikirim. Terima kasih!');
    }

    public function berita()
    {
        $posts = Post::berita()->published()->filter(request(['search', 'category', 'year', 'month', 'tags']))->latest('published_at')->paginate(8)->withQueryString();
        return view('pages.berita', compact('posts'));
    }

    public function artikel()
    {
        $posts = Post::artikel()->published()->filter(request(['search', 'category', 'year', 'month', 'tags']))->latest('published_at')->paginate(8)->withQueryString();
        return view('pages.artikel', compact('posts'));
    }

    public function riset()
    {
        $posts = Post::riset()->published()->filter(request(['search', 'category', 'year', 'month', 'tags']))->latest('published_at')->paginate(8)->withQueryString();
        return view('pages.riset', compact('posts'));
    }

    public function siaranPers()
    {
        $posts = Post::siaranPers()->published()->filter(request(['search', 'category', 'year', 'month', 'tags']))->latest('published_at')->paginate(8)->withQueryString();
        return view('pages.siaran-pers', compact('posts'));
    }

    public function galeri(Request $request)
    {
        $query = \App\Models\Gallery::with('images');

        if ($request->filled('q')) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }

        if ($request->filled('tahun')) {
            $query->whereYear('date', $request->tahun);
        }

        $galleries = $query->latest('date')->paginate(9)->withQueryString();
        
        $years = \App\Models\Gallery::selectRaw('YEAR(date) as year')->distinct()->orderBy('year', 'desc')->pluck('year');

        return view('pages.galeri', compact('galleries', 'years'));
    }

    public function galeriDetail($slug)
    {
        $gallery = \App\Models\Gallery::with('images')->where('slug', $slug)->firstOrFail();
        return view('pages.galeri-detail', compact('gallery'));
    }

    public function acara()
    {
        $events = Event::where('is_published', true)
                       ->filter(request(['search', 'year', 'month', 'tags']))
                       ->orderBy('event_date', 'desc')
                       ->paginate(9)
                       ->withQueryString();
        
        $categories = collect(); // Acara tidak memiliki kategori
        
        $baseTagQuery = \App\Models\Tag::whereHas('events', function($q) {
            $q->where('is_published', true);
        })->withCount(['events' => function ($query) {
            $query->where('is_published', true);
        }]);
        
        $topTags = (clone $baseTagQuery)->orderBy('events_count', 'desc')->take(15)->get();
        $allTags = (clone $baseTagQuery)->orderBy('name', 'asc')->get();

        $archives = Event::where('is_published', true)
            ->selectRaw('YEAR(event_date) year, MONTH(event_date) month, count(*) published')
            ->groupBy('year', 'month')
            ->orderByRaw('year DESC, month DESC')
            ->get()
            ->groupBy('year');

        return view('pages.acara', compact('events', 'categories', 'topTags', 'allTags', 'archives'));
    }

    public function isu()
    {
        $issues = Issue::where('status', 'active')->paginate(9);
        return view('pages.isu', compact('issues'));
    }

    public function postDetail(Post $post)
    {
        if (!$post->is_published && !auth()->check()) {
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

    public function previewLive(Request $request)
    {
        // if (!auth()->check()) {
        //     abort(403);
        // }
        
        $data = session('preview_post_data');
        if (!$data) {
            return "Tidak ada data preview yang ditemukan. Silakan tutup tab ini dan klik 'Lihat Live Preview' kembali dari editor.";
        }

        $post = new Post([
            'title' => $data['title'] ?? 'Judul Preview',
            'type' => $data['type'] ?? 'berita',
            'content' => $data['content'] ?? '<p>Konten kosong.</p>',
        ]);
        $post->published_at = now();
        $post->is_published = true;
        $post->views = 0;
        
        // Mock category for view if needed
        if (!empty($data['category_id'])) {
            $post->setRelation('category', \App\Models\Category::find($data['category_id']));
        }
        
        // Mock cover image if needed (using placeholder or uploaded temp)
        if (!empty($data['cover_image'])) {
            $post->cover_image = $data['cover_image'];
        }
        
        $relatedPosts = collect();
        $viewMap = [
            'berita' => 'pages.berita-detail',
            'artikel' => 'pages.artikel-detail',
            'riset' => 'pages.riset-detail',
            'siaran_pers' => 'pages.siaran-pers-detail',
            'acara' => 'pages.acara-detail',
        ];
        
        if ($post->type === 'acara') {
            $event = new Event([
                'title' => $data['title'] ?? 'Judul Preview',
                'description' => $data['content'] ?? '<p>Konten kosong.</p>',
                'event_date' => $data['event_date'] ?? now(),
                'time' => $data['time'] ?? null,
                'location' => $data['location'] ?? 'Preview Location',
                'is_published' => true,
            ]);
            if (!empty($data['cover_image'])) {
                $event->cover_image = $data['cover_image'];
            }
            return view($viewMap[$post->type], compact('event'));
        }

        return view($viewMap[$post->type] ?? 'pages.berita-detail', compact('post', 'relatedPosts'));
    }

    public function eventDetail(Event $event)
    {
        if (!$event->is_published && !auth()->check()) {
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

        $baseQuery = $issue->posts()->published();

        // Base query for Posts
        $query = clone $baseQuery;

        // Apply filters for Post query (only if not viewing acara specifically)
        if (request('type') && request('type') !== 'acara') {
            $query->where('type', request('type'));
        }

        if (request('tahun')) {
            $query->whereYear('published_at', request('tahun'));
        }

        if (request('search')) {
            $search = request('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        if (request()->filled('tags')) {
            $tags = (array) request('tags');
            $query->whereHas('tags', function ($q) use ($tags) {
                $q->whereIn('slug', $tags);
            });
        }

        // Acara count logic
        $acaraCount = $issue->events()->where('is_published', true)->count();

        // Type counts for tabs
        $typeCountsRaw = $issue->posts()->published()->selectRaw('type, count(*) as total')->groupBy('type')->pluck('total', 'type')->toArray();
        $typeCounts = [
            'semua' => array_sum($typeCountsRaw) + $acaraCount,
            'berita' => $typeCountsRaw['berita'] ?? 0,
            'artikel' => $typeCountsRaw['artikel'] ?? 0,
            'riset' => $typeCountsRaw['riset'] ?? 0,
            'siaran_pers' => $typeCountsRaw['siaran_pers'] ?? 0,
            'acara' => $acaraCount,
        ];

        // Build Acara (Event) query filters
        $eventQuery = $issue->events()->where('is_published', true);
        if (request('tahun')) {
            $eventQuery->whereYear('event_date', request('tahun'));
        }
        if (request('search')) {
            $search = request('search');
            $eventQuery->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        if (request()->filled('tags')) {
            $tags = (array) request('tags');
            $eventQuery->whereHas('tags', function ($q) use ($tags) {
                $q->whereIn('slug', $tags);
            });
        }

        // Handle results based on type
        if (request('type') === 'acara') {
            $relatedPosts = $eventQuery->latest('event_date')->paginate(9)->withQueryString();
            
            $relatedPosts->getCollection()->transform(function ($item) {
                $item->type = 'acara';
                $item->content = $item->description;
                $item->published_at = $item->event_date; 
                return $item;
            });
        } elseif (empty(request('type')) || request('type') === 'semua') {
            $posts = $query->latest('published_at')->get();
            
            $events = $eventQuery->latest('event_date')->get()->map(function ($item) {
                $item->type = 'acara';
                $item->content = $item->description;
                $item->published_at = $item->event_date; 
                return $item;
            });

            $all = $posts->concat($events)->sortByDesc('published_at')->values();

            $page = \Illuminate\Pagination\Paginator::resolveCurrentPage() ?: 1;
            $perPage = 9;
            $relatedPosts = new \Illuminate\Pagination\LengthAwarePaginator(
                $all->slice(($page - 1) * $perPage, $perPage)->values(),
                $all->count(),
                $perPage,
                $page,
                ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath(), 'query' => request()->query()]
            );
        } else {
            $relatedPosts = $query->latest('published_at')->paginate(9)->withQueryString();
        }

        // Dynamic years for this issue's posts (union with events for completeness)
        $postYears = $issue->posts()->published()->selectRaw('YEAR(published_at) as year')->pluck('year')->toArray();
        $eventYears = $issue->events()->where('is_published', true)->selectRaw('YEAR(event_date) as year')->pluck('year')->toArray();
        $availableYears = collect(array_merge($postYears, $eventYears))->unique()->sortDesc()->values();

        // Dynamic tags for this issue's posts
        $availableTags = \App\Models\Tag::whereHas('posts', function($q) use ($issue) {
            $q->whereHas('issues', function($q2) use ($issue) {
                $q2->where('issues.id', $issue->id);
            })->published();
        })->orWhereHas('events', function($q) use ($issue) {
            $q->whereHas('issues', function($q2) use ($issue) {
                $q2->where('issues.id', $issue->id);
            })->where('is_published', true);
        })->get();

        return view('pages.isu-detail', compact('issue', 'relatedPosts', 'availableYears', 'availableTags', 'typeCounts'));
    }
}
