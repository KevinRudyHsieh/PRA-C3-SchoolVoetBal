<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Toernooi;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class InschrijfController extends Controller
{
    public function index() {


        $userId = Auth::id();


        $tournament = Toernooi::Where('onGoing', '=', 1)->first();
        if (empty($tournament)) 
        {
            $tournament = Toernooi::where('date', '>', now())->orderBy('date', 'asc')->first();
        }


            if (!empty($tournament))
            {
                $teams = Team::where('registered', '=', 1)->get();
                $teamAmount = $teams->count();
            
                $matchDurationInMinutes = $this->TimeToMinutes($tournament['match_duration']);
            
                // Bereken het totale aantal wedstrijden dat moet worden gespeeld
                $totalMatches = $teamAmount * ($teamAmount - 1) / 2;
            
                // Verdeel het totale aantal wedstrijden over de beschikbare velden
                $matchesPerField = ceil($totalMatches / $tournament['fields']);
            
                // Bereken de totale duur van het toernooi op basis van het aantal wedstrijden per veld
                $tournament_duration = $matchesPerField * $matchDurationInMinutes;
            
                if ($tournament_duration < 60) {
                    $tournament_duration = $tournament_duration . " minutes";
                } else {
                    $hours = floor($tournament_duration / 60);
                    $remainingMinutes = $tournament_duration % 60;
                    $tournament_duration = sprintf('%02d:%02d', $hours, $remainingMinutes);
                    $tournament_duration = $tournament_duration . " uur";
                }


                    return view('homePage', compact('tournament', 'teams', 'tournament_duration', 'matchDurationInMinutes', 'teamAmount', 'userId'));
            }
            else{
                return view('homePage', compact('userId'));
            }
    }
    

    public function TimeToMinutes($time) {
        $timeInMinutes = Carbon::createFromFormat('H:i:s', $time)->diffInMinutes(Carbon::createFromFormat('H:i:s', '00:00:00'));

        return $timeInMinutes;
    }

    public function submit($id)
    {
        $user = User::find($id);

    $team_id = $user->team_id;

    $team = Team::where('id', '=', $team_id)->first(); // Voeg ->first() toe om het daadwerkelijke model te krijgen

    // Controleer of het teammodel is gevonden
    if ($team) {
        $team->registered = 1;
        $team->save(); // Sla de wijzigingen op

        return redirect()->route('home');
    } else {

        return redirect()->route('home')->with('error', 'Team niet gevonden.');
    }
    }
}
