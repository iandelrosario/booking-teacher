@extends('layouts.app')

@section('title', '#'.$tags)

@section('body')
<div class="row mt-3">
    <div class="col-12">
        <input type="hidden" id="tags" value="#{{$tags}}">
        <input type="hidden" value="{{$limit}}" id="limit">
        <div id="feedPost">
            @include('components.feed',['post'=>$post])
        </div>
        @include('template.modal_report')
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('js/tags.js')}}"></script>
<script src="{{asset('js/feed.js')}}"></script>
@endsection