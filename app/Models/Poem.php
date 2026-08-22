<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Poem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'excerpt',
        'cover_image',
        'genre_id',
        'status',
        'featured',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'featured'     => 'boolean',
    ];

    /**
     * Auto-generate slug from title whenever title is set,
     * unless a slug was explicitly provided.
     */
    public static function booted(): void
    {
        static::saving(function (Poem $poem) {
            if (empty($poem->slug) && ! empty($poem->title)) {
                $poem->slug = Str::slug($poem->title);
            }

            // When a poem is marked published and has no timestamp yet, stamp it now.
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
     * Full public URL for the cover image, or null if none is set.
     */
    public function getCoverUrlAttribute(): ?string
    {
        return $this->cover_image
            ? Storage::disk('public')->url($this->cover_image)
            : null;
    }

    /**
     * Delete the stored cover image file from disk.
     */
    public function deleteCoverImage(): void
    {
        if ($this->cover_image) {
            Storage::disk('public')->delete($this->cover_image);
        }
    }
}
