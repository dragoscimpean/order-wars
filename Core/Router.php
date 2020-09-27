<?php

namespace Core;

use ReflectionMethod;
use ReflectionParameter;

class Router {
    public static function get(string $route, string $action) {
        self::request($route, $action, 'GET');
    }

    public static function post(string $route, string $action) {
        self::request($route, $action, 'POST');
    }

    public static function request(string $route,string  $action, string $method) {
        if (!self::isCorrectRoute($route, $method)) {
            return false;
        }

        list ($controllerName, $method) = explode('@', $action);
        $controller = 'Controllers\\'.$controllerName;

        $parameters = self::instantiateObjectParameters($controller, $method);

        return (new $controller())->$method(...$parameters);
    }

    private static function isCorrectRoute(string $route, string $method) {
        return $route === $_SERVER['REQUEST_URI'] && $_SERVER['REQUEST_METHOD'] === $method;
    }

    protected static function instantiateObjectParameters(string $controller, string $method): array
    {
        $rm = new ReflectionMethod($controller, $method);
        $parameters = [];
        foreach ($rm->getParameters() as $index => $parameter) {
            $rp = new ReflectionParameter([$controller, $method], $index);

            if (is_object($rp->getType())) {
                $class = $rp->getClass()->name;

                $parameters[] = new $class();
                continue;
            }

            $parameters[] = $parameter;
        }

        return $parameters;
    }
}
