<?php

declare(strict_types=1);

namespace Authentication\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class RecoverPasswordHandlerFactory
{
    public function __invoke(ContainerInterface $container) : RecoverPasswordHandler
    {
        return new RecoverPasswordHandler($container->get(TemplateRendererInterface::class));
    }
}
