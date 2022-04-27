<?php

declare(strict_types=1);

namespace Women\Handler;

use Doctrine\ORM\EntityManager;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class CreateStoryHandlerFactory
{
    public function __invoke(ContainerInterface $container): CreateStoryHandler
    {
        return new CreateStoryHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(EntityManager::class)
        );
    }
}
