<?php

declare(strict_types=1);

namespace TinyCms\Interface;

interface RendererInterface
{
    /**
     * Render the current template and return the result as a string.
     *
     * @return string
     */
    public function render(): string;
}
