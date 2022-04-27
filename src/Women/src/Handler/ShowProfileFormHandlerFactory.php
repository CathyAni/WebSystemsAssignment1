<?php

declare(strict_types=1);

namespace Women\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class ShowProfileFormHandlerFactory
{
    public function __invoke(ContainerInterface $container) : ShowProfileFormHandler
    {
        return new ShowProfileFormHandler($container->get(TemplateRendererInterface::class));
    }
}
