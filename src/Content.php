<?php declare(strict_types=1);

namespace TinyCms;

final readonly class Content
{
    public function __construct(private string $contentFolder)
    {
    }

    /**
     * Summary of getContentTree
     * 
     * @param ?string $directory
     * @return array{string | array{string}} | array{}
     */
    public function getContentTree(?string $directory = null): array
    {
        if (empty($directory)) {
            $directory = $this->contentFolder;
        }

        $result = [];

        // Ensure the directory ends with a slash
        $directory = rtrim($directory, "/") . "/";

        // Get all files and directories
        $allItems = glob($directory . "*", GLOB_MARK);
        if (!is_array($allItems)) {
            return $result;
        }

        foreach ($allItems as $item) {
            if (basename($item[0]) === '_') {
                continue;
            }

            if (is_dir($item)) {
                // Recursively scan subdirectories
                $subDirectory = basename($item);
                $result[$subDirectory] = $this->getContentTree($item);
            } elseif (
                is_file($item) &&
                pathinfo($item, PATHINFO_EXTENSION) === "twig"
            ) {
                $result[] = str_replace($directory, "", $item);
            }
        }

        return $result;
    }
}
