<?php

declare(strict_types=1);

namespace Training\Handler;

use Mezzio\Authentication\UserInterface;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class SubmitAssignmentStatusHandlerFactory
{
    public function __invoke(ContainerInterface $container): SubmitAssignmentStatusHandler
    {
        return new SubmitAssignmentStatusHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(UserInterface::class)
        );
    }
}
