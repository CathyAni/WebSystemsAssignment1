<?php

declare(strict_types=1);

namespace Training\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class EnrollsHandlerFactory
{
    public function __invoke(ContainerInterface $container) : EnrollsHandler
    {
        return new EnrollsHandler($container->get(TemplateRendererInterface::class));
    }
}
