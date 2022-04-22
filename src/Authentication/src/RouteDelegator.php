<?php


declare(strict_types=1);

namespace Authentication;

use Authentication\Handler\LoginApiHandler;
use Authentication\Handler\LoginHandler;
use Psr\Container\ContainerInterface;

class RouteDelegator{
    public function __invoke(ContainerInterface $container, $servicename, callable $callback)
    {
        // retur
        $app = $callback();
        $app->route("/login", [LoginHandler::class], ["GET", "POST"]);

        // Api 

        $app->route("/api/login", [LoginApiHandler::class], ["POST"]);

        return $app;
    }
}