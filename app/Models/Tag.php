<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tags', 'tag_id', 'post_id');
    }

    public function name(): Attribute
    {
        return new Attribute(
            get: fn ($value) => ucfirst($value),
            set: fn ($value) => strtolower($value)
        );
    }

    /**
     * Legacy method for tags stored as JSON in the posts table.
     * Use with caution, meant for backward compatibility only.
     */
    public static function getAllFromPosts()
    {
        $tags = \DB::table('posts')->select('tags')->get()->pluck('tags');

        $tags = $tags->map(function ($item) {
            return json_decode($item);
        });

        $tags = $tags->flatten()->unique()->values();

        return $tags;
    }
}
