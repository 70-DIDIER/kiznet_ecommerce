<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public static function resizeAndStore(
        UploadedFile $file, 
        string $folder = 'products',  // ← Ajouter ce paramètre
        int $targetWidth = 600, 
        int $targetHeight = 600
    ): string
    {
        $mime = $file->getMimeType();
        $path = $file->getRealPath();
        $src = self::createImageResource($path, $mime);
        
        if (!$src) {
            $stored = $file->store($folder, 'public');  // ← Utiliser $folder
            return Storage::url($stored);
        }

        $srcW = imagesx($src);
        $srcH = imagesy($src);
        $ratio = min($targetWidth / max(1, $srcW), $targetHeight / max(1, $srcH));
        $newW = max(1, (int) floor($srcW * $ratio));
        $newH = max(1, (int) floor($srcH * $ratio));

        $dst = imagecreatetruecolor($targetWidth, $targetHeight);
        $isTransparent = str_contains(strtolower($mime), 'png') || str_contains(strtolower($mime), 'webp');
        
        if ($isTransparent) {
            imagesavealpha($dst, true);
            $transparent = imagecolorallocatealpha($dst, 0, 0, 0, 127);
            imagefill($dst, 0, 0, $transparent);
        } else {
            $white = imagecolorallocate($dst, 255, 255, 255);
            imagefill($dst, 0, 0, $white);
        }

        $dstX = (int) floor(($targetWidth - $newW) / 2);
        $dstY = (int) floor(($targetHeight - $newH) / 2);
        imagecopyresampled($dst, $src, $dstX, $dstY, 0, 0, $newW, $newH, $srcW, $srcH);

        $ext = strtolower($file->getClientOriginalExtension());
        if (!$ext) {
            $ext = str_contains($mime, 'png') ? 'png' : (str_contains($mime, 'webp') ? 'webp' : 'jpg');
        }
        
        $filename = Str::uuid()->toString() . '.' . $ext;
        
        $dir = Storage::disk('public')->path($folder);  // ← Utiliser $folder
        if (!is_dir($dir)) {
            @mkdir($dir, 0775, true);
        }
        $full = $dir . DIRECTORY_SEPARATOR . $filename;

        switch ($ext) {
            case 'png':
                imagepng($dst, $full);
                break;
            case 'webp':
                if (function_exists('imagewebp')) {
                    imagewebp($dst, $full, 90);
                    break;
                }
                imagejpeg($dst, $full, 90);
                break;
            default:
                imagejpeg($dst, $full, 90);
        }

        imagedestroy($dst);
        imagedestroy($src);

        return Storage::url($folder . '/' . $filename);  // ← Utiliser $folder
    }

    protected static function createImageResource(string $path, ?string $mime)
    {
        // Vérifier si GD est disponible
        if (!function_exists('imagecreatefromjpeg')) {
            return null;
        }
        
        $m = strtolower((string) $mime);
        if (str_contains($m, 'jpeg') || str_contains($m, 'jpg')) {
            return @imagecreatefromjpeg($path);
        }
        if (str_contains($m, 'png')) {
            return @imagecreatefrompng($path);
        }
        if (str_contains($m, 'webp') && function_exists('imagecreatefromwebp')) {
            return @imagecreatefromwebp($path);
        }
        return null;
    }
}