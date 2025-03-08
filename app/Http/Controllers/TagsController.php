<?php

namespace App\Http\Controllers;

use App\Post;

class TagsController extends Controller
{

    protected $limit;

    public function __construct()
    {
        $this->limit = config('paginate.limit');
    }

    public function index(Post $post, $tags)
    {
        $post = $post->select(['id', 'user_id', 'slug', 'content', 'image', 'count_likes', 'count_comments', 'created_at'])
            ->with(['like' => function ($query) {
                $query->where('user_id', auth()->id());
            }])
            ->where('content', 'LIKE', '%' . $tags . '%')
            ->where('is_published', 1)
            ->with('user:id,first_name,last_name,username,profile')
            ->limit($this->limit)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('tags')
            ->with('limit', $this->limit)
            ->with('tags', $tags)
            ->with('post', $post);
    }
}
