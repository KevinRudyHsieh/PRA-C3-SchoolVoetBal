<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Voer hier de controle uit om te bepalen of de gebruiker een admin is
        if (auth()->check() && auth()->user()->isAdmin) {
            return $next($request);
        }

        // Redirect naar een andere pagina of toon een foutmelding als de gebruiker geen admin is
        return redirect()->route('home')->with('error', 'Je hebt geen toegang tot deze pagina.');
    }
}
