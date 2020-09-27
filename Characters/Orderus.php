<?php

namespace Characters;

use Services\ObjectService;

Class Orderus extends Character {
    public string $name = 'Orderus';

    protected array $statsThreshold = [
        'min_health' => 70,
        'max_health' => 100,
        'min_strength' => 70,
        'max_strength' => 80,
        'min_defence' => 45,
        'max_defence' => 55,
        'min_speed' => 40,
        'max_speed' => 50,
        'min_luck' => 10,
        'max_luck' => 30,
    ];
}