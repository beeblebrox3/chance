@extends('layouts.default')

@section('content')

<h1>{{ $raffle->name }}</h1>
<p>{{ $raffle->description }}</p>

{{ Sysfeedback::render('<div class="message :type">:message</div>') }}

{{ Form::open(array('route' => array('Raffles.doJoin', $raffle->slug), 'method' => 'post', 'class' => 'uk-form uk-form-stacked uk-width-1-2')) }}
<fieldset>
    <div class="uk-form-row">
        <label for="name" class="uk-form-label">{{ Lang::get('fields.name') }}</label>
        <div class="uk-form-controls">
            {{ Form::input('text', 'name', null, array('id' =>'name', 'class' => 'uk-form-width-large ' . ($errors->has('name') ? 'uk-form-danger' : ''))) }}
        </div>
        {{ $errors->first('name','<div class="uk-text-danger">:message</div>') }}
    </div>

    <div class="uk-form-row">
        <label for="email" class="uk-form-label">{{ Lang::get('fields.email') }}</label>
        <div class="uk-form-controls">
            {{ Form::input('email', 'email', null, array('id' =>'email', 'class' => 'uk-form-width-large ' . ($errors->has('email') ? 'uk-form-danger' : ''))) }}
        </div>
        {{ $errors->first('email','<div class="uk-text-danger">:message</div>') }}
    </div>
</fieldset>

<div class="uk-form-row">
    {{ Form::submit(Lang::get('actions.send'),['class' => 'uk-button uk-button-primary']) }}
</div>
{{ Form::close() }}
@stop