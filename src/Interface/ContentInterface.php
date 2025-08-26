<?php

declare(strict_types=1);

namespace TinyCms\Interface;

interface ContentInterface
{
    /**
     * Get the content tree structure.
     *
     * @param ?string $directory
     * @return array{string | array{string}} | array{}
     */
    public function getContentTree(?string $directory = null): array;
}