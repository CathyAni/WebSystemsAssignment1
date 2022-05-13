<?php

declare(strict_types=1);

namespace Training\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class CountTotalProgramemHandlerFactory
{
    public function __invoke(ContainerInterface $container) : CountTotalProgramemHandler
    {
        return new CountTotalProgramemHandler($container->get(TemplateRendererInterface::class));
    }
}
