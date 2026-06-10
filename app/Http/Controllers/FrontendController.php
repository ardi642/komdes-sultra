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
        $posts = Post::berita()->published()->latest('published_at')->paginate(9);
        return view('pages.berita', compact('posts'));
    }

    public function artikel()
    {
        $posts = Post::artikel()->published()->latest('published_at')->paginate(9);
        return view('pages.artikel', compact('posts'));
    }

    public function riset()
    {
        $posts = Post::riset()->published()->latest('published_at')->paginate(9);
        return view('pages.riset', compact('posts'));
    }

    public function siaranPers()
    {
        $posts = Post::siaranPers()->published()->latest('published_at')->paginate(9);
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
        
        $relatedPosts = $issue->posts()->published()->latest('published_at')->take(4)->get();
        return view('pages.isu-detail', compact('issue', 'relatedPosts'));
    }
}
