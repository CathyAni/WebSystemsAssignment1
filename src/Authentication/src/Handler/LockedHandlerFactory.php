<?php

declare(strict_types=1);

namespace Authentication\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class LockedHandlerFactory
{
    public function __invoke(ContainerInterface $container) : LockedHandler
    {
        return new LockedHandler($container->get(TemplateRendererInterface::class));
    }
}
