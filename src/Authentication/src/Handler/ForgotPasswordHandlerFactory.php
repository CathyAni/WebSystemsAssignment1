<?php

declare(strict_types=1);

namespace Authentication\Handler;

use Doctrine\ORM\EntityManager;
use Exception;
use General\Service\GeneralService;
use General\Service\MailService;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class ForgotPasswordHandlerFactory
{
    public function __invoke(ContainerInterface $container): ForgotPasswordHandler
    {
        if (!$container->has(MailService::class)) {
            throw new Exception("MailService Required");
        }
        if (!$container->has(GeneralService::class)) {
            throw new Exception("GeneralService is Required");
        }
        $mailService = $container->get(MailService::class);
        $generalService = $container->get(GeneralService::class);
        return new ForgotPasswordHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(EntityManager::class),
            $mailService,
            $generalService
        );
    }
}
