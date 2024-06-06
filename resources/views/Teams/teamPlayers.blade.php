@extends('layouts.page')

@section('content')

<table>
    <tr>
        <th>Name</th>
        <th>Role</th>
    </tr>

    @foreach($users as $user)

        <tr>
            <td>{{ $user->name }}</td>
            <td>
                @if ($user->isTeamOwner == 1)
                    owner
                @else
                    player
                @endif
            </td>
        </tr>

    @endforeach
</table>

@endsection
