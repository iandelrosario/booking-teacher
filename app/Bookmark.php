<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $fillable  = ['user_id', 'post_id', 'comment'];

    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
