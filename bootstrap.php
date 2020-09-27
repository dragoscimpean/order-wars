<?php

header("Access-Control-Allow-Origin: *");

spl_autoload_register(function ($class) {
    $file = './' . str_replace('\\', '/', $class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});