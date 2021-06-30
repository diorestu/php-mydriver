<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->roles < 4) {
            return $next($request);
        }
        return redirect('/')->with('error', "Maaf, Anda tidak memiliki akses ke Halaman Admin. Hubungi pihak IT untuk informasi lebih lanjut.");
    }
}
