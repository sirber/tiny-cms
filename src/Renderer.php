<?php

declare(strict_types=1);

namespace Sirber\TinyCms;

use Michelf\Markdown;

final readonly class Renderer
{
  public function __construct(
    private Router $router
  ) {
    $content = $router->getFileContent();
    $my_html = Markdown::defaultTransform($content);

    echo $my_html;
  }
}
