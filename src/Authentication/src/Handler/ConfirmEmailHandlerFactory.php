<?php

declare(strict_types=1);

namespace Authentication\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class ConfirmEmailHandlerFactory
{
    public function __invoke(ContainerInterface $container) : ConfirmEmailHandler
    {
        return new ConfirmEmailHandler($container->get(TemplateRendererInterface::class));
    }
}
