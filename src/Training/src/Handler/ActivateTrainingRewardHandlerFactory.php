<?php

declare(strict_types=1);

namespace Training\Handler;

use Doctrine\ORM\EntityManager;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Training\Service\YoutubeApiService;

class ActivateTrainingRewardHandlerFactory
{
    public function __invoke(ContainerInterface $container): ActivateTrainingRewardHandler
    {
        return new ActivateTrainingRewardHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(EntityManager::class),
            $container->get(YoutubeApiService::class)
        );
    }
}
