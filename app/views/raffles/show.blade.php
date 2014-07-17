@extends('layouts.default')

@section('content')
    <h1>Sorteio: {{ $data->name }}</h1>
    <p>{{ $data->description }}</p>

    {{ Sysfeedback::render('<div class="message :type">:message</div>') }}

    @if (count($data->raffleWinners))
        <h2>{{ Lang::get('fields.winners') }}</h2>

        <table class="uk-table uk-table-striped uk-table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ Lang::get('fields.name') }}</th>
                    <th>{{ Lang::get('fields.email') }}</th>
                    <th>{{ Lang::get('fields.id') }} </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->raffleWinners as $winner)
                    <tr>
                        <td>{{ $winner->id }}</td>
                        <td>{{ $winner->participant->name }}</td>
                        <td>{{ $winner->participant->email }}</td>
                        <td>{{ $winner->participant->id }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <span class="uk-button" data-label="{{ Lang::get('messages.confirm_redo_raffle') }}" data-confirm="{{ route('Raffles.redoRandomlySelect', $data->id) }}" data-method="put">{{ Lang::get('actions.redoRaffle') }}</span>
    @else
        <span class="uk-button uk-button-success" data-label="{{ Lang::get('messages.confirm_do_raffle') }}" data-confirm="{{ route('Raffles.randomlySelect', $data->id) }}">{{ Lang::get('actions.doRaffle') }}</span>
    @endif


    <h2>{{ Lang::get('fields.participants') }}</h2>

    {{ HTML::link(route('Raffles.join', $data->slug), Lang::get('actions.create'), array('target' => '_blank', 'class'=>'uk-button uk-button-primary')) }}

    <table class="uk-table uk-table-striped uk-table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ Lang::get('fields.name') }}</th>
                <th>{{ Lang::get('fields.email') }}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->participants as $participant)
                <tr>
                    <td>{{ $participant->id }}</td>
                    <td>{{ $participant->name }}</td>
                    <td>{{ $participant->email }}</td>
                    <td>
                        <span class="uk-button-link pointer" data-delete="{{ route('Raffles.unjoin', array($data->id, $participant->id)) }}">{{ Lang::get('actions.delete') }}</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ HTML::link(route('Raffles.join', $data->slug), Lang::get('actions.create'), array('target' => '_blank', 'class'=>'uk-button uk-button-primary')) }}
@stop