<?php

declare(strict_types=1);

namespace Training\Handler;

use Doctrine\ORM\EntityManager;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class TrainingAllHandlerFactory
{
    public function __invoke(ContainerInterface $container) : TrainingAllHandler
    {
        return new TrainingAllHandler($container->get(TemplateRendererInterface::class), $container->get(EntityManager::class));
    }
}
