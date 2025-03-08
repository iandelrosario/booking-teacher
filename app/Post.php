<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable  = ['user_id', 'slug', 'image', 'content', 'count_likes', 'count_comments', 'count_views', 'is_published'];

    protected $appends = [
        'human_timestamp', 'edit_link', 'view_link'
    ];

    public function getImageAttribute($value)
    {
        if (config('filesystems.default') == 'public') {
            return url('media/' . $value);
        } else {
            return config('path.do') . '/' . $value;
        }
    }

    public function getHumanTimestampAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans(null);
    }

    public function getEditLinkAttribute()
    {
        if ($this->user_id == auth()->id()) {
            return route('posts.edit', ['slug' => $this->slug]);
        }
    }

    public function getViewLinkAttribute()
    {
        return route('posts.view', ['slug' => $this->slug]);
    }

    public function getCountViewsAttribute($value)
    {
        if ($value < 1000) {
            return round($value);
        } else if ($value >= 1000 && $value <= 999999) {
            return round($value / 1000) . 'K';
        } else if ($value >= 1000000) {
            return round($value / 1000000) . 'M';
        }

        return round($value);
    }

    public function getCountLikesAttribute($value)
    {
        if ($value < 1000) {
            return round($value);
        } else if ($value >= 1000 && $value <= 999999) {
            return round($value / 1000) . 'K';
        } else if ($value >= 1000000) {
            return round($value / 1000000) . 'M';
        }

        return round($value);
    }

    public function getCountCommentsAttribute($value)
    {
        if ($value < 1000) {
            return round($value);
        } else if ($value >= 1000 && $value <= 999999) {
            return round($value / 1000) . 'K';
        } else if ($value >= 1000000) {
            return round($value / 1000000) . 'M';
        }

        return round($value);
    }

    public function like()
    {
        return $this->hasOne('App\Likes');
    }

    public function bookmark()
    {
        return $this->hasOne('App\Bookmark');
    }

    public function comment()
    {
        return $this->hasMany('App\Comments');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
