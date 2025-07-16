<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoleCheck
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Session::has('user')) {
            return redirect()->route('login.form')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Session::get('user');
        $allowedRoles = explode('|', $role);

        if (!in_array($user['role'], $allowedRoles)) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => 'Unauthorized',
                    'message' => 'Anda tidak memiliki akses ke halaman ini.'
                ], 403);
            }

            return redirect()->route('dashboard')
                ->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
        }

        return $next($request);
    }
}