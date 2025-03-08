@extends('guest.layouts.app')

@section('title','Change password')
@section('body')
<form method="POST" action="{{route('forgot.password')}}">
    @csrf
    <input type="hidden" value="{{$key}}" name="key">
    <div class="form-group">
        <input type="password" class="form-control hartpiece-rounded-corner hartpiece-forms {{ $errors->has('password') ? 'is-invalid' : '' }} {{(old('password')) ? 'is-valid' : ''}}" value="{{old('password')}}" name="password" placeholder="New password">
        <div class="invalid-feedback">{{ $errors->first('password') }}</div>
    </div>
    <div class="form-group">
        <input type="password" class="form-control hartpiece-rounded-corner hartpiece-forms {{ $errors->has('confirm_password') ? 'is-invalid' : '' }} {{(old('confirm_password')) ? 'is-valid' : ''}}" value="{{old('confirm_password')}}" name="confirm_password" placeholder="Confirm password">
        <div class="invalid-feedback">{{ $errors->first('confirm_password') }}</div>
    </div>
    <button type="submit" class="btn btn-primary btn-block float-right mb-2 hartpiece-btn-reverse"><b>Submit</b></button>
    <a href="{{route('login')}}" class="hartpiece-color"><small>Login here!</small></a>
    <a href="{{route('signup')}}" class="float-right hartpiece-color"><small>Sign up here!</small></a>
</form>
@endsection