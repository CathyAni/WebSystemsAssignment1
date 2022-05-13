<?php

declare(strict_types=1);

namespace Training\Service;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class ProgrammesServiceFactory
{
    public function __invoke(ContainerInterface $container) : ProgrammesService
    {
        return new ProgrammesService($container->get(TemplateRendererInterface::class));
    }
}
