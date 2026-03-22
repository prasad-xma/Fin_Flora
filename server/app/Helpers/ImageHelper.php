<?php

namespace App\Helpers;

class ImageHelper
{
    public static function getAvailableItemImages()
    {
        $imagePath = public_path('images/items');
        
        if (!file_exists($imagePath)) {
            return [];
        }
        
        $images = [];
        $files = scandir($imagePath);
        
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                    $images[] = [
                        'filename' => $file,
                        'path' => 'images/items/' . $file,
                        'url' => asset('images/items/' . $file),
                        'size' => filesize($imagePath . '/' . $file)
                    ];
                }
            }
        }
        
        // Sort by filename
        usort($images, function($a, $b) {
            return strcmp($a['filename'], $b['filename']);
        });
        
        return $images;
    }
    
    public static function isValidItemImage($filename)
    {
        $imagePath = public_path('images/items/' . $filename);
        return file_exists($imagePath);
    }
}
