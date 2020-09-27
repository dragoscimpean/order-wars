<?php

namespace Core;

class Router {
    public static function get($route, $action) {
        if (!self::isCorrectRoute($route)) {
            return false;
        }

        list ($controllerName, $method) = explode('@', $action);
        $controller = 'Controllers\\'.$controllerName;
        return (new $controller)->$method();
    }

    protected static function isCorrectRoute($route) {
        return $route === $_SERVER['REQUEST_URI'];
    }
}
