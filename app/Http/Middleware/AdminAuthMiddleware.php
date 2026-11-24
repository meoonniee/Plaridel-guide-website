<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->get('plaridel_admin_authenticated', false)) {
            return redirect()->route('admin.login.form')
                ->with('error', 'Please sign in with your admin credentials to access tour management.');
        }

        return $next($request);
    }
}