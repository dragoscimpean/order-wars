<?php

namespace Characters\Skills;

trait RapidStrike {
    protected int $rapidStrikeChance = 50;
    public bool $rapidStrikeInvoked = false;

    public function attack($target) {
        $inflictedDamage = parent::attack($target);

        if ($this->rapidStrikeChance < rand(0, 100)) {
            $this->rapidStrikeInvoked = false;
            return $inflictedDamage;
        }

        $this->rapidStrikeInvoked = true;
        $inflictedDamage += parent::attack($target);

        return $inflictedDamage;
    }
}