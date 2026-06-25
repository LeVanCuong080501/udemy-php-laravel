<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Rate;

class Blog extends Model
{
    protected $fillable = ['title', 'image', 'description', 'content'];

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }
}