@extends('layouts.page')

@section('content')

<h1>Teams Overview</h1>

<table>
    <thead>
      <th>Player Name: </th>
      <th>Role: </th>
    </thead>
  <tbody>
    @foreach ($teamMembers as $member)
      <tr>
          <td>
            {{ $member->name }}
          </td>        
          <td>
                @if ($member->isTeamOwner == 1)
                    Owner
                @else
                    Player
                @endif
            </td>
      </tr>
    @endforeach
  </tbody>
</table>

@endsection