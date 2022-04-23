<?php

declare(strict_types=1);

namespace Women\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class ViewEventHandlerFactory
{
    public function __invoke(ContainerInterface $container) : ViewEventHandler
    {
        return new ViewEventHandler($container->get(TemplateRendererInterface::class));
    }
}
