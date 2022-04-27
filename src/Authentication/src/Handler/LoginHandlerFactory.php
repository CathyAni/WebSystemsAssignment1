<?php

declare(strict_types=1);

namespace Authentication\Handler;

use Authentication\Adapter\AuthenticationAdapter;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class LoginHandlerFactory
{
    public function __invoke(ContainerInterface $container): LoginHandler
    {
        return new LoginHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(AuthenticationAdapter::class)
        );
    }
}
