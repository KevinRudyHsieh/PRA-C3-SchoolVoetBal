@extends('layouts.page')
@section('content')



<div class="tableTeams">        
    @if (empty($teams))
        <p>er zijn geen teams</p>
    @else
    <table>
        <thead>
            <th>Alle Teams:</th>
            <th>Player Count: </th>
        </thead>
    <tbody>
            @foreach($teams as $team)
                <tr>
                    <td>
                        <a href="{{ route('teamPlayers', ['id' => $team->id]) }}" style="text-decoration: none; color: inherit; display: flex; ">{{ $team->name }}</a>
                    </td>
                    <td>
                        <p>{{ $team->registered }}</p>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>

@endsection
