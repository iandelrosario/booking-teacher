<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Arr;

class PaypalController extends Controller
{ 

    public function index(User $user, $username = null)
    {
        $paypal = $this->credentials();
        $query = $paypal['credentials'];

        if ($username) {
            $email = $user->where('username', $username)->where('is_verified',1)->value('paypal_email_address');
            Arr::pull($query, 'business');
            $query = Arr::add($query, 'business', $email);
        }

        $redirec = $paypal['url'] . '?' . http_build_query($query);

        return redirect()->away($redirec);
    }


    public function credentials()
    {
        $result = config('paypal');

        $mode = $result['default'];

        return $result[$mode];
    }
}
