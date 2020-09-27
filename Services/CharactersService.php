<?php

namespace Services;

use Characters\Beast;
use Characters\Orderus;

class CharactersService {
    private array $characters = [];

    public function spawn() {
        $this->characters = [new Orderus(), new Beast()];
        return $this->characters;
    }

    public function getAttacker() {
        $attacker = null;
        foreach ($this->characters as $character) {
            $attacker = $attacker ?? $character;
            $attacker = $character->speed > $attacker->speed ? $character : $attacker;
            if ($attacker->speed === $character->speed) {
                $attacker = $character->luck > $attacker->luck ? $character : $attacker;
            }
        }

        return $attacker->name;
    }

    public function updateCharactersStats($player, $enemy) {
        return [new Orderus($player), new Beast($enemy)];
    }
}