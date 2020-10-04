<?php

namespace App\Characters;

use App\Services\ObjectService;

class Character {
    protected array $statsThreshold = [
        'min_health' => 0,
        'max_health' => 100,
        'min_strength' => 0,
        'max_strength' => 100,
        'min_defence' => 0,
        'max_defence' => 100,
        'min_speed' => 0,
        'max_speed' => 100,
        'min_luck' => 0,
        'max_luck' => 100,
    ];

    public int $health;
    public int $strength;
    public int $defence;
    public int $speed;
    public int $luck;

    public function spawn() {
        $this->health = rand($this->statsThreshold['min_health'], $this->statsThreshold['max_health']);
        $this->strength = rand($this->statsThreshold['min_strength'], $this->statsThreshold['max_strength']);
        $this->defence = rand($this->statsThreshold['min_defence'], $this->statsThreshold['max_defence']);
        $this->speed = rand($this->statsThreshold['min_speed'], $this->statsThreshold['max_speed']);
        $this->luck = rand($this->statsThreshold['min_luck'], $this->statsThreshold['max_luck']);
    }

    public function attack($target) {
        return $target->takeDamage($this);
    }

    public function takeDamage($attacker) {
        $damageTaken = $attacker->strength > $this->defence ? $attacker->strength - $this->defence : 0;
        $this->health = $this->health > $damageTaken ? ($this->health - $damageTaken) : 0;

        return $damageTaken;
    }

    protected function init($character, $properties = null) {
        if ($properties) {
            return ObjectService::syncProperties($character, $properties);
        }
        $character->spawn();
    }
}