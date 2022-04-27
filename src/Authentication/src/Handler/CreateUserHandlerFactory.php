<?php

declare(strict_types=1);

namespace Authentication\Handler;

use Authentication\Form\UserForm;
use Authentication\Service\UserService;
use General\Service\GeneralService;
use Laminas\Form\FormElementManager;
use Mezzio\Helper\UrlHelper;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class CreateUserHandlerFactory
{
    public function __invoke(ContainerInterface $container) : CreateUserHandler
    {
        return new CreateUserHandler(
            $container->get(TemplateRendererInterface::class),
            $container->get(FormElementManager::class)->get(UserForm::class),
            $container->get(UserService::class),
        );
    }
}
