@extends('guest.layouts.app')

@section('title','Forgot password')

@section('meta')
<meta property="og:url" content="{{route('forgot')}}" />
@endsection

@section('body')
<form method="POST" action="{{route('forgot.post')}}">
    @csrf
    <div class="form-group">
        <input type="text" class="form-control hartpiece-rounded-corner hartpiece-forms {{ $errors->has('email_address') ? 'is-invalid' : '' }} {{(old('email_address')) ? 'is-valid' : ''}}" value="{{old('email_address')}}" name="email_address" placeholder="Email address">
        <div class="invalid-feedback">{{ $errors->first('email_address') }}</div>
    </div>

    <button type="submit" class="btn btn-primary btn-block float-right mb-2 hartpiece-btn-reverse"><b>Submit</b></button>
    <a href="{{route('login')}}" class="hartpiece-color"><small>Login here!</small></a>
    <a href="{{route('signup')}}" class="float-right hartpiece-color"><small>Sign up here!</small></a>
</form>
@endsection