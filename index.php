<?php

spl_autoload_register(function ($class) {
    $file = './' . str_replace('\\', '/', $class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

require __DIR__ . '/routes.php';
