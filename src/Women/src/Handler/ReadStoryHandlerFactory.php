<?php

declare(strict_types=1);

namespace Women\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class ReadStoryHandlerFactory
{
    public function __invoke(ContainerInterface $container) : ReadStoryHandler
    {
        return new ReadStoryHandler($container->get(TemplateRendererInterface::class));
    }
}
