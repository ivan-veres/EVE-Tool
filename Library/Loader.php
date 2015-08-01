<?php


function __autoload($class)
{
    $dirs = array(
        'Routers/',
        'Library/',
        'Library/Login/',
        'Library/Database/',
        'Library/Session/',
        '',
    );

    foreach ($dirs as $dir) {

        if (file_exists(BASE_PATH . $dir . $class . '.php')) {
            require_once BASE_PATH . $dir . $class . '.php';
        }
    }
}