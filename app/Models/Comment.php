<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'is_approved'];

    public function user(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function post(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Post::class, 'id', 'post_id');
    }
}