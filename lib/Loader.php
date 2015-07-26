<?php


function __autoload($class)
{
    $dirs = array(
        'Routers/',
        'lib/',
    );

    foreach ($dirs as $dir) {
        if (file_exists($dir . $class . '.php')) {
            require_once $dir . $class . '.php';
        } else {
            require_once 'Interface.php';
        }
    }
}
