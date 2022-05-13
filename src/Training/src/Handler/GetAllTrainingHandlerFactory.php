<?php

declare(strict_types=1);

namespace Training\Handler;

use Doctrine\ORM\EntityManager;
// use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class GetAllTrainingHandlerFactory
{
    public function __invoke(ContainerInterface $container): GetAllTrainingHandler
    {
        return new GetAllTrainingHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(EntityManager::class)
        );
    }
}
