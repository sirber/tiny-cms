<?php

declare(strict_types=1);

namespace TinyCms\Service;

use TinyCms\DTO\ContentFolder;

final class Router
{
    private string $view;

    public function __construct(
        readonly string $url,
        private readonly ContentFolder $contentFolder
    ) {
        if (empty($url)) {
            $url = $_GET["url"] ?? '';
        }

        $this->view = $this->contentFolder->getViewsFolder() . trim($url, "/");

        if ($this->isFolder()) {
            $this->view .= "/index";
        }

        $this->view = str_replace("//", "/", $this->view);
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

    public function getTemplate(): string // TODO: move elsewhere
    {
        return str_replace($this->contentFolder->getContentFolder(), '', $this->getFileName());
    }
}
