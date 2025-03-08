<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function about()
    {
        return view('app.about');
    }

    public function terms()
    {
        return view('app.terms');
    }

    public function contact()
    {
        return view('app.contact');
    }

    public function donate()
    {
        return view('app.donate');
    }
}
