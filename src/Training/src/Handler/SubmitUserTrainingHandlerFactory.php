<?php

declare(strict_types=1);

namespace Training\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class SubmitUserTrainingHandlerFactory
{
    public function __invoke(ContainerInterface $container) : SubmitUserTrainingHandler
    {
        return new SubmitUserTrainingHandler($container->get(TemplateRendererInterface::class));
    }
}
