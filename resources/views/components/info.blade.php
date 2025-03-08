<div class="row">
    <div class="col-2 col-sm-3 col-md-2 text-center">
        <img class="lazyImages border hartpiece-img" data-src='{{$user->profile}}'>
    </div>
    <div class="col-10 col-sm-8 col-md-7 text-center">
        <h5 class="hartpiece-font-poppins">{{$user->fullname}}</h5>
        <p>
            <small class="text-dark mr-2"><b>{{$user->count_post}}</b> posts</small>
            @if(auth()->id() == $user->id)
            <a href="{{route('followers',['username' => $user->username])}}" class="text-dark mr-2 text-decoration-none"><small><b>{{$user->count_followers}}</b> followers</small></a>
            <a href="{{route('following',['username' => $user->username])}}" class="text-dark text-decoration-none"><small><b>{{$user->count_following}}</b> following</small></a>
            @else
            <a href="{{($user->follower) ? route('followers',['username' => $user->username]) : '#'}}" class="text-dark mr-2 text-decoration-none"><small><b>{{$user->count_followers}}</b> followers</small></a>
            <a href="{{($user->follower) ? route('following',['username' => $user->username]) : '#'}}" class="text-dark text-decoration-none"><small><b>{{$user->count_following}}</b> following</small></a>
            @endif
        </p>
    </div>
    <div class="col-sm-12 col-md-3">
        <div class="row">
            @if(auth()->user()->id != $user->id)
            <div class="col-6 col-md-12">
                <form method="POST" action="{{route('follow',['username' => $user->username])}}">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-block rounded-pill hartpiece-btn hartpiece-btn"><b>{{($user->follower) ? 'Unfollow' : 'Follow'}}</b></button>
                </form>
            </div>
            @if($user->paypal_email_address)
            <div class="col-6 col-md-12">
                <a href="{{route('paypal.donate',['username'=>$user->username])}}" class="btn btn-outline-dark btn-sm btn-block rounded-pill hartpiece-font-poppins"><b>Donate</b></a>
            </div>
            @endif
            @else
            <div class="col-12 d-lg-none mt-2">
                <div class="row text-center">
                    <div class="col"><a href="{{route('posts.bookmarks')}}" class="text-dark"><i class="fas fa-bookmark fa-lg"></i></a></div>
                    <div class="col"><a href="{{route('posts.drafts')}}" class="text-dark"><i class="fas fa-paint-brush fa-lg"></i></a></div>
                    <div class="col"><a href="{{route('settings.user')}}" class="text-dark"><i class="fas fa-cog fa-lg"></i></a></div>
                    <div class="col"><a href="{{route('signout')}}" class="text-dark"><i class="fas fa-sign-out-alt fa-lg"></i></a></div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>