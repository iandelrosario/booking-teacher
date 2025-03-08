<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUpRequest;
use App\Http\Requests\SettingsPasswordRequest;
use Illuminate\Http\Request;
use App\Mail\EmailVerification;
use App\Mail\ForgotPassword;
use App\User;

class AuthController extends Controller
{

    public function auth(LoginRequest $request)
    {

        $fieldKey = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email_address' : 'username';

        if (auth()->attempt([$fieldKey => $request->username, 'password' => $request->password])) {
            $request->user()->fill(['ip_address' => $request->ip()])->save();
            return back();
        }

        return back()->with('invalid', 'Invalid Username or Password!');
    }

    public function signOut()
    {
        auth()->logout();
        session()->flush();

        return back();
    }

    public function signUp()
    {
        return view('guest.sign');
    }

    public function signUpPost(User $user, SignUpRequest $request)
    {
        $info = $request->except(['_token', 'confirm_password']);

        $user->fill($info)->save();

        $url =  URL::temporarySignedRoute(
            'verify',
            now()->addHours(1),
            ['uname' => $user->username]
        );

        $data = [
            'url' => $url,
            'name' => $user->first_name . ' ' . $user->last_name
        ];

        Mail::to($request->email_address)
            ->send(new EmailVerification($data));

        return view('guest.success')
            ->with('message', 'Please check your email for the verification link.')
            ->with('subject', 'Sucessfully signed up!');
    }

    public function accountVerify(User $user, Request $request)
    {
        if (!$request->hasValidSignature()) {
            abort(401);
        }

        $uname = $request->uname;

        $user = $user->where('username', $uname)->first();
        $user->is_verified = 1;
        $user->save();

        auth()->loginUsingId($user->id);

        return redirect()->route('login');
    }

    public function forgotPassword()
    {
        return view('guest.forgot');
    }

    public function forgotPasswordPost(User $user, ForgotRequest $request)
    {
        $user = $user->where('email_address', $request->email_address)->first();

        $url =  URL::temporarySignedRoute(
            'forgot.change',
            now()->addHours(1),
            ['uname' => $user->username]
        );

        $data = [
            'url' => $url,
            'name' => $user->first_name . ' ' . $user->last_name
        ];

        Mail::to($request->email_address)
            ->send(new ForgotPassword($data));

        return view('guest.success')
            ->with('message', 'Please check your email for the change password link.')
            ->with('subject', 'Email sent!');
    }

    public function changePassword(Request $request)
    {
        if (!$request->hasValidSignature()) {
            abort(401);
        }

        return view('guest.changepassword')
            ->with('key', $request->uname);
    }

    public function changePasswordPost(User $user, SettingsPasswordRequest $request)
    {
        $user = $user->where('username', $request->key)->first();
        $user->password = $request->password;
        $user->save();

        auth()->loginUsingId($user->id);

        return back();
    }
}
