@if(Auth::check())

    <nav class="main-nav">
        <div class="container">
            <ul>
                <li>{{ HTML::link(route('Raffles'), Lang::get('titles.raffles')) }}</li>
                <li>{{ HTML::link(route('Auth.logout'), Lang::get('actions.logout')) }}</li>
            </ul>
        </div>
    </nav>

@endif