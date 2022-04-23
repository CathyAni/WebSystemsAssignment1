<?php

declare(strict_types=1);

namespace Women\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class NetworkHandlerFactory
{
    public function __invoke(ContainerInterface $container) : NetworkHandler
    {
        return new NetworkHandler($container->get(TemplateRendererInterface::class));
    }
}
