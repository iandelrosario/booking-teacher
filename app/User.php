<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $fillable = [
        'first_name', 'last_name', 'email_address', 'paypal_email_address', 'gender', 'username', 'profile', 'password', 'ip_address', 'is_verified', 'count_post', 'count_followers', 'count_following'
    ];

    protected $appends = [
        'fullname', 'profile_link', 'donate_link'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function setUsernameAttribute($value)
    {
        $this->attributes['username'] = Str::lower($value);
    }

    public function getFullnameAttribute()
    {
        return Str::title($this->first_name . ' ' . $this->last_name);
    }

    public function getProfileAttribute($value)
    {
        if ($value) {
            if (config('filesystems.default') == 'public') {
                return url('media/' . $value);
            } else {
                return config('path.do') . '/' . $value;
            }
        } else {
            return url('assets/images/default.png');
        }
    }

    public function getProfileLinkAttribute()
    {
        return route('user.home', ['username' => $this->username]);
    }

    public function getDonateLinkAttribute()
    {
        return route('paypal.donate', ['username' => $this->username]);
    }

    public function getCountPostAttribute($value)
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

    public function getCountFollowingAttribute($value)
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

    public function getCountFollowersAttribute($value)
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

    public function post()
    {
        return $this->hasMany('App\Post');
    }

    public function follower()
    {
        return $this->hasOne('App\Follower', 'followed_user_id', 'id');
    }

    public function followers()
    {
        return $this->hasMany('App\Follower', 'followed_user_id', 'id');
    }

    public function following()
    {
        return $this->hasMany('App\Follower');
    }
}
