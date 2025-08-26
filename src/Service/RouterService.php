<?php

declare(strict_types=1);

namespace TinyCms\Service;

use TinyCms\DTO\ContentFolder;
use TinyCms\Interface\RouterInterface;

final readonly class RouterService implements RouterInterface
{
    private string $view;

    public function __construct(
        string $url,
        private ContentFolder $contentFolder
    ) {
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

    public function getFileName(): string
    {
        // TODO: move elsewhere
        return $this->view . ".twig";
    }
}
