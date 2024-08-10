<?php

declare(strict_types=1);

namespace TinyCms\Service;

use TinyCms\DTO\ContentFolder;

final readonly class Content
{
    public function __construct(
        private ContentFolder $contentFolder
    ) {}

    /**
     * Summary of getContentTree
     *
     * @param ?string $directory
     * @return array{string | array{string}} | array{}
     */
    public function getContentTree(?string $directory = null): array
    {
        if (is_null($directory)) {
            $directory = $this->contentFolder->getViewsFolder();
        }

        $result = [];

        // Ensure the directory ends with a slash
        $directory = rtrim($directory, "/") . '/';

        // Get all files and directories
        $allItems = glob($directory . "*", GLOB_MARK);
        if (!is_array($allItems)) {
            return $result;
        }

        foreach ($allItems as $item) {
            if (is_dir($item)) {
                $subDirectory = basename($item);
                $result[$subDirectory] = $this->getContentTree($item);
            } elseif (
                is_file($item) &&
                pathinfo($item, PATHINFO_EXTENSION) === "twig"
            ) {
                $route = pathinfo($item, PATHINFO_FILENAME);
                if ($route == 'index') {
                    continue;
                }

                $result[] = str_replace($directory, "", $route);
            }
        }

        return $result;
    }
}
