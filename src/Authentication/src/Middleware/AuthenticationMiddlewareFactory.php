<?php

declare(strict_types=1);

namespace Authentication\Middleware;

use Authentication\Service\AuthenticationInterface;
use Psr\Container\ContainerInterface;

class AuthenticationMiddlewareFactory
{
    public function __invoke(ContainerInterface $container) : AuthenticationMiddleware
    {
        return new AuthenticationMiddleware($container->get(AuthenticationInterface::class));
    }
}
