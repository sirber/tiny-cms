<?php

declare(strict_types=1);

namespace TinyCms\Service;

use TinyCms\DTO\ContentFolder;

final readonly class Router
{
    private string $view;

    public function __construct(
        string $url,
        private ContentFolder $contentFolder
    ) {
        if (empty($url)) {
            $url = $_GET["url"] ?? '';
        }

        $view = $this->contentFolder->getViewsFolder() . trim($url, "/");

        if (is_dir($view)) {
            $view .= "/index";
        }

        $view = str_replace("//", "/", $view);

        $this->view = $view;
    }

    public function isFolder(): bool
    {
        return is_dir($this->view);
    }

    public function isFile(): bool
    {
        return is_file($this->getFileName());
    }

    public function getFileName(): string // TODO: move elsewhere
    {
        return $this->view . ".twig";
    }
}
