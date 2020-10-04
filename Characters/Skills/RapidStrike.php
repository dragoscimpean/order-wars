<?php

namespace Characters\Skills;

trait RapidStrike {
    private int $chance = 10;
    protected bool $invoked = false;

    public function attack($target) {
        $inflictedDamage = parent::attack($target);
        $inflictedDamage += $this->invoke($target);

        return $inflictedDamage;
    }

    public function invoke($target) {
        if ($this->chance > rand(0, 100)) {
            $this->invoked = true;
            return parent::attack($target);
        }

        return false;
    }
}