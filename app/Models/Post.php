<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function board()
    {
        return $this->belongsTo(Board::class);
    }
    public function likes()
    {
        return $this->hasMany(PostLike::class)->where('type', 'like');
    }

    public function dislikes()
    {
        return $this->hasMany(PostLike::class)->where('type', 'dislike');
    }
    public function totalLikes()
    {
        return $this->hasMany(PostLike::class)->where('type', 'like')->count();
    }

    public function totalDislikes()
    {
        return $this->hasMany(PostLike::class)->where('type', 'dislike')->count();
    }
}
