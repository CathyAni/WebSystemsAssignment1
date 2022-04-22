<?php

declare(strict_types=1);

namespace Authentication\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class CreateUserApiHandlerFactory
{
    public function __invoke(ContainerInterface $container) : CreateUserApiHandler
    {
        return new CreateUserApiHandler($container->get(TemplateRendererInterface::class));
    }
}
