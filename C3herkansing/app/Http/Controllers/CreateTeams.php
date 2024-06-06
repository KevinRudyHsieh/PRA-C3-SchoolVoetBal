<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CreateTeams extends Controller
{
    public function index()
    {
        $userId = Auth::id();


        return view('Teams/createTeams', ['userId' => $userId]);
    }

    public function indexTeams()
    {
        $teams = Team::all();
        return view('Admin/teams' , compact('teams'));
    }

    public function joinTeams()
    {
        $userId = Auth::id();
        $teams = Team::all();


        return view('Teams/joinTeam', compact('teams', 'userId'));

    }
    public function destroy($id)
    {
        // Zoek het team op basis van het opgegeven ID
        $team = Team::findOrFail($id);
    
        // Ontkoppel de gebruiker zonder deze te verwijderen
        $team->user()->dissociate();
    
        // Sla de wijzigingen op in de database
        $team->save();
    
        // Verwijder het team zelf
        $team->delete();
    
        // Keer terug naar de teams-pagina
        return redirect()->route('teams');
    }

    public function createTeam(Request $request, $id)
    {
        $name = $request->input('name');
        if (!empty($name)) 
        {
            $team = new Team;
            $team->name = $name;
            $team->save();

            // Hier wordt het team_id bijgewerkt voor de gebruiker met id $id
            $user = User::find($id);
            $user->team_id = $team->id;
            $user->isTeamOwner = 1;
            $user->save();

            return redirect()->route('home')->with('message', 'Het team is aangemaakt');
        }
        else {
            return view('Teams/createTeams', ['userId' => $id]);
        }
    }


    public function checkTeam()
    {

        $currentUser = Auth::user();

        if ($currentUser && $currentUser->team_id !== null) {

            $teamMembers = User::where('team_id', $currentUser->team_id)->get();
            $team = Team::find($currentUser->team_id);

        return view('Teams/checkTeams', compact('teamMembers', 'team'));


        } else {

            return view('home');
        }
    }
    public function joinTeam(Request $request, $id)
    {
        $request->validate([
            'team' => 'required', // Hier kun je extra validatieregels toevoegen indien nodig
        ]);
    
        // Haal de geselecteerde waarde van het formulier op
        $selectedTeamId = $request->input('team');

        $user = User::find($id);
        $user->team_id = $selectedTeamId;
        $user->save();
        return redirect()->route('checkTeam');

    }

    public function allteams()
    {
        $teams = Team::all();

        return view('Teams/allTeams', compact('teams'));
    }

    public function teamPlayers($id)
    {
        $teams = Team::find($id);
        $users = User::where('team_id', '=', $id)->get();
        
        return view('Teams/teamPlayers', compact('teams', 'users'));
    }


    
}
