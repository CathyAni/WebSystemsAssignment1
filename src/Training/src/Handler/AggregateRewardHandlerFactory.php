<?php

declare(strict_types=1);

namespace Training\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class AggregateRewardHandlerFactory
{
    public function __invoke(ContainerInterface $container) : AggregateRewardHandler
    {
        return new AggregateRewardHandler($container->get(TemplateRendererInterface::class));
    }
}
