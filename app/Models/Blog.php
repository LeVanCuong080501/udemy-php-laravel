<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['title', 'image', 'description', 'content'];

    public function rate()
    {
        return $this->hasMany(Rate::class);
    }
}
