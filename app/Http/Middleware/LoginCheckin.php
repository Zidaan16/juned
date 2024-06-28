<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginCheckin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = $request->user();
            switch ($user->role_id) {
                case 1:
                    return redirect('/superadmin');

                case 2:
                    return redirect('/admin');
                
                case 3:
                    return redirect('/dashboard');
            }
        }
        return $next($request);
    }
}
