@extends('layouts.app')

@section('title','Drafts')

@section('body')
<div class="row mt-3">
    <div class="col-12">
        @if(count($post) > 0)
        @include('components.feed',['post'=>$post])
        @else
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3 hartpiece-rounded-corner">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h6 class="mb-0">No drafts found!</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script src="{{asset('js/feed.js')}}"></script>
@endsection