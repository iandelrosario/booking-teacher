@extends('layouts.app')

@section('title', 'About')

@section('body')
<div class="card mt-3 hartpiece-rounded-corner">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <p>{{config('app.name')}} is a Social networking platform.</p>
                <p>You can freely express your skills by uploading a story of your artwork.</p>
                <p>Our goal is to share and express your artwork and to give motivation to others.</p>
                <p>Be a storyteller to our community!</p>
            </div>
        </div>
    </div>
</div>
@endsection