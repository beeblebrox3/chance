@extends('layouts.default')

@section('pageTitle') Login @stop

@section('content')

<div class="box-login">
    <h1>{{ Lang::get('titles.login') }}</h1>

    {{ Sysfeedback::render('<div class="message :type">:message</div>') }}

    {{ Form::open(array('route' => 'Auth.attempt', 'method' => 'post','class'=>'uk-form uk-form-stacked')) }}
    <fieldset>
        <div class="uk-form-row">
            <label for="email" class="uk-form-label">{{ Lang::get('fields.email') }}</label>
            <div class="uk-form-controls">
                {{ Form::input('email', 'email', null, array('id' => 'email', 'class' => ($errors->has('email') ? 'uk-form-danger' : ''))) }}
            </div>
            {{ $errors->first('email') }}
        </div>

        <div class="uk-form-row">
            <label for="password" class="uk-form-label">{{ Lang::get('fields.password') }}</label>
            <div class="uk-form-controls uk-form-password uk-width-1-1">
                {{ Form::password('password', array('id' => 'password', 'class' => ($errors->has('password') ? 'uk-form-danger' : ''))) }}
                <a href="" class="uk-form-password-toggle" data-uk-form-password="{lblShow:'Mostrar', lblHide:'Esconder'}">Mostrar</a>
            </div>
            {{ $errors->first('password') }}
        </div>
        <div class="uk-form-row">
        {{ Form::submit('Entrar', array('class' => 'uk-button uk-button-primary')) }}
        </div>
    </fieldset>
    {{ Form::close() }}
</div>

@stop