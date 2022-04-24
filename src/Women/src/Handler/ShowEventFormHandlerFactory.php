<?php

declare(strict_types=1);

namespace Women\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class ShowEventFormHandlerFactory
{
    public function __invoke(ContainerInterface $container) : ShowEventFormHandler
    {
        return new ShowEventFormHandler($container->get(TemplateRendererInterface::class));
    }
}
