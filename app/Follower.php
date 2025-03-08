<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    protected $fillable  = ['user_id', 'followed_user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function userFollowing()
    {
        return $this->belongsTo('App\User', 'followed_user_id', 'id');
    }
}
