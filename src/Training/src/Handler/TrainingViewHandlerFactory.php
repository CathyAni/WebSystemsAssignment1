<?php

declare(strict_types=1);

namespace Training\Handler;

use Doctrine\ORM\EntityManager;
use Mezzio\Authentication\UserInterface;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class TrainingViewHandlerFactory
{
    public function __invoke(ContainerInterface $container) : TrainingViewHandler
    {
        return new TrainingViewHandler($container->get(TemplateRendererInterface::class), $container->get(EntityManager::class));
    }
}
