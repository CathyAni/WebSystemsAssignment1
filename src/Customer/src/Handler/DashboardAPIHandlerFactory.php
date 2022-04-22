<?php

declare(strict_types=1);

namespace Customer\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class DashboardAPIHandlerFactory
{
    public function __invoke(ContainerInterface $container) : DashboardAPIHandler
    {
        return new DashboardAPIHandler($container->get(TemplateRendererInterface::class));
    }
}
