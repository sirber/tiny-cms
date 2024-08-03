<?php

declare(strict_types=1);

namespace TinyCms;

final readonly class Renderer
{
    private \Twig\Environment $twig;

    public function __construct(
        private Router $router,
        private string $contentFolder,
        private Content $content
    ) {
        $isDev = getenv("APP_ENV") === 'dev';
        $loader = new \Twig\Loader\FilesystemLoader($this->contentFolder);

        $options = [];
        if (!$isDev) {
            $options['cache'] = '/tmp';
        }

        $this->twig = new \Twig\Environment($loader, $options);
    }

    public function render(): string
    {
        $contentTree = $this->content->getContentTree();
        $fileName = $this->router->getFileName();

        $options = [
            'currentFile' => null, // FIXME: be fileName without extension
            'contentTree' => $contentTree,
        ];

        return $this->twig->render($fileName, $options);
    }
}
