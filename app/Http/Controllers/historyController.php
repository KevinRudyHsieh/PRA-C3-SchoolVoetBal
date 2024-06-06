<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Toernooi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class historyController extends Controller
{
    public function index() {
        $tournament = Toernooi::where('date', '<', now())->orderBy('date', 'asc')->first();
        if (!empty($tournament)){

            
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
        
            return view('oudetournoi', compact('tournament', 'teams', 'tournament_duration', 'matchDurationInMinutes', 'teamAmount'));
        }
        else{
            return view('oudetournoi');
        }
    }

    public function TimeToMinutes($time) {
        $timeInMinutes = Carbon::createFromFormat('H:i:s', $time)->diffInMinutes(Carbon::createFromFormat('H:i:s', '00:00:00'));

        return $timeInMinutes;
    }
}
