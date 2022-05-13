<?php

declare(strict_types=1);

namespace Training\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class GetCourseHandlerFactory
{
    public function __invoke(ContainerInterface $container) : GetCourseHandler
    {
        return new GetCourseHandler($container->get(TemplateRendererInterface::class));
    }
}
