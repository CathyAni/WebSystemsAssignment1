<?php

declare(strict_types=1);

namespace General\Service;

// use GeneralService;
use Mezzio\Helper\ServerUrlHelper;
use Mezzio\Helper\UrlHelper;
use Psr\Container\ContainerInterface;

class GeneralServiceFactory{


    public function __invoke(ContainerInterface $container)
    {
        $urlHelper = $container->get(UrlHelper::class);
        $serverHelper = $container->get(ServerUrlHelper::class);

        $xserv = new GeneralService();

        $xserv->setUrlHelper($urlHelper)->setServerUrlHelper($serverHelper);
        return $xserv;
    }
}