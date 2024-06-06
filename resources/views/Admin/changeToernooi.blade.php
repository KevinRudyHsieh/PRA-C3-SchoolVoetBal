@extends('layouts.pageAdmin')
@section('content')


@if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
<body>
     <div class="container">
        <div class="row">
            <h3>pas het tournament aan</h3>

            <form method="POST" action="{{ route('update.toernooi', $toernooi->id) }}">
                @csrf
                @method('PUT')
                <div class="vragen">
                    <label for="name">Naam Toernooi</label><br>
                    <input type="text" name="name" value="{{ $toernooi->name }}" required>
                </div>
                <div class="vragen">
                    <label for="velden">Hoeveel velden zijn er? </label>
                    <input type="number" id="velden" value="{{ $toernooi->fields}}" name="velden">
                </div>
                <div class="vragen">
                    <label for="date">wanneer is het Toernooi</label>
                    <div class="antwoorden">
                        <input type="datetime-local" id="datetime" name="datetime" value="{{ $toernooi->date }}">
                    </div>
                </div>
            
                <div class="vragen">
                    <button type="submit">Verzenden</button>
                </div>
            </form>


        </div>

    </div>
</body>



@endsection