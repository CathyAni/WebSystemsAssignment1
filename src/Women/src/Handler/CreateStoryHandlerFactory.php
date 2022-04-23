<?php

declare(strict_types=1);

namespace Women\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class CreateStoryHandlerFactory
{
    public function __invoke(ContainerInterface $container) : CreateStoryHandler
    {
        return new CreateStoryHandler($container->get(TemplateRendererInterface::class));
    }
}
