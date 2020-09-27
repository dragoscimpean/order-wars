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
}