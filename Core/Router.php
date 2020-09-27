<?php

namespace Core;

use ReflectionMethod;
use ReflectionParameter;

class Router {
    public static function get(string $route,string  $action) {
        if (!self::isCorrectRoute($route)) {
            return false;
        }

        list ($controllerName, $method) = explode('@', $action);
        $controller = 'Controllers\\'.$controllerName;

        $parameters = self::instantiateObjectParameters($controller, $method);

        return (new $controller())->$method(...$parameters);
    }

    private static function isCorrectRoute($route) {
        return $route === $_SERVER['REQUEST_URI'];
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
