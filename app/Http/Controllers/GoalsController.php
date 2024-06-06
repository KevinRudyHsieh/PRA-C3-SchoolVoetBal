<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Toernooi;
use App\Models\Team;
use App\Models\matches;


class GoalsController extends Controller
{
    public function changeScore_B(Request $request, $id)
    {
        $matches = matches::find($id);
        $score = $request->input('score_b');


        $matches->team_b_score = $score;
        $matches->save();

       return redirect()->route('onGoingAdmin');
    }
    public function changeScore_A(Request $request, $id)
    {
        $matches = matches::find($id);
        $score = $request->input('score_A');


        $matches->team_a_score = $score;
        $matches->save();

       return redirect()->route('onGoingAdmin');
    }
 // 
    public function fetchGoals(Request $request)
    {
        $userKey = $request->query('key');
        $gameId = $request->query('game_id');

        // Your logic to fetch goals based on $userKey and $matchId

        // Example response
        return response()->json(['user' => $userKey, 'game_id' => $gameId, 'goals' => []]);
    }
}
