<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Comments extends Model
{

    protected $fillable  = ['user_id', 'post_id', 'comment'];

    protected $appends = [
        'human_timestamp'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    public function getHumanTimestampAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans(null);
    }
}
