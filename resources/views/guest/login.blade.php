@extends('guest.layouts.app')

@section('meta')
<meta property="og:url" content="{{route('login')}}" />
@endsection

@section('title','Login')
@section('body')
@include('guest.template.login')
@endsection