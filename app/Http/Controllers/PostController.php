<?php

namespace App\Http\Controllers;

use App\Bookmark;
use App\Http\Requests\PostRequest;
use App\Post;
use App\Report;
use App\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{

    protected $limit;

    public function __construct()
    {
        $this->limit = config('paginate.limit');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post, $slug)
    {
        $post = $post
            ->with(['like' => function ($query) {
                $query->where('user_id', auth()->id());
            }])
            ->with(['comment' => function ($query) {
                $query->with('user:id,first_name,last_name,profile,username');
                $query->select(['id', 'user_id', 'comment', 'post_id', 'created_at']);
                $query->limit($this->limit);
                $query->orderBy('created_at', 'desc');
            }])
            ->select(['id', 'user_id', 'slug', 'content', 'is_published', 'count_likes', 'count_comments', 'count_views', 'image', 'created_at'])
            ->where('slug', $slug)
            ->with('user:id,first_name,last_name,username,profile')
            ->first();

        if (empty($post)) {
            abort(404);
        }

        if ($post->is_published == 0 && $post->user_id != auth()->id()) {
            abort(404);
        }

        $content =  Str::of($post->content)->replaceMatches("/(#\w+)/", function ($match) {
            return '<a class="hartpiece-color" href="' . route('tags', ['tags' => Str::of($match[0])->substr(1)]) . '"<b>' . $match[0] . '</b></a>';
        });


        return view('post.view')
            ->with('limit', $this->limit)
            ->with('post', $post)
            ->with('content', $content);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request, Post $post, Tags $tags)
    {
        $date = Carbon::now()->format('Y/m/d');
        $file = $request->file;
        $randomString = Str::random(40);
        $path = 'images/' . $date . '/' . $randomString . '.' . $file->extension();

        $stream =  Image::make($file->path())->encode($file->extension(), 50);

        Storage::put($path, $stream);

        $post->fill([
            'user_id' => auth()->user()->id,
            'image' => $path,
            'slug' => Carbon::now()->valueOf() . auth()->id(),
            'content' => $request->content,
            'is_published' => $request->published
        ])->save();

        $request->user()->increment('count_post');

        $tag = Str::of($request->content)->matchAll("/(#\w+)/");
        $tag = collect($tag)->unique();

        foreach ($tag as $t) {
            $tags->updateOrCreate(
                ['tags' => $t],
                ['tags_count' => DB::raw('tags_count + 1')]
            );
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post, $slug)
    {
        $details = $post->where('user_id', auth()->id())->where('slug', $slug);

        if ($details->count() <= 0) {
            return back();
        }

        $details =  $details->first();

        $content =  Str::of($details->content)->replaceMatches("/(#\w+)/", function ($match) {
            return '<a class="hartpiece-color" href="' . route('tags', ['tags' => Str::of($match[0])->substr(1)]) . '"<b>' . $match[0] . '</b></a>';
        });


        return view('post.edit')
            ->with('content', $content)
            ->with('post', $details);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post, Tags $tags)
    {

        if ($request->hasFile('file')) {

            $date = Carbon::now()->format('Y/m/d');
            $file = $request->file;
            $randomString = Str::random(40);
            $path = 'images/' . $date . '/' . $randomString . '.' . $file->extension();

            $stream =  Image::make($file->path())->encode($file->extension(), 50);

            Storage::put($path, $stream);
        }

        $post = $post->where('user_id', auth()->id())->where('slug', $request->slug)->first();

        $post->fill([
            'user_id' => auth()->user()->id,
            'image' => isset($path) ? $path : $post->getRawOriginal('image'),
            'content' => $request->content,
            'is_published' => $request->published
        ])->save();

        return redirect()->route('posts.view', ['slug' => $request->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Post $post)
    {
        $post->where('slug', $request->key)->where('user_id', auth()->id())->delete();
        $request->user()->decrement('count_post');
        return route('login');
    }

    public function report(Report $report, Post $post, Request $request)
    {
        $post = $post->where('slug', $request->k)->first();

        $cnt = $report->where('user_id', auth()->id())->where('post_id', $post->id)->count();

        if ($cnt > 0) {
            return 'You already reported this post. Thank you!';
        } else {
            $report->fill([
                'user_id' => auth()->id(),
                'post_id' => $post->id,
                'reason' => $request->r
            ])->save();
            return 'Thank you for reporting!';
        }
    }

    public function drafts(Post $post)
    {
        $post = $post
            ->where('user_id', auth()->id())
            ->where('is_published', 0)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('post.drafts')
            ->with('post', $post);
    }

    public function bookmarks(Bookmark $bookmark, Post $post)
    {

        $book = $bookmark->where('user_id', auth()->id())->pluck('post_id');
        $post = $post->whereIn('id', $book)->get();

        return view('post.bookmarks')
            ->with('post', $post);
    }
}
