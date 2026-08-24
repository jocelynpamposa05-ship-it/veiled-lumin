<?php

namespace App\Services;

use Cloudinary;
use Cloudinary\Uploader;
use Illuminate\Http\UploadedFile;

class CloudinaryService
{
    public function __construct()
    {
        // v1 static config
        Cloudinary::config([
            'cloud_name' => config('services.cloudinary.cloud_name'),
            'api_key'    => config('services.cloudinary.api_key'),
            'api_secret' => config('services.cloudinary.api_secret'),
            'secure'     => true,
        ]);
    }

    /**
     * Upload an image file to Cloudinary.
     * Returns public_id and secure_url.
     */
    public function upload(UploadedFile $file, string $folder = 'covers'): array
    {
        $result = Uploader::upload($file->getRealPath(), [
            'folder'          => $folder,
            'resource_type'   => 'image',
            'allowed_formats' => ['jpg', 'jpeg', 'png', 'webp'],
            'quality'         => 'auto',
            'fetch_format'    => 'auto',
        ]);

        return [
            'public_id' => $result['public_id'],
            'url'       => $result['secure_url'],
        ];
    }

    /**
     * Delete an image from Cloudinary by its public_id.
     */
    public function delete(string $publicId): void
    {
        try {
            Uploader::destroy($publicId);
        } catch (\Throwable) {
            // Silently ignore — image may already be gone
        }
    }

    /**
     * Build a secure URL from a stored public_id.
     */
    public function url(string $publicId): string
    {
        return cloudinary_url($publicId, ['secure' => true]);
    }
}
