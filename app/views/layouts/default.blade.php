<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title> @yield('pageTitle') </title>
    <meta charset="utf-8" />

    {{ HTML::style('libs/skeleton/stylesheets/base.css') }}
    {{ HTML::style('libs/skeleton/stylesheets/skeleton.css') }}
    {{ HTML::style('libs/datepicker/jquery.simple-dtpicker.css') }}
    {{ HTML::style('css/style.css') }}
</head>
<body>
    @include('layouts.elements.menu')
    
    <div class="container">
        @yield('content')
    </div>


    {{ HTML::script('bower_components/jquery/dist/jquery.min.js') }}
    {{ HTML::script('libs/datepicker/jquery.simple-dtpicker.js') }}
    {{ HTML::script('js/app.js') }}
</body>
</html>