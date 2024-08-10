<?php

declare(strict_types=1);

namespace TinyCms\Service;

use TinyCms\DTO\ContentFolder;

final readonly class Renderer
{
    const string TWIG_CACHE_PATH = '/tmp';

    private \Twig\Environment $twig;

    public function __construct(
        private Router $router,
        private ContentFolder $contentFolder,
        private Content $content
    ) {
        $isDev = getenv("APP_ENV") === 'dev';
        $loader = new \Twig\Loader\FilesystemLoader($this->contentFolder);

        $options = [];
        if (!$isDev) {
            $options['cache'] = self::TWIG_CACHE_PATH;
        }

        $this->twig = new \Twig\Environment($loader, $options);
    }

    public function render(): string
    {
        $contentTree = $this->content->getContentTree();
        $fileName = $this->router->getTemplate();

        $data = [
            'currentFile' => $this->cleanRoute($fileName),
            'contentTree' => $contentTree,
        ];

        return $this->twig->render($fileName, $data);
    }

    private function cleanRoute(string $file): string
    {
        $pattern = '/routes\/|\.twig/';
        return preg_replace($pattern, '', basename($file));
    }
}