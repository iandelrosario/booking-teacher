@extends('guest.layouts.app')

@section('title','Sign up')

@section('meta')
<meta property="og:url" content="{{route('signup')}}" />
@endsection

@section('body')
<form method="POST" action="{{route('signup.post')}}">
    @csrf
    <div class="form-group">
        <input type="text" class="form-control hartpiece-rounded-corner hartpiece-forms {{ $errors->has('first_name') ? 'is-invalid' : '' }} {{(old('first_name')) ? 'is-valid' : ''}}" value="{{old('first_name')}}" name="first_name" placeholder="First name">
        <div class="invalid-feedback">{{ $errors->first('first_name') }}</div>
    </div>
    <div class="form-group">
        <input type="text" class="form-control hartpiece-rounded-corner hartpiece-forms {{ $errors->has('last_name') ? 'is-invalid' : '' }} {{(old('last_name')) ? 'is-valid' : ''}}" value="{{old('last_name')}}" name="last_name" placeholder="Last name">
        <div class="invalid-feedback">{{ $errors->first('last_name') }}</div>
    </div>
    <div class="form-group">
        <input type="text" class="form-control hartpiece-rounded-corner hartpiece-forms {{ $errors->has('email_address') ? 'is-invalid' : '' }} {{(old('email_address')) ? 'is-valid' : ''}}" value="{{old('email_address')}}" name="email_address" placeholder="Email address">
        <div class="invalid-feedback">{{ $errors->first('email_address') }}</div>
    </div>
    <div class="form-group">
        <input type="text" class="form-control hartpiece-rounded-corner hartpiece-forms {{ $errors->has('username') ? 'is-invalid' : '' }} {{(old('username')) ? 'is-valid' : ''}}" value="{{old('username')}}" name="username" placeholder="Username">
        <div class="invalid-feedback">{{ $errors->first('username') }}</div>
    </div>
    <div class="form-group">
        <input type="password" class="form-control hartpiece-rounded-corner hartpiece-forms {{ $errors->has('password') ? 'is-invalid' : '' }} {{(old('password')) ? 'is-valid' : ''}}" name="password" placeholder="Password">
        <div class="invalid-feedback">{{ $errors->first('password') }}</div>
    </div>
    <div class="form-group">
        <input type="password" class="form-control hartpiece-rounded-corner hartpiece-forms" name="confirm_password" placeholder="Confirm password">
    </div>
    <div class="form-group">
        <div class="form-check ml-1">
            <input class="form-check-input {{ $errors->has('terms_of_use') ? 'is-invalid' : '' }} {{(old('terms_of_use')) ? 'is-valid' : ''}}" type="checkbox" {{(old('terms_of_use')) ? 'checked' : ''}} name="terms_of_use">
            <label class="form-check-label">
                <a href="#" data-toggle="modal" data-target=".termsModal">Terms of use</a>
            </label>
            <div class="invalid-feedback">{{ $errors->first('terms_of_use') }}</div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-block float-right mb-2 hartpiece-btn-reverse"><b>Sign up</b></button>
    <a href="{{route('forgot')}}" class="hartpiece-color"><small>Forgot Password?</small></a>
    <a href="{{route('login')}}" class="float-right hartpiece-color"><small>Login here!</small></a>
</form>
<div class="modal termsModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title hartpiece-font-poppins" id="exampleModalLabel">Terms of use</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul>
                    <li>Hartpiece is free to use for everyone.</li>
                    <li>User's should only upload content that they made or the'yre authorized to use. That means they should not upload content they didn't make that someone else owns the copyright, without necessary authorizations. </li>
                    <li>By joining the website, you agree to abide by these terms and conditions.</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm hartpiece-btn-reverse" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('js/hartpiece.js')}}"></script>
@endsection