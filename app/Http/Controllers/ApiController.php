<?php

namespace App\Http\Controllers;

use App\Models\Results;
use App\Models\Matches;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ApiController extends Controller
{
    public function getMatches()
    {
        $matches = Matches::all();
       

        return response()->json($matches);
    }
    public function getResults()
    {
        $data = Results::all();

        return response()->json($data);
    }
    public function getGoals()
    {
        $matchId = request()->input('MATCH_ID');
        $data = $this->readJsonFile('goals');

        // Filter goals based on the provided match_id
        $filteredGoals = collect($data)->where('match_id', $matchId)->values();

        return response()->json($filteredGoals);
        //voor goals moet je ook de match id opgeven bijvoorbeeld : http://localhost:8000/api/goals?MATCH_ID=90
    }

    private function readJsonFile($fileName)
    {
        $path = public_path('data/testdata.json');

        if (File::exists($path)) {
            $contents = File::get($path);
            $data = json_decode($contents, true);

            // Ensure the key exists in the JSON data
            return isset($data[$fileName]) ? $data[$fileName] : [];
        }

        return [];
    }
}
