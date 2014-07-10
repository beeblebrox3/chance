<?php

namespace Beeblebrox3\Chance\Models\Observers;

class Raffle extends AbstractObserver
{
    protected $rules = [
        'name' => 'required|min:4|max:64',
        'slug' => 'required|alpha_dash|min:4|max:64|unique:raffles',
        'limit_date' => 'required|date_format:Y-m-d H:i',
        'winners' => 'required|integer|min:1',
        'author_id' => 'required|exists:users,id',
    ];
}
