<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\Event;
use App\Models\About;
use Carbon\Carbon;
use App\Services\ImageService;

class CleanEditorImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean:editor-images {--hours=24 : The minimum age of files to be checked}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean orphaned images uploaded via text editors that are not linked in any content.';

    /**
     * Execute the console command.
     */
    public function handle(ImageService $imageService)
    {
        $this->info('Starting editor images cleanup...');

        $hours = $this->option('hours');
        $directory = 'uploads/editor';

        if (!Storage::disk('public')->exists($directory)) {
            $this->info("Directory {$directory} does not exist. Nothing to clean.");
            return;
        }

        $files = Storage::disk('public')->files($directory);
        $deletedCount = 0;
        
        // Combine all HTML contents from tables that use the editor
        $allContents = '';
        
        $posts = Post::select('content')->get();
        foreach ($posts as $post) {
            $allContents .= $post->content . ' ';
        }
        
        $events = Event::select('description', 'content')->get();
        foreach ($events as $event) {
            $allContents .= $event->description . ' ' . $event->content . ' ';
        }
        
        $abouts = About::first();
        if ($abouts) {
            // Include fields that might contain HTML/Images, mostly profil_singkat or mengapa_komdes if they ever use editor
            // Just append it if it exists
            $allContents .= $abouts->profil_singkat . ' ' . $abouts->mengapa_komdes . ' ';
        }

        $activeImages = $imageService->extractImagesFromHtml($allContents);
        
        // Convert active image URLs to pure basenames for easier comparison
        $activeBasenames = array_map(function($url) {
            return basename(parse_url($url, PHP_URL_PATH));
        }, $activeImages);

        $now = Carbon::now();

        foreach ($files as $file) {
            $lastModified = Carbon::createFromTimestamp(Storage::disk('public')->lastModified($file));
            
            // Only check files older than X hours
            if ($now->diffInHours($lastModified) >= $hours) {
                $filename = basename($file);
                
                // If the file is not found in the active images list
                if (!in_array($filename, $activeBasenames)) {
                    Storage::disk('public')->delete($file);
                    $this->line("Deleted orphaned image: {$filename}");
                    $deletedCount++;
                }
            }
        }

        $this->info("Cleanup completed. Deleted {$deletedCount} orphaned images.");
    }
}
