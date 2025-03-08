<div class="row" id="comment-{{$val->id}}">
    <div class="col-1">
        <img class="float-left hartpiece-img-sm border mt-1" src='{{$val->user->profile}}'>
    </div>
    <div class="col-11 pl-4 pl-lg-2">
        <div class="bg-light hartpiece-rounded-corner p-3 mb-4">
            <a href="{{route('user.home',['username'=> $val->user->username])}}" class="hartpiece-font-poppins hartpiece-color"><b>{{$val->user->fullname}}</b></a> &middot; <small class="text-muted">{{$val->human_timestamp}}</small><br>
            <p class="mb-0" id="comment-content-{{$val->id}}">{!! $val->comment !!}</p>
            <label class="mb-0  mt-2">
                <small>
                    @if(auth()->id() == $val->user->id)
                    <a href="#" data-id="{{$val->id}}" id="comment-edit-{{$val->id}}" class="comment-edit hartpiece-color">Edit</a> &middot; <a href="#" data-id="{{$val->id}}" id="comment-delete-{{$val->id}}" class="comment-delete hartpiece-color">Delete</a>
                    @else
                    @if($post->user_id == auth()->id())
                    <a href="#" data-id="{{$val->id}}" class="comment-delete hartpiece-color">Delete</a>
                    @endif
                    @endif
                </small>
            </label>
        </div>
    </div>
</div>