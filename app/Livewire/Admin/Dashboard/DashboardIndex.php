<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Component;
use App\Models\Post;
use App\Models\Gallery;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardIndex extends Component
{
    public function render()
    {
        $user = auth()->user();
        $isMitraMedia = $user->hasRole('Mitra Media');

        // Global Stats
        $stats = [
            'total_posts' => 0,
            'total_galleries' => 0,
            'total_events' => 0,
            'total_users' => 0,
        ];

        // Chart Data
        $chartData = [
            'labels' => [],
            'values' => [],
        ];

        // Specific Data for Mitigation
        $draftPosts = [];
        $latestActivities = [];

        if ($isMitraMedia) {
            // Mitra Media Stats
            $stats['total_posts'] = Post::where('author_id', $user->id)->count();
            $stats['total_galleries'] = Gallery::where('user_id', $user->id)->count();
            $stats['total_events'] = Event::where('user_id', $user->id)->count();
            
            $draftPosts = Post::where('author_id', $user->id)
                            ->where('status', 'draft')
                            ->latest()
                            ->take(5)
                            ->get();

            $latestActivities = Post::where('author_id', $user->id)
                                  ->latest()
                                  ->take(5)
                                  ->get();
        } else {
            // Super Admin / Admin Stats
            $stats['total_posts'] = Post::count();
            $stats['total_galleries'] = Gallery::count();
            $stats['total_events'] = Event::count();
            $stats['total_users'] = User::role('Mitra Media')->count();

            // Last 6 months chart data
            for ($i = 5; $i >= 0; $i--) {
                $month = Carbon::now()->subMonths($i);
                $chartData['labels'][] = $month->translatedFormat('M Y');
                $chartData['values'][] = Post::whereYear('created_at', $month->year)
                                             ->whereMonth('created_at', $month->month)
                                             ->count();
            }

            // Latest Posts Activity
            $latestActivities = Post::with('author')
                                  ->latest()
                                  ->take(6)
                                  ->get();
        }

        return view('livewire.admin.dashboard.dashboard-index', [
            'isMitraMedia' => $isMitraMedia,
            'stats' => $stats,
            'chartData' => $chartData,
            'draftPosts' => $draftPosts,
            'latestActivities' => $latestActivities,
        ])->layout('layouts.admin');
    }
}
