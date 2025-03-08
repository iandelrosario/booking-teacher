<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SearchController extends Controller
{

    protected $limit;

    public function __construct()
    {
        $this->limit = config('paginate.limit');
    }

    public function index(User $user, Post $post, Request $request)
    {
        $query = $request->q;
        $type = isset($request->t) ? $request->t : 'people';

        switch ($type) {
            case "post":
                $result = $post
                    ->with(['like' => function ($query) {
                        $query->where('user_id', auth()->id());
                    }])
                    ->with('user:id,first_name,last_name,username,profile')
                    ->where('content', 'LIKE', '%' . $query . '%')
                    ->where('is_published', 1)
                    ->limit($this->limit)
                    ->get();
                break;
            case "tags":

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
                    ->limit($this->limit)
                    ->get();
                break;

            case "people":
            default:
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
                    ->limit($this->limit)
                    ->get();
                break;
        }

        $query = Str::of($query)->replace('#', '%23'); 
        
        return view('search')
            ->with('limit', $this->limit)
            ->with('query', $query)
            ->with('type', $type)
            ->with('result', $result);
    }
}
