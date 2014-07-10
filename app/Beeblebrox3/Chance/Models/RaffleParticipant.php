<?php

namespace Beeblebrox3\Chance\Models;

class RaffleParticipant extends AbstractModel
{
    protected $table = 'raffles_participants';

    protected $fillable = array(
        'name',
        'email',
        'raffle_id',
    );
}
