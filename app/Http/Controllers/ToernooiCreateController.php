<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toernooi;
use App\Models\Team;
use App\Models\matches;


class ToernooiCreateController extends Controller
{
    public function index()
    {
        return view('Admin/Create');
    }
    public function indexChange(Request $request, $id)
    {
        // Verwerk het verzoek en toon de bewerkingspagina voor het opgegeven $i
        $toernooi = Toernooi::find($id);

        return view('Admin/changeToernooi', compact('toernooi'));
    }
    public function updateToernooi(Request $request, $id)
    {
        $toernooi = Toernooi::find($id);

 
        
    // // Valideer de invoer hier indien nodig
        $request->validate([
            'name' => 'required',
            'velden' => 'required',
            'datetime' => 'required',
            // Voeg validatieregels toe voor andere velden indien nodig
        ]);

        // Werk de velden bij
        $toernooi->name = $request->input('name');
        $toernooi->fields = $request->input('velden');
        $toernooi->date = $request->input('datetime');
        // Voeg andere velden toe die je wilt bijwerken

        // Sla de wijzigingen op
        $toernooi->save();

        return redirect()->route('home')->with('success', 'Toernooi bijgewerkt!');
    }


    public function ToernooiCreate(Request $request)
    {
        $name = $request->input('name');
        $velden = $request->input('velden');
        $date = $request->input('date');

        if (!empty($name) && !empty($velden) && !empty($date)) 
        {
            $toernooi = new Toernooi;
            $toernooi->name = $name;
            $toernooi->fields = $velden;
            $toernooi->date = $date;


            $toernooi->save();

            return redirect()->route('home')->with('message', 'Het Toernooi is aangemaakt');
        }
        else {
            return redirect()->route('Toernooi');
        }

    }

    public function start(Request $request, $id)
    {
        $toernooi = Toernooi::find($id);
        $toernooi2 = $id;

        if ($toernooi) {
            $toernooi->onGoing = 1;
            $toernooi->save(); 
    

        }
        
        $teams = Team::where('registered', '=', '1')->get();
        if ($teams->count() > 1) {
            // $tournament = Toernooi::where('date', '>', now())->orderBy('date', 'asc')->first();
            $matches = matches::all();
            $fields = $toernooi->fields + 1;
            // Loop door elk team en genereer de wedstrijden
            foreach ($teams as $teamA) {
                foreach ($teams as $teamB) {
                    if ($teamA->id != $teamB->id) {
                        //Controleer of de wedstrijd al bestaat om duplicaten te voorkomen
                        $existingMatch = matches::where(function ($query) use ($teamA, $teamB) {
                            $query->where('team_a_id', $teamA->id)
                                ->where('team_b_id', $teamB->id);
                        })->orWhere(function ($query) use ($teamA, $teamB) {
                            $query->where('team_a_id', $teamB->id)
                                ->where('team_b_id', $teamA->id);
                        })->exists();

                            
                        if (!$existingMatch) {
                            // Voeg de wedstrijd toe aan de database

                            $fields -= 1;
                            if ($fields == 0) {
                                $fields = $toernooi->fields;
                            } 

                            matches::create([
                                'team_a_id' => $teamA->id,
                                'team_b_id' => $teamB->id,
                                'toernooi_id' => $toernooi2,
                                'matchField' => $fields,
                            ]);
                            
                        }
                        
                        

                        
                    }
                }
            }

            return view('admin/toernamentOngoingAdmin', compact('teams', 'matches', 'toernooi2', 'toernooi'));
        }
    }


    public function stop(Request $request, $id)
    {
        $toernooi = Toernooi::find($id);
        $matches = matches::all();
        $teams = Team::all();

        foreach ($teams as $team)
        {
            $team->points = 0;
            $team->save(); 
        }
        foreach ($matches as $match)
        {
            $match->delete();
        }
        if ($toernooi) {
            $toernooi->onGoing = 0;
            $toernooi->save(); 
    
            return redirect()->route('home');
        } else {
    
            return redirect()->route('home');
        }
    }

    public function onGoing()
    {
        

        $teams = Team::all();
        $matches = matches::all();

        // Loop door elk team en genereer de wedstrijden
        
        return view('toernamentOngoing', compact('teams', 'matches'));
    }
    public function endMatch($id)
    {
    $match = matches::find($id);
    $teams = Team::all();
    

    $match->status = 'afgelopen';
    $match->save();


    if ($match->team_a_score > $match->team_b_score) {
        foreach ($teams as $team) {
            if ($match->team_a_id == $team->id) {
                $team->points += 3;
                $team->save(); 
            }
        }
    } elseif ($match->team_a_score < $match->team_b_score) {
        foreach ($teams as $team) {
            if ($match->team_b_id == $team->id) {
                $team->points += 3;
                $team->save(); 
            }
        }
    } else {
        foreach ($teams as $team) {
            if ($match->team_b_id == $team->id) {
                $team->points += 1;
                $team->save(); 
            }
            if ($match->team_a_id == $team->id) {
                $team->points += 1;
                $team->save(); 
            }
        }
    }

    return redirect()->route('onGoingAdmin');
    }
    public function startMatch($id)
    {
        $match = matches::find($id);

        $match->status = 'bezig';
        $match->save();

        return redirect()->route('onGoingAdmin');
    }

    
}
