<?php

declare(strict_types=1);

namespace Training\Handler;

use Doctrine\ORM\EntityManager;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class TrainingRewardHandlerFactory
{
    public function __invoke(ContainerInterface $container) : TrainingRewardHandler
    {
        return new TrainingRewardHandler($container->get(TemplateRendererInterface::class), $container->get(EntityManager::class));
    }
}
