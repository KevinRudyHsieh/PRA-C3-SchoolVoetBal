<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResultsController extends Controller
{
    public function fetchResults(Request $request)
    {
        $userKey = $request->query('key');

        // Your logic to fetch results based on $userKey

        // Example response
        return response()->json(['user' => $userKey, 'results' => []]);
    }
}