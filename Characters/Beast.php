<?php

namespace Characters;

class Beast extends Character {
    public string $name = 'Beast';

    private const MIN_HEALTH = 60;
    private const MAX_HEALTH = 90;

    private const MIN_STRENGTH = 60;
    private const MAX_STRENGTH = 90;

    private const MIN_DEFENCE = 40;
    private const MAX_DEFENCE = 60;

    private const MIN_SPEED = 40;
    private const MAX_SPEED = 60;

    private const MIN_LUCK = 25;
    private const MAX_LUCK = 40;

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