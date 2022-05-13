<?php

declare(strict_types=1);

namespace Training\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class GetAllPublishedTrainingHandlerFactory
{
    public function __invoke(ContainerInterface $container) : GetAllPublishedTrainingHandler
    {
        return new GetAllPublishedTrainingHandler($container->get(TemplateRendererInterface::class));
    }
}
