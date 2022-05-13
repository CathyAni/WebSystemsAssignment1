<?php

declare(strict_types=1);

namespace Training\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class ViewMilestoneResourceHandlerFactory
{
    public function __invoke(ContainerInterface $container) : ViewMilestoneResourceHandler
    {
        return new ViewMilestoneResourceHandler($container->get(TemplateRendererInterface::class));
    }
}
