<?php

namespace Beeblebrox3\Chance\Models\Observers;

class RaffleWinner extends AbstractObserver
{
    protected $rules = array(
        'raffle_participant_id' => 'required|exists:raffles_participants,id',
        'raffle_id' => 'required|exists:raffles,id',
    );
}
