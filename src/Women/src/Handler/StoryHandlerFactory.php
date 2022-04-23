<?php

declare(strict_types=1);

namespace Women\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class StoryHandlerFactory
{
    public function __invoke(ContainerInterface $container) : StoryHandler
    {
        return new StoryHandler($container->get(TemplateRendererInterface::class));
    }
}
