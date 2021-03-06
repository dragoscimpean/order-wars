<?php

namespace App\Characters;

class Beast extends Character {
    public string $name = 'Beast';

    public function __construct($properties = null)
    {
        $this->init($this, $properties);
    }

    protected array $statsThreshold = [
        'min_health' => 60,
        'max_health' => 90,
        'min_strength' => 60,
        'max_strength' => 90,
        'min_defence' => 40,
        'max_defence' => 60,
        'min_speed' => 40,
        'max_speed' => 60,
        'min_luck' => 25,
        'max_luck' => 40,
    ];
}