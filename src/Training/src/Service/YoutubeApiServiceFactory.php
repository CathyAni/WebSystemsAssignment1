<?php

declare(strict_types=1);

namespace Training\Service;

use Doctrine\ORM\EntityManager;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class YoutubeApiServiceFactory
{
    public function __invoke(ContainerInterface $container) : YoutubeApiService
    {
        $xserv = new YoutubeApiService();
        $em = $container->get(EntityManager::class);
        $config = $container->get("config");

        $xserv->setEntityManager($em)->setGoogleApi($config["google"]["api_key"]);
        return $xserv;
    }
}
