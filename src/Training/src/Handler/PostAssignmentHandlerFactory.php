<?php

declare(strict_types=1);

namespace Training\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class PostAssignmentHandlerFactory
{
    public function __invoke(ContainerInterface $container) : PostAssignmentHandler
    {
        return new PostAssignmentHandler($container->get(TemplateRendererInterface::class));
    }
}
