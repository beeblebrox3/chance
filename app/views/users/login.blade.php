@extends('layouts.default')

@section('pageTitle') Login @stop

@section('content')

    <div class="box-login">
        <h1>{{ Lang::get('titles.login') }}</h1>

        {{ Sysfeedback::render('<div class="message :type">:message</div>') }}

        {{ Form::open(array('route' => 'Auth.attempt', 'method' => 'post')) }}
            <fieldset>
                <div class="form-control @if($errors->has('email')) error @endif">
                    <label for="email">{{ Lang::get('fields.email') }}</label>
                    {{ Form::input('email', 'email', null, array('class' => '')) }}

                    {{ $errors->first('email') }}
                </div>

                <div class="form-control @if($errors->has('password')) error @endif">
                    <label for="password">{{ Lang::get('fields.password') }}</label>
                    {{ Form::password('password', array('class' => '')) }}

                    {{ $errors->first('password') }}
                </div>

                {{ Form::submit('Entrar', array('class' => 'button')) }}
            </fieldset>
        {{ Form::close() }}
    </div>

@stop