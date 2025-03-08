<form method="POST" action="{{route('auth')}}">
    @csrf
    <div class="form-group">
        <input type="text" class="form-control hartpiece-rounded-corner hartpiece-forms {{session()->has('invalid') ? 'is-invalid' : ''}} {{ $errors->has('username') ? 'is-invalid' : '' }} {{(old('username')) ? 'is-valid' : ''}}" name="username" placeholder="Username or Email Address">
        <div class="invalid-feedback">{{ $errors->first('username') }}</div>
    </div>
    <div class="form-group">
        <input type="password" class="form-control hartpiece-rounded-corner hartpiece-forms {{session()->has('invalid') ? 'is-invalid' : ''}} {{ $errors->has('password') ? 'is-invalid' : '' }} {{(old('password')) ? 'is-valid' : ''}}" name="password" placeholder="Password">
        <div class="invalid-feedback">{{ $errors->first('password') }}</div>
        @if (session()->has('invalid'))
        <div class="invalid-feedback">{{session()->get('invalid')}}</div>
        @endif
    </div>
    <button type="submit" class="btn btn-primary btn-block float-right mb-2 hartpiece-btn-reverse"><b>Log in</b></button>
</form>
<a href="{{route('forgot')}}" class="hartpiece-color"><small>Forgot Password?</small></a>
<a href="{{route('signup')}}" class="float-right hartpiece-color"><small>Sign up here!</small></a>