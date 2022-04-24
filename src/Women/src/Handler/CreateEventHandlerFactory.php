<?php

declare(strict_types=1);

namespace Women\Handler;

use Doctrine\ORM\EntityManager;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class CreateEventHandlerFactory
{
    public function __invoke(ContainerInterface $container): CreateEventHandler
    {
        return new CreateEventHandler($container->get(TemplateRendererInterface::class), $container->get(EntityManager::class));
    }
}
