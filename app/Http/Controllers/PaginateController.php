<?php

namespace App\Http\Controllers;

use App\Comments;
use App\Follower;
use App\Post;
use App\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PaginateController extends Controller
{

    protected $limit;

    public function __construct()
    {
        $this->limit = config('paginate.limit');
    }

    public function index(Post $post, Follower $follower, User $user, Request $request)
    {
        $newLimit = $request->l;

        $followersRaw = $follower->where('user_id', auth()->id())->pluck('followed_user_id');
        $followers = Arr::collapse([$followersRaw,   [auth()->id()]]);

        $randomUser = $user->whereNotIn('id', $followers)->limit(3)->inRandomOrder()->get();

        $result = $post
            ->select(['id', 'user_id', 'slug', 'image', 'count_likes', 'count_comments', 'count_views', 'created_at'])
            ->with(['like' => function ($query) {
                $query->where('user_id', auth()->id());
            }])
            ->with('user:id,first_name,last_name,username,profile')
            ->orderBy('created_at', 'desc')
            ->whereIn('user_id', $followers)
            ->where('is_published', 1)
            ->skip($newLimit)
            ->limit($this->limit)
            ->get();

        return response()
            ->view(
                'components.index_feed',
                [
                    'post' => $result,
                    'randUser' => $randomUser
                ]
            );
    }

    public function home(Post $post, User $user, Request $request)
    {
        $username = $request->u;
        $newLimit = $request->l;

        $user = $user->where('username', $username)->first();

        $result = $post
            ->select(['id', 'user_id', 'slug', 'image', 'count_likes', 'count_comments', 'count_views', 'created_at'])
            ->with(['like' => function ($query) {
                $query->where('user_id', auth()->id());
            }])
            ->with('user:id,first_name,last_name,username,profile')
            ->where('user_id', $user->id)
            ->where('is_published', 1)
            ->orderBy('created_at', 'desc')
            ->skip($newLimit)
            ->limit($this->limit)
            ->get();

        return response()
            ->view(
                'components.feed',
                [
                    'post' => $result,
                ]
            );
    }

    public function searchPeople(User $user, Request $request)
    {
        $newLimit = $request->l;
        $query = $request->q;

        $result = $user
            ->with(['follower' => function ($query) {
                $query->where('user_id', auth()->id());
            }])
            ->where('id', '!=', auth()->id())
            ->where(function ($q) use ($query) {
                $q
                    ->orWhere('first_name', 'LIKE', '%' . $query . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $query . '%')
                    ->orWhere('username', 'LIKE', '%' . $query . '%');
            })
            ->skip($newLimit)
            ->limit($this->limit)
            ->get();

        return response()
            ->view(
                'components.user_search',
                [
                    'result' => $result,
                ]
            );
        return response()->json($result);
    }

    public function searchPost(Post $post, Request $request)
    {
        $newLimit = $request->l;
        $query = $request->q;

        $result = $post
            ->with(['like' => function ($query) {
                $query->where('user_id', auth()->id());
            }])
            ->with('user:id,first_name,last_name,username,profile')
            ->where('content', 'LIKE', '%' . $query . '%')
            ->where('is_published', 1)
            ->skip($newLimit)
            ->limit($this->limit)
            ->get();

        return response()
            ->view(
                'components.feed',
                [
                    'post' => $result,
                ]
            );
    }

    public function searchTags(Post $post, Request $request)
    {
        $newLimit = $request->l;
        $query = $request->q;

        $is = Str::contains($query, '#');
        if ($is) {
            $query = $query;
        } else {
            $query = '#' . $query;
        }

        $result = $post
            ->with(['like' => function ($query) {
                $query->where('user_id', auth()->id());
            }])
            ->with('user:id,first_name,last_name,username,profile')
            ->where('content', 'LIKE', '%' . $query . '%')
            ->where('is_published', 1)
            ->skip($newLimit)
            ->limit($this->limit)
            ->get();

        return response()
            ->view(
                'components.feed',
                [
                    'post' => $result,
                ]
            );
    }

    public function comment(Comments $comments, Post $post, Request $request)
    {
        $slug = $request->s;
        $newLimit = $request->l;

        $post = $post->where('slug', $slug)->first();

        $result = $comments
            ->with('post:id,user_id,slug')
            ->with('user:id,first_name,last_name,profile,username')
            ->select(['id', 'user_id', 'comment', 'post_id', 'created_at'])
            ->where('post_id', $post->id)
            ->skip($newLimit)
            ->limit($this->limit)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()
            ->view(
                'components.comment_post',
                [
                    'post' => $result,
                ]
            );
    }

    public function followers(User $user, Follower $follower, Request $request)
    {
        $username = $request->u;
        $newLimit = $request->l;

        $uid = $user->where('username', $username)->value('id');

        $result = $follower
            ->with('user')
            ->where('followed_user_id', $uid)
            ->orderBy('created_at', 'desc')
            ->skip($newLimit)
            ->limit($this->limit)
            ->get();

        return response()
            ->view(
                'components.user_followers',
                [
                    'result' => $result,
                ]
            );
    }

    public function following(User $user, Follower $follower, Request $request)
    {
        $username = $request->u;
        $newLimit = $request->l;

        $uid = $user->where('username', $username)->value('id');

        $result = $follower
            ->with('userFollowing')
            ->where('user_id', $uid)
            ->orderBy('created_at', 'desc')
            ->skip($newLimit)
            ->limit($this->limit)
            ->get();

        return response()
            ->view(
                'components.user_following',
                [
                    'result' => $result,
                ]
            );
    }

    public function tags(Post $post, Request $request)
    {
        $newLimit = $request->l;
        $tags = $request->t;

        $result = $post
            ->select(['id', 'user_id', 'slug', 'image', 'count_likes', 'count_comments', 'count_views', 'created_at'])
            ->with(['like' => function ($query) {
                $query->where('user_id', auth()->id());
            }])
            ->with('user:id,first_name,last_name,username,profile')
            ->where('is_published', 1)
            ->where('content', 'LIKE', '%' . $tags . '%')
            ->orderBy('created_at', 'desc')
            ->skip($newLimit)
            ->limit($this->limit)
            ->get();

        return response()
            ->view(
                'components.feed',
                [
                    'post' => $result,
                ]
            );
    }
}
