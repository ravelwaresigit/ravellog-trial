<!DOCTYPE html>
<html lang="en">
    <div id="fixed">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">


            <title>{{ config('app.name', 'Ravellog') }}</title>
            <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
            <meta name="description" content="">
            <meta name="author" content="">
            <!-- Bootstrap Core CSS -->
            <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

            <!-- Custom CSS -->
            <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
            <link href="{{ asset('css/app.css') }}" rel="stylesheet">
            <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
            <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
            <!-- jQuery -->
            <script src="{{ asset('js/jquery.js') }}"></script>
            <script src="{{ asset('js/jquery-ui.js') }}"></script>
        </head>

        <body>
            <div class="content">
                @yield('content')
            </div>
        </body>
    </div>
</html>