<div class="row">
    <div class="col-md-12">
        <div class="card mb-3 hartpiece-rounded-corner">
            <div class="card-body">
                <div class="row">
                    <div class="col-3 col-sm-3 col-md-2 text-center">
                        <a href="{{route('user.home',['username'=> $username])}}" class="text-dark"><img class="hartpiece-img lazyImages border" data-src='{{$profile}}'></a>
                    </div>
                    <div class="col-9 col-sm-8 col-md-7 text-center">
                        <h5 class="hartpiece-font-poppins mt-3 mt-sm-0"><a href="{{route('user.home',['username'=> $username])}}" class="text-dark">{{$fullname}}</a></h5>
                        <p><small class="text-dark mr-3"><b>{{$count_post}}</b> posts</small> <small class="text-dark mr-3"><b>{{$count_followers}}</b> followers</small> <small class="text-dark"><b>{{$count_following}}</b> following</small></p>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        @if($type == 'userSearch')

                        <button type="button" class="btn btn-sm btn-block rounded-pill font-weight-bold follow hartpiece-btn" data-un="{{$username}}">{{($follower) ? 'Unfollow' : 'Follow'}}</button>
                        @if($paypal_email_address)
                        <a href="{{route('paypal.donate',['username' => $username])}}" class="btn btn-outline-dark btn-sm btn-block rounded-pill hartpiece-font-poppins"><b>Donate</b></a>
                        @endif

                        @elseif($type == 'userFollower')

                        @if(auth()->id() != $user_id)
                        <button type="button" class="btn btn-outline-primary btn-sm btn-block rounded-pill font-weight-bold follow hartpiece-btn" data-un="{{$username}}">{{($follower) ? 'Unfollow' : 'Follow'}}</button>
                        @if($paypal_email_address)
                        <a href="{{route('paypal.donate',['username'=>$username])}}" class="btn btn-outline-dark btn-sm btn-block rounded-pill hartpiece-font-poppins"><b>Donate</b></a>
                        @endif
                        @endif

                        @elseif($type == 'userFollowing')

                        @if(auth()->id() != $followed_user_id)
                        <button type="button" class="btn btn-outline-primary btn-sm btn-block rounded-pill font-weight-bold follow hartpiece-btn" data-un="{{$username}}">{{($follower) ? 'Unfollow' : 'Follow'}}</button>
                        @if($paypal_email_address)
                        <a href="{{route('paypal.donate',['username'=>$username])}}" class="btn btn-outline-dark btn-sm btn-block rounded-pill hartpiece-font-poppins"><b>Donate</b></a>
                        @endif
                        @endif

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>