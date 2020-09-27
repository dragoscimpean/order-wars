<?php

namespace Services;

use Characters\Beast;
use Characters\Orderus;

class ObjectService {
    public static function syncProperties($object, $properties) {
        foreach ($properties as $property => $value) {
            $object->$property = $value;
        }
    }
}