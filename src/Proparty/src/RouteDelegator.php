<?php
declare(strict_types=1);


namespace Proparty;
use Psr\Container\ContainerInterface;

class RouteDelegator {


    public function __invoke(ContainerInterface $container, $servicename, callable $callback){
        $app = $callback();

        return $app;
    }
}