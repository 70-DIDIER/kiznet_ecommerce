<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterVerification;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:subscribers,email',
        ], [
            'name.required' => 'Le nom est requis',
            'email.required' => 'L\'email est requis',
            'email.email' => 'L\'email doit être valide',
            'email.unique' => 'Cet email est déjà inscrit',
        ]);

        $subscriber = Subscriber::create([
            'name' => $request->name,
            'email' => $request->email,
            'token' => Str::random(60),
        ]);

        // Envoyer l'email de vérification
        Mail::to($subscriber->email)->send(new NewsletterVerification($subscriber));

        return back()->with('success', 'Merci ! Veuillez vérifier votre email ou vos spams pour confirmer votre inscription.');
    }

    public function verify($token)
    {
        $subscriber = Subscriber::where('token', $token)->firstOrFail();

        if ($subscriber->is_verified) {
            return redirect('/')->with('info', 'Votre email est déjà vérifié.');
        }

        $subscriber->update([
            'is_verified' => true,
            'verified_at' => now(),
        ]);

        return redirect('/')->with('success', 'Votre inscription à la newsletter est confirmée !');
    }

    public function unsubscribe($token)
    {
        $subscriber = Subscriber::where('token', $token)->firstOrFail();
        $subscriber->delete();

        return redirect('/')->with('success', 'Vous avez été désinscrit de la newsletter.');
    }
}