<?php

declare(strict_types=1);

namespace Training\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class TakenCoursesHandlerFactory
{
    public function __invoke(ContainerInterface $container) : TakenCoursesHandler
    {
        return new TakenCoursesHandler($container->get(TemplateRendererInterface::class));
    }
}
