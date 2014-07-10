<?php

Route::pattern('id', '[0-9]+');
Route::pattern('participant_id', '[0-9]+');
Route::pattern('slug', '[a-z0-9-]+');

$np = 'Beeblebrox3\\Chance\\Controllers\\';

Route::group(array('before' => 'auth'), function () use ($np) {
    Route::get('/', array('as' => 'Home', function () {
        return Redirect::route('Raffles');
    }));

    Route::get('sorteios', array(
        'as' => 'Raffles',
        'uses' => $np . 'Raffles@index',
    ));
    Route::get('sorteios/novo', array(
        'as' => 'Raffles.create',
        'uses' => $np . 'Raffles@create',
    ));
    Route::post('sorteios', array(
        'as' => 'Raffles.store',
        'uses' => $np . 'Raffles@store',
    ));
    Route::get('sorteios/{id}', array(
        'as' => 'Raffles.show',
        'uses' => $np . 'Raffles@show',
    ));
    Route::put('sorteios/{id}', array(
        'as' => 'Raffles.update',
        'uses' => $np . 'Raffles@update',
    ));
    Route::delete('sorteios/{id}', array(
        'as' => 'Raffles.destroy',
        'uses' => $np . 'Raffles@destroy',
    ));
    Route::delete('sorteios/{id}/unjoin/{participant_id}', array(
        'as' => 'Raffles.unjoin',
        'uses' => $np . 'Raffles@unjoin',
    ));
    Route::post('sorteios/{id}/sortear', array(
        'as' => 'Raffles.randomlySelect',
        'uses' => $np . 'Raffles@randomlySelect',
    ));
    Route::put('sorteios/{id}/resortear', array(
        'as' => 'Raffles.redoRandomlySelect',
        'uses' => $np . 'Raffles@randomlySelect',
    ));
    Route::get('sorteios/{id}/editar', array(
        'as' => 'Raffles.edit',
        'uses' => $np . 'Raffles@edit',
    ));
});

Route::get('login', array(
    'as' => 'Auth.login',
    'uses' => $np . 'Users@login',
));

Route::post('login', array(
    'as' => 'Auth.attempt',
    'uses' => $np . 'Users@attempt',
));

Route::get('logout', array(
    'as' => 'Auth.logout',
    'uses' => $np . 'Users@logout',
));

Route::get('sorteios/{slug}/participar', array(
    'as' => 'Raffles.join',
    'uses' => $np . 'Raffles@getJoin',
));

Route::post('sorteios/{slug}/participar', array(
    'as' => 'Raffles.doJoin',
    'uses' => $np . 'Raffles@postJoin',
));
