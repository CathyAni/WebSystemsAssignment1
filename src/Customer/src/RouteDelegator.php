<?php 

declare(strict_types=1);

namespace Customer;

use Customer\Handler\DashboardHandler;
use Psr\Container\ContainerInterface;

class RouteDelegator{

    public function __invoke(ContainerInterface $container, $servicename, callable $callback)
    {
        $app = $callback();

        $app->route("/dashboard", [DashboardHandler::class], ["POST", "GET"], "customer.dasboard");

        //API

        // $app->route("/api/dashboard", );

        return $app;
    }
}