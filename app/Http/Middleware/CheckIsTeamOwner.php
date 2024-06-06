<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIsTeamOwner
{
    public function handle($request, Closure $next)
    {
        // Controleer of de gebruiker is ingelogd
        if (Auth::check()) {
            // Controleer of de gebruiker isTeamOwner is
            if (Auth::user()->isTeamOwner == 1) {
                return $next($request);
            }
        }

        // Gebruiker is geen team-eigenaar, doorsturen naar een foutpagina of ergens anders
        abort(403, 'Unauthorized action.');

        // Of je kunt een redirect doen naar een andere route
        // return redirect('home')->with('error', 'Je hebt geen toestemming om deze actie uit te voeren.');

        // Of stuur door naar de volgende middleware/route
        // return $next($request);
    }
}
