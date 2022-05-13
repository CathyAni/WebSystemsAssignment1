<?php

declare(strict_types=1);

namespace Training\Handler;

use Doctrine\ORM\EntityManager;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class ActivateCourseCountHandlerFactory
{
    public function __invoke(ContainerInterface $container) : ActivateCourseCountHandler
    {
        return new ActivateCourseCountHandler($container->get(TemplateRendererInterface::class), $container->get(EntityManager::class));
    }
}
