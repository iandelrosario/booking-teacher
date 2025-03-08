@extends('layouts.app')

@php
$search = isset($query) ? Str::of($query)->replace('%23','#') : '';
@endphp

@section('style')
<style>
    #topmenu {
        border-radius: 0px;
    }
</style>
@endsection

@section('title', 'Result for "'.$search.'"')

@section('top')
<div class="row sticky-top" style="top:56px;">
    <div class="col-md-12">
        <div class="card mb-3  border-top border-bottom-0 border-left-0 border-right-0 rounded-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <nav class="nav nav-pills nav-justified text-center">
                            <a class="nav-item  nav-link hartpiece-font-poppins {{($type == 'people') ? 'active hartpiece-active' : 'hartpiece-color'}}" href="{{url()->current()}}?q={{Str::of($query)->replace('%23','')}}">People</a>
                            <a class="nav-item  nav-link hartpiece-font-poppins {{($type == 'post') ? 'active hartpiece-active' : 'hartpiece-color'}}" href="{{url()->current()}}?q={{Str::of($query)->replace('%23','')}}&t=post">Post</a>
                            <a class="nav-item  nav-link hartpiece-font-poppins {{($type == 'tags') ? 'active hartpiece-active' : 'hartpiece-color'}}" href="{{url()->current()}}?q={{$query}}&t=tags">Tags</a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('body')
<div class="row d-lg-none">
    <div class="col-12 mb-3">
        <input type="text" class="form-control hartpiece-rounded-corner hartpiece-forms global-search" data-url="{{route('search')}}" value="{{isset($query) ? Str::of($query)->replace('%23','#') : ''}}" placeholder="Search">
    </div>
</div>
<input type="hidden" id="limit" value="{{$limit}}">
<input type="hidden" id="type" value="{{$type}}">

@if($query == "")
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
@else

@if(count($result) <= 0 ) <div class="row">
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

    @if($type == 'post' || $type == 'tags')
    <div id="feedPost">
        @include('components.feed',['post'=>$result])
    </div>
    @else
    <div id="feedUser">
        @include('components.user_search',['result' => $result])
    </div>
    @endif

    @endif

    @endsection

    @section('scripts')
    <script src="{{asset('js/search.js')}}"></script>
    <script src="{{asset('js/feed.js')}}"></script>
    @endsection