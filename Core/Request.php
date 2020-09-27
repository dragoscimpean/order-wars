<?php

namespace Core;

class Request {
    public function __construct() {
        $entityBody = json_decode(file_get_contents('php://input'));

        foreach (get_object_vars($entityBody) as $property => $value) {
            $this->$property = $value;
        }
    }
}
