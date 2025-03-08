@extends('layouts.app')

@section('title', 'Post')

@section('meta')
<meta property="og:url" content="{{$post->view_link}}" />
<meta property="og:type" content="article" />
<meta property="og:title" content="Work by: {{$post->user->fullname}}" />
<meta property="og:image" content="{{$post->image}}" />
<meta property="fb:app_id" content="" />
@endsection

@section('body')
<input type="hidden" value="{{$limit}}" id="limit">
<div class="row">
    <div class="col-md-12">
        <div class="card my-3 hartpiece-rounded-corner">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <img class="hartpiece-img-sm float-left lazyImages border" data-src='{{$post->user->profile}}'>
                            @auth
                            <label class="float-right">
                                <a class="btn btn-sm hartpiece-color" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-h fa-lg"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                    @if(auth()->user()->id == $post->user_id)
                                    <a class="dropdown-item" href="{{route('posts.edit',['slug' => $post->slug])}}"><small>Edit</small></a>
                                    <a class="dropdown-item post-delete" href="#" data-slug="{{$post->slug}}"><small>Delete</small></a>
                                    @else
                                    <a class="dropdown-item post-report" href="#" data-slug="{{$post->slug}}" data-toggle="modal" data-target=".reportModal"><small>Report post</small></a>
                                    @endif
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item post-bookmark" href="#" data-book="{{($post->bookmark) ? '1' : '0'}}" data-slug="{{$post->slug}}"><small id="bookmark-label">{{($post->bookmark) ? 'Remove bookmark' : 'Bookmark'}}</small></a>
                                </div>
                            </label>
                            @endauth
                            <div style="margin-left:50px;width:auto;">
                                <a href="{{route('user.home',['username'=>$post->user->username])}}" class="text-dark hartpiece-font-poppins"><b>{{$post->user->fullname}}</b></a>
                                <p class="mb-0" style="font-size:12px;color:#999;line-height:1.55;">{{$post->human_timestamp}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-12">
                        <p>
                            {!! $content !!}
                        </p>
                    </div>
                    <div class="col-12">
                        <img data-src="{{$post->image}}" class="lazyImages img-fluid rounded mx-auto d-block">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-1">
                        <small class="ml-4">{{$post->count_views}} views</small>
                    </div>
                    <div class="col-md-12">
                        <div class="row p-1 text-center">
                            <div class="col">
                                @auth<a href="#" class="{{($post->like) ? 'hartpiece-color btn-unlike' : 'text-dark btn-like'}} align-middle" data-slug="{{$post->slug}}">@endauth<i class="far fa-thumbs-up fa-lg"></i>@auth</a>@endauth
                                <small class="ml-2 d-none d-md-inline {{$post->slug}}-count">{{$post->count_likes}}</small>
                            </div>
                            <div class="col">
                                <span class="text-dark align-middle"><i class="far fa-comment-alt fa-lg"></i></span>
                                <small class="ml-2 d-none d-md-inline">{{$post->count_comments}}</small>
                            </div>
                            <div class="col">
                                <a href="{{route('paypal.donate',['username'=>$post->user->username])}}" class="text-dark align-middle"><i class="fas fa-hand-holding-usd fa-lg"></i></a>
                            </div>
                            <div class="col">
                                <a href="javascript:void(0);" class="text-dark align-middle" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={{htmlentities($post->view_link)}}', '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=440,width=600'); return false;"><i class="fab fa-facebook-square fa-lg"></i></a>
                                <small class="ml-2">&nbsp;</small>
                            </div>
                            <div class="col">
                                <a href="javascript:void(0);" class="text-dark align-middle" onclick="window.open('https://twitter.com/share?url={{$post->view_link}}','Twitter-dialog','width=626,height=436'); return false;"><i class="fab fa-twitter fa-lg"></i></a>
                                <small class="ml-2">&nbsp;</small>
                            </div>
                        </div>
                    </div>
                </div>
                @auth
                <div class="row mt-3">
                    <div class="col-2 col-sm-1">
                        <img  class="float-left hartpiece-img-sm border ml-3 ml-sm-1 ml-md-0 mt-1 lazyImages" data-src='{{auth()->user()->profile}}'>
                    </div>
                    <div class="col-10 col-sm-11 pl-4 pl-lg-2">
                        <div contenteditable="true" class="form-group hartpiece-rounded-corner border contentEditable" data-slug="{{$post->slug}}" data-placeholder="Write a comment..." style="outline:none;padding:10px 15px;border-color:1px solid rgba(0,0,0,.1);"></div>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </div>
</div>
@auth
<div class="row">
    <div class="col-md-12">
        <div class="card mb-3 hartpiece-rounded-corner">
            <div class="card-body mt-3" id="comment-section">
                @include('components.comment_post',['post' => $post->comment])
            </div>
        </div>
    </div>
</div>
@include('template.modal_report')
@endauth
@endsection


@push('scripts')
@auth
<script src="{{asset('js/feed.js')}}"></script>
<script src="{{asset('js/post.js')}}"></script>
@endauth
@endpush