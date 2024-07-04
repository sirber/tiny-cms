<?php declare(strict_types=1);

require (__DIR__ . '/../vendor/autoload.php');

// TODO: routing
$route = explode('/', trim($_GET["url"], '/'));


var_dump($route);