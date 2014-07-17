@extends('layouts.default')

@section('content')
    <h1>{{ Lang::get('titles.raffles') }}</h1>

    {{ Sysfeedback::render('<div class="message :type">:message</div>') }}

    {{ HTML::link(route('Raffles.create'), Lang::get('actions.create'),['class'=>'uk-button uk-button-primary']) }}

    <table class="uk-table uk-table-striped uk-table-hover">
        <thead>
            <tr>
                <th>{{ Lang::get('fields.id') }}</th>
                <th>{{ Lang::get('fields.name') }}</th>
                <th>{{ Lang::get('fields.slug') }}</th>
                <th>{{ Lang::get('fields.limit_date') }}</th>
                <th>{{ Lang::get('fields.participants') }}</th>
                <th>{{ Lang::get('fields.winners') }}</th>
                <th>{{ Lang::get('fields.created_at') }}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $piece)
            <tr>
                <td>{{ $piece->id }}</td>
                <td>{{ HTML::link(route('Raffles.show', $piece->id), $piece->name) }}</td>
                <td>
                    {{ HTML::link(route('Raffles.join', $piece->slug), $piece->slug, array('target' => '_blank')) }}
                </td>
                <td>{{ $piece->limit_date }}</td>
                <td>{{ count($piece->participants) }}</td>
                <td>{{ $piece->winners }}</td>
                <td>{{ $piece->created_at }}</td>
                <td>
                    {{ HTML::link(route('Raffles.edit', $piece->id), Lang::get('actions.edit')) }}
                    <span class="uk-button-link pointer" data-delete="{{ route('Raffles.destroy', $piece->id) }}">{{ Lang::get('actions.delete') }}</span>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@stop