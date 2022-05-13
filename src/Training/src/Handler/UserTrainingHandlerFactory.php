<?php

declare(strict_types=1);

namespace Training\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class UserTrainingHandlerFactory
{
    public function __invoke(ContainerInterface $container) : UserTrainingHandler
    {
        return new UserTrainingHandler($container->get(TemplateRendererInterface::class));
    }
}
