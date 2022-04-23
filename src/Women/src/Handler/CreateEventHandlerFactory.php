<?php

declare(strict_types=1);

namespace Women\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class CreateEventHandlerFactory
{
    public function __invoke(ContainerInterface $container) : CreateEventHandler
    {
        return new CreateEventHandler($container->get(TemplateRendererInterface::class));
    }
}
