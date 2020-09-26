<?php

function autoloader() {
    $routerFilePath = './core/Router.php';
    include $routerFilePath;

    $controllerFilePaths = glob('./controllers/*Controller.php');
    foreach($controllerFilePaths as $path) {
        include $path;
    }
}

spl_autoload_register('autoloader');
