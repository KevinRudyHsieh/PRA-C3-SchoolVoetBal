@extends('layouts.page')

@section('content')

    @if(!empty($tournament))
        <div class="HP-container">
            <div class="HP-Lcontainer">
                <div class="HP-tournament">
                    <div class="HP-Namecontainer">
                        <h1 style="font-size: 60px;">{{ $tournament['name'] }}</h1>
                    </div>
                    <hr>
                    <div class="HP-Infocontainer">
                        <div>
                            <p>hoeveelheid minuten per <br>wedstrijd: <br>{{ $matchDurationInMinutes }}</p>
                        </div>
                        <div>
                            <p>Tournament duurt: <br>{{ $tournament_duration }}</p>
                        </div>
                        <div>
                            <p>Datum van het tournament:<br>{{ $tournament['date'] }}</p>
                        </div>
                    </div>
                </div>

                {{-- <button class="Inscrhijf-btn" onclick="togglePopup()">Inscrhijven</button> --}}
                @if ($tournament['onGoing'] == 1)
                    <a href="{{ route('onGoing') }}" class="Inscrhijf-btn">bekijk tournament</a>
                @else
                    @if(auth()->check() && auth()->user()->isTeamOwner)
                        @if ($teams->registerd = 1)
                            <form method="post" action="{{ route('submit', ['id' => $userId]) }}">
                                @csrf
                                <button class="Inscrhijf-btn" type="submit">registreren</button>
                            </form>
                        @else
                            <button class="Inscrhijf-btn" type="submit">geregistreerd</button>
                        @endif
                    @endif
                @endif

            </div>
            <div class="HP-Rcontainer">
                <h2>Teams ({{ $teamAmount }})</h2>
                <div class="HP-TeamTable">
                    <table>
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
        </div>
    @else
        <p>er is geen tournament op de planning</p>
    @endif

@endsection
