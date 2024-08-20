<?php

declare(strict_types=1);

namespace TinyCms\DTO;

readonly class ContentFolder
{
    public function __construct(private string $contentFolder)
    {
    }

    public function getContentFolder(): string
    {
        return $this->contentFolder;
    }

    public function __toString(): string
    {
        return $this->contentFolder;
    }

    public function getViewsFolder(): string
    {
        return $this->contentFolder . "user_content/views/";
    }

    public function getStaticFilesFolder(): string
    {
        return $this->contentFolder . "user_content/static/";
    }
}
