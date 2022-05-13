<?php

declare(strict_types=1);

namespace Training\Service;

use Doctrine\ORM\EntityManager;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class ClassRoomServiceFactory
{
    public function __invoke(ContainerInterface $container) : ClassRoomService
    {
        return new ClassRoomService($container->get(EntityManager::class));
    }
}
