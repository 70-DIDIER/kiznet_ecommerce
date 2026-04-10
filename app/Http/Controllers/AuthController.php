<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // Page de connexion
    public function loginForm(): \Illuminate\View\View
    {
        return view('admin.auth.login');
    }

    // Traitement de la connexion
    public function login(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'pseudo'   => 'required|string',
            'password' => 'required|string',
        ]);

        $throttleKey = Str::lower($request->input('pseudo')) . '|' . $request->ip();

        // Blocker après 5 tentatives (fenêtre de 60 secondes)
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->withErrors([
                'pseudo' => "Trop de tentatives. Réessayez dans {$seconds} secondes.",
            ]);
        }

        if (! Auth::attempt(['pseudo' => $request->input('pseudo'), 'password' => $request->input('password')], $request->boolean('remember'))) {
            RateLimiter::hit($throttleKey, 60);
            return back()->withErrors(['pseudo' => 'Identifiants incorrects.'])->onlyInput(['pseudo']);
        }

        RateLimiter::clear($throttleKey);
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'))->with('success', 'Connexion reussie.');
    }

    // Déconnexion
    public function logout(Request $request): \Illuminate\Http\RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
