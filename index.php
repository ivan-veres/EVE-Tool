<?php

/**
 * file index.php
 * @author: Ivan Vereš
 */

require_once 'lib/Loader.php';

// Instantiate Router class
$route = new Router();

// Add routes (url, router#method)
$route->add('/', 'home#index');

$route->dispatch();