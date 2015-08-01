<?php

/**
 * file index.php
 * @author: Ivan Vereš
 */

define('BASE_PATH', dirname(dirname(__FILE__)) . '/');

define('BASE_URL', $_SERVER['HTTP_HOST']);

require_once BASE_PATH . '/Library/Loader.php';
require_once BASE_PATH . 'config.php';

// Instantiate Router class
$route = new Router();

// Add routes (url, router#method)
$route->add('/', 'home#index');
$route->add('/login', 'login#index');
$route->add('/login/submit', 'login#submit');
$route->add('/logout', 'login#logout');

$route->dispatch();