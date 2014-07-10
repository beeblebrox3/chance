<?php

namespace Beeblebrox3\Chance\Controllers;

class Users extends AbstractController
{
    protected $model = '\Beeblebrox3\Chance\Models\User';

    public function login()
    {
        return \View::make('users.login');
    }

    public function attempt()
    {
        $credentials = \Input::only('email', 'password');
        if (\Auth::attempt($credentials)) {
            return \Redirect::intended(route('Home'));
        }

        \Sysfeedback::error(\Lang::get('messages.invalid_credentials'));
        return \Redirect::route('Auth.login')->withInput();
    }

    public function logout()
    {
        \Auth::logout();
        return \Redirect::route('Home');
    }
}
