<div class="row">
    <div class="col-md-12">
        <div class="card mb-3 hartpiece-rounded-corner">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <a href="{{route('user.home',['username'=> $val->user->username])}}" class="text-dark">
                                <img class="lazyImages border hartpiece-img-sm float-left" data-src="{{$val->user->profile}}">
                            </a>
                            <label class="float-right">
                                <a class="btn btn-sm hartpiece-color" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-h fa-lg"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                    @if(auth()->user()->id == $val->user_id)
                                    <a class="dropdown-item" href="{{route('posts.edit',['slug' => $val->slug])}}"><small>Edit</small></a>
                                    <a class="dropdown-item post-delete" href="#" data-slug="{{$val->slug}}"><small>Delete</small></a>
                                    @else
                                    <a class="dropdown-item post-report" href="#" data-slug="{{$val->slug}}" data-toggle="modal" data-target=".reportModal"><small>Report post</small></a>
                                    @endif
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item post-bookmark" href="#" data-book="{{($val->bookmark) ? '1' : '0'}}" data-slug="{{$val->slug}}"><small>{{($val->bookmark) ? 'Remove bookmark' : 'Bookmark'}}</small></a>
                                </div>
                            </label>
                            <div style="margin-left:50px;width:auto;">
                                <a href="{{route('user.home',['username'=> $val->user->username])}}" class="text-dark hartpiece-font-poppins"><b>{{$val->user->fullname}}</b></a>
                                <p class="mb-0" style="font-size:12px;color:#999;line-height:1.55;">{{$val->human_timestamp}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-12">
                        <a href="{{route('posts.view',['slug' => $val->slug])}}" class="post-view" data-slug="{{$val->slug}}"><img data-src="{{$val->image}}" class="lazyImages img-fluid rounded mx-auto d-block"></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-1">
                        <small class="ml-4">{{$val->count_views}} views</small>
                    </div>
                    <div class="col-md-12">
                        <div class="row p-1 text-center">
                            <div class="col">
                                <a href="#" class="{{($val->like) ? 'hartpiece-color btn-unlike' : 'text-dark btn-like'}} align-middle" data-slug="{{$val->slug}}"><i class="far fa-thumbs-up fa-lg"></i></a>
                                <small class="ml-2 {{$val->slug}}-count">{{$val->count_likes}}</small>
                            </div>
                            <div class="col">
                                <a href="{{route('posts.view',['slug' => $val->slug])}}" data-slug="{{$val->slug}}" class="post-view text-dark align-middle"><i class="far fa-comment-alt fa-lg"></i></a>
                                <small class="ml-2">{{$val->count_comments}}</small>
                            </div> 
                            <div class="col">
                                <a href="javascript:void(0);" class="text-dark align-middle" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={{htmlentities($val->view_link)}}', '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=440,width=600'); return false;"><i class="fab fa-facebook-square fa-lg"></i></a>
                                <small class="ml-2">&nbsp;</small>
                            </div>
                            <div class="col">
                                <a href="javascript:void(0);" class="text-dark align-middle" onclick="window.open('https://twitter.com/share?url={{$val->view_link}}','Twitter-dialog','width=626,height=436'); return false;"><i class="fab fa-twitter fa-lg"></i></a>
                                <small class="ml-2">&nbsp;</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>