<?php

namespace App\Models;

use App\Http\Controllers\MarkdownFileParser;
use App\Scopes\PublishedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'description',
        'featured_image',
        'tags',
        'published_at',
        'view_count',
        'status',
        'slug',
        'user_id'
    ];

    protected $casts = [
        'tags' => 'array',
        'published_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        // Order by latest posts by default, with draft posts first
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderByRaw('-published_at');
        });

        // Filter out posts that are not published
        static::addGlobalScope(new PublishedScope);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function description(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return new Attribute(
            get: fn ($value) => empty($value)
                ? substr($this->body, 0, 255)
                : $value
        );
    }

    public function featuredImage(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return new Attribute(
            get: fn ($value) => empty($value)
                ? asset('storage/default.jpg')
                : $value
        );
    }

    public function isPublished(): bool
    {
        return ($this->published_at !== null) && $this->published_at->isPast();
    }

    public function isFileBased(): bool
    {
        try {
            MarkdownFileParser::getQualifiedFilepath($this->slug);
            return true;
        } catch (\Throwable $th) {
            //
        }
        return false;
    }

    public function author(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    public function getViewCount(): int
    {
        if (! config('analytics.enabled')) {
            throw new \BadMethodCallException('Analytics are not enabled');
        }

        $cacheKey = "post.{$this->id}.views";
        $cacheDuration = config('analytics.view_count_cache_duration');

        // Get the cached value (even if expired)
        $value = cache()->get($cacheKey);

        if ($value !== null) {
            // If the cache exists but is stale, dispatch background refresh
            if (! cache()->has($cacheKey)) {
                dispatch(function () use ($cacheKey, $cacheDuration) {
                    $newValue = PageView::where('page', route('posts.show', $this, false))->count();
                    cache()->put($cacheKey, $newValue, now()->addMinutes($cacheDuration));
                })->afterResponse();
            }

            return $value;
        }

        // If no cached value exists at all, fetch and cache synchronously
        $value = PageView::where('page', route('posts.show', $this, false))->count();
        cache()->put($cacheKey, $value, now()->addMinutes($cacheDuration));

        return $value;
    }

    // Relations

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_categories', 'post_id', 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id');
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'post_id');
    }

    public function revisions()
    {
        return $this->hasMany(PostRevision::class, 'post_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'post_id');
    }
}
