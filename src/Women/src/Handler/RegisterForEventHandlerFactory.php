<?php

declare(strict_types=1);

namespace Women\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class RegisterForEventHandlerFactory
{
    public function __invoke(ContainerInterface $container) : RegisterForEventHandler
    {
        return new RegisterForEventHandler($container->get(TemplateRendererInterface::class));
    }
}
