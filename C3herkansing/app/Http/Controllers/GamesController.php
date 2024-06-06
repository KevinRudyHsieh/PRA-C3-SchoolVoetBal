<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GamesController extends Controller
{
    public function fetchMatches(Request $request)
    {
        $userKey = $request->query('key');

        // Your logic to fetch matches based on $userKey

        // Example response
        return response()->json(['user' => $userKey, 'games' => []]);
    }
}

