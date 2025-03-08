<?php

namespace App\Http\Controllers;

use App\Bookmark;
use App\Comments;
use App\Likes;
use App\Post;
use App\Views;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function like(Request $request, Likes $like, Post $post)
    {
        $post =  $post->where('slug', $request->id)->first();
        $userId = auth()->id();

        $liked = $like->where('user_id', $userId)->where('post_id', $post->id);

        if ($liked->count() <= 0) {
            $like = $like->refresh();
            $like->fill(['user_id' => $userId, 'post_id' => $post->id])->save();
            $post->increment('count_likes');
        } else {
            $liked->delete();
            $post->decrement('count_likes');
        }

        $posts = $post->refresh();

        return $posts->count_likes;
    }

    public function commentAdd(Request $request, Comments $comments, Post $post)
    {
        $post =  $post->where('slug', $request->id)->first();

        $comments->fill([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
            'comment' => $request->comment
        ])->save();

        $commentId = $comments->id;

        $post->increment('count_comments');

        $posts = $post->refresh();

        $post = $post
            ->with(['comment' => function ($query) use ($commentId) {
                $query->with('user:id,first_name,last_name,profile,username');
                $query->select(['id', 'user_id', 'comment', 'post_id', 'created_at']);
                $query->where('id', $commentId);
            }])
            ->select(['id', 'user_id', 'slug', 'content',  'count_likes', 'count_comments', 'count_views', 'image', 'created_at'])
            ->where('id', $post->id)
            ->first();

        return response()
            ->view(
                'components.comment_post',
                [
                    'post' => $post->comment,
                ]
            );

        return response()->json([
            'count' =>  $posts->count_comments,
            'pid' => $request->id,
            'id' => $comments->id,
            'user' => route('user.home', ['username' => auth()->user()->username])
        ]);
    }

    public function commentEdit(Request $request, Comments $comments, Post $post)
    {
        $post =  $post->where('slug', $request->key)->first();

        $comments->where('id', $request->id)->where('post_id', $post->id)->update(['comment' => $request->comment]);
    }

    public function commentDelete(Request $request, Comments $comments, Post $post)
    {
        $post =  $post->where('slug', $request->key)->first();

        $comments->where('id', $request->id)->where('post_id', $post->id)->delete();

        $post->decrement('count_comments');

        $posts = $post->refresh();

        return $posts->count_comments;
    }

    public function view(Request $request, Views $views, Post $post)
    {

        $posts = $post->where('slug', $request->key)->first();
        $userId = auth()->id();

        $view = $views->where('user_id', $userId)->where('post_id', $posts->id);

        if ($view->count() <= 0) {
            $views->fill(['user_id' => auth()->id(), 'post_id' => $posts->id])->save();
            $posts->increment('count_views');
        }
    }

    public function bookmark(Request $request, Post $post, Bookmark $bookmark)
    {
        $posts = $post->where('slug', $request->key)->first();
        $userId = auth()->id();

        $bookmarked = $bookmark->where('user_id', $userId)->where('post_id', $posts->id);

        if ($bookmarked->count() <= 0) {
            $bookmark = $bookmark->refresh();
            $bookmark->fill(['user_id' => $userId, 'post_id' => $posts->id])->save();
        } else {
            $bookmarked->delete();
        }
    }
}
