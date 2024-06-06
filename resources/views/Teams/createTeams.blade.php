{{-- @extends('layouts.page')
@section('content')


@if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
<body>
     <div class="container">
        <div class="row">
            <h3>maak een team</h3>

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



@endsection --}}