<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>@yield('pageTitle')</title>
        <meta charset="utf-8" />
        {{ HTML::style('css/vendor/uikit.min.css') }}
        {{ HTML::style('css/vendor/addons/uikit.addons.min.css') }}
        {{ HTML::style('css/style.css') }}
    </head>
    <body>
        @include('layouts.elements.menu')
        <div class="uk-container uk-container-center">
            @yield('content')
        </div>


        {{ HTML::script('bower_components/jquery/dist/jquery.min.js') }}
        {{ HTML::script('js/vendor/uikit.min.js') }}
        {{ HTML::script('js/vendor/addons/form-password.min.js') }}
        {{ HTML::script('js/vendor/addons/datepicker.min.js') }}
        {{ HTML::script('js/vendor/addons/autocomplete.min.js') }}
        {{ HTML::script('js/vendor/addons/timepicker.min.js') }}
        {{ HTML::script('js/app.js') }}
    </body>
</html>