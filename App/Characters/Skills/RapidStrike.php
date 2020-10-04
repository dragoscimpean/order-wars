<?php

namespace App\Characters\Skills;

trait RapidStrike {
    protected int $rapidStrikeChance = 10;
    public bool $rapidStrikeInvoked = false;

    public function attack($target) {
        $inflictedDamage = parent::attack($target);

        if ($this->rapidStrikeChance < rand(0, 100)) {
            $this->rapidStrikeInvoked = false;
            return $inflictedDamage;
        }

        $this->rapidStrikeInvoked = true;
        return $inflictedDamage + parent::attack($target);
    }
}