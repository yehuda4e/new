<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Script -->
    <script src="/js/sweetalert2.min.js"></script>
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
</head>
<body>
    <div id="app">
        @include('layouts.nav')
        <div class="ui container">
            @yield('content')
            @if (Session::has('info'))
                @include('layouts.alert')
            @endif
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @if (Session::has('info'))
    <script>
    $('.message .close')
    .on('click', function() {
        $(this)
        .closest('.message')
        .transition('fade')
    })  
    $('.alert').delay(2000).fadeOut('slow');
    </script>
    @endif
    <script>
    $('.alert').delay(2000).fadeOut('slow');        
    $(".ui.dropdown").dropdown();
    </script>
    @stack('js')
</body>
</html>
