<?php

namespace Beeblebrox3\Chance\Controllers;

class Raffles extends AbstractController
{
    protected $model = '\Beeblebrox3\Chance\Models\Raffle';

    public function index()
    {
        $data = $this->model()->with(array('participants', 'author'))->get();
        return \View::make('raffles.index')->with('data', $data);
    }

    public function create()
    {
        return \View::make('raffles.edit');
    }

    public function edit($id)
    {
        $data = $this->model()->find($id);
        if (!$data) {
            \App::abort(404);
        }
        return \View::make('raffles.edit')->with('data', $data);
    }

    public function store()
    {
        //@todo Novo datepicker separou hora e data
        $raffle = $this->model();
        $raffle->fill(\Input::all());

        if ($raffle->save()) {
            \Sysfeedback::success(':)');
            return \Redirect::route('Raffles');
        }

        \Sysfeedback::error(':(');
        return \Redirect::route('Raffles.create')->withInput()->withErrors($raffle->errors());
    }

    public function update($id)
    {
        $raffle = $this->model()->find($id);
        if (!$raffle) {
            \App::abort(404);
        }

        $raffle->fill(\Input::all());
        if ($raffle->save()) {
            \Sysfeedback::success(':)');
            return \Redirect::route('Raffles');
        }

        \Sysfeedback::error(':(');
        return \Redirect::route('Raffles.edit', $id)->withInput()->withErrors($raffle->errors());
    }

    public function show($id)
    {
        $data = $this->model()->with(['raffleWinners', 'participants'])->find($id);
        if (!$data) {
            \App::abort(404);
        }

        return \View::make('raffles.show')->with('data', $data);
    }

    public function getJoin($slug)
    {
        $raffle = $this->model()->active()->whereSlug($slug)->first();
        if (!$raffle) {
            \App::abort(404);
        }

        return \View::make('raffles.join')->with('raffle', $raffle);
    }

    public function postJoin($slug)
    {
        $raffle = $this->model()->active()->whereSlug($slug)->first();
        if (!$raffle) {
            \App::abort(404);
        }

        $participant = new \Beeblebrox3\Chance\Models\RaffleParticipant;
        $participant->fill(\Input::all());
        $participant->raffle_id = $raffle->id;

        if ($participant->save()) {
            \Sysfeedback::success(\Lang::get('messages.join_success'));
            return \Redirect::route('Raffles.join', $slug);
        }

        \Sysfeedback::error(\Lang::get('messages.join_error'));
        return \Redirect::route('Raffles.join', $slug)->withErrors($participant->errors())->withInput();
    }

    public function unjoin($raffle_id, $participant_id)
    {
        $participant = \Beeblebrox3\Chance\Models\RaffleParticipant::where('raffle_id', '=', $raffle_id)
            ->where('id', '=', $participant_id)->first();

        if (!$participant) {
            \Sysfeedback::error(\Lang::get('messages.participant_not_found'));
        } else {
            if ($participant->delete()) {
                \Sysfeedback::success(\Lang::get('messages.success_to_unjoin'));
            } else {
                \Sysfeedback::error(\Lang::get('messages.error_to_unjoin'));
            }
        }

        return \Redirect::route('Raffles.show', $raffle_id);
    }

    //@todo sortear sem participantes da erro
    public function randomlySelect($raffle_id)
    {
        $raffle = $this->model()->with('raffleWinners')->find($raffle_id);
        if (!$raffle) {
            \App::abort(404);
        }

        if (!count($raffle->raffleWinners) || \Request::method() === 'PUT') {
            $raffle->randomlySelect();
            \Sysfeedback::success('Sorteio realizado agora!');
        }

        return \Redirect::route('Raffles.show', $raffle_id);
    }
}
