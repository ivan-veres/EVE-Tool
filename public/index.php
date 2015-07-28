<?php

/**
 * file index.php
 * @author: Ivan Vereš
 */

define('BASE_PATH', dirname(dirname(__FILE__)) . '/');

require_once '../Library/Loader.php';

// Instantiate Router class
$route = new Router();

// Add routes (url, router#method)
$route->add('/', 'home#index');
$route->add('/login', 'login#index');
$route->add('/login/submit', 'login#submit');

$route->dispatch();