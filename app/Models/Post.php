<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $with = [
        'category',
        'tags',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeFilters(Builder $query, array $filters): void
    {
        if (isset($filters['search'])) {
            $query->where(fn (Builder $query) => $query
                ->where('title', 'LIKE', '%' . $filters['search'] . '%')
                ->orWhere('content', 'LIKE', '%' . $filters['search'] . '%')
            );
        }

        if (isset($filters['category'])) {
            $query->where(
                'category_id', $filters['category']->id ?? $filters['category']
            );
        }

        if (isset($filters['tag'])) {
            $query->whereRelation(
                'tags', 'tags.id', $filters['tag']->id ?? $filters['tag']
            );
        }
    }

    public function exists(): bool
    {
        return (bool) $this->id;
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->latest();
    }
}
