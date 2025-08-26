<?php

declare(strict_types=1);

namespace TinyCms\Interface;

interface RouterInterface
{
    /**
     * Check if the current route is a folder.
     *
     * @return bool
     */
    public function isFolder(): bool;

    /**
     * Check if the current route is a file.
     *
     * @return bool
     */
    public function isFile(): bool;

    /**
     * Get the filename for the current route.
     *
     * @return string
     */
    public function getFileName(): string;
}
