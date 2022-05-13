<?php

declare(strict_types=1);

namespace Training\Handler;

use Doctrine\ORM\EntityManager;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class RoomCourseActivityHandlerFactory
{
    public function __invoke(ContainerInterface $container): RoomCourseActivityHandler
    {
        return new RoomCourseActivityHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(EntityManager::class)
        );
    }
}
