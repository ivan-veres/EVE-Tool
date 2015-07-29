<?php

/**
 * file index.php
 * @author: Ivan Vereš
 */

define('BASE_PATH', dirname(dirname(__FILE__)) . '/');

require_once '../Library/Loader.php';

// Instantiate Router class
$route = new Router();

$db = new Database();

// Connect to the database
$db->connect(array(
    'host'      => DB_HOST,
    'dbname'    => 'database_name',
    'charset'   => 'utf8'
), DB_USER, DB_PASSWORD);

// Add routes (url, router#method)
$route->add('/', 'home#index');
$route->add('/login', 'login#index');
$route->add('/login/submit', 'login#submit');

$route->dispatch();