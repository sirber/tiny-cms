<?php

declare(strict_types=1);

namespace TinyCms;

final class Router
{
    private string $view;

    public function __construct(
        string $url,
        private readonly string $contentFolder
    ) {
        if (empty($url)) {
            $url = $_GET["url"];
        }

        $this->view = "views/" . trim($url, "/");

        if ($this->isFolder()) {
            $this->view .= "/index";
        }
    }

    public function isFolder(): bool
    {
        return is_dir($this->contentFolder . $this->view);
    }

    public function isFile(): bool
    {
        return is_file($this->contentFolder . $this->getFileName());
    }

    public function getFileName(): string
    {
        return $this->view . ".twig";
    }
}
