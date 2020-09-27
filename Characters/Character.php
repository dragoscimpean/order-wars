<?php

namespace Characters;

class Character {
    public int $health;
    public int $strength;
    public int $defence;
    public int $speed;
    public int $luck;

    const MIN_HEALTH = 0;
    const MAX_HEALTH = 100;

    const MIN_STRENGTH = 0;
    const MAX_STRENGTH = 100;

    const MIN_DEFENCE = 0;
    const MAX_DEFENCE = 100;

    const MIN_SPEED = 0;
    const MAX_SPEED = 100;

    const MIN_LUCK = 0;
    const MAX_LUCK = 100;

    protected function spawn() {
        $this->health = rand(self::MIN_HEALTH, self::MAX_HEALTH);
        $this->strength = rand(self::MIN_STRENGTH, self::MAX_STRENGTH);
        $this->defence = rand(self::MIN_DEFENCE, self::MAX_DEFENCE);
        $this->speed = rand(self::MIN_SPEED, self::MAX_SPEED);
        $this->luck = rand(self::MIN_LUCK, self::MAX_LUCK);
    }
}