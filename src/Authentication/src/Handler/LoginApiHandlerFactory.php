<?php

declare(strict_types=1);

namespace Authentication\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class LoginApiHandlerFactory
{
    public function __invoke(ContainerInterface $container) : LoginApiHandler
    {
        return new LoginApiHandler($container->get(TemplateRendererInterface::class));
    }
}
