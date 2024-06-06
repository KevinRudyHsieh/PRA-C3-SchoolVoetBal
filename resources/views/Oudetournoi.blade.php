@extends('layouts.page')
@section('content')

@if(!empty($tournament))
<div class="HP-container">
    <div class="HP-Lcontainer">
        <div class="HP-tournament">
            <div>
                <h1>Eerderen tournaments</h1>

            </div>
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
        <button class="Inscrhijf-btn" hidden></button>
    </div>
    <div class="HP-Rcontainer">

    </div>
</div>
@else 
    <p>tournaments die al zijn geweest</p>
@endif

@endsection