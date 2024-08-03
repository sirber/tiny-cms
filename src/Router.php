<?php

declare(strict_types=1);

namespace TinyCms;

final class Router
{
    private string $route;

    public function __construct(
        string $url,
        private readonly string $contentFolder
    ) {
        if (empty($url)) {
            $url = $_GET["url"];
        }

        $this->route = "routes/" . trim($url, "/");

        if ($this->isFolder()) {
            $this->route .= "/index";
        }
    }

    public function isFolder(): bool
    {
        return is_dir($this->contentFolder . $this->route);
    }

    public function isFile(): bool
    {
        return is_file($this->contentFolder . $this->getFileName());
    }

    public function getFileName(): string
    {
        return $this->route . ".twig";
    }
}
