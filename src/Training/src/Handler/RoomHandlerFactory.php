<?php

declare(strict_types=1);

namespace Training\Handler;

use Doctrine\ORM\EntityManager;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Training\Service\ClassRoomService;

class RoomHandlerFactory
{
    public function __invoke(ContainerInterface $container): RoomHandler
    {
        return new RoomHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(EntityManager::class),
            $container->get(ClassRoomService::class)
        );
    }
}
