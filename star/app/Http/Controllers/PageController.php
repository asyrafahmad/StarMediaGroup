<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $cookie = $request->cookie('user_consent');
        $decoded = json_decode($cookie);

        return view('pages.home ', ['consent' => $decoded]);
    }

    public function about(Request $request)
    {
        $cookie = $request->cookie('user_consent');
        $decoded = json_decode($cookie);

        return view('pages.about', ['consent' => $decoded]);
    }

    public function privacy(Request $request)
    {
        $cookie = $request->cookie('user_consent');
        $decoded = json_decode($cookie);

        return view('pages.privacy', ['consent' => $decoded]);
    }

    public function terms(Request $request)
    {
        $cookie = $request->cookie('user_consent');
        $decoded = json_decode($cookie);

        return view('pages.terms', ['consent' => $decoded]);
    }

    public function login(Request $request)
    {
        $cookie = $request->cookie('user_consent');
        $decoded = json_decode($cookie);

        return view('pages.login', ['consent' => $decoded]);
    }

    // Show registration form
    public function register(Request $request)
    {
        $cookie = $request->cookie('user_consent');
        $decoded = json_decode($cookie);

        return view('pages.register', ['consent' => $decoded]);
    }
}
