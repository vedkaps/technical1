<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function home(Request $request)
    {
        return view('test.home');
    }

    public function about(Request $request)
    {
        return view('test.about');
    }

    public function contact(Request $request)
    {
        return view('test.contact');
    }
}
