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
            <h3>create Toernooi</h3>

        <form method="POST" action="/submit">
            @csrf
            <div class="vragen">
                <label for="name">Naam Toernooi</label><br>
                <input type="text" name="name" placeholder="Naam Toernooi" required>
            </div>
            <div class="vragen">
                <label for="velden">Hoeveel velden zijn er? </label>
                <input type="number" id="velden" name="velden">
            </div>
            <div class="vragen">
                <label for="date">wanneer is het Toernooi</label>
                <div class="antwoorden">
                    <input type="datetime-local" id="date" name="date">
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