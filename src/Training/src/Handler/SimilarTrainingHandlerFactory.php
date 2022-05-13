<?php

declare(strict_types=1);

namespace Training\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class SimilarTrainingHandlerFactory
{
    public function __invoke(ContainerInterface $container) : SimilarTrainingHandler
    {
        return new SimilarTrainingHandler($container->get(TemplateRendererInterface::class));
    }
}
