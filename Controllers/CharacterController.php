<?php

namespace Controllers;

use Core\Request;
use Services\CharactersService;

class CharacterController {
    public function attack(Request $request, CharactersService $charactersService) {
        list ($player, $enemy) = $charactersService->updateCharactersStats($request->player, $request->enemy);
        $attacker = $request->attacker === $player->name ? $enemy->name : $player->name;
        $inflictedDamage = $request->attacker === $player->name ? $player->attack($enemy) : $enemy->attack($player);

        http_response_code(200);
        echo json_encode([
            'player' => $player,
            'enemy' => $enemy,
            'inflictedDamage' => $inflictedDamage,
            'attacker' => $attacker,
        ]);
    }
}
