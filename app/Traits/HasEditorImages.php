<?php

namespace App\Traits;

use App\Models\EditorImage;

trait HasEditorImages
{
    /**
     * Get the rich text content attribute names.
     * Override this method if your model uses different column names for the content.
     */
    public function getEditorContentAttributeNames()
    {
        return ['content'];
    }

    /**
     * Boot the trait and register model events.
     */
    protected static function bootHasEditorImages()
    {
        static::saved(function ($model) {
            $model->syncEditorImages();
        });

        // Optional: If you want to detach images when model is deleted (so scheduler can clean them up)
        static::deleted(function ($model) {
            // If soft deleting, maybe we don't detach. If force deleting, we detach.
            if (method_exists($model, 'isForceDeleting') && !$model->isForceDeleting()) {
                return;
            }
            
            $model->editorImages()->update([
                'imageable_id' => null,
                'imageable_type' => null
            ]);
        });
    }

    /**
     * Get all related editor images.
     */
    public function editorImages()
    {
        return $this->morphMany(EditorImage::class, 'imageable');
    }

    /**
     * Sync images found in the HTML content with the database.
     */
    public function syncEditorImages()
    {
        $contentFields = $this->getEditorContentAttributeNames();
        $usedImageUrls = [];

        foreach ($contentFields as $field) {
            $htmlContent = $this->getAttribute($field);

            if (!empty($htmlContent)) {
                $dom = new \DOMDocument();
                // Suppress warnings for malformed HTML
                @$dom->loadHTML('<?xml encoding="UTF-8">' . $htmlContent, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

                $images = $dom->getElementsByTagName('img');

                foreach ($images as $img) {
                    $usedImageUrls[] = $img->getAttribute('src');
                }
            }
        }
        
        $usedImageUrls = array_unique($usedImageUrls);

        // First, detach ALL images currently attached to this model
        $this->editorImages()->update([
            'imageable_id' => null,
            'imageable_type' => null
        ]);

        if (count($usedImageUrls) > 0) {
            // Second, attach the ones that ARE in the HTML content
            // We use a query loop with LIKE to ensure that absolute vs relative URLs match perfectly
            // (e.g. /storage/editor/img.jpg matches http://127.0.0.1/storage/editor/img.jpg)
            
            $query = EditorImage::query();
            foreach ($usedImageUrls as $url) {
                $filename = basename(parse_url($url, PHP_URL_PATH));
                if ($filename) {
                    $query->orWhere('file_path', 'LIKE', '%/' . $filename);
                }
            }
            
            $query->update([
                'imageable_id' => $this->id,
                'imageable_type' => get_class($this)
            ]);
        }
    }
}
