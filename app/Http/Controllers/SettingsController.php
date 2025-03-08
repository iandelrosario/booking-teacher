<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingsGeneralRequest;
use App\Http\Requests\SettingsImageRequest;
use App\Http\Requests\SettingsPasswordRequest;
use App\Mail\EmailVerification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings');
    }

    public function image(SettingsImageRequest $request)
    {
        $date = Carbon::now()->format('Y/m/d');
        $file = $request->file;
        $randomString = Str::random(40);
        $path = 'images/' . $date . '/' . $randomString . '.' . $file->extension();

        $stream =  Image::make($file->path())->encode($file->extension(), 30);

        Storage::put($path, $stream);

        $request->user()->fill([
            'profile' => $path
        ])->save();

        return back();
    }

    public function general(SettingsGeneralRequest $request)
    {
        $request->user()->fill($request->except('_token'))->save();

        return back();
    }

    public function password(SettingsPasswordRequest $request)
    {
        $request->user()->fill([
            'password' => $request->password
        ])->save();

        return back();
    }

    public function resendVerify(Request $request)
    {

        $user = auth()->user();

        if ($user->is_verified == 1) {
            return redirect()->route('login');
        }

        $url =  URL::temporarySignedRoute(
            'verify',
            now()->addHours(1),
            ['uname' => $user->username]
        );

        $data = [
            'url' => $url,
            'name' => $user->first_name . ' ' . $user->last_name
        ];

        Mail::to($user->email_address)
            ->send(new EmailVerification($data));

        $request->session()->flash('resendEmail', 'Email successfully sent!');

        return back();
    }
}
