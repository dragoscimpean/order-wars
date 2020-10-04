<?php

namespace App\Services;

use App\Characters\Beast;
use App\Characters\Orderus;

class CharactersService {
    private Orderus $player;
    private Beast $enemy;

    public function updateOrCreate($player = null, $enemy = null) {
        $this->player = new Orderus($player);
        $this->enemy = new Beast($enemy);
        return [$this->player, $this->enemy];
    }

    public function getAttacker($lastAttacker = null) {
        if ($lastAttacker) {
            return $lastAttacker === $this->player->name ? $this->enemy->name : $this->player->name;
        }

        $characters = [$this->player, $this->enemy];
        $attacker = null;
        foreach ($characters as $character) {
            $attacker = $attacker ?? $character;
            $attacker = $character->speed > $attacker->speed ? $character : $attacker;
            if ($attacker->speed === $character->speed) {
                $attacker = $character->luck > $attacker->luck ? $character : $attacker;
            }
        }

        return $attacker->name;
    }

    public function getInflictedDamage($attacker, $player, $enemy)
    {
        return $attacker === $player->name ? $player->attack($enemy) : $enemy->attack($player);
    }
}