<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CleanGalleryImages extends Command
{
    protected $signature = 'clean:gallery-images {--hours=24 : The minimum age of files to be checked}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean orphaned gallery images from database and storage';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $hours = $this->option('hours');
        $this->info("Starting gallery images cleanup (older than {$hours} hours)...");

        $images = \App\Models\GalleryImage::whereNull('gallery_id')
            ->where('created_at', '<', now()->subHours($hours))
            ->cursor();

        $count = 0;
        foreach ($images as $image) {
            $image->delete();
            $count++;
        }

        $this->info("Successfully deleted {$count} orphaned gallery images.");
    }
}
