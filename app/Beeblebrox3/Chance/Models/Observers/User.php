<?php

namespace Beeblebrox3\Chance\Models\Observers;

class User extends AbstractObserver
{
    protected $rules = array(
        'name' => 'required|max:140',
        'email' => 'required|email|max:120|unique:users',
        'password' => 'required|min:4|confirmed',
    );
}
