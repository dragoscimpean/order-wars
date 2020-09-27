<?php

namespace Characters;

Class Orderus extends Character {
    private const MIN_HEALTH = 70;
    private const MAX_HEALTH = 100;

    private const MIN_STRENGTH = 70;
    private const MAX_STRENGTH = 80;

    private const MIN_DEFENCE = 45;
    private const MAX_DEFENCE = 55;

    private const MIN_SPEED = 40;
    private const MAX_SPEED = 50;

    private const MIN_LUCK = 10;
    private const MAX_LUCK = 30;

    public function __construct() {
        $this->spawn();
    }

    protected function spawn() {
        $this->health = rand(self::MIN_HEALTH, self::MAX_HEALTH);
        $this->strength = rand(self::MIN_STRENGTH, self::MAX_STRENGTH);
        $this->defence = rand(self::MIN_DEFENCE, self::MAX_DEFENCE);
        $this->speed = rand(self::MIN_SPEED, self::MAX_SPEED);
        $this->luck = rand(self::MIN_LUCK, self::MAX_LUCK);
    }
}