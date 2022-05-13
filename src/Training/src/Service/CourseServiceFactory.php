<?php

declare(strict_types=1);

namespace Training\Service;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class CourseServiceFactory
{
    public function __invoke(ContainerInterface $container) : CourseService
    {
        return new CourseService($container->get(TemplateRendererInterface::class));
    }
}
