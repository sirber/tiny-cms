<?php

declare(strict_types=1);

namespace TinyCms\Service;

use TinyCms\DTO\ContentFolder;
use TinyCms\Interface\ContentInterface;
use TinyCms\Interface\RendererInterface;
use TinyCms\Interface\RouterInterface;

final readonly class RendererService implements RendererInterface
{
    public const string TWIG_CACHE_PATH = '/tmp';

    private \Twig\Environment $twig;

    public function __construct(
        private RouterInterface $router,
        private ContentFolder $contentFolder,
        private ContentInterface $content
    ) {
        $isDev = getenv("APP_ENV") === 'dev';
        $loader = new \Twig\Loader\FilesystemLoader((string)$this->contentFolder);

        $options = [];
        if (!$isDev) {
            $options['cache'] = self::TWIG_CACHE_PATH;
        }

        $this->twig = new \Twig\Environment($loader, $options);
    }

    public function render(): string
    {
        $fileName = $this->getTemplate();

        $data = [
            'currentFile' => $this->cleanRoute($fileName),
            'contentTree' => $this->content->getContentTree(),
        ];

        return $this->twig->render($fileName, $data);
    }

    private function cleanRoute(string $file): string|null
    {
        $pattern = '/routes\/|\.twig/';
        return preg_replace($pattern, '', basename($file));
    }

    private function getTemplate(): string
    {
        return str_replace($this->contentFolder->getContentFolder(), '', $this->router->getFileName());
    }
}
