<?php

namespace App\Http\Controllers;

use App\Follower;
use App\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    protected $limit;

    public function __construct()
    {
        $this->limit = config('paginate.limit');
    }

    public function follow(Follower $follower, User $user, Request $request)
    {
        $username = $request->username;
        $id = auth()->id();

        $followed = $user->where('username', $username)->first();

        $count = $follower->where('user_id', $id)->where('followed_user_id', $followed->id);

        if ($count->count() > 0) {
            $follower->where('user_id', $id)->where('followed_user_id', $followed->id)->delete();
            $followed->decrement('count_followers');
            $user->find($id)->decrement('count_following');

            return redirect()->route('login');
        } else {
            $follower->fill(['user_id' => $id, 'followed_user_id' => $followed->id])->save();
            $followed->increment('count_followers');
            $user->find($id)->increment('count_following');

            return back();
        }
    }

    public function followers(User $user, Follower $follower, $username)
    {
        $uid = $user->where('username', $username)->value('id');

        if (auth()->id() != $uid) {
            $follower = $follower->where('user_id', auth()->id())->where('followed_user_id', $uid)->count();
            if ($follower  <= 0) {
                return back();
            }
        }

        $user = $user
            ->with(['followers' => function ($query) {
                $query->select(['id', 'user_id', 'followed_user_id', 'created_at']);
                $query->with('user:id,first_name,last_name,username,profile,paypal_email_address,count_post,count_followers,count_following');
                $query->orderBy('created_at', 'desc');
                $query->limit($this->limit);
            }])
            ->select(['id', 'first_name', 'last_name', 'email_address', 'paypal_email_address', 'username', 'profile', 'count_post', 'count_followers', 'count_following'])
            ->where('username', $username)
            ->first();

        return view('followers')
            ->with('limit', $this->limit)
            ->with('user', $user);
    }

    public function following(User $user, Follower $follower, $username)
    {


        $uid = $user->where('username', $username)->value('id');

        if (auth()->id() != $uid) {
            $follower = $follower->where('user_id', auth()->id())->where('followed_user_id', $uid)->count();
            if ($follower  <= 0) {
                return back();
            }
        }

        $user = $user
            ->with(['following' => function ($query) {
                $query->select(['id', 'user_id', 'followed_user_id', 'created_at']);
                $query->with('userFollowing:id,first_name,last_name,username,profile,paypal_email_address,count_post,count_followers,count_following');
                $query->orderBy('created_at', 'desc');
                $query->limit($this->limit);
            }])
            ->select(['id', 'first_name', 'last_name', 'email_address', 'paypal_email_address', 'username', 'profile', 'count_post', 'count_followers', 'count_following'])
            ->where('username', $username)
            ->first(); 
            
        return view('following')
            ->with('limit', $this->limit)
            ->with('user', $user);
    }
}
