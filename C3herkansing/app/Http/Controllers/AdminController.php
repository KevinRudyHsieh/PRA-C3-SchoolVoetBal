<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use App\Models\Toernooi;
use App\Models\Team;
use App\Models\matches;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('Admin/adminPage', ['users' => $users]);
    }

// $tournament = Toernooi::where('date', '>', now())->orderBy('date', 'asc')->get();    
    public function index2() {
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


                    return view('admin/adminToernooi', compact('tournament', 'teams', 'tournament_duration', 'matchDurationInMinutes', 'teamAmount'));
            }
            else{
                return view('admin/adminToernooi');
            }
    }

    public function TimeToMinutes($time) {
        $timeInMinutes = Carbon::createFromFormat('H:i:s', $time)->diffInMinutes(Carbon::createFromFormat('H:i:s', '00:00:00'));

        return $timeInMinutes;
    }
    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        $user->isAdmin = $request->has('isAdmin');
        $user->save();

        // Redirect of andere logica na het bijwerken van de gebruiker

        return redirect()->back();
    }
    public function onGoingAdmin()
    {
       

        $teams = Team::all();
        $matches = matches::all();

        

        return view('Admin/toernamentOngoingAdmin', compact('teams', 'matches'));
    }


    
}
