@extends('guest.layouts.app')

@section('title', $subject)
@section('body')
<p>{{$message}} <a href="{{route('login')}}">Login here!</a></p>
@endsection