<?php

namespace App\Models;

use App\Services\CloudinaryService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Poem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'excerpt',
        'cover_image',      // Cloudinary public_id
        'cover_image_url',  // Cloudinary secure_url (stored so we never need to re-query)
        'genre_id',
        'status',
        'featured',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'featured'     => 'boolean',
    ];

    public static function booted(): void
    {
        static::saving(function (Poem $poem) {
            if (empty($poem->slug) && ! empty($poem->title)) {
                $poem->slug = Str::slug($poem->title);
            }

            if ($poem->status === 'published' && empty($poem->published_at)) {
                $poem->published_at = now();
            }
        });
    }

    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at');
    }

    /**
     * Returns the cover image URL.
     * Uses the stored secure_url — no extra API call needed.
     */
    public function getCoverUrlAttribute(): ?string
    {
        // Prefer the stored Cloudinary URL
        if ($this->cover_image_url) {
            return $this->cover_image_url;
        }

        // Fallback: old local storage path (for existing poems before migration)
        if ($this->cover_image && ! str_contains($this->cover_image, '/')) {
            return null; // public_id without URL stored yet — skip
        }

        return null;
    }

    /**
     * Delete the Cloudinary image for this poem.
     * Pass the CloudinaryService instance from the controller.
     */
    public function deleteCoverImage(CloudinaryService $cloudinary): void
    {
        if ($this->cover_image) {
            $cloudinary->delete($this->cover_image);
        }
    }
}
