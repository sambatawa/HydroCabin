<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckSessionUser
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('user')) {
            return redirect()->route('login.form');
        }
        $user = Session::get('user');
        
        if (!isset($user['uid']) || !isset($user['email'])) {
            Session::forget('user');
            return redirect()->route('login.form')->with('error', 'Sesi tidak valid. Silakan login kembali.');
        }
        try {
            $userRef = app('firebase.database')->getReference('Users/' . $user['uid']);
            $userData = $userRef->getValue();

            if ($userData && isset($userData['hasAccess']) && !$userData['hasAccess']) {
                Session::forget('user');
                return redirect()->route('login.form')
                    ->with('error', 'Akses login Anda telah diblokir. Silakan hubungi administrator.');
            }
        } catch (\Exception $e) {
            \Log::error('Error checking user access: ' . $e->getMessage());
        }
        return $next($request);
    }
}
