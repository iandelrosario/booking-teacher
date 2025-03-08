@inject('trending', 'App\Services\TrendingService')
<div class="sticky-top pt-3">
    <div class="row">
        <div class="col-12">
            <h3 class="mb-0 hartpiece-font-poppins hartpiece-color">
                <a href="{{route('login')}}" class="text-decoration-none text-dark hartpiece-logo-hover">
                    <label class="hartpiece-logo hartpiece-logo-hover"></label><label class="hartpiece hartpiece-logo-hover">H<span class="hartpiece-art">art</span>piece</label>
                </a>
            </h3>
        </div>
        <div class="col-12 mt-3 mb-4">
            <input type="text" class="form-control hartpiece-rounded-corner hartpiece-forms global-search" data-url="{{route('search')}}" value="{{isset($query) ? Str::of($query)->replace('%23','#') : ''}}" placeholder="Search">
        </div>
        <div class="col-12">
            <div class="row">
                <div class="col-3 text-center">
                    <a href="{{route('user.home',['username'=> auth()->user()->username])}}"> <img class="border hartpiece-img" src='{{auth()->user()->profile}}'></a>
                </div>
                <div class="col-9 pl-0">
                    <div class="row">
                        <div class="col-12">
                            <a href="{{route('user.home',['username'=> auth()->user()->username])}}" class="text-dark text-decoration-none">
                                <h5 class="hartpiece-font-poppins" id="fullname">{{Str::title(auth()->user()->first_name)}} {{Str::title(auth()->user()->last_name)}}</h5>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col"><a href="{{route('login')}}" class="text-dark "><i class="fas fa-home fa-fw mr-4"></i></a></div>
                        <div class="col"><a href="{{route('posts.bookmarks')}}" class="text-dark"><i class="fas fa-bookmark mr-4"></i></a></div>
                        <div class="col"><a href="{{route('posts.drafts')}}" class="text-dark"><i class="fas fa-paint-brush mr-4"></i></a></div>
                        <div class="col"><a href="{{route('settings.user')}}" class="text-dark"><i class="fas fa-cog mr-4"></i></a></div>
                        <div class="col"><a href="{{route('signout')}}" class="text-dark"><i class="fas fa-sign-out-alt"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card my-3 hartpiece-rounded-corner">
                <div class="card-body">
                    <h6 class="card-title mb-4 hartpiece-font-poppins"><a href="#" class="text-dark text-decoration-none hartpiece-color">Trending Tags</a></h6>
                    @forelse($trending->tags() as $tag)
                    <h6 class="mb-0">{{$loop->iteration}}. <a href="{{route('tags',['tags'=> Str::of($tag->tags)->substr(1)])}}" class="text-dark">{{$tag->tags}} </a></h6>
                    @if(!$loop->last)
                    <hr>
                    @endif
                    @empty
                    <h6 class="text-center">No tags available!</h6>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col text-center">
            <a href="{{route('about')}}" class="text-dark text-decoration-none"><small>About</small></a>
        </div>
        <div class="col text-center">
            <a href="{{route('terms')}}" class="text-dark text-decoration-none"><small>Terms</small></a>
        </div>
        <div class="col text-center">
            <a href="{{route('contact')}}" class="text-dark text-decoration-none"><small>Contact</small></a>
        </div>
        <div class="col text-center">
            <a href="{{route('donate')}}" class="text-dark text-decoration-none"><small>Donate</small></a>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col text-center">
            <small>{{config('app.name')}} © 2020</small>
        </div>
    </div>
</div>