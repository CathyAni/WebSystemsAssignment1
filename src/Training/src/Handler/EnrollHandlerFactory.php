<?php

declare(strict_types=1);

namespace Training\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Training\Service\ClassRoomService;

class EnrollHandlerFactory
{
    public function __invoke(ContainerInterface $container): EnrollHandler
    {
        return new EnrollHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(EntityManager::class),
            $container->get(ClassRoomService::class)
        );
    }
}
