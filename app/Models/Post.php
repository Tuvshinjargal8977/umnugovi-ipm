<?php

namespace App\Models;

use App\Models\Concerns\FlushesHomeCache;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use FlushesHomeCache, HasTranslations;

    protected $fillable = [
        'post_category_id', 'title', 'slug', 'excerpt', 'body',
        'cover_image', 'author', 'published_at',
    ];

    public array $translatable = ['title', 'excerpt', 'body'];

    protected $casts = ['published_at' => 'datetime'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->whereNotNull('published_at')->where('published_at', '<=', now());
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
