<?php

declare(strict_types=1);

namespace Authentication\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class CreateUserHandlerFactory
{
    public function __invoke(ContainerInterface $container) : CreateUserHandler
    {
        return new CreateUserHandler($container->get(TemplateRendererInterface::class));
    }
}
