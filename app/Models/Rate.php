<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $fillable = ['blog_id', 'user_id', 'score'];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
