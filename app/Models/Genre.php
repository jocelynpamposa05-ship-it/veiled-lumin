<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    /**
     * Auto-generate slug from name whenever name is set,
     * unless a slug was explicitly provided.
     */
    public static function booted(): void
    {
        static::saving(function (Genre $genre) {
            if (empty($genre->slug) && ! empty($genre->name)) {
                $genre->slug = Str::slug($genre->name);
            }
        });
    }

    public function poems(): HasMany
    {
        return $this->hasMany(Poem::class);
    }
}
