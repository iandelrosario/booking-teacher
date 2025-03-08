@extends('layouts.app')

@section('title', 'General Settings')

@section('body')
<div class="row mt-3">
    @if(session()->has('resendEmail'))
    <div class="col-md-12">
        <div class="alert alert-success hartpiece-rounded-corner">
            {{session()->get('resendEmail')}}
        </div>
    </div>
    @endif
    @if(auth()->user()->is_verified == 0)
    <div class="col-md-12">
        <div class="alert alert-secondary hartpiece-rounded-corner">
            Please check your email to verify your account and enable your PayPal. <a href="{{route('settings.resend')}}" class="hartpiece-color">Resend verification</a>
        </div>
    </div>
    @endif
    <div class="col-md-6">
        <div class="card mb-4 h-100 hartpiece-rounded-corner">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form method="POST" action="{{route('settings.general')}}">
                            <h5 class="hartpiece-font-poppins">General <button class="btn btn-sm float-right hartpiece-btn-reverse"><b>Submit</b></button></h5>
                            <hr>
                            @csrf
                            <div class="form-group">
                                <small><b>First Name</b></small>
                                <input type="text" name="first_name" class="form-control hartpiece-rounded-corner hartpiece-forms {{ $errors->has('first_name') ? 'is-invalid' : '' }} {{(old('first_name')) ? 'is-valid' : ''}}" value="{{auth()->user()->first_name}}">
                                <div class="invalid-feedback">{{ $errors->first('first_name') }}</div>
                            </div>
                            <div class="form-group">
                                <small><b>Last Name</b></small>
                                <input type="text" name="last_name" class="form-control hartpiece-rounded-corner hartpiece-forms {{ $errors->has('last_name') ? 'is-invalid' : '' }} {{(old('last_name')) ? 'is-valid' : ''}}" value="{{auth()->user()->last_name}}">
                                <div class="invalid-feedback">{{ $errors->first('last_name') }}</div>
                            </div>
                            <div class="form-group">
                                <small><b>Username</b></small>
                                <input type="text" name="username" class="form-control hartpiece-rounded-corner hartpiece-forms {{ $errors->has('username') ? 'is-invalid' : '' }} {{(old('username')) ? 'is-valid' : ''}}" value="{{auth()->user()->username}}">
                                <div class="invalid-feedback">{{ $errors->first('username') }}</div>
                            </div>
                            <div class="form-group">
                                <small><b>Email Address</b></small>
                                <input type="text" name="email_address" class="form-control hartpiece-rounded-corner hartpiece-forms {{ $errors->has('email_address') ? 'is-invalid' : '' }} {{(old('email_address')) ? 'is-valid' : ''}}" value="{{auth()->user()->email_address}}">
                                <div class="invalid-feedback">{{ $errors->first('email_address') }}</div>
                            </div>
                            @if(auth()->user()->is_verified == 1)
                            <div class="form-group">
                                <small><b>PayPal Email Address</b></small>
                                <input type="text" class="form-control hartpiece-rounded-corner hartpiece-forms {{ $errors->has('paypal_email_address') ? 'is-invalid' : '' }} {{(old('paypal_email_address')) ? 'is-valid' : ''}}" name="paypal_email_address" value="{{auth()->user()->paypal_email_address}}">
                                <div class="invalid-feedback">{{ $errors->first('paypal_email_address') }}</div>
                            </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-4 hartpiece-rounded-corner">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="hartpiece-font-poppins mb-0">Profile <small class="float-right hartpiece-font-muli font-weight-normal mt-1" style="font-size:12px;">Click to change</small></h5>
                        <hr>
                        <form class="mb-0 text-center" id="changeDp" enctype="multipart/form-data" method="POST" action="{{route('settings.upload')}}">
                            @csrf
                            <label>
                                <img id="hartpiece-profile-image" class="border hartpiece-img" src='{{auth()->user()->profile}}'>
                                <input type="file" name="file" class="d-none" accept="image/*" onchange="changeDp(this);">
                            </label>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card hartpiece-rounded-corner">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form method="POST mb-0" action="{{route('settings.password')}}">
                            @csrf
                            <h5 class="hartpiece-font-poppins">Change Password <button class="btn btn-sm float-right hartpiece-btn-reverse"><b>Submit</b></button></h5>
                            <hr>
                            <div class="form-group ">
                                <small><b>Password</b></small>
                                <input type="password" name="password" class="form-control hartpiece-rounded-corner hartpiece-forms {{ $errors->has('password') ? 'is-invalid' : '' }} {{(old('password')) ? 'is-valid' : ''}}" placeholder="New password">
                                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                            </div>
                            <div class="form-group mb-0">
                                <small><b>Confirm Password</b></small>
                                <input type="password" name="confirm_password" class="form-control hartpiece-rounded-corner hartpiece-forms {{ $errors->has('confirm_password') ? 'is-invalid' : '' }} {{(old('confirm_password')) ? 'is-valid' : ''}}" placeholder="Confirm password">
                                <div class="invalid-feedback">{{ $errors->first('confirm_password') }}</div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection