<?php

namespace App\Services;

use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;
use Illuminate\Http\UploadedFile;

class CloudinaryService
{
    private Cloudinary $cloudinary;

    public function __construct()
    {
        Configuration::instance([
            'cloud' => [
                'cloud_name' => config('services.cloudinary.cloud_name'),
                'api_key'    => config('services.cloudinary.api_key'),
                'api_secret' => config('services.cloudinary.api_secret'),
            ],
            'url' => [
                'secure' => true,
            ],
        ]);

        $this->cloudinary = new Cloudinary();
    }

    /**
     * Upload an image file to Cloudinary.
     * Returns the public_id (used to reference / delete later).
     */
    public function upload(UploadedFile $file, string $folder = 'covers'): array
    {
        $result = $this->cloudinary->uploadApi()->upload(
            $file->getRealPath(),
            [
                'folder'           => $folder,
                'resource_type'    => 'image',
                'allowed_formats'  => ['jpg', 'jpeg', 'png', 'webp'],
                'transformation'   => [
                    'quality' => 'auto',
                    'fetch_format' => 'auto',
                ],
            ]
        );

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
            $this->cloudinary->uploadApi()->destroy($publicId);
        } catch (\Throwable) {
            // Silently ignore — image may already be gone
        }
    }

    /**
     * Build a secure URL from a stored public_id.
     */
    public function url(string $publicId): string
    {
        return $this->cloudinary->image($publicId)->toUrl();
    }
}
