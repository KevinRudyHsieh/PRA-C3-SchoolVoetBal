<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@include('include.head')

<body>

    @include('include.header')
    
    <main role="main">
        @yield('content')
    </main>

</body>