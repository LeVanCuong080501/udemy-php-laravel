<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $fillable = ['blog_id', 'user_id', 'score'];

    // blog nào được rate
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    // user(member) rate
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
