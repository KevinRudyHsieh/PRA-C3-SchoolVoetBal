@extends('layouts.page')
@section('content')

@if ($matches->count() > 0)
    <?php $sortedTeams = $teams->sortByDesc('points'); $i = 1;?>

    <div class="container">
        <div class="scoreboard">
            <h1>Scorebord</h1>
            @foreach ($sortedTeams as $team) 
                @if ( $team->registered == 1)
                    <p>{{$i}} | Team name: {{ $team->name }} | Punten: {{ $team->points }}</p>
                    <?php $i++ ?>
                @endif
            @endforeach
        </div>

        <div class="matches-container">
            <h3>Wedstrijden nu bezig</h3>
            @foreach($matches as $match)
                @if ($match->status == "bezig")
                    <div class="current-match">
                        <div class="team-names">
                            @foreach ($teams as $team)
                                @if ($match->team_a_id == $team->id)
                                    <h2>{{ $team->name }} VS</h2>
                                @endif

                                @if ($match->team_b_id == $team->id)
                                    <h2> {{ $team->name }}</h2>
                                @endif
                            @endforeach
                        </div>
                        <div class="score">
                            <h3>Score: {{ $match->team_a_score }} - {{ $match->team_b_score }}</h3>
                        </div>

                    </div>
                @endif
            @endforeach

            <h3>Alle wedstrijden</h3>
            @foreach($matches as $match)
                <div class="match">
                    <div>
                        @foreach ($teams as $team)
                            @if ($match->team_a_id == $team->id)
                                Team 1: {{ $team->name }} | 
                            @endif

                            @if ($match->team_b_id == $team->id)
                                Team 2: {{ $team->name }} | Veld: {{ $match->matchField}} | Score: {{ $match->team_a_score}} - {{ $match->team_b_score}} 
                            @endif
                        @endforeach
                    </div>
                    <div>{{ $match->status}}</div>
                </div>
            @endforeach
        </div>
    </div>

@else 
    <p>Er is geen toernooi bezig</p>
@endif

@endsection
