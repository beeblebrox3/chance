@if(Auth::check())
<nav class="uk-navbar">
    <div class="uk-container uk-container-center">
        <ul class="uk-navbar-nav">
            <li>{{ HTML::link(route('Raffles'), Lang::get('titles.raffles')) }}</li>
        </ul>
        <div class="uk-navbar-flip">
            <ul class="uk-navbar-nav">
                <li>{{ HTML::link(route('Auth.logout'), Lang::get('actions.logout')) }}</li>
            </ul>
        </div>
    </div>
</nav>
@endif