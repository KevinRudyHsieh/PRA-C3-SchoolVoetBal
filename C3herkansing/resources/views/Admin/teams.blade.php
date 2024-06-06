@extends('layouts.pageAdmin')

@section('content')

<h1>overzich van teams</h1>

<table>
  <thead>
    <tr>
      <th>Team Name</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($teams as $team)
      <tr>
        <td>{{ $team->name }}</td>
        <td>
          <a href="{{ route('teams.edit', $team->id) }}">Edit</a>
        </td>
        <td>
          <form method="POST" action="{{ route('teams.destroy', $team->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

@endsection