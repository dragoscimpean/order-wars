<?php

namespace Characters\Skills;

trait MagicShield {
    protected int $magicShieldChance = 20;
    public bool $magicShieldInvoked = false;

    public function takeDamage($attacker) {
        $damageTaken = $attacker->strength > $this->defence ? $attacker->strength - $this->defence : 0;

        $this->magicShieldInvoked = false;
        if ($this->magicShieldChance >= rand(0, 100)) {
            $damageTaken = $damageTaken / 2;
            $this->magicShieldInvoked = true;
        }

        $this->health = $this->health > $damageTaken ? ($this->health - $damageTaken) : 0;

        return $damageTaken;
    }
}