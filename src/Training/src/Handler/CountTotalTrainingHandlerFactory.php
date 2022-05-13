<?php

declare(strict_types=1);

namespace Training\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class CountTotalTrainingHandlerFactory
{
    public function __invoke(ContainerInterface $container) : CountTotalTrainingHandler
    {
        return new CountTotalTrainingHandler($container->get(TemplateRendererInterface::class));
    }
}
