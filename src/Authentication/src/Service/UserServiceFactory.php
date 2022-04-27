<?php

declare(strict_types=1);

namespace Authentication\Service;

use Doctrine\ORM\EntityManager;
use General\Service\GeneralService;
use General\Service\MailService;
use Mezzio\Helper\UrlHelper;
use Psr\Container\ContainerInterface;

class UserServiceFactory
{

    public function __invoke(ContainerInterface $container)
    {
        $xserv = new UserService();
        $em = $container->get(EntityManager::class);
        $mailService = $container->get(MailService::class);
        $urlHelper = $container->get(UrlHelper::class);
        $generalService = $container->get(GeneralService::class);
        $xserv->setEntityManager($em)->setMailService($mailService)->setGeneralService($generalService);
        return $xserv;
    }
}
