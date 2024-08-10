<?php

declare(strict_types=1);

require __DIR__ . "/../vendor/autoload.php";

use TinyCms\DTO\ContentFolder;
use TinyCms\Service\Content;
use TinyCms\Service\Renderer;
use TinyCms\Service\Router;

$contentFolder = new ContentFolder(__DIR__ . "/../data/");

// Content Mapping
$content = new Content($contentFolder);

// Routing
$router = new Router($_GET["url"], $contentFolder);
if (!$router->isFile() || $router->isFolder()) {
    http_response_code(404);
    die("not found");
}

// Rendering
try {
    $renderer = new Renderer($router, $contentFolder, $content);
    echo $renderer->render();
} catch (Exception $e) {
    http_response_code(500);
    die($e->getMessage());
}
