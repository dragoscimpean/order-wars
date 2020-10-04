<?php

namespace App\Controllers;

use App\Services\CharactersService;

class BattleController {
    public function start(CharactersService $charactersService) {
        list($orderus, $beast) = $charactersService->updateOrCreate();
        $attacker = $charactersService->getAttacker();

        http_response_code(200);
        echo json_encode([
            'orderus' => $orderus,
            'beast' => $beast,
            'attacker' => $attacker,
        ]);
    }
}
