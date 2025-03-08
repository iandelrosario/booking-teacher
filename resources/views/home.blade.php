@extends('layouts.app')

@section('title', $user->fullname)

@section('top')
<div class="row mt-3">
    <div class="col-md-12">
        <div class="card hartpiece-rounded-corner">
            <div class="card-body">
                @include('components.info')
            </div>
        </div>
    </div>
</div>
@endsection

@section('body')
<input type="hidden" value="{{$limit}}" id="limit">
<input type="hidden" value="{{$username}}" id="username">
<div class="row mt-3">
    <div class="col-md-12">
        <div id="feedPost">
            @if(count($user->post) > 0)
            @include('components.feed',['post' => $user->post])
            @else
            <div class="card mb-3 hartpiece-rounded-corner">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h6 class="mb-0">No content found!</h6>
                        </div>
                    </div>
                </div>

            </div>
            @endif
        </div>
    </div>
</div>
@include('template.modal_report')
@endsection

@section('scripts')
<script src="{{asset('js/home.js')}}"></script>
<script src="{{asset('js/feed.js')}}"></script>
@endsection