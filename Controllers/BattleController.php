<?php

namespace Controllers;

use Services\CharactersService;

class BattleController {
    public function start(CharactersService $charactersService) {
        list($orderus, $beast) = $charactersService->spawn();
        $attacker = $charactersService->getAttacker();

        http_response_code(200);
        echo json_encode([
            'orderus' => $orderus,
            'beast' => $beast,
            'attacker' => $attacker,
        ]);
    }

    public function test() {
        var_dump(new Beast());
        die();
    }
}
