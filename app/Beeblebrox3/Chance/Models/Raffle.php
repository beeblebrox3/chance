<?php

namespace Beeblebrox3\Chance\Models;

use Pixeloution\Random\Randomizer;

class Raffle extends AbstractModel
{
    protected $fillable = array(
        'name',
        'description',
        'slug',
        'limit_date',
        'winners',
        'author_id',
    );

    protected $randomizer = null;

    protected $table = 'raffles';

    public function author()
    {
        return $this->belongsTo('Beeblebrox3\Chance\Models\User', 'author_id');
    }

    public function participants()
    {
        return $this->hasMany('Beeblebrox3\Chance\Models\RaffleParticipant', 'raffle_id');
    }

    public function scopeActive($query)
    {
        return $query->where('limit_date', '>=', date('Y-m-d H:i:s'));
    }

    public function raffleWinners()
    {
        return $this->hasMany('Beeblebrox3\Chance\Models\RaffleWinner', 'raffle_id', 'id');
    }

    public function randomlySelect()
    {
        set_time_limit(0);

        if ($this->raffleWinners->count()) {
            foreach ($this->raffleWinners as $winner) {
                $winner->delete();
            }
        }

        // if number of participants <= number of allowed winners, all participants are winners
        $participants = $this->participants;
        $winners = array();
        if (count($participants) <= $this->winners) {
            // $winners = array_keys($participants);
            $winners = range(0, (count($participants) - 1));
        } else {
            $randomlyParticipants = $this->randomizer()->sequence(0, count($participants) - 1);
            $winners = array_slice($randomlyParticipants, 0, $this->winners);
        }

        foreach ($winners as $winner) {
            $winner = new RaffleWinner(array(
                'raffle_participant_id' => $participants[$winner]->id,
            ));
            $this->raffleWinners()->save($winner);
        }
    }

    protected function randomizer()
    {
        if (!$this->randomizer) {
            $ramdomizerUA = \Config::get('app.ramdomizerUA');
            $this->randomizer = new Randomizer($ramdomizerUA);
        }

        return $this->randomizer;
    }
}
