<?php

/**
 * file index.php
 * @author: Ivan Vereš
 */

define('BASE_PATH', dirname(dirname(__FILE__)) . '/');

require_once BASE_PATH . '/Library/Loader.php';
require_once BASE_PATH . 'config.php';

// Instantiate Router class
$route = new Router();

// Add routes (url, router#method)
$route->add('/', 'home#index');

$route->dispatch();