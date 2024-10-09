<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckPrivilege
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $privilege
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, $privilege): Response
    {
        // Cek jika pengguna terautentikasi
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect ke login jika tidak terautentikasi
        }

        // Cek privilege pengguna
        if (Auth::user()->privilege !== $privilege) {
            return redirect()->back();
        }

        return $next($request);
    }
}