<?php

declare(strict_types=1);

namespace Sirber\TinyCms;

use Error;

final class Router
{
  private string $route;
  private const string CONTENT_FOLDER = __DIR__ . "/../content/";

  public function __construct(
    ?string $url = null,
  ) {
    if (empty($url)) {
      $url = $_GET["url"];
    }

    $this->route = trim($url, '/');

    if ($this->isFolder()) {
      $this->route .= "index";
    }
  }

  public function isFolder(): bool
  {
    return is_dir(self::CONTENT_FOLDER . $this->route);
  }

  public function isFile(): bool
  {
    return is_file($this->getFileName());
  }

  public function getFileContent(): string
  {
    if (!$this->isFile()) {
      throw new Error("route is not a file");
    }

    return file_get_contents($this->getFileName());
  }

  private function getFileName(): string
  {
    return self::CONTENT_FOLDER . $this->route . '.md';
  }
}
