@extends('layouts.app')

@section('title', 'Following')

@section('top')
<div class="row mt-3">
    <div class="col-md-12">
        <div class="card mb-3 hartpiece-rounded-corner">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        @include('components.info')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('body')
<input type="hidden" id="limit" value="{{$limit}}">
<input type="hidden" id="un" value="{{$user->username}}">

<div id="feedUser">
    @if(count($user->following) > 0 )
    @include('components.user_following',['result' => $user->following])
    @else
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3 hartpiece-rounded-corner">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h6 class="mb-0">No result found!</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif 
</div>

@endsection

@section('scripts')
<script src="{{asset('js/following.js')}}"></script>
@endsection