<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'blog_id',
        'user_id',
        'parent_id',
        'content',
    ];

    // user nào cmt
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // cmt blog nào
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    // lấy các comment con (replies)
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')->with('user');
    }

    // chỉ lấy comment cha (parent_id = null)
    public function scopeParentOnly($query)
    {
        return $query->whereNull('parent_id');
    }
}
