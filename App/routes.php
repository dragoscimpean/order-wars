<?php

use App\Core\Router;

Router::get('/start', 'BattleController@start');
Router::post('/attack', 'CharacterController@attack');