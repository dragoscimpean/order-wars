<?php

namespace App\Services;

use App\Characters\Beast;
use App\Characters\Orderus;

class ObjectService {
    public static function syncProperties($object, $properties) {
        foreach ($properties as $property => $value) {
            $object->$property = $value;
        }

        return $object;
    }
}