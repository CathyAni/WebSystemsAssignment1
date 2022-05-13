<?php

declare(strict_types=1);

namespace General\Service;

use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class MailServiceFactory
{


    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get("config");
        $mailService = $container->get("acmailer.mailservice.default");
        
        if($config["debug"] == null){
            $mailService = ($config["debug"] ? $container->get("acmailer.mailservice.default") : $container->get("acmailer.mailservice.live"));
        }
        
        return new  MailService($mailService);
    }
}
