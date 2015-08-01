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
$route->add('/login/forgot', 'login#forgot');
$route->add('/logout', 'login#logout');
$route->add('/about', 'about#index');
$route->add('/contact', 'contact#index');
$route->add('/admin', 'admin#index');
$route->add('/register', 'register#index');
$route->add('/register/submit', 'register#submit');
$route->add('/recover/password', 'recover#password');
$route->add('/recover/reset', 'recover#reset');

$route->dispatch();