<?php

namespace App\Http\Controllers;

use App\Follower;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class HomeController extends Controller
{
    protected $limit;

    public function __construct()
    {
        $this->limit = config('paginate.limit');
    }

    public function index(Post $post, Follower $follower, User $user)
    {
        if (auth()->check()) {

            $followersRaw = $follower->where('user_id', auth()->id())->pluck('followed_user_id');
            $followers = Arr::collapse([$followersRaw,   [auth()->id()]]);

            $randomUser = $user->whereNotIn('id', $followers)->limit(3)->inRandomOrder()->get();

            $post = $post
                ->with(['like' => function ($query) {
                    $query->where('user_id', auth()->id());
                }])
                ->select(['id', 'user_id', 'slug', 'image', 'count_likes', 'count_comments', 'count_views', 'created_at'])
                ->with('user:id,first_name,last_name,username,profile')
                ->orderBy('created_at', 'desc')
                ->whereIn('user_id', $followers)
                ->where('is_published', 1)
                ->limit($this->limit)
                ->get();

            return view('index')
                ->with('randUser', $randomUser)
                ->with('limit', $this->limit)
                ->with('post', $post);
        }

        return view('guest.login');
    }

    public function home(User $user, $username)
    {
        $user =  $user
            ->with(['follower' => function ($query) {
                $query->where('user_id', auth()->id());
            }])
            ->with(['post' => function ($query) {
                $query->with(['like' => function ($query) {
                    $query->where('user_id', auth()->id());
                }]);
                $query->select(['id', 'user_id', 'slug', 'image', 'count_likes', 'count_comments', 'count_views', 'created_at']);
                $query->with('user:id,first_name,last_name,username,profile');
                $query->where('is_published', 1);
                $query->orderBy('created_at', 'desc');
                $query->limit($this->limit);
            }])
            ->select(['id', 'first_name', 'last_name', 'email_address', 'paypal_email_address', 'username', 'profile', 'count_post', 'count_followers', 'count_following'])
            ->where('username', $username)
            ->first();

        return view('home')
            ->with('username', $username)
            ->with('limit', $this->limit)
            ->with('user', $user);
    }
}
