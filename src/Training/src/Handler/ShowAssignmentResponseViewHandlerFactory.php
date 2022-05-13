<?php

declare(strict_types=1);

namespace Training\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class ShowAssignmentResponseViewHandlerFactory
{
    public function __invoke(ContainerInterface $container) : ShowAssignmentResponseViewHandler
    {
        return new ShowAssignmentResponseViewHandler($container->get(TemplateRendererInterface::class));
    }
}
