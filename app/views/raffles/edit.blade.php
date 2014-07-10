@extends('layouts.default')

@section('content')
    <h1>{{ Lang::get('titles.raffles') }}</h1>

    {{ Sysfeedback::render('<div class="message :type">:message</div>') }}

    @if(isset($data))
        {{ Form::model($data, array('route' => array('Raffles.update', $data->id), 'method' => 'put')) }}
    @else
        {{ Form::open(array('route' => 'Raffles.store', 'method' => 'post')) }}
    @endif

        <fieldset>
            <div class="form-control @if($errors->has('name')) error @endif">
                <label for="name">{{ Lang::get('fields.name') }} @if($errors->has('name')) ({{ $errors->first('name') }}) @endif</label>
                {{ Form::text('name') }}
            </div>

            <div class="form-control @if($errors->has('slug')) error @endif">
                <label for="slug">{{ Lang::get('fields.slug') }} @if($errors->has('slug')) ({{ $errors->first('slug') }}) @endif</label>
                {{ Form::text('slug') }}
            </div>

            <div class="form-control @if($errors->has('limit_date')) error @endif">
                <label for="limit_date">{{ Lang::get('fields.limit_date') }} @if($errors->has('limit_date')) ({{ $errors->first('limit_date') }}) @endif</label>
                {{ Form::text('limit_date', null, array('class' => 'apply-datepicker', 'maxlength' => 16)) }}
            </div>

            <div class="form-control @if($errors->has('winners')) error @endif">
                <label for="winners">{{ Lang::get('fields.winners') }} @if($errors->has('winners')) ({{ $errors->first('winners') }}) @endif</label>
                {{ Form::text('winners', null, array('class' => '')) }}
            </div>

            <div class="form-control @if($errors->has('description')) error @endif">
                <label for="description">{{ Lang::get('fields.description') }} @if($errors->has('description')) ({{ $errors->first('description') }}) @endif</label>
                {{ Form::textarea('description') }}
            </div>
        </fieldset>

        {{ Form::submit(Lang::get('actions.save')) }}

    {{ Form::close() }}
@stop