<?php

declare(strict_types=1);

namespace Training\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class CountInProgressTrainingHandlerFactory
{
    public function __invoke(ContainerInterface $container) : CountInProgressTrainingHandler
    {
        return new CountInProgressTrainingHandler($container->get(TemplateRendererInterface::class));
    }
}
