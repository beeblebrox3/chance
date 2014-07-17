<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>@yield('pageTitle')</title>
        <meta charset="utf-8" />
        {{ HTML::style('libs/uikit/css/uikit.min.css') }}
        {{ HTML::style('libs/uikit/css/addons/uikit.addons.min.css') }}
        {{ HTML::style('css/style.css') }}
    </head>
    <body>
        @include('layouts.elements.menu')
        <div class="uk-container uk-container-center">
            @yield('content')
        </div>


        {{ HTML::script('bower_components/jquery/dist/jquery.min.js') }}
        {{ HTML::script('libs/uikit/js/uikit.min.js') }}
        {{ HTML::script('libs/uikit/js/addons/form-password.min.js') }}
        {{ HTML::script('libs/uikit/js/addons/datepicker.min.js') }}
        {{ HTML::script('libs/uikit/js/addons/autocomplete.min.js') }}
        {{ HTML::script('libs/uikit/js/addons/timepicker.min.js') }}
        {{ HTML::script('js/app.js') }}
    </body>
</html>