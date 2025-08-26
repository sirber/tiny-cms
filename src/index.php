<?php

declare(strict_types=1);

require __DIR__ . "/../vendor/autoload.php";

use TinyCms\DTO\ContentFolder;
use TinyCms\Service\ContentService;
use TinyCms\Service\RendererService;
use TinyCms\Service\RouterService;

$contentFolder = new ContentFolder(__DIR__ . "/../data/");

// Content Mapping
$content = new ContentService($contentFolder);

// Routing
$url = "";
if (isset($_GET["url"]) && is_scalar($_GET["url"])) {
    $url = (string) $_GET["url"];
}

$router = new RouterService($url, $contentFolder);
if (!$router->isFile() || $router->isFolder()) {
    http_response_code(404);
    die("not found");
}

// Rendering
try {
    $renderer = new RendererService($router, $contentFolder, $content);
    echo $renderer->render();
} catch (Exception $e) {
    http_response_code(500);
    die($e->getMessage());
}
