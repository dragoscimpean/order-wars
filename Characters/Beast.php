<?php

namespace Characters;

class Beast extends Character {
    const MIN_HEALTH = 60;
    const MAX_HEALTH = 90;

    const MIN_STRENGTH = 60;
    const MAX_STRENGTH = 90;

    const MIN_DEFENCE = 40;
    const MAX_DEFENCE = 60;

    const MIN_SPEED = 40;
    const MAX_SPEED = 60;

    const MIN_LUCK = 25;
    const MAX_LUCK = 40;

    public function __construct() {
        $this->spawn();
    }
}