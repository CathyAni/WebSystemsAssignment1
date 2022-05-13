<?php

declare(strict_types=1);

namespace Training\Service;

use Doctrine\ORM\EntityManager;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class TrainingServiceFactory
{
    public function __invoke(ContainerInterface $container) : TrainingService
    {
        $xserv =  new TrainingService();
        $em = $container->get(EntityManager::class);
        $xserv->setEntityManager($em);
        return $xserv;
    }
}
