@extends('layouts.page')
@section('content')


@if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
<body>
     <div class="container">
        <div class="row">
            <h3>neem deel aan een team</h3>
            

            <form method="post" action="{{ route('joinTeam', ['id' => $userId]) }}" >
                @csrf
            
                <label for="team">Kies een team:</label>
                <select name="team" id="team">
                    <option value="">-kies een team-</option>
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                    @endforeach
                </select>
            
                <button type="submit">Selecteer Team</button>
            </form>
        {{-- <a href="{{ route('createTeam') }}" class="navElement">of Maak een team</a> --}}


        </div>

    </div>
    <div class="container">
        <div class="row">
            <h3>Maak een team</h3>

        <form method="POST" action="{{ route('update.team', ['id' => $userId]) }}">
            @csrf

            <div class="vragen">
                <label for="name">Naam team</label><br>
                <input type="text" name="name" placeholder="Naam Team" required>
            </div>
            <div class="vragen">
                <button type="submit">Verzenden</button>
            </div>
        </form>


        </div>

    </div>
</body>



@endsection