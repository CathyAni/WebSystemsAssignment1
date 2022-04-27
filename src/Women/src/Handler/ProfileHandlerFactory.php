<?php

declare(strict_types=1);

namespace Women\Handler;

use Doctrine\ORM\EntityManager;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class ProfileHandlerFactory
{
    public function __invoke(ContainerInterface $container) : ProfileHandler
    {
        return new ProfileHandler($container->get(TemplateRendererInterface::class), $container->get(EntityManager::class));
    }
}
