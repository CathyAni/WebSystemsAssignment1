<?php

declare(strict_types=1);

namespace Authentication\Middleware;

use Psr\Container\ContainerInterface;
use Mezzio\Authentication\UserInterface;

class UserRedirectMiddlewareFactory
{
    public function __invoke(ContainerInterface $container) : UserRedirectMiddleware
    {
        return new UserRedirectMiddleware(
            $container->get(UserInterface::class),
            $container->get('config')['authentication']['redirect']
        );
    }
}
