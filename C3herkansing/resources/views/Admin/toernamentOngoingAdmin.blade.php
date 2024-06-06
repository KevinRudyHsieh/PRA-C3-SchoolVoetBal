@extends('layouts.pageAdmin')
@section('content')

@if ($matches->count() > 0)
    <?php $sortedTeams = $teams->sortByDesc('points'); $i = 1;?>

    <h1>score board</h1>
    @foreach ($sortedTeams as $team) 
        @if ( $team->registered == 1)
            <p>{{$i}} | Team name: {{ $team->name }} | punten: {{ $team->points }}</p>
            <?php $i++ ?>
        @endif
    @endforeach

    <h3> wedstrijden nu bezig </h3>
    @foreach($matches as $match)
        @if ($match->status == "bezig")
            @foreach ($teams as $team)
                @if ($match->team_a_id == $team->id)
                    Team 1: {{ $team->name }} | 
                @endif

                @if ($match->team_b_id == $team->id)
                    Team 2: {{ $team->name }} | veld: {{ $match->matchField}} | score: {{ $match->team_a_score}} - {{ $match->team_b_score}} | {{$match->status}}
                    <form method="post" action="{{ route('changeScore_A', ['id' => $match->id]) }}" style="display: inline-block;"> @csrf @method('patch') <input onchange="this.form.submit()" id ="score_A" class="score" value="{{ $match->team_a_score }}" type="number" name="score_A"></form> - 
                    <form method="post" action="{{ route('changeScore_B', ['id' => $match->id]) }}" style="display: inline-block;"> @csrf @method('patch') <input onchange="this.form.submit()" id ="score_b" class="score" value="{{ $match->team_b_score }}" type="number" name="score_b"></form>
                    <form action="{{ route('endMatch', ['id' => $match->id]) }}" style="display: inline-block;"><button type="submit" id = "endMatch" name="endMatch">eindig wedstrijd	</button></form>
                @endif
            @endforeach
            <br>
        @endif
    @endforeach

    
    
    <h3>alle wedstrijden</h3>
    @foreach($matches as $match)
        @foreach ($teams as $team)
            @if ($match->team_a_id == $team->id)
                Team 1: {{ $team->name }} | 
            @endif

            @if ($match->team_b_id == $team->id)
                Team 2: {{ $team->name }} | veld: {{ $match->matchField}} | score: {{ $match->team_a_score}} - {{ $match->team_b_score}} | {{$match->status}}
                
                @if ( $match->status == "moet nog beginnen")
                    <form action="{{ route('startMatch', ['id' => $match->id]) }}" style="display: inline-block;"><button type="submit" id = "startMatch" name="startMatch">start wedstrijd	</button></form>

                   
                @endif
            @endif
            
        @endforeach
        <br><br>
    @endforeach
    
    
@else 
    <p>er is geen toernooi bezig</p>
@endif




    



@endsection

{{-- score: {{ $match->team_a_score}} - {{ $match->team_b_score}} --}}
