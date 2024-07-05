<?php

declare(strict_types=1);

namespace Sirber\TinyCms;

use Michelf\Markdown;

final readonly class Renderer
{
  public function __construct(
    private Router $router,
    private string $contentFolder,
    private Content $content
  ) {
  }

  public function render(): string
  {
    // Render layout
    $contentTree = $this->content->getContentTree();
    $layout = $this->getLayout($contentTree);

    // Render requested page
    $content = $this->getFileContent();
    $my_html = Markdown::defaultTransform($content);

    return $my_html;
  }

  private function getFileContent(): string
  {
    return file_get_contents($this->router->getFileName());
  }

  private function getLayout(array $contentTree): string
  {
    // TODO: 

    return "";
  }
}
