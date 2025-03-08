@extends('layouts.app')

@section('title', 'Edit post')

@section('body')
<div class="row">
    <div class="col-md-12">
        <div class="card my-3 hartpiece-rounded-corner">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <img class="float-left hartpiece-img-sm border" src='{{$post->user->profile}}'>
                            <div style="margin-left:50px;width:auto;">
                                <a href="#" class="text-dark hartpiece-font-poppins"><b>{{$post->user->fullname}}</b></a>
                                <p class="mb-0" style="font-size:12px;color:#999;line-height:1.55;">{{$post->human_timestamp}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-12">
                        <form method="POST" action="{{route('posts.update')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div contenteditable="true" class="form-group hartpiece-rounded-corner contentEditable border " name="content" style="outline:none;padding:10px 15px;border-color:1px solid rgba(0,0,0,.1);"> {!! $post->content !!} </div>
                                    <textarea id="contentEditable" class="d-none" name="content">{{$post->content}}</textarea>
                                    <input type="hidden" name="slug" value="{{$post->slug}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-3 col-sm-2">
                                    <label class="btn btn-sm hartpiece-btn-reverse  hartpiece-rounded-corner px-3 mb-0">
                                        <input id="content-file" type="file" name="file" class="d-none" accept="image/*" onchange="contentImage(this);">
                                        <b>Photo</b>
                                    </label>
                                </div>
                                <div class="col-6">
                                    <div class="form-check form-check-inline mt-1">
                                        <input class="form-check-input" type="radio" id="publishedChk"  name="published" {{($post->is_published) ? 'checked' : ''}} value="1">
                                        <label class="form-check-label" for="publishedChk" >Publish</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="draftChk"  name="published" {{($post->is_published) ? '' : 'checked'}} value="0">
                                        <label class="form-check-label" for="draftChk" >Draft</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-2">
                                    <img data-src="{{$post->image}}" id="content-file-preview" class="lazyImages img-fluid rounded mx-auto d-block">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn hartpiece-btn-reverse btn-sm float-right"><b>Submit</b></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{asset('js/compose.js')}}"></script>
@endpush