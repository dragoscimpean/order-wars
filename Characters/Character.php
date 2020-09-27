<?php

namespace Characters;

use Services\ObjectService;

class Character {
    public function __construct($properties = null) {
        $this->spawn();
        ObjectService::syncProperties($this, $properties);
    }

    protected function spawn() {
        $this->health = rand($this->statsThreshold['min_health'], $this->statsThreshold['max_health']);
        $this->strength = rand($this->statsThreshold['min_strength'], $this->statsThreshold['max_strength']);
        $this->defence = rand($this->statsThreshold['min_defence'], $this->statsThreshold['max_defence']);
        $this->speed = rand($this->statsThreshold['min_speed'], $this->statsThreshold['max_speed']);
        $this->luck = rand($this->statsThreshold['min_luck'], $this->statsThreshold['max_luck']);
    }

    public function attack($target) {
        $inflictedDamage = $this->strength > $target->defence ? $this->strength - $target->defence : 0;
        $target->health -= $inflictedDamage;
        return $inflictedDamage;
    }
}