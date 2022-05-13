<?php

declare(strict_types=1);

namespace Training\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class CountTotalCourseHandlerFactory
{
    public function __invoke(ContainerInterface $container) : CountTotalCourseHandler
    {
        return new CountTotalCourseHandler($container->get(TemplateRendererInterface::class));
    }
}
