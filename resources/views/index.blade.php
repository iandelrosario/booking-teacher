@extends('layouts.app')

@section('title', 'Home')

@section('body')
<input type="hidden" value="{{$limit}}" id="limit">
@include('components.compose')
<div class="row mt-3">
    <div class="col-md-12">
        <div id="feedPost">
            @if(count($post) > 0)
            @include('components.index_feed',['post'=>$post])
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
<script src="{{asset('js/index.js')}}"></script>
<script src="{{asset('js/feed.js')}}"></script>
@endsection