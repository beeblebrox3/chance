<?php

namespace Beeblebrox3\Chance\Models;

class RaffleWinner extends AbstractModel
{
    protected $table = 'raffles_winners';

    protected $fillable = array(
        'raffle_participant_id',
        'raffle_id',
    );

    protected function participant()
    {
        return $this->belongsTo('Beeblebrox3\Chance\Models\RaffleParticipant', 'raffle_participant_id', 'id');
    }
}
