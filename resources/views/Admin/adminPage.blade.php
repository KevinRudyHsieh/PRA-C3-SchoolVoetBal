@extends('layouts.pageAdmin')
@section('content')

<h3>admin</h3>


<div class="container">
    <h1>All Users</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
                <th>is_admin</th>
                <!-- Voeg extra kolommen toe indien nodig -->
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('Y-m-d H:i:s') }}</td>
                    {{-- <td>{{ $user->is_admin ? 'Yes' : 'No' }}</td> --}}
                    <td>
                        <form method="post" action="{{ route('updateUser', ['id' => $user->id]) }}">
                            @csrf
                            @method('patch')
                            <input type="checkbox" id="isAdmin" name="isAdmin" value="1" {{ $user->isAdmin ? 'checked' : '' }} onchange="this.form.submit()">
                        </form>
                    </td>
                    <!-- Voeg extra kolommen toe indien nodig -->
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
