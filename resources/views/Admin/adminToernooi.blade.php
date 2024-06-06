@extends('layouts.pageAdmin')
@section('content')

@if(!empty($tournament))
    <div class="HP-container">
        <div class="HP-Lcontainer">
            <div class="HP-tournament">
                <div class="HP-Namecontainer">
                    <h1 style="font-size:60px;">{{ $tournament['name'] }}</h1>
                </div>
                <hr>
                <div class="HP-Infocontainer">
                    <div>
                        <p>Minuten per <br>wedstrijd: <br>{{$matchDurationInMinutes }}</p>
                    </div>
                    <div>
                        <p>Tournament duurt: <br>{{ $tournament_duration }}</p>
                    </div>
                    <div>
                        <p>velden: <br>{{ $tournament['fields'] }}</p></p>
                    </div>
                    <div>
                        <p>Datum:<br>{{ $tournament['date'] }}</p>
                    </div>
                </div>
            </div>
            @if ($tournament->onGoing == 1)
                <a href="{{ route('stop', ['id' => $tournament->id]) }}"><button class="start-btn">toernament stopen</button></a>
            @else 
                <a href="{{ route('start', ['id' => $tournament->id]) }}"><button class="start-btn">toernament starten</button></a>
            @endif
            <a href="{{ route('change', ['id' => $tournament->id]) }}"><button class="Inscrhijf-btn">Aanpassen</button></a>
            
        </div>
        <div class="HP-Rcontainer">
            <h2>Teams ({{ $teamAmount }})</h2>
            <table class="HP-TeamTable">
                @foreach($teams as $team)
                    <tr>
                        <td>
                            {{ $team['name'] }}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@else
    <p>geen toernooi</p>
@endif
@endsection