<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()?->hasRole('admin')) {
            Auth::logout();
            return redirect()->route('login')->withErrors([
                'pseudo' => 'Accès réservé aux administrateurs.',
            ]);
        }

        return $next($request);
    }
}
