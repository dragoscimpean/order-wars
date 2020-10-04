<?php

namespace App\Controllers;

use App\Core\Request;
use App\Services\CharactersService;

class CharacterController {
    public function attack(Request $request, CharactersService $charactersService) {
        list ($player, $enemy) = $charactersService->updateOrCreate($request->player, $request->enemy);
        $attacker = $charactersService->getAttacker($request->attacker);
        $inflictedDamage = $charactersService->getInflictedDamage($request->attacker, $player, $enemy);

        http_response_code(200);
        echo json_encode([
            'player' => $player,
            'enemy' => $enemy,
            'inflictedDamage' => $inflictedDamage,
            'attacker' => $attacker,
        ]);
    }
}
