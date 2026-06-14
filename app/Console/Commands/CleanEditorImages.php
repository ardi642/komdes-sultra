<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\EditorImage;
use Carbon\Carbon;

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
    public function handle()
    {
        $this->info('Starting editor images cleanup...');

        $hours = $this->option('hours');
        $deletedCount = 0;
        
        $orphanedImages = EditorImage::whereNull('imageable_id')
            ->where('created_at', '<', Carbon::now()->subHours($hours))
            ->get();

        foreach ($orphanedImages as $image) {
            // Determine relative path for Storage disk
            // Example $image->file_path: "http://domain.com/storage/uploads/editor/xyz.jpg" or "/storage/uploads/editor/xyz.jpg"
            $parsedUrl = parse_url($image->file_path, PHP_URL_PATH);
            
            // Remove '/storage/' prefix to get the relative path inside storage/app/public
            $relativePath = preg_replace('#^/?storage/#', '', $parsedUrl);
            
            // Delete the physical file if it exists
            if (Storage::disk('public')->exists($relativePath)) {
                Storage::disk('public')->delete($relativePath);
                $this->line("Deleted physical file: {$relativePath}");
            }
            
            // Always delete the database record
            $image->delete();
            $this->line("Deleted DB record for orphaned image ID: {$image->id}");
            $deletedCount++;
        }

        $this->info("Cleanup completed. Deleted {$deletedCount} orphaned images.");
    }
}
