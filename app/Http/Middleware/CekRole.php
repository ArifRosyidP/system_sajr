<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekRole
{
    /**
     * Handle an incoming request.
     * @param  Closure(Request): (Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }
    public function handle(Request $request, Closure $next, ...$roles) : Response
    {
        if(in_array($request->user()->role, $roles)){
            return $next($request);
        }
        abort(403, 'Anda tidak memiliki akses ke halaman ini. Silahkan kembali ke halaman sebelumnya.');
        // return back()->with([
        //             'alert' => [
        //                 'title' => 'Tidak Dapat Memuat Halaan',
        //                 'text' => 'Akun tidak memiliki askses ke halaman ini',
        //                 'icon' => 'warning'
        //             ]
        //         ]);
        // return redirect()->intended('/setup/klien');
        // dd($request->user()->role, $roles);
}
}