<?php

declare(strict_types=1);

namespace Women\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class ShowStoryFormHandlerFactory
{
    public function __invoke(ContainerInterface $container) : ShowStoryFormHandler
    {
        return new ShowStoryFormHandler($container->get(TemplateRendererInterface::class));
    }
}
