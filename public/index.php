<?php

declare(strict_types=1);

require(__DIR__ . '/../vendor/autoload.php');

use Sirber\TinyCms\Content;
use Sirber\TinyCms\Renderer;
use Sirber\TinyCms\Router;

$contentFolder = __DIR__ . "/../content/";

// Routing
$router = new Router($_GET["url"], $contentFolder);
if (!$router->isFile() || $router->isFolder()) {
  http_response_code(404);
  die("not found");
}

// Content Mapping
$content = new Content($contentFolder);
var_dump($content->getContentTree());

// Rendering
try {
  $renderer = new Renderer($router, $contentFolder, $content);
  echo $renderer->render();
} catch (Exception $e) {
  http_response_code(500);
  die($e->getMessage());
}
