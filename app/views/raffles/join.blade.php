@extends('layouts.default')

@section('content')

<h1>{{ $raffle->name }}</h1>
<p>{{ $raffle->description }}</p>

{{ Sysfeedback::render('<div class="message :type">:message</div>') }}

{{ Form::open(array('route' => array('Raffles.doJoin', $raffle->slug), 'method' => 'post')) }}
<fieldset>
    <div class="form-control @if($errors->has('name')) error @endif">
        <label for="name">{{ Lang::get('fields.name') }} @if($errors->has('name')) ({{ $errors->first('name') }}) @endif</label>
        {{ Form::text('name', null, array('class' => '')) }}
    </div>

    <div class="form-control @if($errors->has('email')) error @endif">
        <label for="email">{{ Lang::get('fields.email') }} @if($errors->has('email')) ({{ $errors->first('email') }}) @endif</label>
        {{ Form::input('email', 'email', null, array('class' => '')) }}
    </div>
</fieldset>

{{ Form::submit(Lang::get('actions.send')) }}
{{ Form::close() }}
@stop