@foreach($post as $key => $val)
@if($loop->iteration == 2)
@include('components.sponsored')
@elseif($loop->iteration == 10)
<div class="row">
    <div class="col-md-12">
        <div class="card mb-3 hartpiece-rounded-corner">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h5 class="hartpiece-font-poppins mb-3">Who to follow</h5>
                        <div class="card-deck">
                            @foreach($randUser as $k => $v)
                            <div class="card hartpiece-rounded-corner pt-3">
                                <img class="border mx-auto d-block hartpiece-img-lg"  src='{{$v->profile}}'>
                                <div class="card-body text-center p-2">
                                    <h6 class="card-title hartpiece-font-poppins"><a href="{{$v->profile_link}}" class="text-dark text-decoration-none"><small>{{$v->fullname}}</small></a></h6>
                                </div>
                                <div class="card-footer border-0" style="background:transparent;"><button type="button" class="btn btn-sm btn-block rounded-pill font-weight-bold follow hartpiece-btn hartpiece-btn" data-un="{{$v->username}}">Follow</button></div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@include('template.feed',['val' => $val])
@endforeach
