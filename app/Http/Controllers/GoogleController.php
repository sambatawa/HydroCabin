<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();
        Session::put('user', [
            'name'  => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
        ]);

        return redirect()->route('dashboard');
    }
}
