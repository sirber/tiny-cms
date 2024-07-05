<?php

declare(strict_types=1);

require(__DIR__ . '/../vendor/autoload.php');

use Sirber\TinyCms\Renderer;
use Sirber\TinyCms\Router;

// Routing
$router = new Router();
if (!$router->isFile() || $router->isFolder()) {
  http_response_code(404);
  die("not found");
}

// Rendering
$renderer = new Renderer($router);
