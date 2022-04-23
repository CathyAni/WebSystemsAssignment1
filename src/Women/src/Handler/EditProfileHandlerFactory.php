<?php

declare(strict_types=1);

namespace Women\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class EditProfileHandlerFactory
{
    public function __invoke(ContainerInterface $container) : EditProfileHandler
    {
        return new EditProfileHandler($container->get(TemplateRendererInterface::class));
    }
}
