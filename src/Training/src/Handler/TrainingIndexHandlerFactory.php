<?php

declare(strict_types=1);

namespace Training\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class TrainingIndexHandlerFactory
{
    public function __invoke(ContainerInterface $container) : TrainingIndexHandler
    {
        return new TrainingIndexHandler($container->get(TemplateRendererInterface::class));
    }
}
