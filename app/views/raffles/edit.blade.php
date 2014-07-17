@extends('layouts.default')

@section('content')

    @if(isset($data))
        <h1>{{ Lang::get('actions.edit') }} {{$data->name}}</h1>
    @else
        <h1>{{ Lang::get('actions.create') }} Sorteio</h1>
    @endif

    {{ Sysfeedback::render('<div class="message :type">:message</div>') }}

    @if(isset($data))
        {{ Form::model($data, array('route' => array('Raffles.update', $data->id), 'method' => 'put', 'class' => 'uk-form uk-form-stacked uk-width-1-2')) }}
    @else
        {{ Form::open(array('route' => 'Raffles.store', 'method' => 'post','class' => 'uk-form uk-form-stacked uk-width-1-2')) }}
    @endif

        <fieldset>
            <div class="uk-form-row">
                <label for="name" class="uk-form-label">{{ Lang::get('fields.name') }}</label>
                <div class="uk-form-controls">
                    {{ Form::input('text', 'name', null, array('id' =>'name', 'class' => 'uk-form-width-large ' . ($errors->has('name') ? 'uk-form-danger' : ''))) }}
                </div>
                {{ $errors->first('name','<div class="uk-text-danger">:message</div>') }}
            </div>
            
            <div class="uk-form-row">
                <label for="slug" class="uk-form-label">{{ Lang::get('fields.slug') }}</label>
                <div class="uk-form-controls">
                    {{ Form::input('text', 'slug', null, array('id' =>'slug', 'class' => 'uk-form-width-large ' . ($errors->has('slug') ? 'uk-form-danger' : ''))) }}
                </div>
                {{ $errors->first('slug','<div class="uk-text-danger">:message</div>') }}
            </div>
            
            <div class="uk-form-row">
                <label for="limit_date" class="uk-form-label">{{ Lang::get('fields.limit_date') }}</label>
                <div class="uk-form-controls">
                    {{ Form::input('text', 'limit_date', null, array('id' =>'limit_date', 'maxlength' => 10, 'data-uk-datepicker'=>'{format:\'DD-MM-YYYY\'}', 'class' => 'uk-form-width-medium ' . ($errors->has('limit_date') ? 'uk-form-danger' : ''))) }}
                    {{ Form::input('text', 'limit_time', null, array('maxlength' => 5, 'data-uk-timepicker'=>'{format:\'24h\'}', 'class' => 'uk-form-width-medium ' . ($errors->has('limit_date') ? 'uk-form-danger' : ''))) }}
                </div>
                {{ $errors->first('limit_date','<div class="uk-text-danger">:message</div>') }}
            </div>
            
            <div class="uk-form-row">
                <label for="winners" class="uk-form-label">{{ Lang::get('fields.winners') }}</label>
                <div class="uk-form-controls">
                    {{ Form::input('text', 'winners', null, array('id' =>'winners', 'class' => 'uk-form-width-large ' . ($errors->has('winners') ? 'uk-form-danger' : ''))) }}
                </div>
                {{ $errors->first('winners','<div class="uk-text-danger">:message</div>') }}
            </div>
            
            <div class="uk-form-row">
                <label for="description" class="uk-form-label">{{ Lang::get('fields.description') }}</label>
                <div class="uk-form-controls">
                    {{ Form::textarea('text', null, array('id' =>'description', 'class' => 'uk-form-width-large ' . ($errors->has('description') ? 'uk-form-danger' : ''))) }}
                </div>
                {{ $errors->first('description','<div class="uk-text-danger">:message</div>') }}
            </div>
        </fieldset>

        {{ Form::submit(Lang::get('actions.save'), array('class'=>'uk-button uk-button-primary')) }}

    {{ Form::close() }}
@stop