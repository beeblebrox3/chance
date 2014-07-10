<?php

$observers = [
    'User',
    'Raffle',
    'RaffleParticipant',
    'RaffleWinner',
];

$ns = "Beeblebrox3\\Chance\\Models\\";
foreach ($observers as $observer) {
    $model = $ns . $observer;
    $observer = $ns . 'Observers\\' . $observer;

    $model::observe(new $observer(App::make('validator')));
}